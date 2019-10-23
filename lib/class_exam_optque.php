<?php
class exams_optque{
    function __construct(){
      $this->query=new Queries();
	 $this->table = 'test_optional_ques';
	}
	function optque_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function optque_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function optque_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function optque_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function optque_select(){
	
		/*$sql = "select * from test_optional_ques where school_id=$school_id order by num"; 
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;*/
		$limit=10;
		$sql = "select * from test_optional_ques order by num"; 
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
		function  optque_select_one(){
			$sql = "select * from test_optional_ques order by num"; 
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		
		function optque_select_rows($field,$value){
		$sql = "select * from test_optional_ques where $field = $value"; 
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		
		}
		function optque_select_all($value1,$value2,$value3){
		$sql = "select * from test_optional_ques where cur_num = $value1 and subject_num=$value2 and grade_num=$value3"; 
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		
		}
}
?>
