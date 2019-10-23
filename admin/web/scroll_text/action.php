<?php 
	session_start();
	include_once '../../../lib/db.php';
	
	include_once"../../../lib/admin_check.php";
	admin_login_check('0','admin');
	include_once '../../../lib/calss_scroll_text.php';
	//admin_login_check('0','RU');
	$qatar_groups = new scroll_text();
	//User delet from adminn side
	
	
	if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			/*$sql = "DELETE FROM `ml_blogs` WHERE `blog_id` ='".$val[$i]."'";
			$objSql->executeSql($sql);*/
				$qatar_groups->qatar_scroll_text_delete("scroll_id",$val[$i]);
			$_SESSION['msg'] = "<font size='2' color='#FF0000'>Deleted Successfully</font>";
		}
echo "<script language='JavaScript'>
			location.href = 'index.php?pageNumber=".$_REQUEST['page']."&al=".$_REQUEST['al']."'
			</script>";
			exit;	}	
			
			//User send message to user from admin side

	if(($_GET['state']!='') && (!empty($_GET['id'])))
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
		$where = "scroll_id=".$_GET['id']."";
		print_r($tab);
		$val = $qatar_groups->qatar_scroll_text_set_function($tab,$where);
		$_SESSION['msg'] = "<font size='2' color='#FF0000'> Scroll Text ".$stau." Successfully</font>";
		
		echo "<script language='JavaScript'>
			location.href = 'index.php?pageNumber=".$_REQUEST['page']."&al=".$_REQUEST['al']."'
			</script>";
			exit;
		
	}
?>