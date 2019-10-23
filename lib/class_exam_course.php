<?php
class exams_course{
    function __construct(){
      $this->query=new Queries();
	 $this->table = 'test_course';
	}
	function course_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function course_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function course_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function course_selectall($field,$value){
		$arr=$this->query->makeselectallquery($this->table,$field,$value);
		return $arr;
	}
	function select_course($column,$field,$value){
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	function course_distinctname_select($value,$school_id){
		$sql="select distinct subject_id from test_course where cur_id='$value' and school_id=$school_id";
		
		//echo $sql;
		$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			while($row = $objSql->fetchRow($record)){
			$rows[]=$row;
			}
			return $rows;
	}
	function course_distinctname_select_all($value,$value2){
		$sql="select distinct subject_id from test_course where cur_id='$value' and subject_id='$value2'";
		//echo $sql;
		$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			while($row = $objSql->fetchRow($record)){
			$rows[]=$row;
			}
			return $rows;
	}
		function course_all_select($value){
		$sql="select * from test_course where subject_id='$value'";
		//echo $sql;
		$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			while($row = $objSql->fetchRow($record)){
			$rows[]=$row;
		
		}
			return $rows;
	}
		function course_all_select1($value,$value2,$school){
		$sql="select * from test_course where subject_id='$value' and cur_id='$value2' and school_id=$school";
		//echo $sql;
		$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			while($row = $objSql->fetchRow($record)){
			$rows[]=$row;
		
		}
			return $rows;
	}
	function course_to_select($value1=0,$value2,$school_id){
	if($value1!=0)
	{
		$sql = "select distinct(grade_id) from test_course where subject_id='".$value1."' and cur_id='".$value2."' and school_id='".$school_id."' order by grade_id"; 
	}
	else
	{
		$sql = "select distinct(grade_id) from test_course where cur_id='".$value2."' and school_id='".$school_id."' order by grade_id"; 	
	}
	//	echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
		function course_select1($school_id){
		$limit=10;
		$sql = "select * from test_course where school_id='".$school_id."'"; 
		//echo $sql;
		$pagination_qatar = new pagination_qatar();
		$pagination_qatar->createPaging($sql,$limit);
		while($row=mysql_fetch_object($pagination_qatar->resultpage)){
		$rowdc[]=$row;
		}
		  $rowdc['total_rec']=$pagination_qatar->totalrecords();
		  $rowdc['dis_page']=$pagination_qatar->displayPaging();
		 
		return $rowdc;
		}
	
	function course_select($field,$value){
	
    $query="select * from ".$this->table." where ".$field."='".$value."'";
			//echo $query;
			$objSql = new SqlClass();
			$res = $objSql->executeSql($query);
			return $res;
		}
	function course_select_name($value){
		$sql="select * from test_course where course_id  in (select course_id from chapters where chap_id=$value)";
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	
	function get_grade_chapters($gid)
	{
		$sql="select * from test_course where grade_id='$gid'";
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);

		while($row = $objSql->fetchRow($record))
		{
			$rows[]=$row;
		
		}
			return $rows;
	}
	function course_grade($school_id){
			$sql = "select distinct grade_id from test_course where school_id=$school_id "; 
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			while($row = $objSql->fetchRow($record)){
			$rows[]=$row;
			}
			return $rows;
			
	}
	function course_curr($gid,$school_id){
			$sql = "select distinct cur_id from test_course where grade_id=$gid and school_id=$school_id"; 
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			while($row = $objSql->fetchRow($record)){
			$rows[]=$row;
			}
			return $rows;
			
	}
	
	function course_sub($gid,$cid){
		$sql = "select distinct subject_id from test_course where grade_id=$gid and cur_id=$cid "; 

			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			while($row = $objSql->fetchRow($record)){
			$rows[]=$row;
			}
			return $rows;
			
	}
		function course_count($value1,$value2,$schoolid){
		$sql = "select * from test_course where subject_id=$value1 and cur_id=$value2 and  order by cur_id"; 
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$rows= $objSql->getNumRecord($record);
			return $rows;
	}
	function course_select_by_column($column,$field,$value){
	
	$query="select ".$column." from ".$this->table." where ".$field."='".$value."'";
			//echo $query;
			$objSql = new SqlClass();
			$res = $objSql->executeSql($query);
			return $res;
		}
	function display_courses($page,$al,$val,$school_id)
		{
			$sql = "select * from test_course"; 
			if($school_id!=0)
			$sql.=" where school_id=".$school_id." ";			
			/*if($al != '.')
				$sql.=" and career_name LIKE '".$al."%'";
			
			if($val == '0')$sql.= "ORDER BY career_name";elseif($val == '1')$sql.= "ORDER BY career_name DESC";
			elseif($val == '2')$sql.= "ORDER BY status";elseif($val == '3')$sql.= "ORDER BY status DESC";
			else $sql.= "ORDER BY career_name";
			*/
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function totalNoOfcourses($school_id)
		{
			$sql = "select * from test_course"; 
			if($school_id!=0)
			$sql.=" where school_id=".$school_id." ";
			/*if($val != '.')
				$sql.=" WHERE career_name LIKE '".$val."%' ";*/

			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}
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
		function edit_course($grade,$curriculum,$subject,$num_chapters,$image,$image_tempname,$reference,$school_id,$id)
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
					$values=array("grade_id=".$grade."","cur_id =".$curriculum."","subject_id=".$subject."","course_image=".$img_name."","reference_text=".$reference."","num_of_chapters=".$num_chapters."","school_id=".$school_id."");
				}
			}
			else
			{
				$values=array("grade_id=".$grade."","cur_id =".$curriculum."","subject_id=".$subject."","reference_text=".$reference."","num_of_chapters=".$num_chapters."","school_id=".$school_id."");
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
		function get_course_count($grade_id,$cur_id,$subject_id,$school_id,$id){
			$sql="selet count(*) as count from test_course where grade_id=$grade_id and cur_id=$cur_id and subject_id =$subject_id and school_id=$school_id and course_id<>$id	";
			$objSql = new SqlClass();
				$record = $objSql->executeSql($sql);
				return $record;
		}
		function course_exist($grade_id,$cur_id,$subject_id,$school_id){
			 $sql="select * from test_course where grade_id=$grade_id and cur_id=$cur_id and subject_id=$subject_id and school_id=$school_id";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
}
?>

