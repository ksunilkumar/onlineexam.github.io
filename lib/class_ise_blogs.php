<?php

class Blogs
{
	function get_all_blogs()
	{
		$sql = "SELECT * FROM ise_blogs WHERE school_id=".$_SESSION['school_id']." and status='active' order by blog_id asc";
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		// $row = $objSql->fetchRow($recore);
		return $record;
	}

	function get_category_blogs($cat_id)
	{
		$sql = "SELECT * FROM ise_blogs WHERE school_id=".$_SESSION['school_id']." and status='active' and cat_id=".$cat_id." order by blog_id asc";
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		// $row = $objSql->fetchRow($recore);
		return $record;
	}
	
	function get_blog_details($blog_id)
	{
		$sql = "SELECT * FROM ise_blogs WHERE school_id=".$_SESSION['school_id']." and blog_id=".$blog_id;
		$objSql = new SqlClass();
		$recore = $objSql->executeSql($sql);
		$row = $objSql->fetchRow($recore);
		return $row;
	}

	function get_blog_name($blog_id)
	{
		$sql = "SELECT blog_title FROM ise_blogs WHERE blog_id=".$blog_id;
		$objSql = new SqlClass();
		$recore = $objSql->executeSql($sql);
		$row = $objSql->fetchRow($recore);
		return $row;
	}
	
	
	
	
	
	function totalNoOfBlogs($val,$sid='')
		{
				$sql	= "SELECT * FROM ise_blogs   ";
			if($sid!='')
				$sql.= "where school_id = '".$sid."%'";
			if($val!="." && $sid!='')
				$sql.= "and blog_title LIKE '".$val."%'";
			if($val!="." && $sid=='')
				$sql.= "where blog_title LIKE '".$val."%'";
			
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
	
	function display_blog($page,$al,$val,$sid)
		{
			//echo $val;exit;
			//$query	= "SELECT * FROM blogs  where school_id=".$_SESSION['school_id'] ." ORDER BY blog_title";
			$sql	= "SELECT * FROM ise_blogs   ";


			
			if($al!= '.')
				$sql.=" where  blog_title LIKE '".$al."%'  ";
			if($sid!=''&& $al != '.')
		 $sql.=" and school_id=".$sid." ";	
		 else if($sid!='')
		 $sql.=" where school_id=".$sid."  ";	
			
			if($val == '1')$sql.= "ORDER BY blog_title";elseif($val == '1')$sql.= "ORDER BY blog_title DESC";
			elseif($val == '2')$sql.= "ORDER BY status";elseif($val == '3')$sql.= "ORDER BY status DESC";
			else $sql.= "ORDER BY create_date desc";
			$sql.=" LIMIT ".($page-1)*perPage()." , ".perPage();
			//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
	
	
	function get_group_name($id)
		{
			$sql = "SELECT group_id,group_name 	 FROM ise_groups WHERE  group_id = ".$id;
			//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			
			return $row['group_name'];
		}
	
	
	function totalNoOfBlogcomms($id,$al)
		{
			$sql	= "SELECT b_r_id,blog_id,user_id,review_desc,create_date,status FROM ise_blog_review WHERE blog_id='".$id."'";
			if($al != '.')
				$sql.=" and review_desc LIKE '".$al."%'";	 
				//echo $sql;
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}
	
	
	
	function get_group_school($id)
		{
			$sql="select school_id from ise_groups where group_id=".$id;
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			//echo $row['school_id'];exit;
			return $row['school_id'];
		}
	
	function display_blog_comms($page,$al,$val,$id)
		{
			
			 $sql	= "SELECT * FROM ise_blog_review WHERE blog_id='".$id."' ";
			
			if($al != '.')
				$sql.=" and review_desc LIKE '".$al."%' ";
			
			
			if($val == '1')$sql.= "ORDER BY review_desc";elseif($val == '0')$sql.= "ORDER BY review_desc DESC";
			elseif($val == '2')$sql.= "ORDER BY status";elseif($val == '3')$sql.= "ORDER BY status DESC";
			else $sql.= "ORDER BY create_date 	Desc";
			$sql.=" LIMIT ".($page-1)*perPage()." , ".perPage();
		
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
	
	function blog_review_view($id)
		{
			$sql="SELECT b_r_id,blog_id,user_id,review_desc,review_rating,create_date,status FROM ise_blog_review WHERE b_r_id='".$id."'";
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			//echo $row['school_id'];exit;
			return $row;
		}
	 function __construct(){
		
		$this->table_post='ise_blog_review';
		
      	$this->query=new Queries();
	}
	function ise_blog_post_delete($field,$value){
		return $this->query->makedeletequery($this->table_post,$field,$value);
	}
	function ise_blog_post_update($array,$where){
	   return $this->query->makeupdatequery($this->table_post,$array,$where);	
	}
}

?>