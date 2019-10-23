<?php

class qatar_videos{
    function __construct(){
      $this->query=new Queries();
	 $this->table = 'videos';
	}
	function qatar_videos_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function qatar_videos_set_function($array,$where){
		return $this->query->makeupdatequery($this->table,$array,$where);
	}
	function qatar_videos_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function qatar_videos_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function qatar_videos_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function qatar_videos_select($column,$field,$value)	{
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	function qatar_videos_selectallcolumns()	{
		return $this->query->makeselectall($this->table);
	}
		
	function qatar_videos_selectvid($val)
	{
		$sql = "SELECT * FROM qatar_videos where video_id =".$val; 
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function qatar_videos_selectvid_1()
	{
		 $sql = "SELECT * FROM qatar_videos WHERE status='active' ORDER BY create_date DESC LIMIT 0,1"; 
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function qatar_videos_prof()
	{
		$sql = "SELECT * FROM qatar_videos ORDER BY create_date DESC LIMIT 0,3"; 
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function qatar_videos_selectcom_2()
	{
			$sql = "SELECT * FROM qatar_videos_comms ORDER BY rate DESC LIMIT 0,1"; 
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function qatar_videos_disp($val,$max)
	{
		$min=$max;
		$max = $max+'15';
		$sql = "SELECT video_id, video_title, youtube_url, video_name, view_count, create_date, status FROM qatar_videos ";
			if($val == '0')$sql.= "ORDER BY video_title";elseif($val == '1')$sql.= "ORDER BY video_title DESC";
			elseif($val == '2')$sql.= "ORDER BY video_name";elseif($val == '3')$sql.= "ORDER BY video_name DESC";
			elseif($val == '4')$sql.= "ORDER BY view_count";elseif($val == '5')$sql.= "ORDER BY view_count DESC";
			elseif($val == '6')$sql.= "ORDER BY create_date";elseif($val == '7')$sql.= "ORDER BY create_date DESC";
			elseif($val == '8')$sql.= "ORDER BY status";elseif($val == '9')$sql.= "ORDER BY status DESC";
		$sql.= " LIMIT ".$min.",".$max;
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function qatar_videos_selectdid($val)
	{
		$sql = "SELECT * FROM qatar_videos where debate_id =".$val;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function qatar_videos_index()
	{
			$sql = "SELECT * FROM qatar_videos WHERE status='active' ORDER BY create_date DESC LIMIT 0,3"; 
			$objSql_v = new SqlClass();
			$record = $objSql_v->executeSql($sql);
			return $record;
	}
	function qatar_videos_index_count()
	{
			$sql = "SELECT count(*) as count FROM qatar_videos WHERE status='active'"; 
			$objSql_v = new SqlClass();
			$record = $objSql_v->executeSql($sql);
			$val_v = $objSql_v->fetchRow($record);
			return $val_v['count'];
	}
	
	
}
?>