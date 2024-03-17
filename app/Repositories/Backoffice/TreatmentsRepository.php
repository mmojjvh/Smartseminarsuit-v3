<?php

namespace App\Repositories\Backoffice;
use App\Domain\Interfaces\Repositories\Backoffice\ITreatmentsRepository;

use App\Services\ImageUploader as UploadLogic;
use App\Models\Backoffice\Record as Model;
use App\Models\Backoffice\AvailedService;
use App\Models\User;
use DB, Str;

class TreatmentsRepository extends Model implements ITreatmentsRepository
{

    public function fetch(){
        return self::all();
    }

    public function saveData($patient_id){
        DB::beginTransaction();
        try {
            $data = new self;
            $data->patient_id = $patient_id;
            
            $data->save();

            DB::commit();
            
            return $data;
            
        } catch (\Exception $e) {
             DB::rollback();
             return false;
        }
    }

    public function fetchTreatments($id){
        return AvailedService::where('record_id', $id)->get();
    }

    public function saveTreatment($request, $id){
        DB::beginTransaction();
        try {
            $data = self::find($id);
            $data->school_office = $request->school_office;
            $data->diagnosis = $request->diagnosis;
            $data->plan_summary = $request->plan_summary;
            if($request->has('panoramic')){
                $data->panoramic = true;
            }
            if($request->has('photo')){
                $data->photo = true;
            }
            if($request->has('ceph')){
                $data->ceph = true;
            }
            if($request->has('cast')){
                $data->cast = true;
            }
            if($request->has('tmj')){
                $data->tmj = true;
            }
            
            $data->save();
            
            $treatments = AvailedService::where('record_id', $id)->get();
            if($treatments->count() == 0){
                foreach(range(0, 9) as $index){
                    $newTreatment = new AvailedService;
                    $newTreatment->record_id = $id;
                    $newTreatment->date = $request->date[$index];
                    $newTreatment->service_id = $request->service_id[$index];
                    $newTreatment->next_procedure = $request->next_procedure[$index];
                    $newTreatment->payment = $request->payment[$index];
                    $newTreatment->balance = $request->balance[$index];
                    $newTreatment->doctor = $request->doctor[$index];
                    $newTreatment->save();
                }
                
            }else{
                foreach($treatments as $index => $treatment){
                    $treatment->date = $request->date[$index];
                    $treatment->service_id = $request->service_id[$index];
                    $treatment->next_procedure = $request->next_procedure[$index];
                    $treatment->payment = $request->payment[$index];
                    $treatment->balance = $request->balance[$index];
                    $treatment->doctor = $request->doctor[$index];
                    $treatment->save();
                }
            }
            DB::commit();
            
            return $data;
            
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
}
