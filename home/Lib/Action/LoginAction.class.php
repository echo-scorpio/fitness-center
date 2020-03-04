<?php 


class LoginAction extends Action{
	public function index(){
		return $this->display();
	}
	
	//用户登录页面
	public function checkLogin(){
		//return 'check login';
		
    // 处理登录逻辑

    	//$param = input('post.');
		$username=$_POST['user_name'];
		$password=$_POST['user_pwd'];
		$user=M('Admin');
		
		$has = $user->where("adminID ='$username'")->find();

		if($has){
			
			if($has['adminPass'] == $password){
			
					$this->success("跳转成功",__ROOT__."/admin.php/Index/index",0);
					session(adminName,$username);

				

			}
			else{
				$this->error("密码错误",__ROOT__."/index.php/Login/index",0);
			}
		}
		else{
			$this->error("密码错误",__ROOT__."/index.php/Login/index",0);
		}
		
	}

	
}



?>