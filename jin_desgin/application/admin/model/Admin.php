<?php
namespace app\admin\model;
use think\Model;
class Admin extends Model{
	public function getTabsMod(){
		$data=$this->select();
		return $data;
	}
	public function deptAddMod($o){
		$data=$this->data($o)->save();
		return $data;
	}
}


?>