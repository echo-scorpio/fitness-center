<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($title); ?></title>


<link rel="stylesheet" href="__PUBLIC__/Css/admin/reset.css" type="text/css" media="screen" />
<!-- Main Stylesheet -->
<link rel="stylesheet" href="__PUBLIC__/Css/admin/style.css" type="text/css" media="screen" />
<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
<link rel="stylesheet" href="__PUBLIC__/Css/admin/invalid.css" type="text/css" media="screen" />


<script type="text/javascript" src="__PUBLIC__/Js/admin/jquery-1.3.2.min.js"></script>
<!-- jQuery Configuration -->
<script type="text/javascript" src="__PUBLIC__/Js/admin/simpla.jquery.configuration.js"></script>
<!-- Facebox jQuery Plugin -->
<script type="text/javascript" src="__PUBLIC__/Js/admin/facebox.js"></script>
<!-- jQuery WYSIWYG Plugin -->
<script type="text/javascript" src="__PUBLIC__/Js/admin/jquery.wysiwyg.js"></script>
<script>
			function show(obj){
				obj.src="__APP__/Common/verify/random/"+Math.random();
			}
</script>
</head>

<body id="login">

<div id="login-wrapper" class="png_bg">

  	<div id="login-top">
    	<h1><?php echo ($title); ?></h1>
    	<!-- Logo (221px width) -->
    	<img id="logo" src="__PUBLIC__/Images/admin/logo.png" alt="<?php echo ($title); ?>" />
    </div>
    
   	<!-- Form表单 --> 
  	<div id="login-content"> 
    	<form action="__URL__/login" method="POST">
      		
      		<p>
        		<label>用户名</label>
        		<input class="text-input" type="text"  name="username"/>
      		</p>
      		
      		<div class="clear"></div>
      		
      		<p>
        		<label>密码</label>
        		<input class="text-input" type="password" name="password"/>
      		</p>
      		
      		<div class="clear"></div>
      		
      		<p>
        		<label>验证码</label>
        		<input class="text-input" type="text" name="verify"/>
        		<img src="__APP__/Common/verify"/ onclick="show(this)">
      		</p>
      		
      		<div class="clear"></div>
      		
      		<!--  
      		<p id="remember-password">
        			<input type="checkbox" />
       		 		记住我
       		 </p>
       		 -->
      		<div class="clear"></div>
      		
      		<p>
        		<input class="button" type="submit" value="登录" />
      		</p>
    	</form>
  </div>

</div>	
</body>
</html>