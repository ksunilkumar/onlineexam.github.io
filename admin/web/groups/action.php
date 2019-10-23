<?php 
	session_start();
	include_once '../../../lib/db.php';
	//include_once"../../../lib/admin_check.php";
	//admin_login_check('0','admin');
	include_once '../../../lib/class_ise_groups.php';
	//admin_login_check('0','RU');
	$ise_groups = new ise_groups();
	
	if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		//print_r($val);
		for($i=1;$i<$count;$i++)
		{
			/*$sql = "DELETE FROM `ml_blogs` WHERE `blog_id` ='".$val[$i]."'";
			$objSql->executeSql($sql);*/
			$ise_groups->ise_groups_delete("group_id",$val[$i]);
			$_SESSION['msg'] = "<div class='success'>Deleted Successfully</div>";
		}
			echo "<script language='JavaScript'>
			location.href = 'index.php?pageNumber=".$_REQUEST['page']."&al=".$_REQUEST['al']."'
			</script>";
			exit;	}
	
	
	
		//User send message to user from admin side
	//echo $_GET['state'];
	if((isset($_GET['state'])) && (!empty($_GET['id'])))
	{
		
		if($_GET['state'] == 'active')
		$sta='inactive';
		if($_GET['state'] == 'inactive'){
		$sta='active';
		}
		$tab = array("status =".$sta."");
		$where = "group_id=".$_GET['id']."";
			$val = $ise_groups->ise_groups_set_function($tab,$where);

		$_SESSION['msg'] = "<div class='success'>Group ".$sta." Successfully</div>";
	
		echo "<script language='JavaScript'>
			location.href = 'index.php?pageNumber=".$_REQUEST['page']."&al=".$_REQUEST['al']."'
			</script>";
			exit;
	
	}
?>