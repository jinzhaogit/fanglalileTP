<?php
namespace app\admin\model;
use think\Model;
class User extends Model{
	public function getTabsModUser(){
		$data=$this->select();
		return $data;
	}
	public function deptAddModUser($o){
		$data=$this->data($o)->save();
		return $data;
	}
}


?>