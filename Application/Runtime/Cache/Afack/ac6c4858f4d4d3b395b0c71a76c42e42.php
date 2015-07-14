<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=yes">
<link type="text/css" rel="stylesheet" href="/blog/Public/admin/css/base.css" />
<link rel="icon" href="/blog/Public/app/images/list_logo.png" type="img/x-icon"/>
<title></title>
<meta name="keywords" content="sunemotor" />
<meta name="description" content="sunemotor" />
<script src="/blog/Public/admin/js/jquery.js" type="text/javascript"></script>
</head>

<body>
<!--头部-->
<header>
	<div class="nav">
    	 <ul>
         <li></li>
         <li></li>
         <li></li>
         </ul>
    </div>
</header>
<!--左侧导航-->
<nav>
	<div class="navTop">
    	 <dl><img src="/blog/Public/Admin/images/avatar2.jpg" width="120" height="120"></dl>
         <ul>
         	<li class="navTop_01"><a href="<?php echo u('Index/index');?>" title="返回首页">返回首页</a></li>
           <!--  <li class="navTop_02"><a href="index.html" title="网站设置">网站设置</a></li> -->
            <li class="navTop_03"><a href="<?php echo u('Index/regin');?>" title="退出后台">退出后台</a></li>
         </ul>
    </div>
    <div class="navList">
    	 <ul>
         <li><a href="<?php echo u('Column/lists');?>" <?php if($currrt == 3): ?>class="this"<?php endif; ?>>栏目列表</a></li>
            <?php if(is_array($newsleft)): $i = 0; $__LIST__ = $newsleft;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$leftnew): $mod = ($i % 2 );++$i;?><li><a href="<?php echo u('New/news',array('id'=>$leftnew['colid']));?>" <?php if($currrt == $leftnew['colid']): ?>class="this"<?php endif; ?>><?php echo ($leftnew['coltt']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            <?php if(is_array($imgleft)): $i = 0; $__LIST__ = $imgleft;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$leftimg): $mod = ($i % 2 );++$i;?><li><a href="<?php echo u('Img/imglist',array('id'=>$leftimg['colid']));?>" <?php if($currrt == $leftimg['colid']): ?>class="this"<?php endif; ?>><?php echo ($leftimg['coltt']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            <?php if(is_array($vidioleft)): $i = 0; $__LIST__ = $vidioleft;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$leftvidio): $mod = ($i % 2 );++$i;?><li><a href="<?php echo u('Shipin/jiaodian',array('id'=>$leftvidio['colid']));?>" <?php if($currrt == $leftvidio['colid']): ?>class="this"<?php endif; ?>><?php echo ($leftvidio['coltt']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
         <!-- <li><a href="">用户管理</a></li> -->
         <li><a href="<?php echo u('Xitong/shezhi');?>">系统设置</a></li>
         </ul>
    </div>
</nav>
<!--快捷导航-->
<aside>
	 <ul>
        <li><a href="<?php echo U('Column/col_add');?>" class="backgroundColorLv">添加栏目</a></li>
        <!-- <li><a href="<?php echo U('User/usersup');?>" class="backgroundColorHui">修改密码</a></li> -->
     </ul>
</aside>
<div id="content">
<div id="title"><a href="#">首页</a><span>&gt;</span><a href="<?php echo U('Column/lists');?>">栏目</a><span>&gt;</span>头部栏目</div>
     <div class="height_20"></div>
     <div id="searchBox">
     	 <div class="widget-content nopadding">
<table class="table table-bordered table-striped">
             <thead>
              <tr>
				<th width="8%">排序</th>
			    <th width="40%">栏目名</th>
			    <th>添加子分类</th>
			    <th>列表</th>
				<th>删除</th>
				<th>编辑</th>
              </tr>
            </thead>
            <tbody>
<?php if(is_array($column)): $i = 0; $__LIST__ = $column;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					<td><input type="text" name="sort[2]" value="<?php echo ($vo['colpx']); ?>" onblur="pxcli(<?php echo ($vo['colid']); ?>,this.value)" style="width:40px; text-align:center; margin:0 0 0 8px;"/></td>
		 		  	<td style="text-indent:<?php echo ($vo['count']*30); ?>px;"><?php if($vo['count'] != 1): ?>├─<?php echo ($vo['coltt']); endif; if($vo['count'] == 1): echo ($vo['coltt']); endif; ?></td>
			 		  	<td style="text-align:center;">
			 		  		<?php if($vo['colqid'] == 2): ?><a href="<?php echo u('Column/colw_add',array('id'=>$vo['colid']));?>"  style="margin: 0 auto;" class="btn btn-mini btn-success">添加子分类</a><?php endif; ?>
						</td>
						<td style="text-align:center;">
			 		  		<?php if($vo['collink'] == 1): endif; ?>
			 		  		<?php if($vo['collink'] == 2): ?><a href="<?php echo u('New/news',array('id'=>$vo['colid']));?>"  style="margin: 0 auto;" class="btn btn-mini btn-success">查看列表</a><?php endif; ?>
			 		  		<?php if($vo['collink'] == 3): ?><a href="<?php echo u('Column/colw_add',array('id'=>$vo['colid']));?>"  style="margin: 0 auto;" class="btn btn-mini btn-success">查看列表</a><?php endif; ?>
			 		  		<?php if($vo['collink'] == 4): ?><a href="<?php echo u('Column/colw_add',array('id'=>$vo['colid']));?>"  style="margin: 0 auto;" class="btn btn-mini btn-success">查看列表</a><?php endif; ?>
			 		  		<?php if($vo['collink'] == 5): ?><a href="<?php echo u('Column/colw_add',array('id'=>$vo['colid']));?>"  style="margin: 0 auto;" class="btn btn-mini btn-success">查看列表</a><?php endif; ?>
			 		  		<?php if($vo['collink'] == 6): ?><a href="<?php echo u('Column/colw_add',array('id'=>$vo['colid']));?>"  style="margin: 0 auto;" class="btn btn-mini btn-success">查看列表</a><?php endif; ?>
						</td>
			 		  	<td style="text-align:center;">
			 		  	<a href="javascript:void(0);" style="margin: 0 auto;" class="btn btn-mini btn-danger" onclick="del(<?php echo ($vo['colid']); ?>)">删除</a>	
						</td>
						<td style="text-align:center;">
			 		  	<a <?php if($vo['coldid'] == null): ?>href="<?php echo U('Column/update_select',array('upid'=>$vo['colid']));?>"<?php endif; ?> <?php if($vo['coldid'] != null): ?>href="<?php echo U('Column/update_select',array('upid'=>$vo['colid']));?>"<?php endif; ?> style="margin: 0 auto;" class="btn btn-mini btn-primary">编辑</a>
			 		  	</td>
	 		  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
	 		  <tr></tr>            </tbody>
          </table>
		  </form>
          </div>
          <script type="text/javascript">
          function pxcli(id,val)
          {
        	  $.ajax({
				   type: "POST",
				   url: "paixu",
				   data: "id="+val+"&tb="+id,
				   success: function(msg){
				     var msg=eval("("+msg+")");
				     if(msg==1){
					     alert("修改失败");
				     }
				     else{
				    	 alert("修改成功");
					 }
				   }
				});  
          }
          
	          function del(id){
		          var r=confirm("是否删除? 删除后可能前台某些无法显示，请慎重");
		          if (r==true){
		        	  sendRequest(id);
		            }
		          else{
		            alert("您已经取消删除");
		            }
	          }
			function sendRequest(id){
				$.ajax({
					   type: "POST",
					   dataType: "json",
					   url: "delete",
					   data: {di:id},
					   success: function(msg){
					     var msg=eval("("+msg+")");
						if(msg==1){
							alert("删除失败");
					     }
					     else if(msg==2){
					    	 alert("该菜单下面子菜单,无法删除");
						 }
					     else if(msg==3){
					    	 alert("删除成功！");
					    	 window.location.href="lists";
					     }
					   }
					}); 
			}
		  </script>
        </div>
       
   
</div>
<inclide file="Public:footer"/>