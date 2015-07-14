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
     	<li><a href="<?php echo u('Syjdt/jdt');?>" class="backgroundColorZi">首页banner</a></li>
        <li><a href="<?php echo u('User/alluser');?>" class="backgroundColorLv">管理员列表</a></li>
        <li><a href="<?php echo u('User/update');?>" class="backgroundColorHui">修改密码</a></li>
        <li><a href="<?php echo u('Index/del_cache');?>" class="backgroundColorLan">清楚缓存</a></li>
        <!-- <?php if($uderid == 2): ?><li><a href="<?php echo u('Index/del_cache');?>" class="backgroundColorLan">清楚缓存</a></li><?php endif; ?>
        <?php if($uderid == 3): ?><li><a href="<?php echo u('Index/del_cache');?>" class="backgroundColorLan">清楚缓存</a></li><?php endif; ?> -->
     </ul>
</aside>
<!--内容-->
<div id="content">
	 <div class="main">
     	  <dl>
     	  <?php if(is_array($server_info)): $k = 0; $__LIST__ = $server_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><dt><span><?php echo ($key); ?>：</span><input type="text" value="<?php echo ($vo); ?>" class="srk" style="border: 0px; cursor:default;"></dt><?php endforeach; endif; else: echo "" ;endif; ?>
          <!-- <dt><span>网站名称：</span><input name="" type="text" class="srk" placeholder="请添加您的网站名称"></dt>
          <dt><span>网站域名：</span><input name="" type="text" class="srk"></dt>
          <dt><span>页面标题：</span><input name="" type="text" class="srk"></dt>
          <dt><span>页面关键字：</span><input name="" type="text" class="srk"></dt>
          <dt><span>页面描述：</span><textarea name="" cols="" rows="" class="wby"></textarea></dt>
          <dt><span>统计代码：</span><textarea name="" cols="" rows="" class="wby"></textarea></dt>
          <dd><input name="" type="submit" class="an" value="保存发布"></dd> -->
          </dl>
     </div>
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
</script>
</body>
</html>