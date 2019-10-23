<?php
class ise_users{
	var $query;
	var $table;
	 function __construct()
	{
	  $this->table='ise_users';
	  $this->table_fb='qatar_feedback';
	  $this->table_country='qatar_country';
	  $this->table_state='qatar_state';

      $this->query=new Queries();
	}
	//**********  anu nov 12 th ******* //f
	function get_user_city($val)
		{
		
		 $sql = "SELECT name FROM sis_city WHERE cityid = ".$val;
			
			$objSql = new SqlClass();
			$recore = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($recore);
			return $row[0];
		
		}
	function get_ads_details($val)
		{
			
			$sql = "SELECT * FROM sis_address WHERE id = '".$val."'";
			
			
			$objSql = new SqlClass();
			$recore = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($recore);
			
			return $row;
		}
		function country_onchange_select($val){
			 $sql1 = "SELECT countryid, name FROM sis_country ORDER BY  name ";
			
			$objSql1 = new SqlClass();
			$record1 = $objSql1->executeSql($sql1);
			$out = "<select name='selcountry' onChange='state_onchange(this.value)'>";
			$out.= "<option value=''>Select Country from List</option>";
			while($row1 = $objSql1->fetchRow($record1))
			{
				if($row1['countryid'] == $val)
				{
				
				$out.= "<option value='".$row1['countryid']."' selected='selected'>".$row1['name']."</option>";
				}
				else
				$out.= "<option value='".$row1['countryid']."'>".$row1['name']."</option>";
			}
			$out.= "</select>";
			return $out;
		}
		
		function state_onchange_select($sid,$cid)
		{
			 $sql1 = "SELECT stateid, name FROM sis_state WHERE countryid = '".$cid."' ORDER BY name ";
			$objSql1 = new SqlClass();
			$record1 = $objSql1->executeSql($sql1);
			$out = "<select name='selstate' id='selstate' onchange='district_onchange(this.value)'>";
			$out.= "<option value=''>Select State from List</option>";
			while($row1 = $objSql1->fetchRow($record1))
			{
				if($row1['stateid'] == $sid)
				$out.= "<option value='".$row1['stateid']."' selected>".$row1['name']."</option>";
				else
				$out.= "<option value='".$row1['stateid']."'>".$row1['name']."</option>";
			}
			$out.= "</select>";
			return $out;
		}
		
		function city_onchange_select($cityid,$sid)
		{
			 $sql1 = "SELECT cityid, name FROM sis_city WHERE stateid = '".$sid."' ORDER BY name ";
			$objSql1 = new SqlClass();
			$record1 = $objSql1->executeSql($sql1);
			$out = "<select name='selcity' id='selcity' >";
			$out.= "<option value=''>Select City from List</option>";
			while($row1 = $objSql1->fetchRow($record1))
			{
				if($row1['cityid'] == $cityid)
				$out.= "<option value='".$row1['cityid']."' selected>".$row1['name']."</option>";
				else
				$out.= "<option value='".$row1['cityid']."'>".$row1['name']."</option>";
			}
			$out.= "</select>";
			return $out;
		}
		function nationality_dropdown_select($val)
		{
			$sql1 = "SELECT nationalityid, name FROM sis_nationality ORDER BY name";
			$objSql1 = new SqlClass();
			$record1 = $objSql1->executeSql($sql1);
			$out = "<select name='selnationality'>";
			$out.= "<option value=''>Select Nationality from List</option>";
			while($row1 = $objSql1->fetchRow($record1))
			{
				if($row1['nationalityid'] == $val)
				$out.= "<option value='".$row1['nationalityid']."' selected>".$row1['name']."</option>";
				else
				$out.= "<option value='".$row1['nationalityid']."'>".$row1['name']."</option>";
			}
			$out.= "</select>";
			return $out;
		}
		
	//*******   nov 13th end    ***********//
	//**********  anu nov 12 th ******* //
	function user_values($val,$type='')
		{
			if($type=='student' || $type=='')
			$sql = "SELECT * FROM sis_students WHERE studentid = '".$val."'";
			else
			$sql = "SELECT * FROM sis_employee WHERE emp_id = ".$val;
			
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
		function get_user_country($val)
		{
		
		$sql = "SELECT name FROM sis_country WHERE countryid = ".$val;
			
			$objSql = new SqlClass();
			$recore = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($recore);
			return $row[0];
		
		}
		function get_classname($val)
		{
		
		$sql = "SELECT class_name FROM sis_classes WHERE class_id= ".$val;
			
			$objSql = new SqlClass();
			$recore = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($recore);
			return $row[0];
		}       
		//*******   end    ***********//
		
		
   
	function ise_users_grade_set_function($array,$where){
		return $this->query->makeupdatequery('ise_user_grade',$array,$where);
	}
	function ise_users_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function ise_feedback_insert($array){
            return $this->query->makeinsertquery($this->table_fb,$array);
    }
	function ise_users_grade_insert($array){
			return $this->query->makeinsertquery("ise_user_grade",$array);
	}	   
	function ise_users_set_function($array,$where){
		return $this->query->makeupdatequery($this->table,$array,$where);
	}
	function ise_users_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function ise_fb_update($array,$where){
	   return $this->query->makeupdatequery($this->table_fb,$array,$where);	
	}
	function ise_users_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function ise_users_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function ise_fb_delete($field,$value){
		return $this->query->makedeletequery($this->table_fb,$field,$value);
	}
	function ise_users_select($column,$field,$value){
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	function ise_country_select($column,$field,$value){
		return $this->query->makeselectquery($this->table_country,$column,$field,$value);
	}
	function ise_state_select($column,$field,$value){
		return $this->query->makeselectquery($this->table_state,$column,$field,$value);
	}
	function ise_users_disp($var,$val,$max){
		$min=$max;
		$max = $max+'15';
		$sql = "SELECT user_id, username, email_id, create_date, status FROM  ise_users ";
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

	function ise_users_check($vk)
	{
		$sql = "SELECT * ise_users where username=$vk";
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		$num=mysql_num_rows($record);
		return $record;
	
	}
	
	function chk_user($un,$pw,$sch_id)
	{
		 $sql = "SELECT user_id, q_u_name, email_id, school_id, user_type, username, display_name, status FROM  ise_users where username='$un' and password='$pw' and school_id='$sch_id' ";
		
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sql);
		
		$row[0] = $objSqldc->getNumRecord();
		$row[1] = $objSqldc->fetchRow($recorddc);
		
		return $row;
		
	}
	function chk_em($em)
	{
		 $sql = "SELECT  user_id,email_id from ise_users where email_id='$em' ";
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sql);
		$row = $objSqldc->getNumRecord();
		return $row;
	}
	function user_name($id)
	{
		 $sql_u = "SELECT username from ise_users where user_id=".$id;
		$objSql_1 = new SqlClass();
		$record_u = $objSql_1->executeSql($sql_u);
		$row_1 = $objSql_1->fetchRow($record_u);
		return $row_1['username'];
	}
	function user_name_one($id)
	{
		 $sql_u = "SELECT username from sis_employee where emp_id='".$id."'";
		 $objSql_1 = new SqlClass();
		$record_u = $objSql_1->executeSql($sql_u);
		$row_1 = $objSql_1->fetchRow($record_u);
		return $row_1['username'];
	}
	function user_name_two($id)
	{
		 $sql_u = "SELECT username from sis_students where studentid='".$id."'";
		 $objSql_1 = new SqlClass();
		$record_u = $objSql_1->executeSql($sql_u);
		$row_1 = $objSql_1->fetchRow($record_u);
		return $row_1['username'];
	}
	
	function user_most_active()
	{
		$sql_u = "SELECT username from ise_users where status='active' ORDER BY user_visits DESC";
		$objSql_1 = new SqlClass();
		$record_u = $objSql_1->executeSql($sql_u);
		$row_1 = $objSql_1->fetchRow($record_u);
		return $row_1['username'];
	}
	/*function ise_users_selectschools(){
	$sql1 = "SELECT * FROM ise_users where user_type ='group_user'";
	$objSql = new SqlClass();
	$record1 = $objSql->executeSql($sql1);
	while($row = $objSql->fetchRow($record1)){
		$rows[]=$row;
		
		}
		return $rows;
	}*/
	function user_last_login()
	{
		$sql_u = "SELECT username from ise_users where status='active' ORDER BY create_date DESC";
		$objSql_1 = new SqlClass();
		$record_u = $objSql_1->executeSql($sql_u);
		$row_1 = $objSql_1->fetchRow($record_u);
		return $row_1['username'];
	}
 	function get_schools()
	{
	 	 $sql = "SELECT  user_id,q_u_name from ise_users where user_type='group_user' and status = 'active' ";
		
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
	function get_user_details($shid)
	{
	 	 $sql = "SELECT  *  from ise_users where user_id='".$shid."'";
		//echo $sql;exit;
		$ob = new SqlClass();
		
		$record1 = $ob->executeSql($sql);
		$row1 = $ob->fetchRow($record1);
		return $row1;
	}
	function chk_user_forgot($un,$que,$ans)
	{
		 $sql = "SELECT user_id, q_u_name, email_id, school_id, user_type, username, display_name, status FROM  ise_users where username='$un' and rec_question='$que' and rec_answer='$ans'";
		
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sql);
		
		$row[0] = $objSqldc->getNumRecord();
		$row[1] = $objSqldc->fetchRow($recorddc);
		
		return $row;
		
	}
	function users_name_select($field,$value){
		$sql = "SELECT * FROM  ise_users WHERE user_id=". +  $value; 
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	/////// **********           anu start     ********* /////////////
		function ise_users_selectschools($val)
		{
			$sql1 = "SELECT school_id,school_name FROM qse_schools where act_status ='activated'";
			
			$objSql1 = new SqlClass();
			$record1 = $objSql1->executeSql($sql1);
			$out = "<select name='selschool'  onchange=\"getdata(this.value);\">";
			$out.= "<option value=''>Select School</option>";
			while($row1 = $objSql1->fetchRow($record1))
			{
				if($row1['school_id'] == $val)
				$out.= "<option value='".$row1['school_id']."' selected>".$row1['school_name']."</option>";
				else
				$out.= "<option value='".$row1['school_id']."'>".$row1['school_name']."</option>";
			}
			$out.= "</select>";
			return $out;
		}

	
		function get_email($id)
		{
		$sql="SELECT Email FROM `sis_address` WHERE id='$id'";
		//echo $sql;
				$this->objSqldc= new SqlClass();
				return $recorddc = $this->objSqldc->executeSql($sql);
		}
		function get_email_one($id)
		{
		$sql="SELECT * FROM `sis_address` WHERE id='$id'";
		//echo $sql;
				$this->objSqldc= new SqlClass();
				return $recorddc = $this->objSqldc->executeSql($sql);
		}
	function get_student_address($id)
		{
		$sql="SELECT * FROM `sis_address` WHERE id='$id'";
		//echo $sql;
				$this->objSqldc= new SqlClass();
				return $recorddc = $this->objSqldc->executeSql($sql);
		}
	function new_user_id()
	{
			 $value1 = $this->query->makeselectquery('sis_students',"Max(studentid) as studentid",'1','1');
		
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
				$user_id = 'stu'.$year.$val1;
			 }else
			 {
				$user_id='stu'.$year_now.'00001';
			 }
//			 echo $user_id;
			 return $user_id;
		}
	function new_emp_id()
	{
			 $value1 = $this->query->makeselectquery('sis_employee',"Max(emp_id) as empid",'1','1');
		
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
		$sql="select username from sis_students where username='".$user."'";
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
	function get_city_name($id){
		$sql="select name from sis_city where cityid='".$id."'";
		$objSql1 = new SqlClass();
		return $val = $objSql1->executeSql($sql);	
	}
	function chk_user1($user)
	{
		$sql="select * from ise_users where user_email='".$user."'";
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
	/////// **********           anu start     ********* /////////////
	
}
?>
