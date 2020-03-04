<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title><?php echo ($title); ?></title>
	<meta content="text/html; CHARSET=utf-8" http-equiv="Content-Type">		 
</head>
<body>   	
<?php if(is_array($news_list)): $i = 0; $__LIST__ = $news_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><p><b><?php echo ($vo['subject']); ?></b></p> 
<p><?php echo ($vo['message']); ?> <p>
<p><?php echo ($vo['createtime']); ?></p>
<p></p>
<p></p><?php endforeach; endif; else: echo "" ;endif; ?>	  						 
</body>
</html>