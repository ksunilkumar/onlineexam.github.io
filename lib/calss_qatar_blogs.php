<?php

class qatar_blogs{
	 var $query;
	var $table;

    function __construct()
	{
	  $this->table='blogs';
      $this->query=new Queries();
	}
	
	function qatar_blogs_insert($array){

			return $this->query->makeinsertquery($this->table,$array);
	}

	function qatar_blogs_set_function($array,$where)
	{
		return $this->query->makeupdatequery($this->table,$array,$where);
	}

	function blog_comms_insert($array){

			return $this->query->makeinsertquery('blog_review',$array);
	}
	function qatar_blogs_update($array,$where)
	{
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}


	function qatar_blogs_delete($field,$value)
	{
		return $this->query->makedeletequery($this->table,$field,$value);

	}


	function qatar_blogs_selectall($field,$value)
	{
		return $this->query->makeselectallquery($this->table,$field,$value);

	}

	function qatar_blogs_select($column,$field,$value)
	{
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	
	function display_Blog($ob,$max,$limit)
	{
		$sqldc = "SELECT blog_id,blog_title,blog_rating,create_date,status FROM qatar_blogs ";
		if($ob == 'a') $sqldc.= "order by blog_title asc"; elseif($ob == 'a1') $sqldc.= "order by blog_title desc";
		if($ob == 'b') $sqldc.= "order by create_date asc"; elseif($ob == 'b1') $sqldc.= "order by create_date desc";
		if($ob == 'c') $sqldc.= "order by status asc"; elseif($ob == 'c1') $sqldc.= "order by status desc";
		$sqldc.=" limit ".$max.",".$limit ;
		
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);
		
		while($row = $objSqldc->fetchRow($recorddc))
		{
			$rowdc[] = $row;
		}
		return $rowdc;
	}
	
	function get_blog_count()
	{
		$sqldc = "SELECT blog_id,blog_title,blog_rating,create_date,status FROM qatar_blogs ";
		
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);
		
		$rows = $objSqldc->getNumRecord();
		
		return $rows;
	}
	function get_active_blogs($school_id)		{
			$limit=5;
			$sql = "SELECT * FROM blogs where status='active' and school_id=$school_id ORDER BY blog_id ASC";
			$pagination_qatar = new pagination_key();
		$pagination_qatar->createPaging($sql,$limit);
		while($row=mysql_fetch_object($pagination_qatar->resultpage)){
		$rowdc[]=$row;
		}
		  $rowdc['total_rec']=$pagination_qatar->totalrecords();
		  $rowdc['dis_page']=$pagination_qatar->displayPaging();
		 
		return $rowdc;
		}
	function delete_blog($table,$field,$ids)
	{
		$query="DELETE from ".$table." where ".$field." in(".$ids.")";
		$objSql = new SqlClass();
		$res = $objSql->executeSql($query);
		//$del_res = $objSql->getAffectedRows();
		return $res;
	}
	
	function get_blogs($max,$limit)
	{
		$sqldc = "SELECT blog_id,blog_title,blog_desc,blog_rating,image_path,user_id,create_date,status FROM qatar_blogs where status ='active'";	
		$sqldc.=" limit ".$max.",".$limit ;
		
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);
		
		while($row = $objSqldc->fetchRow($recorddc))
		{
			$rowdc[] = $row;
		}
		return $rowdc;
	}
	
	function get_cat_blogs($cat)
	{
		$sqldc = "SELECT blog_id,blog_title,blog_desc,blog_rating,image_path,user_id,create_date,status FROM qatar_blogs where status ='active' and cat_id = ".$cat;	
		$sqldc.=" order by create_date desc limit 0,5 " ;
		
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);
		
		while($row = $objSqldc->fetchRow($recorddc))
		{
			$rowdc[] = $row;
		}
		return $rowdc;
	}
	
	function get_blog($id)
	{
		$sqldc = "SELECT * FROM blogs where blog_id = ".$id." and status ='active'";	
				
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);
		
		$row = $objSqldc->fetchRow($recorddc);
		
		return $row;
	}
	
	function get_active_blog_count()
	{
		$sqldc = "SELECT blog_id FROM qatar_blogs where status = 'active'";
		
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);
		
		$rows = $objSqldc->getNumRecord();
		return $rows;
	}
	
	function get_review_count($bid)
	{
		$sqldc = "SELECT blog_id FROM qatar_blog_review where blog_id = ".$bid." and status = 'active'";
		
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);
		
		$rows = $objSqldc->getNumRecord();
		return $rows;
	}
	
	
	function get_blog_reviews($bid)
	{
		$sqldc = "SELECT * FROM blog_review where blog_id = ".$bid." and status = 'active' ";
		
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);
		
		while($row = $objSqldc->fetchRow($recorddc))
		{
			$rowdc[] = $row;
		}
		return $rowdc;
	}
	
	function get_usr_blogs($id)
	{
		$sqldc = "SELECT a.blog_id,a.review_desc,a.create_date as review_date,a.review_rating,b.blog_title,b.blog_desc,b.create_date as blog_date , count( a.b_r_id ) AS review_count
			FROM qatar_blog_review as a 
			inner join qatar_blogs as b on a.blog_id=b.blog_id 
			where a.user_id = ".$id." and a.status = 'active' and b.status = 'active' group by a.blog_id order by a.create_date";
		
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);
		
		while($row = $objSqldc->fetchRow($recorddc))
		{
			$rowdc[] = $row;
		}
		return $rowdc;
	}
	function get_recent_blog($schoolid){
		$sql="select * from blogs where status='active' and school_id=$schoolid order by blog_id asc limit 1";
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sql);
		return $recorddc;
	} 
	

}
?>
