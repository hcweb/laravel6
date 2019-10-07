<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TemplateController extends BaseController
{
    public function index(){
        $path=\request()->get('path');
        $dir=\request()->get('dir');

        $p_path=$dir;
        $r_path=$dir;


        $data=array();
        $public_path=public_path().'/frontend';
        $resource_path=resource_path().'/views/frontend';


        if (empty($path) && empty($dir)){

            //获取public/frontend下的文件及文件夹
            if (\File::exists($public_path)){
                $public_files=\File::files($public_path);
                $public_dirs=\File::directories($public_path);
            }

            //获取resources/views/frontend下的文件及文件夹

            if (\File::exists($resource_path)){
                $resource_files=\File::files($resource_path);
                $resource_dirs=\File::directories($resource_path);
            }




            $files=array_merge(['public_path'=>$public_files],['resource_path'=>$resource_files]);
            $dirs=array_merge(['public_path'=>$public_dirs],['resource_path'=>$resource_dirs]);

            $data=array(
                'files'=>$files,
                'dirs'=>$dirs
            );
        }else{
            if ($path === 'public_path'){
                $data=array(
                    'files'=>[
                        'public_path'=>\File::files($public_path.'/'.$dir)
                    ],
                    'dirs'=>[
                        'public_path'=>\File::directories($public_path.'/'.$dir)
                    ]
                );
            }

            if ($path === 'resource_path'){
                $data=array(
                    'files'=>[
                        'resource_path'=>\File::files($resource_path.'/'.$dir)
                    ],
                    'dirs'=>[
                        'resource_path'=>\File::directories($resource_path.'/'.$dir)
                    ]
                );
            }
        }
        return view('backend.template.index',compact('data','p_path','r_path'));
    }


    /**
     * 获取文件内容
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getFileContent(){
        $dir=\request()->get('dir');
        $path=\request()->get('path');
        $fullPath='';
        $t_path='';
        if ($dir == 'resource_path'){
            $fullPath = resource_path('views/frontend'.$path);
            $t_path='views/frontend'.$path;
        }
        if ($dir == 'public_path'){
            $fullPath = public_path('frontend'.$path);
            $t_path='frontend'.$path;
        }

        if (\File::exists($fullPath)){
            return $this->sendSuccess("获取文件内容成功!",[
                'content'=>\File::get($fullPath),
                'path'=>$t_path,
                'dir'=>$dir
            ]);
        }
        return $this->sendError("文件不存在或已经删除!");
    }

    public function saveContent(){
        $dir=\request()->get('dir');
        $path=\request()->get('path');
        $content=\request()->get('content');
        $fullPath='';

        if ($dir == 'resource_path'){
            $fullPath = resource_path($path);
        }
        if ($dir == 'public_path'){
            $fullPath = public_path($path);
        }

        if (\File::exists($fullPath)){
           \File::replace($fullPath,$content);
            return $this->sendSuccess("文件内容更新成功!");
        }
        return $this->sendError("文件不存在或已经删除!");
    }

}
