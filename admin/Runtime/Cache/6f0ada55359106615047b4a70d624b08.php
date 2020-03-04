<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($title); ?></title>

<link href="/abcTest/public/static/bootstrap/css/bootstrap.min.css" rel="stylesheet">


<link rel="stylesheet" href="/abcTest/public/static/bootstrap/css/indexFrame.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/abcTest/public/static/bootstrap/css/invalid.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/abcTest/public/static/bootstrap/css/bootstrap-fileinput.css">

<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="/abcTest/public/static/bootstrap/js/bootstrap-fileinput.js"></script>
<script src="/abcTest/public/static/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/abcTest/public/static/bootstrap/js/jquery.min.js"></script>

<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/abcTest/public/static/bootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="/abcTest/public/static/bootstrap/js/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="/abcTest/public/static/bootstrap/js/facebox.js"></script>
<script type="text/javascript" src="/abcTest/public/static/bootstrap/js/jquery.wysiwyg.js"></script>



</head>

<body>
 <div id="main-content">
    <div class="content-box">
    
      
      
      <div class="content-box-content">
        
          <!-- 表头 -->
          <table id="table" >
            <thead>
              <tr>
				<th>课程号</th>
                <th>课程名</th>
                <th>课程内容</th>	 
                <th>上课时间</th>
				<th>上课地点</th>
                <th>教练</th>
				<th>课程价格</th>				
                <th>选项</th>
              </tr>
            </thead>
              
            <!-- 表内容部分 -->
            <tbody>
              <?php if(is_array($courseList)): $i = 0; $__LIST__ = $courseList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($vo['courseID']); ?></td>
                <td><?php echo ($vo['courseName']); ?></td>
                <td><a class="courseIntro" id="showCourseInfo" onclick="showIntro()" data-toggle="modal" data-target="#introModal"><?php echo ($vo['courseContent']); ?> </a></td>
				<td><?php echo ($vo['courseTime']); ?> </td>
                <td><?php echo ($vo['courseArea']); ?></td>
                <td><?php echo ($vo['courseTeacher']); ?></td>
                <td><?php echo ($vo['coursePrice']); ?> </td>				
				<td><button onclick="doclick(this)" id="edit">编辑</button></td>
               <td><a onclick="delCourse('<?php echo ($vo[courseID]); ?>')" title="删除" ><img src="/abcTest/public/Images/icons/cross.png" alt="删除" /></a></td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>                        
            </tbody>
            
              <!-- 表尾 -->
            <tfoot>
              <tr>
                <td colspan="6">
                     <button data-toggle="modal" data-target="#myModal">添加课程</button>
					 
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
</div>
<!--显示信息模态框-->
<div class="modal fade" id="introModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				
				<h4 class="modal-title" id="myModalLabel">
					课程信息
				</h4>
			</div>
			<div class="modal-body" id="introModalBody">
				
			</div>

			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal -->
</div>
<!--显示信息模态框-->

<!--添加课程模态框  -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				
				<h4 class="modal-title" id="myModalLabel">
					添加课程
				</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" action="/abcTest/admin.php/Course/add" method="post" name="courseForm" enctype="multipart/form-data">
				  
				  
				  <div class="form-group">
					<label for="inputText" class="col-sm-2 control-label">课程名</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" id="cName" placeholder="课程名">
					</div>					
				  </div>
				  
				  <div class="form-group">
					<label for="inputText" class="col-sm-2 control-label">课程简介</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" id="cBrife" placeholder="课程简介">
					</div>					
				  </div>
				  <div class="form-group">
						<label for="inputText" class="col-sm-2 control-label">课前准备</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" id="cPrepare" placeholder="课前准备" id="teacher">
						</div>					
					  </div>

					  <div class="form-group">
						<label for="inputText" class="col-sm-2 control-label">课程步骤</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" id="cSteps" placeholder="==如有多条内容，请以@符号分隔==" id="teacher">
						</div>					
					  </div>

				   <div class="form-group">
					<label for="inputText" class="col-sm-2 control-label">常见错误</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" id="cErrors" placeholder="==如有多条内容，请以@符号分隔==">
					</div>					
				  </div>
				  
				   <div class="form-group">
					<label for="inputText" class="col-sm-2 control-label">课程建议</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" id="cSuggests" placeholder="==如有多条内容，请以@符号分隔==">
					</div>					
				  </div>
				  <div class="form-group" id="uploadForm" enctype="multipart/form-data">
					<label for="inputText" class="col-sm-2 control-label">课程封面</label>
					<div class="fileinput fileinput-new" data-provides="fileinput"  id="exampleInputUpload">
						<div class="fileinput-new thumbnail" style="width:140px;height:140px;max-height:150px;">
							<img id='picImg' style="width: 100%;height: auto;max-height: 140px;" src="/abcTest/public/Images/noimage.png" alt="" />
						</div>
						<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
						<div>
							<span class="btn btn-primary btn-file">
								<span class="fileinput-new">选择文件</span>
								<span class="fileinput-exists">换一张</span>
								<input type="file" name="pic1" id="picID" accept="image/gif,image/jpeg,image/x-png"/>
							</span>
							<a href="javascript:;" class="btn btn-warning fileinput-exists" data-dismiss="fileinput">移除</a>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">关闭
					</button>
					<button id="addButton" type="submit" class="btn btn-primary"><!--- onclick="addCourse()"-->
						添加
					</button>
				</div>

				</form>
			</div>
			
		</div><!-- /.modal-content -->
	</div><!-- /.modal -->
</div>
</div>
<script language="javascript">


	function delCourse(obj){
         
          $.ajax({
            url:"/abcTest/admin.php/Course/del",
            type:"post",
            data:{"id":obj},
            success:function(msg){
				if(msg=='删除成功'){
					//alert(msg);
              window.location.reload();
				}
				else{
					alert(msg);
				}
              
            },
            error:function(msg){
              alert(msg);
            }
          });
        
        }

function addCourse(){

var imgName=(document.getElementById('picID').files)[0].name;
var cname=$('#cName').val();
var brife=$('#cBrife').val();
var prepare=$('#cPrepare').val();
var steps=$('#cSteps').val();
var errors=$('#cErrors').val();
var suggests=$('#cSuggests').val();
var imgUrl='/abcTest/public/Images/upload/'+imgName;
//alert(imgUrl);
//alert('aaaaaaaaaaa'+imgName);

$.ajax({
url:"/abcTest/admin.php/Course/add",
type:"POST",
data:{"cname":cname,"brife":brife,"prepare":prepare,"steps":steps,"errors":errors,"suggests":suggests,"imgName":imgName},
success:function(msg){
alert(msg);
//window.location.reload();
},
error:function(){
alert("添加失败");
}

});

}

function showIntro(){
		var td = event.srcElement; // 通过event.srcElement 获取激活事件的对象 td 
		var index=td.parentElement.parentElement.rowIndex;
		var tab = document.getElementById("table");
		var row = tab.rows; //获取table的行
		var cell = row[index].cells; 
		var cID=cell[0].innerText; //获取课程号
		//alert(cID);
		var showModal=document.getElementById("introModalBody");
		$.ajax({
                    url: "/abcTest/admin.php/Course/index",  
                    type: "POST",                    
					data: {"id":cID},//前端数据通过ajax传到后端
					success:function(msg){
						//window.location.reload();
						msg=msg.split("<")[0];
						showModal.innerHTML=msg;
					
					},
                    error: function(){  
                        alert('Error loading XML document');  
                    }
                });
}

    function doclick(obj) {
		var td = event.srcElement; // 通过event.srcElement 获取激活事件的对象 td 
		var index=td.parentElement.parentElement.rowIndex;
		
		var tab = document.getElementById("table");
		var row = tab.rows; //获取table的行
		var cell = row[index].cells; 
		var courseID=cell[0].innerHTML; //获取课程号
		var c=index;
		
        
		for(var i=0;i<tab.rows[index].cells.length-2;i++){
			var text = tab.rows[index].cells[i].innerText;
		tab.rows[index].cells[i].innerHTML = '<input class="input" name="input'+ index + '" type="text" value="" style="width:70px;"/>';
		var input = document.getElementsByName("input" + index);	
		if(i==0){
			input[i].value=text;
			input[i].setAttribute('readonly','readonly');
		}	
		input[i].value = text;
		input[0].focus();
		input[0].select();
			
		}

		
		obj.innerHTML="确定";

		
		obj.onclick = function onclick(event) {
                          
                
                $.ajax({
                    url: "/abcTest/admin.php/Course/edit",  
                    type: "POST",                    
					data: {"id":courseID,"name":input[1].value,"content":input[2].value,
					"time":input[3].value,"area":input[4].value,"teacher":input[5].value,
					"price":input[6].value},//前端数据通过ajax传到后端
					success: function(msg){
						window.location.reload();
						//alert(msg)
					},
                    error: function(){  
                        alert('Error loading XML document');  
                    }
                });
                   
    }
    }
	
    </script>
		
		
	</body>
<!-- Download From www.exet.tk-->
</html>