<?php
class MemberAction extends Action{
	public function index(){
		if(session('adminName')){
		header("Content-Type:text/html; charset=utf-8");
		$memInfo=M(Member);
		$name=session('username');
		$count=$memInfo->count();				
		$memInfoList=$memInfo->field(array('memId','memName','memSex','memAddr','memHealth','memIdCard','memTel','memRegisteDate'))->order('memId asc')->select();
		$this->assign('memInfoList',$memInfoList);
		$this->assign('name',$name);
		//$this->assign('count',$count);记录条数
		$this->display();
		}
		else{
			$this->error("请先登录！");
		}
	}
	function delete(){
		$member=M('Member');
		$ID=$_GET['id'];  //1546982136547456
		$done=$member->where("memIdCard='$ID'")->delete();
		if($done){
			$this->redirect('Member/index',302);
		}
	}
	function edit(){//"health":input[3].value,"IDNum":input[4].value,"tel":input[5].value,"data":input[6].value
		$id=$_POST["id"];//原始身份证号
		$data['memName']= $_POST["name"];
		$data['memSex']=$_POST["sex"];
		$data['memAddr']=$_POST["addr"];		
		$data['memHealth']=$_POST["health"];
		$data['memIdCard']= $_POST["IDNum"];//修改后的身份证号
		$data['memTel']=$_POST["tel"];
		$data['memRegisteDate']=$_POST["date"];		
		
		$member=M('Member');
		//echo $_POST["idCardNum"];
		$done=$member->where('memId='.$id)->save($data);
		if($done){
			$this->redirect('Index/index',302);
			
		}
		else{
			$this->error("修改错误");
		}
		
		
	}//"memCardNo":cardID,"name":memName,"sex":memSex,"addr":memAddr,"health":memHealth,"idCard":memIdCard,"tel":memTel,"coach":memCoach
	function add(){
		
		$time=$_POST["time"];//memCardNo
		$member=M('Member');
		$user=M(User);
		$member->vipCardId=$_POST["memCardNo"];
		$member->memName=$_POST["name"];
		$member->memSex=$_POST["sex"];
		$member->memAddr=$_POST["addr"];
		$member->memHealth=$_POST["health"];
		$member->memIdCard=$_POST["idCard"];
		$member->memTel=$_POST["tel"];
		$member->memRegisteDate=$time;
		
		if($member->add()){
			$sql="select max(memId) from t_member";
			$result=$member->query($sql);
			foreach($result as $k=>$v){
				$id=$v['max(memId)'];
			}
			$userSql="insert into t_user values('$id','$id','0')";
			$user->execute($userSql);

		}
		else{
			echo("添加失败");
		}
		
		
	}
	function checkCardID(){
		$cardID=$_POST['cardID'];
			$Card=M(Card);
			$member=M(Member);
			$query = $Card->where("cardID='$cardID'")->getField('cardID');
			$check=$member->where("vipCardId='$cardID'")->getField('vipCardId');
			if(count($check)>0){
				echo "已售出";
			}
			else{
				if(count($query)==0){
					echo "不存在该会员卡";
				}
				else{
					//echo "存在";
				}
			}
			
	}
	
}
?>