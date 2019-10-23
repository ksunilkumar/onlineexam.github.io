<?php
 require("../../../lib/db.php");
 require("../../../lib/class_exam_course.php");
 require("../../../lib/class_exam_chapters.php");
 require("../../../lib/class_exam_grades.php");
 
  require("../../../lib/class_exam_questions.php");
 require("../../../lib/class_exam_answers.php");
 require("../../../lib/class_exam_options.php");
 
 require("../../../lib/class_exam_cost.php");
 require("../../../lib/class_exam_test.php");
require("../../../lib/class_exam_curriculum.php");
  require("../../../lib/class_exam_bag.php");
  require("../../../lib/class_exam_subject.php");
 $queries = new Queries();
		$objSql = new SqlClass();
 $exams_course = new exams_course();
	$exams_chapters = new exams_chapters();
	$exams_grades = new exams_grades();
		$exams_questions = new exams_questions();
			$exams_answers = new exams_answers();
				$exams_options = new exams_options();
	
	$exams_cost = new exams_cost();
	$exams_bag = new exams_bag();
	$exams_test = new exams_test();
 $exams_curriculum = new exams_curriculum();
 $exams_subject = new exams_subject();
 

?>
