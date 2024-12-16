<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Backoffice\FeedbackAnswer;

//Events
use App\Events\SendEmailEvent;

//Services & Repositories
use App\Domain\Interfaces\Services\Backoffice\ICRUDService;
use App\Domain\Interfaces\Repositories\Backoffice\IFeedbacksRepository;

//Request Validator
use App\Http\Requests\Backoffice\FeedbackRequest;

//Global Classes
use Input;

class FeedbacksController extends Controller
{
    //Do some magic
    public function __construct(IFeedbacksRepository $repo, ICRUDService $CRUDservice){
        $this->data = [];
        $this->repo = $repo;
        $this->CRUDservice = $CRUDservice;
        $this->data['title'] = 'Feedbacks';
        $this->data['feedback'] = null;
    }

    public function index(){
        $this->data['feedbacks'] = $this->repo->fetch();
        return view('backoffice.pages.feedbacks.index',$this->data);
    }

    public function create(){
        return view('backoffice.pages.feedbacks.create',$this->data);
    }

    public function add(FeedbackRequest $request){

        $data = $request->all();
        $payload = new \stdClass();
        
        if(isset($data["feedback_question_id"]) && isset($data["comment"])){
            
            foreach ($data["feedback_question_id"] as $key => $value) {

                $payload->event_id = $data["event_id"];
                $payload->comment = $data["comment"][$key];
                $payload->feedback_question = $data["feedback_question"][$key];
                $payload->feedback_question_id = $value;
                
                $crudData = $this->CRUDservice->save($payload, $this->repo);
                $result = $this->repo->addFeedbackAnswer($payload);
            }
        }
        
        return redirect()->back();        
    }
}
