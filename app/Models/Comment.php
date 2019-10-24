<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table='comment';
    protected $fillable=['title','ip','content','visitor','city','state','member_id','mould_id','document_id','_lft','_rgt','parent_id'];

   public function download(){
        return $this->belongsTo(Download::class);
    }public function fggfg(){
        return $this->belongsTo(Fggfg::class);
    }public function guest_book(){
        return $this->belongsTo(GuestBook::class);
    }public function picture(){
        return $this->belongsTo(Picture::class);
    }public function post(){
        return $this->belongsTo(Post::class);
    }public function single(){
        return $this->belongsTo(Single::class);
    }
}