<?php 
class settings {

	function getExtension($str) 
	{
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}
	 
	function get_currentfile()
	{
		$file = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
		$qry_str = $_SERVER["QUERY_STRING"];
		$filename = $file.'?'.$qry_str;
		unset($_SESSION['new_file']); $_SESSION['new_file'] = $filename;
	}
	 
	function chk_usr_authentication()
	{
		session_start();
		if(!(isset($_SESSION['sno'])) || ($_SESSION['sno']=='') )
		{ 
			$_SESSION['authmsg'] = 'Please login to proceed...'; 
			?> <script> location.href = 'index.php'; </script> <?php	
			exit(); 
		}
	}
	 
	 
	 function upload_img($var,$folder_path)
	 {
	 	$image=$_FILES[$var]['name']; $error = '0';$upload='';$extension='';
				define ("MAX_SIZE","50"); 
				
				$upload = "";
				$filename = stripslashes($_FILES[$var]['name']);
				$extension = $this->getExtension($filename);
				$extension = strtolower($extension);
				// Image Size
				$size=filesize($_FILES[$var]['tmp_name']);
				if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
				{
					$_SESSION['valid_err'] = "<font size='2' color='#FF0000'>Upload Unknown File extension! Please Upload Onely png,gif,jpg,jpeg File</font>";
					$error='1';
				}else
				{
					$upload=time().".".$extension;
					$newname=$folder_path.$upload;
					$copied = copy($_FILES[$var]['tmp_name'], $newname);
				}
				return $upload;
	 }
	 
	 function cat(){
		$sql1 = "SELECT cat_id, cat_name FROM ".CATEGORY." WHERE status = 'active' ORDER BY cat_name";
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
	 
	 function cat_sel($id){
		
		$sql1 = "SELECT cat_id, cat_name FROM ".CATEGORY." WHERE status = 'active' ORDER BY cat_name";
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
	
	function generate_code($characters) {
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
	
	function country_sel(){
		$sql1 = "SELECT country_id, country_name FROM country WHERE status = 'active' ORDER BY country_name";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='country' style='width:150px;'>";
		$out.= "<option value=''>Select Category from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			if($row1['country_id'] == 24)
			$out.= "<option value='".$row1['country_id']."' selected>".$row1['country_name']."</option>";
			else
			$out.= "<option value='".$row1['country_id']."'>".$row1['country_name']."</option>";
		}
		$out.= "</select>";
		return $out;
	}
	
	function get_country_sel($id){
		$sql1 = "SELECT country_id, country_name FROM country WHERE status = 'active' ORDER BY country_name";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='country' style='width:150px;'>";
		$out.= "<option value=''>Select Category from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			if($row1['country_id'] == $id)
			$out.= "<option value='".$row1['country_id']."' selected>".$row1['country_name']."</option>";
			else
			$out.= "<option value='".$row1['country_id']."'>".$row1['country_name']."</option>";
		}
		$out.= "</select>";
		return $out;
	}
	
	
	function state_sel(){
		$sql1 = "SELECT stat_id, stat_name FROM  state WHERE status = 'active' ORDER BY stat_name";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='state' style='width:150px;'>";
		$out.= "<option value=''>Select Category from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			if($row1['stat_id'] == 71)
			$out.= "<option value='".$row1['stat_id']."' selected>".$row1['stat_name']."</option>";
			else
			$out.= "<option value='".$row1['stat_id']."'>".$row1['stat_name']."</option>";
		}
		$out.= "</select>";
		return $out;
	}
	
	function get_state_sel($id){
		$sql1 = "SELECT stat_id, stat_name FROM  state WHERE status = 'active' ORDER BY stat_name";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='state' style='width:150px;'>";
		$out.= "<option value=''>Select Category from List</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			if($row1['stat_id'] == $id)
			$out.= "<option value='".$row1['stat_id']."' selected>".$row1['stat_name']."</option>";
			else
			$out.= "<option value='".$row1['stat_id']."'>".$row1['stat_name']."</option>";
		}
		$out.= "</select>";
		return $out;
	}
	
		function sendMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message){
		$headers  = "MIME-Version: 1.0\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "X-Priority: 3\n";
		$headers .= "X-MSMail-Priority: Normal\n";
		$headers .= "X-Mailer: php\n";
		$headers .= "From: \"".$fromname."\" <".$fromaddress.">\n";
		mail($toaddress, $subject, $message, $headers);
		
	}
	function curriculum_admin(){
		$sql1 = "SELECT * from curriculum order by cur_id";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='selcur' style='width:150px;' id='selcur' onchange=\"javascript:changegrade(this.value)\">";
		$out.= "<option value=''>Select Curriculum</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			$out.= "<option value='".$row1['cur_id']."' >".$row1['cur_name']."</option>";
		
		}
		//$out.= "<option value='all'>All</option></select>";
		$out.="</select>";
		return $out;
	}
	function grades_admin($curid){
		$sql1 = "SELECT * from grades order by grade_id";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='selgrade' style='width:150px;' id='selgrade'>";
		$out.= "<option value=''>Select Grade</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{
			$out.= "<option value='".$row1['grade_id']."' >".$row1['grade_name']."</option>";
		
		}
		$out.= "<option value='all'>All</option></select>";
		return $out;
	}
		function grades_course($curid){
		$sql1 = "SELECT distinct grade_id from course where cur_id =$curid";
		$objSql1 = new SqlClass();
		$record1 = $objSql1->executeSql($sql1);
		$out = "<select name='selgrade' style='width:150px;' id='selgrade'>";
		$out.= "<option value=''>Select Grade</option>";
		while($row1 = $objSql1->fetchRow($record1))
		{	
			$se="select * from grades where grade_id=".$row1['grade_id'];
			$objSql2 = new SqlClass();
			$record2 = $objSql2->executeSql($se);
			$gradenames=$objSql2->fetchRow($record2);
			$out.= "<option value='".$row1['grade_id']."' >".$gradenames['grade_name']."</option>";
		
		}
		$out.= "<option value='all'>All</option></select>";
		return $out;
	}
	
	
}

?>