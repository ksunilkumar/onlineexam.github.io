<?php
class ise_settings{
 	
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
	function generate_group_code($characters) {
		/* list all possible characters, similar looking characters and vowels have been removed */
		$possible = '23456789bcdfghjkmnpqrstvwxyz';
		$code = '';
		$i = 0;
		while ($i < $characters) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
		return $code;
	}
	
	function ise_country(){
		$sql1 = "SELECT country_id, country_name FROM country WHERE status = 'active' ORDER BY country_name ";
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
	function ise_country_reg($va){
		$sql1 = "SELECT country_id, country_name FROM country WHERE status = 'active' ORDER BY country_name ";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='selcountry' onChange='state(this.value)' style='width:150px;'>";
		$out.= "<option value=''>Select Country from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			if($row1['country_id'] == $va)
			$out.= "<option value='".$row1['country_id']."' selected>".$row1['country_name']."</option>";
			else
			$out.= "<option value='".$row1['country_id']."' >".$row1['country_name']."</option>";
		
		}
		$out.= "</select>";
		return $out;
	}
	function ise_country_reg_edu($va){
		$sql1 = "SELECT country_id, country_name FROM country WHERE status = 'active' ORDER BY country_name ";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='selcountryedu' onChange='state(this.value)' style='width:150px;'>";
		$out.= "<option value=''>Select Country from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			if($row1['country_id'] == $va)
			$out.= "<option value='".$row1['country_id']."' selected>".$row1['country_name']."</option>";
			else
			$out.= "<option value='".$row1['country_id']."' >".$row1['country_name']."</option>";
		
		}
		$out.= "</select>";
		return $out;
	}
	function ise_country_res($va){
		$sql1 = "SELECT country_id, country_name FROM country WHERE status = 'active' ORDER BY country_name ";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='selcountryres' onChange='state(this.value)' style='width:150px;'>";
		$out.= "<option value=''>Select Country from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			if($row1['country_id'] == $va)
			$out.= "<option value='".$row1['country_id']."' selected>".$row1['country_name']."</option>";
			else
			$out.= "<option value='".$row1['country_id']."' >".$row1['country_name']."</option>";
		
		}
		$out.= "</select>";
		return $out;
	}
	function ise_grades(){
		$sql1 = "SELECT * from grades order by gid";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='selgrade' style='width:150px;' id='selgrade'>";
		$out.= "<option value=''>Select Grade from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			$out.= "<option value='".$row1['gid']."' >".$row1['grade']."</option>";
		
		}
		$out.= "</select>";
		return $out;
	}
	
	function ise_grades_admin(){
		$sql1 = "SELECT * from grades order by gid";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='selgrade' style='width:150px;' id='selgrade'>";
		$out.= "<option value=''>Select Grade</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			$out.= "<option value='".$row1['gid']."' >".$row1['grade']."</option>";
		
		}
		$out.= "<option value='all'>All</option></select>";
		return $out;
	}
	
	function ise_grades_sel($uid){
		$sql1 = "SELECT * from ise_user_grade where user_id=".$uid;
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$row1 = $objSql1->fetchRow($record1);
		$sql = "SELECT * from grades where gid=".$row1['grade'];
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		$row = $objSql->fetchRow($record);
		return $row['grade'];
				
	}
	
	
	function ise_country_sel($val){
		$sql1 = "SELECT country_id, country_name FROM country WHERE status = 'active' ORDER BY country_name ";
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
	function ise_state(){
		$sql1 = "SELECT stat_id, stat_name FROM state WHERE status = 'active' ORDER BY stat_name ";
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
	function ise_state_sel($val){
		$sql1 = "SELECT stat_id, stat_name FROM state WHERE status = 'active' ORDER BY stat_name ";
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
	function ise_state_loc(){
		$sql1 = "SELECT stat_id, stat_name FROM state WHERE status = 'active' ORDER BY stat_name ";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='sellocstate' style='width:150px;'>";
		$out.= "<option value=''>Select State/Province from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			$out.= "<option value='".$row1['stat_id']."'>".$row1['stat_name']."</option>";
		}
		$out.= "</select>";
		return $out;
	}
	function ise_state_sel_loc($val){
		$sql1 = "SELECT stat_id, stat_name FROM state WHERE status = 'active' ORDER BY stat_name ";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='sellocstate' style='width:150px;'>";
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
	
	function ise_users(){
		$sql1 = "SELECT user_id, user_name FROM users ORDER BY user_name";
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
	function ise_users_sel($id){
		$sql1 = "SELECT user_id, user_name FROM users ORDER BY user_name";
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
	function ise_cat(){
		$sql1 = "SELECT cat_id, cat_name FROM category WHERE status = 'active' ORDER BY cat_name";
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
	function ise_cat_sel($id){
		
		$sql1 = "SELECT cat_id, cat_name FROM category WHERE status = 'active' ORDER BY cat_name";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='selcat' style='width:150px;'>";
		$out.= "<option value=''>Select Category from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			if($row1['cat_id'] == $id)
			$out.= "<option value='".$row1['cat_id']."' selected>".$row1['cat_name']."</option>";
			else
			$out.= "<option value='".$row1['cat_id']."'>".$row1['cat_name']."</option>";
		}
		$out.= "</select>";
		return $out;
	}
	function ise_category_disp($val,$max)
	{
		$min=$max;
		$max = $max+'15';
		$sql = "SELECT cat_id , cat_name , create_date, status FROM category ";
			if($val == '0')$sql.= "ORDER BY cat_name";elseif($val == '1')$sql.= "ORDER BY cat_name DESC";
			elseif($val == '2')$sql.= "ORDER BY create_date";elseif($val == '3')$sql.= "ORDER BY create_date DESC";
			elseif($val == '4')$sql.= "ORDER BY status";elseif($val == '5')$sql.= "ORDER BY status DESC";
		$sql.= " LIMIT ".$min.",".$max;
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function ise_category(){
		$sql1 = "SELECT cat_id, cat_name FROM category WHERE status = 'active' ORDER BY cat_name ";
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
	function ise_category_sel($val){
		$sql1 = "SELECT cat_id, cat_name FROM category WHERE status = 'active' ORDER BY cat_name ";
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
	function ise_cat_name_disp($id)
	{
		$sql1 = "SELECT cat_name FROM category WHERE cat_id=".$id;
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$row1 = $objSql1->fetchRow($record1);
		return $row1['cat_name'];
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
	function sendeMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message){
		$headers  = "MIME-Version: 1.0\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "X-Priority: 3\n";
		$headers .= "X-MSMail-Priority: Normal\n";
		$headers .= "X-Mailer: php\n";
		$headers .= "From: \"".$fromname."\" <".$fromaddress.">\n";
		if(mail($toaddress, $subject, $message, $headers))
		return 1;
		else
		return 0;
		
	}
	function ise_banner_links()
	{
		$sql = "SELECT banner_id , banner_title FROM banner_links ";
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		return $record;
	}
	function ise_banner_links_one($val)
	{
		$sql = "SELECT * FROM banner_links WHERE banner_id=".$val;
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		$row = $objSql->fetchRow($record);
		return $row;
	}
	function ise_left_top_disp($val,$max)
	{
		$min=$max;
		$max = $max+'15';
		$sql = "SELECT page_id , page_title , create_date, status FROM ise_left_pages WHERE position='top' ";
			if($val == '0')$sql.= "ORDER BY page_title";elseif($val == '1')$sql.= "ORDER BY page_title DESC";
			elseif($val == '2')$sql.= "ORDER BY create_date";elseif($val == '3')$sql.= "ORDER BY create_date DESC";
			elseif($val == '4')$sql.= "ORDER BY status";elseif($val == '5')$sql.= "ORDER BY status DESC";
		$sql.= " LIMIT ".$min.",".$max;
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function ise_left_links_one($val)
	{
		$sql = "SELECT * FROM ise_left_pages WHERE page_id=".$val;
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		$row = $objSql->fetchRow($record);
		return $row;
	}
	function ise_left_bottom_disp($val,$max)
	{
		$min=$max;
		$max = $max+'15';
		$sql = "SELECT page_id , page_title , create_date, status FROM ise_left_pages WHERE position='bottom' ";
			if($val == '0')$sql.= "ORDER BY page_title";elseif($val == '1')$sql.= "ORDER BY page_title DESC";
			elseif($val == '2')$sql.= "ORDER BY create_date";elseif($val == '3')$sql.= "ORDER BY create_date DESC";
			elseif($val == '4')$sql.= "ORDER BY status";elseif($val == '5')$sql.= "ORDER BY status DESC";
		$sql.= " LIMIT ".$min.",".$max;
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function ise_left_top_front()
	{
		$sql = "SELECT * FROM ise_left_pages WHERE position='top' ";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function ise_left_bottom_front()
	{
		$sql = "SELECT * FROM ise_left_pages WHERE position='bottom' ";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function ise_left_front($val)
	{
		$sql = "SELECT * FROM ise_left_pages WHERE page_id=".$val;
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		$row = $objSql->fetchRow($record);
		return $row;
	}
	function page_name($val)
	{
		if($val=='index')return 'Home';
		elseif($val=='groups')return 'Groups';
		elseif($val=='groups_inner')return 'Groups';
		elseif($val=='groups_viewall')return 'Groups';
		elseif($val=='forums')return 'Forums';
		elseif($val=='forums_innernew')return 'Forums';
		elseif($val=='forums_inner1new')return 'Forums';
		elseif($val=='blogs')return 'Blogs';
		elseif($val=='debates')return 'Debates';
		elseif($val=='debates_inner_page')return 'Debates';
		elseif($val=='live_debates')return 'Live Debates';
		elseif($val=='live_debatesinner')return 'Live Debates';
		elseif($val=='q_a')return 'Question & Answer';
		elseif($val=='teachyourself')return 'Test Yourself';
		elseif($val=='grade_inner')return 'Test Yourself';
		elseif($val=='grade_inner_maths')return 'Test Yourself';
		elseif($val=='grade_inner_mathsets')return 'Test Yourself';
		elseif($val=='cart2')return 'Test Yourself';
		elseif($val=='mycart')return 'Test Yourself';
		elseif($val=='quizrtone')return 'Test Yourself';
		elseif($val=='result')return 'Test Yourself';
		elseif($val=='correctansaieee')return 'Test Yourself';
		elseif($val=='career')return 'Careers';
		elseif($val=='news')return 'News';
		elseif($val=='news_inner')return 'News';
		elseif($val=='polls')return 'Polls';
		elseif($val=='feedback')return 'Feedback';
		elseif($val=='about')return 'About';
	}
	function ise_live_debate_add()
	{
		$sql = "SELECT * FROM ise_manage_adds WHERE status='active'";
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		$row = $objSql->fetchRow($record);
		return $row;
	}
	
	
}
?>
