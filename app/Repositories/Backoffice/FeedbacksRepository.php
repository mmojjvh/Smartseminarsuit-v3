<?php

namespace App\Repositories\Backoffice;
use App\Domain\Interfaces\Repositories\Backoffice\IFeedbacksRepository;

use App\Services\ImageUploader as UploadLogic;
use App\Models\Backoffice\Feedback as Model;
use App\Models\User;
use App\Models\Backoffice\FeedbackQuestion;
use App\Models\Backoffice\FeedbackAnswer;

use DB, Str, Input;

class FeedbacksRepository extends Model implements IFeedbacksRepository
{

    public function fetch(){
        if(Input::has('event_id') AND Input::get('event_id') != null){
            return self::where('event_id', Input::get('event_id'))->orderBy('created_at','DESC')->get();
        }
        if(Input::has('search') AND Input::get('search') != null){
            $exploded = explode(" ",str_replace(' & ',' ',Input::get('search')));
            $query = self::query();
            foreach ($exploded as $key => $value) {
                $query->where('comment', 'like', "%{$value}%");
            }
            return $query->get();
        }
        return self::all();
    }

    public function saveData($request){
        DB::beginTransaction();
        try {
            $feedback = new self;
            $feedback->event_id = $request->event_id;
            $feedback->user_id = auth()->user()->id;
            $feedback->comment = $request->comment;
            $feedback->question = $request->feedback_question;
            $feedback->save();

            DB::commit();

            return $feedback;
        } catch (\Exception $e) {
             DB::rollback();
             return false;
        }
    }

    public function findOrFail($id){
        $data = self::find($id);
        if(!$data){
            return false;
        }
        return $data;
    }

    public function deleteData($id){
        DB::beginTransaction();
        try {
            self::destroy($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function fetchFeedbacks($id){
        return self::where('event_id', $id)->orderBy('created_at','DESC')->paginate(10);
    }

    public function fetchEventFeedbackQuestions($eventId){
        $data = FeedbackQuestion::where('event_id', $eventId)->get();
        return $data;
    }

    public function fetchUserFeedbackAnswers($eventId){
        $data = FeedbackAnswer::where('event_id', $eventId)->where('user_id', auth()->user()->id)->get();
        return $data;
    }

    public function fetchUserFeedbacksQuery($eventId){
        $userid = auth()->user()->id;
        $sql =  FeedbackQuestion::join('feedback_answers', 'feedback_answers.feedback_question_id', '=', 'feedback_questions.id')
        ->where('feedback_questions.event_id', $eventId)
        ->where('feedback_answers.event_id', $eventId)
        ->where('feedback_answers.user_id', $userid)
        ->select('feedback_questions.*', 'feedback_answers.answer')
        ->get();
        echo $userid;
        echo json_encode($sql);
        return $sql;
    }

    public function fetchUserFeedbacks($questions, $answers){
        $result = [];
        $userid = auth()->user()->id;
        foreach ($questions as $q => $question) {
            $data = $question;
            $data["user_answer"] = "";
            $data["user_answer_date"] = "";
            foreach ($answers as $a => $answer) {
                if($question["id"] == $answer["feedback_question_id"]){
                    if($answer['user_id'] == $userid){
                        $question["user_answer"] = $answer['answer'];
                        $question["user_answer_date"] = $answer['created_at'];
                    }
                }
            }
            $result[] = $data;
        }
        return $result;
    }

    public function addFeedbackAnswer($request){
        $feedans = new FeedbackAnswer;
        $feedans->event_id = $request->event_id;
        $feedans->feedback_question_id = $request->feedback_question_id;
        $feedans->user_id = auth()->user()->id;
        $feedans->answer = $request->comment;
        $feedans->save();
        return $feedans;
    }
}
