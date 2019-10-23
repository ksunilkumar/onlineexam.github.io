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
	//exit;
	if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			$sql = "DELETE FROM ml_forum_comms WHERE `f_c_id` ='".$val[$i]."'";
			$objSql->executeSql($sql);
			$_SESSION['msg'] = "<font size='2' color='#FF0000'>Comment(s) Deleted Successfully</font>";
		}
		echo "<script> self.location='".$_SERVER['HTTP_REFERER']."';</script>";
		exit;
	}else{
		if($_GET['state'] == 'active')
		$sta = 'inactive';
		if($_GET['state'] == 'inactive')
		$sta = 'active';
		$sql = "UPDATE ml_forum_comms SET status = '".$sta."' WHERE f_c_id = '".$_GET['id']."'"; 
		//echo $sql;exit;
		 $objSql->executeSql($sql);
		$_SESSION['msg'] = "<font size='2' color='#FF0000'>Comment Status Update Successfully</font>";
		echo "<script> self.location='".$_SERVER['HTTP_REFERER']."';</script>";
		exit;
	}
?>