<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($title); ?></title>

<link href="/abcTest/public/static/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="/abcTest/public/static/bootstrap/css/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/abcTest/public/static/bootstrap/css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/abcTest/public/static/bootstrap/css/invalid.css" type="text/css" media="screen" />

<script src="/abcTest/public/static/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/abcTest/public/static/bootstrap/js/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/abcTest/public/static/bootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="/abcTest/public/static/bootstrap/js/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="/abcTest/public/static/bootstrap/js/facebox.js"></script>
<script type="text/javascript" src="/abcTest/public/static/bootstrap/js/jquery.wysiwyg.js"></script>



</head>

<body>
<div id="body-wrapper">

  <div id="sidebar">
    <div id="sidebar-wrapper">
     
      	<h1 id="sidebar-title"><a href="#">Simpla Admin</a></h1>
      	<img id="logo" src="__PUBLIC__/Images/logo.png" alt="Simpla Admin logo" />

      	<div id="profile-links"> 
      		您好,<a href="#" title="当前用户:<?php echo ($name); ?>"><?php echo ($name); ?></a> |
	 		<a title="退出" onclick="logout()">退出</a> 
			
       	</div>
       	
	    <ul id="main-nav">
     		<!-- 类型为nav-top-itrm current 表示选中时的样式 -->
     		<li class="nav-top-item"><a href="../ManageCourse/index" target="mid_frame" >课程管理</a></li>
	        <li class="nav-top-item"> <a href="../ShowStudentInfo/index" target="mid_frame">学员信息</a></li>	              
	        <li class="nav-top-item"> <a data-toggle="modal" data-target="#passwordModal">修改密码</a></li>
			
			
			
			
	     </ul>
         
    </div>
  </div>
  <!-- End #sidebar -->
  
  
  
  
  <div id="main-content">
 
    <noscript>
    <!-- Show a notification if the user has disabled javascript -->
	    <div class="notification error png_bg">
	      	<div> Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
	        Download From
	        </div>
	    </div>
    </noscript>
    
    
    <!-- Page Head -->
    <h2>后台管理系统</h2>
	
	
	<div   class="officeFrame" data-options="region:'center',title:'  '" 
            style="background: #fff; width:1100px; height:800px; float: left; margin-top: 0px;  border-radius: 2px">
            <iframe frameborder="0"  style="width: 1100px; height: 800px;"
                name="mid_frame"></iframe>
        </div>
	
		 <!--修改密码模态框-->
      
		 <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content cModel">
						<div class="modal-header">
							
							<h4 class="modal-title" id="myModalLabel">
								修改密码
							</h4>
						</div>
						<div class="modal-body" id="introModalBody">
								<form class="form-horizontal" method="post" name="memberForm">
			  
										<div class="form-group">
										  <label for="inputText" class="col-sm-2 control-label">新密码</label>
										  <div class="col-sm-10">
											<input type="text" class="form-control" name="password" placeholder="新密码">
										  </div>					
										</div>
										
										<div class="form-group">
										  <label for="inputText" class="col-sm-2 control-label">确认密码</label>
										  <div class="col-sm-10">
											<input type="text" class="form-control" name="confirmPassword" placeholder="确认密码">
										  </div>					
										</div>
							</form>
						</div>
			
						
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">关闭
							</button>
							<button type="button" class="btn btn-primary" onclick="changePassword()">
									修改
								</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal -->
			</div>
					
		<!--修改密码模态框-->
	</div>
    
</div>
		<script language="javascript">
		 function logout(){
               window.location.href='/abcTest/index.php/Login/index';
			   
           }
		   function changePassword(){
               var newPass=$('input[name="password"]').val();
               var confirmPass=$('input[name="confirmPassword"]').val();
               if(newPass!=confirmPass){
                    alert("两次输入密码不一致，请重新输入");
                    //$('input[name="password"]').val("");
               }
               else{
                $.ajax({
                   url:"/abcTest/index.php/CoachIndex/changePass",
                   type:"post",
                   data:{"newPass":newPass},
                   success:function(msg){
                        alert(msg);
                        $('#passwordModal').modal('hide');
                   },
                   error:function(msg){
                        alert(msg);
                   }
               });
               }
              
           }
		</script>
		
</body>

</html>