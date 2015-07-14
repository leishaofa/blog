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
     	<li><a href="<?php echo u('Column/lists');?>" class="backgroundColorZi">查看添加</a></li>
     </ul>
</aside>
<script charset="utf-8" type="text/javascript" src="/blog/Public/kindeditor/kindeditor.js"></script>
<script charset="utf-8" type="text/javascript" src="/blog/Public/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript">
KindEditor.options.filterMode = false;
        KindEditor.ready(function(K) {
                window.editor = K.create('#editors',{
                	themeType: 'simple',
                	resizeType: 1,
                	uploadJson: '/blog/Public/kindeditor/php/upload_json.php',
                	fileManagerJson: '/blog/Public/kindeditor/php/file_manager_json.php',
                	allowFileManager: true,
                	afterBlur: function(){this.sync();}
                });
        })
        
</script>

<!--内容-->
<div id="content">
	 <div class="main">
     	  <dl>
     	  <form action="<?php echo U('Column/update_up',array('cid'=>$update['colid']));?>" method="post" enctype="multipart/form-data"> 
          <dt><span>中文标题：</span><input name="columntitle" type="text" value="<?php echo ($update['coltt']); ?>" class="srk" placeholder="文章名称必须添加！"><b style="color: red;"><?php echo ($title); ?></b></dt>
          <dt><span>英文标题：</span><input name="columnentitle" type="text" value="<?php echo ($update['colentt']); ?>" class="srk" placeholder="文章名称必须添加！"><b style="color: red;"><?php echo ($title); ?></b></dt>
          <dt><span>栏目类别</span><select class="srk" name="leibie">
          <option value="1">内容栏目</option>
          <option value="2">新闻栏目</option>
          <option value="5">抓取栏目</option>
          <option value="3">图片栏目</option>
          <option value="4">视频栏目</option>
          </select></dt>
          <dt><span>修改内容：</span>
          		<textarea name="bannnercontent" id="editors" cols="" rows="" style="width:100%;" class="wby"><?php echo ($update['colcc']); ?></textarea>
          </dt>
          <dd><input name="" type="submit" class="an" value="保存发布"></dd>
          </form>
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