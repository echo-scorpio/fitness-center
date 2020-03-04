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
            <input type="text" class="form-control consumeInput" id="memberID" placeholder="请输入会员卡号或手机号"/>
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
	<script language="javascript">
   
   function searchMember(){
          //alert("搜索");
            var id=document.getElementById("memberID");
            var text=id.value;
            var voList=document.getElementById("test");
            $.ajax({
                url:"/abcTest/admin.php/Leave/search",
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
                        tr.append('<td>'+ '<a onclick="leave()" style="cursor:pointer" id="leave">'+'请假'+'</a>' + '</td>');
                        tbody.append(tr);
                       
                        
                        }
                        $('#table tbody').replaceWith(tbody);
                        var remark=document.getElementById("remarks").innerHTML;
                        if(remark=="已请假"){
                          $("#leave").css("pointer-events","none");
                          $("#leave").css("color","#bbb7b7");
                        }
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
        function leave(){
          var id=document.getElementById('memberId').innerHTML;
          var time=getTime();
          var butt=document.getElementById("leave");
         
          var remark=document.getElementById('remarks');
          switch (remark.innerHTML){
            case '已转卡':
                alert("已转卡，不能请假");
                break;
            case '已请假':
                alert("已请假，不能请假");
                break;
            case '已到期':alert("已到期，不能请假");
                break;
            case '':
          
          //alert(time+2000);
          $.ajax({
            url:"/abcTest/admin.php/Leave/leave",
            type:"POST",
            data:{"id":id,"time":time},
            dataType:"json",
            success:function(msg){
              if(msg!=''){
              alert("请假成功！");
             $("#leave").css("pointer-events","none");//将a标签禁用
             $("#leave").css("color","#bbb7b7");
             /*局部刷新页面!!!!!!!!!*/
             var data='';
             data = eval("("+msg+")");
             remark.innerHTML=data.remarks;

             /*点击请假一天后恢复可以正常状态，服务器一直开，单位为毫秒*/
             setTimeout(returnClass,86400000);
            }
            },
            error:function(){
              alert("请假失败！");
            }
          });
        }
        }
        function returnClass(){
          var id=document.getElementById('memberId').innerHTML;
          $.ajax({
            url:"/abcTest/admin.php/Leave/returnClass",
            type:"POST",
            data:{"id":id},
            success:function(msg){
              //alert(msg);
             //alert("aaaaaaaaaaa");
             $("#leave").css("pointer-events","auto");
             $("#leave").css("color","#337ab7");
             
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
        return time;

    }
    </script>
	</body>
<!-- Download From www.exet.tk-->
</html>