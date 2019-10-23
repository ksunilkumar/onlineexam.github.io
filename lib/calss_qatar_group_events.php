<?php

class qatar_group_events{
	 var $query;
	var $table;

    function __construct()
	{
	  $this->table='qatar_group_events';
      $this->query=new Queries();
	}
	
	function qatar_group_events_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}

	function qatar_group_events_set_function($array,$where){
		return $this->query->makeupdatequery($this->table,$array,$where);
	}
	
	function qatar_group_events_update($array,$where)
	{
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}

	function qatar_group_events_delete($field,$value)
	{
		return $this->query->makedeletequery($this->table,$field,$value);

	}

	function qatar_group_events_selectall($field,$value)
	{
		return $this->query->makeselectallquery($this->table,$field,$value);

	}
	
	function qatar_group_events_select($column,$field,$value)
	{
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	
	
	function get_active_events($group_id)
	{
		$sql = "SELECT * from qatar_group_events where group_id = ".$group_id." and status = 'active' order by event_date desc";
			
			$objSql = new SqlClass();
			
			$record1 = $objSql->executeSql($sql);
			
			while($row1 = $objSql->fetchRow($record1))
			{
				$record[] = $row1;
			}			
			
			return $record;		
	}
	
	
}
?>
