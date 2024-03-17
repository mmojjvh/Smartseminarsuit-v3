<?php

namespace App\Repositories\Backoffice;
use App\Domain\Interfaces\Repositories\Backoffice\IAppointmentsRepository;

use App\Services\ImageUploader as UploadLogic;
use App\Models\Backoffice\Appointment as Model;
use App\Models\User;
use DB, Str, Carbon;

class AppointmentsRepository extends Model implements IAppointmentsRepository
{

    public function fetch(){
        //if(auth()->user()->type != 'patient'){
            return self::all();
        //}else{
        //    return self::where('patient_id', auth()->user()->patient->id)->get();
        //}
    }

    public function count(){
        return self::where('patient_id',auth()->user()->patient->id)->whereIn('status', ['Pending', 'Scheduled'])->count();
    }

    public function scheduledAppoints(){
        return self::where('status', '!=','Pending')->get();
    }

    public function saveData($request){
        DB::beginTransaction();
        try {
            
            $appointment = self::find($request->id)? : new self;
            
            // if($this->checkDate($request) AND auth()->user()->type == 'patient'){
            //     session()->flash('notification-status', "warning");
            //     session()->flash('notification-msg', "Oops! The time slot you've been selected was already been taken.");
                
            //     return false;
            // }else{
                $start = $request->start_date." ".$request->start_time.":00:00";
                $end = $request->start_date." ".$request->end_time.":00:00";

                $appointment->patient_id = $request->patient_id;
                $appointment->service_id = $request->service_id;
                $appointment->service_type_id = $request->service_type;
                $appointment->details = $request->details;
                $appointment->status = $request->status?$request->status:'Pending';
                $appointment->start = $start?date('Y-m-d H:i:s',strtotime($start)):null;
                $appointment->end = $end?date('Y-m-d H:i:s',strtotime($end)):null;
                
                $appointment->save();

                DB::commit();
                
                session()->flash('notification-status', "primary");
                session()->flash('notification-msg', __('msg.save_success'));
                return $appointment;
            // }
            
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('notification-status', "danger");
            session()->flash('notification-msg', __('msg.error'));
            return false;
        }
    }

    private function checkDate($request){
        $start = $request->start_date." ".$request->start_time.":00:00";
        $end = $request->end_date." ".$request->end_time.":00:00";

        $checkStart = self::where('start', '<=', $start)
                            ->where('end', '>=', $start)
                            ->count();

        $checkEnd = self::where('start', '<=', $end)
                            ->where('end', '>=', $end)
                            ->count();

        $checkDate1 = self::where('start', '>=', $start)
                            ->where('end','<=', $end)
                            ->count();

        
        if($checkStart > 0 || $checkEnd > 0 || $checkDate1 > 0 ){
            return true;
        }else{
            return false;
        }

    }

    public function saveGuessAppointment($request){
        DB::beginTransaction();
        try {
            $appointment = self::find($request->id)? : new self;

            $appointment->name = $request->name;
            $appointment->email = $request->email;
            $appointment->contact = $request->contact;
            $appointment->service_id = $request->service_id;
            $appointment->details = $request->details;
            $appointment->status = $request->status?$request->status:'Pending';
            $appointment->start = $request->start?date('Y-m-d H:i:s',strtotime($request->start)):null;
            $appointment->end = $request->end?date('Y-m-d H:i:s',strtotime($request->end)):null;
            
            $appointment->save();

            DB::commit();
            
            return $appointment;
            
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

    public function getAppointments($start, $end){
        $start = date("Y-m-01", strtotime($start));
        $end = date("Y-m-t", strtotime($end));
        return self::where('start','>=', $start)->where('end','<=', $end)->orderBy('start', 'ASC')->get();
    }
}
