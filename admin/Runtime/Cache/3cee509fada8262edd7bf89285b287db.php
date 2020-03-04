<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($title); ?></title>

<link href="/abcTest/public/static/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">


<link rel="stylesheet" href="/abcTest/public/static/bootstrap/css/indexFrame.css" type="text/css" media="screen" />
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
 <div id="main-content">
    <div class="content-box">
    
      
      
      <div class="content-box-content">
        
          <!-- 表头 -->
          <table id="table" >
            <thead>
              <tr>
				  <th>会员号</th>
                <th>姓名</th>
                <th>性别</th>	 
                <th>家庭住址</th>
				<th>健康状况</th>
                <th>身份证号</th>
                <th>联系方式</th>
                <th>注册时间</th>	 
                <th>选项</th>
              </tr>
            </thead>
              
            <!-- 表内容部分 -->
            <tbody>
              <?php if(is_array($memInfoList)): $i = 0; $__LIST__ = $memInfoList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					<td><?php echo ($vo['memId']); ?></td>
                <td><?php echo ($vo['memName']); ?></td>
                <td><?php echo ($vo['memSex']); ?> </td>
				<td><?php echo ($vo['memAddr']); ?> </td>
                <td><?php echo ($vo['memHealth']); ?></td>
                <td><?php echo ($vo['memIdCard']); ?></td>
                <td><?php echo ($vo['memTel']); ?> </td>
				<td><?php echo ($vo['memRegisteDate']); ?> </td>
				<td><button onclick="doclick(this)" id="edit">编辑</button></td>
               <td><a href="__URL__/delete/id/<?php echo ($vo['memIdCard']); ?>" title="删除"><img src="/abcTest/public/Images/icons/cross.png" alt="删除" /></a></td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>                        
            </tbody>
            
              <!-- 表尾 -->
            <tfoot>
              <tr>
                <td colspan="6">
                     <button data-toggle="modal" data-target="#myModal" >添加会员</button>
					 
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
</div>

<!-- 模态框  -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel">
					添加会员
				</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" method="post" name="memberForm">
				  
				  <div class="form-group">
					<label for="inputText" class="col-sm-2 control-label">会员卡号</label>
					<div class="col-sm-10">
					  <input id="CardID" type="text" class="form-control" name="memCardID" placeholder="会员卡号">
					</div>					
				  </div>
				  
				  <div class="form-group">
					<label for="inputText" class="col-sm-2 control-label">姓名</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" name="memName" placeholder="姓名">
					</div>					
				  </div>
				  
				  <div class="form-group">				
					<label class="col-sm-2 control-label"> 性别</label>
					<label for="inputText" class="radio-inline sexRadio">
							<input type="radio" name="radioname" id="checkSex" value="男" checked> 男
						</label>
						<label class="radio-inline">
							<input type="radio" name="radioname" id="checkSex"  value="女"> 女
						</label>
	 
				</div>
				  
				   <div class="form-group">
					<label for="inputText" class="col-sm-2 control-label">家庭住址</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" name="memAddr" placeholder="家庭住址">
					</div>					
				  </div>
				  
				   <div class="form-group">
					<label for="inputText" class="col-sm-2 control-label">健康情况</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" name="memHealth" placeholder="健康情况">
					</div>					
				  </div>
				  
				   <div class="form-group">
					<label for="inputText" class="col-sm-2 control-label">身份证号</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" name="memIdCard" placeholder="身份证号">
					</div>					
				  </div>
				  
				   <div class="form-group">
					<label for="inputText" class="col-sm-2 control-label">联系方式</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" name="memTel" placeholder="联系方式">
					</div>					
				  </div>
				  
				  
				  
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭
				</button>
				<button id="addButton" type="button" class="btn btn-primary" onclick="addMember()">
					添加
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal -->
</div>
</div>
<script language="javascript">
	$("#CardID").blur(function(){
//alert("hello world");
var cardID=document.memberForm.memCardID.value;
$.ajax({
	url:"/abcTest/admin.php/Member/checkCardID",
	type:"post",
	data:{'cardID':cardID},
	success:function(msg){/*要加一个会员卡是否已售出的字段，已售出的会员卡不能再分配给会员*/
		if(msg=='不存在该会员卡'){
			alert(msg);			
			$("#addButton").attr("disabled",true);
			$("#addButton").css("pointer-events","none");
                          $("#addButton").css("background-color","#bbb7b7");
		}
		else{
			if(msg=='已售出'){
				alert("该会员卡已售出，不能继续出售");
				$("#addButton").attr("disabled",true);
			$("#addButton").css("pointer-events","none");
                          $("#addButton").css("background-color","#bbb7b7");
			}
			else{
				$("#addButton").attr("disabled",false);
			$("#addButton").css("pointer-events","auto");
                          $("#addButton").css("background-color","#337ab7");
			}
			
		}
		//alert(msg);
	},
	error:function(msg){
		alert(msg);
	}
});
});
function addMember(){
	//alert("add member");
var cardID=document.memberForm.memCardID.value;//会员卡号
var memName=document.memberForm.memName.value;
var Sex = $('input:radio[name="radioname"]:checked').val();
var memAddr=document.memberForm.memAddr.value;
var memHealth=document.memberForm.memHealth.value;
var memIdCard=document.memberForm.memIdCard.value;//身份证号
var memTel=document.memberForm.memTel.value;

var time=getTime();
//alert time;
//alert(memSex);
//alert(memName);

$.ajax({
url:"/abcTest/admin.php/Member/add",
type:"POST",
data:{"time":time,"memCardNo":cardID,"name":memName,"sex":Sex,"addr":memAddr,"health":memHealth,"idCard":memIdCard,"tel":memTel},
success:function(msg){
//alert(msg);
window.location.reload();
},
error:function(){
alert("添加失败");
}

});

}

function getTime(){
var time,year,month,date;
time = new Date();
year = time.getFullYear();
	
//以下是通过三元运算对日期进行处理,小于10的数在前面加上0
month = (time.getMonth()+1)<10?("0"+(time.getMonth()+1)):(time.getMonth()+1);
date = time.getDate()<10?("0"+time.getDate()):time.getDate();
/*hours = time.getHours()<10?("0"+time.getHours()):time.getHours();
minutes = (time.getMinutes()<10?("0"+time.getMinutes()):time.getMinutes());
seconds = (time.getSeconds()<10?("0"+time.getSeconds()):time.getSeconds());
*/
//下面操作可以拼成自己想要的日期格式，如：2018-01-15 14:32:57
time = year+"-"+month+"-"+date;
return time;
}
    function doclick(obj) {
        var td = event.srcElement; // 通过event.srcElement 获取激活事件的对象 td 
		var index=td.parentElement.parentElement.rowIndex;
		var tab = document.getElementById("table");
		var row = tab.rows; //获取table的行
		var cell = row[index].cells; //获取第二行的列
		var idNum=cell[0].innerHTML; //会员号
		
        //alert("行号：" + index + "，内容：" + td.innerText);
        
		for(var i=0;i<tab.rows[index].cells.length-2;i++){
		var text = tab.rows[index].cells[i].innerHTML;
		tab.rows[index].cells[i].innerHTML = '<input class="input" name="input'+ index + '" type="text" value="" style="width:100px;"/>';
		var input = document.getElementsByName("input" + index);
		
		input[i].value = text;
		input[0].focus();
		input[0].select();
		}
		obj.innerHTML="确定";

		
		obj.onclick = function onclick(event) {
                          
                
                $.ajax({
                    url: "/abcTest/admin.php/Member/edit",  
                    type: "POST",                    
					//url: "test.php",
					data: {"id":idNum,"name":input[1].value,"sex":input[2].value,"addr":input[3].value,"health":input[4].value,"IDNum":input[5].value,"tel":input[6].value,"date":input[7].value},//前端数据通过ajax传到后端
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