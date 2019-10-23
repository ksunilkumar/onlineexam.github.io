<?php 
include "../../../lib/db.php";
include "../../../lib/class_exam_course.php";
include "../../../lib/class_exam_curriculum.php";
include "../../../lib/class_exam_subject.php";

	$queries = new Queries();
	$exams_course = new exams_course();
	$exams_curriculum = new exams_curriculum();
	$exams_subject = new exams_subject();
	
	$val = $exams_course->course_curr($_GET['un'],$_GET['school']);
	


?>
<select name='sel_curr' id='sel_curr' onChange='load_sub(this.value)'>
<option value="">Select Curriculum</option>
<?php foreach($val as $ref) { ?>
<option value="<?= $ref['cur_id'] ?>" ><?php echo $exams_curriculum->select_curriculum('cur_name','cur_id',$ref['cur_id']); ?></option>
<?php } ?>

</select>