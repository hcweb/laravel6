<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mould extends Model
{
    protected $table='moulds';

    protected $fillable=['name','table_name','des','is_system','status','order','repeat','ctr_name'];

    public function fields(){
        return $this->hasMany(Field::class,'mould_id');
    }

    public function categories(){
        return $this->hasMany(Category::class,'mould_id');
    }
}
