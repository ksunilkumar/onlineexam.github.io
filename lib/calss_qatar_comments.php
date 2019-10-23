<?php

class qatar_comments{
    function __construct(){
      $this->query=new Queries();
	 $this->table = 'qatar_comments';
	}
	function qatar_comments_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function qatar_comments_set_function($array,$where){
		return $this->query->makeupdatequery($this->table,$array,$where);
	}
	function qatar_comments_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function qatar_comments_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function qatar_comments_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function qatar_comments_select($column,$field,$value)	{
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	function qatar_comments_selectallrows(){
		return $this->query->makeselectall($this->table);
	}
	function qatar_comments_selectallfields($field,$value){
		return $this->query->makeselectallfields($this->table,$field,$value);
	}
	
	function qatar_comments_selectcount($field,$value){
		return $this->query->makecount($this->table,$field,$value);
	}
}
?>
