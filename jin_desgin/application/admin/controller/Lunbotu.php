<?php
namespace app\admin\controller;
use think\Controller;
class Lunbotu extends Controller{
	public $lunbotu;
	public function __construct(){
		$this->lunbotu=model('lunbotu');
	}
	public function index(){
		return view();
	}
	public function getTabLun($name='',$page=1,$rows=5){
		$total=$this->lunbotu->count();
		$res=$this->lunbotu->where('name','like','%'.$name.'%')->page($page,$rows)->select();
		return ['total'=>$total,'rows'=>$res];                                                                                                                                                                         
	}
	public function addLun(){
		$id=db('lunbotu')->insertGetId($_POST);
		// 获取表单上传文件 例如上传了001.jpg
	    $file = request()->file('tu');
	    // 移动到框架应用根目录/public/uploads/ 目录下
	    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
	    if($info){
	    	$path='uploads'. DS .$info->getSaveName();
			db('lunbotu')->where('id',$id)->setField('tu',$path);
			return ['status' => '200','id'=>$id];
	    }else{
	        // 上传失败获取错误信息
	        echo $file->getError();
			return ['status' => '400','id'=>$id];
	    }                                                                                                                                                                        
	}
	public function delLun($id){
		$res=$this->lunbotu->destroy($id);
		return $res;
	}
	public function editLun(){
		$id=input('post.id');
		db('lunbotu')->where('id',$id)->update($_POST);
		// 获取表单上传文件 例如上传了001.jpg
	    $file = request()->file('tu');
	    // 移动到框架应用根目录/public/uploads/ 目录下
	    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
	    if($info){
	    	$path='uploads'. DS .$info->getSaveName();
			db('lunbotu')->where('id',$id)->setField('tu',$path);
			return ['status' => '200','id'=>$id];
	    }else{
	        // 上传失败获取错误信息
	        echo $file->getError();
			return ['status' => '400','id'=>$id];
	    }                           
	}
}

?>