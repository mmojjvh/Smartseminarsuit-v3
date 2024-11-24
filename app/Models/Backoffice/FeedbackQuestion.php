<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeedbackQuestion extends Model
{
    use SoftDeletes;

    protected $table = 'feedback_questions';
    
    protected $guarded = [];

    public function event(){
        return $this->belongsTo('App\Models\Backoffice\Event', 'event_id','id');
    }

}
