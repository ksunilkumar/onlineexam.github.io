<?php
class exams_test{
    function __construct(){
      $this->query=new Queries();
	 $this->table = 'test_test';
	}
	function test_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function test_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function test_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function test_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	
	function test_all_select($value){
		$sql = "select * from ".$this->table." where chapter_id=$value ORDER BY test_name desc"; 
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			while($row = $objSql->fetchRow($record)){
			$rows[]=$row;
		
		}
			return $rows;
	}
	function test_to_select_one($value1,$value2,$school_id){
		 $sql = "select * from ".$this->table." where course_id=$value1 and chapter_id=$value2 and school_id=$school_id order by test_name asc"; 
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
		function test_to_select($value1,$value2){
		/* $sql = "select * from ".$this->table." where course_id=$value1 and chapter_id=$value2 and school_id=$school_id order by test_name asc"; 
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;*/
			$limit=10;
		$sql="select * from ".$this->table." where course_id=$value1 and chapter_id=$value2 order by test_name asc";
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		return $record;
		//echo $sql;
		//$pagination_qatar = new pagination_qatar();
		//$pagination_qatar->createPaging($sql,$limit);
		while($row=mysql_fetch_object($pagination_qatar->resultpage)){
		$rowdc[]=$row;
		}
		  
		 
		return $rowdc;
		}
	//to get number of tests
	function test_count($value1,$value2){
		$sql = "select * from ".$this->table." where course_id=$value1 and chapter_id=$value2 order by test_id"; 
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$rows= $objSql->getNumRecord($record);
			return $rows;
	}
		function test_select_one($field,$value){
	$query="select * from ".$this->table." where ".$field."='".$value."'";
	
			echo $query;
			$objSql = new SqlClass();
			$res = $objSql->executeSql($query);
			return $res;
			}
	function test_select($field,$value){
	$query="select * from ".$this->table." where ".$field."='".$value."'";
	
		//echo $query;
			$objSql = new SqlClass();
			$res = $objSql->executeSql($query);
			
			return $res;
				//$limit=10;
		//$sql="select * from ".$this->table." where ".$field."='".$value."' and school_id=$school_id";
		//echo $sql;
		//$pagination_qatar = new pagination_qatar();
		//$pagination_qatar->createPaging($sql,$limit);
		/*while($row=mysql_fetch_object($sql)){
		$rowdc[]=$row;
		}*/
		  //$rowdc['total_rec']=$pagination_qatar->totalrecords();
		 // $rowdc['dis_page']=$pagination_qatar->displayPaging();
		 
		//return $rowdc;
		}
		function test_select_name($field,$value){

		$sql="select * from ".$this->table." where ".$field."='".$value."'";
		//echo $sql;
		$objSql = new SqlClass();
			$res = $objSql->executeSql($sql);
		
			return $res;
		 
		return $rowdc;
		}
		function test_select_two($field,$value,$school_id){
		$query="select * from ".$this->table." where ".$field."='".$value."'";
	
		//echo $query;
			$objSql = new SqlClass();
			$res = $objSql->executeSql($query);
			return $res;
			}
		function get_test_info($testid){
			 $sql="select * from ".$this->table." where test_id= $testid" ;
			$objSql = new SqlClass();
			$res = $objSql->executeSql($sql);
			return $res;
		}
	function get_test_page(){
			/* $sql = "SELECT * FROM ".$this->table ." where school_id=$school_id"; 
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;*/
				$limit=10;
		$sql = "select * from test_bag where tid!='offer' and nstatus!='pending' and nstatus!='process' and status=2";
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

	function display_tests($page,$al,$val,$school_id,$cid)
		{
			
			
			if($cid!="")
			$sql="select * from test_test where chapter_id=$cid ORDER BY test_id";
			else
			$sql="select * from test_test ORDER BY test_id";
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
function totalNoOftests($cid)
		{
			//$sql="select * from test_chapters where course_id = ".$value." and school_id=$school_id";
			
				if($cid!="")
			$sql="select * from test_test where chapter_id=$cid ORDER BY test_id";
			else
			$sql="select * from test_test ORDER BY test_id";
			/*if($val != '.')
				$sql.=" WHERE career_name LIKE '".$val."%' ";*/

			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}

function get_test_name($testid)
		{
			$sql="select test_name from ".$this->table." where test_id 	='".$testid."'";
			$objSql = new SqlClass();
			$res = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($res);
			return $row['test_name'];
		}
		function no_of_tests_taken($userid)
		{
			$sql="select count(Bagid) as id from test_bag where user='".$userid."' and status=1";
			$objSql = new SqlClass();
			$res = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($res);
			return $row['id'];
		}
	
}
?>
