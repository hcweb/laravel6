<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Traits\ApiResponseTrait;

class RoleController extends BaseController
{
    use ApiResponseTrait;
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('id','asc')->get();
        return view('backend.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $this->getPermissions();
        return view('backend.role.create', compact('permissions'));
    }

    /**
     * @param RoleRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(RoleRequest $request)
    {
        //保存角色
        $role = Role::create($request->except('permissions'));
        //保存权限
        if ($role && $role->givePermissionTo($request->get('permissions'))) {
            return redirect()->route('role.index')->with('successMsg', '角色创建成功!');
        }
        return back()->withInput()->withErrors('角色创建失败!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->findById($id);
        $permissions = $this->getPermissions();
        return view('backend.role.edit', compact('role', 'permissions'));
    }


    /**
     * @param RoleRequest $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(RoleRequest $request, $id)
    {
        $role = $this->findById($id);
        //保存角色信息
        $result = $role->update($request->except(['roleId', 'permissions']));
        //先删除权限
        foreach ($role->permissions as $v) {
            $role->revokePermissionTo($v);
        }
        if ($result && $role->syncPermissions($request->input('permissions'))) {
            return redirect()->route('role.index')->with('successMsg', '角色更新成功！');
        }
        return back()->withInput()->withErrors('角色更新失败!');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (Role::destroy(explode(',', $id))) {
            return $this->sendSuccess("角色删除成功!");
        }
        return $this->sendError("角色删除失败!");
    }

    /**
     * 获取所有权限
     * @return mixed
     */
    private function getPermissions()
    {
        return Permission::all(['id', 'display_name', 'name']);
    }

    protected function findById($id)
    {
        return Role::findOrFail($id);
    }
}
