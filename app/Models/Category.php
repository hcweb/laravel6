<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;
    protected $table='categories';
    protected $fillable=['title','route','mould_id','target','icon_class','color','font_style','order','is_show','page_num','template_index','template_list','template_show','alias','seo_title','seo_key','seo_content','url','thumb','description','_lft','_rgt','parent_id'];

    public function mould(){
        return $this->belongsTo(Mould::class,'mould_id');
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function single(){
        return $this->hasOne(Single::class);
    }

    public function downloads(){
        return $this->hasMany(Download::class);
    }

    public function pictures(){
        return $this->hasMany(Picture::class);
    }

    public function guestBooks(){
        return $this->hasMany(GuestBook::class);
    }
}
