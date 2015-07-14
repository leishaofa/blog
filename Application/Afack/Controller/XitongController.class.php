<?php
namespace Afack\Controller;
use Think\Controller;
class XitongController extends Controller{
    public function shezhi()
    {
        R('Column/leftcolumn');
        $dao=M('tb_xitong')->where('xitongid =1')->find();
        $this->assign('web',$dao);
        $base=M('tb_member')->where('memberid =1')->find();
        $this->assign('member',$base);
        //dump($dao);
        $this->display('Syzs/addwuxue');
    }
    public function save()
    {
        $id=$_GET['id'];
        $dao['title']=$_POST['webname'];
        $dao['keytitle']=$_POST['webkey'];
        $base['membername']=$_POST['net'];
        $base['memberjob']=$_POST['job'];
        $base['memberpone']=$_POST['pone'];
        $base['memberemail']=$_POST['email'];
        $upload= new \Think\Upload();// 实例化上传类
    	$upload->maxSize  = 3145728 ;// 设置附件上传大小
    	$upload->exts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    	$filename=$upload->rootPath  = './Public';//设置文件上传gen
    	$filenames=$upload->savePath =  '/Uploads/';// 设置附件上传目录
    	$info = $upload->uploadOne($_FILES['ieco']);
    	$logo = $upload->uploadOne($_FILES['logo']);
    	if(!$info and !$logo){// 上传错误提示错误信息
    	    
    			$dao=M('tb_xitong')->where('xitongid ='.$id)->save($dao);
    			$dao=M('tb_member')->where('memberid ='.$id)->save($base);
    			$this->shezhi();
    			die;
    	}
    	else if(!$info){
    		$ieconame=$info['savepath'];
    		$ieconames=$info['savename'];
    		$dao['ico']="/Public".$ieconame.$ieconames;
    		$dao=M('tb_xitong')->where('xitongid ='.$id)->save($dao);
    		$dao=M('tb_member')->where('memberid ='.$id)->save($base);
    		$this->shezhi();
    		die;
    	}
    	else if(!$logo){
    	    $logoname=$logo['savepath'];
    	    $logonames=$logo['savename'];
    	    $dao['logo']="/Public".$ieconame.$ieconames;
    	    $dao=M('tb_xitong')->where('xitongid ='.$id)->save($dao);
    	    $dao=M('tb_member')->where('memberid ='.$id)->save($base);
    		$this->shezhi();
    		die;
    	}
    	else{
    	    $ieconame=$info['savepath'];
    	    $ieconames=$info['savename'];
    	    $dao['ico']="/Public".$ieconame.$ieconames;
    	    $logoname=$logo['savepath'];
    	    $logonames=$logo['savename'];
    	    $dao['logo']="/Public".$ieconame.$ieconames;
    	    $dao=M('tb_xitong')->where('xitongid ='.$id)->save($dao);
    	    $dao=M('tb_member')->where('memberid ='.$id)->save($base);
    	    $this->shezhi();
    	    die;
    	}
        
    }
}