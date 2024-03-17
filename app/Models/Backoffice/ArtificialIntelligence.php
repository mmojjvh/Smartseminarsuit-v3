<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArtificialIntelligence extends Model
{
    use SoftDeletes;

    protected $table = 'artificial_intelligences';

    protected $guarded = [];
}
