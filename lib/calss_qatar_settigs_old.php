<?php
class qatar_settings{
 	
	 function __construct(){
      $this->query=new Queries();
	}
	
	function chk_usr_authentication()
	{
		session_start();
		if(!(isset($_SESSION['user_id'])) || $_SESSION['user_id']=='') { $_SESSION['authmsg'] = 'Please login to proceed...'; header("location:index.php");		exit(); }
	}
	
	function get_currentfile()
	{
		$file = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
		$qry_str = $_SERVER["QUERY_STRING"];
		$filename = $file.'?'.$qry_str;
		unset($_SESSION['new_file']); $_SESSION['new_file'] = $filename;
	}
	
	function qatar_country(){
		$sql1 = "SELECT country_id, country_name FROM qatar_country WHERE status = 'active' ORDER BY country_name ";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='selcountry' onChange='state(this.value)' style='width:150px;'>";
		$out.= "<option value=''>Select Country from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			$out.= "<option value='".$row1['country_id']."'>".$row1['country_name']."</option>";
		}
		$out.= "</select>";
		return $out;
	}
	function qatar_country_sel($val){
		$sql1 = "SELECT country_id, country_name FROM qatar_country WHERE status = 'active' ORDER BY country_name ";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='selcountry' onChange='state(this.value)' style='width:150px;'>";
		$out.= "<option value=''>Select Country from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			if($row1['country_id'] == $val)
			$out.= "<option value='".$row1['country_id']."' selected>".$row1['country_name']."</option>";
			else
			$out.= "<option value='".$row1['country_id']."'>".$row1['country_name']."</option>";
		}
		$out.= "</select>";
		return $out;
	}
	function qatar_state(){
		$sql1 = "SELECT stat_id, stat_name FROM qatar_state WHERE status = 'active' ORDER BY stat_name ";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='selstate' style='width:150px;'>";
		$out.= "<option value=''>Select State/Province from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			$out.= "<option value='".$row1['stat_id']."'>".$row1['stat_name']."</option>";
		}
		$out.= "</select>";
		return $out;
	}
	function qatar_state_sel($val){
		$sql1 = "SELECT stat_id, stat_name FROM qatar_state WHERE status = 'active' ORDER BY stat_name ";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='selstate' style='width:150px;'>";
		$out.= "<option value=''>Select State/Province from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			if($row1['stat_id'] == $val)
			$out.= "<option value='".$row1['stat_id']."' selected>".$row1['stat_name']."</option>";
			else
			$out.= "<option value='".$row1['stat_id']."'>".$row1['stat_name']."</option>";
		}
		$out.= "</select>";
		return $out;
	}
	function qatar_users(){
		$sql1 = "SELECT user_id, user_name FROM qatar_users ORDER BY user_name";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='seluser' style='width:150px;'>";
		$out.= "<option value=''>Select User from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			$out.= "<option value='".$row1['user_id']."'>".$row1['user_name']."</option>";
		}
		$out.= "</select>";
		return $out;
	}
	function qatar_users_sel($id){
		$sql1 = "SELECT user_id, user_name FROM qatar_users ORDER BY user_name";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='seluser' style='width:150px;'>";
		$out.= "<option value=''>Select User from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			if($row1['user_id'] == $id)
			$out.= "<option value='".$row1['user_id']."' selected>".$row1['user_name']."</option>";
			else
			$out.= "<option value='".$row1['user_id']."'>".$row1['user_name']."</option>";
		}
		$out.= "</select>";
		return $out;
	}
	function qatar_cat(){
		$sql1 = "SELECT cat_id, cat_name FROM qatar_category WHERE status = 'active' ORDER BY cat_name";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='selcat' style='width:150px;'>";
		$out.= "<option value=''>Select Category from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			$out.= "<option value='".$row1['cat_id']."'>".$row1['cat_name']."</option>";
		}
		$out.= "</select>";
		return $out;
	}
	function qatar_cat_sel($id){
		
		$sql1 = "SELECT cat_id, cat_name FROM qatar_category WHERE status = 'active' ORDER BY cat_name";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='selcat' style='width:150px;'>";
		$out.= "<option value=''>Select Category from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			if($row1['group_cat_id'] == $id)
			$out.= "<option value='".$row1['cat_id']."' selected>".$row1['cat_name']."</option>";
			else
			$out.= "<option value='".$row1['cat_id']."'>".$row1['cat_name']."</option>";
		}
		$out.= "</select>";
		return $out;
	}
	function qatar_category_disp($val,$max)
	{
		$min=$max;
		$max = $max+'15';
		$sql = "SELECT cat_id , cat_name , create_date, status FROM qatar_category ";
			if($val == '0')$sql.= "ORDER BY cat_name";elseif($val == '1')$sql.= "ORDER BY cat_name DESC";
			elseif($val == '2')$sql.= "ORDER BY create_date";elseif($val == '3')$sql.= "ORDER BY create_date DESC";
			elseif($val == '4')$sql.= "ORDER BY status";elseif($val == '5')$sql.= "ORDER BY status DESC";
		$sql.= " LIMIT ".$min.",".$max;
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function qatar_category(){
		$sql1 = "SELECT cat_id, cat_name FROM qatar_category WHERE status = 'active' ORDER BY cat_name ";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='selcategory' style='width:150px;'>";
		$out.= "<option value=''>Select Category from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			$out.= "<option value='".$row1['cat_id']."'>".$row1['cat_name']."</option>";
		}
		$out.= "</select>";
		return $out;
	}
	function qatar_category_sel($val){
		$sql1 = "SELECT cat_id, cat_name FROM qatar_category WHERE status = 'active' ORDER BY cat_name ";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='selcategory' style='width:150px;'>";
		$out.= "<option value=''>Select Category from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			if($val==$row1['cat_id'])
			$out.= "<option value='".$row1['cat_id']."' selected >".$row1['cat_name']."</option>";
			else
			$out.= "<option value='".$row1['cat_id']."'>".$row1['cat_name']."</option>";
		}
		$out.= "</select>";
		return $out;
	}
	
	function replace_p_tags($str)
	{
		$rep = array('<p>','</p>');
		$rep_str = str_replace($rep,'', $str);
		return $rep_str;
	}
	//send mail function begin
	function sendMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message){
		$headers  = "MIME-Version: 1.0\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "X-Priority: 3\n";
		$headers .= "X-MSMail-Priority: Normal\n";
		$headers .= "X-Mailer: php\n";
		$headers .= "From: \"".$fromname."\" <".$fromaddress.">\n";
		mail($toaddress, $subject, $message, $headers);
	}
	function qatar_banner_links()
	{
		$sql = "SELECT banner_id , banner_title FROM qatar_banner_links ";
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		return $record;
	}
	function qatar_banner_links_one($val)
	{
		$sql = "SELECT * FROM qatar_banner_links WHERE banner_id=".$val;
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		$row = $objSql->fetchRow($record);
		return $row;
	}
	function qatar_left_top_disp($val,$max)
	{
		$min=$max;
		$max = $max+'15';
		$sql = "SELECT page_id , page_title , create_date, status FROM qatar_left_pages WHERE position='top' ";
			if($val == '0')$sql.= "ORDER BY page_title";elseif($val == '1')$sql.= "ORDER BY page_title DESC";
			elseif($val == '2')$sql.= "ORDER BY create_date";elseif($val == '3')$sql.= "ORDER BY create_date DESC";
			elseif($val == '4')$sql.= "ORDER BY status";elseif($val == '5')$sql.= "ORDER BY status DESC";
		$sql.= " LIMIT ".$min.",".$max;
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function qatar_left_links_one($val)
	{
		$sql = "SELECT * FROM qatar_left_pages WHERE page_id=".$val;
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		$row = $objSql->fetchRow($record);
		return $row;
	}
	function qatar_left_bottom_disp($val,$max)
	{
		$min=$max;
		$max = $max+'15';
		$sql = "SELECT page_id , page_title , create_date, status FROM qatar_left_pages WHERE position='bottom' ";
			if($val == '0')$sql.= "ORDER BY page_title";elseif($val == '1')$sql.= "ORDER BY page_title DESC";
			elseif($val == '2')$sql.= "ORDER BY create_date";elseif($val == '3')$sql.= "ORDER BY create_date DESC";
			elseif($val == '4')$sql.= "ORDER BY status";elseif($val == '5')$sql.= "ORDER BY status DESC";
		$sql.= " LIMIT ".$min.",".$max;
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function qatar_left_top_front()
	{
		$sql = "SELECT * FROM qatar_left_pages WHERE position='top' ";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function qatar_left_bottom_front()
	{
		$sql = "SELECT * FROM qatar_left_pages WHERE position='bottom' ";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function qatar_left_front($val)
	{
		$sql = "SELECT * FROM qatar_left_pages WHERE page_id=".$val;
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		$row = $objSql->fetchRow($record);
		return $row;
	}
}
?>
