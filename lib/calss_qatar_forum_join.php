<?php

class qatar_forum_join{
	 var $query;
	var $table;
	
    function __construct()
	{
	  $this->table='qatar_join_forum';
      $this->query=new Queries();
	}
	
	function qatar_forum_join_insert($array){

			return $this->query->makeinsertquery($this->table,$array);
	}

	function qatar_forum_join_set_function($array,$where)
	{
		return $this->query->makeupdatequery($this->table,$array,$where);
	}

	
	function qatar_forum_join_update($array,$where)
	{
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}


	function qatar_forum_join_delete($field,$value)
	{
		return $this->query->makedeletequery($this->table,$field,$value);

	}


	function qatar_forum_join_selectall($field,$value)
	{
		return $this->query->makeselectallquery($this->table,$field,$value);

	}

	function qatar_forum_join_select($column,$field,$value)
	{
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	
	
		
	function get_posts_count()
	{
		$sqldc = "SELECT f_c_id FROM qatar_forum_join ";
		if(isset($_SESSION['pid'])) $sqldc.= "where f_topic_id = ".$_SESSION['pid']." ";
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);
		
		$rows = $objSqldc->getNumRecord();
		
		return $rows;
	}
	
	function qatar_forum_join_selectexisting($val1,$val2)
	{
		$sql = "SELECT count(*) as count FROM qatar_join_forum WHERE user_id=".$val1." AND forum_id=".$val2;
		    //echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			return $row['count'];
	}
}
?>
