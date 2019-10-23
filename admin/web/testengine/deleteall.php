<?php
include "../../../lib/db.php";
include "../../../lib/class_exam_answers.php";
include "../../../lib/class_exam_options.php";
include "../../../lib/class_exam_questions.php";

	$queries = new Queries();
	$exams_answers = new exams_answers();
	$aid=$_REQUEST['aid'];
	$val = $exams_answers->answers_delete('ans_id',$aid);
	$exams_answers = new exams_answers();
	$exams_options = new exams_options();
	$oid=$_REQUEST['oid'];
	$val = $exams_options->options_delete('opt_id',$oid);
	$exam_questions = new exams_questions();
	$qid=$_REQUEST['qid'];
	$val = $exam_questions->questions_delete('que_id',$qid);
	$sec=$_REQUEST['sec'];
	$quizid=$_REQUEST['quizid'];
	$url="sectiona_bulk.php?id=".$quizid."&sec=$sec";
	
	print "<script>";
				print " self.location='$url ';";
				print "</script>"; 
?>