<?php 
		session_start();
		
	include_once '../../../lib/db.php';
	include_once"../../../lib/admin_check.php";
	admin_login_check('0','Others');
	include_once '../../../lib/calss_qatar_polls.php';
	//admin_login_check('0','RU');
	$qatar_polls = new qatar_polls();

	
	if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			$qatar_polls->qatar_polls_delete("poll_id",$val[$i]);
			$_SESSION['msg'] = "<font size='2' color='#FF0000'>Poll(s) Deleted  Successfully</font>";
			
		}
		echo "<script language='JavaScript'>
			location.href = 'index.php?al=".$_REQUEST['al']."&pageNumber=".$_REQUEST['page']."'
			</script>";
			exit;
	}
	
	if((!empty($_GET['state'])) && (!empty($_GET['id'])))
	{
		
		if($_GET['state'] == 'active')
		$sta = 'inactive';
		if($_GET['state'] == 'inactive')
		$sta = 'active';
		$tab = array("status =".$sta."");
		$where = "poll_id=".$_GET['id']."";
		$val = $qatar_polls->qatar_polls_set_function($tab,$where);
		 
		$_SESSION['msg'] = "<font size='2' color='#FF0000'> ".$sta." Successfully</font>";
		?>
		<script language="JavaScript">
			location.href = "index.php?pageNumber=<?php echo $_GET['pageNumber'];?>&al=<?php echo $_REQUEST['al'];?>";
		</script>
		<?php
		
	}
?>
    <form name="pageSelectionForm" id="pageSelectionForm" method="post" action="index.php">
		<input type="text" id="pageNumber" name="pageNumber" value="<?php echo $page; ?>"/>
        <input type="text" id="al" name="al" value="<?php echo $al;?>"/>
		<input type="text" id="order" name="order" value="<?php echo $order;?>"/>
	</form>


