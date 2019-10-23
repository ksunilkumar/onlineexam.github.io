<?php
class qatar_groupuser_members{
	 var $query;
	var $table;
	
    function __construct(){
	$this->table='qatar_group_members';
	$this->table_pic='qatar_group_photos';
	$this->table_post='qatar_group_posts';
      $this->query=new Queries();
	}
	function qatar_group_members_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function qatar_group_photos_insert($array){
			return $this->query->makeinsertquery($this->table_pic,$array);
	}
	function qatar_group_post_insert($array){
			return $this->query->makeinsertquery($this->table_post,$array);
	}
	function qatar_group_members_set_function($array,$where){
		return $this->query->makeupdatequery($this->table,$array,$where);
	}
	function qatar_group_members_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function qatar_group_photos_update($array,$where){
	   return $this->query->makeupdatequery($this->table_pic,$array,$where);	
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
	function qatar_group_photos_select($column,$field,$value){
		return $this->query->makeselectquery($this->table_pic,$column,$field,$value);
	}
	
	function user_in_group($user_id,$group_id)
	{
		$sql = "SELECT status FROM qatar_group_members where group_id = ".$group_id." and user_id = ".$user_id." ";
			
			$objSql = new SqlClass();
			
			$record1 = $objSql->executeSql($sql);
			$row1 = $objSql->fetchRow($record1);
			
			return $row1['status'];		
	}
	
	function get_active_users($user_id)
	{
		$sql = "SELECT * FROM `qatar_users` WHERE user_id =$user_id";
			$objSql = new SqlClass();

			$record1 = $objSql->executeSql($sql);
			$row1 = $objSql->fetchRow($record1);
			$arr=explode(",",$row1[group_members]);
			return $arr;		
	}
	function get_active_users_names($user_id)
	{
			$sql = "SELECT * FROM `qatar_users` WHERE user_id =$user_id";
			$objSql = new SqlClass();
			$record1 = $objSql->executeSql($sql);
			$row1 = $objSql->fetchRow($record1);
			return $row1;		
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
	
	function get_group_photos($group_id,$ord)
	{
		$sql = "SELECT a.pic_id, a.group_id, a.user_id,a.gp_photo_path, a.uploaded_date, a.status, b.email_id, b.username 
			FROM qatar_group_photos as a 
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
	
	
	function get_active_pics($group_id)
	{
		$sql = "SELECT pic_id, group_id,user_id, gp_photo_path,uploaded_date from qatar_group_photos where group_id = ".$group_id." and status = 'active' ";
			
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
