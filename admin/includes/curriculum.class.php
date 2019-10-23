<?php
class Curriculum
{
	function Addcur($name,$image,$image_tempname)
	{
		$target="curimages/".basename($image);
		move_uploaded_file($image_tempname,$target);
		$query= New Queries();
		$values=array("curriculum=".addslashes($name)."","image =".$target."");
		$query->makeinsertquery('test_curriculum',$values);
		
	}
	function editcur($name,$image,$image_tempname,$id)
	{
		
		$query= New Queries();
		if(basename($image!=""))
		{
			$target="curimages/".basename($image);
			move_uploaded_file($image_tempname,$target);
			$values=array("curriculum=".$name."","image =".$target."");
		}
		else
		{
			$values=array("curriculum=".$name."");
		}
		$where=array("cid=".$id."");
		$query->makeupdatequery('test_curriculum',$values,$where);		
	}
	function delete($id)
	{
		
		$query= New Queries();
		$sql=New SqlClass;
		$obj1=$query->makeselectallfields('course','test_curriculum',$id);
		$cou1=count($obj1);
		for($i=0;$i<$cou1;$i++)
		{
			$cid=$obj1[$i]['cid'];
			$chaps=$query->makeselectallfields('chapters','courseid',$cid);
			$cou=count($chaps);
			for($j=0;$j<$cou;$j++)
			{
				$query->makedeletequery('qntab','quizid',$chaps[$j]['chapid']);
				$query->makedeletequery('opntab','quizid',$chaps[$j]['chapid']);
				$query->makedeletequery('copttab','quizid',$chaps[$j]['chapid']);
				$query->makedeletequery('topics','chapterid',$chaps[$j]['chapid']);
				$query->makedeletequery('quiz','chapterid',$chaps[$j]['chapid']);
				$query->makedeletequery('cost','chapterid',$chaps[$j]['chapid']);
			}
			$query->makedeletequery('course','cid',$cid);
			$query->makedeletequery('chapters','courseid',$cid);
		}
		$query->makedeletequery('test_curriculum','cid',$id);
	}
	function display()
	{
		
		$query= New Queries();
		return $query->makeselectall('test_curriculum');
	}
	function display_select($school_id)
	{
		//include "includes/db.php";
		$query= New Queries();
		return $query->makeselectallfields('test_curriculum','school_id',$school_id);
	}
	function display_one($id)
	{
		
		$query= New Queries();
		return $query->makeselectallfields('test_curriculum','cid',$id);
	}
}
?>