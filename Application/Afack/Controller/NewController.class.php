<?php

namespace Afack\Controller;
use Think\Controller;
class NewController extends Controller
{
	public function collect(){
        $collect=D('collect');
        $id=$_GET['id'];
        $vo=$collect->where("id = $id")->find();
        if ($vo['charset']=="UTF-8") {
             header("Content-type: text/html; charset=utf-8");
        }else{
             header("Content-type: text/html; charset=GB2312");
        }
        set_time_limit(0);
        import ( "@.ORG.QueryList" );
        $url=$vo['url'];
        $title=$vo['list_title'];
        $href=$vo['list_url'];
        $reg = array("title"=>array($title,"text"),"url"=>array($href,"href"));
        $rang=$vo['list_list'];
        $hj = new QueryList($url,$reg,$rang);
        $arr = $hj->jsonArr;
        foreach ($arr as $k => $v) {
            if(substr($val['url'],0,7) != 'http://'){
                $arr[$k]['url'] = $vo['site'].$v['url'];
            }
            unset($v); // 最后取消掉引用
        }
        array_splice($arr, 10); 
        $doc = phpQuery::newDocument("<div/>");
        $doc["div"]->append("<ul><li>新闻标题</li><li>新闻地址</li></ul>");
        foreach($arr as $key=>$product) {
            $doc["div ul"]->append("<li>$product[title]</li><li><a href='$product[url]'>$product[url]</a></li>");
        }
        $doc["div"]->attr('style',' text-align:center;width:100%;float:left;border:1px solid #96c2f1;background:#eff7ff;margin-bottom:20px;');
        $doc["div ul"]->find("li:even")->attr("style","width:48%; float:left; padding:5px; list-style:none;");
        $doc["div ul"]->find("li:odd")->attr("style","width:50%; text-align:center; float:left; padding:5px; list-style:none;");
        $this->assign('doc',$doc);
        $curl = $arr[0]['url'];
        $list_content=$vo['list_content'];
        $reg = array("title"=>array(".detail-hd h2","text"),"con"=>array($list_content,"html"));
        $hj = new QueryList($curl,$reg);
        $val = $hj->jsonArr;
        $this->assign('val',$val);
        dump($val);
    }
	
	
	
	
	
	
	public function news()
	{
		$userid=session('id');
		if($userid!=null){
    		$id=$_GET['id'];
    		if($id!=null){
    		    unset($_SESSION['imgcolid']);
    		    unset($_SESSION['imgcoltt']);
    		    if($_SESSION['imgcolid']==null){
    		        $colbase=M('tb_column')->where('colid ='.$id)->field('colid,coltt')->find();
    		        $_SESSION['newscolid'] = $colbase['colid'];
    		        $_SESSION['newscoltt'] = $colbase['coltt'];
    		        if($_SESSION['newscolid']!=null){
                		$newlist=M('tb_news')->where('qfid='.$_SESSION['newscolid']);
                		$count =$newlist->count();
                		$page=new \Think\Page($count,5);
                		$show=$page->show();
                		$info=$newlist->where('qfid='.$_SESSION['newscolid'])->order('newsid desc')->limit($page->firstRow.','.$page->listRows)->select();
                		$this->assign('page',$show);
                		$this->assign('news',$info);
                		R('Column/leftcolumn');
                		$this->assign('currrt',$id);
                		$this->display();
                	}
                	else{$this->error("请清除浏览器历史记录重新加载该页面！");}
            	}
            	else{$this->error("请清除浏览器历史记录重新加载该页面！");}
        	}
        	else{$this->error("请清除浏览器历史记录重新加载该页面！");}
		}
		else{R('Index/login');}
	}
	public function chakannews()
	{
		$id=$_POST['id'];
		if($id==null){
			echo 1;
		}
		else{
			$info=M('tb_news')->where('newsid ='.$id)->find();
			$info['newimg']=__ROOT__.$info['newimg'];
			$this->ajaxReturn($info);
		}
	}
	public function zhs()
	{
		$userid=session('id');
		if($userid!=null)
		{
	
			$newlist=M('tb_news')->where('qfid=1');
			$count =$newlist->count();
			$page=new \Think\Page($count,5);
			$show=$page->show();
			$info=$newlist->where('qfid=2')->order('newsid desc')->limit($page->firstRow.','.$page->listRows)->select();
			$this->assign('page',$show);
			$this->assign('news',$info);
			$this->display('New/zs');
		}
	
		else{$this->error("警告用户非法用户串改地址想进入后台");}
	}
	
	
	
	/*跳转添加新闻页面*/
	public function thisadd()
	{
	    $id=$_GET['id'];
	    if($id!=null){
	      $this->assign('currrt',$id);
	      R('Column/leftcolumn');
		  $this->display();
	    }
	    else{
	        $this->error("请重新加载");
	    }
	}
	/*检查日期类型是否正确*/
	public function checkDateIsValid($date, $formats = array("Y-m-d", "Y/m/d")) {
		$unixTime = strtotime($date);
		if (!$unixTime) { //strtotime转换不对，日期格式显然不对。
			return false;
		}
		//校验日期的有效性，只要满足其中一个格式就OK
		foreach ($formats as $format) {
			if (date($format, $unixTime) == $date) {
				return true;
			}
		}
	
		return false;
	}
	/* 计算字符串的长度(包括中英数字混合情况) */
	function count_string_len($str) {
		//return (strlen($str)+mb_strlen($str,'utf-8'))/2; //开启了php_mbstring.dll扩展
		$name_len = strlen ( $str );
		$temp_len = 0;
		for($i = 0; $i < $name_len;) {
			if (strpos ( 'abcdefghijklmnopqrstvuwxyz0123456789', $str [$i] ) === false) {
				$i = $i + 3;
				$temp_len += 2;
			} else {
				$i = $i + 1;
				$temp_len += 1;
			}
		}
		return $temp_len;
	}
	/*获取页面提交添加*/
	public function add()
	{header('Content-Type:text/html; charset=utf-8');
		$title=$_POST['newtt'];
		if($title==null){$this->error("用户名不能为空");}
		else
		{
		    $quid=$_GET['id'];
		    if($quid==null){$this->error("请重新加载该页面");}
		    else{
    			$date=$_POST['date'];
    			$pxid=$_POST['paixuid'];
    			$newtj=$_POST['newtj'];
    			$newsgs=$_POST['newgs'];
    			$content=$_POST['content'];
    			$this->assign('currrt',$quid);
    			
    			if(preg_match('/^(?!0000)[0-9]{4}-\d{1,2}-\d{1,2}$/',$date)){
    				if($content==null){$this->error("内容不能为空！");}
    				else{
    					$upload= new \Think\Upload();// 实例化上传类
    					$upload->maxSize  = 3145728 ;// 设置附件上传大小
    					$upload->exts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    					$filename=$upload->rootPath  = './Public';//设置文件上传gen
    					$filenames=$upload->savePath =  '/Uploads/';// 设置附件上传目录
    					$info = $upload->uploadOne($_FILES['imgfile']);
    					if(!$info){// 上传错误提示错误信息
    						$this->error($upload->getError());
    					}
    					else{
    					    R('Column/leftcolumn');
    						$filename=$info['savepath'];
    						$filenames=$info['savename'];
    						$image="/Public".$filename.$filenames;
    						$addnews=M('tb_news');
    						$data['newstt']=$title;
    						$data['date']=$date;
    						$data['newsgs']=$newsgs;
    						$data['newscc']=$content;
    						$data['qfid']=$quid;
    						$data['pxid']=$pxid;
    						$data['tjid']=$newtj;
    						$data['newimg']=$image;
    						$data['colduiid']=5;
    						$newinfo=$addnews->add($data);
    						 if($newinfo==null){
    						     echo '<script type=text/javascript>	alert("添加失败，返回新闻页"); location.href="'.U('New/news',array('id'=>$quid)).'";document.onmousedown==click;</script>';
    						}
    						else{
    						    echo '<script type=text/javascript>	alert("添加成功，返回新闻页"); location.href="'.U('New/news',array('id'=>$quid)).'";document.onmousedown==click;</script>';
    						} 
    					}
    				}
    			}
    			else{
    				$this->error("亲请输入合法的日期格式例如：YYYY-M-D或YYYY-MM-DD");
    			}
		    }
		}
	}
	public function newsupdate()
	{
		$ssjjid=$_GET['id'];
		$model=M('tb_news')->where('newsid ='.$ssjjid)->find();
		R('Column/leftcolumn');
		$this->assign('currrt',$model['qfid']);
		$this->assign('upnews',$model);
		$this->display();
	}
	public function update()
	{	header('Content-Type:text/html; charset=utf-8');
		$jjsid=$_GET['id'];
		if($jjsid==null){
			$this->error("没有获取到该条数据的id");
		}
		else{
			$title=$_POST['newtt'];
			if($title==null){$this->error("标题明不能为空");}
			else{
				$date=$_POST['date'];
				$pxid=$_POST['paixuid'];
				$newtj=$_POST['newtj'];
				$content=$_POST['content'];
				if(preg_match('/^(?!0000)[0-9]{4}-\d{1,2}-\d{1,2}$/',$date)){
					if($content==null){$this->error("修改内容不能为空！");}
					else{
						$upload= new \Think\Upload();// 实例化上传类
						$upload->maxSize  = 3145728 ;// 设置附件上传大小
						$upload->exts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
						$filename=$upload->rootPath  = './Public';//设置文件上传gen
						$filenames=$upload->savePath =  '/Uploads/';// 设置附件上传目录
						$info = $upload->uploadOne($_FILES['imgfile']);
						if(!$info){// 上传错误提示错误信息
							$addnews=M('tb_news');
							$data['newstt']=$title;
							$data['date']=$date;
							$data['newscc']=$content;
							$data['pxid']=$pxid;
							$data['tjid']=$newtj;
							$newinfo=$addnews->where('newsid ='.$jjsid)->save($data);
							if($newinfo==null){
								echo '<script type=text/javascript>	alert("添加失败，返回新闻页"); location.href="'.U('New/news',array('id'=>$_SESSION['newscolid'])).'";document.onmousedown==click;</script>';
							}
							else{
								echo '<script type=text/javascript>	alert("添加成功！单击确定返回查看"); location.href="'.U('New/news',array('id'=>$_SESSION['newscolid'])).'";document.onmousedown==click;</script>';
							}
						}
						else{
							$filename=$info['savepath'];
							$filenames=$info['savename'];
							$image="/Public".$filename.$filenames;
							$addnews=M('tb_news');
							$data['newstt']=$title;
							$data['date']=$date;
							$data['newscc']=$content;
							$data['pxid']=$pxid;
							$data['tjid']=$newtj;
							$data['newimg']=$image;
							$newinfo=$addnews->where('newsid ='.$jjsid)->save($data);
							
							if($newinfo==null){
								echo '<script type=text/javascript>	alert("修改失败，返回'.$_SESSION['newscoltt'].'"); location.href="'.U('New/news',array('id'=>$_SESSION['newscolid'])).'";document.onmousedown==click;</script>';
							}
							else{
								echo '<script type=text/javascript>	alert("修改成功！返回'.$_SESSION['newscoltt'].'"); location.href="'.U('New/news',array('id'=>$_SESSION['newscolid'])).'";document.onmousedown==click;</script>';
							}
						}
					}
				}
				if($date==null)
				{$this->error("亲输入合法的日期格式例如：YYYY-MM-DD");}
			}
		}
	}

	public function delnews()
	{
		header('Content-Type:text/html; charset=utf-8');
		if($_GET['did']==null)
		{
			$this->error("删除失败！！！");
		}
		else
		{
			$delid=M('tb_news')->where('newsid='.$_GET['did'])->delete();
			echo '<script type=text/javascript>	alert("删除成功！！！单击确定返回查看"); location.href="'.U('New/news',array('id'=>$_SESSION['newscolid'])).'";document.onmousedown==click;</script>';
		}
	}
	
	
	/* public function zsadd()
	{header('Content-Type:text/html; charset=utf-8');
	$title=$_POST['newtt'];
	if($title==null){$this->error("用户名不能为空");}
	else
	{
		$date=$_POST['date'];
		$pxid=$_POST['paixuid'];
		$newtj=$_POST['newtj'];
		$content=$_POST['content'];
		//$checkdate=$this->checkDateIsValid($date);
		//$checkdate=var_dump(checkdate($date));
		///
		dump($date);
		//if(preg_match('/^(?:(?!0000)[0-9]{4}([-/.]?)(?:(?:0?[1-9]|1[0-2])\1(?:0?[1-9]|1[0-9]|2[0-8])|(?:0?[13-9]|1[0-2])\1(?:29|30)|(?:0?[13578]|1[02])\1(?:31))|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)([-/.]?)0?2\2(?:29))$/', $date)){
		if(preg_match('/^(?!0000)[0-9]{4}-\d{1,2}-\d{1,2}$/',$date)){
			if($content==null){$this->error("内容不能为空！");}
			else{
				$upload= new \Think\Upload();// 实例化上传类
				$upload->maxSize  = 3145728 ;// 设置附件上传大小
				$upload->exts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
				$filename=$upload->rootPath  = './Public';//设置文件上传gen
				$filenames=$upload->savePath =  '/Uploads/';// 设置附件上传目录
				$info = $upload->uploadOne($_FILES['imgfile']);
				if(!$info){// 上传错误提示错误信息
					$this->error($upload->getError());
				}
				else{
					$filename=$info['savepath'];
					$filenames=$info['savename'];
					$image="/Public".$filename.$filenames;
					$addnews=M('lws_news');
					$data['newstt']=$title;
					$data['date']=$date;
					$data['newscc']=$content;
					$data['qfid']=2;
					$data['pxid']=$pxid;
					$data['tjid']=$newtj;
					$data['newimg']=$image;
					$data['colduiid']=13;
					$newinfo=$addnews->add($data);
					if($newinfo==null){
						echo '<script type=text/javascript>	alert("添加失败，返回确定返回招生信息页"); location.href="'.U('New/zhs').'";document.onmousedown==click;</script>';
					}
					else{
						echo '<script type=text/javascript>	alert("添加成功！单击确定返回招生信息查看"); location.href="'.U('New/zhs').'";document.onmousedown==click;</script>';
					}
				}
			}
		}
		else{
			dump($date);
			$this->error("亲请输入合法的日期格式例如：YYYY-M-D或YYYY-MM-DD");
		}
	} */
	public function zspdate()
	{
		$ssjjid=$_GET['id'];
		$model=M('lws_news')->where('newsid ='.$ssjjid)->find();
		$this->assign('upnews',$model);
		$this->display('New/zsupdate');
	}
	
	
	
	public function zsup()
	{	header('Content-Type:text/html; charset=utf-8');
	$jjsid=$_GET['id'];
	if($jjsid==null){
		$this->error("没有获取到该条数据的id");
	}
	else{
		$title=$_POST['newtt'];
		if($title==null){$this->error("标题明不能为空");}
		else{
			$date=$_POST['date'];
			$pxid=$_POST['paixuid'];
			$newtj=$_POST['newtj'];
			$content=$_POST['content'];
			if(preg_match('/^(?!0000)[0-9]{4}-\d{1,2}-\d{1,2}$/',$date)){
				if($content==null){$this->error("修改内容不能为空！");}
				else{
					$upload= new \Think\Upload();// 实例化上传类
					$upload->maxSize  = 3145728 ;// 设置附件上传大小
					$upload->exts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
					$filename=$upload->rootPath  = './Public';//设置文件上传gen
					$filenames=$upload->savePath =  '/Uploads/';// 设置附件上传目录
					$info = $upload->uploadOne($_FILES['imgfile']);
					if(!$info){// 上传错误提示错误信息
						$addnews=M('lws_news');
						$data['newstt']=$title;
						$data['date']=$date;
						$data['newscc']=$content;
						$data['pxid']=$pxid;
						$data['tjid']=$newtj;
						$newinfo=$addnews->where('newsid ='.$jjsid)->save($data);
						if($newinfo==null){
							echo '<script type=text/javascript>	alert("修改失败，单击确定返回重新修改"); location.href="'.U('New/zhs').'";document.onmousedown==click;</script>';
						}
						else{
							echo '<script type=text/javascript>	alert("修改成功！单击确定返回查看"); location.href="'.U('New/zhs').'";document.onmousedown==click;</script>';
						}
					}
					else{
						$filename=$info['savepath'];
						$filenames=$info['savename'];
						$image="/Public".$filename.$filenames;
						$addnews=M('lws_news');
						$data['newstt']=$title;
						$data['date']=$date;
						$data['newscc']=$content;
						$data['pxid']=$pxid;
						$data['tjid']=$newtj;
						$data['newimg']=$image;
						$newinfo=$addnews->where('newsid ='.$jjsid)->save($data);
						if($newinfo==null){
							echo '<script type=text/javascript>	alert("修改失败，单击确定返回重新修改"); location.href="'.U('New/zhs').'";document.onmousedown==click;</script>';
						}
						else{
							echo '<script type=text/javascript>	alert("修改成功！单击确定返回查看"); location.href="'.U('New/zhs').'";document.onmousedown==click;</script>';
						}
					}
				}
			}
			if($date==null)
			{$this->error("亲输入合法的日期格式例如：YYYY-MM-DD");}
		}
	}
	}
	
	
	public function delzs()
	{
		header('Content-Type:text/html; charset=utf-8');
		if($_GET['did']==null)
		{
			$this->error("删除失败！！！");
		}
		else
		{
			$delid=M('lws_news')->where('newsid='.$_GET['did'])->delete();
			echo '<script type=text/javascript>	alert("删除成功！！！单击确定返回查看"); location.href="'.U('New/zhs',array('id'=>$_SESSION['newscolid'])).'";document.onmousedown==click;</script>';
		}
	}

}
?>