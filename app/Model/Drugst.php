<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Drugst extends Model
{
    //
    public $table='drugst';
    public $primaryKey="id";
    //public $fillable=['pername','perurl'];
    public $guarded=[];
    public $timestamps=false;
}
