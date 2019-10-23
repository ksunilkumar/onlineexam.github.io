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
		<input type="text" id="pageNumber" name="pageNumber" value="<?php echo $page; ?>"/>
        <input type="text" id="al" name="al" value="<?php echo $al;?>"/>
		<input type="text" id="order" name="order" value="<?php echo $order;?>"/>
	</form>
<?php
	include_once '../../lib/functions.php';
	include "../../lib/db.php";
	$objSql = new SqlClass();
	admin_login_check();
	//User delet from adminn side
	if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		for($i=1;$i<$count;$i++)
		{
			$sql = "DELETE FROM enm_session WHERE session_id ='".$val[$i]."'";
			 $objSql->executeSql($sql);
			$_SESSION['msg'] = "<font size='3' color='#0099FF'>Session(s) Deleted Successfully</font>";
			echo "<script> self.location='index.php';</script>"; 
		}
	}	//User send message to user from admin side
	else
	{
		if($_GET['state'] == 'active')
		$sta = 'inactive';
		if($_GET['state'] == 'inactive')
		$sta = 'active';
		$sql = "UPDATE enm_session SET status = '".$sta."' WHERE session_id  = '".$_GET['id']."'"; 
		 $objSql->executeSql($sql);
		$_SESSION['msg'] = "<font size='3' color='#0099FF'>Session Status Update Successfully</font>";
		echo "<script language='JavaScript'>
		document.getElementById('pageSelectionForm').submit();
		</script>";
	}
	
?>