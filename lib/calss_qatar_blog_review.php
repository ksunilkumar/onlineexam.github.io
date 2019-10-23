<?php

class qatar_blog_review{
	 var $query;
	var $table;
	
    function __construct()
	{
	 $this->table='blog_review';
      $this->query=new Queries();
	}
	
	function qatar_blog_review_insert($array){

		return $this->query->makeinsertquery($this->table,$array);
	}

	function qatar_blog_review_set_function($array,$where)
	{
		return $this->query->makeupdatequery($this->table,$array,$where);
	}

	
	function qatar_blog_review_update($array,$where)
	{
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}


	function qatar_blog_review_delete($field,$value)
	{
		return $this->query->makedeletequery($this->table,$field,$value);

	}


	function qatar_blog_review_selectall($field,$value)
	{
		return $this->query->makeselectallquery($this->table,$field,$value);

	}

	function qatar_blog_review_select($column,$field,$value)
	{
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	
	function display_Reviews($ob,$max,$limit)
	{
		$sqldc = "SELECT b_r_id,blog_id,user_id,review_desc,review_rating,create_date,status FROM qatar_blog_review ";
		if(isset($_SESSION['bid'])) $sqldc.= "where blog_id = ".$_SESSION['bid']." ";
		if($ob == 'a') $sqldc.= "order by review_desc asc"; elseif($ob == 'a1') $sqldc.= "order by review_desc desc";
		if($ob == 'b') $sqldc.= "order by create_date asc"; elseif($ob == 'b1') $sqldc.= "order by create_date desc";
		if($ob == 'd') $sqldc.= "order by review_rating asc"; elseif($ob == 'd1') $sqldc.= "order by review_rating desc";
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
		
	function get_review_count()
	{
		$sqldc = "SELECT b_r_id,blog_id,user_id,review_desc,review_rating,create_date,status FROM qatar_blog_review";
		if(isset($_SESSION['bid'])) $sqldc.= " where blog_id = ".$_SESSION['bid']." ";
		
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);
		
		$rows = $objSqldc->getNumRecord();
		
		return $rows;
	}
	
	function blog_rating($bid)
	{
		$sqldc = "SELECT review_rating FROM qatar_blog_review where blog_id = ".$bid." and status='active'";
		
		$objSqldc = new SqlClass();
		$recorddc = $objSqldc->executeSql($sqldc);
		
		$rows = $objSqldc->getNumRecord();
		$count = 0;
		while($row = $objSqldc->fetchRow($recorddc))
		{			
			$count += $row['review_rating'];
		}
		
		if($rows >=1 ) { $avg_rating = intval($count/$rows); } else $avg_rating=1;

		return $avg_rating;
		
	}

}
?>
