<?php
class LeaveAction extends Action{
    function index(){
        
     
        $this->display();
    }
    function search(){
        /*主体内容查询部分 */
        $Member=M(Member);
        $id=$_POST["id"];          
        $memInfoSql="select memId,memName,vipCardId,memTel,memSex,memHealth,memRemarks from t_member where memId='$id' ";
        $memberList=$Member->query($memInfoSql);
        if(count($memberList)==0){
            echo "未查询到用户信息";
        }
        else
        {
            echo json_encode($memberList);
        }
        
    }
    function leave(){
        $Member=M(Member);
        $Card=M(Card);
        $Leave=M(Leave);
        $id=$_POST["id"];
        //$role = $user->where("userId ='$username'")->getField('userRole');
        //echo $id;
        $data["memRemarks"]="已请假";
        $done=$Member->where("memId='$id'")->save($data);
        if ($done){
            $sql="update t_card set validTimes=validTimes+1 where cardID in (select vipCardId from t_member where memId='$id')";
            $Card->execute($sql);//请假后有效次数+1
            $remarks=$Member->where("memId='$id'")->getField('memRemarks');
            //echo $remarks;
            $text='{remarks:"' . $remarks.'"}';
            echo json_encode($text);
            $Leave->memId=$id;
            $Leave->leaveTime=$_POST["time"];//请假表中加入一条数据
            $Leave->add();
        }
        
    }
    function returnClass(){
        $Member=M(Member);
        $id=$_POST["id"];
        $data["memRemarks"]="";
        $Member->where("memId='$id'")->save($data);
    }
}
?>