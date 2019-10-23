<?php

class qatar_upcoming_debates{
    function __construct(){
      $this->query=new Queries();
	 $this->table = 'qatar_upcoming_debates';
	}
	function qatar_upcoming_debates_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function qatar_upcoming_debates_set_function($array,$where){
		return $this->query->makeupdatequery($this->table,$array,$where);
	}
	function qatar_upcoming_debates_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function qatar_upcoming_debates_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function qatar_upcoming_debates_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function qatar_upcoming_debates_select($column,$field,$value)	{
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	function qatar_upcoming_debates_selectallrows(){
		return $this->query->makeselectall($this->table);
	}
	
	function qatar_upcoming_debates_disp($val,$max)
	{
		$min=$max;
		$max = $max+'15';
		$sql = "SELECT debate_id, debate_title, launchedby,members_in_debate, sponsors, sponsors_logo FROM qatar_upcoming_debates ";
			if($val == '0')$sql.= "ORDER BY debate_title";elseif($val == '1')$sql.= "ORDER BY debate_title DESC";
			elseif($val == '2')$sql.= "ORDER BY launchedby";elseif($val == '3')$sql.= "ORDER BY launchedby DESC";
			elseif($val == '4')$sql.= "ORDER BY members_in_debate";elseif($val == '5')$sql.= "ORDER BY members_in_debate DESC";
			elseif($val == '6')$sql.= "ORDER BY sponsors";elseif($val == '7')$sql.= "ORDER BY sponsors DESC";
			elseif($val == '8')$sql.= "ORDER BY sponsors_logo";elseif($val == '9')$sql.= "ORDER BY sponsors_logo DESC";
		$sql.= " LIMIT ".$min.",".$max;
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	
}
?>
