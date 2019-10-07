<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DatabaseController extends BaseController
{
    public function index()
    {
        $fileInfos = array();
        if (\Storage::exists('/backups')) {
            $files = \Storage::allFiles('/backups');
            if (count($files) > 0) {
                foreach ($files as $v) {
                    array_push($fileInfos, [
                        'name' => explode('/', $v)[1],
                        'size' => \Storage::size($v),
                        'date' => \Storage::lastModified($v)
                    ]);
                }
            }

        } else {
            \Storage::makeDirectory('/backups');
        }
        return view('backend.database.index', compact('fileInfos'));
    }


    /**
     * 下载文件
     * @param $file
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function down($file)
    {
        return response()->download(realpath(\Storage::path('/backups/' . $file)), $file);
    }

    /**
     * 数据库备份
     * @return \Illuminate\Http\JsonResponse
     */
    public function backup()
    {
        \Artisan::call('backup:mysql-dump');
        $result = \Artisan::output();
        if (str_contains($result, 'successfully')) {
            return $this->sendSuccess('数据库备份成功!');
        }
        return $this->sendError('数据库备份失败!');
    }

    /**
     * 还原数据库
     * @param $file
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($file)
    {
        \Artisan::call('backup:mysql-restore', ['--yes' => true, '--filename' => $file]);
        $result = \Artisan::output();
        if (str_contains($result, 'successfully')) {
            return $this->sendSuccess('数据库还原成功!');
        }
        return $this->sendSuccess('数据库还原失败!');
    }

    /**
     * 删除文件
     * @param $file
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteDatabase($file)
    {
        if (\Storage::delete('/backups/' . $file)) {
            return $this->sendSuccess('文件删除成功!');
        }
        return $this->sendSuccess('文件删除失败!');
    }
}
