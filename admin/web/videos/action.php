<?php 
	session_start();
	include_once '../../../lib/db.php';
	include_once"../../../lib/admin_check.php";
	admin_login_check('0','Debates');
	include_once '../../../lib/calss_qatar_videos.php';
	//admin_login_check('0','RU');
	$qatar_videos = new qatar_videos();
	//User delet from adminn side
	
	
	if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		//print_r($val);
		for($i=1;$i<$count;$i++)
		{
			
			$qatar_videos->qatar_videos_delete("video_id",$val[$i]);
			
			$_SESSION['msg'] = "<font  color='#FF0000'>Deleted Successfully</font>";
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
		$where = "video_id=".$_GET['id']."";
		
		$val = $qatar_videos->qatar_videos_set_function($tab,$where);
		
		$_SESSION['msg'] = "<font  color='#FF0000'> ".$sta." Successfully</font>";
		echo "<script language='JavaScript'>
			location.href = 'index.php?pageNumber=".$_REQUEST['page']."&al=".$_REQUEST['al']."'
			</script>";
			exit;
	}
?>