<?php
include "../../../lib/db.php";
include "../../../lib/class_exam_questions.php";

	$queries = new Queries();
	$exam_questions = new exams_questions();

	$id=$_REQUEST['id'];
	
	$val = $exam_questions->questions_delete('que_id',$id);
	
	
	$sec=$_REQUEST['sec'];
	$quizid=$_REQUEST['quizid'];
	$url="sectiona_bulk.php?id=".$quizid."&sec=$sec";
	
	
	print "<script>";
				print " self.location='$url ';";
				print "</script>";
?>