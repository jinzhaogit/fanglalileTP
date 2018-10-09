<?php
namespace app\admin\controller;
use think\Controller;
class Index extends Controller{
	public function __construct(){
		parent::__construct();
		$this->dept=model('admin');
	}
	public function index(){
		return view();
	}
	public function getTabs($name='',$sex='',$page=1,$rows=5){
		$total=$this->dept->count();
		$res=$this->dept->where('name','like','%'.$name.'%')->where('sex','like','%'.$sex.'%')->order('id desc')->page($page,$rows)->select();
		return ['total'=>$total,'rows'=>$res];
	}
	public function deptAdd($ostr){
		$o=json_decode($ostr);
		$o->pwd=md5($o->pwd);
		$res=$this->dept->deptAddMod($o);
		return $res;
	}
	public function deptDel($id){
		$res=$this->dept->destroy($id);
		return $res;
	}
	public function deptEdit($ostr){
		$o=json_decode($ostr);
		$res=$this->dept->save($o,['id'=>$o->id]);
		return $res;
	}
}

?>