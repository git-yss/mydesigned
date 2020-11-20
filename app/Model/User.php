<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    public $table='User';
    public $primaryKey="id";
    public $fillable=['username','password','email','tel',];
    public $timestamps=false;
 public function role(){
     return $this->belongsToMany('App\Model\Role',
         'user_role','user_id','role_id');
 }

}
