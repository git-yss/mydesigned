<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //
    public $table='log';
    public $primaryKey="id";
    //public $fillable=['pername','perurl'];
    public $guarded=[];
    public $timestamps=false;
}
