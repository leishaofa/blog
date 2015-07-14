<?php
namespace Afack\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        if(session('qianxian')!=null)
        {
            session('id');
            $this->home();
        }
        else
        {$this->display('Login/login');}
        }
        public function home()
        {
        
            $uderid=session('qianxian');
            if (function_exists('gd_info')) {
                $gd = gd_info();
                $gd = $gd['GD Version'];
            } else {
                $gd = "No support";
            }R('Column/leftcolumn');
            $info = array(
                '操作系统' => PHP_OS,
                '服务器IP' => $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ':' . $_SERVER['SERVER_PORT'] . ')',
                '环境' => $_SERVER["SERVER_SOFTWARE"],
                'PHP运行模式' => php_sapi_name(),
                '根目录' => $_SERVER['DOCUMENT_ROOT'],
                'MYSQL版本' => function_exists("mysql_close") ? mysql_get_client_info() : 'No support',
                'GD库版本' => $gd,
                //            'MYSQL版本' => mysql_get_server_info(),
                '上传附件大小' => ini_get('upload_max_filesize'),
                '运行时间' => ini_get('max_execution_time') . "s",
                '剩余磁盘空间' => round((@disk_free_space(".") / (1024 * 1024)), 2) . 'M',
                '服务器时间' => date("Y-n-j H:i:s"),
                '北京时间' => gmdate("Y-n-j H:i:s", time() + 8 * 3600),
            );
            R('Column/leftcolumn');
            $this->assign('server_info', $info);
            $this->assign('userid',$uderid);
            $this->display('Index/index');
        }
        public function login()
        {
            header('Content-Type:text/html; charset=utf-8');
            $username=$_POST['user'];
            if(preg_match('/^[0-9a-zA-Z\d_]{5,18}$/',$username)){
                $pwdone=$_POST['pwd'];
                if(preg_match('/^[0-9a-zA-Z\d_]{8,18}$/',$pwdone)){
                    $passone=md5(md5($pwdone)."leishaofa");
                    //\PassHash::check_password($pwdone);
                    //usernaem="123456" AND password="25d55ad283aa400af464c76d713c07ad"
                    $userinfo=M('tb_users')->where('userName="'.$username.'" and paddWord ="'.$passone.'"')->field('qianxian,id')->find();
                    if(!$userinfo){
                        $this->assign('reg',"登录失败");
                        $this->display('Login/login');
                    }
                    else{
                        session('qianxian',$userinfo['qianxian']);
                        session('id',$userinfo['id']);
                        echo '<script type=text/javascript>	alert("登陆成功欢迎你'.$username.'"); location.href="'.U('Index/index').'";document.onmousedown==click;</script>';
                    }
                }
                else{
                    $this->assign('pwds',"密码长度为字母数字组成");
                    $this->display('Login/login');
                }
            }
            else{
                $this->assign('users',"用户名长度为5——18之间，且只能输入字母和数字");
                $this->display('Login/login');
            }
        }
        public function regin()
        {
            cookie(null);
            session(null);
            $this->index();
        }
        public function del_cache() {
            header("Content-type: text/html; charset=utf-8");
            //清文件缓存
            $dirs = array('./Application/Runtime/');
            //赋予权限
            @mkdir('Runtime',0777,true);
            //清理缓存
            foreach($dirs as $value) {
                $this->rmdirr($value);
            }
            echo '<script type=text/javascript>	alert("清楚缓存成功"); location.href="'.U('Index/index').'";document.onmousedown==click;</script>';
        }
        //清楚缓存；
        public function rmdirr($dirname) {
            if (!file_exists($dirname)) {
                return false;
            }
            if (is_file($dirname) || is_link($dirname)) {
                return unlink($dirname);
            }
            $dir = dir($dirname);
            if($dir){
                while (false !== $entry = $dir->read()) {
                    if ($entry == '.' || $entry == '..') {
                        continue;
                    }
                    //递归
                    $this->rmdirr($dirname . DIRECTORY_SEPARATOR . $entry);
                }
            }
            $dir->close();
            return rmdir($dirname);
        }
         
        }