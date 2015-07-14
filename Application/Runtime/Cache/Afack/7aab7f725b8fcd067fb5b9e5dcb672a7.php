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
<!--内容-->
  <script type="text/javascript" src="/blog/Public/Admin/js/manhuaDate.js"></script>
<script charset="utf-8" src="/blog/Public/kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="/blog/Public/kindeditor/lang/zh_CN.js"></script>
<script>
    /*     KindEditor.ready(function(K) {
                window.editor = K.create('#editor_id');
        }); */
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
    $(function (){
     	$("input.mh_date").manhuaDate({					       
     		Event : "click",//可选				       
     		Left : 0,//弹出时间停靠的左边位置
     		Top : -16,//弹出时间停靠的顶部边位置
     		fuhao : "-",//日期连接符默认为-
     		isTime : false,//是否开启时间值默认为false
     		beginY : 2013,//年份的开始默认为1994
     		endY :2030,//年份的结束默认为2049
     	});
     	
     });
</script>

<div id="content">
	 <div class="main">
	 <form action="<?php echo u('Xitong/save',array('id'=>$web['xitongid']));?>" method="post" enctype="multipart/form-data">
     	  <dl>
          <dt><span>网站标题：</span><input name="webname" type="text" class="imgcontent srk" value="<?php echo ($web['title']); ?>" placeholder="文章名称必须添加！"></dt>
           <dt><span>seo关键字：</span><input name="webkey" type="text" class="imgcontent srk" value="<?php echo ($web['keytitle']); ?>" placeholder="文章名称必须添加！"></dt>
           <dt><span>网名：</span><input name="net" required="required" type="text" class="imgcontent srk" value="<?php echo ($member['membername']); ?>" ></dt>
           <dt><span>职业：</span><input name="job" required="required" type="text" class="imgcontent srk" value="<?php echo ($member['memberjob']); ?>" ></dt>
           <dt><span>电话：</span><input name="pone" required="required" type="text" class="imgcontent srk" value="<?php echo ($member['memberpone']); ?>" ></dt>
           <dt><span>email：</span><input name="email" required="required" type="text" class="imgcontent srk" value="<?php echo ($member['memberemail']); ?>"></dt>
           <dt><span>网站图标：</span>
           <input class="imgcontent srk" type="file" name="ieco">
           <?php if($web['ico'] != null): ?><br/><img alt="浏览器图标" src="/blog/<?php echo ($web['ico']); ?>"><?php endif; ?>
			</dt>
		 <dt><span>网站logo：</span><input class="imgcontent srk" type="file" name="logo" />
		  <?php if($web['logo'] != null): ?><br/><img alt="浏览器图标" src="/blog/<?php echo ($web['logo']); ?>"><?php endif; ?>
			
		 </dt>
          
          <dd><input name="" type="submit" class="an" value="保存发布"></dd>
          </dl>
     </form>
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