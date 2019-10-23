<?php
class Subjects
{
	function add_sub($name)
	{
		
		$query= New Queries();
		$values=array("subject=".$name."");
		$query->makeinsertquery('test_subject',$values);
	}
	
	function edit_sub($name,$id)
	{
		
		$query= New Queries();
		$values=array("subject=".$name."");
		$where=array("sid=".$id."");
		$query->makeupdatequery('test_subject',$values,$where);
	}
	function delete($id)
	{
		
		$query= New Queries();
		$sql=New SqlClass;
		$obj1=$query->makeselectallfields('test_course','subject',$id);
			$cou1=count($obj1);
			
		for($i=0;$i<$cou1;$i++)
		{
			$cid=$obj1[$i]['cid'];
			$chaps=$query->makeselectallfields('test_chapters','courseid',$cid);
			$cou=count($chaps);
			for($j=0;$j<$cou;$j++)
			{
				$query->makedeletequery('qntab','quizid',$chaps['chapid']);
				$query->makedeletequery('opntab','quizid',$chaps['chapid']);
				$query->makedeletequery('copttab','quizid',$chaps['chapid']);
				$query->makedeletequery('topics','chapterid',$chaps['chapid']);
				$query->makedeletequery('quiz','chapterid',$chaps['chapid']);
				$query->makedeletequery('cost','chapterid',$chaps['chapid']);
			}
		$query->makedeletequery('test_course','cid',$cid);
		$query->makedeletequery('test_chapters','courseid',$cid);
		
		}
		$query->makedeletequery('test_subject','sid',$id);
	}
	function display()
	{
		
		$query= New Queries();
		return $query->makeselectall('test_subject');
	}
	function display_select($school_id)
	{
		$query= New Queries();
		
		return $query->makeselectallfields('test_subject','school_id',$school_id);
	}
	function display_cur_subject($curID)
	{
		include "includes/db.php";
		$objSql = new SqlClass();
		$res = $objSql->executeSql("select distinct subject from test_course where curriculum='$curID'");
		while($row = $objSql->fetchRow($res))
		{
			$query= New Queries();
			$final[]=$query->makeselectallquery('test_subject','sid',$row['subject']);	
		}
		return $final;
	}
}
?>