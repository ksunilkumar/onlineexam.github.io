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
	session_start();
	include_once '../../../lib/db.php';
	include_once"../../../lib/admin_check.php";
	
	include_once '../../../lib/calss_qatar_blogs.php';
	//admin_login_check('0','RU');
	$qatar_blogs = new qatar_blogs();
	
	if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		for($i=1;$i<$count;$i++)
		{
			$qatar_blogs->qatar_blogs_delete("blog_id",$val[$i]);
			$_SESSION['msg'] = "<font size='2' color='#0099FF'>Blog(s) Deleted  Successfully</font>";
			?>
            <script language="JavaScript">
				location.href = "index.php?page=<?=$_GET['page']?>";
		 	</script>
            <?
			exit;
		}
	}	//User send message to user from admin side
	
	if((!empty($_GET['state'])) && (!empty($_GET['id'])))
	{
		if($_GET['state'] == 'active')
		$sta = 'inactive';
		if($_GET['state'] == 'inactive')
		$sta = 'active';
		$tab = array("status =".$sta."");
		$where = "blog_id=".$_GET['id']."";
		$val = $qatar_blogs->qatar_blogs_set_function($tab,$where);
		 
		$_SESSION['msg'] = "<font size='2' color='#0099FF'> ".$sta." Successfully</font>";
		?>
		<script language="JavaScript">
			location.href = "index.php?page=<?=$_GET['page']?>";
		</script>
		<?php
		
	}
?>

