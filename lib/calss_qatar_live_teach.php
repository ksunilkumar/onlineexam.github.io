<?php
class qatar_live_teach{
	var $query;
	var $table;
	
    function __construct(){
	 
	  $this->table='sis_employee';
	  $this->table_online_c='qatar_online_class';
	  $this->table_class_com='qatar_class_comments';
	  $this->table_class_mem='qatar_class_members';
	  $this->table_class_sche='qatar_class_schedule';
      $this->query=new Queries();
	  $this->curyear = date('Y');	 
	}
	/*Live Teachers Function Begin*/
	function qatar_live_teach_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function qatar_live_teach_set_function($array,$where){
		return $this->query->makeupdatequery($this->table,$array,$where);
		
	}
	function qatar_live_teach_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function qatar_live_teach_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function qatar_live_teach_delete_one($field,$value){
		return $this->query->makedeletequery($this->table_online_c,$field,$value);
	}
	function qatar_live_teach_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function qatar_live_teach_select($column,$field,$value){
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	/*Live Teachers Function End*/
	/*Live Class Schedule Function Begin*/
	function qatar_live_sche_insert($array){
			return $this->query->makeinsertquery($this->table_class_sche,$array);
	}
	function qatar_live_sche_set_function($array,$where){
		return $this->query->makeupdatequery($this->table_class_sche,$array,$where);
	}
	function qatar_live_sche_update($array,$where){
	   return $this->query->makeupdatequery($this->table_class_sche,$array,$where);	
	}
	function qatar_live_sche_delete($field,$value){
		return $this->query->makedeletequery($this->table_class_sche,$field,$value);
	}
	function qatar_live_sche_selectall($field,$value){
		return $this->query->makeselectallquery($this->table_class_sche,$field,$value);
	}
	function qatar_live_sche_select($column,$field,$value){
		return $this->query->makeselectquery($this->table_class_sche,$column,$field,$value);
	}
	/*Live Class Schedule Function End*/
	/*Live Teachers Online class Function Begin*/
 	function qatar_live_teach_class_insert($array){
			return $this->query->makeinsertquery($this->table_online_c,$array);
	}
	function qatar_live_teach_set_class_function($array,$where){
		return $this->query->makeupdatequery($this->table_online_c,$array,$where);
	}
	function qatar_live_teach_class_update($array,$where){
	   return $this->query->makeupdatequery($this->table_online_c,$array,$where);	
	}
	function qatar_live_teach_class_delete($field,$value){
		return $this->query->makedeletequery($this->table_online_c,$field,$value);
	}
	function qatar_live_teach_class_selectall($field,$value){
		return $this->query->makeselectallquery($this->table_online_c,$field,$value);
	}
	function qatar_live_teach_class_select($column,$field,$value){
		return $this->query->makeselectquery($this->table_online_c,$column,$field,$value);
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
	/*Live Teachers Online class Members Function Begin*/
	function qatar_live_teach_members_insert($array){
			return $this->query->makeinsertquery($this->table_class_mem,$array);
	}
	function qatar_live_teach_set_members_function($array,$where){
		return $this->query->makeupdatequery($this->table_class_mem,$array,$where);
	}
	function qatar_live_teach_members_update($array,$where){
	   return $this->query->makeupdatequery($this->table_class_mem,$array,$where);	
	}
	function qatar_live_teach_members_delete($field,$value){
		return $this->query->makedeletequery($this->table_class_mem,$field,$value);
	}
	function qatar_live_teach_members_selectall($field,$value){
		return $this->query->makeselectallquery($this->table_class_mem,$field,$value);
	}
	function qatar_live_teach_members_select($column,$field,$value){
		return $this->query->makeselectquery($this->table_class_mem,$column,$field,$value);
	}
	/*Live Teachers Online class Members Function End*/
	function qatar_live_teschers_dropdown_change($school_id)
	{
		$sql1 = "SELECT emp_id, alias FROM sis_employee WHERE status = '1' and school_id=$school_id ORDER BY alias ";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='selteacher' style='width:180px;' onchange='change_teacher(this.value)'>";
		$out.= "<option value='0'>Select Teacher Name from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			if($row1['emp_id'] == $_GET['teach_id'])
				$out.= "<option value='".$row1['emp_id']."' selected>".$row1['alias']."</option>";
			else
				$out.= "<option value='".$row1['emp_id']."'>".$row1['alias']."</option>";
		}
		$out.= "</select>";
		return $out;
	}
 
	function qatar_live_teschers_dropdown($school_id)
	{
		$sql1 = "SELECT emp_id, alias FROM sis_employee WHERE status = 1 and designation='Teacher' and  school_id=$school_id ORDER BY alias ";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='selteacher' style='width:150px;'>";
		$out.= "<option value=''>Select Teacher from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			$out.= "<option value='".$row1['emp_id']."' >".$row1['alias']."</option>";
		}
		$out.= "</select>";
		return $out;
	}
	function qatar_live_teschers_dropdown_select($id)
	{
		
		 $sql1 = "SELECT emp_id, alias FROM sis_employee WHERE status = 1 and designation='Teacher' ORDER BY alias";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='selteacher' style='width:150px;'>";
		$out.= "<option value=''>Select Teacher from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			
			if($row1['emp_id'] == $id)
			$out.= "<option value='".$row1['emp_id']."' selected>".$row1['alias']."</option>";
			else
			$out.= "<option value='".$row1['emp_id']."' >".$row1['alias']."</option>";
		}
		$out.= "</select>";
		return $out;
	}
	function qatar_subject_dropdown($school_id)
	{
		$sql1 = "SELECT sub_id, sub_name FROM test_subject where school_id='$school_id' ORDER BY sub_name ";
		
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='selsubject' style='width:150px;'>";
		$out.= "<option value=''>Select Subject from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			$out.= "<option value='".$row1['sub_id']."' >".$row1['sub_name']."</option>";
		}
		$out.= "</select>";
		return $out;
	}
	function qatar_subject_dropdown_select($id,$school_id)
	{
		 $sql1 = "SELECT  sub_id, sub_name FROM test_subject where school_id='$school_id' ORDER BY sub_name ";
		
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='selsubject' style='width:150px;'>";
		$out.= "<option value=''>Select Subject from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			if($row1['sub_id'] == $id)
			$out.= "<option value='".$row1['sub_id']."' selected>".$row1['sub_name']."</option>";
			else
			$out.= "<option value='".$row1['sub_id']."'>".$row1['sub_name']."</option>";
		}
		$out.= "</select>";
		return $out;
	}
	function qatar_grade_dropdown($school_id)
	{
		$sql1 = "SELECT grade_id, grade_name FROM test_grades where school_id='$school_id' ORDER BY grade_name ";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='selgrade' style='width:150px;'>";
		$out.= "<option value=''>Select Subject from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			$out.= "<option value='".$row1['grade_id']."' >".$row1['grade_name']."</option>";
		}
		$out.= "</select>";
		return $out;
	}
	function qatar_grade_dropdown_select($id,$school_id)
	{
		$sql1 = "SELECT grade_id, grade_name FROM test_grades where school_id='$school_id' ORDER BY grade_name ";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='selgrade' style='width:150px;'>";
		$out.= "<option value=''>Select Subject from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			if($row1['grade_id'] == $id)
			$out.= "<option value='".$row1['grade_id']."' selected>".$row1['grade_name']."</option>";
			else
			$out.= "<option value='".$row1['grade_id']."' >".$row1['grade_name']."</option>";
		}
		$out.= "</select>";
		return $out;
	}
	function qatar_year_dropdown()
	{
		$year = $this->curyear;
		$out = "<select name='selyear' style='width:80px;'>";
		$out.= "<option value=''>Year</option>";
			for($i=0;$i<10;$i++)
			{
				$val_1=$year+$i;
				$out.= "<option value='".$val_1."'>".$val_1."</option>";
			}
		$out.= "</select>";
		return $out;
	}
	function qatar_year_dropdown_select($id)
	{
		$year1 = $this->curyear;
		$out = "<select name='selyear' style='width:80px;'>";
		$out.= "<option value=''>Year</option>";
			for($i=0;$i<10;$i++)
			{
				$val_1=$year1+$i;
				if($val_1 == $id)
				$out.= "<option value='".$val_1."' selected>".$val_1."</option>";
				else
				$out.= "<option value='".$val_1."'>".$val_1."</option>";
			}
		$out.= "</select>";
		return $out;
	}
	function qatar_month_dropdown()
	{
		$curr_month = date("m");
		$month = array (1=>"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
		$out = "<select name='month' style='width:80px;'>";
		$out.= "<option value=''>month</option>";
		foreach ($month as $key => $val) {
			$out .= "<option val=".$key."";
			if ($key == $curr_month) {
				$out .= " selected>".$val."";
			} else {
				$out .= ">".$val."";
			}
		}
		$out .= "</select>";
		return $out; 
	}
	function qatar_month_dropdown_select($id)
	{
		$curr_month = date("m");
		$month = array (1=>"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
		$out = "<select name='month' style='width:80px;'>";
		$out.= "<option value=''>month</option>";
		foreach ($month as $key => $val) {
			$out .= "<option val=".$key."";
			if ($key == $id) {
				$out .= " selected>".$val."";
			} else {
				$out .= ">".$val."";
			}
		}
		$out .= "</select>";
		return $out; 
	}
	function qatar_day_dropdown()
	{
		$curr_month = date("d");
		$out = "<select name='selday' style='width:80px;'>";
		$out.= "<option value=''>Day</option>";
			for($i=1;$i<=31;$i++)
			{
				$out.= "<option value='".$i."'>".$i."</option>";
			}
		$out.= "</select>";
		return $out;
	}
	function qatar_day_dropdown_select($id)
	{
		$curr_month = date("d");
		$out = "<select name='selday' style='width:80px;'>";
		$out.= "<option value=''>Day</option>";
			for($i=1;$i<=31;$i++)
			{
				if($i==$id)
				$out.= "<option value='".$i."' selected>".$i."</option>";
				else
				$out.= "<option value='".$i."'>".$i."</option>";
			}
		$out.= "</select>";
		return $out;
	}
	function qatar_hours_dropdown()
	{
		$out = "<select name='selhours' style='width:80px;'>";
		$out.= "<option value=''>Hours</option>";
			for($i=1;$i<=24;$i++)
			{
				$out.= "<option value='".$i."'>".$i."</option>";
			}
		$out.= "</select>";
		return $out;
	}
	function qatar_hours_dropdown_select($id)
	{
		$out = "<select name='selhours' style='width:80px;'>";
		$out.= "<option value=''>Hours</option>";
			for($i=1;$i<=24;$i++)
			{
				if($i==$id)
				$out.= "<option value='".$i."' selected>".$i."</option>";
				else
				$out.= "<option value='".$i."'>".$i."</option>";
			}
		$out.= "</select>";
		return $out;
	}
	function qatar_min_dropdown()
	{
		$out = "<select name='selmin' style='width:80px;'>";
		$out.= "<option value=''>Minutes</option>";
			for($i=1;$i<=60;$i++)
			{
				$out.= "<option value='".$i."'>".$i."</option>";
			}
		$out.= "</select>";
		return $out;
	}
	function qatar_min_dropdown_select($id)
	{
		$out = "<select name='selmin' style='width:80px;'>";
		$out.= "<option value=''>Minutes</option>";
			for($i=1;$i<=60;$i++)
			{
				if($i==$id)
				$out.= "<option value='".$i."' selected>".$i."</option>";
				else
				$out.= "<option value='".$i."'>".$i."</option>";
			}
		$out.= "</select>";
		return $out;
	}
	
	
	function get_sch_teach_id($id)
	{
		$sqldc = "SELECT a.teacher_id FROM qatar_online_class as a inner join qatar_class_schedule as b on a.online_cid = b.class_id where b.class_id = ".$id;
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);
		
		$row = $objSqldc->fetchRow($recorddc);
		
		return $row;
	}
	function get_live_classes($school_id){
		$date = date('Y-m-d 00:00:00');
		$limit=4;
		 $query = "select * from qatar_online_class WHERE status = 'active' AND class_start_date >= '".$date."'  and school_id=$school_id ORDER BY class_start_hours ";
		$pagination_qatar = new pagination_key();
		$pagination_qatar->createPaging($query,$limit);
		while($row=mysql_fetch_object($pagination_qatar->resultpage)){
		$rowdc[]=$row;
		}
		  $rowdc['total_rec']=$pagination_qatar->totalrecords();
		  $rowdc['dis_page']=$pagination_qatar->displayPaging();
		 
		return $rowdc;
	}
	function get_live_classes_teacher($school_id,$teacher_id){
		$date = date('Y-m-d h:r:s');
		$limit=4;
		 $query = "select * from qatar_online_class WHERE status = 'active' AND class_start_date >= '".$date."'  and school_id=$school_id and teacher_id='$teacher_id' ORDER BY class_start_hours ";
		$pagination_qatar = new pagination_key();
		$pagination_qatar->createPaging($query,$limit);
		while($row=mysql_fetch_object($pagination_qatar->resultpage)){
		$rowdc[]=$row;
		}
		  $rowdc['total_rec']=$pagination_qatar->totalrecords();
		  $rowdc['dis_page']=$pagination_qatar->displayPaging();
		 
		return $rowdc;
	}
	function get_sessions_teacher($school_id,$teacher_id){
		$limit=4;
		 $query = "select * from qatar_online_class WHERE status = 'active'  and school_id=$school_id and teacher_id='$teacher_id' ORDER BY class_start_hours ";
		$pagination_qatar = new pagination_key();
		$pagination_qatar->createPaging($query,$limit);
		while($row=mysql_fetch_object($pagination_qatar->resultpage)){
		$rowdc[]=$row;
		}
		  $rowdc['total_rec']=$pagination_qatar->totalrecords();
		  $rowdc['dis_page']=$pagination_qatar->displayPaging();
		 
		return $rowdc;
	}
	function get_sessions_teacher_one($school_id,$teacher_id){
		 $query = "select * from qatar_online_class WHERE status = 'active'  and school_id=$school_id and teacher_id='$teacher_id' ORDER BY class_start_hours ";
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($query);
		
		return $recorddc;
	}
	function get_teacher_class_duration($school_id,$teacher_id){
		$query = "select * from qatar_online_class WHERE status = 'active'  and school_id=$school_id and teacher_id='$teacher_id' ORDER BY class_start_hours ";
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($query);
		while($row=$objSqldc->fetchRow($recorddc)){
			$Minutes+=$row['duration'];
		}
		if ($Minutes < 0)
		{
			$Min = Abs($Minutes);
		}
		else
		{
			$Min = $Minutes;
		}
		$iHours = Floor($Min / 60);
		$Minutes = ($Min - ($iHours * 60)) / 100;
		$tHours = $iHours + $Minutes;
		if ($Minutes < 0)
		{
			$tHours = $tHours * (-1);
		}
		$aHours = explode(".", $tHours);
		$iHours = $aHours[0];
		if (empty($aHours[1]))
		{
			$aHours[1] = "00";
		}
		$Minutes = $aHours[1];
		if (strlen($Minutes) < 2)
		{
			$Minutes = $Minutes ."0";
		}
		$tHours = $iHours ." Hrs ". $Minutes." Mins";
	   return $tHours;

	}
	function get_live_classes_students($class_id){
		$date = date('Y-m-d h:r:s');
		$limit=4;
		 $query = "select * from qatar_class_members WHERE status = 'active' AND online_cid= $class_id  ORDER BY create_date ";
		$pagination_qatar = new pagination_key();
		$pagination_qatar->createPaging($query,$limit);
		while($row=mysql_fetch_object($pagination_qatar->resultpage)){
		$rowdc[]=$row;
		}
		  $rowdc['total_rec']=$pagination_qatar->totalrecords();
		  $rowdc['dis_page']=$pagination_qatar->displayPaging();
		 
		return $rowdc;
	}
	
	function get_taken_classes_teacher($school_id,$teacher_id){
		$date = date('Y-m-d 00:00:00');
		$query = "select * from qatar_online_class WHERE status = 'inactive'  and school_id=$school_id and teacher_id='$teacher_id' ORDER BY class_start_hours ";
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($query); 
		return $recorddc;
	}
	function get_live_class_members($class_id){
		$sql="select *  from qatar_class_members where online_cid =$class_id and status='active'";
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sql);
		return $objSqldc->getNumRecord();
		
	}
	function get_live_class_comments($class_id){
		 $sql="select * from qatar_class_comments where online_cid=$class_id and status='active'";
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sql);
		return $objSqldc->getNumRecord();
	}
	function check_class_member($user_id,$classid){
		$sql="select * from qatar_class_members where user_id='$user_id' and online_cid=$classid and status='active'";
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sql);
		if(is_array($recorddc)){
			return 'already member';
		}
		else{
			return 'not a member';
		}
	}
	function get_class_comments($class_id){
		$sql="select *  from qatar_class_comments where online_cid 	=$class_id and status='active'";
		$objSqldc = new SqlClass();
		return $recorddc = $objSqldc->executeSql($sql);
	}
	function get_Subject_name($id)
	{
		$sqldc = "SELECT sub_name from test_subject where sub_id = ".$id;
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);
		$row = $objSqldc->fetchRow($recorddc);
		return $row['sub_name'];
	}
	function display_faculty($name){
	$sqldc = "SELECT * from sis_employee where (firstname like '%".$name."' or firstname like '".$name."%' or firstname like '%".$name."%' or lastname like '%".$name."' or lastname like '".$name."%' or lastname like '%".$name."%' or alias like '%".$name."' or alias like '".$name."%' or alias like '%".$name."%' ) and designation='Teacher' and status=1";
		$objSqldc = new SqlClass();
		return $recorddc = $objSqldc->executeSql($sqldc);
	}
	function get_class_latest($school_id){
		$sql="select * from ".$this->table_online_c." where school_id=$school_id and status='active' order by online_cid asc limit 1";
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sql);
		return $recorddc;
	}
}
?>
