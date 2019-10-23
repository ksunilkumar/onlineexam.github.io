<?php @session_start();
	include_once'../../lib/db.php';
	include_once'../../lib/class_exam_chapters.php';
	 $cid=$_REQUEST['na'];
	 $school=$_REQUEST['school'];

	 $queries = new Queries();
	 $exams_chapters = new exams_chapters();
	 
     $chapname = $exams_chapters->chapters_chapname_select_all($cid,$school);
	/*echo "<pre>";	 print_r($chapname);
exit;*/	echo "<select name='chno' onchange=".'"'."call('4')".'"'."id='chno'><option value='all'>--Select--</option>";
	$i1='0';
	if($cid!="")
	{
		foreach($chapname as $name){
		$i1=$i1+1;
		echo "<option value=$name[chap_id]>$name[chap_name]</option>";
		 }
		 if($i1=='0')
		 {
		 	echo "<option value=''>-Select Chapter Name-</option>";
		 }
	 
	}
echo "</select>";

?>
