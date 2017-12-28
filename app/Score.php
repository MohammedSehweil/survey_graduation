<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = "score";
    public $timestamps  = false;
    protected $fillable = ['university_score','our_score'];

}
