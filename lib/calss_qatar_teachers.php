<?php
class qatar_users{
	var $query;
	var $table;
	
    function __construct()
	{
	  $this->table='qatar_users';
	  $this->table_fb='qatar_feedback';
	  $this->table_country='qatar_country';
	  $this->table_state='qatar_state';

      $this->query=new Queries();
	}
	function qatar_users_grade_set_function($array,$where){
		return $this->query->makeupdatequery('qatar_user_grade',$array,$where);
	}
	function qatar_users_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function qatar_feedback_insert($array){
            return $this->query->makeinsertquery($this->table_fb,$array);
    }
	function qatar_users_grade_insert($array){
			return $this->query->makeinsertquery("qatar_user_grade",$array);
	}	   
	function qatar_users_set_function($array,$where){
		return $this->query->makeupdatequery($this->table,$array,$where);
	}
	function qatar_users_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function qatar_fb_update($array,$where){
	   return $this->query->makeupdatequery($this->table_fb,$array,$where);	
	}
	function qatar_users_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function qatar_users_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function qatar_fb_delete($field,$value){
		return $this->query->makedeletequery($this->table_fb,$field,$value);
	}
	function qatar_users_select($column,$field,$value){
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	function qatar_country_select($column,$field,$value){
		return $this->query->makeselectquery($this->table_country,$column,$field,$value);
	}
	function qatar_state_select($column,$field,$value){
		return $this->query->makeselectquery($this->table_state,$column,$field,$value);
	}
	function qatar_users_disp($var,$val,$max){
		$min=$max;
		$max = $max+'15';
		$sql = "SELECT user_id, username, email_id, create_date, status FROM  qatar_users ";
		if($var == 'or'){
			if($val == '0')$sql.= "ORDER BY username";elseif($val == '1')$sql.= "ORDER BY username DESC";
			elseif($val == '2')$sql.= "ORDER BY email_id";elseif($val == '3')$sql.= "ORDER BY email_id DESC";
			elseif($val == '4')$sql.= "ORDER BY create_date";elseif($val == '5')$sql.= "ORDER BY create_date DESC";
			elseif($val == '6')$sql.= "ORDER BY status";elseif($val == '7')$sql.= "ORDER BY status DESC";
		}
		else if($var == 'al')$sql.="WHERE username LIKE '".$val."%'";
		$sql.= " LIMIT ".$min.",".$max;
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		return $record;
	}

	function qatar_users_check($vk)
	{
		$sql = "SELECT * qatar_users where username=$vk";
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		$num=mysql_num_rows($record);
		return $record;
	
	}
	
	function chk_user($un,$pw,$sch_id)
	{
		 $sql = "SELECT * FROM  qatar_teachers where username='$un' and password='$pw'";
		
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sql);
		$row[0] = $objSqldc->getNumRecord();
		$row[1] = $objSqldc->fetchRow($recorddc);
		
		return $row;
		
	}
	function chk_em($em)
	{
		 $sql = "SELECT  user_id,email_id from qatar_users where email_id='$em' ";
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sql);
		$row = $objSqldc->getNumRecord();
		return $row;
	}
	function user_name($id)
	{
		 $sql_u = "SELECT username from qatar_users where user_id=".$id;
		$objSql_1 = new SqlClass();
		$record_u = $objSql_1->executeSql($sql_u);
		$row_1 = $objSql_1->fetchRow($record_u);
		return $row_1['username'];
	}
	function user_most_active()
	{
		$sql_u = "SELECT username from qatar_users where status='active' ORDER BY user_visits DESC";
		$objSql_1 = new SqlClass();
		$record_u = $objSql_1->executeSql($sql_u);
		$row_1 = $objSql_1->fetchRow($record_u);
		return $row_1['username'];
	}
	function qatar_users_selectschools(){
	$sql1 = "SELECT * FROM qatar_users where user_type ='group_user'";
	$objSql = new SqlClass();
	$record1 = $objSql->executeSql($sql1);
	while($row = $objSql->fetchRow($record1)){
		$rows[]=$row;
		
		}
		return $rows;
	}
	function user_last_login()
	{
		$sql_u = "SELECT username from qatar_users where status='active' ORDER BY create_date DESC";
		$objSql_1 = new SqlClass();
		$record_u = $objSql_1->executeSql($sql_u);
		$row_1 = $objSql_1->fetchRow($record_u);
		return $row_1['username'];
	}
 	function get_schools()
	{
	 	 $sql = "SELECT  user_id,q_u_name from qatar_users where user_type='group_user' and status = 'active' ";
		
		$objSqldc = new SqlClass();
		
		$record1 = $objSqldc->executeSql($sql);
		$sch_names = "<select name='sch_name' style='width:150px;'>";
		$sch_names.= "<option value=''>Select School</option>";
		while($row1 = $objSqldc->fetchRow($record1))
		{
			$sch_names.= "<option value='".$row1['user_id']."'>".$row1['q_u_name']."</option>";
		}
		$sch_names.= "</select>";
		
		return $sch_names;
	}
	function get_school_name_id($shid)
	{
	 	 $sql = "SELECT  q_u_name from qatar_users where user_id=".$shid;
		
		$ob = new SqlClass();
		
		$record1 = $ob->executeSql($sql);
		$row1 = $ob->fetchRow($record1);
		return $row1;
	}
	function chk_user_forgot($un,$que,$ans)
	{
		 $sql = "SELECT user_id, q_u_name, email_id, school_id, user_type, username, display_name, status FROM  qatar_users where username='$un' and rec_question='$que' and rec_answer='$ans'";
		
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sql);
		
		$row[0] = $objSqldc->getNumRecord();
		$row[1] = $objSqldc->fetchRow($recorddc);
		
		return $row;
		
	}
}
?>
