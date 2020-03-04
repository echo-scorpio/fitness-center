<?php
class ShowStudentInfoAction extends Action{
    function index(){
        $coaId=$_SESSION['coachName'];
        
        $member=M(Member);
        $coach=M(Coach);
        $name=$coach->where("coaID='$coaId'")->getField('coaName');
        $sql="select memName,memSex,memAddr,memHealth,memIdCard,memTel,
        memRegisteDate,memRemarks from t_member,t_consume,t_course,t_coach where 
        t_member.memId=t_consume.userID and t_consume.courseID=t_course.courseID
         and t_course.courseTeacher=t_coach.coaName and t_coach.coaName='$name'";
         $stuInfo=$member->query($sql);
         $this->assign('studentInfo',$stuInfo);
        $this->display();
    }
}
?>