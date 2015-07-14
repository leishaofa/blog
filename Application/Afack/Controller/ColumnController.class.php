<?php
namespace Afack\Controller;
use Think\Controller;
class ColumnController extends Controller
{	
		static protected $treeList = array();
		static protected function tree(&$data,$pid=0,$count=1){
			foreach($data as $key=>$val){
				if($val['coldid']==$pid){
					$val['count']=$count;
					self::$treeList[]=$val;
					unset($data[$key]);
					self::tree($data,$val['colid'],$count+1);
				}
			}
			return self::$treeList;
		}
		public function leftcolumn()
		{
			$newsleftdao=M('tb_column')->where('collink =2')->field('colid,colqid ,coltt')->select();
			$this->assign('newsleft',$newsleftdao);
			$imgleftdao=M('tb_column')->where('collink =3')->field('colid ,colqid,coltt')->select();
			$this->assign('imgleft',$imgleftdao);
			$vidioleftdao=M('tb_column')->where('collink =4')->field('colid ,colqid,coltt')->select();
			$this->assign('vidioleft',$vidioleftdao);
			

		}
		public function lists()
		{
		    R('Column/leftcolumn');
		    $this->assign('current',3);
			header('Content-Type:text/html; charset=utf-8');
			$columndao=M('tb_column')->field('colid ,coldid,colpx,colqid,collink,coltt')->order('coldid asc')->select();
			$this->assign('counts',count($columndao));
			$this->assign('column',self::tree($columndao));
			$this->display('Column/lists');
		}
		//查询返回栏目标题到下拉框
		public function col_add()
		{  
			R('Column/leftcolumn');
			$this->assign('current',3);
			$this->display('Column/addcolumn');
		}
		 //查询返回栏目标题到下拉框
		public function colw_add()
		{  $this->assign('current',3);
		$this->assign('id',$_GET[id]);
		$this->display('Column/addwcolumn');
		}
		/*//查询返回栏目标题到下拉框
		public function colf_add()
		{  $this->assign('current',3);
		$this->display('Column/addfcolumn');
		} */
		//添加栏目
		public function add_columt()
		{R('Column/leftcolumn');
		 $this->assign('current',3);
			header("Content-type: text/html; charset=utf-8");
    		$title=$_POST['columntitle'];
    		$edid=$_POST['content'];
    		if($title==null){
    			$this->assign('title',"标题不能为空");
    			$this->col_add();
    		}
    		else{
    		    $addnodao=M('tb_column');
    			$adddao['coltt']=$title;
    			$adddao['colentt']=$_POST['columnentitle'];
    			$adddao['colcc']=$edid;
    			$adddao['colqid']=2;
    			$adddao['collink']=$_POST['leibie'];
    			$returncolumn=$addnodao->add($adddao);
    			if($returncolumn==null) {
    				$this->error('添加失败！');
    				$this->col_add();
    			}
    			else{
    				echo '<script type=text/javascript>	alert("添加成功！单击确定返回查看"); location.href="'.U('Column/lists').'";document.onmousedown==click;</script>';
    			}	
			}
		}
		 //添加栏目
		public function addw_columt()
		{
			R('Column/leftcolumn');
		 $this->assign('current',3);
		header("Content-type: text/html; charset=utf-8");
		$title=$_POST['columntitle'];
		$edid=$_POST['content'];
		if($title==null){
			$this->assign('title',"标题不能为空");
			$this->col_add();
		}
		else{
			$addnodao=M('tb_column');
			$adddao['coltt']=$title;
			$adddao['colcc']=$edid;
			$adddao['colqid']=1;
			$adddao['coldid']=$_GET['id'];
			$adddao['collink']=$_POST['leibie'];
			$returncolumn=$addnodao->add($adddao);
			if($returncolumn==null) {
				$this->error('添加失败！');
				$this->col_add();
			}
			else{
				echo '<script type=text/javascript>	alert("添加成功！单击确定返回查看"); location.href="'.U('Column/lists').'";document.onmousedown==click;</script>';
			}
		}
		}
		
	/*	//添加栏目
		public function addf_columt()
		{ $this->assign('current',3);
		header("Content-type: text/html; charset=utf-8");
		$title=$_POST['columntitle'];
		$edid=$_POST['content'];
		if($title==null){
			$this->assign('title',"标题不能为空");
			$this->col_add();
		}
		else{
			$addnodao=M('tb_column');
			$adddao['coltt']=$title;
			$adddao['colcc']=$edid;
			$adddao['colqid']=3;
			$returncolumn=$addnodao->add($adddao);
			if($returncolumn==null) {
				$this->error('添加失败！');
				$this->col_add();
			}
			else{
				echo '<script type=text/javascript>	alert("添加成功！单击确定返回查看"); location.href="'.U('Column/flists').'";document.onmousedown==click;</script>';
			}
		}
		} */
		
		
		public function zicol(){
			R('Column/leftcolumn');
		    $this->assign('current',3);
		    $id=$_GET['id'];
		    
		    if(!$id){
		        $this->error("添加跳转出错！");
		    }
		    else{
		        $this->assign('id',$id);
		        $this->display('Column/colziadd');
		    } 
		}
		
		public function addzicolumn()
		{
			R('Column/leftcolumn');
		 $this->assign('current',3);
		    $id=$_GET['id'];
		    $type_id=M('tb_column')->where(array('colid'=>$id))->field('colqid')->find();
		    header("Content-type: text/html; charset=utf-8");
		    $title=$_POST['columntitle'];
		    $edid=$_POST['content'];
		    if($title==null){
		        $this->assign('title',"标题不能为空");
		        $this->col_add();
		    }
		    else{
		        $addnodao=M('tb_column');
		        $adddao['coltt']=$title;
		        $adddao['colcc']=$edid;
		        $adddao['colqid']=1;
		        $adddao['coldid']=$id;
		        $adddao['collink']=$_POST['leibie'];
		        $returncolumn=$addnodao->add($adddao);
		        if($returncolumn==null) {
		        	$this->error('添加失败！');
		        	$this->col_add();
		        }
		        else{
		        	if($type_id['colqid']==1){
		        	echo '<script type=text/javascript>	alert("添加成功！单击确定返回查看"); location.href="'.U('Column/lists').'";document.onmousedown==click;</script>';
		        	}elseif($type_id['colqid']==2){
		        		
		        		echo '<script type=text/javascript>	alert("添加成功！单击确定返回查看"); location.href="'.U('Column/wlists').'";document.onmousedown==click;</script>';
		        	}
		        }
		    }
		    
		}
		
		//查询修改内容
		public function update_select()
		{
			R('Column/leftcolumn');
		 $this->assign('current',3);
			$upid=$_GET['upid'];
			$updatedao=M('tb_column')->where('colid ='.$upid)->field('colid,colqid,colcc,colentt,coltt,collink')->find();
			$this->assign('update',$updatedao);
			$this->display('Column/updatecolumn');
		}
		//提交修改
		public function update_up()
		{header("Content-type: text/html; charset=utf-8");
		R('Column/leftcolumn');
		$this->assign('current',3);
			$ids=$_GET['cid'];
			if (!empty($ids)){
				$titles=$_POST['columntitle'];
				if(!empty($titles)){
					$updatecontent=$_POST['bannnercontent'];
					$addnodao=M('tb_column');
					$adddao['coltt']=$titles;
					$adddao['collink']=$_POST['leibie'];
					$adddao['colentt']=$_POST['columnentitle'];
					//$adddao['colqid']=1;
					$adddao['colcc']=$updatecontent;
					$updatescolumn=$addnodao->where('colid ='.$ids)->save($adddao);
					if ($updatescolumn==null){$this->error('修改失败！');}
					else{
						echo '<script type=text/javascript>	alert("修改成功！单击确定返回查看"); location.href="'.U('Column/lists').'";document.onmousedown==click;</script>';
					}
	
				}
				else{$this->error("标题不能修改为空！！");}
			}
			else{$this->error("没有找到该页面！");}
		}
		//删除lanmu
        public function delete()
        	{  $this->assign('current',3);
        	R('Column/leftcolumn');
        		$id=$_POST['di'];
        		if($id==null){echo 1;}
        		else{
        			$ziladao=M('tb_column')->where('coldid ='.$id)->find();
        			if($ziladao==null){
        			    $deldao=M('tb_column')->where('colid ='.$id)->delete();
        			    if($deldao){
        			        echo 3;
        			    }
        			    else{echo 1;}
        			}
        			else {echo 2;}
        		}
        	}
public function paixu()
{ $this->assign('current',3);
R('Column/leftcolumn');
$a=$_POST['tb'];
if($a!=null){
$dao=M('tb_column')->where('colid ='.$a)->setField('colpx',$_POST['id']);
    if($dao==null){echo 1;}
    else {echo 2;}
    }
    else{echo 1;}
}
public function wlists()
{ $this->assign('current',3);
R('Column/leftcolumn');
    header('Content-Type:text/html; charset=utf-8');
    $columndao=M('tb_column')->where('colqid =2')->field('colid ,coldid,colpx,coltt')->order('coldid asc')->select();
    $this->assign('counts',count($columndao));
    $this->assign('column',self::tree($columndao));
    $this->display('Column/wlists');
}
public function flists()
{ $this->assign('current',3);
R('Column/leftcolumn');
    header('Content-Type:text/html; charset=utf-8');
    $columndao=M('tb_column')->where('colqid =3')->field('colid ,coldid,colpx,coltt')->order('coldid asc')->select();
    $this->assign('counts',count($columndao));
    $this->assign('column',self::tree($columndao));
    $this->display('Column/flists');
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
?>