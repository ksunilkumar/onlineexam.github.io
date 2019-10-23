<?php 
	session_start();
	$page=$_REQUEST['pageNumber'];
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
	session_start();
	include_once '../../../lib/db.php';
	//include_once"../../../lib/admin_check.php";
	
	include_once '../../../lib/class_ise_blogs.php';
	//admin_login_check('0','RU');
	$ise_blogs = new blogs();
	
	
	if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
		$objSql1 = new SqlClass();
			$sql = "DELETE FROM `ise_blogs` WHERE `blog_id` ='".$val[$i]."'";
			//echo $sql;exit;
			$objSql1->executeSql($sql);
			
		
            
		}
		$_SESSION['msg'] = "<div class='success'>Blog(s) Deleted  Successfully</div>";
		?>
		<script language="JavaScript">
			location.href = "index.php?pageNumber=<?=$_REQUEST['pageNumber']?>&al=<?php echo $_REQUEST['al'];?>";
		 	</script>
            <?
			exit;
	}	//User send message to user from admin side
	
	if((!empty($_GET['state'])) && (!empty($_GET['id'])))
	{
		if($_GET['state'] == 'active')
		$sta = 'inactive';
		if($_GET['state'] == 'inactive')
		$sta = 'active';
		
		$sql = "UPDATE ise_blogs SET status = '".$sta."' WHERE blog_id = '".$_GET['id']."'"; 
		//echo $sql;exit;
		$objSql = new SqlClass();
		 $objSql->executeSql($sql);
		 
		$_SESSION['msg'] = "<div class='success'>blog status set to ".$sta." Successfully</div>";
		?>
		<script language="JavaScript">
			location.href = "index.php?pageNumber=<?=$_REQUEST['pageNumber']?>&al=<?php echo $_REQUEST['al'];?>";
		</script>	
        <?
		
        exit;
	}
?>

