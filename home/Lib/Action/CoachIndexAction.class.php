<?php
class CoachIndexAction extends Action{
    function index(){
        $id=$_SESSION['coachName'];
        if($id!=null){
            $this->assign('name',$id);
            $this->display();
        }
        else{
            $this->error("未登录，请重新登录",__ROOT__."/index.php/Login/index",0);
        }
        
    }
    function changePass(){
        $pass=$_POST['newPass'];
        $user=M(User);
        $id=$_SESSION['coachName'];
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