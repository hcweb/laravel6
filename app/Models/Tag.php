<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = ['name'];
    
    public function dfgdfgdfgdf()
{
    return $this->belongsToMany(Dfgdfgdfgdf::class, 'model_tag');
}public function download()
{
    return $this->belongsToMany(Download::class, 'model_tag');
}public function guest_book()
{
    return $this->belongsToMany(GuestBook::class, 'model_tag');
}public function picture()
{
    return $this->belongsToMany(Picture::class, 'model_tag');
}public function post()
{
    return $this->belongsToMany(Post::class, 'model_tag');
}public function single()
{
    return $this->belongsToMany(Single::class, 'model_tag');
}
}