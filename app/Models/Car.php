<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "cars";


    protected $fillable = [
         'name', 'active','created_at','updated_at', 'type', 'color', 'airConditioning', 'confort', 'upholstery', 'paintState', 'year', 'registrationDate', 'lastCheckDate', 'armored', 'status', 'armoredLevel', 'plateNumber', 'circulationCertificate', 'propertyTitle', 'serialCar', 'lateralMirrors', 'rearViewMirror', 'frontLights', 'taillights', 'blinkingLights', 'rubbersState', 'vehicleStatus', 'travelOtherStates', 'photos','model_id','typeCar_id'];


    public function model()
	{
		return $this->belongsTo('App\Models\ModelCar','model_id','id');
	}

	public function typeCar()
	{
		return $this->belongsTo('App\Models\TypeCar','typeCar_id','id');
	}


}
