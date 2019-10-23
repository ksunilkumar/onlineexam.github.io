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
	$objSql = new SqlClass();
	//admin_login_check();
	//User delet from adminn side
	//exit;
	if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			$sql = "DELETE FROM ise_forums WHERE forum_id ='".$val[$i]."'";
			$objSql->executeSql($sql);
			$_SESSION['msg'] = "<div class='success'>Forum(s) Deleted Successfully</div>";
		}
		
		echo "<script> self.location='index.php?pageNumber=".$_REQUEST['pageNumber']."&al=".$_REQUEST['al']."';</script>";
		exit;
	}else{
		if($_GET['state'] == 'active')
		$sta = 'inactive';
		if($_GET['state'] == 'inactive')
		$sta = 'active';
		$sql = "UPDATE ise_forums SET status = '".$sta."' WHERE forum_id = '".$_GET['id']."'"; 
		$objSql->executeSql($sql);
		$_SESSION['msg'] = "<div class='success'>Forum Status Update Successfully</div>";
		echo "<script language='JavaScript'>
		self.location='index.php?pageNumber=".$_REQUEST['page']."&al=".$_REQUEST['al']."';
		</script>";
		exit;
	}
?>