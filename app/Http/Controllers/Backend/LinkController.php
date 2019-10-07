<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\LinkCateRequest;
use App\Http\Requests\LinkRequest;
use App\Models\Link;
use App\Models\LinkItem;
use Illuminate\Http\Request;

class LinkController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $linkCates = Link::all();
        $links = LinkItem::with('link')->orderBy('order', 'desc')->get();
        return view('backend.link.index', compact('links', 'linkCates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $linkCates = Link::all();
        return view('backend.link.create', compact('linkCates'));
    }

    /**
     * @param LinkRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(LinkRequest $request)
    {
        if (LinkItem::create($request->except('file'))) {
            return redirect()->route('link.index')->with('successMsg', '友情链接创建成功!');
        }
        return back()->withInput()->withErrors('友情链接创建失败!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Link $link
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * @param LinkItem $link
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(LinkItem $link)
    {
        $linkCates = Link::all();
        return view('backend.link.edit', compact('link', 'linkCates'));
    }


    /**
     * @param LinkRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(LinkRequest $request, $id)
    {
        $linkItem=$this->findById($id);
        if ($linkItem->update($request->except('file'))) {
            return redirect()->route('link.index')->with('successMsg', '友情链接更新成功!');
        }
        return back()->withInput()->withErrors('友情链接更新失败!');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        if (LinkItem::destroy(explode(',',$id))) {
            return $this->sendSuccess("删除成功!");
        }
        return $this->sendError("删除失败!");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function order(Request $request)
    {
        $linkItem=$this->findById($request->get('id'));
        $linkItem->order=$request->get('order');
        if ($linkItem->save()) {
            return $this->sendSuccess("排序更新成功!");
        }
        return $this->sendError("排序更新失败!");
    }


    /**
     * @param LinkCateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createAndUpdateLinkCate(LinkCateRequest $request)
    {

        if ($request->get('id')) {
            $cate = Link::findOrFail($request->get('id'));
            $cate->name = $request->get('name');
            if ($cate->save()) {
                return $this->sendSuccess("分类编辑成功!");
            }
            return $this->sendError("分类编辑失败!");
        }

        if (Link::create($request->all())) {
            return $this->sendSuccess("分类添加成功!");
        }
        return $this->sendError("分类添加失败!");
    }


    /**
     * 删除分类
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteCate($id)
    {
        if (Link::destroy($id)) {
            return $this->sendSuccess("分类删除成功!");
        }
        return $this->sendError("分类删除失败!");
    }

    /**
     * 更具id获取模型
     * @param $id
     * @return mixed
     */
    protected function findById($id){
        return LinkItem::findOrFail($id);
    }
}
