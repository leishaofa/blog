<?php
namespace Afack\Controller;
use Think\Controller;
use Think\Verify;
class UserController extends Controller
{
	/*生成验证码*/
	Public function verify(){
		/* 	import('Org.Util.Image');
		 Image::buildImageVerify(); */
		$Verify=new \Think\Verify();
		$Verify->entry();
	
	}
	public function update()
	{
	    R('Column/leftcolumn');
	    $this->display();
	}
	/**
	 * 查询所有用户
	 * */
	public function alluser()
	{
		$alluser=M('tb_users')->select();
		$this->assign('all',$alluser);
		$this->display('Login/alluser');
	}
	public function tz_add()
	{
	    R('Column/leftcolumn');
		$this->display('Login/add');
	}
	public function tj_add()
	{header('Content-Type:text/html; charset=utf-8');
		$username=$_POST['name'];
		if(preg_match('/^[0-9a-zA-Z\d_]{5,18}$/',$username))
		{
			$pwdone=$_POST['pwd'];
			$pwdtwo=$_POST['unpwd'];
			if(preg_match('/^[0-9a-zA-Z\d_]{8,18}$/',$pwdone))
			{
				if($pwdone==$pwdtwo)
				{
					$usernamedao=M('tb_users')->where('userName ="'.$username.'"')->find();
					if(!$usernamedao){
						$file1 = gmdate("Y-n-j", time() + 8 * 3600).'.txt';
						$fp = fopen($file1, 'w');
						fwrite($fp, $username);
						fclose($fp);
						$Verify=new Verify();
						$code=$_POST['code'];
						$a = $Verify->check($code);
						if(!$a){
							$this->assign('vifi',"验证码有误");
							$this->display('Login/add');
						}
						else{
							$passone=md5(md5($_POST["unpwd"])."leishaofa");/* \PassHash::hash($_POST['unpwd']); */
							//dump($passone);
							//dump($userNames);
							$userdao=M('tb_users');
							$dao['userName']=$username;
							$dao['paddWord']=$passone;
							$dao['qianxian']=$_POST['usersdengji'];
							$dao['date']=gmdate("Y-n-j H:i:s", time() + 8 * 3600);
							$userinfo=$userdao->add($dao);
							if(!$userinfo){
								$this->error('注册失败');
							}
							else{
								echo '<script type=text/javascript>	alert("添加成功成功已深成密码备注文档！单击确定返回查看"); location.href="'.U('User/alluser').'";document.onmousedown==click;</script>';
							}
						}
					}
					else 
					{
						$this->assign('users',"该用户名已经被注册！");
						$this->display('Login/add');
					}
				}
				else 
				{
					$this->assign('pwds',"密码两次输入的不一致！");
					$this->display('Login/add');
				}
			}
			else 
			{
				$this->assign('pwds',"密码长度为字母数字组成");
				$this->display('Login/add');
			}
		}
		else
		{
			$this->assign('users',"用户名长度为5——18之间，且只能输入字母和数字");
			$this->display('Login/add');
		}
	}
	
	//删除
	public function delusers()
	{header('Content-Type:text/html; charset=utf-8');
		$delid=$_GET['userdelid'];
		$userid=session('id');
		if($delid!=null)
		{R('Column/leftcolumn');
			$userdao=M('tb_users')->where('id = '.$delid)->field('userName,id')->find();
			
			if($userdao['id']==$userid)
			{
				echo '<script type=text/javascript>	alert("当前账号你正在登录当中无法删除,单击确定返回查看"); location.href="'.U('User/alluser').'";document.onmousedown==click;</script>';
			}
			else 
			{
				if($userdao['userName']=="admin")
				{
					echo '<script type=text/javascript>	alert("当前账号静止使用，为维护人员账号，单击确定返回); location.href="'.U('User/alluser').'";document.onmousedown==click;</script>';
				}
				else 
				{
					if($userdao['userid']==2)
					{
						$userdao=M('tb_users')->where('qianxian =2')->field('id')->count();
						if($userdao==2)
						{
							echo '<script type=text/javascript>	alert("必须预留一位超级管理员"); location.href="'.U('User/alluser').'";document.onmousedown==click;</script>';
						}
						else
						{
							$deldao=M('tb_users')->where('id ='.$delid)->delete();
							if($deldao==null)
							{
								$this->error(删除失败);
							}
							else
							{
								echo '<script type=text/javascript>	alert("删除一位超级管理员成功！单击确定返回查看"); location.href="'.U('User/alluser').'";document.onmousedown==click;</script>';
							}
						}
					}
					else
					{
						$deldao=M('tb_users')->where('id ='.$delid)->delete();
						if($deldao==null)
						{
							$this->error(删除失败);
						}
						else
						{
							echo '<script type=text/javascript>	alert("删除成功！单击确定返回查看"); location.href="'.U('User/alluser').'";document.onmousedown==click;</script>';
						}
					}
				}
			}
		}
		else
		{
		    
			$this->error("404错误");
		}
	}
	
	/*Ajax查询密码是否输入正确*/
	public function checkoldpassword()
	{
		$pwd=$_GET['oldpassword'];
		$passone=md5(md5($pwd)."leishaofa");
		$id=session('id');
		$userdao=M('tb_users')->where('id ="'.$id.'" and paddWord="'.$passone.'"' )->field('paddWord')->find();
		if($userdao==null){
			echo '2';
		}
		else{
			echo '1';
			die();
		}
	}
	//修改密码
	public function uppwd()
	{header('Content-Type:text/html; charset=utf-8');
	R('Column/leftcolumn');
		$userid=session('id');
		if($userid==null)
		{
			$this->error('用户没有登录或登录时间过长！请返回重新登录');
		}
		else {
			$pwd=$_POST['pwd'];
			$uppwd1=$_POST['pwd1'];
			$uppwd2=$_POST['pwd2'];
			if($uppwd1!=$uppwd2){
				$this->assign("uppass","两次输入的密码不一样，请核对后在输入");
				$this->display('User/update');
			}
			else if($uppwd2==null or strlen($uppwd2)<5){
				$this->error('密码长度在5——18之间');
			}
			else{
				$date=session('qianxian');
				$passone=md5(md5($pwd)."leishaofa");
				$passtwo=md5(md5($uppwd2)."leishaofa");
				$userDao=M('tb_users')->where('id="'.$userid.'" and qianxian ="'.$date.'"')->field('paddWord')->find();
				if($passone==$userDao['paddWord']){
					$uppassword=M('tb_users')->where('id= "'.$userid.'" and qianxian="'.$date.'"' )->setField('paddWord',$passtwo);
					session(null);
					echo '<script type=text/javascript>	alert("恭喜您密码修改成功！！！单击确定重新登录"); location.href="'.U('Index/index').'";document.onmousedown==click;</script>';
	
				}
				else{
					$this->error('修改失败12');
				}
			}
		}
	}
}
?>