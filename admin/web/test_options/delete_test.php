<?php include_once '../../../lib/db.php';
			 $query=new Queries();
			$query->makedeletequery('test_bag','Bagid',$_REQUEST['id']);
			$_SESSION['msg'] = "<font size='2' color='#0099FF'>Poll(s) Deleted  Successfully</font>";
	
		echo "<script language='JavaScript'>
			location.href = 'manage_tests.php?al=".$_REQUEST['al']."&pageNumber=".$_REQUEST['page']."'
			</script>";
			exit;
?>