<?php

class qatar_blog_follw{
	 var $query;
	var $table;
	
    function __construct()
	{
	  $this->table='qatar_blog_follw';
      $this->query=new Queries();
	}
	
	function qatar_blog_follw_insert($array){

			return $this->query->makeinsertquery($this->table,$array);
	}

	function qatar_blog_follw_set_function($array,$where)
	{
		return $this->query->makeupdatequery($this->table,$array,$where);
	}

	
	function qatar_blog_follw_update($array,$where)
	{
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}


	function qatar_blog_follw_delete($field,$value)
	{
		return $this->query->makedeletequery($this->table,$field,$value);

	}


	function qatar_blog_follw_selectall($field,$value)
	{
		return $this->query->makeselectallquery($this->table,$field,$value);

	}

	function qatar_blog_follw_select($column,$field,$value)
	{
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}

}
?>
