<?php 
	session_start();
	include_once '../../../lib/db.php';
	include_once"../../../lib/functions.php";
	//admin_login_check('0','Others');
	include_once '../../../lib/calss_qatar_newssletter.php';
	$objSql = new SqlClass();
	$ns=new qatar_newsletter();
	$arr1=$ns->news_display_all($_GET['id']);
	$arrw=$objSql->fetchRow($arr1);
	$sql= "SELECT * FROM qse_newsletter_users where status='active'";
	$objSql = new SqlClass();
	$arr = $objSql->executeSql($sql);
	
	
	if($arr[0][0]!="" && count($arr)>0)
	{
		for($i=0;$i<count($arr);$i++)
		{
		$email =$arr[$i]['email_id'];
		$body=$arrw['content']."<br>";
		if($arrw['image_url']!=''){
			$body.="<img src=\'www.inconfy.com/admin/newsletter/images/".$arrw['image_url']."\' >";
		
		}
		$pa='send';
			include "../../../phpmailer/examples/mail.php";
		}
		
	}
	
	$_SESSION['msg'] = "<font size='2' color='#FF0000'> Newsletter  Details Sent To All Newsletter Users MailIds</font>";
	print "<script>";
	print " self.location='index.php';";
	print "</script>"; 
	exit;
			

?>