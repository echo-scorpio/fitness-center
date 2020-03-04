<?php 
class CoachAction extends Action{
	function index(){
		
		
		header("Content-Type:text/html;charset=utf-8");
		$coach=M('Coach');
		$coachInfoList=$coach->field(array('coaID','coaName','coaSex','coaIdCardNo','coaNation','coaPolitic','coaEducation','coaTel','coaPosition','coaSchool','coaRemarks'))->order('coaID asc')->select();
		$this->assign('coachList',$coachInfoList);
		$this->display();
	}
	
	function  edit(){
		
		$coach=M(Coach);
		$idCardNum=$_POST["idCardNum"];//原来的身份证号
		$data['coaName']=$_POST["name"];
		$data['coaSex']=$_POST["sex"];
		$data['coaIdCardNo']=$_POST["newIdCardNo"];
		$data['coaNation']=$_POST["nation"];
		$data['coaPolitic']=$_POST["politic"];
		$data['coaEducation']=$_POST["education"];
		$data['coaTel']=$_POST["tel"];
		$data['coaPosition']=$_POST["position"];
		$data['coaSchool']=$_POST["school"];
	
		$done=$coach->where('coaIdCardNo='.$idCardNum)->save($data);
		if($done){
			$this->redirect('Index/index',302);			
		}
		else{
			$this->error("修改失败");
		}
		
		
	}
	function del(){
		$id=$_GET["id"];
		$coach=M(Coach);
		$done=$coach->where("coaIdCardNo='$id'")->delete();
		if ($done){
			$this->redirect('Coach/index',302);
		}
		else{
			$this->error("删除失败");
		}
	}
	
	function add(){
		
		$coach=M(Coach);
		$user=M(User);
		$coach->coaName=$_POST["name"];
		$coach->coaSex=$_POST["sex"];
		$coach->coaIdCardNo=$_POST["idCardNo"];
		$coach->coaNation=$_POST["nation"];
		$coach->coaPolitic=$_POST["politic"];
		$coach->coaEducation=$_POST["education"];
		$coach->coaTel=$_POST["tel"];
		$coach->coaPosition=$_POST["position"];
		$coach->coaSchool=$_POST["school"];
		
		$coach->add();
		$sql="select max(coaID) from t_coach";
			$result=$coach->query($sql);
			foreach($result as $k=>$v){
				$id=$v['max(coaID)'];
			}
			$userSql="insert into t_user values('$id','$id','1')";
			$user->execute($userSql);
		
		
	
	}
	
}

?>