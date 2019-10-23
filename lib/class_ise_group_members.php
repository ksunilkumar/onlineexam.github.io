<?php
class ise_group_members{
	 var $query;
	var $table;
	
    function __construct(){
		$this->table='ise_group_members';
		$this->table_post='ise_group_posts';
		$this->table_con='ise_country';
		$this->table_sta='ise_state';
      	$this->query=new Queries();
	}
	function ise_group_members_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function ise_group_photos_insert($array){
			return $this->query->makeinsertquery($this->table_pic,$array);
	}
	function ise_group_post_insert($array){
			return $this->query->makeinsertquery($this->table_post,$array);
	}
	function ise_group_members_set_function($array,$where){
		return $this->query->makeupdatequery($this->table,$array,$where);
	}
	function ise_group_members_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function ise_group_photos_update($array,$where){
	   return $this->query->makeupdatequery($this->table_pic,$array,$where);	
	}
	function ise_group_post_update($array,$where){
	   return $this->query->makeupdatequery($this->table_post,$array,$where);	
	}
	function ise_group_members_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function ise_group_photo_delete($field,$value){
		return $this->query->makedeletequery($this->table_pic,$field,$value);
	}
	function ise_group_post_delete($field,$value){
		return $this->query->makedeletequery($this->table_post,$field,$value);
	}
	function ise_group_members_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function ise_group_members_select($column,$field,$value){
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	function ise_group_photos_select($column,$field,$value){
		return $this->query->makeselectquery($this->table_pic,$column,$field,$value);
	}
	function ise_group_post_select($column,$field,$value){
		return $this->query->makeselectquery($this->table_post,$column,$field,$value);
	}
	function ise_con_select($column,$field,$value){
		return $this->query->makeselectquery($this->table_con,$column,$field,$value);
	}
	function ise_sta_select($column,$field,$value){
		return $this->query->makeselectquery($this->table_sta,$column,$field,$value);
	}
	
	function user_in_group($user_id,$group_id)
	{
		$sql = "SELECT * FROM group_members where group_id = ".$group_id." and user_id = '".$user_id."' ";
			
			$objSql = new SqlClass();
			
			$record1 = $objSql->executeSql($sql);
			$row1 = $objSql->fetchRow($record1);
			if(is_array($row1)){
				return 'grop Member';
			}
			else{
				return 'not group member';		
			}
	}
	
	function get_active_users($group_id)
	{
		$sql = "SELECT a.user_id, b.q_u_name,b.username,b.email_id, b.profile_photo,b.city_residence,b.country_residence,b.age FROM ise_group_members as a inner join ise_users as b on a.user_id = b.user_id where a.group_id = ".$group_id." and a.status = 'active'";
			
			$objSql = new SqlClass();
			
			$record1 = $objSql->executeSql($sql);
			
			while($row1 = $objSql->fetchRow($record1))
			{
				$record[] = $row1;
			}			
			
			return $record;		
	}
	
	
	function display_grp_mem($id,$page,$order)
{
	 $sql= "SELECT * FROM ise_group_members WHERE group_id =".$id." ORDER BY user_add_date  ";
 
 $sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			//echo $sql; //exit;	
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function  totalNoOfgrp_mem()
	{
	
	$sql= "SELECT * FROM ise_group_members WHERE group_id =".$_REQUEST['id']." ORDER BY user_add_date  ";
			
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
	}
	
	
	
	function  totalNoOfgrp_comments_active($id)
	{
	
	$sql= "SELECT post_id FROM ise_group_posts WHERE group_id =".$id."  and status='active' ORDER BY posted_date desc  ";
			//echo $sql;
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function get_group_members($group_id,$ord)
	{
		$sql = "SELECT a.g_m_id, a.group_id, a.user_id, a.user_add_date, a.status, b.email_id, b.username 
			FROM ise_group_members as a 
			inner join ise_users as b on a.user_id = b.user_id 
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
			FROM ise_group_photos as a 
			inner join ise_users as b on a.user_id = b.user_id 
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
	
	function get_group_posts($group_id,$ord)
	{
		$sql = "SELECT a.post_id, a.group_id, a.user_id,a.message, a.posted_date, a.status, b.email_id, b.username 
			FROM ise_group_posts as a 
			inner join ise_users as b on a.user_id = b.user_id 
			where a.group_id = ".$group_id ;
		if($ord == 'a')	$sql .= " order by b.username asc"; if($ord == 'a1') $sql .= " order by b.username desc";
		if($ord == 'b')	$sql .= " order by b.email_id asc"; if($ord == 'b1')	$sql .= " order by b.email_id desc";
		if($ord == 'c')	$sql .= " order by a.posted_date asc"; if($ord == 'c1')	$sql .= " order by a.user_add_date desc";
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
		 $sql = "SELECT * FROM group_members  where group_id = ".$id ;
			
			$objSql = new SqlClass();
			
			$record1 = $objSql->executeSql($sql);
			
			$rows = $objSql->getNumRecord();
		return $rows;		
	}
	function is_grp_mem($id,$gid)
	{
		$sql = "SELECT g_m_id FROM ise_group_members  where group_id = ".$gid." and user_id = ".$id ;
			$objSql = new SqlClass();
			$record1 = $objSql->executeSql($sql);
			$rows = $objSql->getNumRecord();
		return $rows;		
	}
	function get_active_pics($group_id)
	{
		$sql = "SELECT pic_id, group_id,user_id, gp_photo_path, upload_type, uploaded_date from ise_group_photos where group_id = ".$group_id." and status = 'active' ";
			$objSql = new SqlClass();
			$record1 = $objSql->executeSql($sql);
			while($row1 = $objSql->fetchRow($record1))
			{
				$record[] = $row1;
			}			
			return $record;		
	}
	function get_active_posts($group_id)
	{
			$sql = "SELECT * from group_posts where group_id = ".$group_id." and status = 'active' ";
			$objSql = new SqlClass();
			$record1 = $objSql->executeSql($sql);
			while($row1 = $objSql->fetchRow($record1))
			{
				$record[] = $row1;
			}			
			return $record;		
	}
	
	function get_my_posts($group_id)
	{
		$sql = "SELECT post_id, group_id,user_id, message,posted_date from ise_group_posts where group_id = ".$group_id." and user_id = ".$_SESSION['user_id']." and status = 'active' ";
			$objSql = new SqlClass();
			$record1 = $objSql->executeSql($sql);
			while($row1 = $objSql->fetchRow($record1))
			{
				$record[] = $row1;
			}			
			return $record;		
	}
	function get_posts()
	{
		$sql = "SELECT a.post_id, a.group_id,a.user_id, a.message,a.posted_date ,b.q_u_name,b.username,b.profile_photo
			from ise_group_posts as a 
			inner join ise_users as b on a.user_id = b.user_id where a.status = 'active' and b.status = 'active' order by posted_date desc ";
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