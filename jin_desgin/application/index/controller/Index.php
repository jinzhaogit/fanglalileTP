<?php
namespace app\index\controller;
use think\Controller;
class Index extends Controller{
	public function index(){
		return $this->fetch();
	}
	public function tree($id=0){
		$data=db('tree')->where('pid',$id)->select();
		return $data;
	}
}

?>