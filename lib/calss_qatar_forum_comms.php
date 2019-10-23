<?php

class qatar_forum_comms{
	 var $query;
	var $table;
	
    function __construct()
	{
	  $this->table='forum_comms';
      $this->query=new Queries();
	}
	
	function qatar_forum_comms_insert($array){

			return $this->query->makeinsertquery($this->table,$array);
	}

	function qatar_forum_comms_set_function($array,$where)
	{
		return $this->query->makeupdatequery($this->table,$array,$where);
	}

	
	function qatar_forum_comms_update($array,$where)
	{
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}


	function qatar_forum_comms_delete($field,$value)
	{
		return $this->query->makedeletequery($this->table,$field,$value);

	}


	function qatar_forum_comms_selectall($field,$value)
	{
		return $this->query->makeselectallquery($this->table,$field,$value);

	}

	function qatar_forum_comms_select($column,$field,$value)
	{
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	
	function display_posts($ob,$max,$limit)
	{
		$sqldc = "SELECT f_c_id,f_topic_id,f_c_desc,user_id,create_date,status FROM forum_comms ";
		if(isset($_SESSION['pid'])) $sqldc.= "where f_topic_id = ".$_SESSION['pid']." ";
		if($ob == 'a') $sqldc.= "order by f_c_desc asc"; elseif($ob == 'a1') $sqldc.= "order by f_c_desc desc";
		if($ob == 'b') $sqldc.= "order by create_date asc"; elseif($ob == 'b1') $sqldc.= "order by create_date desc";			
		if($ob == 'c') $sqldc.= "order by status asc"; elseif($ob == 'c1') $sqldc.= "order by status desc";
		$sqldc.=" limit ".$max.",".$limit ;
		//echo $sqldc;
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);
		
		while($row = $objSqldc->fetchRow($recorddc))
		{			
			$rowdc[] = $row;
		}
		return $rowdc;
	}
		
	function get_posts_count()
	{
		$sqldc = "SELECT f_c_id FROM qatar_forum_comms ";
		if(isset($_SESSION['pid'])) $sqldc.= "where f_topic_id = ".$_SESSION['pid']." ";
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);
		
		$rows = $objSqldc->getNumRecord();
		
		return $rows;
	}

}
?>
