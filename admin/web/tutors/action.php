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
	include_once '../../../lib/calss_qatar_tutors.php';
	$qatar_users = new qatar_tutors();
	
	
	if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		$c1=$c2=0;
		for($i=1;$i<$count;$i++)
		{
				$qatar_users->qatar_users_delete("emp_id",$val[$i]);
				
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
		if($_GET['state'] == '1')
		{
		$sta = '0';
		$status="Deactive";
		}
		if($_GET['state'] == '0')
		{
		$sta = '1';
		$status="Active";
		}
		$tab = array("status =".$sta."");
		$where = "emp_id=".$_GET['id_1']."";
		
		$val = $qatar_users->qatar_users_set_function($tab,$where);
		 
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

