<?php
class exams_modelpapers{
    function __construct(){
      $this->query=new Queries();
	 $this->table = 'test_optional_modelpapers';
	}
	function modelpapers_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function modelpapers_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function modelpapers_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function modelpapers_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function modelpapers_select(){
		/*$sql = "select * from ".$this->table." where school_id=$school_id order by num"; 
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;*/
			$limit=10;
		$sql = "select * from ".$this->table." order by num"; 
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
		function modelpapers_select_one(){
			$sql = "select * from ".$this->table." order by num"; 
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		//modelpapers_select_rows(num,$num)
		
		function modelpapers_select_rows($field,$value){
		$sql = "select * from ".$this->table." where $field = $value"; 
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		
		}
		function modelpapers_select_all($value1,$value2,$value3){
		$sql = "select * from ".$this->table." where cur_num = $value1 and subject_num=$value2 and grade_num=$value3"; 
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		
		}
}
?>
