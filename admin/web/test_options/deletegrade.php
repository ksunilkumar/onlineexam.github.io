<?php
session_start();
ob_start();
include_once'../../../lib/db.php';
include_once'../../../lib/class_exam_course.php';
include_once'../../../lib/class_exam_grades.php';

$exams_course=new exams_course();
$exams_grades = new exams_grades();

 $qid=$_GET['gid'];
$objSql = new SqlClass();

$cour = $exams_course->course_select("grade_id",$qid);
while($r=$objSql->executeSql($cour))
{
$chap1 = $exams_chapters->chapters_sel("course_id",$cid);
$delcour = $exams_course->course_delete("course_id",$cid);
$delchap = $exams_chapters->chapters_delete("chap_id",$cid);
$delchap1 = $exams_chapters->chapters_delete("course_id",$cid);

$test = $exams_test->test_delete("course_id",$cid);


}
$grade = $exams_grades->grades_delete("grade_id",$qid);
$page=$_GET['page'];
$al=$_REQUEST['al'];
//$sql="delete  from grades where gid=$qid";
$_SESSION['msg']="<font color='red' size='2'>Grade Deleted Successfully</font>";
header("location:manage_grade.php?page=$page&al=$al");
exit;
?>