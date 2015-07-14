<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=yes">
<link type="text/css" rel="stylesheet" href="/blog/Public/Admin/css/base.css" />
<link rel="icon" href="/blog/Public/app/images/list_logo.png" type="img/x-icon"/>
<title>龍武士</title>
<meta name="keywords" content="sunemotor" />
<meta name="description" content="sunemotor" />
</head>

<body style="background:#2e363f;">
	<form action="<?php echo u('Index/login');?>" method="post">
    <div id="login">
    	 <div class="login">
         	  <ul><img src="/blog/Public/Admin/images/logo.png" width="178"></ul>
              <dl>
                  <dt><img src="/blog/Public/Admin/images/pic_03.gif"><input name="user" type="text"><span><?php echo ($users); ?></span></dt>
                  <dt><img src="/blog/Public/Admin/images/pic_04.gif"><input name="pwd" type="password"><span><?php echo ($pwds); ?></span></dt>
                  <dd><span><?php echo ($reg); ?></span><input name="" type="submit" value="登录"></dd>
              </dl>
         </div>
    </div>
    </form>
</body>
</html>