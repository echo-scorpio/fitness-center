<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($title); ?></title>

<link href="/abcTest/public/static/bootstrap/css/bootstrap.min.css" rel="stylesheet">


<link rel="stylesheet" href="/abcTest/public/static/bootstrap/css/indexFrame.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/abcTest/public/static/bootstrap/css/invalid.css" type="text/css" media="screen" />

         <script type="text/javascript" src="/abcTest/public/static/bootstrap/js/jquery.min.js"></script>
            <script type="text/javascript" src="/abcTest/public/static/bootstrap/js/bootstrap.min.js"></script>
	
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>


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
                <th>会员卡号</th>
                <th>会员卡名称</th>	 
                <th>有效天数</th>
				<th>售价</th>
                <th>消费折扣</th>
				<th>使用时间段</th>			
                <th>选项</th>
              </tr>
            </thead>
              
            <!-- 表内容部分 -->
            <tbody>
              <?php if(is_array($cardList)): $i = 0; $__LIST__ = $cardList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                
                <td><?php echo ($vo['cardID']); ?></td>
                <td><?php echo ($vo['cardName']); ?> </td>
				<td><?php echo ($vo['validTimes']); ?> </td>
                <td><?php echo ($vo['cardPrice']); ?></td>
                <td><?php echo ($vo['cardDiscount']); ?></td>
                <td><?php echo ($vo['startTime']); ?>-<?php echo ($vo['endTime']); ?> </td>
				
				
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

<!-- 模态框  -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				
				<h4 class="modal-title" id="myModalLabel">
					添加会员卡
				</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" method="post" name="cardForm">
				  
				  
				  <div class="form-group">
					<label for="inputText" class="col-sm-2 control-label">会员卡名称</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" name="cardName" placeholder="会员卡名称">
					</div>					
				  </div>
				  
				  <div class="form-group">
					<label for="inputText" class="col-sm-2 control-label">有效天数</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" name="validTimes" placeholder="有效天数">
					</div>					
				  </div>
				  
				   <div class="form-group">
					<label for="inputText" class="col-sm-2 control-label">售价</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" name="cardPrice" placeholder="售价">
					</div>					
				  </div>
				  
				   <div class="form-group">
					<label for="inputText" class="col-sm-2 control-label">消费折扣</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" name="cardDiscount" placeholder="消费折扣">
					</div>					
				  </div>
				  
				   <div class="form-group">
					<label for="inputText" class="col-sm-2 control-label">每天使用开始时间</label>
					
							
							<select class="timeSelect" id="startTime" onchange="getStartTime()">
									<option value="">开始时间</option>
									<option value="08:00:00">08:00:00</option>
									<option value="09:00:00">09:00:00</option>
									<option value="10:00:00">10:00:00</option>
								  </select>
								  
							
				  </div>
				  
				   <div class="form-group">
					<label for="inputText" class="col-sm-2 control-label">每天使用截止时间</label>
					<div class="col-sm-10">
							<select class="timeSelect" id="endTime" onchange="getEndTime()">
									<option value="">截止时间</option>
									<option value="20:00:00">20:00:00</option>
									<option value="21:00:00">21:00:00</option>
									<option value="22:00:00">22:00:00</option>
								  </select>
					</div>					
				  </div>
				  
				  
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭
				</button>
				<button type="button" class="btn btn-primary" onclick="addCard()">
					添加
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal -->
</div>
</div>
<script language="javascript">
function getStartTime(){
	var selItem=document.getElementById('startTime');
	var time = selItem.options[selItem.selectedIndex].value;
    return time;
}
function getEndTime(){
	var selItem=document.getElementById('endTime');
	var time = selItem.options[selItem.selectedIndex].value;
    return time;
}

function addCard(){
var name=document.cardForm.cardName.value;
var time=document.cardForm.validTimes.value;
var price=document.cardForm.cardPrice.value;
var discount=document.cardForm.cardDiscount.value;
var startTime=getStartTime();
var endTime=getEndTime();
$.ajax({
url:"/abcTest/admin.php/Card/add",
type:"POST",
data:{"name":name,"time":time,"price":price,"discount":discount,"startTime":startTime,"endTime":endTime},
success:function(msg){
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
		var idNum=cell[0].innerHTML; //获取会员卡号
		
		//alert(times[0]);
		for(var i=0;i<tab.rows[index].cells.length-2;i++){
		var text = tab.rows[index].cells[i].innerHTML;
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
                          
			var Time=input[5].value;
			var times=Time.split('-');
                $.ajax({
                    url: "/abcTest/admin.php/Card/edit",  
                    type: "POST",                    
					data: {"id":idNum,"name":input[1].value,"validTimes":input[2].value,
					"price":input[3].value,"discount":input[4].value,"startTime":times[0],
					"endTime":times[1]},//前端数据通过ajax传到后端
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