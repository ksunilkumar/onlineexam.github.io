<?php 
include "../../../lib/db.php";
include "../../../lib/class_exam_course.php";
include "../../../lib/class_exam_curriculum.php";
include "../../../lib/class_exam_subject.php";

	$queries = new Queries();
	$exams_course = new exams_course();
	$exams_curriculum = new exams_curriculum();
	$exams_subject = new exams_subject();
	
	$val = $exams_course->course_sub($_GET['un'],$_GET['cu']);
	
	//print_r($val);


?>
<select name='sel_subject' id="sel_subject" onChange='sub_form(this.value);'>
<option value="">Select Subject</option>
<?php foreach($val as $ref) { ?>
<option value="<?= $ref['subject_id'] ?>" ><?php echo $exams_subject->select_subject('sub_name','sub_id',$ref['subject_id']); ?></option>
<?php } ?>

</select>