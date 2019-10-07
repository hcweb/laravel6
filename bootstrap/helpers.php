<?php
/**
 * Created by PhpStorm.
 * User: xtn
 * Date: 2018/7/6
 * Time: 11:45
 */
if (!function_exists('getBreadcrumbs')) {
    /**
     * 获取后台面包屑导航
     * @return array
     */
    function getBreadcrumbs()
    {
        $path = request()->path();
        //如果是后台
        if (Str::contains($path, 'admin/')) {
            $routeName = explode('.', Request::route()->getName());
            $lastRoute = null;
            switch (end($routeName)) {
                case 'edit':
                    $lastRoute = array(['title' => '编辑', 'route' => '']);
                    break;
                case 'create':
                    $lastRoute = array(['title' => '创建', 'route' => '']);
                    break;
                case 'show':
                    $lastRoute = array(['title' => '详情', 'route' => '']);
                    break;
                case 'search':
                    $lastRoute = array(['title' => '搜索结果', 'route' => '']);
                    break;
            }

            $menu = \App\models\Menu::where('route', $routeName[0] . '.index')->firstOrFail();
            $breadcrumbs = \App\models\Menu::whereAncestorOrSelf($menu->id)->get(['title', 'route']);
            $result = collect($breadcrumbs)->toArray();
            if (is_null($lastRoute)) {
                return $result;
            }
            return array_merge($result, $lastRoute);
        }

    }
}
if (!function_exists('block')) {

    /**
     * 获取资料信息
     * @param $id
     * @return mixed
     */
    function block($id)
    {
        $result = \App\Models\Block::where('id', $id)->value('body');
        if (!empty($result)) {
            return $result;
        }
        return null;
    }
}

if (!function_exists('format_bytes')) {
    /**
     * 格式化字节大小
     * @param $size
     * @param string $delimiter
     * @return string
     */
    function format_bytes($size, $delimiter = '')
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
        for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
        return round($size) . $delimiter . $units[$i];
    }
}

if (!function_exists('getPermissionByRoute')) {

    function getPermissionByRoute($route)
    {
        if (is_array($route)) {

        }
    }
}

if (!function_exists('getListTableNames')) {
    /**
     * 获取所有表名称
     * @return string[]
     */
    function
    getListTableNames()
    {
        return DB::getDoctrineSchemaManager()->listTableNames();
    }
}
if (!function_exists('getListTableColumns')) {
    /**
     * 获取指定表所有字段
     * @param $tableName
     * @return \Doctrine\DBAL\Schema\Column[]
     */
    function getListTableColumns($tableName)
    {
        return DB::getDoctrineSchemaManager()->listTableColumns($tableName);
    }
}
if (!function_exists('getModelIdByCateId')) {
    /**
     * 获取模型id
     * @param $cid
     * @return mixed
     */
    function getModelIdByCateId($cid)
    {
        return \App\models\Category::where('id', $cid)->value('model_id');
    }
}
if (!function_exists('getFieldsByModelId')) {
    /**
     * 根据模型id获取模型字段
     * @param $mid
     * @return mixed
     */
    function getFieldsByModelId($mid)
    {
        return \App\Models\Field::where('mould_id',$mid)->get();
    }
}

if (!function_exists('setMouldName')) {
    /**
     * EOF使用函数
     * @param $name
     * @return string
     */
    function setMouldName($name){
        return \Illuminate\Support\Str::studly($name);
    }
}

if (!function_exists('getFileExtension')) {
    /**
     * 获取文件扩展名
     * @param $filename
     * @return mixed
     */
    function getFileExtension($filename){
        $myext = substr($filename, strrpos($filename, '.'));
        return str_replace('.','',$myext);
    }
}

if (!function_exists('mReadDirectory')) {
    /**
     * @param $path
     * @return mixed
     */
    function mReadDirectory($path) {
        $handle = opendir ( $path );
        while ( ($item = readdir ( $handle )) !== false ) {
            //.和..这2个特殊目录
            if ($item != "." && $item != "..") {
                if (is_file ( $path . "/" . $item )) {
                    $arr ['file'] [] = $item;
                }
                if (is_dir ( $path . "/" . $item )) {
                    $arr ['dir'] [] = $item;
                }

            }
        }
        closedir ( $handle );
        return $arr;
    }
}

if (!function_exists('getFileListInfo')) {
    /**
     * 获取文件列表信息
     * @param $path
     * @return array
     */
    function getFileListInfo($path) {
        $fileInfos = array();
        if (File::exists($path)) {
            $files = File::allFiles($path);
            if (count($files) > 0) {
                foreach ($files as $v) {
                    array_push($fileInfos, [
                        'name' => basename($v),
                        'size' => File::size($v),
                        'extension' => File::extension(basename($v))
                    ]);
                }
            }
        } else {
            File::makeDirectory($path);
        }
        return $fileInfos;
    }

}

if (!function_exists('getAllSubMenuById')) {
    /**
     * 根据分类id获取所有子栏目
     * @param $id
     * @return mixed
     */
    function getAllSubMenuById($id){
        return \App\Models\Category::with('mould')->where(['parent_id'=>$id,'is_show'=>1])->orderBy('order','DESC')->get();
    }
}

if (!function_exists('getPermissionName')) {
    /**
     * 
     * @param null $route
     * @return string|null
     */
    function getPermissionName($route=null){
        if ($route != null && \Illuminate\Support\Str::contains($route,'.')){
            $routeName=explode('.',request()->route()->getName());
            return $routeName[0].'_'.$routeName[1];
        }
        return null;
    }
}


