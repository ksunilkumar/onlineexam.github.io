<?php 
	session_start();
	include_once '../../../lib/db.php';
	include_once"../../../lib/admin_check.php";
	admin_login_check('0','admin');
	include_once '../../../lib/class_ise_contact.php';
	//admin_login_check('0','RU');
	$qatar_groups = new Contact();
	//User delet from adminn side
		
	if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		print_r($val);
		for($i=1;$i<$count;$i++)
		{
			/*$sql = "DELETE FROM `ml_blogs` WHERE `blog_id` ='".$val[$i]."'";
			$objSql->executeSql($sql);*/
			$qatar_groups->contact_groups_delete("id",$val[$i]);
			
			$_SESSION['msg'] = "<div class='success'>Deleted Successfully</div>";
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
		$where = "id=".$_GET['id']."";
		$val = $qatar_groups->contact_set_function($tab,$where);
		
		$_SESSION['msg'] = "<div class='success'>Record status set to ".$sta." Successfully</font>";
		
		echo "<script language='JavaScript'>
			location.href = 'index.php?pageNumber=".$_REQUEST['page']."&al=".$_REQUEST['al']."'
			</script>";
			exit;
	}
?>