<?php

namespace App\Http\Controllers\Common;

use App\Handlers\FileUploadHandler;
use App\Handlers\ImageUploadHandler;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    use ApiResponseTrait;

    public function upload()
    {


        $type = \request()->get('f_type');


        if ((!is_null($type) && $type == 'file')) {
            $folder = request()->get('folder') ? request()->get('folder') : 'files';
            $path = (new FileUploadHandler())->save($type,request()->file('file'), $folder, 'site_');
        }

        if (!is_null($type) && $type == 'img') {
            $folder = request()->get('folder') ? request()->get('folder') : 'thumbs';
            $path = (new FileUploadHandler())->save($type,request()->file('file'), $folder, 'site_');
        }

        if ($path) {
            return $this->sendSuccess('文件上传成功!',
                [
                    'path' => $path,
                    'fullPath' => asset($path),
                    'name'=>request()->file('file')->getClientOriginalName()
                ]);
        } else {
            return $this->sendError('文件上传失败!');
        }
    }

    /**
     * 删除指定图片
     */
    public function remove()
    {
        if (file_exists(public_path(request()->get('path')))) {
            if (unlink(public_path(request()->get('path')))) {
                return $this->sendSuccess('文件删除成功!');
            } else {
                return $this->sendError('文件删除失败!');
            }
        } else {
            return $this->sendError('文件不存在!');
        }
    }
}
