<?php
 require("../../../lib/lib.php");


$exams_chapters = new exams_chapters();

$chapid = $_GET["id"];

$del = $exams_chapters->chapters_delete(chap_id,$chapid);

$exams_cost->cost_delete(chap_id,$chapid);
$exams_questions->questions_delete(chap_id,$chapid);
$exams_options->options_delete(chap_id,$chapid);
$exams_answers->answers_delete(chap_id,$chapid);
$exams_test->test_delete(chap_id,$chapid);
//echo $page=$_GET['page']; exit;
print "<script>";
print " self.location='manage_course_chapters.php?opt=$opt&page=".$page."';";
print "</script>";
?>

