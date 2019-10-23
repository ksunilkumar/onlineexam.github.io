<?php 
	session_start();
	include_once '../../../lib/db.php';
	include_once"../../../lib/admin_check.php";
	admin_login_check('0','admin');
	include_once '../../../lib/calss_qatar_group_members.php';
	//admin_login_check('0','RU');
	$qatar_group_members = new qatar_group_members();
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
		$qatar_group_members->qatar_group_photo_delete("pic_id",$val[$i]);
		
			$_SESSION['msg'] = "<font size='3' color='#0099FF'>Deleted Successfully</font>";
		}
echo "<script language='JavaScript'>
			location.href = 'view_pics.php?pageNumber=".$_REQUEST['page']."&id=".$_REQUEST['group_id']."'
			</script>";
			exit;	
			}
	
	
	
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
		$where = "pic_id=".$_GET['id']."";
		$val = $qatar_group_members->qatar_group_photos_update($tab,$where);

		$_SESSION['msg'] = "<font size='2' color='#FF0000'>picture ".$sta." Successfully</font>";
	
		echo "<script language='JavaScript'>
			location.href = 'view_pics.php?pageNumber=".$_REQUEST['page']."&id=".$_REQUEST['group_id']."'
			</script>";
			exit;
	
	}
?>
