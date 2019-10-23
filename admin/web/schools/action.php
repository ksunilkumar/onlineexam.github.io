<?php 
	session_start();
	include_once '../../../lib/db.php';
	include_once"../../../lib/admin_check.php";
	include_once '../../../lib/calss_qatar_keys.php';
	admin_login_check('0','admin');
	include_once '../../../lib/calss_qatar_school.php';
	include_once '../../../lib/schools_class.php';
	
	
	//User send message to user from admin side

	if($_GET['state']!='' && (!empty($_GET['id'])))
	{
		if($_GET['state'] == 'inactive')
		{
		$sta = '1';
		$stau='active';
		}
		if($_GET['state'] == 'active')
		{
		$sta = '0';
		$stau='inactive';
		}
		$tab = array("status =".$stau."");
		$where = "school_id =".$_GET['id']."";
		
		$school=new School();
		$val = $school->schools_set_function($tab,$where);
		$_SESSION['msg'] = "<font size='2' color='#FF0000'> School ".$stau." Successfully</font>";
		echo "<script language='JavaScript'>
			location.href = 'index.php?pageNumber=".$_REQUEST['page']."&al=".$_REQUEST['al']."'
			</script>";
			exit;
	}
	if(!empty($_POST['delet']))
	{		
		$val = explode(',', $_POST['delet']);
		$count = count($val);
			print_r($val);
		for($i=1;$i<$count;$i++)
		{
				$school=new School();
				$school->schools_delete("school_id",$val[$i]);
				
			$_SESSION['msg'] = "<font size='3' color='#0099FF'>Deleted Successfully</font>";
		}
		echo "<script language='JavaScript'>
			location.href = 'index.php?pageNumber=".$_REQUEST['page']."&$al=".$_REQUEST['al']."'
			</script>";
			exit;	
			
			}
?>

