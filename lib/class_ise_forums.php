<?php 
class Forums{
	function display_subforum_comms($page,$val,$al,$id)
		{
			$sql = "SELECT f_c_id,forum_id,f_c_desc,user_id,create_date,status FROM ise_forum_comms where forum_id = ".$id;
			if($val!=".")
				$sql.= " AND f_c_desc LIKE '".$val."%'";
			$sql.=" order by create_date desc";	
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			//echo $sql; exit;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		
	function display_forum_comms($id)
		{
			$sql = "SELECT f_c_id,forum_id,f_c_desc,user_id,create_date,status FROM ise_forum_comms where f_c_id = ".$id;
			
			//echo $sql; exit;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			return $row;
		}
		
		
	
	function totalNoOfforumcomms($id,$val)
		{
			$sql = "SELECT f_c_id,forum_id,f_c_desc,user_id,create_date,status FROM ise_forum_comms where forum_id = ".$id;


			if($val!="." )
				$sql.= "  AND f_c_desc LIKE '".$val."%'";
			//echo $sql;
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}
		
	function totalNoOfforumcomments($id)
		{
			$sql = "SELECT f_c_id,forum_id,f_c_desc,user_id,create_date,status FROM ise_forum_comms where forum_id = ".$id;


			//echo $sql;
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}	
		
		
		
		
		
		
function display_forums($page,$al,$val,$sid)
		{
		  $sql= "SELECT * FROM ise_forums WHERE forum_state='0' ";
		  /*
	      $pagination_qatar->createPaging($query,10);
			$sql = "SELECT forum_id,forum_title, forum_desc, cat_id, forum_state, status FROM ml_forums where forum_state=0 ";
			*/
				if($al!=".")
				$sql.=" and forum_name LIKE '".$al."%' ";
				
				if($sid!='')
		 $sql.=" and school_id=".$sid."  ";	
				
				
		if($val == '1')$sql.= "ORDER BY forum_name";elseif($val == '3')$sql.= "ORDER BY forum_name DESC";
			//elseif($val == '2')$sql.= "ORDER BY cat_id";elseif($val == '3')$sql.= "ORDER BY cat_id DESC";
			
			elseif($val == '6')$sql.= "ORDER BY status";elseif($val == '7')$sql.= "ORDER BY status DESC";
			else $sql.= "ORDER BY create_date desc";
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
		//echo $sql;exit;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function display_subforums($id,$page,$val,$al)
		{
			$sql = "SELECT forum_id,forum_name, forum_description,forum_category, forum_state, status,createdby FROM ise_forums where forum_state=".$id." ";
			if($al !='.')
				$sql.=" and forum_name LIKE '".$al."%' ";
			//echo $sql;
			if($val == '1')$sql.= "ORDER BY forum_name";elseif($val == '3')$sql.= "ORDER BY forum_name DESC";
			//elseif($val == '2')$sql.= "ORDER BY cat_id";elseif($val == '3')$sql.= "ORDER BY cat_id DESC";
			//elseif($val == '4')$sql.= "ORDER BY group_owner";elseif($val == '5')$sql.= "ORDER BY group_owner DESC";
			elseif($val == '6')$sql.= "ORDER BY status";elseif($val == '7')$sql.= "ORDER BY status DESC";
			else $sql.= " ORDER BY create_date desc";
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			//echo $sql;exit;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function totalNoOfforums($val,$id,$sid)
		{
			$sql = "SELECT * FROM ise_forums WHERE forum_state=".$id."";

			if($val!=".")
				$sql.= " AND forum_name LIKE '".$val."%'";
			if($sid!='')
		 $sql.=" and school_id=".$sid."  ";		
			//echo $sql;exit;
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}
		function totalNoOfforums_export($id)
		{
			$sql = "SELECT * FROM ise_forums WHERE forum_state=".$id."";

			
			//echo $sql;
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}
		
		
		
		
		
		function totalNoOfComments($val,$id)
		{
			$sql = "SELECT * FROM forum_comms WHERE forum_id=".$id;

			if($val!=".")
				$sql.= " AND forum_title LIKE '".$val."%'";

			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}
		function forum_cat_disp($val)
		{
			$sql = "SELECT cat_id,cat_name FROM category WHERE  cat_id = ".$val;
			//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			//echo $row['category_name'];exit;
			return $row['cat_name'];
		}
		function forum_cat_disp_one($val)
		{
			$query="select cat_id from forums where forum_id=$val ";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($query);
			$row = $objSql->fetchRow($record);
			$sql = "SELECT cat_id,cat_name FROM category WHERE  cat_id = ".$row['cat_id'];
			//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			//echo $row['category_name'];exit;
			return $row['cat_name'];
		}
		function forum_comment_count($val)
		{
			$sql = "SELECT count(*) as count FROM ml_forum_comms WHERE forum_id = ".$val;
			//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			return $row;
		}
		
		function subforums($val){
		$sql = "SELECT forum_id,forum_title, forum_desc, cat_id, forum_state, status FROM ise_forums where forum_state=".$val." ";
		//echo $sql;
		$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		
		
		function get_forum($val){
		$sql = "SELECT forum_id,forum_name, forum_description, forum_category, forum_state,school_id, status FROM ise_forums where forum_id=".$val." ";
		//echo $sql;exit;
		$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			return $row;
		}
		
		function forum_comments($val1)
		{
			$sql = "SELECT forum_id,f_c_desc, user_id, create_date and status FROM ml_forum_comms WHERE forum_id = ".$val1." and status='active' ORDER BY create_date desc";
			$objSql11 = new SqlClass();
			$record = $objSql11->executeSql($sql);
			return $record;
		}
		function forum_values_one($val1)
		{
			$sql = "SELECT forum_id, forum_title, forum_desc, status,create_date FROM ml_forums";
			if($val1!='')
			$sql.=" WHERE forum_id = ".$val1;
			else
			$sql.=" ORDER BY create_date LIMIT 1";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			//$row = $objSql->fetchRow($record);
			return $record;
		}
		
		function display_forum_comments($id,$page,$val,$al)
		{
			$sql = "SELECT f_c_id,f_topic_id,f_c_desc, user_id, create_date,status FROM ml_forum_comms WHERE f_topic_id = ".$id." ";
			if($al != '.')
				$sql.=" WHERE f_c_desc LIKE '".$al."%'";
			
			$sql.= "ORDER BY create_date desc";
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			//echo $sql; exit;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		
		function forum_comment_user($val)
		{
			$sql = "SELECT user_fname,user_lname FROM enm_users WHERE user_id = ".$val;
			//echo $sql;exit;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			//echo $row['category_name'];exit;
			return $row['user_fname'].' '.$row['user_lname'];
		}
	
	
	 function __construct(){
		
		$this->table_post='ise_forum_comms';
		
      	$this->query=new Queries();
	}
	function ise_forum_post_delete($field,$value){
		return $this->query->makedeletequery($this->table_post,$field,$value);
	}
	function ise_forum_post_update($array,$where){
	   return $this->query->makeupdatequery($this->table_post,$array,$where);	
	}
	
	
	
	
	
	
		
		
	}
	?>