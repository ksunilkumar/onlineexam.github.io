<?php	session_start();
	include_once 'lib/db.php';
	include_once 'lib/class_ise_groups.php';
	include_once 'lib/class_ise_users.php';
	
	$page=$_GET['page'];
	$gid=$_GET['gid'];
	$queries = new Queries();
	$pagination_qatar = new pagination_qatar();
	$ise_groups = new ise_groups();
	//$qtr_grps = $qatar_groups->disply_active_groups();
	$objSql = new SqlClass();
	//$objSql = new SqlClass();
			
	$qry="select group_id,user_id from ise_group_members where user_id='".$_SESSION['user_id']."' and group_id='".$gid."'";
	
	$res = $objSql->executeSql($qry);
	$row = $objSql->fetchRow($res);
	if($_SESSION['user_id']){
	$date = date('Y-m-d H:i:s');
	$array=array("group_id=".$_GET['gid']."","user_id=".$_SESSION['user_id']."","user_add_date=".$date."","status=active","user_visits=0");
	/*echo "<pre>";
	print_r($array);
	exit;*/
	
	if(!empty($row)){
	
	
	$_SESSION['msg']="<div class='info'>You are already in this group</div>";
	header("Location:".$_SERVER['HTTP_REFERER']."");
	}else{
	$insert=$ise_groups->ise_group_member_insert($array);	
	
	if($insert){
	$_SESSION['msg']="<div class='success'>You are successfully added in this group</div>";
	//header("Location:livegroups_inner.php?page=$page&gid=$gid");
	
	} else {
	$_SESSION['msg']="<div class='wrong'>You are not added in this group</div>";
	//header("Location:livegroups.php?page=$page");
	}
	}
	header("Location:".$_SERVER['HTTP_REFERER']."");
	}else{
	$_SESSION['errmsg']="<div class='wrong'>Please login for join in this group</div>";
	header("Location:login_one.php?page=$page&gid=$_GET[gid]");
	//header("Location:livegroups.php?page=$page");
	}
	
?>