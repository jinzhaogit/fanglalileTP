<?php
namespace app\admin\controller;
use think\Controller;
class Article extends Controller{
	public function index(){
		return view();
	}
	public function getAtrtab($title='',$city='',$page=1,$rows=5){
		$total=db('article')->count();
		$res=db('article')->where('title','like','%'.$title.'%')->where('city','like','%'.$city.'%')->order('id desc')->page($page,$rows)->select();
		return ['total'=>$total,'rows'=>$res];
	}
	public function artAdd(){
		$id=db('article')->insertGetId($_POST);
		 // 获取表单上传文件 例如上传了001.jpg
	    $file = request()->file('img');
	    // 移动到框架应用根目录/public/uploads/ 目录下
	    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
	    if($info){
			$path='uploads'. DS .$info->getSaveName();
			db('article')->where('id',$id)->setField('img',$path);
			return ['status'=>'200','id'=>$id];
	    }else{
	        // 上传失败获取错误信息
	        echo $file->getError();
			return ['status'=>'400','id'=>$id];
	    }
	}
	public function artDel($id){
		$res=db('article')->where('id',$id)->delete();
		return $res;
	}
	public function artEdit($ostr){
		$o=json_decode($ostr);echo $o->id;
		$res=model('article')->save($o,['id',$o->id]);
		return $res;
	}
	public function editImg(){
		$id=input('post.id');
		$file = request()->file('img');
	    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
	    if($info){
			$path='uploads'. DS .$info->getSaveName();
			db('article')->where('id',$id)->setField('img',$path);
			return ['status'=>'200','id'=>$id];
	    }else{
	        echo $file->getError();
			return ['status'=>'400','id'=>$id];
	    }
	    
	}
	public function artProvince(){
		$res=db('province')->select();
		return $res;
	}
	public function artCity(){
		$res=db('city')->select();
		return $res;
	}
	public function artArea(){
		$res=db('area')->select();
		return $res;
	}
	
}

?>