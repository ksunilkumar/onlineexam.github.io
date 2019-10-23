<?php 
	session_start();
	$page=$_REQUEST['page'];
	if(isset($_REQUEST['al']))
		$al=$_REQUEST['al'];
	else
		$al='.';
	$order=$_REQUEST['order'];
	include_once '../../../lib/db.php';
	include_once"../../../lib/admin_check.php";
	admin_login_check('0','admin');
	include_once '../../../lib/class_ise_users.php';
	$qatar_users = new ise_users();
	
	/*if(!empty($_GET['delet']))
	{
			$qatar_users->qatar_users_delete("studentid",$_GET['id_1']);
	
			?>
			<script language="JavaScript">
				location.href = "index.php?page=<?=$_GET['page']?>&id=<?=$_GET['id']?>&al=<?=$_REQUEST['al']?>";
		 	</script>
			<?php
	}	*/
 
	if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		$c1=$c2=0;
		for($i=1;$i<$count;$i++)
		{
				$qatar_users->ise_users_delete("user_id",$val[$i]);
				
		}
				
					
				
			$_SESSION['msg'] = "<font size='2' color='#0099FF'>Users Deleted Successfully</font>";
			?>
			<script language="JavaScript">
				location.href = "index.php?pageNumber=<?=$_GET['page']?>&id=<?=$_GET['id']?>&al=<?=$_REQUEST['al']?>";
		 	</script>
            <?
			exit;
				

	}
	
	if(($_GET['state']!="") && ($_GET['id_1']!=""))
	{
		if($_GET['state'] == 'active')
		{
		$sta = '0';
		$status="inactive";
		}
		if($_GET['state'] == 'inactive')
		{
		$sta = '1';
		$status="active";
		}
		$tab = array("status =".$status."");
		$where = "user_id=".$_GET['id_1']."";
		
		$val = $qatar_users->ise_users_set_function($tab,$where);
		 
		$_SESSION['msg'] = "<font size='2' color='#0099FF'>User ".$status." Successfully</font>";
		?> 
		<script language="JavaScript">
			location.href = "index.php?pageNumber=<?=$_GET['page']?>&id=<?=$_GET['id']?>&al=<?=$_REQUEST['al']?>";
		</script>
        
		<?php
		
	}
?>    
<form name="pageSelectionForm" id="pageSelectionForm" method="post" action="index.php">
		<input type="text" id="pageNumber" name="pageNumber" value="<?php echo $page; ?>"/>
        <input type="text" id="al" name="al" value="<?php echo $al;?>"/>
		<input type="text" id="order" name="order" value="<?php echo $order;?>"/>
	</form>

