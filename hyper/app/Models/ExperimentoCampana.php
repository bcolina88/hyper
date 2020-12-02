<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExperimentoCampana extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "experimento_campanas";
    
    protected $fillable = [
        'experimento_id', 'campana_id'
    ];

    public function experimento()
    {
        return $this->belongsTo('App\Models\Experimento','experimento_id','id');
    }

    public function campana()
    {
        return $this->belongsTo('App\Models\Campana','campana_id','id');
    }
    

}
