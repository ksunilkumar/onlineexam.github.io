<?php
class exams_offers{
    function __construct(){
      $this->query=new Queries();
	 $this->table = 'test_offers';
	}
	function offers_insert($array){
	echo"jhjj";
			return $this->query->makeinsertquery($this->table,$array);
	}
	function offers_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function offers_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function offers_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}

	
}
?>
