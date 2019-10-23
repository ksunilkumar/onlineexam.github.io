<?php 
	session_start();
	$page=$_REQUEST['pageNumber'];
	
?>

<?php	include_once '../../../lib/db.php';
		$id=$_REQUEST['cost_id'];
		$status=$_REQUEST['status'];	
		if($status=='active'){
			$sta='inactive';
		}
		else{
			$sta='active';
		}
		$sql="update test_cost set status='$sta' where cost_id=$id";
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		$_SESSION['msg']="<font color='#0099FF' size='2'>Cost Updated Successfully</font>";
		print "<script>";
		print " self.location='index.php?pageNumber=".$_REQUEST['pageNumber']."';";
		print "</script>"; 
		exit;
?>

