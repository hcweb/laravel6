<?php

namespace App\Http\Controllers\Backend;

use App\Models\Seller;
use App\Models\SellerType;
use Illuminate\Http\Request;
use App\Http\Requests\SellerRequest;

class SellerController extends BaseController
{
    //
    public function index(Request $request)
    {
        $key = empty($request->input('key'))? '' :$request->input('key');
//        echo $key;
        $sellerList= Seller::orderBy('id','desc')->paginate(2);
        if(!empty($key)){
            $sellerList= Seller::where('name','like',"%$key%")->orderBy('id','desc')->paginate(config('base_config.page_number'));
        }
//        dd($sellerList);
        return view('backend.seller.index', compact('key','sellerList'));
    }

    public function create()
    {
        $sellerTypeTree = $this->getSellerTypeTree();
        return view('backend.seller.create', compact('sellerTypeTree'));
    }

    public function store(SellerRequest $request)
    {
//        dd($request->all());
        if (Seller::create($request->all())) {
            return redirect()->route('seller.index')->with('successMsg', '商家添加成功!');
        }
        return back()->withInput()->withErrors('商家添加失败!');
    }

    public function edit($id)
    {
        $seller= $this->findById($id);
        $sellerTypeTree = $this->getSellerTypeTree();
        return view('backend.seller.edit', compact('seller','sellerTypeTree'));
    }

    public function update(SellerRequest $request, $id)
    {
        $seller = $this->findById($id);
        if ($seller->update($request->all())) {
            return redirect()->route('seller.index')->with('successMsg', '商家更新成功!');
        }
        return back()->withInput()->withErrors('商家更新失败!');
    }

    public function destroy($id)
    {
        if (Seller::destroy(explode(',', $id))) {
            return $this->sendSuccess("商家删除成功!");
        }
        return $this->sendError("商家删除失败!");
    }


    /**
     * 获取所有分类
     * @return mixed
     */
    protected function getSellerTypeTree(){
        return SellerType::where('is_show',1)->orderBy('order_num','DESC')->withDepth()->get()->toFlatTree();
    }
    protected function findById($id)
    {
        return Seller::findOrFail($id);
    }
}
