<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //
    protected $table='logs';

    protected $fillable=['url','operator','operate_ip','description','operate_time'];

    public $timestamps=false;
}
