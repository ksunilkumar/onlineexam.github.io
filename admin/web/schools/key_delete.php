<?php 
	session_start();
	include_once '../../../lib/db.php';
	include_once"../../../lib/admin_check.php";
	include_once '../../../lib/calss_qatar_keys.php';
	admin_login_check('0','admin');
	include_once '../../../lib/calss_qatar_skoolinfo.php';
	//admin_login_check('0','RU');
	$qatar_groups=new qatar_skoolinfo();
	//User delet from adminn side
	if(!empty($_GET['delet']))
	{		
		$val = explode(',', $_POST['delet']);
		$count = count($val);
			print_r($val);
		for($i=1;$i<$count;$i++)
		{
			
				qatar_keys_delete("keyId",$val[$i]);
			$_SESSION['msg'] = "<font size='3' color='#0099FF'>Deleted Successfully</font>";
		}
		echo "<script language='JavaScript'>
			location.href = 'viewkeys.php?page=".$_REQUEST['page']."'
			</script>";
			exit;	
			
			}
		
		
		
		
		
		
		//User send message to user from admin side


?>