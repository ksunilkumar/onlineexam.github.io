<?php 
	session_start();
	include_once '../../../lib/db.php';
	/*include_once"../../../lib/admin_check.php";
	admin_login_check('0','admin');*/
	include_once '../../../lib/class_ise_group_members.php';
	//admin_login_check('0','RU');
	$ise_group_members = new ise_group_members();
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
		$ise_group_members->ise_group_post_delete("post_id",$val[$i]);
		
			$_SESSION['msg'] = "<div class='success'>Group Comment Deleted Successfully</div>";
		}
echo "<script language='JavaScript'>
			location.href = 'view_posts.php?pageNumber=".$_REQUEST['page']."&id=".$_REQUEST['group_id']."'
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
		$where = "post_id=".$_GET['id']."";
		$val = $ise_group_members->ise_group_post_update($tab,$where);
		$_SESSION['msg'] = "<div class='success'>Comment Status set to ".$sta." Successfully</div>";
	
		echo "<script language='JavaScript'>
			location.href = 'view_posts.php?pageNumber=".$_REQUEST['page']."&id=".$_REQUEST['group_id']."'
			</script>";
			exit;
	
	}
?>
