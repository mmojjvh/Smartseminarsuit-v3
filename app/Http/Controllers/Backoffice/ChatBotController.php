<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Events
use App\Events\SendEmailEvent;

//Services & Repositories
use App\Domain\Interfaces\Services\Backoffice\ICRUDService;
use App\Domain\Interfaces\Repositories\Backoffice\IServicesRepository;
use App\Domain\Interfaces\Repositories\Backoffice\IAppointmentsRepository;

//Request Validator
use App\Http\Requests\Backoffice\FAQsRequest;

//Model
use App\Models\Backoffice\ArtificialIntelligence;

//Global Classes
use Input;

class ChatBotController extends Controller
{
    //Do some magic
    public function __construct(IAppointmentsRepository $repo, IServicesRepository $serviceRepo, ICRUDService $CRUDservice){
        $this->data = [];
        $this->repo = $repo;
        $this->serviceRepo = $serviceRepo;
        $this->CRUDservice = $CRUDservice;
        $this->data['title'] = 'ChatBot';
        $this->data['appointment'] = null;
        $this->data['statuses'] = [
            'Pending',
            'Scheduled',
            'Completed',
            'No Show',
        ];
    }

    public function index(){
        $this->data['appointments'] = $this->repo->fetch();
        $this->data['events'] = [];
        $events = $this->data['appointments']->where('start','!=',null)->where('end','!=',null);
        foreach($events as $index => $event){
            if((auth()->user()->type == 'patient' AND $event->patient->user->id == auth()->user()->id) OR auth()->user()->type != 'patient'){

                if(!$event->patient_id){
                    array_push($this->data['events'],[ 
                        'title' => 'Service: '.ucfirst($event->service->name).', Patient : '.$event->name, 
                        'description' => 'Patient : '.$event->name, 
                        'start' => date('Y-m-d',strtotime($event->start)).'T'.date('H:i:s',strtotime($event->start)), 
                        'end' =>  date('Y-m-d',strtotime($event->end)).'T'.date('H:i:s',strtotime($event->end))]);
                }else{
                    array_push($this->data['events'],[ 
                        'title' => 'Service: '.ucfirst($event->service->name).', Patient : '.$event->patient->user->name, 
                        'description' => 'Patient : '.$event->patient->user->name, 
                        'start' => date('Y-m-d',strtotime($event->start)).'T'.date('H:i:s',strtotime($event->start)), 
                        'end' =>  date('Y-m-d',strtotime($event->end)).'T'.date('H:i:s',strtotime($event->end))]);
                }


            }else{
                array_push($this->data['events'],[ 
                    'title' => 'Date & time taken', 
                    'description' => '', 
                    'start' => date('Y-m-d',strtotime($event->start)).'T'.date('H:i:s',strtotime($event->start)), 
                    'end' =>  date('Y-m-d',strtotime($event->end)).'T'.date('H:i:s',strtotime($event->end))]);
            }
        }
        $this->data['events'] = json_encode($this->data['events']);
        $this->data['services'] = $this->serviceRepo->pluck('name', 'id')->toArray();
        return view('backoffice.pages.chatbot.index',$this->data);
    }

    public function create(Request $request){
        $appointment = $this->repo->saveGuessAppointment($request);
        if($appointment){
            event(new SendEmailEvent($appointment,'guest_appointment_details'));
        }
        return redirect()->back();
    }

    public function train(Request $request){
        $file = $request->file('file');
        $fileContents = file($file->getPathname());
        foreach ($fileContents as $line) {
            $data = str_getcsv($line);
            ArtificialIntelligence::create([
                'question' => $data[0],
                'answer' => $data[1],
            ]);
        }

        session()->flash('notification-status', "success");
        session()->flash('notification-msg', "Data has been successfully fed to your AI.");
        return redirect()->back();
    }

    public function autoReply(){
        $message = Input::get('_message');

        if(Input::has('_message') AND Input::get('_message') != null){
            $exploded = explode(" ",str_replace(' & ',' ',str_replace("?","",Input::get('_message')))); 
            $query = ArtificialIntelligence::query();
            foreach ($exploded as $key => $value) {
                if(strlen($value) > 4){
                    $query->where('question', 'like', "%{$value}%");
                }
            }
            $data['datas'] = $query->orderBy('id', 'ASC')->first()?:[
                            'id' => 0, 
                            'question' => null, 
                            'answer' => "Sorry 😔, I don't have answer for that specific inquiry for the meantime. Please try to ask other inquiries. Thank you."];
            return response()->json($data,200); 
        }
        $data['datas'] = ['id' => 0, 'question' => null, 'answer' => null];
        return response()->json($data, 500); 
        
    }
}
