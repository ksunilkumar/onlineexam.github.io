<?php 
	session_start();
	$page=$_REQUEST['pageNumber'];
	
?>

<?php	include_once '../../../lib/db.php';
		$id=$_REQUEST['test_id'];
		$status=$_REQUEST['status'];	
		if($status=='active'){
			$sta='inactive';
		}
		else{
			$sta='active';
		}
		$sql="update test_test set status='$sta' where test_id=$id";
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		$_SESSION['msg']="<font color='#0099FF' size='2'>Course Updated Successfully</font>";
		print "<script>";
		print " self.location='index.php?pageNumber=".$_REQUEST['pageNumber']."';";
		print "</script>"; 
		exit;
?>

