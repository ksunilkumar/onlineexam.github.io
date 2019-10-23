<?php
class qatar_tutors{
	var $query;
	var $table;
	
    function __construct()
	{
	  $this->table='sis_employee';
	  $this->table_fb='sis_address';
	  $this->table_country='qatar_country';
	  $this->table_state='qatar_state';

      $this->query=new Queries();
	}
	
	function qatar_users_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function qatar_feedback_insert($array){
            return $this->query->makeinsertquery($this->table_fb,$array);
    }
	
	function qatar_fb_update($array,$where){
	   return $this->query->makeupdatequery($this->table_fb,$array,$where);	
	}
	function qatar_users_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function qatar_fb_delete($field,$value){
		return $this->query->makedeletequery($this->table_fb,$field,$value);
	}
	function qatar_users_set_function($array,$where){
		return $this->query->makeupdatequery($this->table,$array,$where);
	}
	

	function user_name_one($id)
	{
		 $sql_u = "SELECT username from sis_employee where emp_id='".$id."'";
		 $objSql_1 = new SqlClass();
		$record_u = $objSql_1->executeSql($sql_u);
		$row_1 = $objSql_1->fetchRow($record_u);
		return $row_1['username'];
	}
	function get_email($id)
		{
		$sql="SELECT Email FROM `sis_address` WHERE id='$id'";
		//echo $sql;
				$this->objSqldc= new SqlClass();
				return $recorddc = $this->objSqldc->executeSql($sql);
		}
	
	function user_values($val)
		{
			 $sql = "SELECT * FROM sis_employee WHERE emp_id = '".$val."'";
			 $objSql = new SqlClass();
			$recore = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($recore);
			return $row;
		}
		function user_Address($val)
		{
			$sql = "SELECT * FROM sis_address WHERE id = '".$val."'";
			$objSql = new SqlClass();
			$recore = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($recore);
			return $row;
		}
		function new_user_id()
	{
			 $value1 = $this->query->makeselectquery('sis_employee',"Max(emp_id) as studentid",'1','1');
		
			 $val1=substr("$value1",-5);
		
			 $year = substr("$value1",3,-5);
			 $year_now = date('y');
			 if($year_now==$year)
			 {
				if($val1<9)
				{
					$val1=$val1+1;
					$val1='0000'.$val1;
				}elseif($val1<99)
				{
					$val1=$val1+1;
					$val1='000'.$val1;
				}elseif($val1<999)
				{
					$val1=$val1+1;
					$val1='00'.$val1;
				}elseif($val1<9999)
				{
					$val1=$val1+1;
					$val1='0'.$val1;
				}
				$user_id = 'emp'.$year.$val1;
			 }else
			 {
				$user_id='emp'.$year_now.'00001';
			 }
//			 echo $user_id;
			 return $user_id;
		}
		function checkuser($user)
	{
		$sql="select username from sis_employee where username='".$user."'";
		$objSql1 = new SqlClass();
		$val = $objSql1->executeSql($sql);
		$cnt=0;
		while($row = $objSql1->fetchRow($val)){
			$cnt++;
		}
		
		if($cnt > 0)
		{ 
           return "Username already exists";  
	} else 
		return "Available";
		
	}
}
?>
