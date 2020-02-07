<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "ratings";


    protected $fillable = [
        'type','typeId','question1','assessment1','question2','assessment2', 'question3','assessment3','observations','created_at','updated_at','total'
    ];

}
