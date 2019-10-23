<?php 
	include "../../../lib/db.php";
	include "../../../lib/class_exam_course.php";
	include "../../../lib/class_exam_grades.php";
	include "../../../lib/class_exam_subject.php";
	$queries = new Queries();
	$exams_course = new exams_course();
	$exams_grade = new exams_grades();
	$exams_subject = new exams_subject();
	$val = $exams_course->course_grade($_GET['school']);
?>
<select name='grade' id='grade' onChange='load_grade(this.value)'>
<option value="">Select Grade</option>
<?php foreach($val as $ref) {echo $ref['grade_id']; ?>

<option value="<?= $ref['grade_id'] ?>" ><?php echo $exams_grade->grade_select('grade_name','grade_id',$ref['grade_id']); ?></option>
<?php } ?>

</select>