<?php	session_start();
	include_once 'lib/db.php';
	include_once 'lib/class_ise_groups.php';
	include_once 'lib/class_ise_users.php';
	$page=$_GET['page'];
	$queries = new Queries();
	//$pagination_qatar = new pagination_qatar();
	$ise_groups = new ise_groups();
	$qtr_grps = $ise_groups->disply_active_groups();

	$delete=$ise_groups->ise_groups_member_delete($_GET['gid'],$_SESSION['user_id']);	
	if($delete){
	$_SESSION['msg']="<div class='success'>You successfully left the Group</div>";
	header("Location:".$_SERVER['HTTP_REFERER']."");
	
	} else {
	$_SESSION['msg']="<div class='wrong'>You are not leaved from the group</div>";'';
	header("Location:".$_SERVER['HTTP_REFERER']."");
	}
?>