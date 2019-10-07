<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $table='message';

    protected $fillable=['name','email','phone','content','remark','ip','member_id','city'];

    public function member(){
        return $this->belongsTo(Member::class);
    }

}
