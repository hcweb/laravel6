<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\User;
use App\Traits\ApiResponseTrait;

class UserController extends BaseController
{
    use ApiResponseTrait;

    public function index()
    {
        $users = User::all();
        foreach ($users as $v){
            $v->getRoleNames();
        }
        $users->toArray();
        return view('backend.user.index', compact('users'));
    }

    /**
     * 编辑用户信息
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = $this->findById($id);
        $roles = $this->getAllRole();
        return view('backend.user.edit', compact('user', 'roles'));
    }

    /**
     * 创建页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = $this->getAllRole();
        return view('backend.user.create', compact('roles'));
    }

    /**
     * 保存用户信息
     * @param UserRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {

        //创建用户
        $user = User::create($request->except('role'));
        //给用户赋予角色
        if ($user && $user->assignRole($request->get('role'))) {
            return redirect()->route('user.index')->with('successMsg', '用户创建成功!');
        }
        return back()->withInput()->withErrors('用户创建失败!');
    }

    /**
     * 更新用户信息
     * @param UserRequest $userRequest
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $userRequest, $id)
    {
        $user = $this->findById($id);
        if ($userRequest->get('password') != '0|0|0|0') {
            $data = $userRequest->except('role');
        } else {
            $data = $userRequest->except(['role', 'password']);
        }
        //更新用户
        if ($user->update($data)) {
            //先撤销当前的权限
            foreach ($user->getRoleNames() as $v) {
                $user->removeRole($v);
            }
            //给用户赋予角色
            $user->assignRole($userRequest->get('role'));
            return redirect()->route('user.index')->with('successMsg', '用户更新成功!');
        } else {
            return back()->withInput()->withErrors('用户更新失败!');
        }
    }


    public function show(User $user)
    {
        return view('backend.user.show', compact('user'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (User::destroy(explode(',', $id))) {
            return $this->sendSuccess("用户删除成功!");
        }
        return $this->sendError("用户删除失败!");
    }

    /**
     * 退出
     * @return \Illuminate\Http\RedirectResponse
     */
    public function layout()
    {
        auth()->logout();
        return redirect()->route('backend.login');
    }


    /**
     * 用户登录
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function login()
    {
        if (auth()->check()) {
            return redirect()->route('backend.home');
        }
        return view('backend.user.login');
    }

    public function loginForm(AdminLoginRequest $request)
    {
        //是否是记住密码
        if ($request->input('rember_me')) {
            $is_rember = true;
        } else {
            $is_rember = false;
        }
        $field = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $request->merge([$field => $request->input('username')]);
        if (auth()->attempt($request->only($field, 'password'), $is_rember)) {
            if (auth()->user()->is_enabled != 1) {
                return back()->withErrors('尊敬的' . auth()->user()->name . '您的账户目前处理禁用状态,请联系管理员开启！');
            }
            return redirect()->route('backend.app');
        } else {
            return back()->withErrors("用户名或密码错误！");
        }
    }

    protected function findById($id)
    {
        return User::findOrFail($id);
    }

    protected function getAllRole()
    {
        return Role::all();
    }
}
