<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Events
use App\Events\SendEmailEvent;

//Services & Repositories
use App\Domain\Interfaces\Services\Backoffice\ICRUDService;
use App\Domain\Interfaces\Repositories\Backoffice\IFAQsRepository;
use App\Domain\Interfaces\Repositories\Backoffice\IServicesRepository;
use App\Domain\Interfaces\Repositories\Backoffice\IAppointmentsRepository;

//Request Validator
use App\Http\Requests\Backoffice\AppointmentRequest;

//Global Classes
use Input, DB;

class AppointmentsController extends Controller
{
    //Do some magic
    public function __construct(IFAQsRepository $faqRepo, IAppointmentsRepository $repo, IServicesRepository $serviceRepo, ICRUDService $CRUDservice){
        $this->data = [];
        $this->repo = $repo;
        $this->faqRepo = $faqRepo;
        $this->serviceRepo = $serviceRepo;
        $this->CRUDservice = $CRUDservice;
        $this->data['title'] = 'Appointments';
        $this->data['appointment'] = null;
        $this->data['statuses'] = [
            'Pending',
            'Scheduled',
            'Completed',
            'No Show',
        ];
        $this->data['time'] = [
            // '00'=>"12:00 AM",
            // '01'=>"1:00 AM",
            // '02'=>"2:00 AM",
            // '03'=>"3:00 AM",
            // '04'=>"4:00 AM",
            // '05'=>"5:00 AM",
            // '06'=>"6:00 AM",
            // '07'=>"7:00 AM",
            '08'=>"8:00 AM",
            '09'=>"9:00 AM",
            '10'=>"10:00 AM",
            '11'=>"11:00 AM",
            '12'=>"12:00 PM",
            '13'=>"1:00 PM",
            '14'=>"2:00 PM",
            '15'=>"3:00 PM",
            '16'=>"4:00 PM",
            '17'=>"5:00 PM",
        ];
    }

    public function index(){
        $this->data['faqs'] = $this->faqRepo->fetch();
        $this->data['appointments'] = $this->repo->fetch();
        $this->data['events'] = [];
        $events = $this->data['appointments']->where('status','Scheduled')->where('start','!=',null)->where('end','!=',null);
        foreach($events as $index => $event){
            if((auth()->user()->type == 'patient' AND ($event->patient_id? $event->patient->user->id == auth()->user()->id: false)) OR auth()->user()->type != 'patient'){

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
        return view('backoffice.pages.appointments.index',$this->data);
    }

    public function create(){
        $appointments = $this->repo->count();
        if($appointments > 0){
            session()->flash('notification-status', "warning");
            session()->flash('notification-msg', "Oops! You are not allowed to request for new appointment, you still have Pending or Scheduled appointment.");
            return redirect()->back();
        }
        if(auth()->user()->type != 'patient'){
            return abort(404);
        }
        $this->data['services'] = $this->serviceRepo->pluck('name', 'id')->toArray();
        return view('backoffice.pages.appointments.create',$this->data);
    }

    public function store(AppointmentRequest $request){
        $crudData = $this->repo->saveData($request);
        if(!$crudData){
            return redirect()->back();
        }
        return redirect()->route('backoffice.appointments.index');
    }
    
    public function edit($id){
        $this->data['appointment'] = $this->repo->findOrFail($id);
        if(!$this->data['appointment']){
            return abort(404);
        }
        $this->data['services'] = $this->serviceRepo->pluck('name', 'id')->toArray();
        return view('backoffice.pages.appointments.create',$this->data);
    }

    public function update(AppointmentRequest $request){
        $crudData = $this->CRUDservice->save($request, $this->repo);
        if($crudData AND $crudData->status == 'Scheduled'){
            event(new SendEmailEvent($crudData,'appointment_details'));
        }
        return redirect()->route('backoffice.appointments.index');
    }

    public function delete($id){
        $delete = $this->CRUDservice->delete($id, $this->repo);
        return redirect()->route('backoffice.appointments.index');
    }
}
