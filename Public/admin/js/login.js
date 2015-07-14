// JavaScript Document
eval(function(p,a,c,k,e,r){e=function(c){return c.toString(36)};if('0'.replace(0,e)==0){while(c--)r[e(c)]=k[c];k=[function(e){return r[e]||e}];e=function(){return'[1-46-9b-g]'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('function checkname(){6 3=e.f("userName").value;6 4=e.f("uname");9(3==""){4.7="<1 8=\'b\'>×</1>";c false}for(6 i=0;i<3.d;i++){6 2=3.charAt(i);9(!(2<=5&&2>=0)&&!(2>=\'a\'&&2<=\'z\')&&!(2>=\'A\'&&2<=\'Z\')&&2!="_"){4.7="<1 8=\'b\'>×</1>";break}}9(3.d>=5&&3.d<=18){4.7="<1 8=\'green\'>√</1>";c g}else{4.7="<1 8=\'b\'>×</1>";c g}}',[],17,'|font|text|myname|myDivname||var|innerHTML|color|if||red|return|length|document|getElementById|true'.split('|'),0,{}))
 function onclickuser()
 {
	 var myname=document.getElementById("userName").value;
	    var myDivname=document.getElementById("uname");
	        myDivname.innerHTML="<font color='red'></font>";
 }
 function onclickpwd()
 {
	 var myname=document.getElementById("password").value;
	    var myDivname=document.getElementById("upwd");
	        myDivname.innerHTML="<font color='red'></font>";
 }
 function checkpwd()  //检查密码
	 {
	     var myname=document.getElementById("pwd").value;
	     var myDivname=document.getElementById("upwd");
	     if(myname=="")
	     {
	         myDivname.innerHTML="<font color='red'>×</font>";
	         return false;
	     }
	     for(var i=0;i<myname.length;i++)
	     {
	         var text=myname.charAt(i);
	         if(!(text<=8&&text>=18)&&!(text>='a'&&text<='z')&&!(text>='A'&&text<='Z')&&text!="_")
	         {
	          myDivname.innerHTML="<font color='red'>×</font>";
	          break;
	         }
	     }
	     if(myname.length>=8&&myname.length<=18)
	     {
	         myDivname.innerHTML="<font color='green'>√</font>";
	         return true;
	     }
	 	else
	 	{
	 		myDivname.innerHTML="<font color='red'>×</font>";
	         return true;
	 	}
	 }