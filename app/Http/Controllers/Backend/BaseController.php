<?php

namespace App\Http\Controllers\Backend;

use App\Models\Menu;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    use ApiResponseTrait;

    function __construct()
    {
        \View::share('adminMenu', $this->getAllMenus());
        \View::share('adminSelectMenu', $this->getSelectMenu());
    }

    /**
     * 获取所有后台菜单
     * @return mixed
     */
    private function getAllMenus()
    {
        $menu=Menu::orderBy('order', 'DESC')->where('is_show',1)->get()->toTree();
        return $menu;
    }

    private function getSelectMenu()
    {
        return Menu::orderBy('order', 'DESC')->withDepth()->get()->toFlatTree();
    }
}
