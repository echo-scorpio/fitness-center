<?php
class ManageRightAction extends Action{
    function index (){
        $right=M(Right);
        $sql="SELECT	t.userId,t.userName,	
        GROUP_CONCAT(r.userRight) as rules 
        FROM 
         t_role t,t_right r where t.userRole=r.userRole GROUP BY	t.userId";
        $rightInfo=$right->query($sql);
        $this->assign('rightInfo',$rightInfo);
        $this->display();
      
    }
    function edit(){
        $role=M(Role);
        $userID=$_POST["userID"]; 
        $name=$_POST["name"];
        $rights=$_POST["rights"];
        if($rights==''){
            $emptySql="update t_role set userRole='0' where userId='$userID'";
            $y=$role->execute($emptySql);
            if($y){
                echo "保存成功";
            }
            else{
                echo "保存失败";
            }
        }
        else{
            $arr = explode("|",$rights);
            $sql="delete from t_role where userId='$userID'";
            $done=$role->execute($sql);
            $flags=0;
            if($done){
                foreach($arr as $v){
                    if($v!=''){
                        $roleSql="insert into t_role (userId,userName,userRole) values ('$userID','$name','$v')";
                    $ok=$role->execute($roleSql);
                    if($ok){
                        $flags=1;
                    }
                    else{
                        $flags=0;
                    }
                    }
                 }
       
                
              
            }
            if($flags==1){
                echo "保存成功";
            }
            else{
                echo "保存失败";
            }
        }
        //直接更新role表，相当于更改了角色
        //echo $arr[1];
//"name":name,"rights":rights,"id":id
    }
    

    function addAdminUser(){
        $role=M(Role);
        $user=M(User);
        $name=$_POST["name"];
        $rights=$_POST['rights'];
        $id=$_POST['id'];
        $roleSql="insert into t_role (userId,userName,userRole) values ('$id','$name','$rights')";
        $done=$role->execute($roleSql);
        if($done){
            $memSql="insert into t_user (userId,userPassword,userRole) values ('$id','$id','3')";
            $user->execute($memSql);
            echo "添加成功";
        }
        else{
            echo "添加失败";
        }
       
    }

}
?>