<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <title>Flat Admin V.2 - Free Bootstrap Admin Templates</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <!-- CSS Libs -->
    <link href="/abcTest/public/static/bootstrap/css/bootstrap.min.css" rel="stylesheet">


<link rel="stylesheet" href="/abcTest/public/static/bootstrap/css/indexFrame.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/abcTest/public/static/bootstrap/css/invalid.css" type="text/css" media="screen" />

    <link rel="stylesheet" href="/abcTest/public/static/bootstrap/css/user.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="/abcTest/public/static/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/abcTest/public/static/bootstrap/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/abcTest/public/static/bootstrap/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="/abcTest/public/static/bootstrap/css/bootstrap-switch.min.css">
    <link rel="stylesheet" type="text/css" href="/abcTest/public/static/bootstrap/css/checkbox3.min.css">
    <link rel="stylesheet" type="text/css" href="/abcTest/public/static/bootstrap/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="/abcTest/public/static/bootstrap/css/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/abcTest/public/static/bootstrap/css/select2.min.css">
    <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="/abcTest/public/static/bootstrap/css/style1.css">
    <link rel="stylesheet" type="text/css" href="/abcTest/public/static/bootstrap/css/flat-blue.css">
</head>

<body class="flat-blue">
    <div class="app-container">
        <div class="row content-container">
            <nav class="navbar navbar-default navbar-fixed-top navbar-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                      
                        <ol class="breadcrumb navbar-breadcrumb">
                            <li class="active">Dashboard</li>
                        </ol>
                        <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                            <i class="fa fa-th icon"></i>
                        </button>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                      
                        
                        <li class="dropdown profile">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Emily Hart <span class="caret"></span></a>
                            <ul class="dropdown-menu animated fadeInDown">
                                <li class="profile-img">
                                    <img src="../img/profile/picjumbo.com_HNCK4153_resize.jpg" class="profile-img">
                                </li>
                                <li>
                                    <div class="profile-info">
                                        <h4 class="username">Emily Hart</h4>
                                        <p>emily_hart@email.com</p>
                                        <div class="btn-group margin-bottom-2x" role="group">
                                            <button type="button" class="btn btn-default"><i class="fa fa-user"></i> Profile</button>
                                            <button type="button" class="btn btn-default"><i class="fa fa-sign-out"></i> Logout</button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
           
            
            <!-- Main Content -->
            <div id="main-content">
            <div class="container-fluid">
                <div class="side-body padding-top">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <a href="#" onclick="courseAction()">
                                <div class="course">
                                    <div class="card-body">
                                        
                                        
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <a href="#">
                                <div class="consume">
                                    <div class="card-body">
                                        
                                        
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <a href="#">
                                <div class="leave">
                                    <div class="card-body">
                                        
                                        
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <a href="#">
                                <div class="consumeDetail">
                                    <div class="card-body">
                                        
                                        
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                </div>
                <div class="content-box">
          
      
                       
                          
                            <!-- 表头 -->
                            <table id="table" style="display: none">
                              <thead>
                                <tr>
                                  <th>课程号</th>
                                  <th>课程名</th>
                                  <th>上课时间</th>	 
                                  <th>上课地点</th>
                                  <th>教练</th>
                                  <th>课程售价</th>
                                  
                                </tr>
                              </thead>
                                
                              <!-- 表内容部分 -->
                              <tbody>
                                <?php if(is_array($courseList)): $i = 0; $__LIST__ = $courseList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                  
                                        <td><?php echo ($vo['courseID']); ?></td>
                                        <td><?php echo ($vo['courseName']); ?></td>
                                        
                                        <td><?php echo ($vo['courseTime']); ?> </td>
                                        <td><?php echo ($vo['courseArea']); ?></td>
                                        <td><?php echo ($vo['courseTeacher']); ?></td>
                                        <td><?php echo ($vo['coursePrice']); ?> </td>	
                                  
                                  <td><button onclick="doclick(this)" id="edit">编辑</button></td>
                                 <td><a href="/abcTest/admin.php/Card/del/id/<?php echo ($vo['cardID']); ?>" title="删除"><img src="/abcTest/public/Images/icons/cross.png" alt="删除" /></a></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>                        
                              </tbody>
                              
                                <!-- 表尾 -->
                              <tfoot>
                                <tr>
                                  <td colspan="6">
                                       <button data-toggle="modal" data-target="#myModal"  id="addButton">添加会员卡</button>
                                       
                                  </td>
                                </tr>
                              </tfoot>
                            </table>
                          
                  </div>
                </div>

            </div>
        </div>
        <footer class="app-footer">
            
        </footer>
       <script language="javascript">
           function courseAction(){
               //alert("aaaaaaaaaaaa");
               var tab=document.getElementById('table');
               tab.style.display="block";
           }
        </script>
            <!-- Javascript Libs -->
            <script type="text/javascript" src="/abcTest/public/static/bootstrap/js/jquery.min.js"></script>
            <script type="text/javascript" src="/abcTest/public/static/bootstrap/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="/abcTest/public/static/bootstrap/js/Chart.min.js"></script>
            <script type="text/javascript" src="/abcTest/public/static/bootstrap/js/bootstrap-switch.min.js"></script>
            <script type="text/javascript" src="/abcTest/public/static/bootstrap/js/jquery.matchHeight-min.js"></script>
            <script type="text/javascript" src="/abcTest/public/static/bootstrap/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="/abcTest/public/static/bootstrap/js/dataTables.bootstrap.min.js"></script>
            <script type="text/javascript" src="/abcTest/public/static/bootstrap/js/select2.full.min.js"></script>
            <script type="text/javascript" src="/abcTest/public/static/bootstrap/js/ace.js"></script>
            <script type="text/javascript" src="/abcTest/public/static/bootstrap/js/mode-html.js"></script>
            <script type="text/javascript" src="/abcTest/public/static/bootstrap/js/theme-github.js"></script>
            <!-- Javascript -->
            <script type="text/javascript" src="../js/app.js"></script>
            <script type="text/javascript" src="../js/index.js"></script>
</body>

</html>