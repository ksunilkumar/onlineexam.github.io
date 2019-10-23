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
	include_once '../../../lib/functions.php';
	include "../../../lib/db.php";
	$settings=new Settings();
	$objSql = new SqlClass();
	/*$date=date('Y-m-d');
	$sql1="select  distinct(userid) from enm_cart_schedule where date='$date'";
	 $data1=$objSql->executeSql($sql1);
	while($rec1=$objSql->fetchRow($data1))
	 {
	 $arr[]=$rec1[0];
	 }*/
	$objSql = new SqlClass();
	admin_login_check();
	$user= new User();
	
	//User delet from adminn side
	if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		$c1=$c2=0;
		for($i=1;$i<$count;$i++)
		{
			
				$n=$user->user_name($val[$i]);
				$name=$n[0];
				
				$sql = "DELETE FROM ml_professors WHERE id ='".$val[$i]."'";
				 $objSql->executeSql($sql);
				
				
		}
				
				$msg2.="  <font size='2' color='#0099FF'>Deleted successfully </font>";
				$_SESSION['msg'] =$msg1."<br>".$msg2;
				echo "<script language='JavaScript'>
			location.href = 'index.php?al=".$_REQUEST['al']."&pageNumber=".$_REQUEST['page']."'
			</script>";
				exit;

	}	//User send message to user from admin side
	else
	{
		if($_GET['state'] == 'active')
		$sta = 'inactive';
		if($_GET['state'] == 'inactive')
		$sta = 'active';
		 $sql = "UPDATE ml_professors SET status = '".$sta."' WHERE id  = '".$_GET['id']."'"; 
		
		 $objSql->executeSql($sql);
		$_SESSION['msg'] = "<font size='2' color='#0099FF'>Professor Status Updated Successfully</font>";
		echo "<script language='JavaScript'>
		document.getElementById('pageSelectionForm').submit();
		</script>";
		exit;
	}
	
?>