<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceType extends Model
{
    use SoftDeletes;

    protected $table = 'service_types';

    protected $guarded = [];


    public function service(){
        return $this->belongsTo('App\Models\Backoffice\Service', 'service_id','id');
    }
}
