<?php
/**
 * Created by PhpStorm.
 * User: xtn
 * Date: 2018-3-11
 * Time: 19:16
 */

namespace App\Handlers;


class FileUploadHandler
{
    //允许上传的图片图片类型
    protected $allow_ext = array();

    public function __construct()
    {
        $this->allow_ext=explode('|',config('system_config.site_img_type'));
    }

    /**
     * @param $type 保存类型
     * @param $file 文件名
     * @param $folder 文件夹名称
     * @param $file_prefix 文件后缀
     * @return bool|string
     */
    public function save($type,$file, $folder, $file_prefix)
    {
        if ($type == 'file'){
            $this->allow_ext=array_merge(explode('|',config('system_config.site_img_type')),explode('|',config('system_config.site_file_type')),explode('|',config('system_config.site_media_type')));
        }

        //存储文件规则
        $folderName = config('system_config.site_file_path').'/'.$folder.'/'.date('Ym').'/';
        //文件路径
        $filePath = public_path($folderName);

        //获取图片后缀
        $extension = strtolower($file->getClientOriginalExtension());

        //拼接文件名
        $filename = $file_prefix . date('YmdHis') . '.' . $extension;

        //判断是不是允许上传的文件类型
        if (!in_array($extension, $this->allow_ext)) {
            return false;
        }

        //把文件移动到指定文件夹
        $file->move($filePath, $filename);

        //返回文件路径
        return $folderName .'/'. $filename;
    }

}
