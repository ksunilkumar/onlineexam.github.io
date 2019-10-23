<?php

class Grades
{
	function add_grade($name)
	{
		$query= New Queries();
		$values=array("grade=".$name."");
		$query->makeinsertquery('test_grades',$values);
	}
	function edit_grade($name,$id)
	{
		$query= New Queries();
		$values=array("grade=".$name."");
		$where=array("gid=".$id."");
		$query->makeupdatequery('test_grades',$values,$where);
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
			$cou=$count($chaps);
			for($j=0;$j<$cou;$j++)
			{
				$query->makedeletequery('qntab','quizid',$chaps[$j]['chapid']);
				$query->makedeletequery('opntab','quizid',$chaps[$j]['chapid']);
				$query->makedeletequery('copttab','quizid',$chaps[$j]['chapid']);
				$query->makedeletequery('topics','chapterid',$chaps[$j]['chapid']);
				$query->makedeletequery('quiz','chapterid',$chaps[$j]['chapid']);
				$query->makedeletequery('cost','chapterid',$chaps[$j]['chapid']);
			}
			$query->makedeletequery('test_course','cid',$cid);
			$query->makedeletequery('test_chapters','courseid',$cid);
		}
		$query->makedeletequery('test_grades','gid',$id);
	}
	function display()
	{
		$query= New Queries();
		return $query->makeselectall('test_grades');
	}
	function display_select($school_id)
	{echo"dsfd";
		$query= New Queries();
		return $query->makeselectallfields('test_grades','school_id',$school_id);
	}
	function display_cur_sub_grade($curid,$subid)
	{
		$objSql = new SqlClass();
		$res = $objSql->executeSql("select * from test_course where curriculum='$curid' and subject='$subid'");
		while($row = $objSql->fetchRow($res))
		{
			$query= New Queries();
			$final[]=$query->makeselectallquery('test_grades','gid',$row['grade']);	
		}
		return $final;
	}
}
?>