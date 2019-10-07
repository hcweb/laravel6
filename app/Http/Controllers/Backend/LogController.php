<?php

namespace App\Http\Controllers\Backend;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogController extends BaseController
{
    //
    public function index()
    {
        $logs=Log::orderBy('operate_time','DESC')->get();
        return view('backend.log.index',compact('logs'));
    }
}
