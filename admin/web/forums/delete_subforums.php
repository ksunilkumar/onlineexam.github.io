<?php 

	session_start();
	$page=$_REQUEST['page'];
	if(isset($_REQUEST['al']))
		$al=$_REQUEST['al'];
	else
		$al='.';
	$order=$_REQUEST['order'];
?>
    <form name="pageSelectionForm" id="pageSelectionForm" method="post" action="index.php">
		<input type="hidden" id="pageNumber" name="pageNumber" value="<?php echo $page; ?>"/>
        <input type="hidden" id="al" name="al" value="<?php echo $al;?>"/>
		<input type="hidden" id="order" name="order" value="<?php echo $order;?>"/>
	</form>
<?php
	//include_once '../../../lib/functions.php';
	
	include "../../../lib/db.php";
	//include_once '../../../lib/admin_check.php';
	
	//admin_login_check();
	//User delet from adminn side
	//exit;
	
	if(!empty($_REQUEST['delet']))
	{
	
		$val = explode(',', $_REQUEST['delet']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			$sql = "DELETE FROM `ise_forums` WHERE `forum_id` ='".$val[$i]."'";
		$objSql = new SqlClass();
			$objSql->executeSql($sql);
			$_SESSION['msg'] = "<div class='success'>SubForum(s) Deleted Successfully</div>";
		}
		echo "<script> self.location='".$_SERVER['HTTP_REFERER']."';</script>";
		exit;
	}
	else{
	if((!empty($_GET['state'])) && (!empty($_GET['id'])))
	{
		if($_GET['state'] == 'active')
		$sta = 'inactive';
		if($_GET['state'] == 'inactive')
		$sta = 'active';
		$sql = "UPDATE ise_forums SET status = '".$sta."' WHERE forum_id = '".$_GET['id']."'"; 
		$objSql1 = new SqlClass();
		 $objSql1->executeSql($sql);
		$_SESSION['msg'] = "<div class='success'>SubForum Status set to ".$sta." Successfully</div>";
		echo "<script> self.location='".$_SERVER['HTTP_REFERER']."';</script>";
		exit;
	}
	}
?>