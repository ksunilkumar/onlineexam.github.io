<?php
class qatar_footer_tabs{
	 var $query;
	var $table;
	
    function __construct(){
	 
      $this->query=new Queries();
	  $this->table='qatar_footer_tab';
	}
	function qatar_footer_tabs_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function qatar_footer_tabs_set_function($array,$where){
		return $this->query->makeupdatequery($this->table,$array,$where);
	}
	function qatar_footer_tabs_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function qatar_footer_tabs_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function qatar_footer_tabs_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function qatar_footer_tabs_select($column,$field,$value){
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	function qatar_footer_tabs_disp()
	{
		$sql = "SELECT ftab_id , tab_title , tab_image , create_date , last_update, status FROM qatar_footer_tab ";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function qatar_footer_tabs_link_disp($id)
	{
		$sql = "SELECT * FROM `qatar_footer_tab_links` WHERE ftab_id=".$id;
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		return $record;
	}
}
?>
