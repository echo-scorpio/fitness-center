<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>登录系统</title> 

    <link href="/abcTest/public/static/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="container">

	<div class="row">

	    <div class="col-sm-7">

	        <div class="ibox float-e-margins">	          

	            <div class="ibox-content">

	                <div class="row">

	                    <div class="col-sm-6 b-r">

	                        <h3 class="m-t-none m-b">登录</h3>

	                        

	                        <form role="form" action="./checkLogin" method="post">

	                            <div class="form-group">

	                                <label>用户名</label>

	                                <input type="text" placeholder="请输入用户名" name="user_name" class="form-control">

	                            </div>

	                            <div class="form-group">

	                                <label>密码</label>

	                                <input type="password" placeholder="请输入密码" name="user_pwd" class="form-control">

	                            </div>

	                            <div>

	                                <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>登 录</strong>

	                                </button>	                               

	                            </div>

	                        </form>

	                    </div>	                   

	                </div>

	            </div>

	        </div>

	    </div>

	</div>

</div> 

<script src="/static/js/jquery.min.js?v=2.1.4"></script>

<script src="/static/bootstrap/js/bootstrap.min.js"></script>

</body>


</html>