<?php 
	session_start();
	include_once 'lib/db.php';
	$objSql2 = new SqlClass();
	
	$sql2 = "SELECT stat_id, stat_name FROM ise_state WHERE status = 'active' AND country_id = '".$_GET['cou']."' ";
		$objSql2 = new SqlClass();
		$record2 = $objSql2->executeSql($sql2);
		$out = "<select name='selstate'>";
		$out.= "<option value=''>Select State from List</option>";
		while($row2 = $objSql2->fetchRow($record2))
		{
			$out.= "<option value='".$row2['stat_id']."'>".$row2['stat_name']."</option>";
			
		}
		$out.= "</select>";
		echo $out;
?>