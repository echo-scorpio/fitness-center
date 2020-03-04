<?php

class CountConsumeAction extends Action{
    function index(){  
      $this->display();  
    }
    function tt(){
      $consume=M(Consume);
      $time=$_POST['time'];
      $sql="SELECT courseName,count(t_consume.courseID) from t_consume,t_course where t_course.courseID=t_consume.courseID and consumeTime LIKE '%$time%' group by t_consume.courseID";
      $result=$consume->query($sql);
      echo json_encode($result);
    }
    function show(){
      $consume=M(Consume);
      $user=M(User);
      $id=$_POST["memId"];
      $role=$user->where("userId='$id'")->getField('userRole');
      if($role==null){
        echo "10";
      }
      else{
        echo $role;
      }
     
     

    }
function showCoach(){
  $id=$_POST["id"];
  $consume=M(Consume);
  $coaSql="select  count(t_consume.courseID) as num,DATE_FORMAT( consumeTime,  '%Y-%m' )
   AS TIME from t_coach,t_user,t_course,t_consume where t_user.userId=t_coach.coaID and
    t_course.courseTeacher=t_coach.coaName and t_course.courseID=t_consume.courseID and
     coaID='$id' group by TIME";
    $coaResult=$consume->query($coaSql);
    echo json_encode($coaResult);
}
function courseInfo(){
  $member=M(Member);
  $date=$_POST['date'];
  $id=$_POST['id'];
  $memSql="select  memId,memName,vipCardId from t_member,t_coach,
  t_user,t_course,t_consume where t_user.userId=t_coach.coaID and
   t_course.courseTeacher=t_coach.coaName and t_course.courseID=t_consume.courseID
    and t_member.memId=t_consume.userID and coaID='$id' and t_consume.consumeTime LIKE '%$date%'";
    $result=$member->query($memSql);
    echo json_encode($result);

}
    function showUser(){//若输入为用户id，显示用户每月的消费情况
      $consume=M(Consume);
      $user=M(User);
      $id=$_POST["id"];
      $sql="SELECT DATE_FORMAT( consumeTime,  '%Y-%m' ) AS TIME, SUM( price ) 
      FROM t_consume, t_course
      WHERE t_course.courseID = t_consume.courseID
      AND userID =  '$id'
      GROUP BY TIME";
      $result=$consume->query($sql);
      echo json_encode($result);
    }
    function info(){
      $consume=M(Consume);
      $date=$_POST["date"];
      $id=$_POST["userId"];
      $sql="SELECT courseName, price, DATE_FORMAT( consumeTime,  '%Y-%m-%d' )
      FROM t_consume, t_course
      WHERE t_consume.courseID = t_course.courseID
      AND DATE_FORMAT( consumeTime,  '%Y-%m' ) =  '$date'
      AND userID =  '$id'";
      $result=$consume->query($sql);
      echo json_encode($result);
      
    }
}
