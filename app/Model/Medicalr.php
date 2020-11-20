<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Medicalr extends Model
{
    //
    public $table='medicalr';
    public $primaryKey="id";
    //public $fillable=['pername','perurl'];
    public $guarded=[];
    public $timestamps=false;
    public function patient()
    {
        return $this->belongsTo('App\Model\Patient','patient_id');
    }
}
