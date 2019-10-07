<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $table='fields';
    protected $fillable=['title','name','type','byte','order','content','tip_content','mould_id','is_empty','validate','is_system'];

    public function mould(){
        return $this->belongsTo(Mould::class);
    }
}
