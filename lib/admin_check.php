<?php 
	
	function admin_login_check($flag = 0,$val){
	
		if($_SESSION['adminuser'] == "")
		{
			$_SESSION['msg'] = "<font size='2' color='#FF0000'>Please Login To access the Admin Panel</font>";
				header("Location:".ADMIN_URL."index.php");
				exit;
			
		}
				
		if($_SESSION[$val] == 'NO')
		{
			
			if($val == 'Testengin'){$message = "Testengine Management";}
			if($val == 'Debates'){$message = "Debates Management";}
			if($val == 'Others'){$message = "Others Management";}
			if($val == 'admin'){$message = "Admin Management";}
			if($_SESSION['Testengin']=='YES'){$page1=ADMIN_URL.'/testengin.php';}
			if($_SESSION['Debates']=='YES'){$page1=ADMIN_URL.'/debates.php';}
			if($_SESSION['Others']=='YES'){$page1=ADMIN_URL.'/others.php';}
		 
				
			$_SESSION['msg'] = "<font size='3' color='#FF0000'>You Have no permission for ".$message." Pages </font>";
			print "<script>";
			print " self.location='".$page1."';";
			print "</script>"; 
			exit;
		}
	}
	function super_admin_login_check($flag = 0,$val){
	
		
		if($_SESSION['adminuser'] == "")
		{
			$_SESSION['msg'] = "<font size='2' color='#FF0000'>You Don't have the Super Admin Permissions</font>";
				header("Location:".ADMIN_URL."index.php");
				exit;
			
		}
		
	}
	function display_admins($var,$val,$max){
		$min=$max;
		$max = $max+'15';
		$sql = "SELECT admin_id, admin_name, email, status FROM  qatar_admin WHERE admin_name!='admin'";
		if($var == 'or'){
			if($val == '0')$sql.= "ORDER BY admin_name";elseif($val == '1')$sql.= "ORDER BY admin_name DESC";
			elseif($val == '2')$sql.= "ORDER BY email";elseif($val == '3')$sql.= "ORDER BY email DESC";
			elseif($val == '4')$sql.= "ORDER BY status";elseif($val == '5')$sql.= "ORDER BY status DESC";
		}
		else if($var == 'al')$sql.="WHERE admin_name LIKE '".$val."%'";
		$sql.= " LIMIT ".$min.",".$max;
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		return $record;
	}
?>