<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asignatory extends Model
{
    use SoftDeletes;

    protected $table = 'asignatories';
    
    protected $guarded = [];

    public function event(){
      return $this->belongsTo('App\Models\Event', 'event_id','id');
    }
}