<?php
	 include_once'../../lib/db.php';
	 include_once'../../lib/class_exam_course.php';
	 include_once'../../lib/class_exam_subject.php';
	 echo $cid=$_REQUEST['na'];
	 //echo "dasf".$cid;
	exit;
	 $queries = new Queries();
	 $exams_course = new exams_course();
	 $exams_subject = new exams_subject();
	 $subs = $exams_course->course_distinctname_select($cid);
	 echo "<input type='hidden' id='cur' value=$cid>";
	 	//print_r($subs);
echo "<select name='sub' onchange=".'"'."call('1')".'"'."id='sub'><option value='all'>--Select--</option>";
if($cid!="")
{
	foreach($subs as $s){
	$allsub = $exams_subject->subject_all_select($s[0]);
	foreach($allsub as $sa){

	echo "<option value=$sa[sub_id]>$sa[sub_name]</option>";
 }
 }

}
echo "</select>";
?>
