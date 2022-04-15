<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class User extends Model
{
    use HasFactory,HasApiTokens;
    public $table="register";   //define if DB name is not registers
    public $timestamps = false;
    protected $guarded = []; //FIX for - SQLSTATE[HY000]: General error: 1364 Field 'email' doesn't have a default value


    //Mutator & Accessors
    public function setPasswordAttribute($password){
        $this->attributes['password'] = bcrypt($password);
    }

    public function getNameAttribute($name){
        return ucfirst($name);
    }
}
