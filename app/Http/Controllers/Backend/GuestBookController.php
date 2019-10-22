<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\TagRequest;
use App\Models\GuestBook;
use App\Models\Tag;

class GuestBookController extends BaseController
{
   public function index(){
       $datas=GuestBook::orderBy('id','desc')->paginate(config('base_config.page_number'));
       return view('backend.guest_book.index',compact('datas'));
   }
}
