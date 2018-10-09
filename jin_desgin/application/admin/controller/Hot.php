<?php
namespace app\admin\controller;
use think\Controller;
class Hot extends Controller{
	public function index(){
		return view();
	}
	public function getTabHot($name='',$page=1,$rows=5){
		$total=db('hot')->count();
		$res=model('hot')->where('name','like','%'.$name.'%')->page($page,$rows)->select();
		return ['total'=>$total,'rows'=>$res];                                                                                                                                                                         
	}
	public function HotAdd($ostr){
		$o=json_decode($ostr);
		$res=model('hot')->data($o)->save();
		return $res;
	}
	public function HotDel($id){
		$res=db('hot')->where('id',$id)->delete();
		return $res;
	}
	public function HotEdit($ostr){
		$o=json_decode($ostr);
		$res=model('hot')->save($o,['id',$o->id]);
		return $res;
	}
}
?>