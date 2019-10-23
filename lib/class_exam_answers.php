<?php
class exams_answers{
    function __construct(){
      $this->query=new Queries();
	 $this->table = 'test_answers';
	}
	function answers_insert($array){

			return $this->query->makeinsertquery_uploadfiles($this->table,$array);
	}
	function answers_update($array,$where){
	   return $this->query->makeupdatequery_uploadfiles($this->table,$array,$where);	
	}
	function answers_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function answers_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function answers_delete_from($value1,$value2,$value3){
		$sql="delete  from ".$this->table." where chapter_id=$value1 and ans_number='$value2'  and section like '%$value3%'";
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
		function answers_updatelike($value1,$value2){
		$sql="update ".$this->table." set section='$value1' where section like'%$value1%' and chapter_id=$value2";
	//	echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function answers_like_all($value1,$value2,$value3){
		$sql="select * from ".$this->table." where chapter_id=$value1 and ans_number=$value2 and section like '%$value3%'";
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}

}
?>