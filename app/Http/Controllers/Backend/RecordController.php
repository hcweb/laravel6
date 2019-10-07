<?php

namespace App\Http\Controllers\Backend;

use App\Models\Record;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecordController extends BaseController
{
    use ApiResponseTrait;
    public function index(Request $request){
        $fullPath='';
        $data=array();
        if ($request->isMethod('POST')){
          //  ini_set('memory_limit', '-1');

            $filePath=$request->get('filePath') ?? '';
            $type=$request->get('type');
            $fullPath=$filePath;

            if (\File::exists($filePath) && is_dir($filePath)){

                ini_set('memory_limit', '-1');
                $files=\File::allFiles($filePath);
                //获取到所有txt文件
                $txtFiels=array();
                foreach ($files as $v){
                    if (\File::extension(basename($v)) == 'txt'){
                        array_push($txtFiels,$v);
                    }
                }


                foreach ($txtFiels as $c=>$f){
                    $file=\File::get($f);
                    $str_encoding=mb_convert_encoding($file, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5,ASCII');
                    $result=explode("\r\n",trim($str_encoding));
                    $ff=array();
                    foreach ($result as $v){
                        array_push($ff,explode(':',$v));
                    }


                    foreach ($ff as $k=>$v){
                        preg_match_all('/[\x{4e00}-\x{9fff}]+/u', trim($v[0]), $matches);
                        $resultKey=join('',$matches[0]);
                        if ($resultKey == '书名'){
                            $data[$c]['b_name']=$v[1];
                        }
                        if ($resultKey == '作者'){
                            $data[$c]['b_auther']=trim($v[1]);
                        }
                        if ($resultKey == '出版社'){
                            $data[$c]['b_house']=trim($v[1]);
                        }
                        if ($resultKey == '出版日期'){
                            $data[$c]['b_push_time']=trim($v[1]);
                        }
                        if ($v[0] == 'ISBN'){
                            $data[$c]['b_isbn']=trim($v[1]);
                        }
                        if ($resultKey == '主题词'){
                            $data[$c]['b_theme_word']=trim($v[1]);
                        }
                        if ($resultKey == '页码'){
                            $data[$c]['b_page_number']=trim($v[1]);
                        }
                        if ($resultKey == '中图分类号'){
                            $data[$c]['b_cate_number']=trim($v[1]);
                        }
                        if ($resultKey == '丛书名'){
                            $data[$c]['b_series_name']=trim($v[1]);
                        }
                        if ($resultKey == '价格'){
                            $data[$c]['b_price']=trim($v[1]);
                        }
                        if ($resultKey == '摘要'){
                            $data[$c]['b_summary']=trim($v[1]);
                        }
                    }
                }


                //如果是查看
                if ($type === 'see'){
                    if (count($data) == 0){
                        return back()->withInput()->withErrors('暂无数据!');
                    }
                }


                //如果是导入
                if ($type === 'import'){
                    if (count($data)>0){
                        \DB::beginTransaction();
                        foreach ($data as $k=>$v){
                            if (isset($v['b_isbn'])){
                                $record=Record::where('b_isbn',$v['b_isbn'])->first();
                                if (is_null($record)){
                                    Record::create($v);
                                }
                                if ($k % 1000 === 0){
                                    \DB::commit();
                                    \DB::beginTransaction();
                                }
                                if ($k === count($data)){
                                    return back()->with('successMsg', '数据导入成功!');
                                }
                            }
                        }
                        \DB::commit();
                    }else{
                        return back()->withInput()->withErrors('没有可导入的数据!');
                    }
                }
            }else{
                return back()->withInput()->withErrors('文件夹不存在或者不是一个文件夹!');
            }
        }
        return view('backend.record.index',compact('data','fullPath'));
    }
}
