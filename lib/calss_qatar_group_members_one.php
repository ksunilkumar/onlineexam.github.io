<?php
class qatar_group_members{
	 var $query;
	var $table;
	
    function __construct(){
	$this->table='qatar_group_members';
      $this->query=new Queries();
	}
	function qatar_group_members_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function qatar_group_members_set_function($array,$where){
		return $this->query->makeupdatequery($this->table,$array,$where);
	}
	function qatar_group_members_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function qatar_group_members_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function qatar_group_members_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function qatar_group_members_select($column,$field,$value){
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	
	function user_in_group($user_id,$group_id)
	{
		$sql = "SELECT status FROM qatar_group_members where group_id = ".$group_id." and user_id = ".$user_id." ";
			
			$objSql = new SqlClass();
			
			$record1 = $objSql->executeSql($sql);
			$row1 = $objSql->fetchRow($record1);
			
			return $row1['status'];		
	}
	
	function get_active_users($group_id)
	{
		$sql = "SELECT a.user_id, b.q_u_name, b.profile_photo_display FROM qatar_group_members as a inner join qatar_users as b on a.user_id = b.user_id where a.group_id = ".$group_id." limit 0,8";
			
			$objSql = new SqlClass();
			
			$record1 = $objSql->executeSql($sql);
			
			while($row1 = $objSql->fetchRow($record1))
			{
				$record[] = $row1;
			}			
			
			return $record;		
	}
	
	
	function get_group_members($group_id,$ord)
	{
		$sql = "SELECT a.g_m_id, a.group_id, a.user_id, a.user_add_date, a.status, b.email_id, b.username 
			FROM qatar_group_members as a 
			inner join qatar_users as b on a.user_id = b.user_id 
			where a.group_id = ".$group_id ;
		if($ord == 'a')	$sql .= " order by b.username asc"; if($ord == 'a1') $sql .= " order by b.username desc";
		if($ord == 'b')	$sql .= " order by b.email_id asc"; if($ord == 'b1')	$sql .= " order by b.email_id desc";
		if($ord == 'c')	$sql .= " order by a.user_add_date asc"; if($ord == 'c1')	$sql .= " order by a.user_add_date desc";
		if($ord == 'd')	$sql .= " order by a.status asc"; if($ord == 'd1')	$sql .= " order by a.status desc";
		//echo $sql;	
			$objSql = new SqlClass();
			
			$record1 = $objSql->executeSql($sql);
			
			while($row1 = $objSql->fetchRow($record1))
			{
				$record[] = $row1;
			}			
			
			return $record;		
	}
	
	function get_grp_mem_count($id)
	{
		$sql = "SELECT a.g_m_id, a.group_id FROM qatar_group_members as a where a.group_id = ".$id ;
			
			$objSql = new SqlClass();
			
			$record1 = $objSql->executeSql($sql);
			
			$rows = $objSql->getNumRecord();
			
		return $rows;		
	}
	
	function is_grp_mem($id,$gid)
	{
		$sql = "SELECT g_m_id FROM qatar_group_members  where group_id = ".$gid." and user_id = ".$id ;
			
			$objSql = new SqlClass();
			
			$record1 = $objSql->executeSql($sql);
			
			$rows = $objSql->getNumRecord();
			
		return $rows;		
	}
	
	
}
?>
