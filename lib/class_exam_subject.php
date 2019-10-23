<?php
class exams_subject{
    function __construct(){
      $this->query=new Queries();
	 $this->table = 'test_subject';
	}
	function subject_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function subject_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function subject_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function subject_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	
	function select_subject($column,$field,$value){
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	
	function subject_all_select($value){
		$sql = "select * from test_subject where sub_id=$value"; 
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			while($row = $objSql->fetchRow($record)){
			$rows[]=$row;
		
		}
			return $rows;
	}
	
	function subject_select($school_id){
		/*$sql = "select * from test_subject where school_id=$school_id order by sub_id"; 
		
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;*/
					$limit=10;
		$sql = "select * from test_subject where school_id=$school_id order by sub_id"; 
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
		function subject_select1($subid){
		$sql = "select * from test_subject WHERE sub_id = ".$subid." order by sub_id"; 
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		
		}
		function grade_cur_select($cur_id,$gradeid,$schoolid){
		$sql = "select * from test_course WHERE cur_id = '".$cur_id."' AND grade_id = '".$gradeid."' AND school_id='".$schoolid."'"; 
		//echo $sql; exit;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		
		}
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
	function display_select()
	{
		$query= New Queries();
		
		return $query->makeselectallvalues('test_subject');
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
	function get_subject_count($name,$id){
			$sql="select count(*) as count from ".$this->table." where sub_name ='$name' and sub_id <> $id";
		$objSql1 = new SqlClass();
		$rows= $objSql1->executeSql($sql);
		return $rows[0]['count'];
	}
}
?>
