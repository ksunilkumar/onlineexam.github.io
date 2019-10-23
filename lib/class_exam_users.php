<?php
class exams_users{
    function __construct(){
      $this->query=new Queries();
	 $this->table = 'test_users';
	}
	function users_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function users_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function users_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function users_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function users_allnames_select(){
		 $sql = "SELECT user_id,user_fname FROM ise_users"; 
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function users_name_select($field,$value){
		$sql = "SELECT * FROM test_users WHERE sno=". +  $value; 
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	
}
?>
