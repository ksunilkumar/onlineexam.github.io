<?php
// to get grade name
include_once'../../lib/db.php';
	 include_once'../../lib/class_exam_course.php';
	 include_once'../../lib/class_exam_grades.php';
	 $sid=$_REQUEST['na'];
	 $cur= $_REQUEST['cur'];
	 $school= $_REQUEST['school'];
	 $queries = new Queries();
	 $objSql = new SqlClass();
	 $exams_course = new exams_course();
	 $exams_grades = new exams_grades();
	 $subs = $exams_course->course_all_select1($sid,$cur,$school);
	echo "<select name='grade' onchange=".'"'."call('2')".'"'."id='grade'><option value='all'>--Select--</option>";

	if($sid!="")
	{
		
		foreach($subs as $s){
		$a = $s['grade_id'];
		$c = $s['course_id'];
		$allgra = $exams_grades->grades_all_select($a);
		while($grade= $objSql->fetchRow($allgra)){
		
		echo "<option value=$c>".$grade['grade_name']."</option>";
		//print_r($s['cid']);
	 }
	 }
	
	}

echo "</select>";

?>
