<?php
class qatar_newsletter{
	 var $query;
	var $table;
	
    function __construct(){
	 
      $this->query=new Queries();
	  $this->table='qse_newsletters';
	}
	
	
	function qatar_newsletterusers_update($array,$where){
	   return $this->query->makeupdatequery('qse_newsletter_users',$array,$where);	
	}
	
	
	function qatar_newsletter_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function qatar_newsletter_set_function($array,$where){
		return $this->query->makeupdatequery($this->table,$array,$where);
	}
	function qatar_newsletter_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function qatar_newsletter_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function qatar_newsletter_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function qatar_newsletter_select($column,$field,$value){
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	function qatar_news_disp($val,$max)
	{
		$min=$max;
		$max = $max+'15';
		$sql = "SELECT news_id , news_title , news_pic , create_date , status FROM tt_news ";
			if($val == '0')$sql.= "ORDER BY news_title";elseif($val == '1')$sql.= "ORDER BY news_title DESC";
			elseif($val == '2')$sql.= "ORDER BY news_pic";elseif($val == '3')$sql.= "ORDER BY news_pic DESC";
			elseif($val == '4')$sql.= "ORDER BY create_date";elseif($val == '5')$sql.= "ORDER BY create_date DESC";
			elseif($val == '6')$sql.= "ORDER BY status";elseif($val == '7')$sql.= "ORDER BY status DESC";
		$sql.= " LIMIT ".$min.",".$max;
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	/*function news_display_all()
		{
			$sql = "SELECT * FROM tt_news where status='active' ORDER BY create_date DESC";
			$objSql = new SqlClass();
			$recore = $objSql->executeSql($sql);
			return $recore;
		}*/
			function news_display_all($id)
		{
			$sql = "SELECT * FROM qse_newsletters where status='active' and newsletter_id=$id";
			$objSql = new SqlClass();
			$recore = $objSql->executeSql($sql);
			return $recore;
		}
}
?>
