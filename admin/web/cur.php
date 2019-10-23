<?php
	 include_once'../../lib/db.php';
	 include_once'../../lib/class_exam_course.php';
	 include_once'../../lib/class_exam_curriculum.php';
	 $school=$_REQUEST['school'];
	 $queries = new Queries();
	 $objSql= new SqlClass();
	 $curriculum= new exams_curriculum();
	$sql="select distinct(cur_id) from test_course where school_id=".$school;
	 $result=$objSql->executeSql($sql); 
	 echo "<select name='cur' onchange=".'"'."call('10')".'"'." id='cur'><option value='all'>--Select--</option>";
	 while($row=$objSql->fetchRow($result))
	 {
	 	$cur_id=$curriculum->curriculum_name_select($row['cur_id']);
		
		echo "<option value='".$cur_id[0]['cur_id']."'>".$cur_id[0]['cur_name']."</option>";
 	 }
	echo "</select>";
?>
