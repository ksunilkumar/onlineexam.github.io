<?php 
	session_start();
	include_once '../../../lib/db.php';
	include_once"../../../lib/admin_check.php";
	include_once '../../../lib/functions_admin.php';
	admin_login_check('0','admin');
	$country=new country();
	//User delet from adminn side
/*	if(!empty($_GET['delet']))
	{		
		$qatar_groups->qatar_groups_delete("ad_id",$_GET['id']);
		
		$_SESSION['msg'] = "<font size='2' color='#FF0000'>Client Deleted Successfully</font>";
			?>
			<script language="JavaScript">
				location.href = "index.php?page=<?=$_GET['page']?>";
		 	</script>
			<?php
	}*/
	
	
	
	if(!empty($_POST['delet']))
	{
		$val = explode(',', $_POST['delet']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			/*$sql = "DELETE FROM `ml_blogs` WHERE `blog_id` ='".$val[$i]."'";
			$objSql->executeSql($sql);*/
			$country->country_delete("country_id",$val[$i]);
			$_SESSION['msg'] = "<div class='success'>Deleted Successfully</div>";
		}
echo "<script language='JavaScript'>
			location.href = 'index.php?pageNumber=".$_REQUEST['page']."&al=".$_REQUEST['al']."'
			</script>";
			exit;	}
	
	

?>