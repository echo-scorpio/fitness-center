<?php


class CourseAction extends Action{
		public function index(){		
		$ID=$_POST["id"];
		$Course=M(Course);			
		$courseInfoList=$Course->field(array('courseID','courseName','courseContent','courseTime','courseArea','courseTeacher','coursePrice'))->order('courseID asc')->select();
		$courseIntro=$Course->where("courseID='$ID'")->getField('courseContent');
		echo $courseIntro;
		$this->assign('courseList',$courseInfoList);
		$this->display();
		}
		public function del(){
			$id=$_POST["id"];
		$Course=M(Course);
		$consume=M(Consume);
		$query = $consume->where("courseID='$id'")->getField('userID');//查看是否有用户选课，有记录的话证明已选课，不能删除该课程
		$num=count($query);
		if($num>0){
			echo "已有人选课，不能删除该课程";
		}
		else{
			$done=$Course->where("courseID='$id'")->delete();
			if($done){
				//$this->redirect('ManageCourse/index',302);
				echo "删除成功";
			}
			else{
				echo "删除失败";
			}
		}
		}

		public function add(){
			//import('@.ORG.UploadFile');
			import('ORG.Net.UploadFile');
			//import("/abcTest/ThinkPHP/Lib/ORG/UploadFile");
			$upload = new UploadFile();
//设置上传文件大小
$upload->maxSize = 52428800;
//设置上传文件类型
$upload->allowExts = explode(',', 'jpg,gif,png,jpeg');
//设置附件上传目录
$upload->savePath = './public/upload/images/';
//$upload->imageClassPath = '@.ORG.Image';
$upload->saveRule = 'uniqid';
$upload->uploadReplace=true;
if (!$upload->upload($upload->savePath)) {
    //捕获上传异常
    $this->error($upload->getErrorMsg());
} else {
    //取得成功上传的文件信息
	$uploadList = $upload->getUploadFileInfo();
	//echo $uploadList[0]['savepath'];
	print_r($_FILES);
	
}

			
		}


		public function edit(){
			$id=$_POST["id"];
			//echo $id;
			$Course=M(Course);
			$data["courseName"]=$_POST["name"];
			$data["courseContent"]=$_POST["content"];
			$data["courseTime"]=$_POST["time"];
			$data["courseArea"]=$_POST["area"];
			$data["courseTeacher"]=$_POST["teacher"];
			$data["coursePrice"]=$_POST["price"];
			$done=$Course->where("courseID='$id'")->save($data);
			if ($done){
				$this->redirect(Course/index);
			}
			else{
				$this->error("修改失败");
			}
		}
		function checkTeacher(){
			$teacher=$_POST['teacher'];
			$Coach=M(Coach);
			$query = $Coach->where("coaName='$teacher'")->getField('coaID');
			if(count($query)==0){
				echo "不存在该教练";
			}
			else{
				//echo "存在";
			}
		}
		
}

?>