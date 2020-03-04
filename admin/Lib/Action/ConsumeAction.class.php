<?php
class ConsumeAction extends Action{
    function index(){
        $Card=M(Card);
        $Member=M(Member);
        $Course=M(Course);
        /*头部显示部分*/ 
        $allMembers=$Member->count();
        $sql="select count(vipCardId) from t_member where vipCardId in(select cardID from t_card where validTimes>=7)";
        $timedSql="select count(vipCardId) from t_member where vipCardId in(select cardID  from t_card where validTimes> 0 and validTimes<7)";
        $alreadyTimeout="select count(vipCardId) from t_member where vipCardId in(select cardID  from t_card where validTimes=0)";

        $result=$Member->query($sql);
        $timedResult=$Member->query($timedSql);
        $alreadySql=$Member->query($alreadyTimeout);

        foreach($timedResult as $key=>$val){
            $timedOut=$val['count(vipCardId)'];
        }
    
        foreach ($result as $k=>$v){
            $noTimeOut=$v['count(vipCardId)'];
        }

        foreach($alreadySql as $key=>$value){
            $alreadyOverTime=$value['count(vipCardId)'];
        }
        //echo $tt;
        $this->assign('allMembers',$allMembers);
        $this->assign('noTimeOut',$noTimeOut);
        $this->assign('timedOut',$timedOut);
        $this->assign('alreadyTimeout',$alreadyOverTime);
        /*主体内容查询部分 */
       /* $id=$_POST["id"];   
        
        $memInfoSql="select memId,memName,vipCardId,memSex,memTel,memRegisteDate,memRemarks,validTimes,cardDiscount from t_member,t_card where t_member.vipCardId=t_card.cardID and memId='$id' ";
        $memberList=$Member->query($memInfoSql);
        echo json_encode($memberList);

        /*显示课程信息 */
        $courseList=$Course->field(array('courseID','courseName','courseTime','courseArea','courseTeacher','coursePrice'))->select();
        $this->assign('userId',$id);
       
        $this->assign('courseList',$courseList);
        $this->assign('memberList',$memberList);  
        $this->display();
        
        
    }
    function search(){
        $id=$_POST["id"];   
        $Member=M(Member);
        $memInfoSql="select memId,memName,vipCardId,memSex,memTel,memRegisteDate,memRemarks,validTimes,cardDiscount from t_member,t_card where t_member.vipCardId=t_card.cardID and memId='$id' ";
        $memberList=$Member->query($memInfoSql);
        if(count($memberList)==0){
            echo "未查询到用户信息";
        }
        else
        {
            echo json_encode($memberList);
        }
        
    }
    function chooseCourse(){
        $Consume=M(Consume);
        $Course=M(Course);
        $courseId=$_POST["courseID"];
        
        $userId=$_POST["userID"];
        $result=$Consume->where("courseID='$courseId'")->select();//检查是否重复选课
        $Consume->userID=$userId;       
        $Consume->courseID=$courseId;
        $Consume->price=$_POST["price"];
        $Consume->consumeTime=$_POST["consumeTime"];
        

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
     
    
    
    }//
    function allMembers(){
        $Member=M(Member);
        $memInfoSql="select memId,memName,vipCardId,memSex,memTel,memRegisteDate,memRemarks,validTimes,cardDiscount from t_member,t_card where t_member.vipCardId=t_card.cardID";
        $memberList=$Member->query($memInfoSql);       
        echo json_encode($memberList);
        
    }
    function noTimeoutMem(){
        $Member=M(Member);
        $memInfoSql="select memId,memName,vipCardId,memSex,memTel,memRegisteDate,memRemarks,validTimes,cardDiscount from t_member,t_card where t_member.vipCardId=t_card.cardID and validTimes>=7";
        $memberList=$Member->query($memInfoSql);       
        echo json_encode($memberList);
    }
    function overTime(){
        $Member=M(Member);
        $memInfoSql="select memId,memName,vipCardId,memSex,memTel,memRegisteDate,memRemarks,validTimes,cardDiscount from t_member,t_card where t_member.vipCardId=t_card.cardID and validTimes> 0 and validTimes<7";
        $memberList=$Member->query($memInfoSql);       
        echo json_encode($memberList);
    }
    function alreadyOvertime(){
        $Member=M(Member);
        $memInfoSql="select memId,memName,vipCardId,memSex,memTel,memRegisteDate,memRemarks,validTimes,cardDiscount from t_member,t_card where t_member.vipCardId=t_card.cardID and validTimes=0";
        $memberList=$Member->query($memInfoSql);       
        echo json_encode($memberList);
    }
}
?>