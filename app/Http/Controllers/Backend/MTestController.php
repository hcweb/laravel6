<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\TagRequest;
use App\Models\Tag;

class MTestController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view('backend.tag.index', compact('tags'));
    }


    /**
     * @param TagRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TagRequest $request)
    {
        if (Tag::create($request->all())) {
            return $this->sendSuccess('标签添加成功!');
        }
        return $this->sendError('标签添加失败!');
    }


    /**
     * @param TagRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TagRequest $request, $id)
    {
        $tag = $this->findById($id);
        if ($tag->update($request->all())) {
            return $this->sendSuccess('标签更新成功!');
        }
        return $this->sendError('标签更新失败!');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (Tag::destroy(explode(',', $id))) {
            return $this->sendSuccess("标签删除成功!");
        }
        return $this->sendError("标签删除失败!");
    }

    /**
     * @param $id
     * @return mixed
     */
    protected function findById($id)
    {
        return Tag::findOrFail($id);
    }
}