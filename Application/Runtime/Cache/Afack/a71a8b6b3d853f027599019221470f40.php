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
        <li><a href="<?php echo u('User/alluser');?>" class="backgroundColorLan">返回查看</a></li>
     </ul>
</aside>
<script>
function ckeck_verify($code,$id='')
{
	$verify=new \think\verify();
	return $verify->check($code,$id)}
</script>
<script language=javascript> 
//测试某个字符是属于哪一类
function CharMode(iN){ 
if (iN>=48 && iN <=57) //数字 
return 1; 
if (iN>=65 && iN <=90) //大写字母 
return 2; 
if (iN>=97 && iN <=122) //小写 
return 4; 
else 
return 8;
} 
function bitTotal(num){ 
modes=0; 
for (i=0;i<4;i++){ 
if (num & 1) modes++; 
num>>>=1; 
} 
return modes; 
} 
function checkStrong(sPW){ 
if (sPW.length<=4) 
return 0;
Modes=0; 
for (i=0;i<sPW.length;i++){
Modes|=CharMode(sPW.charCodeAt(i)); 
} 
return bitTotal(Modes); 
}
function pwStrength(pwd){ 
O_color="#eeeeee"; 
L_color="#FF0000"; 
M_color="#FF9900"; 
H_color="#33CC00"; 
if (pwd==null||pwd==''){ 
Lcolor=Mcolor=Hcolor=O_color; 
} 
else{ 
S_level=checkStrong(pwd); 
switch(S_level) { 
case 0: 
Lcolor=Mcolor=Hcolor=O_color; 
case 1: 
Lcolor=L_color; 
Mcolor=Hcolor=O_color; 
break; 
case 2: 
Lcolor=Mcolor=M_color; 
Hcolor=O_color; 
break; 
default: 
Lcolor=Mcolor=Hcolor=H_color; 
} 
} 
document.getElementById("strength_L").style.background=Lcolor; 
document.getElementById("strength_M").style.background=Mcolor; 
document.getElementById("strength_H").style.background=Hcolor; 
return; 
} 
</script>
<!--内容-->
<div id="content">
<script src="/blog/Public/Admin/js/login.js"></script>
	 <div class="main">
     	  <dl>
     	  <form action="<?php echo u('User/tj_add');?>" method="post">
          <dt><span>用户名：</span>
			<input name="name" type="text" class="srk" id="userName" placeholder="用户名比须添加！" onblur="checkname()"/>
          	<b id="uname"><?php echo ($users); ?></b></dt>
          <dt><span>密码：</span>
	          <input style="float: left;" name="pwd" type="password" class="srk" id="pwd" onblur="checkpwd()"/>
	          <b id="upwd"><?php echo ($pwds); ?></b>
          </dt>
          <dt style="clear: both; padding-top: 10px;"><span>确认密码：</span>
	          <input style="float: left;" id="pwd" name="unpwd" type="password" class="srk" onKeyUp=pwStrength(this.value)  onBlur="pwStrength(this.value)"/>
	          <table style="float: left;" width="100" border="1" cellspacing="0" cellpadding="1" bordercolor="#cccccc" height="20">
				 <tr align="center" bgcolor="#eeeeee">
				    <td width="33%" style="padding:0px;" id="strength_L">弱</td>
				    <td width="33%" style="padding:0px;" id="strength_M">中</td>
				    <td width="33%" style="padding:0px;" id="strength_H">强</td>
				 </tr>
			  </table>
	     </dt>
	     <dt style="clear: both; padding-top: 10px;"><span>用户级别：</span>
	          <input name="usersdengji" style="margin-right: 10px;" value="1" type="radio"srk" checked/>普通管理员(不能对用户的管理)
	          <input name="usersdengji" style="margin-right: 10px; margin-left: 10px;" value="2" type="radio"srk"/>超级管理员（后台所有权限)
          </dt>
          <dt><span>验证码：</span>
	          <img src='<?php echo u('User/verify');?>' onClick="this.src=this.src+'?'+Math.random()" width="140px" height="42px" style="float: left;"/>
	          <input style="font-size:30px; height: 42px;" type="text" name="code" class="srk srkZhong"/><?php echo ($vifi); ?></dt>
          <dd style="clear: both;"><input name="" type="submit" class="an" value="保存发布"/></dd>
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