<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Menu extends Model
{
    use NodeTrait;
    protected $table = 'menus';

    protected $fillable = ['title', 'route', 'target', 'icon_class', 'color', 'order', 'is_show','_lft','_rgt','parent_id'];

    public function permissions(){
        return $this->hasMany(Permission::class);
    }
}
