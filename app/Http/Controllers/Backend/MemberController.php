<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\MemberRequest;
use App\Http\Requests\UserRequest;
use App\Models\Member;
use App\Models\Role;
use App\User;
use App\Traits\ApiResponseTrait;

class MemberController extends BaseController
{
    use ApiResponseTrait;

    public function index()
    {
        $members = Member::all();
        return view('backend.member.index', compact('members'));
    }

    /**
     * 编辑会员信息
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $member = $this->findById($id);
        return view('backend.member.edit', compact('member'));
    }

    /**
     * 创建页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend.member.create');
    }

    /**
     * 保存会员信息
     * @param MemberRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(MemberRequest $request)
    {

        //创建用户
        $request['ip']=$request->ip();
        $member = Member::create($request->except('file'));
        if ($member) {
            return redirect()->route('member.index')->with('successMsg', '会员创建成功!');
        }
        return back()->withInput()->withErrors('会员创建失败!');
    }

    /**
     * 更新会员信息
     * @param MemberRequest $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(MemberRequest $request, $id)
    {
        $member = $this->findById($id);
        if ($request->get('password') == '0|0|0|0') {
            $data = $request->except('file');
        } else {
            $data = $request->except(['file', 'password']);
        }
        //更新用户
        if ($member->update($data)) {
            return redirect()->route('member.index')->with('successMsg', '会员更新成功!');
        } else {
            return back()->withInput()->withErrors('会员更新失败!');
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
        if (Member::destroy(explode(',', $id))) {
            return $this->sendSuccess("会员删除成功!");
        }
        return $this->sendError("会员删除失败!");
    }


    protected function findById($id)
    {
        return Member::findOrFail($id);
    }
}
