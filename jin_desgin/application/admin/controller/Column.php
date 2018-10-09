<?php
namespace app\admin\controller;
use think\Controller;
class Column extends Controller{
	public $column;
	public function __construct(){
		$this->column=model('column');
	}
	public function index(){
		return view();
	}
	public function getTabCol($alt='',$page=1,$rows=5){
		$total=$this->column->count();
		$res=$this->column->where('alt','like','%'.$alt.'%')->page($page,$rows)->select();
		return ['total'=>$total,'rows'=>$res];                                                                                                                                                                         
	}
	public function addCol(){
		$id=db('column')->insertGetId($_POST);
		// 获取表单上传文件 例如上传了001.jpg
	    $file = request()->file('logo');
	    // 移动到框架应用根目录/public/uploads/ 目录下
	    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
	    if($info){
	    	$path='uploads'. DS .$info->getSaveName();
			db('column')->where('id',$id)->setField('logo',$path);
			return ['status' => '200','id'=>$id];
	    }else{
	        // 上传失败获取错误信息
	        echo $file->getError();
			return ['status' => '400','id'=>$id];
	    }                                                                                                                                                                        
	}
	public function delCol($id){
		$res=$this->column->destroy($id);
		return $res;
	}
	public function editCol(){
		$id=input('post.id');
		db('column')->where('id',$id)->update($_POST);
		// 获取表单上传文件 例如上传了001.jpg
	    $file = request()->file('logo');
	    // 移动到框架应用根目录/public/uploads/ 目录下
	    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
	    if($info){
	    	$path='uploads'. DS .$info->getSaveName();
			db('column')->where('id',$id)->setField('logo',$path);
			return ['status' => '200','id'=>$id];
	    }else{
	        // 上传失败获取错误信息
	        echo $file->getError();
			return ['status' => '400','id'=>$id];
	    }                           
	}
}

?>