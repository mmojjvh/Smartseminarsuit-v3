<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Record extends Model
{
    use SoftDeletes;

    protected $table = 'treatment_records';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    
    public function patient(){
        return $this->belongsTo('App\Models\Backoffice\Patient', 'patient_id','id');
    }
    
    public function service(){
        return $this->belongsTo('App\Models\Backoffice\Service', 'service_id','id');
    }
}
