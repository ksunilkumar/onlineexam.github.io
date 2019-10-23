<?php
class exams_cost{
    function __construct(){
      $this->query=new Queries();
	 $this->table = 'test_cost';
	}
	function cost_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function cost_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function cost_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function cost_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function cost_select($field,$value){
		$sql="select * from test_cost where $field=$value";
		///echo $sql;
		$objSql = new SqlClass();
			$row = $objSql->executeSql($sql);
				//print_r($row);
					return $row;
	}
	
		function cost_test1($value1,$value2,$value3,$school_id){
		/*$sql="select * from test_cost where test_id!=$value1 and chapter_id=$value2 and course_id=$value3 and school_id=$school_id";
		//echo $sql;
		$objSql = new SqlClass();
			$row = $objSql->executeSql($sql);
				//print_r($row);
					return $row;*/
		$limit=10;
		$sql="select * from test_cost where test_id!=$value1 and chapter_id=$value2 and course_id=$value3 and school_id=$school_id";
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
	
	function cost_test2($value1,$school_id){
		/*$sql="select * from test_cost where test_id!=$value1 and school_id=$school_id";
		echo $sql;
		$objSql = new SqlClass();
			$row = $objSql->executeSql($sql);
				//print_r($row);
					return $row;*/
	
		
		$sql="select * from test_cost where test_id!=$value1 and school_id=$school_id";
		//echo $sql;
		$objSql = new SqlClass();
			$row = $objSql->executeSql($sql);
			while($row1=$objSql->fetchRow($row))
			$rowdc[]=$row;
		return $rowdc;
	}
	function cost_test3($value1,$value2,$school_id){
		$sql="select * from test_cost where test_id=$value1 and chapter_id!=$value2 and school_id=$school_id";
		//echo $sql;
		$objSql = new SqlClass();
			$row = $objSql->executeSql($sql);
				//print_r($row);
					return $row;
	}
	function cost_test4($value1,$value2){
		$sql="select * from test_cost where chapter_id=$value1 and test_id=$value2";
		//echo $sql;
		$objSql = new SqlClass();
			$row = $objSql->executeSql($sql);
				//print_r($row);
					return $row;
	}
	function cost_test5($value1,$value2,$value1){
		$sql="select * from test_cost where course_id=$value1 and chapter_id=$value2 and test_id=$value3";
		//echo $sql;
		$objSql = new SqlClass();
			$row = $objSql->executeSql($sql);
				//print_r($row);
					return $row;
	}
	function cost_num_of_records($value1,$value2,$value1){
		$sql="select * from test_cost where course_id=$value1 and chapter_id=$value2 and test_id=$value3";
		//echo $sql;
		$objSql = new SqlClass();
			$row = $objSql->executeSql($sql);
			$rows= $objSql->getNumRecord($row);
				//print_r($row);
					return $rows;
	}
	function display_costs($page,$al,$val,$id,$cid)
		{
			
			
			if($cid!="" && $id!='')
			$sql="select * from test_cost where chapter_id=$id and course_id=$cid  ORDER BY cost_id";
			else
			$sql="select * from test_cost ORDER BY cost_id";
			
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
function totalNoOfcosts($id,$cid)
		{
			//$sql="select * from test_chapters where course_id = ".$value." and school_id=$school_id";
			
				if($cid!="" && $id!='')
			$sql="select * from test_cost where chapter_id=$id and course_id=$cid ORDER BY cost_id";
			else
			$sql="select * from test_cost ORDER BY cost_id";
			/*if($val != '.')
				$sql.=" WHERE career_name LIKE '".$val."%' ";*/

			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}
}
?>
