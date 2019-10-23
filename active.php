<?php 
	session_start();
	include_once 'lib/db.php';
	$objSql1 = new SqlClass();
	$objSql = new SqlClass();

	$email = $_GET['id'];
	$code = $_GET['code'];
	$sq = "SELECT user_id FROM ise_users WHERE user_email = '".$email."' AND secure_code = '".$code."' AND status = 'inactive'";
	$recor = $objSql->executeSql($sq);
	$row13 = $objSql->fetchRow($recor);
	if(!empty($row13['user_id']))
	{
		$sql = "UPDATE ise_users SET status = 'active',secure_code = '' WHERE user_id = '".$row13['user_id']."'"; 
		$objSql->executeSql($sql);
		$_SESSION['msg'] = "<div class = 'success'>Your Account has been Activated Please Login </div>";
		print "<script>";
		print " self.location='index.php';";
		print "</script>"; 
		exit;
	}else
	{
		$sql = "SELECT user_email FROM ise_users WHERE user_email = '".$email."' AND status = 'active'";
		$record = $objSql1->executeSql($sql);
		$row = $objSql1->fetchRow($record);
		if(!empty($row['user_id']))
		{
			$_SESSION['msg'] = "<div class = 'info'>Your Account Already Activated Please Login </div>";
			print "<script>";
			print " self.location='index.php';";
			print "</script>"; 
			exit;
		}else
		
		$_SESSION['msg'] = "<div class = 'wrong'>You Enter Wrong Security Code</div>";
		print "<script>";
		print " self.location='verify_email.php?id=".$_GET['id']."';";
		print "</script>"; 
		exit;
	}
		

?>