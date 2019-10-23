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
		<input type="text" id="pageNumber" name="pageNumber" value="<?php echo $page; ?>"/>
        <input type="text" id="al" name="al" value="<?php echo $al;?>"/>
		<input type="text" id="order" name="order" value="<?php echo $order;?>"/>
	</form>
<?php
	session_start();
	include_once '../../../lib/db.php';
	//include_once"../../../lib/admin_check.php";
	include_once '../../../lib/class_ise_blogs.php';
	$ise_blogs = new Blogs();
	
	
		
	if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			
			$ise_blogs->ise_blog_post_delete("b_r_id",$val[$i]);
			
		
            
		}
		$_SESSION['msg'] = "<div class='success'>Blog Review(s) Deleted  Successfully</div>";

		?>
		<script language="JavaScript">
			location.href = "view_comments.php?pageNumber=<?=$_REQUEST['pageNumber']?>&al=<?php echo $_REQUEST['al'];?>&id=<?=$_GET['id']?>";
		 	</script>
            <?
			exit;
	}	//User send message to user from admin side
	
	if((!empty($_GET['state'])) && (!empty($_GET['id_1'])))
	{
		if($_GET['state'] == 'active')
		$sta = 'inactive';
		if($_GET['state'] == 'inactive')
		$sta = 'active';
		$tab = array("status =".$sta."");
		$where = "b_r_id=".$_GET['id_1']."";
		//echo $where;exit;
		$val = $ise_blogs->ise_blog_post_update($tab,$where);
		 
		$_SESSION['msg'] = "<div class='success'>Blog Review status set to ".$sta." Successfully</div>";
		?>
		<script language="JavaScript">
			location.href = "view_comments.php?pageNumber=<?=$_REQUEST['pageNumber']?>&al=<?php echo $_REQUEST['al'];?>&id=<?=$_GET['id']?>";
		</script>	
        <?
		
        exit;
	}
?>

