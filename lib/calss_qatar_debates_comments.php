<?php

class qatar_debates_comments{
    function __construct(){
      $this->query=new Queries();
	 $this->table = 'qatar_debates_comments';
	}
	function qatar_debates_comments_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function qatar_debates_comments_set_function($array,$where){
		return $this->query->makeupdatequery($this->table,$array,$where);
	}
	function qatar_debates_comments_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function qatar_debates_comments_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function qatar_debates_comments_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function qatar_debates_comments_select($column,$field,$value)	{
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	function qatar_debates_comments_deb1($field,$value){
		return $this->query->makeselectall1($this->table, $field, $value);
	}
	function qatar_debates_comments_selectallrows(){
		return $this->query->makeselectall($this->table);
	}
	function qatar_debates_comments_selectallfields($field,$value){
		return $this->query->makeselectallfields($this->table,$field,$value);
	}
	function qatar_debates_comments_selectexisting($val1,$val2)
	{
		$sql = "SELECT count(*) as count FROM qatar_debates_comments WHERE user_id=".$val1." AND debate_id=".$val2;
		    //echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			return $row['count'];
	}
	function qatar_debates_comm($val)
	{
		$sql = "SELECT  a.comment_id, a.user_id, b.username, b.profile_photo, b.city_study, b.country_study FROM qatar_debates_comments as a
			inner join qatar_users as b on a.user_id = b.user_id  where a.debate_id=".$val." AND a.status='active'";
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function qatar_debates_comm_coun($val)
	{
		$sql = "SELECT count(*) as count FROM qatar_debates_comments where debate_id=".$val." AND status='active'";
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			return $row['count'];
	}
	
	
		function qatar_debates_graph_val($id)
	{
		$sql = "SELECT comment_id,points,user_id FROM qatar_videos_comms where video_id=".$id." limit 0,10";
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$val = "";
			$max = "";
			while($row = $objSql->fetchRow($record))
			{
				$x[] = $row;
				$val=$val.",".$row['points'];
				$max = max($max,$row['points']);
			}
			$ret[0]=$max;
			if(sizeof($x) >=1 )
			{
				$val = explode(",",substr($val,1));
			}
			else
			{
				$val='';
			}	
			$ret[1]=$val;
			return $ret;
	}
	
	
	/*function qatar_debates_comms($id)
	{
		$sql = "SELECT comment_id,commet_des,points,comment_type,user_id FROM qatar_videos_comms where video_id=".$id." limit 0,10";
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$val = "";
			$max = "";
			while($row = $objSql->fetchRow($record))
			{
				$x[] = $row;
				$val=$val.",".$row['points'];
				$max = max($max,$row['points']);
			}
			return $x;
	}
	*/
	
	
	function qatar_debates_comms($id,$ln1,$ln2)
	{
		$sql = "SELECT comment_id,commet_des,points,comment_type,user_id FROM qatar_videos_comms where video_id=".$id." limit ".$ln1.",".$ln2."";
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$val = "";
			$max = "";
			while($row = $objSql->fetchRow($record))
			{
				$x[] = $row;
				$val=$val.",".$row['points'];
				$max = max($max,$row['points']);
			}
			return $x;
	}
	
}
?>
