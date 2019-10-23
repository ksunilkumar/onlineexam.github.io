<?php 
	session_start();

	include "../../lib/db.php";
	$objSql = new SqlClass();
	
	$username=$_REQUEST['username'];
	$password=md5($_REQUEST['password']);
		//$egh=20;
		
		  $query = "SELECT * FROM ise_admin WHERE username  = '".$username."' AND password  = '".$password."' and status='active' ";
		
	
	$objSql = new SqlClass();
	$objSql->setAdvanceErr(true);
	if($record = $objSql->executeSql($query))
	{
		if($objSql->getNumRecord())
		{
			while($row = $objSql->fetchRow($record))
			{
				$_SESSION['adminuser'] = $username;
				$_SESSION['admin_login'] = "admin";
				$_SESSION['admin_id'] = $row['emp_id'];
				$_SESSION['admin_sessid']=$row['id'];
				$_SESSION['school_id']=$row['school_id'];
				
				print "<script>";
				print " self.location='home.php';";
				print "</script>"; 
				exit;
			}
		}
		else
		{
			$_SESSION['msg'] = "Login Credentials didn't match";
			header("Location:index.php");
			exit;
		}	
	}
?>