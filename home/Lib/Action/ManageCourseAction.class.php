<?php
class ManageCourseAction extends Action{
    function index(){
        $course=M(Course);
        $coach=M(Coach);
        $id=$_SESSION['coachName'];
	//	$cID=$_POST['cid'];
		$name=$coach->where("coaID='$id'")->getField('coaName');
		$remark=$coach->where("coaID='$id'")->getField('coaRemarks');
        $result = $course->where("courseTeacher ='$name'")->field(array('courseID','courseName','courseContent','courseTime','courseArea','courseTeacher','coursePrice'))->order('courseID asc')->select();
		

		$this->assign('courseInfo',$result);
		$this->assign('coachRemarks',$remark);
        $this->display();
    }
    function editCourse(){
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
				echo "修改成功";
			}
			else{
				echo "修改失败";
			}
	}
	
	function delCourse(){
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
	function showCourseContent(){
		$cid=$_POST['cid'];
		$course=M(Course);
		//展示课程内容
		$courseIntro=$course->where("courseID='$cid'")->getField('courseContent');
		echo $courseIntro;

	}
}
?>