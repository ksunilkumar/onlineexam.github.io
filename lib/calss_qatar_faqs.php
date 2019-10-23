<?php
class qatar_faqs{
	var $query;
	var $table;
	
    function __construct()
	{
	  $this->table='faqs';
      $this->query=new Queries();
	}
	function qatar_faqs_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function qatar_faqs_set_function($array,$where){
		return $this->query->makeupdatequery($this->table,$array,$where);
	}
	function qatar_faqs_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function qatar_faqs_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function qatar_faqs_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function qatar_faqs_select($column,$field,$value){
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	
	function qatar_faqs_disp($var,$max){
		$min=$max;
		$max = $max+'15';
		$sql = "SELECT faq_id, faq_question, user_id, create_date, status FROM  faqs ";
		if($var == 'or'){
			if($val == '0')$sql.= "ORDER BY faq_question";elseif($val == '1')$sql.= "ORDER BY faq_question DESC";
			elseif($val == '2')$sql.= "ORDER BY create_date";elseif($val == '3')$sql.= "ORDER BY create_date DESC";
			elseif($val == '4')$sql.= "ORDER BY status";elseif($val == '5')$sql.= "ORDER BY status DESC";
		}
		$sql.= " LIMIT ".$min.",".$max;
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		return $record;
	}
	function display_active_faqs(){
		
		$sql = "SELECT faq_id, faq_question, faq_answer, user_id, create_date FROM  faqs where status = 'active' ";
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		return $record;
	}
	function userdetails($x){
		
		$sql = "SELECT username FROM  users where user_id=$x";
			$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		$row = $objSql->fetchRow($record);
		return $row;
	}
	function display_faqs_one(){
		
		$sql = "SELECT * FROM  faqs where status = 'active' ORDER BY create_date DESC LIMIT 0,1";
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		$row = $objSql->fetchRow($record);
		return $row;
	}
	
}
?>
