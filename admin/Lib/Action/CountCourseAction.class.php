<?php
class CountCourseAction extends Action{
    function index(){
        $this->display();
    }
    function showCourse(){
        //select DATE_FORMAT('2019-08-06 09:51:59','%Y-%m-%d') as diff
        $course=M(Course);
        $consume=M(Consume);
        $time=$_POST['time'];//详细日期
        $week=$_POST['week'];//周几
        $id=$_POST['id'];
        if($week==null){
            echo '';
        }
        else{
            $timeSql="select datediff('$time',DATE_FORMAT(consumeTime,'%Y-%m-%d')) as sub
            from t_consume where userID='$id'";
            $subResult=$consume->query($timeSql);
            $flags=0;
            $notice='{notice:"不存在相关记录"}';
            foreach($subResult as $key=>$val){
                $num=$val['sub'];
                if($num<0){
                    $flags=-1;
                }
                //echo $num;
         }
         if($flags==-1){
            echo '';
         }
         else{
            $sql="SELECT courseID,courseName,courseArea,courseTime,courseTeacher from t_course WHERE courseID in(select courseID from t_consume where userID='$id' ) and LOCATE('$week',courseTime)>0";
            $result=$course->query($sql);
            if(count($result)>0){
                echo json_encode($result);
            }
            else{
                echo '';
            }
            
         }
        
        }
       
        
    }
}
?>