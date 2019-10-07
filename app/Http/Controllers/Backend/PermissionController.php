<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use App\Traits\ApiResponseTrait;

class PermissionController extends BaseController
{
    //
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::with('menu')->get();
        return view('backend.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.permission.create');
    }


    /**
     * @param PermissionRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(PermissionRequest $request)
    {
        if (Permission::create($request->all())) {
            return redirect()->route('permission.index')->with('successMsg', '权限创建成功!');
        }
        return back()->withInput()->withInput()->withErrors('权限创建成功');
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $permission = $this->findById($id);
        return view('backend.permission.edit', compact('permission'));
    }


    /**
     * @param PermissionRequest $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(PermissionRequest $request, $id)
    {
        $permission=$this->findById($id);
        if ($permission->update($request->except('permissionId'))) {
            return redirect()->route('permission.index')->with('successMsg', '权限更新成功!');
        }
        return back()->withInput()->withErrors('权限更新失败!');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (Permission::destroy(explode(',',$id))) {
            return $this->sendSuccess("权限删除成功!");
        }
        return $this->sendError("权限删除失败!");
    }

    protected function findById($id){
        return Permission::findOrFail($id);
    }
}
