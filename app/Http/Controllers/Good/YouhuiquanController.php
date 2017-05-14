<?php

namespace App\Http\Controllers\Good;

use App\Http\Controllers\Controller;
use App\Http\Requests\Good\YouhuiquanRequest;
use App\Models\Youhuiquan;
use Illuminate\Http\Request;

class YouhuiquanController extends Controller
{
    /**
     * 优惠券管理
     * @return [type] [description]
     */
    public function getIndex(Request $res)
    {
    	$title = '优惠券管理';
        // 搜索关键字
        $key = trim($res->input('q',''));
        $starttime = $res->input('starttime');
        $endtime = $res->input('endtime');
        $status = $res->input('status');
		$list = Youhuiquan::where(function($q) use($key){
                if ($key != '') {
                    $q->where('title','like','%'.$key.'%');
                }
            })->where(function($q) use($starttime,$endtime){
                if ($starttime != '' && $endtime != '') {
                    $q->where('starttime','>=',$starttime)->where('starttime','<=',$endtime);
                }
            })->where(function($q) use($status){
                if ($status != '') {
                    $q->where('status',$status);
                }
            })->where('del',1)->orderBy('id','desc')->paginate(15);
    	return view('admin.youhuiquan.index',compact('title','list','key','starttime','endtime','status'));
    }
    // 添加优惠券
    public function getAdd()
    {
    	$title = '添加优惠券';
    	return view('admin.youhuiquan.add',compact('title'));
    }
    public function postAdd(YouhuiquanRequest $req)
    {
    	$data = $req->input('data');
    	Youhuiquan::create($data);
    	return redirect('xyshop/youhuiquan/index')->with('message','添加成功！');
    }
    // 修改优惠券
    public function getEdit($id = '')
    {
    	$title = '修改优惠券';
    	$ref = session('backurl');
    	$info = Youhuiquan::findOrFail($id);
    	return view('admin.youhuiquan.edit',compact('title','info','ref'));
    }
    public function postEdit(YouhuiquanRequest $req,$id = '')
    {
    	$data = $req->input('data');
    	Youhuiquan::where('id',$id)->update($data);
    	return redirect($req->ref)->with('message','修改成功！');
    }
    // 删除
    public function getDel($id = '')
    {
    	Youhuiquan::where('id',$id)->update(['del'=>0]);
    	return back()->with('message','删除成功！');
    }
}