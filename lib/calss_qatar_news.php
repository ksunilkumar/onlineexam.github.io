<?php
class qatar_news{
	 var $query;
	var $table;
	
    function __construct(){
	 
      $this->query=new Queries();
	  $this->table='news';
	}
	function qatar_news_insert($array){
			return $this->query->makeinsertquery_uploadfiles($this->table,$array);
	}
	function qatar_news_set_function($array,$where){
		return $this->query->makeupdatequery($this->table,$array,$where);
	}
	function qatar_news_update($array,$where){
	   return $this->query->makeupdatequery_uploadfiles($this->table,$array,$where);	
	}
	function qatar_news_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function qatar_news_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function qatar_news_select($column,$field,$value){
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	function qatar_news_disp($val,$max)
	{
		$min=$max;
		$max = $max+'15';
		$sql = "SELECT news_id , news_title , news_pic , create_date , status FROM qatar_news ";
			if($val == '0')$sql.= "ORDER BY news_title";elseif($val == '1')$sql.= "ORDER BY news_title DESC";
			elseif($val == '2')$sql.= "ORDER BY news_pic";elseif($val == '3')$sql.= "ORDER BY news_pic DESC";
			elseif($val == '4')$sql.= "ORDER BY create_date";elseif($val == '5')$sql.= "ORDER BY create_date DESC";
			elseif($val == '6')$sql.= "ORDER BY status";elseif($val == '7')$sql.= "ORDER BY status DESC";
		$sql.= " LIMIT ".$min.",".$max;
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function get_active_news($school_id)		{
			$limit=5;
			$sql = "SELECT * FROM news where school_id=$school_id and  status='active' ORDER BY news_id 	 ASC";
			$pagination_qatar = new pagination_key();
		$pagination_qatar->createPaging($sql,$limit);
		while($row=mysql_fetch_object($pagination_qatar->resultpage)){
		$rowdc[]=$row;
		}
		  $rowdc['total_rec']=$pagination_qatar->totalrecords();
		  $rowdc['dis_page']=$pagination_qatar->displayPaging();
		 
		return $rowdc;
		}
		
	function get_news_info($id){
		$sql="select * from news where news_id=$id";
		$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function get_news_latest($school_id){
		$sql="select * from news where school_id=$school_id and  status='active' ORDER BY news_id ASC limit 2";
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		return $record;
	}
}
?>
