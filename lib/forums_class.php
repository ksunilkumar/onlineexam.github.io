<?php 
include_once 'db.php';
//	define('Site_Admin_Name', 'http://learnnow.in/admin/');
//	define('Site_Name', 'http://localhost/enggmath/');
	/*define('Site_Admin_Name','http://localhost/robo_18/admin/');
	define('Site_Name', 'http://localhost/robo_18/');*/
	//define('Site_Admin_Name','http://learnnow.in/admin/');
	//define('Site_Name', 'http://robotutor.in/');
	//admin login check function
	
	class Forums{
	var $query;
	var $table;
	
    function __construct()
	{
	  $this->table='ise_forum_comms';
      $this->query=new Queries();
	}
	
	
function display_forums($page,$al,$order)
		{
			$sql = "SELECT * FROM ise_forums where forum_state=0 ";
			if($al != '.')
				$sql.=" AND forum_name LIKE '".$al."%'";
			if($val == '0')$sql.= "ORDER BY forum_name";elseif($val == '1')$sql.= "ORDER BY news_title DESC";
			elseif($val == '2')$sql.= "ORDER BY status";elseif($val == '3')$sql.= "ORDER BY status DESC";
			else $sql.= " ORDER BY create_date desc";
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			//echo $sql;exit;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function display_subforums($id,$page,$al,$val)
		{
			$sql = "SELECT forum_id,forum_name, forum_description, forum_category, forum_state, status FROM ise_forums where forum_state=".$id." ";
			if($al != '.')
				$sql.=" AND forum_name LIKE '".$al."%' ";
			
			if($val == '0')$sql.= "ORDER BY forum_name";elseif($val == '1')$sql.= "ORDER BY forum_name DESC";
			elseif($val == '2')$sql.= "ORDER BY forum_category";elseif($val == '3')$sql.= "ORDER BY forum_category DESC";
			//elseif($val == '4')$sql.= "ORDER BY group_owner";elseif($val == '5')$sql.= "ORDER BY group_owner DESC";
			elseif($val == '6')$sql.= "ORDER BY status";elseif($val == '7')$sql.= "ORDER BY status DESC";
			else $sql.= "ORDER BY forum_name";
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			//echo $sql;exit;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function totalNoOfforums($al,$id)
		{
			$sql = "SELECT * FROM ise_forums WHERE forum_state=".$id;

			if($al!=".")
				$sql.= " AND forum_name LIKE '".$al."%'";

			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}
		function totalNoOfSubforums($al,$id)
		{
			$sql = "SELECT * FROM ise_forums WHERE forum_state=".$id;
              if($al!=".")
				$sql.= " AND forum_name LIKE '".$al."%'";

			
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}
		function totalNoOf_active_Subforums($id)
		{
			$sql = "SELECT * FROM ise_forums WHERE status='active' AND forum_state=".$id;
             
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}
		
		function totalNoOfComments($al,$id)
		{
			$sql = "SELECT * FROM ise_forum_comms WHERE forum_id=".$id;
            if($al!=".")
				$sql.= " AND f_c_desc LIKE '".$al."%'";

			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}
		function totalNoOf_active_Comments($id)
		{
			$sql = "SELECT * FROM ise_forum_comms WHERE status='active' and forum_id=".$id;
           
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}
		
		
		function forum_cat_disp($val)
		{
			$sql = "SELECT category_id,category_name FROM enm_category WHERE category_id = ".$val;
			//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			//echo $row['category_name'];exit;
			return $row['category_name'];
		}
		function forum_comment_count($val)
		{
			$sql = "SELECT count(*) as count FROM enm_forum_comms WHERE status='active' and forum_id = ".$val;
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			return $row;
		}
		
		function subforums($val){
		$sql = "SELECT forum_id,forum_name, forum_desc, cat_id, forum_state, status FROM ise_forums where forum_state=".$val." ";
		//echo $sql;
		$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		
		function forum_comments($val1)
		{
			$sql = "SELECT forum_id,f_c_desc, user_id, create_date,status FROM ise_forum_comms WHERE forum_id = ".$val1." and status='active' ORDER BY create_date desc";
			$objSql11 = new SqlClass();
			$record = $objSql11->executeSql($sql);
			return $record;
		}
		function forum_values_one($val1)
		{
			$sql = "SELECT forum_id, forum_name, forum_description, status,create_date FROM ise_forums";
			if($val1!='')
			$sql.=" WHERE forum_id = ".$val1;
			else
			$sql.=" ORDER BY create_date LIMIT 1";
			//echo $sql;exit;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			//$row = $objSql->fetchRow($record);
			return $record;
		}
		
		function display_forum_comments($id,$page,$al,$val)
		{
			$sql = "SELECT f_c_id,forum_id,f_c_desc, user_id,f_com_rating, create_date,status FROM ise_forum_comms WHERE forum_id = ".$id." ";
			if($al != '.')
				$sql.="and f_c_desc LIKE '".$al."%'";
			
			$sql.= "ORDER BY create_date desc";
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			//echo $sql; exit;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		
		function forum_comment_user($val)
		{
			$sql = "SELECT user_fname,user_lname FROM ise_users WHERE user_id = ".$val;
			//echo $sql;exit;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			//echo $row['category_name'];exit;
			return $row['user_fname'].' '.$row['user_lname'];
		}
		
	function get_active_forums($id)		{
			$sql = "SELECT * FROM ise_forums where forum_state=0 and school_id=".$id." and status='active' ORDER BY forum_id DESC";
			$objSql = new SqlClass();
			$recore = $objSql->executeSql($sql);
			return $recore;
		}
		
		
		function get_active_subforums($val,$schoolid){
		$sql = "SELECT forum_id,forum_name, forum_description,createdby,create_date FROM ise_forums where status='active' and forum_state=".$val." and school_id=$schoolid";
		//echo $sql;
		$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function get_fourm_info($val,$schoolid){
		$sql = "SELECT forum_id,forum_name, forum_description FROM ise_forums where status='active' and forum_id=".$val." and school_id=$schoolid";
		//echo $sql;
		$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			return $row;
		}
		function forum_comms_insert($array){

			return $this->query->makeinsertquery($this->table,$array);
	}
		
	function get_latest_forums($id='')		{
			$sql = "SELECT * FROM ise_forums where forum_state=0 and status='active' ";
			if($id!='')
				$sql.=" and school_id=".$id;
			$sql.=" ORDER BY forum_id DESC LIMIT 0,5";
			
			$objSql = new SqlClass();
			$recore = $objSql->executeSql($sql);
			return $recore;
		}	
		function get_search_forum($val){
			$sql = "SELECT forum_id,forum_name, forum_description FROM ise_forums where status='active' and forum_id=".$val;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
	}
	 
	