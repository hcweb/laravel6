<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ToolController extends BaseController
{
    public function index(){
        $files=getFileListInfo(public_path('tools'));
        return view('backend.tool.index',compact('files'));
    }

    /**
     * 下载文件
     * @param $file
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function down($file)
    {
        return response()->download(realpath(public_path('/tools/' . $file)), $file);
    }
}
