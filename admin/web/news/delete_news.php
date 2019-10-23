<?php
	session_start();
	include_once '../../../lib/functions.php';
	include "../../../lib/db.php";
	$objSql = new SqlClass();
	admin_login_check();
	//User delet from adminn side
	if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			$sql = "DELETE FROM `ml_news` WHERE `news_id` ='".$val[$i]."'";
			$objSql->executeSql($sql);
			$_SESSION['msg'] = "<font size='2' color='#FF0000'>News Deleted Successfully</font>";
		}
		echo "<script language='JavaScript'>
			location.href = 'index.php?al=".$_REQUEST['al']."&pageNumber=".$_REQUEST['page']."'
			</script>";
		exit;
	}
?>