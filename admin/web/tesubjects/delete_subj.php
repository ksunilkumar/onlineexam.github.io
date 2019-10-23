<?php
	session_start();
	
include "../../../lib/db.php";
	
include_once '../../../lib/functions.php';

include "../../../lib/class_exam_subject.php";
	
	//admin_login_check();
	//User delet from adminn side
	if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			//$r =  $exams_course->course_select(cur_id,$val[$i]);
			$exams_subject = new exams_subject();
			 $delsub =  $exams_subject->subject_delete(sub_id,$val[$i]);			
			// echo $val[$i];
		}
	$al=$_REQUEST['al'];
	$_SESSION['msg']='<font size="2" color="#FF0000"><b>Subject Deleted Successfully</b></font>';
	print "<script>";
				print "self.location='index.php?pageNumber=".$_REQUEST['page']."&al=".$al."';";
				print "</script>"; 
				exit;
		
	}
?>