<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    public $table='patient';
    public $primaryKey="id";
    //public $fillable=['pername','perurl'];
    public $guarded=[];
    public $timestamps=false;

    public function medicalr(){
        return $this->hasMany('App\Model\Medicalr', 'patient_id','id');
    }
}
