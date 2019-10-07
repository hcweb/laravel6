<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    protected $table='systems';
    protected $fillable=['name','title','content','type','value','tabType','is_system'];
}
