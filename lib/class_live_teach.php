<?php
class qatar_all_live_teach{
	var $query;
	var $table;
	
    function __construct(){
	 
	  $this->table='qatar_teachers';
	  $this->session='qatar_online_class';
	  $this->table_class_com='session_transactions';
	   $this->user ='users';
	  $this->query=new Queries();
	  $this->curyear = date('Y');	 
	}
	/*Live Teachers Function Begin*/
	function qatar_live_teach_insert($array){
	print_r($array);
			return $this->query->makeinsertquery($this->table,$array);
	}
	function qatar_live_teach_set_function($array,$where){
		return $this->query->makeupdatequery($this->table,$array,$where);
	}
	function qatar_live_teach_update($array,$where){
	echo "hello";
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function qatar_live_teach_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function qatar_live_teach_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function qatar_live_teach_select($column,$field,$value){
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	
	/*Live Teachers Online class Function End*/
	/*Live Teachers Online class Comments Function Begin*/
	function qatar_live_teach_comm_insert($array){
			return $this->query->makeinsertquery($this->table_class_com,$array);
	}
	function qatar_live_teach_comm_set_function($array,$where){
		return $this->query->makeupdatequery($this->table_class_com,$array,$where);
	}
	function qatar_live_teach_comm_update($array,$where){
	   return $this->query->makeupdatequery($this->table_class_com,$array,$where);	
	}
	function qatar_live_teach_comm_delete($field,$value){
		return $this->query->makedeletequery($this->table_class_com,$field,$value);
	}
	function qatar_live_teach_comm_selectall($field,$value){
		return $this->query->makeselectallquery($this->table_class_com,$field,$value);
	}
	function qatar_live_teach_comm_select($column,$field,$value){
		return $this->query->makeselectquery($this->table_class_com,$column,$field,$value);
	}
	/*Live Teachers Online class Comments Function End*/
	/*Live Teachers Online class session Function Begin*/
	function qatar_live_teach_session_insert($array){
			return $this->query->makeinsertquery($this->session,$array);
	}
	function qatar_live_teach_set_session_function($array,$where){
		return $this->query->makeupdatequery($this->session,$array,$where);
	}
	function qatar_live_teach_session_update($array,$where){
	   return $this->query->makeupdatequery($this->session,$array,$where);	
	}
	function qatar_live_teach_session_delete($field,$value){
		return $this->query->makedeletequery($this->session,$field,$value);
	}
	function qatar_live_teach_session_selectall($field,$value){
		return $this->query->makeselectallquery($this->session,$field,$value);
	}
	function qatar_live_teach_session_select($column,$field,$value){
		return $this->query->makeselectquery($this->session,$column,$field,$value);
	}
	/*Live Teaching Modules*/
	
	function chk_member($studentid,$sessionid)
	{
		
		$sqldc = "select student_id from session_transactions where student_id=".$studentid." AND session_id=".$sessionid;
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);
		$row = $objSqldc->fetchRow($recorddc);
		return $row;
	}
	
	function teach_details($teacherid,$value){
	$sql= "select *  from   $this->table where $teacherid =$value";
	//echo  $sql;
	$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sql);
		$row = $objSqldc->fetchRow($recorddc);
		return $row;
	}
	function session_class_details($class,$value,$dt,$de){
	$sql= "select *  from  $this->session where $class =$value and class_start_date >= '$dt' and class_start_date like '$de%'";
	//echo  $sql;
	$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sql);
		return $recorddc;
	}
	function count_of_session($field,$value){
	 $sql= "SELECT * FROM $this->table_class_com where $field =$value";
	//echo  $sql;
	$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sql);
	
		$count = $objSqldc->getNumRecord($recorddc);
		
		return $count;
	}
	function qatar_display_sessions($grades)
	{
		 $sql1 = "SELECT sessions.session_id,sessions.name, sessions.time, sessions.noofstudents, teachers.firstname,teachers.photo, sessions.price, sessions.duration
FROM $this->session,  $this->table
WHERE sessions.teacher_id = teachers.emp_id and grade_id in($grades)
ORDER BY time desc ";
		$objSql1 = new SqlClass();
		return $record1 = $objSql1->executeSql($sql1);	
	}
	
	function become_a_member($studentid,$sessionid)
	{
	$sqldc = "insert into session_transactions(student_id,session_id) values('".$studentid."','".$sessionid."')";
		$objSqldc = new SqlClass();
		$objSqldc->executeSql($sqldc);		
	}
	
		function users_name_select($field,$value){
	 	$sql = "SELECT * FROM $this->user WHERE sno=". +  $value; 
		
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
}
?>
