<?php


class IndexAction extends Action //index控制器
{
	public function index(){
		$name=session('adminName');
		if($name!=null){
			$this->assign('name',$name);
		$this->display();
		}
		else{
            $this->error("未登录，请重新登录",__ROOT__."/index.php/Login/index",0);
        }
		
	}
public function delete(){
	if($_GET['id']){
    		redirect(U('/Member/delete/id/'.$_GET['id']),0, '删除会员');
    	}
	else{
		$this->error("参数错误");
	}
}
 function show(){
	echo "bbbbb";
	
}

	 function quit(){
    	session(null);//清空所有session信息
		//redirect(U('/abcTest/index.php/Login/index'),0,'退出系统');
		//echo "aaa";
    }



}
