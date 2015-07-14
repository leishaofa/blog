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
<aside>
	 <ul>
	 	<li><a href="<?php echo u('Column/lists');?>" class="backgroundColorZi">返回栏目</a></li>
        <li><a href="<?php echo u('New/thisadd',array('id'=>$currrt));?>" class="backgroundColorLan">添加动态</a></li>
     </ul>
</aside>
<style type="text/css">
.mask{height:100%; width:100%; position:fixed; _position:absolute; top:0; z-index:1000; display: none; }
.opacity{ opacity:0.95; filter: alpha(opacity=95); background-color:#6dbbb9; } 
.tankuang{ margin: 0 auto;  background: none repeat scroll 0 0 #CDC9C9; width: 1000px; position: relative; top: 10%;}
.tankuang dl{ display: block; overflow: hidden;}
.tankuang dt{ float: left;  padding-bottom: 40px; margin-bottom:5px;} 
.tankuang dt span{ width:80px; text-align:right; height: 40px; display: block; line-height:40px; float: left; }
.tankuang dt input{ height: 40px; width: 240px; float: left;}
.tankuang dd{display: block; clear: both; padding-bottom: 10px;}
.tankuang dd textarea{ width: 800px; height: 60px;}
.tankuang p{overflow: hidden; display: block; padding-bottom: 10px;}
.tankuang p a{ display:block; margin: 0 auto;  width: 100px; height: 20px; background: #333333; text-align:center; color: #fff;}
.tankuang p input{display:block; margin: 0 auto;  width: 100px; height: 20px; background: #333333; text-align:center; color: #fff;}
</style>
<!--查看-->
<div id="tk" class="mask opacity">
  <div class="tankuang">
    <dl>
      <dt><span>新闻图像：</span><img id="imguser" src="" height="140px" width="140px"></dt>
        <dt><span>新闻标题：</span><input id="title" name="title" /> </dd>
        <dt><span>点赞人数：</span><input id="dianzan" name="dianzan" /></dt>
        <dt><span>访问人数：</span><input id="fangwen" name="fangwen" /></dd>
        <dt><span>发布公司名：</span><input id="gongshi" name="gongshi" /></dd>
        <dt><span>发布日期：</span><input id="date" name="date" /></dd>
    </dl>
    <p><a href="#" onclick="chaxun();">返回</a></p>
  </div>
</div>
<!--内容-->
<div id="content">
	 <div id="title"><a href="#">新闻</a><span>&gt;</span><a href="#">新闻快车</a></div>
     <div class="height_20"></div>
     <div id="searchBox">
     </div>
     <div class="newsList">
     	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
     	  
            <tr>
              <th width="60" class="none">#</th>
              <th align="left">新闻标题</th>
              <th align="left">展示方式</th>
              <th align="left">浏览次数</th>
              <th align="left">赞人数</th>
              <th width="100" class="none">发布时间</th>
              <th width="160" align="center">操作</th>
            </tr>
            <?php if(is_array($news)): $i = 0; $__LIST__ = $news;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
              <td align="center" class="none"><?php echo ($vo["newsid"]); ?></td>
              <td><a href="#"><?php echo ($vo["newstt"]); ?></a></td>
              <td><a href="#"><?php if($vo['tjid'] == 2): ?>首页推荐<?php endif; if($vo['tjid'] == 1): ?>无推荐<?php endif; ?></a></td>
              <td align="center" class="none"><?php echo ($vo["newsip"]); ?></td>
              <td align="center" class="none"><?php echo ($vo["newszan"]); ?></td>
              <td align="center" class="none"><?php echo ($vo["date"]); ?></td>
              
              <td>
                <a href="<?php echo u('New/listpinlun',array('did'=>$vo["newsid"]));?>" title="查看评论">查看评论</a>
                <a href="#" onclick="chakan(<?php echo ($vo["newsid"]); ?>);" title="查看详情">查看详情</a>
              	<a href="<?php echo u('New/newsupdate',array('id'=>$vo["newsid"]));?>" style="" title="编辑">编辑</a>
                <a href="<?php echo u('New/delnews',array('did'=>$vo["newsid"]));?>" title="删除">删除</a>
              </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
          </table>
     </div>
     <div id="page"><?php echo ($page); ?></div>
</div>
<!--尾巴-->
<footer>上海魔方企业形象设计有限公司</footer>
<script>
$(function(){
	$('header .nav').click(function(){
		$('nav').slideToggle(0);
		$('#content, aside').toggleClass('margin'); 
  	});
})
function chakan(id){
  $("#tk").css("display","block");
   $.ajax({
    type: "post",
        dataType: "json",
    url:"<?php echo U('New/chakannews');?>",
        data:"id=" + id,
    success:function(msg){
    	
      $("#imguser").attr("src",msg.newimg);
      $("#title").val(msg.newstt);
      $("#dianzan").val(msg.newszan);
      $("#fangwen").val(msg.newsip);
      $("#date").val(msg.date);
      $("#gongshi").val(msg.newsgs);
    }
  }); 
}
function chaxun(){$("#tk").css("display","none");}
</script>
</body>
</html>