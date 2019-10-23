<?php
	SESSION_START();
	if(!isset($_SESSION['admin_sessid']) && $egh!=20)
	{
		header("location:index.php?msg=Please Login");
	}
	else
	{
		$uploadpath="http://www.skoolinfo.com/projects/qlg/uploads/";
		$host="localhost";
       		$root="http://www.skoolinfo.com/projects/qlg/";
		$adminroot="http://www.skoolinfo.com/projects/qlg/admin";
		$sdf=file($adminroot."/code/manageotheroptions/num.txt");
		$perpage=$sdf[0];
		$host="localhost";
		$user="root";
	$pwd="";
	mysql_connect($host,$user,$pwd) or die("sorry db not connected");
	$db="skoolstation";
	mysql_select_db($db) or die("could not select db");
	}
?>