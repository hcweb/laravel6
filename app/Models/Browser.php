<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Browser extends Model
{
    protected $table='browser';

    protected $fillable=['mould','member_id','p_id'];
}
