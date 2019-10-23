<?php
	 include_once'../../../lib/db.php';
	 include_once'../../../lib/class_exam_bag.php';
	 $queries = new Queries();
	 $objSql = new SqlClass();
	 $exams_bag =new exams_bag();

	 $id=$_REQUEST['id'];
	 $val=$_REQUEST['val'];
	 $user = $exams_bag->bag_selectall(bagid,$id);
	//echo"<pre>";
	//print_r($user);
	 $tab = array("status =".$val."");
	 $where = "bagid=".$id."";
	 $update = $exams_bag->bag_update($tab,$where);
 
		if($val==0){
			$msg="Test Was Deactivated";
			/*	print "<script>";
				print " self.location='manage_cart.php?userid=".$user['user']."&';";
				print "</script>";*/

			}
			if($val==1){
				$msg="Test Was activated";
				/*print "<script>";
				print " self.location='manage_cart.php?userid=".$user['user']."&msg=Test Was c';";
				print "</script>";*/
				}
?>
<?php
	include_once'../../../lib/db.php';
	include_once'../../../lib/class_exam_bag.php';
	include_once'../../../lib/class_exam_course.php';
	include_once'../../../lib/class_exam_curriculum.php';
	include_once'../../../lib/class_exam_subject.php';
	include_once'../../../lib/class_exam_grades.php';
	include_once'../../../lib/class_exam_chapters.php';
 	include_once'../../../lib/class_exam_test.php';

 $queries = new Queries();
 $objSql = new SqlClass();
 $exams_bag =new exams_bag();
 $exam_course = new exams_course();
 $exam_curriculum = new exams_curriculum();
 $exam_subject =new exams_subject();
 $exam_grade = new exams_grades();
 $exam_chapter = new exams_chapters();
 $exam_test = new exams_test();
 
 
$user=$_REQUEST['user'];
//$user='stu1000056';

$offers = $exams_bag->bag_select($user);

//print_r($offers);
//$useroffdasf = $objSql->fetchRow($offers);
//print_r($useroffdasf );
$table=" <table width='100%' border='0'>
			<tr>
				<td colspan=6 align=right>".$msg."</td>
			</tr>
            <tr>
            <th><b>Curriculum</b></th>
            <th><b>Subject</b></th>
            <th><b>Course</b></th>
            <th><b>Chapter</b></th>
            <th><b>Quiz</b></th>
            <th><b>Options</b></th>
            </tr>";
            
$rowcount=0;
while($useroff = $objSql->fetchRow($offers))
{ 
$rowcount++;
$course = $exam_course->course_selectall(course_id,$useroff['courseid']);

	$curr = $exam_curriculum->curriculum_selectall(cur_id,$course['cur_id']);

	$subject =  $exam_subject->subject_selectall(sub_id,$course['subject_id']); 


	$grade = $exam_grade->grades_selectall(grade_id,$course['grade_id']);

	$chapters =$exam_chapter->chapters_selectall(chap_id,$useroff['chapterid']);

	$test = $exam_test->test_selectall(test_id,$useroff['quizid']);


	$table.="<tr><td>".$curr['cur_name']."</td><td>".$subject['sub_name']."</td><td>".$grade['grade_name']."</td><td>".$chapters['chap_name']."</td><td>".$test['test_name']."</td><td align='center'>";
	if($useroff['status']==0)
	$table.="<a href='#' onclick='show1(\"cart_activate.php\",\"".$useroff['Bagid']."\",\"1\",\"".$user."\")'><img src='../../images/active.gif' title='Activate' alt='Activate' border='0'></a>";
	else if($useroff['status']==1)
	$table.="<a href='#' onclick='show1(\"cart_activate.php\",\"".$useroff['Bagid']."\",\"0\",\"".$user."\")'><img src='../../images/active.gif' title='Dectivate' alt='Deactivate' border='0'></a>";
	$table.="<a href='#'  onclick='show1(\"deletecart.php\",\"".$useroff['Bagid']."\",\"0\",\"".$user."\")' ><img src='../../images/delete.gif' title='Delete' alt='Delete' border='0'></a></td></tr>";
}
if($rowcount==0)
$table.="<tr><td colspan='6' align='center'><strong> No Tests </strong></td></tr>";
$table.="</table>";
echo $table;
//echo " ffff<input type='text' value='". $user ."' name='user' />";

?>