<?php
class qatar_skoolinfo{
	var $query;
	var $table;
	
    function __construct(){
	 
	  $this->table='qse_school_info';
	  $this->table_cat='qse_schools';
	 
      $this->query=new Queries();
	}
	function qatar_skoolinfo_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function qatar_groups_cat_insert($array){
			return $this->query->makeinsertquery($this->table_cat,$array);
	}
	
	function qatar_groups_set_function($array,$where){
		return $this->query->makeupdatequery($this->table,$array,$where);
	}
	function qatar_groups_set_cat_function($array,$where){
		return $this->query->makeupdatequery($this->table_cat,$array,$where);
	}
	function qatar_skoolinfo_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function qatar_groups_comm_update($array,$where){
	   return $this->query->makeupdatequery($this->table_cat,$array,$where);	
	}
	function qatar_groups_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function qatar_groups_comm_delete($field,$value){
		return $this->query->makedeletequery($this->table_cat,$field,$value);
	}
	function qatar_skoolinfo_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function qatar_groups_comm_selectall($field,$value){
		return $this->query->makeselectallquery($this->table_cat,$field,$value);
	}
	function qatar_groups_select($column,$field,$value){
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	function qatar_groups_comm_select($column,$field,$value){
		return $this->query->makeselectquery($this->table_cat,$column,$field,$value);
	}
	function qatar_groups_memb_select($column,$field,$value){
		return $this->query->makeselectquery($this->table_mem,$column,$field,$value);
	}
	
	function update_group_visits($val)
	{
		$query="update qatar_groups set no_of_visits = no_of_visits+1 where group_id ='$val' ";
		$objSql = new SqlClass();
			$res = $objSql->executeSql($query);
			return $res;
	}
	function update_user_visits($val)
	{
		$query="update qatar_group_members set user_visits = user_visits+1 where group_id ='$val' and user_id=".$_SESSION['user_id'];
		$objSql = new SqlClass();
			$res = $objSql->executeSql($query);
			return $res;
	}	
	function get_most_active_member($val)
	{
		$sql = "SELECT max( user_visits ) , user_id	FROM qatar_group_members WHERE group_id = '$val'";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record[0]['user_id'];
	}
	function get_recent_active_member($val)
	{
		$sql = "SELECT  user_id
						FROM qatar_group_members
						WHERE group_id = '$val' order by user_add_date desc limit 0,1";		
				
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record[0][user_id];
	}
	function get_online_members()
	{
		$sql = "SELECT  count(is_online) as online_mem
						FROM qatar_users where is_online=1";		
				
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record[0][online_mem];		
	}
	function qatar_groups_disp($val,$max)
	{
		$min=$max;
		$max = $max+'15';
		$sql = "SELECT group_id, group_name, group_owner, group_cat, group_pic, create_date, status FROM qatar_groups ";
			if($val == '0')$sql.= "ORDER BY group_name";elseif($val == '1')$sql.= "ORDER BY group_name DESC";
			elseif($val == '2')$sql.= "ORDER BY group_owner";elseif($val == '3')$sql.= "ORDER BY group_owner DESC";
			elseif($val == '4')$sql.= "ORDER BY group_cat";elseif($val == '5')$sql.= "ORDER BY group_cat DESC";
			elseif($val == '6')$sql.= "ORDER BY create_date";elseif($val == '7')$sql.= "ORDER BY create_date DESC";
			elseif($val == '8')$sql.= "ORDER BY status";elseif($val == '9')$sql.= "ORDER BY status DESC";
		$sql.= " LIMIT ".$min.",".$max;
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);

			return $record;
	}
	function qatar_groups_cat_disp($val,$max)
	{
		$min=$max;
		$max = $max+'15';
		$sql = "SELECT group_cat_id, cat_name, create_date, status FROM qatar_group_category ";
			if($val == '0')$sql.= "ORDER BY cat_name";elseif($val == '1')$sql.= "ORDER BY cat_name DESC";
			elseif($val == '2')$sql.= "ORDER BY create_date";elseif($val == '3')$sql.= "ORDER BY create_date DESC";
			elseif($val == '4')$sql.= "ORDER BY status";elseif($val == '5')$sql.= "ORDER BY status DESC";
		$sql.= " LIMIT ".$min.",".$max;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	
	function disply_active_groups()
	{
		$min=$max;
		$max = $max+'15';
		$sql = "SELECT group_id, group_name, group_owner, group_cat, group_pic, create_date, status FROM qatar_groups where status = 'active' ";
			$objSql = new SqlClass();
			$record1 = $objSql->executeSql($sql);
			while($row1 = $objSql->fetchRow($record1))
			{
				$record[] = $row1;
			}	
			return $record;		
	}
	function disply_related_groups($cat_id)
	{
		$sql = "SELECT group_id, group_name, group_desc, group_cat FROM qatar_groups where status = 'active' and  group_cat=".$cat_id." order by create_date desc limit 0,4";
			$objSql = new SqlClass();
			$record1 = $objSql->executeSql($sql);
			while($row1 = $objSql->fetchRow($record1))
			{
				$record[] = $row1;
			}	
			return $record;		
	}
	function get_usr_grps($id)
	{
		$sql = "SELECT a.g_m_id ,a.group_id, a.user_id, a.user_add_date, b.group_desc, b.group_cat, b.group_name, b.grp_emailid, b.group_pic, b.create_date  
			FROM qatar_group_members as a 
			inner join qatar_groups as b on a.group_id = b.group_id where a.user_id = ".$id." and a.status = 'active' and  b.status='active' order by a.user_add_date desc limit 0,6";
			$objSql = new SqlClass();
			$record1 = $objSql->executeSql($sql);
			while($row1 = $objSql->fetchRow($record1))
			{
				$record[] = $row1;
			}	
			return $record;		
	}
}
?>