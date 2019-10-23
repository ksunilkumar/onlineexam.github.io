<?php
class qatar_polls{
	 var $query;
	var $table;
	
    function __construct(){
	  
      $this->query=new Queries();
	  $this->table='polls';
	}
	function qatar_polls_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function qatar_polls_set_function($array,$where){
		return $this->query->makeupdatequery($this->table,$array,$where);
	}
	function qatar_polls_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function qatar_polls_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function qatar_polls_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function qatar_polls_select($column,$field,$value){
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	function qatar_polls_disp($val,$max)
	{
		$min=$max;
		$max = $max+'15';
		$sql = "SELECT poll_id , poll_title , create_date , status FROM polls ";
			if($val == '0')$sql.= "ORDER BY poll_title";elseif($val == '1')$sql.= "ORDER BY poll_title DESC";
			elseif($val == '2')$sql.= "ORDER BY create_date";elseif($val == '3')$sql.= "ORDER BY create_date DESC";
			elseif($val == '4')$sql.= "ORDER BY status";elseif($val == '5')$sql.= "ORDER BY status DESC";
		$sql.= " LIMIT ".$min.",".$max;
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function qatar_polls_one()
	{
		$sql = "SELECT * FROM polls WHERE status = 'active' ORDER BY create_date DESC LIMIT 0,1";
			
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		$row = $objSql->fetchRow($record);
		return $row;
	}
	function qatar_polls_all($min)
	{
		$max = $min+'4';
		 $sql = "SELECT * FROM polls WHERE status = 'active' ORDER BY create_date DESC LIMIT ".$min.",".$max;
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		return $record;
	}
}
?>
