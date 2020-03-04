<?php
class DiffAdminIndexAction extends Action{
    function index (){
        $role=M(Role);
       $userID=session('adminUserId');
       $sql="SELECT		
       GROUP_CONCAT(r.userRight) as rules 
       FROM 
        t_role t,t_right r where t.userRole=r.userRole and userId='$userID' GROUP BY	t.userId";
        $right=$role->query($sql);
          $this->assign('rights',$right);  
          $this->assign('name',$userID);
        $this->display();
      
    }
   
    
}
?>