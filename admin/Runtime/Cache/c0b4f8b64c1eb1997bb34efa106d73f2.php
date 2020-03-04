<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($title); ?></title>

<link href="/abcTest/public/static/bootstrap/css/bootstrap.min.css" rel="stylesheet">


<link rel="stylesheet" href="/abcTest/public/static/bootstrap/css/indexFrame.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/abcTest/public/static/bootstrap/css/invalid.css" type="text/css" media="screen" />

<script src="/abcTest/public/static/bootstrap/js/bootstrap.min.js"></script>
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
				<th>教练号</th>
                <th>姓名</th>
                <th>性别</th>	 
                <th>身份证号</th>
				<th>民族</th>
                <th>政治面貌</th>
				<th>学历</th>
                <th>联系方式</th>
                <th>职位</th>	
				<th>毕业学校</th>
          				
                <th>选项</th>
              </tr>
            </thead>
              
            <!-- 表内容部分 -->
            <tbody>
              <?php if(is_array($coachList)): $i = 0; $__LIST__ = $coachList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($vo['coaID']); ?></td>
                <td><?php echo ($vo['coaName']); ?></td>
                <td><?php echo ($vo['coaSex']); ?> </td>
				<td><?php echo ($vo['coaIdCardNo']); ?> </td>
                <td><?php echo ($vo['coaNation']); ?></td>
                <td><?php echo ($vo['coaPolitic']); ?></td>
                <td><?php echo ($vo['coaEducation']); ?> </td>
				<td><?php echo ($vo['coaTel']); ?> </td>
				<td><?php echo ($vo['coaPosition']); ?></td>
                <td><?php echo ($vo['coaSchool']); ?> </td>
				
				<td><button onclick="doclick(this)" id="edit">编辑</button></td>
               <td><a href="/abcTest/admin.php/Coach/del/id/<?php echo ($vo['coaIdCardNo']); ?>" title="删除"><img src="/abcTest/public/Images/icons/cross.png" alt="删除" /></a></td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>                        
            </tbody>
            
              <!-- 表尾 -->
            <tfoot>
              <tr>
                <td colspan="6">
                     <button data-toggle="modal" data-target="#myModal"  id="addButton">添加教练</button>
					 
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
				
				<h4 class="modal-title" id="myModalLabel">
					添加教练
				</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" method="post" name="coachForm">
				  
				  
				  <div class="form-group">
					<label for="inputText" class="col-sm-2 control-label">姓名</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" name="coaName" placeholder="姓名">
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
					<label for="inputText" class="col-sm-2 control-label">身份证号</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" name="coaIdCardNo" placeholder="身份证号">
					</div>					
				  </div>
				  
				   <div class="form-group">
					<label for="inputText" class="col-sm-2 control-label">民族</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" name="coaNation" placeholder="民族">
					</div>					
				  </div>
				  
				   <div class="form-group">
					<label for="inputText" class="col-sm-2 control-label">政治面貌</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" name="coaPolitic" placeholder="政治面貌">
					</div>					
				  </div>
				  
				   <div class="form-group">
					<label for="inputText" class="col-sm-2 control-label">学历</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" name="coaEducation" placeholder="学历">
					</div>					
				  </div>
				  
				   <div class="form-group">
					<label for="inputText" class="col-sm-2 control-label">联系方式</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" name="coaTel" placeholder="联系方式">
					</div>					
				  </div>
				  				   <div class="form-group">
					<label for="inputText" class="col-sm-2 control-label">职位</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" name="coaPosition" placeholder="职位">
					</div>					
				  </div>
				  
				   <div class="form-group">
					<label for="inputText" class="col-sm-2 control-label">毕业院校</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" name="coaSchool" placeholder="毕业院校">
					</div>					
				  </div>
				  
				   
				  
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭
				</button>
				<button type="button" class="btn btn-primary" onclick="addCoach()">
					添加
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal -->
</div>
</div>
<script language="javascript">
function addCoach(){
	
var Sex = $('input:radio[name="radioname"]:checked').val();
//alert(radioValue);

var name=document.coachForm.coaName.value;
//var Sex=document.coachForm.coaSex.value;
var IdCardNo=document.coachForm.coaIdCardNo.value;
var nation=document.coachForm.coaNation.value;
var politic=document.coachForm.coaPolitic.value;//政治面貌
var education=document.coachForm.coaEducation.value;
var tel=document.coachForm.coaTel.value;
var position=document.coachForm.coaPosition.value;//职位
var school=document.coachForm.coaSchool.value;


$.ajax({
url:"/abcTest/admin.php/Coach/add",
type:"POST",
data:{"name":name,"sex":Sex,"idCardNo":IdCardNo,"nation":nation,"politic":politic,"education":education,"tel":tel,"position":position,"school":school},
success:function(msg){
//alert(msg);
window.location.reload();
},
error:function(){
alert("添加失败");
}

});

}

    function doclick(obj) {
        var td = event.srcElement; // 通过event.srcElement 获取激活事件的对象 td 
		var index=td.parentElement.parentElement.rowIndex;
		var tab = document.getElementById("table");
		var row = tab.rows; //获取table的行
		var cell = row[index].cells; 
		var idNum=cell[3].innerHTML; //获取身份证号
		//alert(idNum);
        //alert("行号：" + index + "，内容：" + td.innerText);
        
		for(var i=0;i<tab.rows[index].cells.length-2;i++){
		var text = tab.rows[index].cells[i].innerHTML;
		tab.rows[index].cells[i].innerHTML = '<input class="input" name="input'+ index + '" type="text" value="" style="width:70px;"/>';
		var input = document.getElementsByName("input" + index);
		
		input[i].value = text;
		input[0].focus();
		input[0].select();
		}
		obj.innerHTML="确定";

		
		obj.onclick = function onclick(event) {
                          
                
                $.ajax({
                    url: "/abcTest/admin.php/Coach/edit",  
                    type: "POST",                    
					data: {"idCardNum":idNum,"name":input[1].value,"sex":input[2].value,
					"newIdCardNo":input[3].value,"nation":input[4].value,"politic":input[5].value,
					"education":input[6].value,"tel":input[7].value,"position":input[8].value,
					"school":input[9].value},//前端数据通过ajax传到后端
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