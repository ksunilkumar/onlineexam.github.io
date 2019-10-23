<?php
class ise_groups{
	var $query;
	var $table;
	
    function __construct(){
	 
	  $this->table='ise_groups';
	  //$this->table_cat='category';
	  $this->table_mem='ise_group_members';
      $this->query=new Queries();
	}
	function ise_groups_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function ise_groups_cat_insert($array){
			return $this->query->makeinsertquery($this->table_cat,$array);
	}
	
	function ise_groups_set_function($array,$where){
		return $this->query->makeupdatequery($this->table,$array,$where);
	}
	function ise_groups_set_cat_function($array,$where){
		return $this->query->makeupdatequery($this->table_cat,$array,$where);
	}
	function ise_groups_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function ise_groups_comm_update($array,$where){
	   return $this->query->makeupdatequery($this->table_cat,$array,$where);	
	}
	function ise_groups_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function ise_groups_comm_delete($field,$value){
		return $this->query->makedeletequery($this->table_cat,$field,$value);
	}
	function ise_groups_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function ise_groups_comm_selectall($field,$value){
		return $this->query->makeselectallquery($this->table_cat,$field,$value);
	}
	function ise_groups_select($column,$field,$value){
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	function ise_groups_comm_select($column,$field,$value){
		return $this->query->makeselectquery($this->table_cat,$column,$field,$value);
	}
	function ise_groups_memb_select($column,$field,$value){
		return $this->query->makeselectquery($this->table_mem,$column,$field,$value);
	}
	function ise_group_member_insert($array){
			return $this->query->makeinsertquery($this->table_mem,$array);
	}
	function ise_groups_member_delete($gid,$userid){
		 $query='delete from '.$this->table_mem." where group_id=$gid and user_id=$userid";
		$objSql = new SqlClass();
			$res = $objSql->executeSql($query);
			return $res;
	}
	
	//  anu nov 24th //
		function get_active_othergroups_limit($school_id,$userid)
			{
			
			 $sql = "SELECT * FROM ise_groups where (school_id=$school_id and group_id not in(select distinct(group_id) from group_members where user_id='$userid'))
			 ORDER BY group_id ASC limit 0,5";
			 
			$objSql = new SqlClass();
			$res = $objSql->executeSql($sql);
			return $res;
		}
		
		
	//  nov 24th end //
	
	
	
	
	//*** anu 13th  *****//
	function get_active_mygroups_limit($school_id,$userid)
			{
			$limit=5;
			 $sql = "SELECT * FROM ise_groups where status='active' and school_id=$school_id and group_id in(select distinct(group_id) from group_members where user_id='$userid')
			 ORDER BY group_id ASC limit 0,3";
			 $objSql = new SqlClass();
			$res = $objSql->executeSql($sql);
			
			return $res;
		}
	/*function get_blogs_limit($school_id,$userid)
			{
			$limit=5;
			  $sql = "SELECT * FROM blogs where status='active' and school_id=$school_id and blog_id in
			 (select distinct(blog_id) from blog_review where user_id='$userid')
			 ORDER BY blog_id ASC limit 0,3";
			 $objSql = new SqlClass();
			$res = $objSql->executeSql($sql);
			
			return $res;
		}*/
	//****** end *****//
	/* *******   nov 10th  amu *****/
	
	

	
	
	function update_group_visits($val)
	{
		$query="update ise_groups set no_of_visits = no_of_visits+1 where group_id ='$val' ";
		$objSql = new SqlClass();
			$res = $objSql->executeSql($query);
			return $res;
	}
	function update_user_visits($val)
	{
		$query="update ise_group_members set user_visits = user_visits+1 where group_id ='$val' and user_id=".$_SESSION['user_id'];
		$objSql = new SqlClass();
			$res = $objSql->executeSql($query);
			return $res;
	}	
	function get_most_active_member($val)
	{
		$sql = "SELECT max( user_visits ) , user_id	FROM ise_group_members WHERE group_id = '$val'";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record[0]['user_id'];
	}
	function get_recent_active_member($val)
	{
		$sql = "SELECT  user_id
						FROM ise_group_members
						WHERE group_id = '$val' order by user_add_date desc limit 0,1";		
				
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record[0][user_id];
	}
	function get_online_members()
	{
		$sql = "SELECT  count(is_online) as online_mem
						FROM ise_users where is_online=1";		
				
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record[0][online_mem];		
	}
	function ise_groups_disp($val,$max)
	{
		$min=$max;
		$max = $max+'15';
		$sql = "SELECT group_id, group_name, group_pic, create_date, status FROM ise_groups ";
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
	function ise_groups_cat_disp($val,$max)
	{
		$min=$max;
		$max = $max+'15';
		$sql = "SELECT group_cat_id, cat_name, create_date, status FROM ise_group_category ";
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
		$sql = "SELECT group_id, group_name, group_owner, group_cat, group_pic, create_date, status FROM ise_groups where status = 'active' ";
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
		$sql = "SELECT group_id, group_name, group_desc, group_cat FROM ise_groups where status = 'active' and  group_cat=".$cat_id." order by create_date desc limit 0,4";
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
			FROM ise_group_members as a 
			inner join ise_groups as b on a.group_id = b.group_id where a.user_id = ".$id." and a.status = 'active' and  b.status='active' order by a.user_add_date desc limit 0,6";
			$objSql = new SqlClass();
			$record1 = $objSql->executeSql($sql);
			while($row1 = $objSql->fetchRow($record1))
			{
				$record[] = $row1;
			}	
			return $record;		
	}
	function get_group_info($id)
		{
			$sql="select * from ise_groups where group_id=$id";
			//echo $sql;exit;
			$objSql = new SqlClass();
			$record1 = $objSql->executeSql($sql);
			$row=$objSql->fetchRow($record1);
			return $row;
		}
		
		
		
	/* *******   nov 10th  amu *****/
	
	function get_group_members_limit($schoolid,$groupid)
	{
	
	$sql="select first_name,photo from sis_students where studentid in(select distinct(user_id) from group_members where group_id=$groupid) limit 0,4";
	$objSql = new SqlClass();
			$res = $objSql->executeSql($sql);
			return $res;
	}
	function get_group_members($schoolid,$groupid)
	{
	
	 $sql="select user_id,user_fname,user_lname,user_pic_add from ise_users where user_id in(select distinct(user_id) from ise_group_members where group_id=$groupid)";
	// echo $sql;exit;
	$objSql = new SqlClass();
			$res = $objSql->executeSql($sql);
			return $res;
	}
	
	function get_user_memeber($gid,$user){
	$query ="select * from ise_group_members where group_id=".$gid." and user_id=$user and status='active'" ;
	//echo $query;exit;
	$objSql = new SqlClass();
			$record1 = $objSql->executeSql($query);
			if(is_array($record1)){
			return 'Group member';
			}
			else {
			return 'Not Group member';
			}
			
	}
	
	
	
	
	function get_group_noofmembers($schoolid,$groupid)
	{
	
	 $sql="select user_fname,user_lname,user_pic_add from ise_users where user_id in(select distinct(user_id) from ise_group_members where group_id=".$groupid.")";
	 //echo $sql;exit;
	$objSql = new SqlClass();
			$res = $objSql->executeSql($sql);
			if(is_array($res))
			return count($res);
			else
			return 0;
	}
	
	
	
	function get_active_groups($school_id,$id)		{
			//$limit=5;
			$sql = "SELECT * FROM ise_groups where status='active' and school_id=$school_id and group_id not in(select distinct(group_id) from ise_group_members where user_id=".$id.") ORDER BY group_id DESC";
			//echo $sql;
			/*$pagination_ise = new pagination_key();
		$pagination_ise->createPaging($sql,$limit);
		while($row=mysql_fetch_object($pagination_ise->resultpage)){
		$rowdc[]=$row;
		}
		  $rowdc['total_rec']=$pagination_ise->totalrecords();
		  $rowdc['dis_page']=$pagination_ise->displayPaging();
		 
		return $rowdc;*/
		$objSql = new SqlClass();
			$res = $objSql->executeSql($sql);
			return $res;
		}
		
	function get_active_mygroups($school_id,$userid)
			{
			//$limit=6;
			$sql = "SELECT * FROM ise_groups where status='active' and school_id=".$school_id." and group_id in(select distinct(group_id) from ise_group_members where user_id=".$userid.") ORDER BY group_id ASC";
			 //echo $sql;
			/*$pagination_ise = new pagination_key();
			$pagination_ise->createPaging($sql,$limit);
			while($row=mysql_fetch_object($pagination_ise->resultpage)){
			$rowdc[]=$row;
			}
		  $rowdc['total_rec']=$pagination_ise->totalrecords();
		  $rowdc['dis_page']=$pagination_ise->displayPaging();
		  
		  
		  
		return $rowdc;*/
		$objSql = new SqlClass();
			$res = $objSql->executeSql($sql);
			return $res;
		}


	function get_active_othergroups($school_id,$userid)
			{
			//$limit=6;
			 $sql = "SELECT * FROM ise_groups where (school_id=$school_id and group_id not in(select distinct(group_id) from ise_group_members where user_id='$userid')) or school_id=$school_id and status='inactive' and group_id in(select distinct(group_id) from ise_group_members where user_id='$userid')
			 ORDER BY group_id DESC ";
		/*$pagination_ise = new pagination_key();
		$pagination_ise->createPaging($sql,$limit);
		while($row=mysql_fetch_object($pagination_ise->resultpage)){
		$rowdc[]=$row;
		}
		  $rowdc['total_rec']=$pagination_ise->totalrecords();
		  $rowdc['dis_page']=$pagination_ise->displayPaging();
		  
		  
		  
		return $rowdc;*/
		$objSql = new SqlClass();
			$res = $objSql->executeSql($sql);
			return $res;
		}



	function get_mygroup($school_id,$groupid)
			{
			//$limit=5;
			 $sql = "SELECT * FROM groups where status='active' and school_id=$school_id and group_id=$groupid";
			 
			$objSql = new SqlClass();
			$res = $objSql->executeSql($sql);
			return $res;
		}
/****************  anu  end           ********/





function display_group($page,$val,$al,$sid)
{
 $sql= "SELECT * FROM ise_groups ";
 
 if($al != '.')
				$sql.=" WHERE group_name   LIKE '".$al."%' ";
		if($sid!=''&& $al != '.')
		 $sql.=" and school_id=".$sid."";	
		 else if($sid!='')
		 $sql.=" where school_id=".$sid."";	
		 
				
if($val == '0')$sql.= " ORDER BY group_name";elseif($val == '1')$sql.= " ORDER BY group_name DESC";
			
			
			elseif($val == '6')$sql.= " ORDER BY create_date";elseif($val == '7')$sql.= " ORDER BY create_date DESC";
			elseif($val == '8')$sql.= " ORDER BY status";elseif($val == '9')$sql.= " ORDER BY status DESC";				
			else $sql.=" order by create_date desc";
 $sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
//echo $sql;			
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}

function  totalNoOfgroup($al='',$sid)
	{
	
	$sql= "SELECT * FROM ise_groups";
		if($al != '.')
				$sql.=" where  group_name LIKE '".$al."%' ";		
		
		if($sid!=''&& $al != '.')
		 $sql.=" and school_id=".$sid."";	
		 else if($sid!='')
		 $sql.=" where school_id=".$sid."";	
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
	}


function display_grp_posts($page,$val)
	{
	 $sql="SELECT * FROM ise_group_posts WHERE group_id =".$_REQUEST['id']." ";
	//echo $sql; 
	 if($val == '0')$sql.= " ORDER BY message";elseif($val == '1')$sql.= " ORDER BY message DESC";
	 if($val == '6')$sql.= " ORDER BY status";elseif($val == '7')$sql.= " ORDER BY message DESC";
	 else
	 $sql.=" ORDER BY posted_date DESC";
		$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			//echo $sql; exit;	
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}

function display_grp_posts_all($id)
	{
	 $sql="SELECT * FROM ise_group_posts WHERE group_id =".$id." ORDER BY posted_date";
		//echo $sql;exit;	
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function  totalNoOfgrp_posts()
	{
	
	  $sql="SELECT * FROM ise_group_posts WHERE group_id =".$_REQUEST['id']." ORDER BY posted_date";
			
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
	}


function get_school_groups($school_id)		{
			//$limit=5;
			echo $sql = "SELECT * FROM ise_groups where status='active' and school_id=$school_id";
			//echo $sql;
			/*$pagination_ise = new pagination_key();
		$pagination_ise->createPaging($sql,$limit);
		while($row=mysql_fetch_object($pagination_ise->resultpage)){
		$rowdc[]=$row;
		}
		  $rowdc['total_rec']=$pagination_ise->totalrecords();
		  $rowdc['dis_page']=$pagination_ise->displayPaging();
		 
		return $rowdc;*/
		$objSql = new SqlClass();
			$res = $objSql->executeSql($sql);
			return $res;
		}








}
?>