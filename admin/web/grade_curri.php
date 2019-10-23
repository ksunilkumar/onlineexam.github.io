<?php
	include_once'../../lib/db.php';
	include_once'../../lib/class_exam_chapters.php';
	include_once'../../lib/class_exam_course.php';
	$courseid=$_REQUEST['na'];

	 $queries = new Queries();
	 $objSql = new SqlClass();
	 $exams_chapters = new exams_chapters();
	 $exams_course = new exams_course();
	 $no_of_chap = $exams_course->course_select_by_column(num_of_chapters,course_id,$courseid);
     $chapname = $exams_chapters->chapters_select_by_column(chapter_no,course_id,$courseid);
	 $count = $objSql->fetchRow($no_of_chap);
	  	$chap_count =$count["num_of_chapters"];
	
		//create an array
	$chp_array = range(1,$chap_count);
	if(is_array($chapname)){
	foreach($chapname as $c_number){
	//print_r($c_number);
	$chaps[] = $c_number[0];
	}
	}
			 if(is_array($chp_array)){
		 foreach($chp_array as $key =>$y){
		 if(is_array($chaps)){
		foreach($chaps as $key1 =>$k){
		if($y==$k)
		unset($chp_array[$key]);
		}
		}
		}
		}
	echo "<select name='chno' id='chno'><option value='all'>--Select--</option>";
	$i1='0';
	if($courseid!="")
	{
		foreach($chp_array as $name){
		$i1=$i1+1;
		
		echo "<option value='$name'> $name</option>";
		 }
		 if($i1=='0')
		 {
		 	echo "<option value=''>-Select Chapter Name-</option>";
		 }
	 
	}
echo "</select>";

?>
