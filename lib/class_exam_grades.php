<?php
class exams_grades{
    function __construct(){
      $this->query=new Queries();
	 $this->table = 'test_grades';
	 //$this->table_user_grade = 'user_grade';
	}
	function grades_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function grades_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function grades_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function grades_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function grade_select($column,$field,$value){
	
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	function grade_select_one(){
	
		//return $this->query->makeselectquery($this->table_user_grade,$column,$field,$value);
		$sql="select * from test_grades order by grade_id";
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		//$row = $objSql->fetchRow($record);
		//return $row;
		return $record;
	}
	function grades_all_select($value)
	{
		$sql="select * from test_grades where grade_id=$value order by grade_id";
      	//echo $sql;
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		while($row = $objSql->fetchRow($record)) 
			{
					$rows[] = $row;
			}
				
			return $rows;
	}
	function grades_select_one($school_id)
	{
		$sql="select * from test_grades where school_id=$school_id ";
		$this->objSqldc= new SqlClass();
		 $recorddc = $this->objSqldc->executeSql($sql);
		while($row = $this->objSqldc->fetchRow($recorddc)) 
			{
					$rows[] = $row;
			}
				
			return $rows;
	}
	function grades_select($page,$al)
	{
		
		$sql = "select * from test_grades "; 
		if($al != '.')
				$sql.=" where grade_name LIKE '".$al."%'";
		$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		return $record;
	}
	function totalNoOfGrades($al)
	{
		
		$sql = "select * from test_grades "; 
		if($al != '.')
				$sql.=" where grade_name LIKE '".$al."%'";
		
		$objSql = new SqlClass();
		$arr=$objSql->executeSql($sql);
		if(is_array($arr))
		return count($arr);
		else
		return 0;
	}
	function grades_inner_query($value)
	{
		$sql = "select * from test_grades where grade_id in(select grade_id from test_course where course_id=$value)";
		//echo $sql; exit;
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		$row = $objSql->fetchRow($record);
		return $row;
	}
	function get_grade($value)
	{
		$sql="select * from test_grades where grade_id in(select grade_id from test_course where course_id in(select course_id from test_chapters where chap_id=$value))";
		//echo $sql;
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		$row = $objSql->fetchRow($record);
		return $row;
	}
	function get_distinct_grade()
	{
		$sql="select distinct grade_name,grade_id from test_grades";
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		while($row = $objSql->fetchRow($record))
		{
		$roww[]=$row;
		}
		return $roww;
	}
	function grade_name_select($field,$value){
		$sql = "SELECT * FROM test_grades WHERE $field=". +  $value; 
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
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
	function display_select()
	{
		$query= New Queries();
		return $query->makeselectallvalues('test_grades');
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
