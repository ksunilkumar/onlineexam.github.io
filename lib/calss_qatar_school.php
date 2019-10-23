<?php
class qatar_schools{
	var $query;
	var $table;
	
    function __construct(){
	 
	$this->table='qse_schools';
	 
      $this->query=new Queries();
	}
	function get_school_name($id)
	{
		 $sql_u = "SELECT school_name from qse_schools where school_id=".$id;
		$objSql_1 = new SqlClass();
		$record_u = $objSql_1->executeSql($sql_u);
		$row_1 = $objSql_1->fetchRow($record_u);
		return $row_1['school_name'];
	}
		function qatar_schools_set_function($array,$where){
		return $this->query->makeupdatequery($this->table,$array,$where);
	}
	
	function qatar_emp_set_function($array,$where){
		return $this->query->makeupdatequery('sis_employee',$array,$where);
	}

}
?>