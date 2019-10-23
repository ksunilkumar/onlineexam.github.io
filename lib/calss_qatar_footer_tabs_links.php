<?php
class qatar_footer_tabs_links{
	 var $query;
	var $table;
	
    function __construct(){
	 
      $this->query=new Queries();
	  $this->table='qatar_footer_tab_links';
	}
	function qatar_footer_tabs_links_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function qatar_footer_tabs_links_set_function($array,$where){
		return $this->query->makeupdatequery($this->table,$array,$where);
	}
	function qatar_footer_tabs_links_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function qatar_footer_tabs_links_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function qatar_footer_tabs_links_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function qatar_footer_tabs_links_select($column,$field,$value){
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	function qatar_footer_tabs_links_disp()
	{
		$sql = "SELECT ftab_id , tab_title , tab_image , create_date , last_update, status FROM qatar_footer_tab ";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function qatar_footer_tabs_links_link_disp($id)
	{
		$sql = "SELECT * FROM `qatar_footer_tab_links` WHERE ftab_id=".$id;
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		return $record;
	}
}
?>
