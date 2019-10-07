<?php

namespace App\Http\Controllers\Frontend;

use App\Handlers\IpAddressHandler;
use App\Models\Message;
use App\Traits\ApiResponseTrait;
use Doctrine\DBAL\Schema\AbstractAsset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class MessageController extends Controller
{
    use ApiResponseTrait;

    public function create(){
        return view('frontend.message.index');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^1[34578][0-9]{9}$/',
            'content' => 'required|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('home.message')
                ->withErrors($validator)
                ->withInput();
        }

        //保存留言信息
        $request['ip']=$request->ip();
        $request['member_id']=auth('member')->user()->id;
        $request['city']=IpAddressHandler::getAddress($request->ip());

        if (Message::create($request->all())){
            return redirect()->route('home.message')->with('successMsg', '留言成功,感谢您的宝贵意见!');
         }
         return back()->withInput()->withErrors('留言失败!');
    }
}
