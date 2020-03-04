<?php
class PayAction extends Action{
    function index(){
        $Card=M(Card);
        $Member=M(Member);
        $Course=M(Course);
       
       
        $this->assign('memberList',$memberList);  
        $this->display();
        
    }
    function search(){
        $Member=M(Member);
         /*主体内容查询部分 */
         $id=$_POST["id"];           
         $memInfoSql="select memId,memName,vipCardId,memTel,cardPrice,validTimes,memRemarks from t_member,t_card where t_member.vipCardId=t_card.cardID and memId='$id' ";
         $memberList=$Member->query($memInfoSql);
         if(count($memberList)==0){
            echo "未查询到用户信息";
        }
        else
        {
            echo json_encode($memberList);
        }
         
    }
    function cost(){
        $Card=M(Card);
        $member=M(Member);
        $time=$_POST["time"];
        $id=$_POST["id"];
        $sql="update t_card set validTimes=validTimes+'$time' where cardID='$id'";
        $checkTime=$Card->where("cardID='$id'")->getField('validTimes');
        if($checkTime==0){
            $updateRemarks="update t_member set memRemarks='' where vipCardId='$id' and memRemarks!='已转卡'";
            $member->execute($updateRemarks);
        }
        $done=$Card->execute($sql);
        if($done){
            //echo"缴费成功！";
            $times=$Card->where("cardID='$id'")->getField('validTimes');
            echo json_encode($times);
        }
        else{
            echo "缴费失败！";
        }
    }
}
?>