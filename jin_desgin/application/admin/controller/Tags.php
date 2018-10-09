<?php
namespace app\admin\controller;
use think\Controller;
class Tags extends Controller{
	public function index(){
		return view();
	}
	public function getTagstab(){
		$res=db('tags')->order('id desc')->select();
		return $res;
	}
	public function tagsAdd($ostr){
		$o=json_decode($ostr);
		$o->tag=htmlspecialchars($o->tag);
		$res=model('tags')->data($o)->save();
		return $res;
	}
	public function tagsDel($id){
		$res=db('tags')->where('id',$id)->delete();
		return $res;
	}
	public function tagsEdit($ostr){
		$o=json_decode($ostr);
		$res=model('tags')->save($o,['id',$o->id]);
		return $res;
	}
}
?>