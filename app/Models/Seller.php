<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $table = 'seller';

    protected $fillable = ['userid','name', 'typeid','logo','telphone','wx','license','introduction'
        ,'content','store_image','address','contact','qq','email','business_hours','serve','audit_status','audit_time','audit_note'
        ,'valid','valid_time'];

}
