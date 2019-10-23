<?php 
	session_start();
	include_once '../../../lib/db.php';
	//admin_login_check('0','RU');
	$queries = new Queries();
	//User delet from adminn side
	
	
	if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		//print_r($val);
		for($i=1;$i<$count;$i++)
		{
			
			$queries->makedeletequery('category',"cat_id",$val[$i]);
			
			
		}
			$_SESSION['msg'] = "<font  color='#FF0000'>Category Deleted Successfully</font>";
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
		$where = "cat_id=".$_GET['id']."";
		$val = $queries->makeupdatequery('category',$tab,$where);
		
		$_SESSION['msg'] = "<font size='2' color='#FF0000'> ".$sta." Successfully</font>";
		echo "<script language='JavaScript'>
			location.href = 'index.php?pageNumber=".$_REQUEST['page']."&al=".$_REQUEST['al']."'
			</script>";
			exit;
	}
?>