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
        'valuedBy','assessmentDriver','assessment1','assessment2','assessment3','observations','created_at','updated_at','total'
    ];


}
