<?php
class qatar_videos_comms{

    function __construct(){
      $this->query=new Queries();
	  $this->table = 'qatar_videos_comms';
	}
	function qatar_videos_comms_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function qatar_videos_comms_set_function($array,$where)	{
		return $this->query->makeupdatequery($this->table,$array,$where);
	}
	function qatar_videos_comms_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function qatar_videos_comms_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function qatar_videos_comms_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function qatar_videos_comms_select($column,$field,$value){
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	function qatar_videos_comm_disp($val,$max)
	{
		$min=$max;
		$max = $max+'15';
		$sql = "SELECT comment_id, commet_des, video_id, user_name, user_email, create_date, status FROM qatar_videos_comms ";
			if($val == '0')$sql.= "ORDER BY user_name";elseif($val == '1')$sql.= "ORDER BY user_name DESC";
			elseif($val == '2')$sql.= "ORDER BY video_id";elseif($val == '3')$sql.= "ORDER BY video_id DESC";
			elseif($val == '4')$sql.= "ORDER BY create_date";elseif($val == '5')$sql.= "ORDER BY create_date DESC";
			elseif($val == '6')$sql.= "ORDER BY status";elseif($val == '7')$sql.= "ORDER BY status DESC";
		$sql.= " LIMIT ".$min.",".$max;
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
}
?>
