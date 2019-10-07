<?php

namespace App\Http\Controllers\Backend;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends BaseController
{
    public function index(){
        $messages=Message::with('member')->latest()->get();
        return view('backend.message.index',compact('messages'));
    }

    public function edit(Message $message){
        return view('backend.message.edit',compact('message'));
    }

    public function destroy($id)
    {
        if (Message::destroy(explode(',',$id))) {
            return $this->sendSuccess("删除成功!");
        }
        return $this->sendError("删除失败!");
    }
}
