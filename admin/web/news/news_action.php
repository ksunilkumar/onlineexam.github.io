<?php 
	session_start();
	
	$page=$_REQUEST['page'];
	if(isset($_REQUEST['al']))
		$al=$_REQUEST['al'];
	else
		$al='.';
	$order=$_REQUEST['order'];

	include_once '../../../lib/db.php';
	include_once"../../../lib/admin_check.php";
	//admin_login_check('0','Others');
	include_once '../../../lib/class_ise_news.php';
	//admin_login_check('0','RU');
	$ise_news = new ise_news();
	
	if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			$ise_news->ise_news_delete("news_id",$val[$i]);
			$_SESSION['msg'] = "<font size='2' color='#FF0000'>News(s) Deleted  Successfully</font>";
			
		}
		echo "<script language='JavaScript'>
			location.href = 'index.php?al=".$_REQUEST['al']."&pageNumber=".$_REQUEST['page']."'
			</script>";
			exit;
	}
	

	if((!empty($_GET['state'])) && (!empty($_GET['id'])))
	{
		if($_GET['state'] == 'active')
		$sta = 'inactive';
		if($_GET['state'] == 'inactive')
		$sta = 'active';
		$tab = array("status =".$sta."");
		$where = "news_id=".$_GET['id']."";
		$val = $ise_news->ise_news_set_function($tab,$where);
		 
		$_SESSION['msg'] = "<font size='2' color='#FF0000'> News ".$sta." Successfully</font>";

		ECHO "<script language='JavaScript'>
			location.href = 'index.php?al=".$_REQUEST['al']."&pageNumber=".$_REQUEST['page']."'
		</script>";
		exit;

		
	}
?>
    <form name="pageSelectionForm" id="pageSelectionForm" method="post" action="index.php">
		<input type="hidden" id="pageNumber" name="pageNumber" value="<?php echo $page; ?>"/>
        <input type="hidden" id="al" name="al" value="<?php echo $al;?>"/>
		<input type="hidden" id="order" name="order" value="<?php echo $order;?>"/>
	</form>








<?php
/*	include_once '../../../lib/functions.php';
	include "../../../lib/db.php";
	$objSql = new SqlClass();
	admin_login_check();
	//User delet from adminn side
	if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		for($i=1;$i<$count;$i++)
		{
			$sql = "DELETE FROM ml_news WHERE blog_id='".$val[$i]."'";
			 $objSql->executeSql($sql);
			$_SESSION['msg'] = "<font size='2' color='#0099FF'>News(s) Deleted  Successfully</font>";
			echo "<script language='JavaScript'>
			location.href = 'index.php?al=".$_REQUEST['al']."&pageNumber=".$_REQUEST['page']."'
			</script>";
			exit;
		}
	}	//User send message to user from admin side
	else
	{
		if($_REQUEST['state'] == 'active')
		$sta = 'inactive';
		if($_REQUEST['state'] == 'inactive')
	 	$sta = 'active';
	
		$sql = "UPDATE ml_news SET status = '".$sta."' WHERE news_id = '".$_GET['id']."'"; 
		 $objSql->executeSql($sql);
		$_SESSION['msg'] = "<font size='2' color='#0099FF'>News Status Update Successfully</font>";
		echo "<script language='JavaScript'>
			location.href = 'index.php?al=".$_REQUEST['al']."&pageNumber=".$_REQUEST['page']."'
			</script>";
		exit;
	}
	*/
?>