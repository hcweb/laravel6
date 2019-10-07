<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use Notifiable;

    protected $table='members';

    protected $fillable=['name','avatar','email','tel','ip','city','state','platform','remember_token','openid','password','is_enabled'];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password']=bcrypt($password);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }
}
