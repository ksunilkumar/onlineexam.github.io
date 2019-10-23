<?php
include "../../../lib/db.php";
include "../../../lib/class_exam_options.php";

	$queries = new Queries();
	$exams_options = new exams_options();

	$id=$_REQUEST['id'];
	
	$val = $exams_options->options_delete('opt_id',$id);
	
	
	$sec=$_REQUEST['sec'];
	$quizid=$_REQUEST['quizid'];
	$url="sectiona_bulk.php?id=".$quizid."&sec=$sec";
	
	
	print "<script>";
				print " self.location='$url ';";
				print "</script>";
?>