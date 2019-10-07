<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class MenuController extends BaseController
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.menu.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend.menu.create');
    }


    /**
     * @param MenuRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(MenuRequest $request)
    {
        if (Menu::create($request->all())) {
            return redirect()->route('menu.index')->with('successMsg', '菜单创建成功!');
        }
        return back()->withInput()->withErrors('菜单创建失败!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('backend.menu.edit', compact('menu'));
    }


    /**
     * @param MenuRequest $request
     * @param Menu $menu
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        if ($menu->update($request->except('menuId'))) {
            return redirect()->route('menu.index')->with('successMsg', '菜单更新成功!');
        }
        return back()->withInput()->withErrors('菜单更新失败!');
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (Menu::destroy(explode(',', $id))){
            return $this->sendSuccess("菜单删除成功!");
        }
        return $this->sendError("菜单删除失败!");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function order(Request $request){
        $menu=Menu::findOrFail($request->get('id'));
        $menu->order=$request->get('order');
        if ($menu->save()) {
            return $this->sendSuccess("排序更新成功!");
        }
        return $this->sendError("排序更新失败!");
    }
}
