<?php 
	include('lib/db.php');
	$user_id=$_REQUEST['user_id'];
	for($i=0;$i<count($user_id);$i++)
	{
		$sql="select user_fname,user_lname, user_email from ise_users where user_id=".$user_id[$i];
		$objSql = new SqlClass();
		$res = $objSql->executeSql($sql);
		$row= $objSql->fetchRow($res);
		$fromname = 'ismartexams.com';$fromaddress = 'admin@ismartexams.com' ;$toname = $row->user_fname." ".$row->user_lname;
		$toaddress = $row['user_email'];
		$subject = $_REQUEST['subject'];;
		$message = $_REQUEST['message'];
		sendMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);
		echo "<script>self.location='".$_SERVER['HTTP_REFERER']."'</script>";
	}
?>