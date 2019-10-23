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
	//admin_login_check('0','Others');
	include_once '../../../lib/calss_qatar_career.php';
	//admin_login_check('0','RU');
	$qatar_career = new qatar_career();
		if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			
			$qatar_career->qatar_career_delete("career_id",$val[$i]);
			
			
		}
		$_SESSION['msg'] = "<font size='2' color='#0099FF'>Career(s) Deleted  Successfully</font>";	
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
		$where = "career_id=".$_GET['id']."";
		$val = $qatar_career->qatar_career_set_function($tab,$where);
		 
		$_SESSION['msg'] = "<font size='2' color='#0099FF'> ".$sta." Successfully</font>";
			
		echo "<script language='JavaScript'>
			location.href = 'index.php?al=".$_REQUEST['al']."&pageNumber=".$_REQUEST['page']."'
			</script>";
			exit;
		
		
	}
	
	

?>
    <form name="pageSelectionForm" id="pageSelectionForm" method="post" action="index.php">
		<input type="hidden" id="pageNumber" name="pageNumber" value="<?php echo $page; ?>"/>
        <input type="hidden" id="al" name="al" value="<?php echo $al;?>"/>
		<input type="hidden" id="order" name="order" value="<?php echo $order;?>"/>
	</form>







