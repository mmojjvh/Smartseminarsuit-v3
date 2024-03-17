<?php

namespace App\Repositories\Backoffice;
use App\Domain\Interfaces\Repositories\Backoffice\IFAQsRepository;

use App\Services\ImageUploader as UploadLogic;
use App\Models\Backoffice\FAQ as Model;
use App\Models\User;
use DB, Str, Input;

class FAQsRepository extends Model implements IFAQsRepository
{

    public function fetch(){
        if(Input::has('search') AND Input::get('search') != null){
            $exploded = explode(" ",str_replace(' & ',' ',Input::get('search')));
            $query = self::query();
            foreach ($exploded as $key => $value) {
                $query->where('question', 'like', "%{$value}%")
                ->orWhere('answer', 'like', "%{$value}%");
            }
            return $query->orderBy('sequence', 'ASC')->get();
        }
        return self::orderBy('sequence', 'ASC')->get();
    }

    public function saveData($request){
        DB::beginTransaction();
        try {
            $faq = self::find($request->id)? : new self;
            $faq->sequence = $request->sequence;
            $faq->question = $request->question;
            $faq->answer = $request->answer;

            $faq->save();

            DB::commit();

            return $faq;
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
