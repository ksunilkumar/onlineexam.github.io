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
			$sql = "DELETE FROM `ml_blogs` WHERE `blog_id` ='".$val[$i]."'";
			$objSql->executeSql($sql);
			$_SESSION['msg'] = "<font size='3' color='#0099FF'>Blog(s) Deleted Successfully</font>";
		}
}
?>


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
			$sql = "DELETE FROM `ml_blogs` WHERE `blog_id` ='".$val[$i]."'";
			$objSql->executeSql($sql);
			$_SESSION['msg'] = "<font size='3' color='#0099FF'>Blog(s) Deleted Successfully</font>";
		}
echo "<script language='JavaScript'>
			location.href = 'index.php?al=".$_REQUEST['al']."&pageNumber=".$_REQUEST['page']."'
			</script>";
			exit;	}
?>