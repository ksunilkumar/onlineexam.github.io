<?php 
	session_start();
	include_once '../../../lib/db.php';
	include_once"../../../lib/admin_check.php";
	include_once '../../../lib/calss_qatar_newssletter.php';

	admin_login_check('0','admin');
	include_once '../../../lib/class_qatar_feedback.php';
	//admin_login_check('0','RU');
	$qatar_groups = new qatar_newsletter();
	//User delet from adminn side
		
	if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		
		for($i=1;$i<$count;$i++)
		{
			/*$sql = "DELETE FROM `ml_blogs` WHERE `blog_id` ='".$val[$i]."'";
			$objSql->executeSql($sql);*/
			$qatar_groups->qatar_groups_delete("fb_id",$val[$i]);
			
			$_SESSION['msg'] = "<font size='3' color='#0099FF'>Deleted Successfully</font>";
		}
echo "<script language='JavaScript'>
			location.href = 'index.php?pageNumber=".$_REQUEST['page']."&al=".$_REQUEST['al']."'
			</script>";
			exit;	}
	
	
	//User send message to user from admin side

	if((!empty($_GET['state'])) && (!empty($_GET['id'])))
	{
		if($_GET['state'] == 'active')
		$sta = 'inactive';
		if($_GET['state'] == 'inactive')
		$sta = 'active';
		$tab = array("status =".$sta."");
		$where = "ns_id=".$_GET['id']."";
		$val = $qatar_groups->qatar_newsletterusers_update($tab,$where);
		
		$_SESSION['msg'] = "<font size='2' color='#FF0000'> Newsletter user ".$sta." Successfully</font>";
		
		echo "<script language='JavaScript'>
			location.href = 'index.php?pageNumber=".$_REQUEST['page']."&al=".$_REQUEST['al']."'
			</script>";
			exit;
	}
?>