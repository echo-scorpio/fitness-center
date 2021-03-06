<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
        
        <link rel="stylesheet" href="/abcTest/public/static/bootstrap/css/indexFrame.css" type="text/css" media="screen" />
        <link href="/abcTest/public/static/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="/abcTest/public/static/bootstrap/js/jquery.min.js"></script>
        <script src="/abcTest/public/static/bootstrap/js/calendar.js"></script>
		<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
    </head>
    
     
    
    <body>
       
    <script src="/abcTest/public/static/bootstrap/js/echarts-all-3.js" charset="utf-8" type="text/javascript"></script>
    
    <div class="content">
        <div class="row">
    
<div class="selectBox sel">  
       
<select id="year">
<option value="0">--请选择--</option>
</select>年
<select id="month">
<option value="0">--请选择--</option>
</select>月
<select id="day" style="display: none">
    <option value="0">--请选择--</option>
</select>
</div> 
<span class="input-group-btn search">
<button class="btn btn-default" type="button" onclick="searchConsume()">搜索</button>
</span>
</div>
</div>
    <div id="main" style="height:450px;width:500px;float: left;"></div>
    <div class="searchBox" data-toggle="modal" data-target="#newMemberModal">
        <div class="col-lg-6 chartContainer">
            <div class="input-group searchInputGroup searchMem">
              <input type="text" class="form-control consumeInput" id="memberID" placeholder="请输入会员号"/>
              <span class="input-group-btn">
                <button class="btn btn-default" type="button" onclick="searchMember()">搜索</button>
              </span>
            </div>
          </div>
          <div id="preference" style="height:400px;width:450px;">
      
        </div>
        <div id="showDetail"></div>
        <div id="memInfo">
                <ul class="list-group" id="memUl">
                        <li class="list-group-item" id="cName">会员号</li>
                        <li class="list-group-item" ID="cPrice">姓名</li>
                        <li class="list-group-item" id="cDate">会员卡号</li>
                        
                      </ul>
        </div>
       
    </div>
 
 
    <script type="text/javascript">
    //根据用户查询每个用户的消费情况
    function userFun(){
        //alert("user");
        var id=document.getElementById("memberID").value;
        var chart = echarts.init(document.getElementById("preference"));    
     var data1=[];
     var data2=[];
     var array=[];
        $.ajax({
            url:"/abcTest/admin.php/CountConsume/showUser",
            type:"post",
            data:{"id":id},
            dataType:"JSON",
            success:function(data){
                if(data.length>0){
                for(var i=0;i<data.length;i++){

data1.push(data[i]['TIME']);data2.push(data[i]['SUM( price )']);                          
}

var option = {

color : [ '#3398DB' ],

title : {

 text : '个人消费情况统计', //主标题文本，支持使用 \n 换行。

 link : '', //主标题文本超链接

 textStyle : { //该属性用来定义主题文字的颜色、形状等

     color : '#3398DB',

 }

},

tooltip : {

 trigger : 'axis',

 axisPointer : { // 坐标轴指示器，坐标轴触发有效

     type : 'shadow' // 默认为直线，可选为：'line' | 'shadow'

 }

},

grid : {

 left : '6%',

 right : '20%',

 bottom : '20%',

 containLabel : true

},

xAxis : [ { //x轴列表展示

 type : 'category',

 data : data1,

} ],

yAxis : [ { //定义y轴刻度

 type : 'value',

 scale : true,

 name : '消费金额',

 max : 2000,

 min : 0,

} ],

series : [ {

 name : '消费',

 type : 'bar', //bar 柱状图     line 折线图 等

 barWidth : '30%', //柱的宽度

 data : data2

} ]

};

chart.setOption(option);
chart.on('click', function (params) {
 //alert(params.name);//name是横坐标，

 var date=params.name;
 var id=document.getElementById("memberID").value;
 var circle = echarts.init(document.getElementById("showDetail"));

 
 var itemArray=[];

 $.ajax({
     url:"/abcTest/admin.php/CountConsume/info",
     type:"post",
     data:{"date":date,"userId":id},
     success:function(msg){
         var data=eval("("+msg+")");
         /*点击柱状图以后以饼状图的形式详细展示消费情况：消费时间，课程名，课程价格*/
         for(var i=0;i<data.length;i++){                                   
                 var item={};                                  
                 item.name=data[i]['courseName'];
                 item.value=data[i]['price'];
                 itemArray.push(item);
                 
         }
         //alert(itemArray[0].name);
     var option =  {

                             tooltip : {
         trigger: 'item',
         formatter: "{a} <br/>{b} : {c} ({d}%)"
     },
     
     toolbox: {
         show : false,
         feature : {
             mark : {show: true},
             dataView : {show: true, readOnly: false},
             magicType : {
                 show: true, 
                 type: ['pie', 'funnel'],
                 option: {
                     funnel: {
                         x: '25%',
                         width: '20%',
                         funnelAlign: 'center',
                         max: 1548
                     }
                 }
             },
             restore : {show: true},
             saveAsImage : {show: true}
         }
     },
     calculable : true,
     series : [
         {
             name:'消费明细',
             type:'pie',
             radius : ['45%', '60%'],
             itemStyle : {
                 normal : {
                     label : {
                         show : true
                     },
                     labelLine : {
                         show : true
                     }
                 },
                 emphasis : {
                     label : {
                         show : true,
                         position : 'center',
                         textStyle : {
                             
                             fontWeight : 'bold'
                         }
                     }
                 }
             },
             data:itemArray
         }
     ]

         };



         circle.setOption(option); 

     },
     error:function(){
         alert("加载图表失败!");
     }
 });

});
                
        

    }
},
error:function(){
alert("加载数据失败");
}
        });
    }
    
    
    //根据教练查询每个教练的授课情况
    function coachFun(){
        //alert("coach");
        var chart = echarts.init(document.getElementById("preference"));    
     var data1=[];
     var data2=[];
     var array=[];
        var id=document.getElementById("memberID").value;
        $.ajax({
            url:"/abcTest/admin.php/CountConsume/showCoach",
            type:"post",
            data:{"id":id},
            dataType:"json",
            success:function(data){
                if(data.length>0){
                for(var i=0;i<data.length;i++){

data1.push(data[i]['TIME']);data2.push(data[i]['num']);                          
}

var option = {

color : [ '#3398DB' ],

title : {

 text : '选课情况统计', //主标题文本，支持使用 \n 换行。

 link : '', //主标题文本超链接

 textStyle : { //该属性用来定义主题文字的颜色、形状等

     color : '#3398DB',

 }

},

tooltip : {

 trigger : 'axis',

 axisPointer : { // 坐标轴指示器，坐标轴触发有效

     type : 'shadow' // 默认为直线，可选为：'line' | 'shadow'

 }

},

grid : {

 left : '6%',

 right : '20%',

 bottom : '20%',

 containLabel : true

},

xAxis : [ { //x轴列表展示

 type : 'category',

 data : data1,

} ],

yAxis : [ { //定义y轴刻度

 type : 'value',

 scale : true,

 name : '选课人数',

 max : 30,

 min : 0,

} ],

series : [ {

 name : '人数',

 type : 'bar', //bar 柱状图     line 折线图 等

 barWidth : '30%', //柱的宽度

 data : data2

} ]

};

chart.setOption(option);
chart.on('click', function (params) {
 //alert(params.name);//name是横坐标，

 var date=params.name;
 var id=document.getElementById("memberID").value;
 //alert(date+id);
 $.ajax({
     url:"/abcTest/admin.php/CountConsume/courseInfo",
     type:"post",
     data:{"date":date,"id":id},
    // dataType:"json",
     success:function(msg){

        var data=eval("("+msg+")");
                            /*点击柱状图以后以饼状图的形式详细展示消费情况：消费时间，课程名，课程价格*/
                           for(var i=0;i<data.length;i++){
                            //alert(data[i]['courseName']);
                            obj=data[i];
                            var ul=$('<ul class="list-group"></ul>');//memId,memName,vipCardId,memTel,memSex,memHealth,memRemarks
                       
                        ul.append('<li class="list-group-item">'+ obj['memId'] + '</li>');
                        ul.append('<li class="list-group-item">'+ obj['memName'] + '</li>');
                        ul.append('<li class="list-group-item">'+ obj['vipCardId'] + '</li>');
                          $('#memInfo').append(ul);  
                           }
                           $('#memInfo').css('display','block');


     },
     error:function(){
            alert("数据加载出错");
     }
 })
});

 }
 else{
     alert("没有人选择该教练的课程");
 }
            },
            error:function(){
                alert("数据加载失败");
            }

        });
    }
    function searchMember(){
        var id=document.getElementById("memberID").value;
       
           //alert(id);
        $.ajax({
            url:"/abcTest/admin.php/CountConsume/show",
            type:"post",
            data:{"memId":id},
            dataType:"json",
            success:function(data){
                //alert (data);
                switch (data) {
                    case 0:
                        userFun();
                        break;
                    case 1:
                        coachFun();
                        break;
                    case 10:
                        alert("不存在相关信息");
                        break;
                }
              // alert(data);
            }
        });
    }
        function searchConsume(){
            var year=document.getElementById("year");
                var month=document.getElementById("month");
                var num='0';
                var mm;
                if(month.value>0 && month.value<10){               
                    mm=num+month.value;
                }
                else{
                    mm=month.value;
                }
                var time=year.value+'-'+mm;           
            var dom = document.getElementById("main");
            var myChart = echarts.init(dom);
                   /*   data1 表示每个饼状图的名字，每个培训类型
    
                 data2 表示每个饼状图，即每个培训类型的统计结果
    
             */    
            var data1=[];    
            var data2=[];   
            var array=[];
            $.ajax({   
                url:"/abcTest/admin.php/CountConsume/tt",
                type:"post",                  
                async:false,
                data:{"time":time},
                //dataType:"json",
                success:function(result){
                    
                    if(result.length>2){
                        var test=eval("("+result+")");
                    for(var i=0;i<test.length;i++){
                        data1.push(test[i]['courseName']);data2.push(test[i]['count(t_consume.courseID)']);    
                        var map={};map.name=test[i]['courseName'];map.value=test[i]['count(t_consume.courseID)'];    
                        array.push(map);
                    }
                
                   myChart.setOption({ //加载数据图表 
                        title : {  
                            text: '消费情况统计',    
                            x:'center'
                        },
    
                        tooltip : {
    
                            trigger: 'item',
    
                            formatter: "{a} <br/>{b} : {c} ({d}%)"
    
                        },
    
                       
    
                        toolbox: {
    
                            show : false,
    
                            feature : {
    
                                mark : {show: true},
    
                                dataView : {show: true, readOnly: false},
    
                                magicType : {
    
                                    show: true,
    
                                    type: ['pie', 'funnel'],
    
                                    option: {
    
                                        funnel: {
    
                                            x: '25%',
    
                                            width: '50%',
    
                                            funnelAlign: 'left',
    
                                            max: 1548
    
                                        }
    
                                    }
    
                                },
    
                                restore : {show: true},
    
                                saveAsImage : {show: true}
    
                            }
    
                        },
    
                        calculable : true,
    
                        series : [
    
                            {
    
                                name:'统计结果:',
    
                                type:'pie',
    
                                radius : '50%',
    
                                center: ['50%', '40%'],
    
                                data:array
    
                            }
    
                        ]
    
                       });
    
                    }
                   
                    else{
                        alert("未查询到相关消费记录");
                    } 
               },
    
                error : function(result) {
    
                    //请求失败时执行该函数
    
                    alert("图表请求数据失败!");
    
                    myChart.hideLoading();
    
                }
    
            });
    
     
        }
           
     
    
        
    
    </script>
    </body>
    
     
    
    </html>