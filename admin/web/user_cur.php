<?php
	 include_once'../../lib/db.php';
	 include_once'../../lib/class_exam_course.php';
	 include_once'../../lib/class_exam_curriculum.php';
	 $user=$_REQUEST['user'];
	 $queries = new Queries();
	 $objSql= new SqlClass();
	 $curriculum= new exams_curriculum();
	 $sql="select school from ise_users where user_id=".$user;
	 $result=$objSql->executeSql($sql); 
	 $school=$objSql->fetchRow($result); 
	 $sql="select distinct(cur_id) from test_course where school_id=".$school[0];
	 $result=$objSql->executeSql($sql);
	 $count=count($result);
	 echo "<input type='hidden' name='school' id='school' value='".$school[0]."'>";
	 echo "<select name='cur' onchange=".'"'."call('10')".'"'." id='cur'><option value='all'>--Select--</option>";
	 $i=1;
	 while($row=$objSql->fetchRow($result))
	 {
	 	$cur_id=$curriculum->curriculum_name_select($row['cur_id']);
		if($i!=1)
		{
		echo "<option value='".$cur_id[0]['cur_id']."'>".$cur_id[0]['cur_name']."</option>";
		}
		$i++;
 	 }
	echo "</select>";
?>
