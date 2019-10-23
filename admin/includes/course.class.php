<?php
class Course
{
	function add_course($grade,$curriculum,$subject,$num_chapters,$image,$image_tempname,$reference,$school_id)
	{
		$ext = pathinfo($image,PATHINFO_EXTENSION);
		$ext = strtolower($ext);
		if(($ext == 'jpg') || ($ext == 'jpeg') || ($ext == 'gif') || ($ext == 'png'))
		{
			$img_name = time().'.'.$ext;
			
			
			$target="../../course_images/".$img_name;	
			
			
			
			move_uploaded_file($image_tempname,$target);
			$query= New Queries();
			$values=array("grade_id=".$grade."","cur_id =".$curriculum."","subject_id=".$subject."","course_image=".$img_name."","reference_text=".$reference."","num_of_chapters=".$num_chapters."","school_id=".$school_id."");
			$ret = $query->makeinsertquery('test_course',$values);
		}
		else $ret = false;
		return $ret;
	}
	function edit_course($grade,$curriculum,$subject,$num_chapters,$image,$image_tempname,$reference,$id)
	{
		//echo"sxcfsfcsdf";
		$query= New Queries();
		if(basename($image!=""))
		{
		$ext = pathinfo($image,PATHINFO_EXTENSION);
		$ext = strtolower($ext);
			if(($ext == 'jpg') || ($ext == 'jpeg') || ($ext == 'gif') || ($ext == 'png'))
			{
				$img_name = time().'.'.$ext;
				$target="course_images/".$img_name;	
				move_uploaded_file($image_tempname,$target);
				$values=array("grade_id=".$grade."","cur_id =".$curriculum."","subject_id=".$subject."","course_image=".$img_name."","reference_text=".$reference."","num_of_chapters=".$num_chapters."");
			}
		}
		else
		{
			$values=array("grade_id=".$grade."","cur_id =".$curriculum."","subject_id=".$subject."","reference_text=".$reference."","num_of_chapters=".$num_chapters."");
		}
		/*echo "<pre>";
		print_r($values);
		exit;*/
		$where=array("course_id=".$id."");
		$query->makeupdatequery('test_course',$values,$where);		
	}
	function delete($id)
	{
		$query= New Queries();
		$sql=New SqlClass;
		$query->makedeletequery('test_course',' course_id',$id);
		$obj1=$query->makeselectallfields('test_chapters','courseid',$id);
		$cou=$count[$obj1];
		for($i=0;$i<$cou;$i++)
		{
			$query->makedeletequery('qntab',$quizid,$obj1['chapid']);
			$query->makedeletequery('opntab',$quizid,$obj1['chapid']);
			$query->makedeletequery('copttab',$quizid,$obj1['chapid']);
		}
		$query->makedeletequery('test_chapters','courseid',$id);
		$query->makedeletequery('test_topics','courseid',$id);
		$query->makedeletequery('test_quiz','courseid',$id);
		$query->makedeletequery('test_cost','courseid',$id);
	}
	function display()
	{
		$query= New Queries();
		return $query->makeselectall('test_course');
	}
	
	function get_course($id){
		$sql = "select * from test_course where  course_id=$id"; 
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function get_course_count($grade_id,$cur_id,$subject_id,$id){
		$sql="selet count(*) as count from test_course where grade_id=$grade_id and cur_id=$cur_id and subject_id =$subject_id and course_id<>$id	";
		$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function course_exist($grade_id,$cur_id,$subject_id){
		 $sql="select * from test_course where grade_id=$grade_id and cur_id=$cur_id and subject_id=$subject_id";
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		return $record;
	}
}
?>