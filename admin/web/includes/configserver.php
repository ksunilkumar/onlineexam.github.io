<?php
	SESSION_START();
	if(!isset($_SESSION['admin_sessid']) && $egh!=20)
	{
		header("location:index.php?msg=Please Login");
	}
	else
	{
		$uploadpath="http://www.skoolstation.com/uploads/";
		$host="localhost";
       		$root="http://www.skoolstation.com/";
		$adminroot="http://www.skoolstation.com/admin";
		$sdf=file($adminroot."/code/manageotheroptions/num.txt");
		$perpage=$sdf[0];
		$user="skoolsta_root";
		$pwd="iiit123";
		mysql_connect($host,$user,$pwd) or die("sorry db not connected");
		$db="skoolsta_skool";
		mysql_select_db($db) or die("could not select db");
	}
?>