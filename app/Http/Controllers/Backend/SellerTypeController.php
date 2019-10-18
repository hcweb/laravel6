<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\SellerTypeRequest;
use App\Models\SellerType;
use Illuminate\Http\Request;

class SellerTypeController extends BaseController
{
    public function index()
    {
        $sellerTypeTree = $this->getSellerTypeTree();
        return view('backend.seller_type.index', compact('sellerTypeTree'));
    }

    public function create()
    {
        $sellerTypeTree = $this->getSellerTypeTree();
//        dd($sellerTypeTree);
        return view('backend.seller_type.create', compact('sellerTypeTree'));
    }

    public function store(SellerTypeRequest $request)
    {
//        dd($request->all());
        if (SellerType::create($request->all())) {
            return redirect()->route('sellertype.index')->with('successMsg', '商家类别添加成功!');
        }
        return back()->withInput()->withErrors('商家类别添加失败!');
    }

    public function edit($id)
    {
        $sellerType = $this->findById($id);
        $sellerTypeTree = $this->getSellerTypeTree();
        return view('backend.seller_type.edit', compact('sellerType','sellerTypeTree'));
    }

    public function update(SellerTypeRequest $request, $id)
    {
        $sellerType = $this->findById($id);

        if ($sellerType->update($request->all())) {
            return redirect()->route('sellertype.index')->with('successMsg', '商家类别更新成功!');
        }
        return back()->withInput()->withErrors('商家类别更新失败!');
    }

    public function destroy($id)
    {
        if (SellerType::destroy(explode(',', $id))) {
            return $this->sendSuccess("商家类别删除成功!");
        }
        return $this->sendError("商家类别删除失败!");
    }


    public function order(Request $request){
        $type=SellerType::findOrFail($request->get('id'));

        $type->order_num=$request->get('order');
        if ($type->save()) {
            return $this->sendSuccess("排序更新成功!");
        }
        return $this->sendError("排序更新失败!");
    }

    /**
     * 获取所有分类
     * @return mixed
     */
    protected function getSellerTypeTree(){
        return SellerType::orderBy('order_num','DESC')->withDepth()->get()->toFlatTree();
    }

    protected function findById($id)
    {
        return SellerType::findOrFail($id);
    }
}
