<?php
include "../../../lib/db.php";
include "../../../lib/class_exam_answers.php";

	$queries = new Queries();
	$exams_answers = new exams_answers();

	$id=$_REQUEST['id'];
	
	$val = $exams_answers->answers_delete('ans_id',$id);
	
	
	$sec=$_REQUEST['sec'];
	$quizid=$_REQUEST['quizid'];
	$url="sectiona_bulk.php?id=".$quizid."&sec=$sec";
	
	
	print "<script>";
				print " self.location='$url ';";
				print "</script>";
?>