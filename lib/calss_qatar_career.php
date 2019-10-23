<?php
 class qatar_career{
	 var $query;
	var $table;
	
    function __construct()
	{
      $this->table='career';
	  $this->query=new Queries();
	}
	function qatar_career_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function qatar_career_set_function($array,$where){
		return $this->query->makeupdatequery($this->table,$array,$where);
	}
	function qatar_career_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function qatar_career_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function qatar_career_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function qatar_career_select($column,$field,$value){
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	function qatar_career_disp($val,$max)
	{
		$min=$max;
		$max = $max+'15';
		$sql = "SELECT career_id , career_name , create_date , status FROM career ";
			if($val == '0')$sql.= "ORDER BY career_name";elseif($val == '1')$sql.= "ORDER BY news_title DESC";
			elseif($val == '2')$sql.= "ORDER BY create_date";elseif($val == '3')$sql.= "ORDER BY create_date DESC";
			elseif($val == '4')$sql.= "ORDER BY status";elseif($val == '5')$sql.= "ORDER BY status DESC";
		$sql.= " LIMIT ".$min.",".$max;
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
}
?>
