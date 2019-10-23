<?php 
	session_start();
	include_once '../../../lib/db.php';
	include_once"../../../lib/admin_check.php";
	admin_login_check('0','Debates');
	include_once '../../../lib/calss_qatar_live_teach.php';
	$qatar_live_teach = new qatar_live_teach();
	
	
	if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		print_r($val);
		for($i=1;$i<$count;$i++)
		{
			/*$sql = "DELETE FROM `ml_blogs` WHERE `blog_id` ='".$val[$i]."'";
			$objSql->executeSql($sql);*/
			$qatar_live_teach->qatar_live_teach_delete_one("online_cid",$val[$i]);
			$_SESSION['msg'] = "<font color='#FF0000'>Deleted Successfully</font>";
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
		$sta1='inactive';
		if($_GET['state'] == 'inactive'){
		$sta1='active';
		}
		$tab = array("status =".$sta1."");
		$where = "online_cid=".$_GET['id']."";
		 $val = $qatar_live_teach->qatar_live_teach_class_update($tab,$where);

		$_SESSION['msg'] = "<font  color='#FF0000'>Teacher ".$sta1." Successfully</font>";
	
		echo "<script language='JavaScript'>
			location.href = 'index.php?pageNumber=".$_REQUEST['page']."&al=".$_REQUEST['al']."'
			</script>";
			exit;
	
	}
?>