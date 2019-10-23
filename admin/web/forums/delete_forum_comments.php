<?php 
	session_start();
	$page=$_REQUEST['page'];
	if(isset($_REQUEST['al']))
		$al=$_REQUEST['al'];
	else
		$al='.';
	$order=$_REQUEST['order'];
?>
   
<?php
	include_once '../../../lib/forums_class.php';
	include_once '../../../lib/settings_class.php';
	include_once '../../../lib/db.php';
	$objSql = new SqlClass();
	//admin_login_check();
	//User delet from adminn side
	
	if(!empty($_GET['delete_one']))
	{
		
			$sql = "DELETE FROM `ttn_forum_comms` WHERE `f_c_id` ='".$_GET['delete_one']."'";
			//echo $sql; exit;
			$objSql->executeSql($sql);
			$_SESSION['msg'] = "<font class='alert_success'>Comment Deleted Successfully</font>";
		
		echo "<script> self.location='".$_SERVER['HTTP_REFERER']."';</script>";
		exit;
	}
	
	
	
	
	if(!empty($_POST['delet']))
	{ //echo "hello";
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			$sql = "DELETE FROM `ttn_forum_comms` WHERE `f_c_id` ='".$val[$i]."'";
			//echo $sql;exit;
			$objSql->executeSql($sql);
			$_SESSION['msg'] = "<font class='alert_success'>Comments(s) Deleted Successfully</font>";
		}
		echo "<script> self.location='".$_SERVER['HTTP_REFERER']."';</script>";
		exit;
	}
	else{
	
		if($_GET['state'] == 'active')
		$sta = 'inactive';
		if($_GET['state'] == 'inactive')
		$sta = 'active';
		$sql = "UPDATE ttn_forum_comms SET status = '".$sta."' WHERE f_c_id = '".$_GET['fid']."'"; 
		 $objSql->executeSql($sql);
		$_SESSION['msg'] = "<font class='alert_success'>Comment Status Update Successfully</font>";
		echo "<script> self.location='".$_SERVER['HTTP_REFERER']."';</script>";
		exit;
	}
?>