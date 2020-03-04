<?php
class TransferAction extends Action{
    function index(){
        
        $this->display();
        
    }
    function search(){
        $Member=M(Member);
        /*主体内容查询部分 */
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
    function toNewMember(){
        $Member=M(Member);
        $Transfer=M(Transfer);
        $user=M(User);
        $memId=$_POST["memId"];
        $Member->vipCardId=$_POST["memCardNo"];
        $Member->memName=$_POST["name"];
        $Member->memSex=$_POST["sex"];
        $Member->memAddr=$_POST["addr"];
        $Member->memHealth=$_POST["health"];
        $Member->memIdCard=$_POST["idCard"];
        $Member->memTel=$_POST["tel"];
        $Member->memRegisteDate=$_POST["time"];  
        
        $Transfer->memID=$memId;
        $Transfer->toMemTel=$_POST["tel"];
        $Transfer->cardID=$_POST["memCardNo"];
        $Transfer->time=$_POST["detailTime"];
       
        if($Member->add()){
            $sql="update t_member set memRemarks ='已转卡' where memId ='$memId'";
            $Member->execute($sql);
            $remarks=$Member->where("memId='$memId'")->getField('memRemarks');
            $text='{remarks:"'.$remarks.'"}';//$text='{remarks:"' . $remarks.'"}';
            echo json_encode($text);

            //echo"转卡成功！";
            $Transfer->add();

            $sql="select max(memId) from t_member";
			$result=$Member->query($sql);
			foreach($result as $k=>$v){
				$id=$v['max(memId)'];
			}
			$userSql="insert into t_user values('$id','$id','0')";
			$user->execute($userSql);

        }
        else{
           echo "转卡失败！";
        }

        //echo $memId;
    }
    function searchOldMem(){
        $id=$_POST["memId"];
        $Member=M(Member);
        $memInfoSql="select memName,vipCardId,memTel,memSex,memAddr from t_member where memId='$id' ";
        $memberList=$Member->query($memInfoSql);        
        echo json_encode($memberList);

    }
    function toOldMem(){
        $Member=M(Member);
        $Transfer=M(Transfer);
        $memID=$_POST["memId"];
        $oldMemId=$_POST["oldMemId"];//要转给的会员号
        $cardId=$_POST["cardId"];
        $remarks=$Member->where("memId='$oldMemId'")->getField('memRemarks');
        if($remarks=='已转卡'){
            $sql="update t_member set memRemarks='',vipCardId='$cardId' where memId='$oldMemId'";//如果已转卡的会员又被转卡，要将已转卡的备注去掉
            $Member->execute($sql);
        }

        else{
            $tSql="update t_member set vipCardId='$cardId' where memId='$oldMemId'";
            $Member->execute($tSql);
        }
        $data["memRemarks"]="已转卡";
        $Member->where("memId='$memID'")->save($data);//将转卡了的会员备注为已转卡
        $Transfer->memID=$memID;
        $Transfer->toMemTel=$_POST["tel"];
        $Transfer->cardID=$cardId;
        $Transfer->time=$_POST["time"];
        if($Transfer->add()){
            //echo "转卡成功！";
            

            $remark=$Member->where("memId='$memID'")->getField('memRemarks');
            $text='{remarks:"'.$remark.'"}';//$text='{remarks:"'.$remarks.'"}';
            echo json_encode($text);
        }

        else{
            echo "转卡失败！";
        }
    }
}
?>