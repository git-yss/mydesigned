<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //
    public $table='permission';
    public $primaryKey="id";
   //public $fillable=['pername','perurl'];
    public $guarded=[];
    public $timestamps=false;

}
