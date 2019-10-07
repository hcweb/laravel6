<?php

namespace App\Http\Controllers\Frontend;

use App\Handlers\FileEncryption;
use App\Handlers\FileHelpHandler;
use App\Models\Browser;
use App\Models\Category;
use App\Models\Mould;
use App\Models\Page;
use App\Models\Record;
use COM;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class HomeController extends BaseController
{


    public function index(){


       // $file=public_path().'/site_20190613214848.mp4';


       //FileEncryption::encryptFile($file,'xietiannan',public_path().'/hbfile/'.\File::name($file).'.enc');

       // FileEncryption::decryptFile(public_path().'/hbfile/site_20190613214848.enc','xietiannan',public_path().'/hbfile/site_20190613214848.mp4');
        //\Auth::logout();
        $categories=$this->getMainMenu();
        return view('frontend.index',compact('categories'));
    }

    /**
     * 获取分类列表
     * @param $mould
     * @param $alias
     * @param $mid
     * @param $id
     * @param int $number
     * @param string $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getContentList($mould,$alias,$mid,$id,$number=20,$order='title_asc'){
        if ($number > 50){
            $number=50;
        }
        if (!Str::contains($order,'_')){
            abort('500');
        }
        $orderParame=explode('_',$order);
        $orderOrder=strtoupper($orderParame[1]);
        $orderField=$orderParame[0];
        if (!in_array($orderOrder,['DESC','ASC'])){
            $orderOrder='ASC';
        }
        if ($orderField == 'push' && $mould == 'Post'){
            $orderField='b_push_time';
        }
        if ($orderField == 'create'){
            $orderField='created_at';
        }

        $cate=Category::where(['id'=>$id,'alias'=>$alias,'mould_id'=>$mid,'is_show'=>1])->firstOrFail();
        $subCate=Category::where(['parent_id'=>$id,'is_show'=>1])->orWhere('id',$id)->get();

        $breadcrumb = $cate->ancestorsAndSelf($id);
        $model="App\\Models\\".$mould;
        if ($mould === 'Single'){
            $data=$model::where('category_id',$id)->firstOrFail();
            return view('frontend.'.substr($cate->template_show,0,-10),compact('data'));
        }

        $ids=collect(Category::descendantsAndSelf($id)->pluck('id'))->toArray();
        $count=0;
        if (count($ids) > 0){
            if ($orderField == 'b_push_time'){
                $data=$model::with('category')
                    ->where('mould_id',$mid)
                    ->whereIn('category_id',$ids)
                    ->join('record',strtolower($mould).'.isbn','=','record.b_isbn')
                    ->orderBy('record.'.$orderField, $orderOrder)
                    ->simplePaginate($number);
                $count=$model::with('category','record')
                    ->where('mould_id',$mid)
                    ->whereIn('category_id',$ids)
                    ->whereHas('record',function ($q) use ($orderField,$orderOrder){
                        $q->orderBy($orderField,$orderOrder);
                    })->count();
            }else if ($orderField == 'title'){
                $data=$model::with('category')
                    ->where('mould_id',$mid)
                    ->whereIn('category_id',$ids)
                    ->distinct($orderField)
                    ->orderByRaw("convert ($orderField using GBK) $orderOrder")
                    ->simplePaginate($number);
                $count=$model::with('category')
                    ->where('mould_id',$mid)
                    ->whereIn('category_id',$ids)
                    ->orderBy($orderField,$orderOrder)->count();
            }else{
                $data=$model::with('category')
                    ->where('mould_id',$mid)
                    ->whereIn('category_id',$ids)
                    ->orderBy($orderField,$orderOrder)
                    ->simplePaginate($number);
                $count=$model::with('category')
                    ->where('mould_id',$mid)
                    ->whereIn('category_id',$ids)
                    ->orderBy($orderField,$orderOrder)->count();
            }

        }else{
            if ($orderField == 'b_push_time'){
                $data=$model::with('category')
                    ->where(['mould_id'=>$mid,'category_id'=>$id])
                    ->join('record',strtolower($mould).'.isbn','=','record.b_isbn')
                    ->orderBy('record.'.$orderField, $orderOrder)
                    ->simplePaginate($number);
                $count=$model::with('category','record')
                    ->where(['mould_id'=>$mid,'category_id'=>$id])
                    ->whereHas('record',function ($q) use ($orderField,$orderOrder){
                        $q->orderBy($orderField,$orderOrder);
                    })->count();
            }else if ($orderField == 'title'){
                $data=$model::with('category')
                    ->where(['mould_id'=>$mid,'category_id'=>$id])
                    ->distinct($orderField)
                    ->orderByRaw("convert ($orderField using GBK) $orderOrder")
                    ->simplePaginate($number);
                $count=$model::with('category')
                    ->where(['mould_id'=>$mid,'category_id'=>$id])
                    ->orderBy($orderField,$orderOrder)->count();
            }else{
                $data=$model::with('category')
                    ->where(['mould_id'=>$mid,'category_id'=>$id])
                    ->orderBy($orderField,$orderOrder)
                    ->simplePaginate($number);
                $count=$model::with('category')
                    ->where(['mould_id'=>$mid,'category_id'=>$id])
                    ->orderBy($orderField,$orderOrder)->count();
            }
        }
        $menus=$this->getMainMenu();
        return view('frontend.'.substr($cate->template_list,0,-10),compact('subCate','data','breadcrumb','menus','count'));
    }


    /**
     * 获取详细信息
     * @param $mould
     * @param $alias
     * @param $cid
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getContentDetail($mould,$alias,$cid,$id){
        $model="App\\Models\\".$mould;
        $cate=Category::where(['id'=>$cid])->firstOrFail();
        $breadcrumb = $cate->ancestorsAndSelf($cid);
        if ($mould === 'Post'){
            $data=$model::with(['record','category'])->findOrFail($id);
        }else{
            $data=$model::with('category')->findOrFail($id);
        }
        //浏览量自动增加
        $data->increment('views',1);
        //保存浏览信息
        Browser::create([
            'mould'=>$mould,
            'member_id'=>auth('member')->id(),
            'p_id'=>$id,
        ]);
        return view('frontend.'.substr($cate->template_show,0,-10),compact('data','breadcrumb'));
    }

    /**
     * 获取单页内容
     * @param $alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function page($alias){
        $data=Page::where('alias',$alias)->firstOrFail();
        return view('frontend.page.'.$alias,compact('data'));
    }

    /**
     * 获取软件列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tool(){
        $files=getFileListInfo(public_path('tools'));
        return view('frontend.tool',compact('files'));
    }

    /**
     * 下载文件
     * @param $file
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function toolDown($file)
    {
        return response()->download(realpath(public_path('/tools/' . $file)), $file);
    }

    /**
     * 搜索列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function search(Request $request){
        if ($request->session()->has('app_search_parame') && count($request->session()->get('app_search_parame')) > 0){
            $mid=$request->session()->get('app_search_parame')['mid'];
            $cid=$request->session()->get('app_search_parame')['cid'];
            $field=$request->session()->get('app_search_parame')['field'];
            $query=$request->session()->get('app_search_parame')['query'];
            $number=$request->session()->get('app_search_parame')['number'];
            $order=$request->session()->get('app_search_parame')['order'];
        }else if (is_null($request->get('mid')) || is_null($request->get('cid')) || is_null($request->get('field'))){
            return redirect()->route('home.index')
                   ->withErrors('搜索参数不能为空！');
        }else{
            $mid=$request->get('mid');
            $cid=$request->get('cid');
            $field=$request->get('field');
            $query=$request->get('query');
            $number=$request->get('number');
            $order=$request->get('order');
        }

        //获取模型名称
        $mould=Mould::select('table_name')->findOrFail($mid);

        $model="App\\Models\\".Str::studly($mould->table_name);

        if ($number > 50){
            $number=50;
        }
        if (!Str::contains($order,'_')){
            abort('500');
        }
        $orderParame=explode('_',$order);
        $orderOrder=strtoupper($orderParame[1]);
        $orderField=$orderParame[0];
        if (!in_array($orderOrder,['DESC','ASC'])){
            $orderOrder='ASC';
        }
        if ($orderField == 'push' && Str::studly($mould->table_name) == 'Post'){
            $orderField='b_push_time';
        }
        if ($orderField == 'create'){
            $orderField='created_at';
        }

         $cate=Category::where(['id'=>$cid,'mould_id'=>$mid])->firstOrFail();
        //二级栏目

        $subCate=Category::where(['parent_id'=>$cid,'is_show'=>1])->orWhere('id',$cid)->get();
         //面包屑导航
         $breadcrumb = $cate->ancestorsAndSelf($cid);

        $ids=collect(Category::descendantsAndSelf($cid)->pluck('id'))->toArray();

        $count=0;
        if (count($ids) > 0){
            if (Str::studly($mould->table_name) === 'Post'){
                if ($orderField == 'title'){
                    $data=$model::with('category')
                        ->where('mould_id',$mid)
                        ->whereIn('category_id',$ids)
                        ->join('record',strtolower($mould->table_name).'.isbn','=','record.b_isbn')
                        ->distinct($orderField)
                        ->orderByRaw("convert ($orderField using GBK) $orderOrder")
                        ->where($field,'like',"%$query%")
                        ->simplePaginate($number);
                    $count=$model::with('category')
                        ->where('mould_id',$mid)
                        ->whereIn('category_id',$ids)
                        ->join('record',strtolower($mould->table_name).'.isbn','=','record.b_isbn')
                        ->orderByRaw("LENGTH($orderField) $orderOrder")
                        ->where($field,'like',"%$query%")
                        ->count();
                } else{
                    $data=$model::with('category')
                        ->where('mould_id',$mid)
                        ->whereIn('category_id',$ids)
                        ->join('record',strtolower($mould->table_name).'.isbn','=','record.b_isbn')
                        ->orderBy($orderField,$orderOrder)
                        ->where($field,'like',"%$query%")
                        ->simplePaginate($number);
                    $count=$model::with('category')
                        ->where('mould_id',$mid)
                        ->whereIn('category_id',$ids)
                        ->join('record',strtolower($mould->table_name).'.isbn','=','record.b_isbn')
                        ->orderBy($orderField,$orderOrder)
                        ->where($field,'like',"%$query%")
                        ->count();
                }
            }else{
                if ($orderField == 'title'){
                    $data=$model::with('category')
                        ->where('mould_id',$mid)
                        ->whereIn('category_id',$ids)
                        ->where($field,'like',$query.'%')
                        ->distinct($orderField)
                        ->orderByRaw("convert ($orderField using GBK) $orderOrder")
                        ->simplePaginate($number);
                    $count=$model::with('category')
                        ->where('mould_id',$mid)
                        ->whereIn('category_id',$ids)
                        ->where($field,'like',$query.'%')
                        ->orderByRaw("LENGTH($orderField) $orderOrder")
                        ->count();
                }else{
                    $data=$model::with('category')
                        ->where('mould_id',$mid)
                        ->whereIn('category_id',$ids)
                        ->where($field,'like',$query.'%')
                        ->orderBy($orderField,$orderOrder)
                        ->simplePaginate($number);
                    $count=$model::with('category')
                        ->where('mould_id',$mid)
                        ->whereIn('category_id',$ids)
                        ->where($field,'like',$query.'%')
                        ->orderBy($orderField,$orderOrder)
                        ->count();
                }
            }
        }else{
            if (Str::studly($mould->table_name) === 'Post'){
                if ($orderField == 'title'){
                    $data=$model::with('category')
                        ->where('mould_id',$mid)
                        ->join('record',strtolower($mould->table_name).'.isbn','=','record.b_isbn')
                        ->distinct($orderField)
                        ->orderByRaw("convert ($orderField using GBK) $orderOrder")
                        ->where($field,'like',"%$query%")
                        ->simplePaginate($number);
                    $count=$model::with('category')
                        ->where('mould_id',$mid)
                        ->join('record',strtolower($mould->table_name).'.isbn','=','record.b_isbn')
                        ->orderByRaw("LENGTH($orderField) $orderOrder")
                        ->where($field,'like',"%$query%")
                        ->count();
                } else{
                    $data=$model::with('category')
                        ->where('mould_id',$mid)
                        ->join('record',strtolower($mould->table_name).'.isbn','=','record.b_isbn')
                        ->orderBy($orderField,$orderOrder)
                        ->where($field,'like',"%$query%")
                        ->simplePaginate($number);
                    $count=$model::with('category')
                        ->where('mould_id',$mid)
                        ->join('record',strtolower($mould->table_name).'.isbn','=','record.b_isbn')
                        ->orderBy($orderField,$orderOrder)
                        ->where($field,'like',"%$query%")
                        ->count();
                }
            }else{
                if ($orderField == 'title'){
                    $data=$model::with('category')
                        ->where('mould_id',$mid)
                        ->where($field,'like',$query.'%')
                        ->distinct($orderField)
                        ->orderByRaw("convert ($orderField using GBK) $orderOrder")
                        ->simplePaginate($number);
                    $count=$model::with('category')
                        ->where('mould_id',$mid)
                        ->where($field,'like',$query.'%')
                        ->orderByRaw("LENGTH($orderField) $orderOrder")
                        ->count();
                }else{
                    $data=$model::with('category')
                        ->where('mould_id',$mid)
                        ->where($field,'like',$query.'%')
                        ->orderBy($orderField,$orderOrder)
                        ->simplePaginate($number);
                    $count=$model::with('category')
                        ->where('mould_id',$mid)
                        ->where($field,'like',$query.'%')
                        ->orderBy($orderField,$orderOrder)
                        ->count();
                }
            }
        }
        $menus=$this->getMainMenu();
        return view('frontend.'.substr($cate->template_list,0,-10),compact('subCate','data','breadcrumb','menus','count'));
    }


    /**
     * 下载和查看文件
     * @param $mould
     * @param $type
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function getFile($mould,$type,$id){
        $model="App\\Models\\".$mould;
        $result=$model::findOrFail($id);
        $path=$result->m_file;
        if (\File::exists(public_path($path))){
            if ($type === 'look'){
                $ext=getFileExtension($path);
                if ($ext == 'pdf'){
                    return view('frontend.common.pdf',compact('path'));
                }

                if ($ext == 'mp4' || $ext == 'flv' || $ext == 'f4v' || $ext == 'm3u8' || $ext == 'webm' || $ext == 'ogg'){
                    return view('frontend.common.video',compact('path'));
                }

               if ($ext == 'mp3'){
                    return view('frontend.common.mp3',compact('path'));
                }

              if ($ext == 'swf'){
                    return view('frontend.common.swf',compact('path'));
                }

                if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif' || $ext == 'bmp'){
                    return view('frontend.common.img',compact('path'));
                }
            }
            if ($type === 'download'){
                return response()->download(public_path($path));
            }
        }else{
            return back()->withErrors('文件不存在或已经删除！');
        }
    }


    public function test(){
        FileHelpHandler::encrypt_file(public_path('TEST_TEP/video.mp4'),public_path('TEST_TEP/video.bim'),'xtn123');
    }
}
