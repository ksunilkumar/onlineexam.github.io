<?php 
	session_start();
	include_once '../../../lib/db.php';
	//include_once"../../../lib/admin_check.php";
	//admin_login_check('0','Others');
	include_once '../../../lib/class_ise_forums.php';
	//admin_login_check('0','RU');
	$ise_forum_comms = new Forums();
	//User delet from adminn side
	if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			
			
		$ise_forum_comms->ise_forum_post_delete("f_c_id",$val[$i]);
            
		}
		$_SESSION['msg'] = "<div class='success'>Forum Comments Deleted  Successfully</div>";
		?>
		<script language="JavaScript">
			location.href = "<?=$_SERVER['HTTP_REFERER'];?>";
		 	</script>
            <?
			exit;
	}	//User send message to user from admin side
	
	
	//User send message to user from admin side

	if((!empty($_GET['state'])) && (!empty($_GET['id_1'])))
	{
		if($_GET['state'] == 'active')
		$sta = 'inactive';
		if($_GET['state'] == 'inactive')
		$sta = 'active';
		$tab = array("status =".$sta."");
		$where = "f_c_id=".$_GET['id_1']."";
		$val = $ise_forum_comms->ise_forum_post_update($tab,$where);
		 
		$_SESSION['msg'] = "<div class='success'>Forum Comment status set to ".$sta." Successfully</font>";
		?>
		<script language="JavaScript">
			location.href = "display_forum_comments.php?page=<?=$_REQUEST['pageNumber']?>&al=<?php echo $_REQUEST['al'];?>&id=<?=$_GET['id']?>";
		</script>
		<?php
		
	}
?>