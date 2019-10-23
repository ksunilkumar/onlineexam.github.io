<?php
class exams_chapters{
    function __construct(){
      $this->query=new Queries();
	 $this->table = 'test_chapters';
	}
	function chapters_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function chapters_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function chapters_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function chapters_selectall($field,$value){
	
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function chapters_count($field,$value){
		return $this->query->makecount($this->table,$field,$value);
	}
	function chapters_chapname_select($value){
		$limit=5;
		$sql="select * from ".$this->table." where course_id = '".$value."' ORDER BY chap_id";
		
		$pagination_qatar = new pagination_qatar();
		$pagination_qatar->createPaging($sql,$limit);
		while($row=mysql_fetch_object($pagination_qatar->resultpage)){
		$rowdc[]=$row;
		}
		  $rowdc['total_rec']=$pagination_qatar->totalrecords();
		  $rowdc['dis_page']=$pagination_qatar->displayPaging();
		 
		return $rowdc;
	}
	function chapters_chapname_select_all($value,$school_id){
				
		$sql="select * from ".$this->table." where course_id = '".$value."' and school_id='".$school_id."' ORDER BY chap_id";
		//echo $sql;
	
		$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			while($rec=$objSql->fetchRow($record))
				$row[]=$rec;
		return $row;
	}
		function chapters_chapname_select_one($value,$school_id){
		$sql="select * from ".$this->table." where course_id = ".$value." and school_id='".$school_id."' ORDER BY chap_id";
		
		$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
	function chapters_all($value,$school_id){
		/*$sql="select * from ".$this->table." where 	school_id=$school_id order by ".$value."";
		//echo $sql;
		$objSql = new SqlClass();
			$row = $objSql->executeSql($sql);
				//print_r($row);
					return $row;*/
		$limit=5;
		$sql="select * from ".$this->table." where 	school_id=$school_id order by ".$value."";
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
	function chapters_all_select($value){
		$sql="select * from ".$this->table." order by ".$value."";
		//echo $sql;
		$objSql = new SqlClass();
			$row = $objSql->executeSql($sql);
				//print_r($row);
					return $row;
		
	}
	
		function chapters_selectl($value1,$value2){
		 $sql="select * from ".$this->table." where course_id=".$value1." and chapter_no=".$value2;
		$objSql = new SqlClass();
		$row = $objSql->executeSql($sql);
			//$rows= $objSql->getNumRecord($row);
				//print_r($row);
					return $row;
	}
	function chapters_select_val($value1,$value2){
		$sql="select * from ".$this->table." where course_id=".$value1." and chapter_no=".$value2;
	//	echo $sql;
		$objSql = new SqlClass();
			$row = $objSql->executeSql($sql);
				//print_r($row);
					return $row;
	}
	function chapters_sel($field,$value){
		 $sql="select * from ".$this->table." where $field=".$value;
		//echo $sql;
		$objSql = new SqlClass();
			$row = $objSql->executeSql($sql);
				//print_r($row);
					return $row;
	}
	
		function chapters_select_by_column($column,$field,$value){
	
	$query="select ".$column." from ".$this->table." where ".$field."='".$value."'";
			//echo $query;
			$objSql = new SqlClass();
			$res = $objSql->executeSql($query);
			/*while ($res = $objSql->executeSql($query)){
			$rows =$res;
			}*/
			return $res;
		}
	function display_chapters($page,$al,$val,$cid)
		{
			
			
			if($cid!="")
			$sql="select * from test_chapters where course_id in(select course_id from test_course where grade_id =$cid) ORDER BY chap_id";
			else
			$sql="select * from test_chapters ORDER BY chap_id";
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
	function totalNoOfchapters($cid)
	{
			//$sql="select * from test_chapters where course_id = ".$value." and school_id=$school_id";
			
			if($cid!="")
			$sql="select * from test_chapters where course_id in(select course_id from test_course where grade_id =$cid) ORDER BY chap_id";
			else
			$sql="select * from test_chapters ORDER BY chap_id";
			/*if($val != '.')
				$sql.=" WHERE career_name LIKE '".$val."%' ";*/

			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
	}
	function get_chapter_name_exist($course_id,$chap_name){
		$sql="select * from test_chapters where course_id=$course_id and  chap_name='$chap_name'";
		$objSql1 = new SqlClass();
		return $rows= $objSql1->executeSql($sql);
	}
	function get_chapter_name_count($chapname,$cid,$id){
		$sql="select count(*) as count from ".$this->table." where chap_name='$chapname' and course_id=$cid and chap_id <>$id";
		$objSql1 = new SqlClass();
		$rows= $objSql1->executeSql($sql);
		return $rows[0]['count'];
	}
}
?>

