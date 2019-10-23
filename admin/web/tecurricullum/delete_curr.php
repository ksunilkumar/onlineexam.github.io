<?php
	session_start();
	
//include "../../../lib/db.php";
	
//include_once '../../../lib/functions.php';
require("../../../lib/lib.php");

	$objSql = new SqlClass();
	//admin_login_check();
	//User delet from adminn side
	if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			$r =  $exams_course->course_select(cur_id,$val[$i]);
		
			while($row=$objSql->fetchRow($r))
			{
				$cou_num =$row[0];
				$cou =$exams_chapters->chapters_sel(course_id,$row[0],$_SESSION['school_id']);
				//getting chapters
				while($course_no =$objSql->fetchRow($cou))
				{
					 $chap_num = $course_no[0] ."<br>";
					$exams_questions->questions_delete(chapter_id,$chap_num);
					$exams_answers->answers_delete(chapter_id,$chap_num);
					$exams_options->options_delete(chapter_id,$chap_num);
				}
				$exams_course->course_delete(cur_id,$cou_num);
				 $exams_chapters->chapters_delete(course_id,$cou_num);
				 $exams_test->test_delete(course_id,$cou_num);
				 $exams_bag->bag_delete(course_id,$cou_num);
				 $exams_cost->cost_delete(course_id,$cou_num);
			}
			$exams_curriculum->curriculum_delete(cur_id,$val[$i]);
			
			
		}
	

			$_SESSION['msg'] = "<font size='2' color='#0099FF'>Curtriculum(s) Deleted Successfully</font>";
			echo "<script language='JavaScript'>
			location.href = 'index.php?al=".$_REQUEST['al']."&pageNumber=".$_REQUEST['page']."'
			</script>";
			exit;
	}
?>