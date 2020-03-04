<?php
class UserIndexAction extends action{
    function index(){
        $id=$_SESSION['username'];
        if($id!=null){
            $course=M(Course);
            $Member=M(Member);
            $Card=M(Card);
			
            $sql="select t_consume.courseID,courseName,courseTime,courseArea,courseTeacher,coursePrice,memRemarks,cardDiscount,t_card.cardID from t_course,t_member,t_consume,t_card where t_member.memId=t_consume.userID and t_consume.courseID=t_course.courseID and t_member.vipCardId=t_card.cardID and t_consume.userID='$id'";
            $courseInfoList=$course->query($sql);
            
            $remarks=$Member->where("memId='$id'")->getField('memRemarks');
            $discountSql="SELECT cardDiscount from t_card where cardID in(SELECT vipCardId from t_member where memId='$id')";
            $disResult=$Card->query($discountSql);
			foreach($disResult as $k=>$v){
				
				$cardDiscount=$v['cardDiscount'];
			}
			
            $courseSql="select courseID,courseName,courseTime,courseArea,courseTeacher,coursePrice from t_course";
            $chooseList=$course->query($courseSql);
            $this->assign('chooseList',$chooseList);
    
            $showSql="select memName,memTel from t_member where memId='$id'";
            $userInfo=$Member->query($showSql);
            foreach($userInfo as $key=>$val){
                $name=$val['memName'];
                $tel=$val['memTel'];
            }

            $timeSql="select startTime,endTime from t_card where cardID in(select vipCardId from t_member where memId='$id')";
            $timeResult=$Card->query($timeSql);
            foreach ($timeResult as $k=>$v){
                $startTime=$v['startTime'];
                $endTime=$v['endTime'];
            }

			
            $this->assign('name',$name);
            $this->assign('tel',$tel);
            $this->assign('startTime',$startTime);
            $this->assign('endTime',$endTime);
			$this->assign('remarks',$remarks);
			$this->assign('cardDiscount',$cardDiscount);
			$this->assign('courseList',$courseInfoList);
            
            $this->display();
        }
        else{
            $this->error("未登录，请重新登录",__ROOT__."/index.php/Login/index",0);
        }
       
    }
    function chooseCourse(){//"courseID":courseID,"price":realPrice,"consumeTime":consumeTime
        $Consume=M(Consume);
        $Course=M(Course);
        $courseId=$_POST["courseID"];
        
        $userId=$_SESSION['username'];
        $result=$Consume->where("courseID='$courseId'")->select();//检查是否重复选课
        $Consume->userID=$userId;       
        $Consume->courseID=$courseId;
        $Consume->price=$_POST["price"];
        $Consume->consumeTime=$_POST["consumeTime"];
        //echo $courseId;
        

     $timeSql="select courseTime from t_course where courseID='$courseId'";//检查要选课程的时间
     $query=$Course->query($timeSql);
     foreach($query as $key=>$val){
            $newTime=$val['courseTime'];
            //echo $newTime;
     }

     $sql="select courseTime from t_course where courseID in (select courseID from t_consume where  userID='$userId')";//查询已选课程的时间
     $timeResult=$Course->query($sql);
     //print_r($timeResult);
     $j=count($timeResult);
     $oldTime=array();
     $flag=0;
     if(count($timeResult)==0){
        //echo"查询为空";
        $Consume->add();
        echo "选择成功";
     }else{
        foreach($timeResult as $key=>$val){//检查时间是否冲突
            //$oldTime=$val['courseTime'];
            for($i=0;$i<$j;$i++){
                
                $oldTime[$i]=$val['courseTime'];
                //echo $oldTime[$i];
                if($oldTime[$i]==$newTime){
                    echo "时间冲突,不能选课";
                    $flag=1;
                    break;
                }else{              
                    $flag=-1;   
                   // echo "选课成功";                          
                }
                
            }
            if($flag==1){
                
                throw new Error();//结束foreach循环只能使用throw
            }
            
        
        }  
     }
    
    if($flag==-1){
        echo "选择成功";
        $Consume->add();
       
    }
  
    
    }

    function leave(){
        $Member=M(Member);
        $Card=M(Card);
        $Leave=M(Leave);
        $id=$_SESSION['username'];
        $data["memRemarks"]="已请假";
        $done=$Member->where("memId='$id'")->save($data);
        if ($done){
            $sql="update t_card set validTimes=validTimes+1 where cardID in (select vipCardId from t_member where memId='$id')";
            $Card->execute($sql);//请假后有效次数+1
            
            $Leave->memId=$id;
            $Leave->leaveTime=$_POST["time"];//请假表中加入一条数据
            $Leave->add();
        }
        
    }
    function show(){
        $Consume=M(Consume);
        $id=$_SESSION['username'];
        $sql="SELECT DATE_FORMAT( consumeTime,  '%Y-%m' ) AS TIME, SUM( price ) 
        FROM t_consume, t_course
        WHERE t_course.courseID = t_consume.courseID
        AND userID =  '$id'
        GROUP BY TIME";
        $result=$Consume->query($sql);
        echo json_encode($result);
    }
    function showDetail(){
        $Consume=M(Consume);
        $id=$_SESSION['username'];
        $date=$_POST["date"];
        $sql="SELECT courseName, price, DATE_FORMAT( consumeTime,  '%Y-%m-%d' ) as cTime
        FROM t_consume, t_course
        WHERE t_consume.courseID = t_course.courseID
        AND DATE_FORMAT( consumeTime,  '%Y-%m' ) =  '$date'
        AND userID =  '$id'";
        $result=$Consume->query($sql);
        echo json_encode($result);
    }
    function changePass(){
        $pass=$_POST['newPass'];
        $user=M(User);
        $id=$_SESSION['username'];
        $sql="update t_user set userPassword='$pass' where userId='$id'";
        $done=$user->execute($sql);
        if($done){
            echo "修改成功！";
        }
        else{
            echo "修改失败！";
        }
    }
}
?>