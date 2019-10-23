<?php 
	session_start();
	include_once '../../../lib/db.php';
	include_once"../../../lib/admin_check.php";
	admin_login_check('0','Others');
	include_once '../../../lib/class_ise_faqs.php';
	//admin_login_check('0','RU');
	$ise_faqs = new ise_faqs();
	//User delet from adminn side
	
	
	
	if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			
			
			$ise_faqs->ise_faqs_delete("faq_id",$val[$i]);
			
			
		}
		$_SESSION['msg'] = "<div class='success'>Faq(s) Deleted  Successfully</div>";	
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
		$where = "faq_id =".$_GET['id']."";
		$val = $ise_faqs->ise_faqs_set_function($tab,$where);
		 
		$_SESSION['msg'] = "<div class='success'>Faq status set to ".$sta." Successfully</div>";
		?>
		<script language="JavaScript">
			location.href = "index.php?pageNumber=<?=$_GET['page']?>&al=<?php echo $_REQUEST['al'];?>";
		</script>
		<?php
		
	}	

?>
    <form name="pageSelectionForm" id="pageSelectionForm" method="post" action="index.php">
		<input type="hidden" id="pageNumber" name="pageNumber" value="<?php echo $page; ?>"/>
        <input type="hidden" id="al" name="al" value="<?php echo $al;?>"/>
		<input type="hidden" id="order" name="order" value="<?php echo $order;?>"/>
	</form>







