<?php

class qatar_forums{
	 var $query;
	var $table;
	
    function __construct()
	{
	  $this->table='forums';
      $this->query=new Queries();
	}
	
	function qatar_forums_insert($array){

			return $this->query->makeinsertquery($this->table,$array);
	}

	function qatar_forums_set_function($array,$where)
	{
		return $this->query->makeupdatequery($this->table,$array,$where);
	}

	
	function qatar_forums_update($array,$where)
	{
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}


	function qatar_forums_delete($field,$value)
	{
		return $this->query->makedeletequery($this->table,$field,$value);

	}
	function forum_comms_insert($array){

			return $this->query->makeinsertquery('forum_comms',$array);
	}

	function qatar_forums_selectall($field,$value)
	{
		return $this->query->makeselectallquery($this->table,$field,$value);

	}

	function qatar_forums_select($column,$field,$value)
	{
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	
	function display_forum($ob,$max,$limit,$forum_state)
	{
		$sqldc = "SELECT forum_id,forum_title,forum_state,create_date,status FROM forums where forum_state=".$forum_state." ";
		if($ob == 'a') $sqldc.= "order by forum_title asc"; elseif($ob == 'a1') $sqldc.= "order by forum_title desc";
		if($ob == 'b') $sqldc.= "order by create_date asc"; elseif($ob == 'b1') $sqldc.= "order by create_date desc";
		if($ob == 'c') $sqldc.= "order by status asc"; elseif($ob == 'c1') $sqldc.= "order by status desc";
		$sqldc.=" limit ".$max.",".$limit ;
		//echo $sqldc."<P>";
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);
		
		while($row = $objSqldc->fetchRow($recorddc))
		{			
			$rowdc[] = $row;
		}
		return $rowdc;
	}
	
	function display_active_forums()
	{
		$sqldc = "SELECT a.forum_id,a.forum_title,a.forum_desc,a.forum_state,a.create_date,a.status,b.display_name FROM qatar_forums as a
			inner join users as b on a.user_id = b.user_id  where a.forum_state=0 and a.status='active'";

		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);
		
		while($row = $objSqldc->fetchRow($recorddc))
		{			
			$rowdc[] = $row;
		}
		return $rowdc;
	}
	function get_active_forums($school_id)		{
			$limit=5;
			$sql = "SELECT * FROM forums where forum_state=0 and status='active' and school_id=$school_id ORDER BY forum_id ASC";
			$pagination_qatar = new pagination_key();
		$pagination_qatar->createPaging($sql,$limit);
		while($row=mysql_fetch_object($pagination_qatar->resultpage)){
		$rowdc[]=$row;
		}
		  $rowdc['total_rec']=$pagination_qatar->totalrecords();
		  $rowdc['dis_page']=$pagination_qatar->displayPaging();
		 
		return $rowdc;
		}
			function get_fourm_info($val){
		$sql = "SELECT * FROM forums where status='active' and forum_id=".$val." ";
		//echo $sql;
		$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			return $row;
		}
		function get_active_subforums($val){
		$sql = "SELECT forum_id,forum_title, forum_desc,create_date FROM forums where status='active' and forum_state=".$val." ";
		//echo $sql;
		$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function forum_comments($val1)
		{
			$sql = "SELECT f_topic_id,f_c_desc, user_id, create_date,status FROM forum_comms WHERE f_topic_id = ".$val1." and status='active' ORDER BY create_date desc limit 4";
			
			$objSql11 = new SqlClass();
			$record = $objSql11->executeSql($sql);
			return $record;
		}
			function forum_comments_all($val1)
		{
			$sql = "SELECT f_topic_id,f_c_desc, user_id, create_date,status FROM forum_comms WHERE f_topic_id = ".$val1." and status='active' ORDER BY create_date desc ";
			
			$objSql11 = new SqlClass();
			$record = $objSql11->executeSql($sql);
			return $record;
		}
	function display_cat_forums($catid)
	{
		$sqldc = "SELECT a.forum_id,a.forum_title,a.forum_desc,a.forum_state,a.create_date,a.status,b.display_name FROM forums as a
			inner join users as b on a.user_id = b.user_id  where a.forum_state=0 and a.status='active' and cat_id=".$catid." order by create_date desc limit 0,5";

		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);
		
		while($row = $objSqldc->fetchRow($recorddc))
		{			
			$rowdc[] = $row;
		}
		return $rowdc;
	}
	
	function display_active_subforums($id)
	{
		$sqldc = "SELECT a.forum_id,a.forum_title,a.forum_desc,a.forum_state,a.create_date,a.status,b.display_name FROM forums as a
			inner join qatar_users as b on a.user_id = b.user_id  where a.forum_state=".$id." and a.status='active'";

		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);
		
		while($row = $objSqldc->fetchRow($recorddc))
		{			
			$rowdc[] = $row;
		}
		return $rowdc;
	}
	
	function get_subtopic_list($id)
	{
		$sqldc = "SELECT a.forum_title FROM forums as a
			 where a.forum_state=".$id." and a.status='active' order by create_date desc limit 0,3";

		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);
		
		
		while($row = $objSqldc->fetchRow($recorddc))
		{			
			$rowdc[] = substr($row['forum_title'], 0, 15).',';
		}		
		$rowstr = $rowdc[0].$rowdc[1].$rowdc[2].'...';
		
		return $rowstr;
	}
	

	function get_forum_count($forum_state)
	{
		$sqldc = "SELECT forum_id,forum_title,forum_state,create_date,status FROM forums where forum_state=".$forum_state." ";
		
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);			
		$rows = $objSqldc->getNumRecord();
		
		return $rows;
	}
	
	

	function get_subtopic_count($id)
	{
		 $sqldc = "SELECT forum_id FROM forums where forum_state=".$id." and status='active'";
		
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);			
		$rows = $objSqldc->getNumRecord();
		
		return $rows;
	}	
	
	function delete_forum($table,$field,$ids)
	{
		$query="DELETE from ".$table." where ".$field." in(".$ids.")";
		$objSql = new SqlClass();
		$res = $objSql->executeSql($query);
		
		return $res;
	}	
	
	function get_post_count($id)
	{
		$ids = $id;
		$sql = "SELECT forum_id,forum_state FROM forums where forum_state=".$id." ";
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sql);
		while($row = $objSqldc->fetchRow($recorddc))
		{			
			$ids .= ",".$row[forum_id] ;
		}		
	
		$sqldc = "SELECT f_c_id FROM forum_comms where f_topic_id in(".$ids.")";
		
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);			
		$rows = $objSqldc->getNumRecord();
		
		return $rows;
	}
	
	function get_active_post_count($id)
	{
		$ids = $id;
		$sql = "SELECT forum_id,forum_state FROM forums where forum_state=".$id." and status='active'";
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sql);
		while($row = $objSqldc->fetchRow($recorddc))
		{			
			$ids .= ",".$row[forum_id] ;
		}		
	
		$sqldc = "SELECT f_c_id FROM forum_comms where f_topic_id in(".$ids.") and status = 'active'";
		
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);			
		$rows = $objSqldc->getNumRecord();
		
		return $rows;
	}
	
	function get_last_reply($id)
	{
		$ids = $id;
		$sql = "SELECT forum_id,forum_state FROM forums where forum_state=".$id." ";
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sql);
		while($row = $objSqldc->fetchRow($recorddc))
		{			
			$ids .= ",".$row[forum_id] ;
		}		
	
		$sqldc = "SELECT f_c_id,create_date FROM forum_comms where f_topic_id in(".$ids.") order by create_date";
		
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);
		$row = $objSqldc->fetchRow($recorddc);	
		
		return $row['create_date'];
	}
	
	
	function get_active_reply($id)
	{
		$sqldc = "SELECT a.f_c_id,a.f_c_desc,a.create_date,b.display_name FROM forum_comms as a
			inner join users as b on a.user_id = b.user_id  where a.f_topic_id =".$id." and a.status='active' order by a.create_date desc";

		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);
		
		while($row = $objSqldc->fetchRow($recorddc))
		{			
			$rowdc[] = $row;
		}
		return $rowdc;
	}
	
	function replace_p_tags($str)
	{
		$rep = array('<p>','</p>');
		$rep_str = str_replace($rep,'', $str);
		return $rep_str;
	}
	
	
	function get_usr_forums($id)
	{
		$sql = "SELECT a.f_c_id ,a.f_topic_id, a.f_c_desc, a.user_id, a.create_date as comment_date, b.forum_title, b.forum_state   
			FROM forum_comms as a 
			inner join forums as b on a.f_topic_id = b.forum_id where a.user_id = ".$id." and a.status = 'active' and  b.status='active' order by a.create_date desc limit 0,3";
			
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