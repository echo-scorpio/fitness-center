<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($title); ?></title>


<link rel="stylesheet" href="__PUBLIC__/Css/admin/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="__PUBLIC__/Css/admin/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="__PUBLIC__/Css/admin/invalid.css" type="text/css" media="screen" />
<link rel="stylesheet" href="__ROOT__/ueditor/themes/default/ueditor.css"/>

<script type="text/javascript" src="__PUBLIC__/Js/admin/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/admin/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/admin/facebox.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/admin/jquery.wysiwyg.js"></script>

<script type="text/javascript" src="__ROOT__/ueditor/editor_config.js"></script>
<script type="text/javascript" src="__ROOT__/ueditor/editor_all.js"></script>


</head>

<body>
<div id="body-wrapper">

  <div id="sidebar">
    <div id="sidebar-wrapper">
     
      	<h1 id="sidebar-title"><a href="#">Simpla Admin</a></h1>
      	<img id="logo" src="__PUBLIC__/Images/admin/logo.png" alt="Simpla Admin logo" />

      	<div id="profile-links"> 
      		您好,<a href="#" title="当前用户:<?php echo ($username); ?>"><?php echo ($username); ?></a> |
	 		<a href="__URL__/quit" title="退出">退出</a> 
       	</div>
       	
	    <ul id="main-nav">
     		<!-- 类型为nav-top-itrm current 表示选中时的样式 -->
     		 <li> <a href="#" class="nav-top-item">实验室  Lab</a>
	          <ul>
	            <li><a href="#">实验室简介</a></li>
	            <li><a href="#">实验室组织</a></li>
	            <li><a href="#">实验室成员</a></li>
	          </ul>
	        </li>
	        
	        <li> <a href="#" class="nav-top-item ">项目  Projects</a>
	          <ul>
	            <li><a href="#">目前项目</a></li>
	            <li><a href="#">获奖项目</a></li>
	            <li><a href="#">开发课题</a></li>
	          </ul>
	        </li>
	              
	        <li> <a href="#" class="nav-top-item">研究生 Student</a>
	          <ul>
	            <li><a href="#">研究生招收</a></li>
	            <li><a href="#">研究生教育</a></li>
	            <li><a href="#">在读研究生</a></li>
	            <li><a href="#">毕业研究生</a></li>
	          </ul>
	        </li>
	        
	        <li> <a href="#" class="nav-top-item">其他 Others</a>
	          <ul>
	            <li><a href="#">软件</a></li>
	            <li><a href="#">出版物</a></li>
	          </ul>
	        </li>
	     </ul>
         
    </div>
  </div>
   
  <div id="main-content">
 
    <noscript>
    <!-- Show a notification if the user has disabled javascript -->
	    <div class="notification error png_bg">
	      	<div> 您好，您的浏览器不支持JavaScript，请打开JavaScript功能 <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
	        Download From
	        </div>
	    </div>
    </noscript>
    
    <h2>新文章</h2>
	<br></br>
	
   	<!-- 实例化百度编辑器 -->

   	<form action="__URL__/<?php echo ($btn_ok_act); ?>"  method="post">
   		<p class="subtit">文章标题</p>
		<div>
			<select id="selType">
				<option value="0">请选择</option>
				<option value="1">原创</option>
				<option value="2">转载</option>
				<option value="4">翻译</option>
			</select>
			<input type="text" id="txtTitle" name="subject" style="width:560px; height:20px; float:left;" maxlength="100" value="<?php echo ($article_item["subject"]); ?>"/>
		</div>
		<br></br>
		<p class="subtit">文章内容</p>
	    <div id="myEditor">
			<script type="text/javascript">
				var editor = new baidu.editor.ui.Editor({
				    initialContent: '<?php echo ($article_item["message"]); ?>'
				});
				editor.render("myEditor");
			</script>
		</div>
		<br></br>
		<input type="hidden" value="<?php echo ($article_item["id"]); ?>" name="id"/>
		<input type="submit" value="<?php echo ($btn_ok_text); ?>"/>
	</form>
    <div class="clear"></div>
        
    <div id="footer"> 
    	<small>
      		&#169; Copyright 2012 SIA | Powered by Ruby97 		| 	<a href="#">Top</a> 
      	</small> 
    </div>
    
  </div>

</div>
</body>
</html>