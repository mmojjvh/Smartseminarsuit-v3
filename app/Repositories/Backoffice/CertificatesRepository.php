<?php

namespace App\Repositories\Backoffice;
use App\Domain\Interfaces\Repositories\Backoffice\ICertificatesRepository;

use App\Services\ImageUploader as UploadLogic;
use App\Models\Backoffice\Certificate as Model;
use App\Models\Backoffice\AvailedService;
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

    public function generateCertificate($event, $quote, $background){
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
                $data->save();
                array_push($certificates, $data);
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

    public function updateAndFetch($id, $background) {
        
        $certificate = self::where('event_id', $id)->update(['background_image' => $background]);
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
}
