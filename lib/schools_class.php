<?php
class School
{
function __construct(){
      $this->query=new Queries();
	 $this->table = 'ise_schools';
	}
	function school_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function schools_set_function($array,$where){
		return $this->query->makeupdatequery($this->table,$array,$where);
	}
	function schools_delete($field,$value)
	{
		return $this->query->makedeletequery($this->table,$field,$value);
	}
}
?>