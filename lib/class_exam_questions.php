<?php
class exams_questions{
    function __construct(){
      $this->query=new Queries();
	 $this->table = "test_questions";
	}
	function questions_insert($array){
		
			return $this->query->makeinsertquery_uploadfiles($this->table,$array);
	}
	function questions_update($array,$where){
	   return $this->query->makeupdatequery_uploadfiles($this->table,$array,$where);	
	}
	function questions_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function questions_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function questions_delete_from($value1,$value2,$value3){
		$sql="delete  from ".$this->table." where chapter_id=$value1 and que_number='$value2'  and section like '%$value3%'";
		//echo $sql."<br>";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
		function questions_updatelike($value1,$value2){
		$sql="update ".$this->table." set section='$value1' where section like'%$value1%' and chapter_id=$value2";
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	
	function get_sections($value){
		$sql="select distinct section from ".$this->table." where chapter_id = ".$value." ORDER BY section";
		$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			while($row = $objSql->fetchRow($record)){
			$rows[]=$row;
		
		}
			return $rows;
	}
	
	function get_questions($id,$sc)
	{
		$sql="select * from ".$this->table." where chapter_id='$id' and section like '%$sc%' order by que_number";
		//echo "<br>";
		$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			while($row = $objSql->fetchRow($record)){
			$rows[]=$row;
		
		}
			return $rows;
		
	}
	
	function get_options($id,$sc)
	{
		$sql="select * from test_options where chapter_id='$id' and section like '%$sc%' order by option_number";
		//echo "<br>";
		$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			while($row = $objSql->fetchRow($record)){
			$rows[]=$row;
		
		}
			return $rows;
		
	}
	
	function get_answers($id,$sc)
	{
		$sql="select * from test_answers where chapter_id='$id' and section like '%$sc%' order by ans_number";
		//echo "<br>";
		$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			while($row = $objSql->fetchRow($record))
			{
				$rows[]=$row;		
			}
			return $rows;		
	}


}
?>