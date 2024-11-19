<?php

namespace App\Repositories\Backoffice;
use App\Domain\Interfaces\Repositories\Backoffice\ICertificatesRepository;

use App\Services\ImageUploader as UploadLogic;
use App\Models\Backoffice\Certificate as Model;
use App\Models\Backoffice\AvailedService;
use App\Models\Backoffice\Coordinators;
use App\Models\User;
use DB, Str;

class CertificatesRepository extends Model implements ICertificatesRepository
{

    public function fetch($id){
        // return self::where('event_id', $id)->get();

        return $this->fetchCertificatesWithUserDetails($id);
    }

    public function fetchAll(){
        return self::all();
    }

    public function generateCertificate($event, $quote, $background, $styles, $useTemplate){
        DB::beginTransaction();
        try {
            $attandanceList = $event->attendance;
            $certificates = [];            

            foreach($attandanceList as $index => $attendance){
                $certificate_id = $event->id.$attendance->user_id.date('mdy').$index;
                $data = new self;
                $data->event_id = $event->id;
                $data->user_id = $attendance->user_id;
                $data->certificate_id = $certificate_id;
                $data->user_name = $attendance->user->name;
                $data->event_name = $event->name;
                $data->quote = $quote;
                $data->date = $event->start?date('Y-m-d',strtotime($event->start)):null;
                $data->category = $event->certCat->name;
                $data->directory = $event->certCat->directory;
                $data->filename = $event->certCat->filename;
                $data->background_image = $background;

                $data->heading_style = $styles["heading"];
                $data->title_style = $styles["title"];
                $data->text_style = $styles["text"];
                $data->quotes_style = $styles["quotes"];

                $data->heading_color = $styles["heading_color"];
                $data->title_color = $styles["title_color"];
                $data->text_color = $styles["text_color"];
                $data->quotes_color = $styles["quotes_color"];

                $data->use_template = $useTemplate;

                $isInTimeFrame = $this->timeFrameValidation($event->start, $event->end, $attendance->created_at, $attendance->timeout);
                // echo "USER: ".$attendance->user->name."<br>";
                // echo "IS IN TIME FRAME: ".$isInTimeFrame."<br><br>";
                if($isInTimeFrame){
                    $data->save();
                    array_push($certificates, $data);
                }

            }

            DB::commit();
            
            // return $certificates;

            // Fetch certificates with user details after generating them
            return $this->fetchCertificatesWithUserDetails($event->id);
            
        } catch (\Exception $e) {
            DB::rollback();
            return 0;
        }
    }

    public function updateAndFetch($id, $background, $styles, $useTemplate) {
        
        $certificate = self::where('event_id', $id)->update([
            'background_image' => $background,

            'heading_style' => $styles["heading"],
            'title_style' => $styles["title"],
            'text_style' => $styles["text"],
            'quotes_style' => $styles["quotes"],

            'heading_color' => $styles["heading_color"],
            'title_color' => $styles["title_color"],
            'text_color' => $styles["text_color"],
            'quotes_color' => $styles["quotes_color"],
            'use_template' => $useTemplate
        ]);
        // $certificate->background_image = $background;
        // $certificate->save();

        return $this->fetch($id);
    }

    public function getCertificate($id){
        return self::join('participants', 'certificates.user_id', '=', 'participants.user_id')
            ->where('certificates.certificate_id', $id)
            ->select('certificates.*', 'participants.esignature as user_signature')
            ->first();
    }

    public function fetchCertificatesWithUserDetails($eventId) {
        return self::join('participants', 'certificates.user_id', '=', 'participants.user_id')
            ->where('certificates.event_id', $eventId)
            ->select('certificates.*', 'participants.esignature as user_signature')
            ->get();
    }

    public function timeFrameValidation($start, $end, $timein, $timeout) {

        if(!$timeout) return true;

        $eventDuration = strtotime($end) - strtotime($start);
        $attendanceDuration = strtotime($timeout) - strtotime($timein);
        $requiredDuration = 0.7 * $eventDuration;

        echo "EVENT DURATION: ".$eventDuration."<br>";
        echo "ATTENDANCE DURATION: ".$attendanceDuration."<br>";
        echo "REQUIRED DURATION: ".$requiredDuration."<br>";

        if ($attendanceDuration < $requiredDuration) {
            // INVALID
            return false;
        } else {
            return true;
        }
        
    }

    public function getCoordinators($eventId) {
        return self::join('coordinators', 'certificates.event_id', '=', 'coordinators.event_id')
            ->where('certificates.event_id', $eventId)
            ->select('coordinators.*')
            ->get();
    }
}
