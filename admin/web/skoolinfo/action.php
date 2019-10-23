<?php 
	session_start();
	include_once '../../../lib/db.php';
	include_once"../../../lib/admin_check.php";
	admin_login_check('0','admin');
	include_once '../../../lib/calss_qatar_skoolinfo.php';
	//admin_login_check('0','RU');
	$qatar_groups=new qatar_skoolinfo();
	//User delet from adminn side
	if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
			print_r($val);
		for($i=1;$i<$count;$i++)
		{
			
			$qatar_groups->qatar_groups_delete("info_id",$val[$i]);
			
			$_SESSION['msg'] = "<font  color='#FF0000'>Deleted Successfully</font>";
		}
echo "<script language='JavaScript'>
			location.href = 'index.php?pageNumber=".$_REQUEST['page']."&al=".$_REQUEST['al']."'
			</script>";
			exit;	}
	
	
	
		//User send message to user from admin side

	if($_GET['state']!='' && (!empty($_GET['id'])))
	{
		if($_GET['state'] == '0')
		{
		$sta = '1';
		$stau='Active';
		}
		if($_GET['state'] == '1')
		{
		$sta = '0';
		$stau='Inactive';
		}
		$tab = array("status =".$sta."");
		$where = "info_id=".$_GET['id']."";
		$val = $qatar_groups->qatar_groups_set_function($tab,$where);
		$_SESSION['msg'] = "<font color='#FF0000'> Skool Information ".$stau." Successfully</font>";
		echo "<script language='JavaScript'>
			location.href = 'index.php?pageNumber=".$_REQUEST['page']."&al=".$_REQUEST['al']."'
			</script>";
			exit;
	}
?>
