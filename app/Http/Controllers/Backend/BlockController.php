<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\BlockRequest;
use App\Models\Block;

class BlockController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $blocks = Block::all();
        return view('backend.block.index', compact('blocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.block.create');
    }

    /**
     * @param BlockRequest $request
     * @return $this|string
     */
    public function store(BlockRequest $request)
    {
        $type = $request->get('type');
        $request['body'] = $request['body'][$type];
        if (Block::create($request->except('file'))) {
            return redirect()->route('block.index')->with('successMsg', '自定义资料创建成功!');
        }
        return back()->withInput()->withErrors('自定义资料创建失败!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Block $block
     * @return \Illuminate\Http\Response
     */
    public function show(Block $block)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Block $block
     * @return \Illuminate\Http\Response
     */
    public function edit(Block $block)
    {
        $block->body = [$block->type => $block->body];
        return view('backend.block.edit', compact('block'));
    }


    /**
     * @param BlockRequest $request
     * @param Block $block
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BlockRequest $request, Block $block)
    {
        $type = $request->get('type');
        $request['body'] = $request['body'][$type];
        if ($block->update($request->except('file'))) {
            return redirect()->route('block.index')->with('successMsg', '自定义资料更新成功!');
        }
        return back()->withInput()->withErrors('自定义资料更新失败!');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        if (Block::destroy(explode(',', $id))) {
            return $this->sendSuccess("自定义资料删除成功!");
        }
        return $this->sendError("自定义资料删除失败!");
    }

    public function getCall(){
        return 132;
    }
}
