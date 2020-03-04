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
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript" src="/abcTest/public/static/bootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="/abcTest/public/static/bootstrap/js/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="/abcTest/public/static/bootstrap/js/facebox.js"></script>
<script type="text/javascript" src="/abcTest/public/static/bootstrap/js/jquery.wysiwyg.js"></script>



</head>

<body>
 <div class="headContent">
   <a style="cursor: pointer" onclick="showAllMembers()">
    <div class="allMembers">
    
        <ul>
            <li>全部会员</li>
            <li class="memberNum"><?php echo ($allMembers); ?></li>
            
            
            <li>本健身房会员总数</li>
        </ul>
    </div>
  </a>
  <a style="cursor: pointer" onclick="showNoTimeoutMembers()">
    <div class="unOverTime">
           
        <ul>
            <li>未过期会员</li>
            <li class="memberNum"><?php echo ($noTimeOut); ?></li>
            <li>会员卡未过期会员</li>
        </ul>
    </div>
  </a>
  <a style="cursor: pointer" onclick="showOverTime()">
    <div class="overTiming">
            
        <ul>
            <li>即将到期</li>
            <li class="memberNum"><?php echo ($timedOut); ?></li>
            <li>到期天数<7天的会员</li>
        </ul>
    </div>

 
</a>

<a style="cursor: pointer" onclick="alreadyTimeout()">
    <div class="alreadyOvertime">
            
        <ul>
            <li>已到期</li>
            <li class="memberNum"><?php echo ($alreadyTimeout); ?></li>
            <li>已到期会员</li>
        </ul>
    </div>

 
</a>

 <div class="container">
    <div class="row">       
        <div class="col-lg-6 searchContainer searchMemberBox">
          <div class="input-group searchInputGroup">
            <input type="text" class="form-control consumeInput" id="memberID" placeholder="请输入会员卡号或手机号">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button" onclick="searchMember()">搜索</button>
            </span>
          </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
 </div>

 <!--主题内容部分-->
 <div id="main-content" class="mainDiv">
    <div class="content-box boxContainer">
    
      
      
      <div class="content-box-content">
        
          <!-- 表头 -->
          <table id="table" >
            <thead>
              <tr>
                <th>会员号</th>
				<th>会员名</th>
                <th>手机号</th>
                <th>性别</th>	 
                <th>会员卡号</th>
                <th>会员折扣</th>
				<th>注册时间</th>
                <th>剩余天数</th>
				<th>备注</th>				
               
              </tr>
            </thead>
              
            <!-- 表内容部分 -->
            <tbody>
              <?php if(is_array($memberList)): $i = 0; $__LIST__ = $memberList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr><!--memId,memName,vipCardId,memSex,memTel,memRegisteDate,memRemarks,validTimes,cardDiscount-->
                <td><?php echo ($vo['memId']); ?></td>
                <td><?php echo ($vo['memName']); ?></td>
                <td><?php echo ($vo['memTel']); ?> </td>
				<td><?php echo ($vo['memSex']); ?> </td>
                <td><?php echo ($vo['vipCardId']); ?></td>
                <td><?php echo ($vo['cardDiscount']); ?></td>
                <td><?php echo ($vo['memRegisteDate']); ?></td>                	
                <td><?php echo ($vo['memRemarks']); ?> </td>	
        <td><button onclick="doclick(this)" id="edit">选课</button>
          <button onclick="pay(this)" id="edit">缴费</button>
        </td>
        
               
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>                        
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

        

        <!--选择课程模态框-->
        <div class="modal fade" id="courseModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content cModel">
                        <div class="modal-header">
                            
                            <h4 class="modal-title" id="myModalLabel">
                                选择课程
                            </h4>
                        </div>
                        <div class="modal-body" id="introModalBody">
                                <div class="content-box-content">
        
                                        <!-- 表头 -->
                                        <table id="courseTable" >
                                          <thead>
                                            <tr>
                                              <th>课程号</th>
                                              <th>课程名</th>
                                              <th>上课时间</th>
                                              <th>上课地点</th>
                                              <th>教练</th>
                                              <th>课程原价</th>
                                              <th>选项</th>
                                              
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
                                              <td><a onclick="chooseCourse(this)" id="edit" style="cursor: pointer">选择</a></td>
                    
                                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>                        
                                          </tbody>

                                        </table>
                                      </div>
                        </div>
            
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                            </button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal -->
            </div>
        <!--选择课程模态框-->
</div>
 <!--主体部分结束-->
	<script language="javascript">
   function showAllMembers(){
     $.ajax({
       url:"/abcTest/admin.php/Consume/allMembers",
       type:"post",
       data:{},
       success:function(data){
        var test=eval("("+data+")");//转化为{object,object的形式}
                  // alert (text);
                    var tbody=$('<tbody></tbody>');
                    for(var i=0;i<test.length;i++){
                        var obj = test[i];//获取数组内每个对象。
                        //alert(obj);
                        var tr=$('<tr></tr>');
                        tr.append('<td id="mID">'+ obj['memId'] + '</td>');
                        tr.append('<td>'+ obj['memName'] + '</td>');
                        tr.append('<td>'+ obj['memTel'] + '</td>');
                        tr.append('<td>'+ obj['memSex'] + '</td>');
                        tr.append('<td id="cardId">'+ obj['vipCardId'] + '</td>');
                        tr.append('<td id="cardDiscount">'+ obj['cardDiscount'] + '</td>');
                        tr.append('<td>'+ obj['memRegisteDate'] + '</td>');                       
                        tr.append('<td>'+obj['validTimes']+'</td>');
                        tr.append('<td id="remarks">'+ obj['memRemarks'] + '</td>');
                        
                        tbody.append(tr);
                    
                        
                        }
                        $('#table tbody').replaceWith(tbody);
                        
       },
       error:function(){
         alert("用户信息检索失败！");
       }
     });
     
   }
   function showNoTimeoutMembers(){
     //alert("noTimeOut");
     $.ajax({
       url:"/abcTest/admin.php/Consume/noTimeoutMem",
       type:"post",
       data:{},
       success:function(data){
        var test=eval("("+data+")");//转化为{object,object的形式}
                  // alert (text);
                    var tbody=$('<tbody></tbody>');
                    for(var i=0;i<test.length;i++){
                        var obj = test[i];//获取数组内每个对象。
                        //alert(obj);
                        var tr=$('<tr></tr>');
                        tr.append('<td id="mID">'+ obj['memId'] + '</td>');
                        tr.append('<td>'+ obj['memName'] + '</td>');
                        tr.append('<td>'+ obj['memTel'] + '</td>');
                        tr.append('<td>'+ obj['memSex'] + '</td>');
                        tr.append('<td id="cardId">'+ obj['vipCardId'] + '</td>');
                        tr.append('<td id="cardDiscount">'+ obj['cardDiscount'] + '</td>');
                        tr.append('<td>'+ obj['memRegisteDate'] + '</td>');                       
                        tr.append('<td>'+obj['validTimes']+'</td>');
                        tr.append('<td id="remarks">'+ obj['memRemarks'] + '</td>');
                        
                        tbody.append(tr);
                        
                        }
                        $('#table tbody').replaceWith(tbody);
                   
       },
       error:function(){
         alert("用户信息检索失败！");
       }
     });
   }
   function showOverTime(){
     //alert("showOverTime");
     $.ajax({
       url:"/abcTest/admin.php/Consume/overTime",
       type:"post",
       data:{},
       success:function(data){
        var test=eval("("+data+")");//转化为{object,object的形式}
                  // alert (text);
                    var tbody=$('<tbody></tbody>');
                    for(var i=0;i<test.length;i++){
                        var obj = test[i];//获取数组内每个对象。
                        //alert(obj);
                        var tr=$('<tr></tr>');
                        tr.append('<td id="mID">'+ obj['memId'] + '</td>');
                        tr.append('<td>'+ obj['memName'] + '</td>');
                        tr.append('<td>'+ obj['memTel'] + '</td>');
                        tr.append('<td>'+ obj['memSex'] + '</td>');
                        tr.append('<td id="cardId">'+ obj['vipCardId'] + '</td>');
                        tr.append('<td id="cardDiscount">'+ obj['cardDiscount'] + '</td>');
                        tr.append('<td>'+ obj['memRegisteDate'] + '</td>');                       
                        tr.append('<td>'+obj['validTimes']+'</td>');
                        tr.append('<td id="remarks">'+ obj['memRemarks'] + '</td>');
                        
                        tbody.append(tr);
                        
                        }
                        $('#table tbody').replaceWith(tbody);
                   
       },
       error:function(){
         alert("用户信息检索失败！");
       }
     });
   }
   function alreadyTimeout(){
    $.ajax({
       url:"/abcTest/admin.php/Consume/alreadyOvertime",
       type:"post",
       data:{},
       success:function(data){
        var test=eval("("+data+")");//转化为{object,object的形式}
                  // alert (text);
                    var tbody=$('<tbody></tbody>');
                    for(var i=0;i<test.length;i++){
                        var obj = test[i];//获取数组内每个对象。
                        //alert(obj);
                        var tr=$('<tr></tr>');
                        tr.append('<td id="mID">'+ obj['memId'] + '</td>');
                        tr.append('<td>'+ obj['memName'] + '</td>');
                        tr.append('<td>'+ obj['memTel'] + '</td>');
                        tr.append('<td>'+ obj['memSex'] + '</td>');
                        tr.append('<td id="cardId">'+ obj['vipCardId'] + '</td>');
                        tr.append('<td id="cardDiscount">'+ obj['cardDiscount'] + '</td>');
                        tr.append('<td>'+ obj['memRegisteDate'] + '</td>');                       
                        tr.append('<td>'+obj['validTimes']+'</td>');
                        tr.append('<td id="remarks">'+ obj['memRemarks'] + '</td>');
                        
                        tbody.append(tr);
                        
                        }
                        $('#table tbody').replaceWith(tbody);
                   
       },
       error:function(){
         alert("用户信息检索失败！");
       }
     });
   }
        function searchMember(){
          //alert("搜索");
            var id=document.getElementById("memberID");
            var text=id.value;
            var voList=document.getElementById("test");
            $.ajax({
                url:"/abcTest/admin.php/Consume/search",
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
                        //alert(obj);
                        var tr=$('<tr></tr>');
                        tr.append('<td id="mID">'+ obj['memId'] + '</td>');
                        tr.append('<td>'+ obj['memName'] + '</td>');
                        tr.append('<td>'+ obj['memTel'] + '</td>');
                        tr.append('<td>'+ obj['memSex'] + '</td>');
                        tr.append('<td id="cardId">'+ obj['vipCardId'] + '</td>');
                        tr.append('<td id="cardDiscount">'+ obj['cardDiscount'] + '</td>');
                        tr.append('<td>'+ obj['memRegisteDate'] + '</td>');                       
                        tr.append('<td>'+obj['validTimes']+'</td>');
                        tr.append('<td id="remarks">'+ obj['memRemarks'] + '</td>');
                        tr.append('<td>'+ '<a onclick="choose()"  style="cursor:pointer" id="chooseCourse">'+'选课'+'</a>' + '</td>');
                        
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
        function choose(){
          var remark=document.getElementById('remarks').innerHTML;
          switch (remark){
            case '已转卡':
                alert("已转卡，不能消费");
                break;
            case '已请假':
                alert("已请假，不能消费");
                break;
            case '已到期':alert("已到期，不能消费");
                break;
            case '':
          
            $("#chooseCourse").attr("data-toggle","modal");
                                    $("#chooseCourse").attr("data-target","#courseModal");
                                   //$("#courseModal").modal('hide');
          
        }
      
        }
    function chooseCourse(obj){
//alert("aaaaaaaaaaaaa");
      
        var userID=document.getElementById('mID').innerHTML;
        var td = event.srcElement; // 通过event.srcElement 获取激活事件的对象 td 
		var index=td.parentElement.parentElement.rowIndex;		
		var tab = document.getElementById("courseTable");
    var discount=document.getElementById("cardDiscount").innerHTML;
    
		var row = tab.rows; //获取table的行
		var cell = row[index].cells; 
		var courseID=cell[0].innerHTML; 
    var price=cell[5].innerHTML;
    var courseName=cell[1].innerHTML;
    var realPrice=discount*price; 
        
    if (confirm('课程名:'+courseName+'\n\n折后价格:'+realPrice+'\n\n是否确认选择？')) {  
          var consumeTime=getTime();
        var cardId=document.getElementById('cardId').innerHTML;
        //alert(discount+cardId+userID+courseID+realPrice);
        $.ajax({
          
            url:"/abcTest/admin.php/Consume/chooseCourse",
            type:"POST",
            data:{"userID":userID,"courseID":courseID,"price":realPrice,"consumeTime":consumeTime},
            success:function(msg){
              
              var text = msg.split("<")[0];
                alert (text);
                //window.location.reload();
            },
            error:function(){
                alert("选课失败");
            }
        });
        }  
        
        else {  
            //alert("点击了取消");  
        }  
  
       
        //alert(courseID);
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