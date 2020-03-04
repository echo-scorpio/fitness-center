<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($title); ?></title>

<link href="/abcTest/public/static/bootstrap/css/bootstrap.min.css" rel="stylesheet">


<link rel="stylesheet" href="/abcTest/public/static/bootstrap/css/indexFrame.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/abcTest/public/static/bootstrap/css/invalid.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/abcTest/public/static/bootstrap/css/consume.css" type="text/css" media="screen"/>
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
  <div class="placeHolder"> </div>
 <div class="container">
    <div class="row">    
        <div class="col-lg-6 searchContainer">
          <div class="input-group searchInputGroup">
            <input type="text" class="form-control consumeInput" id="memberID" placeholder="请输入会员卡号"/>
            <span class="input-group-btn">
              <button class="btn btn-default" type="button" onclick="searchMember()">搜索</button>
            </span>
          </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
 </div>


 <!--主题内容部分-->
 <div id="main-content">
  <div class="content-box boxContainer">
  
    
    
    <div class="content-box-content">
      
        <!-- 表头 -->
        <table id="table" >
          <thead>
            <tr>
              <th>会员号</th>
              <th>会员名</th>
              <th>会员卡号</th>
              <th>性别</th>              
              <th>联系方式</th>	              
              <th>健康情况</th>
              <th>备注</th>
              
              <th>选项</th>
            </tr>
          </thead>
            
          <!-- 表内容部分 -->
          <tbody>
            
          </tbody>
          
            <!-- 表尾 -->
          <tfoot>
            <tr>
              <td colspan="6">
                  <div id="test"></div>
         
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
</div>

 <!--主体部分结束-->

 <!--转卡给新会员  -->
<!-- 模态框  -->
<div class="modal fade" id="newMemberModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				
				<h4 class="modal-title" id="myModalLabel">
					转卡给新会员
				</h4>
			</div>
			<div class="modal-body" id="inputContainer">
				<form class="form-horizontal" method="post" name="memberForm">
				  
				  
				  
				  <div class="form-group">
					<label for="inputText" class="col-sm-2 control-label">姓名</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" name="memName" placeholder="姓名">
					</div>					
				  </div>
				  
				  <div class="form-group">
					<label for="inputText" class="col-sm-2 control-label">性别</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" name="memSex" placeholder="性别">
					</div>					
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
				<button type="button" class="btn btn-primary" onclick="transToNewMember()">
					转卡
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal -->
</div>
<!--转卡给新会员-->

<!--转卡给已有会员-->
<div class="modal fade" id="oldMemberModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				
				<h4 class="modal-title" id="myModalLabel">
					转卡给已有会员
				</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" method="post" name="oldMemberForm">
				  
				  
				  
				  <div class="form-group">
            <div class="row">    
              <div class="col-lg-6 searchContainer">
                <div class="input-group transferInput">
                  <input type="text" class="form-control consumeInput" id="memberID" placeholder="请输入会员卡号"/>
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button" onclick="searchOldMem()">搜索</button>
                  </span>
                </div><!-- /input-group -->
              </div><!-- /.col-lg-6 -->
            </div>
          </div>
          <ul class="list-group">
            <li class="list-group-item" id="memNameLi">姓名</li>
            <li class="list-group-item" ID="memIdCardLi">会员卡号</li>
            <li class="list-group-item" id="memSexLi">性别</li>
            <li class="list-group-item" id="memAddrLi">家庭住址</li>
            <li class="list-group-item" id="memTelLi">联系方式</li>
          </ul>
				
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭
				</button>
				<button type="button" class="btn btn-primary" onclick="transToOldMember()">
					转卡
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal -->
</div>
<!--转卡给已有会员-->

	<script language="javascript">
    function searchOldMem(){
      var oldMemId=document.oldMemberForm.memberID.value;
      //alert(oldMemId);
      $.ajax({
        url:"/abcTest/admin.php/Transfer/searchOldMem",
        type:"post",
        data:{"memId":oldMemId},
        success:function(msg){
          
          var data=eval("("+msg+")");
          var ul=$('<ul></ul>');
          for(var i=0;i<data.length;i++){
            var obj=data[i];
            var li=$('<li></li>');//memName,vipCardId,memTel,memSex
            $('#memNameLi').append('\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0'+obj['memName']);
            $('#memIdCardLi').append("\xa0\xa0\xa0\xa0\xa0\xa0\xa0"+obj['vipCardId']);
            $('#memSexLi').append("\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0"+obj['memSex']);
            $('#memAddrLi').append("\xa0\xa0\xa0\xa0\xa0\xa0\xa0"+obj['memAddr']);
            $('#memTelLi').append("\xa0\xa0\xa0\xa0\xa0\xa0\xa0"+obj['memTel']);
          }
          
          
        },
        error:function(){
          alert("error");
        }
      });
    }
    function transToOldMember(){
      var memId=document.getElementById('memberId').innerHTML; 
      var oldMemId=document.oldMemberForm.memberID.value;//要转给的会员号
      var memTel=document.getElementById("memTelLi").innerText;//要转给的手机号
      var cardid=document.getElementById('cardId').innerHTML;
      var remark=document.getElementById("remarks");
    

    var reg=/\d+/g;//正则表达式提取出手机号
    var tel=memTel.match(reg);
    var detailTime=getTime().time;
    //alert(t);
    $.ajax({
      url:"/abcTest/admin.php/Transfer/toOldMem",
      type:"post",
      data:{
        "memId":memId,
        "oldMemId":oldMemId,
        "tel":tel,
        "time":detailTime,
        "cardId":cardid
      },
      dataType:"json",
      success:function(msg){
        alert("转卡成功！");
        /*局部刷新数据*/
        var data='';
        data=eval("("+msg+")");
        //alert(data.remarks);
        remark.innerHTML=data.remarks;
      },
      error:function(){
        alert("转卡失败!");
      }
    });
      
    }
   function transToNewMember(){
    
        var memId=document.getElementById('memberId').innerHTML; //要转卡的 会员号    
        var cardid=document.getElementById('cardId').innerHTML;//卡号
        var memName=document.memberForm.memName.value;
        var memSex=document.memberForm.memSex.value;
        var memAddr=document.memberForm.memAddr.value;
        var memHealth=document.memberForm.memHealth.value;
        var memIdCard=document.memberForm.memIdCard.value;//身份证号
        var memTel=document.memberForm.memTel.value;//要转给的手机号
        var remark=document.getElementById("remarks");
       
        //alert(memTel);
        var time=getTime().day;
        var detailTime=getTime().time;

        $.ajax({
        url:"/abcTest/admin.php/Transfer/toNewMember",
        type:"POST",
        data:{"detailTime":detailTime,"memId":memId,"time":time,"memCardNo":cardid,"name":memName,"sex":memSex,"addr":memAddr,"health":memHealth,"idCard":memIdCard,"tel":memTel},
        dataType:"json",
        success:function(msg){
        alert("转卡成功！");
        /*局部刷新数据*/
        var data='';
        data=eval("("+msg+")");
        //alert(data.remarks);
        remark.innerHTML=data.remarks;
        },
        error:function(msg){
        alert(msg);
        }

        });
      
   }
  
   function check(status){
            var cardId=document.getElementById('cardId');
            var remark=document.getElementById('remarks').innerHTML;
            switch (remark){
            case '已转卡':
                alert("已转卡，不能转卡");
                break;
            case '已请假':
                alert("已请假，不能转卡");
                break;
            case '已到期':alert("已到期，不能转卡");
                break;
            case '':
            if(status=="1"){
                                       
                  $("#newMem").attr("data-toggle","modal");
                  $("#newMem").attr("data-target","#newMemberModal");
                        }
                  else{
                                       
                  $("#oldMember").attr("data-toggle","modal");
                  $("#oldMember").attr("data-target","#oldMemberModal");
                  }
                                  
                                      
                                  }
                               }                  
                                  
   
            
   function searchMember(){
          //alert("搜索");
            var id=document.getElementById("memberID");
            var text=id.value;
            var voList=document.getElementById("test");
            $.ajax({
                url:"/abcTest/admin.php/Transfer/search",
                //dataType:"json",
                type:"POST",
                async:false,
                
                
                data:{"id":text},
                success:function(data){
                  if(data=='未查询到用户信息'){
                    alert(data);
                  }
                  else{
                    //alert (data);
                    //var text = data.split("<")[0];//返回值会带着<html>要用split把它分隔开
                        var test=eval("("+data+")");//转化为{object,object的形式}
                  // alert (text);
                    var tbody=$('<tbody></tbody>');
                   
                    for(var i=0;i<test.length;i++){
                      var obj = test[i];//获取数组内每个对象。
                       // alert(obj);
                        var tr=$('<tr></tr>');//memId,memName,vipCardId,memTel,memSex,memHealth,memRemarks
                       
                        tr.append('<td id="memberId">'+ obj['memId'] + '</td>');
                        tr.append('<td>'+ obj['memName'] + '</td>');
                        tr.append('<td  id="cardId">'+ obj['vipCardId'] + '</td>');
                        tr.append('<td>'+ obj['memSex'] + '</td>');
                        tr.append('<td>'+ obj['memTel'] + '</td>');
                        tr.append('<td>'+ obj['memHealth'] + '</td>');
                        tr.append('<td id="remarks">'+ obj['memRemarks'] + '</td>');
                        
                        tr.append('<td>'+ '<a id="newMem"  onclick="check(1)" style="cursor:pointer">'+'转卡给新会员'+'</a>'+ '\t'+'|'+'\t'+'<a onclick="check(2)" style="cursor:pointer" id="oldMember">'+'转卡给已有会员'+'</a>' + '</td>');
                        
                        tbody.append(tr);
                       
                        
                        }
                        $('#table tbody').replaceWith(tbody);
                        var remark=document.getElementById('remarks');
                        var cardId=document.getElementById("cardId");
                        if(remark.innerHTML=='已转卡'){
                            cardId.innerHTML='';
                            
                        }
                        
                  }
                  
                },
                error:function(){
                    alert("error");
                }
            });
        }
        
    
        function getTime(){
        var time,year,month,day,hours,minute,second;
        time=new Date();
        year=time.getFullYear();
        month = (time.getMonth()+1)<10?("0"+(time.getMonth()+1)):(time.getMonth()+1);
        date = time.getDate()<10?("0"+time.getDate()):time.getDate();
        hours = time.getHours()<10?("0"+time.getHours()):time.getHours();
        minutes = (time.getMinutes()<10?("0"+time.getMinutes()):time.getMinutes());
        seconds = (time.getSeconds()<10?("0"+time.getSeconds()):time.getSeconds());

        time = year+"-"+month+"-"+date+" "+hours+":"+minutes+":"+seconds;
        day=year+"-"+month+"-"+date;
        return {'time':time,'day':day};

    }

    </script>
	</body>
<!-- Download From www.exet.tk-->
</html>