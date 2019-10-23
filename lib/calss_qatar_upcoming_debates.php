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
	function qatar_debates(){
		$sql1 = "SELECT debate_id, debate_title FROM qatar_upcoming_debates ";
		$objSql = new SqlClass();
		$record1 = $objSql->executeSql($sql1);
		$out = "<select name='seldebate' style='width:150px;'>";
		$out.= "<option value=''>Select Debate from List</option>";
		while($row1 = $objSql->fetchRow($record1))
		{
			$out.= "<option value='".$row1['debate_id']."'>".$row1['debate_title']."</option>";
		}
		$out.= "</select>";
		return $out;
	}
	function qatar_debates_select($id){
	
		$sql1 = "SELECT debate_id, debate_title FROM qatar_upcoming_debates ";
		$objSql = new SqlClass();
		$record1 = $objSql->executeSql($sql1);
		$out = "<select name='seldebate' style='width:150px;'>";
		$out.= "<option value=''>Select Debate from List</option>";
		while($row1 = $objSql->fetchRow($record1))
		{
			if($row1['debate_id']==$id)
			$out.= "<option value='".$row1['debate_id']."'  selected>".$row1['debate_title']."</option>";
			else
			$out.= "<option value='".$row1['debate_id']."'>".$row1['debate_title']."</option>";
		}
		$out.= "</select>";
		return $out;
	}
	
	function get_usr_debates($id)
	{
		$sqldc = "SELECT a.debate_id,b.debate_title ,b.debate_description,b.members_in_debate,b.sponsors_logo, count(comment_id) as comments FROM qatar_debates_comments as a 
			inner join qatar_upcoming_debates as b on a.debate_id=b. debate_id  
			where a.user_id = ".$id." and a.status = 'active' and b.status = 'active' group by a.debate_id order by a.create_date desc";
		
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);
		
		while($row = $objSqldc->fetchRow($recorddc))
		{
			$rowdc[] = $row;
		}
		return $rowdc;
	}
	function debate_user_count($id)
	{
		 $sql_u = "SELECT count(*) as count from qatar_debates_comments where debate_id=".$id;
		$objSql_1 = new SqlClass();
		$record_u = $objSql_1->executeSql($sql_u);
		$row_1 = $objSql_1->fetchRow($record_u);
		return $row_1['count'];
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
	function qatar_duration_dropdown()
	{
		$out = "<select name='duration' style='width:80px;'>";
		$out.= "<option value=''>Minutes</option>";
			for($i=1;$i<=120;$i++)
			{
				$out.= "<option value='".$i."'>".$i."</option>";
			}
		$out.= "</select>";
		return $out;
	}
	function qatar_duration_dropdown_select($id)
	{
		$out = "<select name='duration' style='width:80px;'>";
		$out.= "<option value=''>Minutes</option>";
			for($i=1;$i<=120;$i++)
			{
				if($i==$id)
				$out.= "<option value='".$i."' selected>".$i."</option>";
				else
				$out.= "<option value='".$i."'>".$i."</option>";
			}
		$out.= "</select>";
		return $out;
	}
}
?>
