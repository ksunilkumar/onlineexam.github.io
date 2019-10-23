<?php

class qatar_adds{
	 var $query;
	var $table;

    function __construct()
	{
	  $this->table='qatar_manage_adds';
	  $this->table_country='qatar_country';
	  $this->table_state='qatar_state';
      $this->query=new Queries();
	}
	
	function qatar_adds_insert($array){

			return $this->query->makeinsertquery($this->table,$array);
	}

	function qatar_adds_set_function($array,$where)
	{
		return $this->query->makeupdatequery($this->table,$array,$where);
	}
	
	function qatar_country_set_function($array,$where)
	{
		return $this->query->makeupdatequery($this->table_country,$array,$where);
	}
	
	function qatar_state_set_function($array,$where)
	{
		return $this->query->makeupdatequery($this->table_state,$array,$where);
	}

	
	function qatar_adds_update($array,$where)
	{
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}


	function qatar_adds_delete($field,$value)
	{
		return $this->query->makedeletequery($this->table,$field,$value);

	}
	
	function qatar_country_delete($field,$value)
	{
		return $this->query->makedeletequery($this->table_country,$field,$value);

	}
	
	function qatar_state_delete($field,$value)
	{
		return $this->query->makedeletequery($this->table_state,$field,$value);

	}


	function qatar_adds_selectall($field,$value)
	{
		return $this->query->makeselectallquery($this->table,$field,$value);

	}

	function qatar_adds_select($column,$field,$value)
	{
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}	
	
	
	function get_state_id($con_id,$state){
		$sql1 = "SELECT state_id FROM qatar_state WHERE country_id= $con_id and state_name=$state";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$row = $objSql1->fetchRow($record1);
		
		return $row;
	}	

}
?>
