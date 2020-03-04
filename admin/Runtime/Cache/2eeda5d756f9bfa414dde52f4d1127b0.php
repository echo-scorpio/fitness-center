<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
<link rel="stylesheet" href="/abcTest/public/static/bootstrap/css/calendar.css"  type="text/css"/>
        <link rel="stylesheet" href="/abcTest/public/static/bootstrap/css/indexFrame.css" type="text/css" media="screen" />
        <link href="/abcTest/public/static/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        
        <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
        <script src="/abcTest/public/static/bootstrap/js/calendar.js"></script>
        
    </head>
    
     
    
    <body>
        <div class="content">
                            <div class="row">
                            <div class="col-lg-6 searchCon">
                              <div class="input-group searchInputGroup">
                                <input type="text" class="form-control consumeInput" id="memberID" placeholder="请输入会员卡号"/>
                                
                              </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                   <div class="selectBox">     
            <select id="year">
                <option value="0">--请选择--</option>
            </select>年
            <select id="month">
                <option value="0">--请选择--</option>
            </select>月
            <select id="day">
                <option value="0">--请选择--</option>
            </select>日
        </div> 
            <span class="input-group-btn search">
                    <button class="btn btn-default" type="button" onclick="searchMember()">搜索</button>
                  </span>
                </div>
        </div>

<!--表内容-->
<div id="main-content">
<div class="content-box">
          
      
        <div class="content-box-content">
          
            <!-- 表头 -->
            <table id="table" >
              <thead>
                <tr>
                  <th>课程号</th>
                  <th>课程名</th>	 
                  
                  <th>教练</th>

                  <th>上课时间</th>
                  <th>上课地点</th>
                  
                </tr>
              </thead>
                
              <!-- 表内容部分 -->
              <tbody>
                                     
              </tbody>
              
                <!-- 表尾 -->
             
            </table>
          </div>
  </div>
</div>
<!--表内容-->



    <script src="http://echarts.baidu.com/gallery/vendors/echarts/echarts-all-3.js" charset="utf-8" type="text/javascript"></script>
    
           
 
    <script type="text/javascript">

function searchMember(){
            //alert("aaa");
                var id=document.getElementById('memberID').value;
			          var year=document.getElementById("year");
                var month=document.getElementById("month");
                var day=document.getElementById("day");
                var time=year.value+'-'+month.value+'-'+day.value;//年月日
                //alert(time);
                var week=getWeekByDay(time);//周几
                //alert(date);

                $.ajax({
                  url:"/abcTest/admin.php/CountCourse/showCourse",
                  type:"post",
                  data:{"time":time,"week":week,"id":id},
                  //dataType:"json",
                  success:function(msg){
                  
                    if(msg.length==0){
                      alert('不存在相关课程记录');
                    }
                    
                    else{
                      var text=eval("("+msg+")");                   
                      var tbody=$('<tbody></tbody>');
                      for(var i=0;i<text.length;i++){
                        var obj = text[i];//获取数组内每个对象。
                       // alert(obj);
                        var tr=$('<tr></tr>');//courseID,courseName,courseArea,courseTime,courseTeacher
                       
                        tr.append('<td>'+ obj['courseID'] + '</td>');
                        tr.append('<td>'+ obj['courseName'] + '</td>');
                        tr.append('<td>'+ obj['courseTeacher'] + '</td>');
                        tr.append('<td>'+ obj['courseTime'] + '</td>');
                        tr.append('<td>'+ obj['courseArea'] + '</td>');
                        
                        tbody.append(tr);
                       
                      }
                      $('#table tbody').replaceWith(tbody);
                    }
                    
                  }
                });
			
			}
    
   
function getWeekByDay(dayValue){ //dayValue=“2014-01-01”
//return dayValue;
var day = new Date(Date.parse(dayValue.replace(/-/g, '/'))); //将日期值格式化

var today = new Array("周日","周一","周二","周三","周四","周五","周六"); //创建星期数组

console.log(today[day.getDay()])

return today[day.getDay()];  //返一个星期中的某一天，其中0为星期日

}

    
        
    
    </script>
    </body>
    
     
    
    </html>