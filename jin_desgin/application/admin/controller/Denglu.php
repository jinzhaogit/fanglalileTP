<?php
namespace app\admin\controller;
use think\Controller;
class Denglu extends Controller{
	public function index(){
		return view();
	}
	public function sign($ostr){
		$o=json_decode($ostr);
		$o->pwd=md5($o->pwd);
		$res=db('admin')->where('name',$o->name)->where('pwd',$o->pwd)->select();
		if($res){
			return 1;
		}else{
			return 0;
		}
	}
	public function signup($ostr){
		$o=json_decode($ostr);
		$v=$o->pwd;
		$o->pwd=md5($v);
		$res=model('admin')->allowField(true)->data($o)->save();
		return $res;
	}
}
?>