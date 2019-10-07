<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\SystemRequest;
use App\Models\System;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class SystemController extends BaseController
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $systems = System::orderBy('id', 'asc')->get();
        $this->putSystemConfig();
        return view('backend.system.index', compact('systems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.system.create');
    }


    /**
     * @param SystemRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(SystemRequest $request)
    {
        if (System::create($request->except('file'))) {
            $this->putSystemConfig();
            return redirect()->route('system.index')->with('successMsg', '配置项添加成功!');
        }
        return back()->withInput()->withErrors('配置项添加失败!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\System $system
     * @return \Illuminate\Http\Response
     */
    public function show(System $system)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\System $system
     * @return \Illuminate\Http\Response
     */
    public function edit(System $system)
    {
        return view('backend.system.edit', compact('system'));
    }

    /**
     * @param SystemRequest $request
     * @param System $system
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SystemRequest $request, System $system)
    {
        if ($system->update($request->except('file', 'systemId'))) {
            $this->putSystemConfig();
            return redirect()->route('system.index')->with('successMsg', '配置项更新成功!');
        }
        return back()->withInput()->withErrors('配置项更新失败!');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        if (System::destroy(explode(',', $id))) {
            $this->putSystemConfig();
            return $this->sendSuccess("配置删除成功!");
        }
        return $this->sendError("配置删除失败!");
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function updateAll(Request $request)
    {

        $result = false;
        $base = System::where('tabType', 'base')->orderBy('id', 'asc')->get();
        $file = System::where('tabType', 'file')->orderBy('id', 'asc')->get();
        $email = System::where('tabType', 'email')->orderBy('id', 'asc')->get();
        $other = System::where('tabType', 'other')->orderBy('id', 'asc')->get();


        //更新基本配置
        foreach ($base as $k => $v) {
            $v->content = $request->get('base_content')[$k];
            $v->save() ? $result = true : $result = false;
        }
        //更新文件配置
        foreach ($file as $k => $v) {
            $v->content = $request->get('file_content')[$k];
            $v->save() ? $result = true : $result = false;
        }
        //更新邮箱配置
        foreach ($email as $k => $v) {
            $v->content = $request->get('email_content')[$k];
            $v->save() ? $result = true : $result = false;
        }
        //更新其他配置
        foreach ($other as $k => $v) {
            $v->content = $request->get('other_content')[$k];
            $v->save() ? $result = true : $result = false;
        }

        if ($result) {
            $this->putSystemConfig();
            return redirect()->route('system.index')->with('successMsg', '配置更新加成功!');
        }
        return back()->withInput()->withErrors('配置项更新失败!');
    }

    /**
     * 生成配置文件
     */
    private function putSystemConfig()
    {
        $systems = System::pluck('content', 'name')->all();
        $path = config_path() . '/system_config.php';
        $content = '<?php return ' . var_export($systems, true) . ';';
        file_put_contents($path, $content);
    }
}
