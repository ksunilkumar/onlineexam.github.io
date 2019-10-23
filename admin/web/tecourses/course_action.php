<?php 
	session_start();
	$page=$_REQUEST['pageNumber'];
	if(isset($_REQUEST['al']))
		$al=$_REQUEST['al'];
	else
		$al='.';
	$order=$_REQUEST['order'];
?>
    <!--<form name="pageSelectionForm" id="pageSelectionForm" method="post" action="index.php">
		<input type="text" id="pageNumber" name="pageNumber" value="<?php echo $page; ?>"/>
        <input type="text" id="al" name="al" value="<?php echo $al;?>"/>
		<input type="text" id="order" name="order" value="<?php echo $order;?>"/>
	</form>-->
<?php
	session_start();
	include_once '../../../lib/db.php';
	
	
	
	
	if(!empty($_POST['delet']))
	{
		 $val = explode(',', $_POST['delet']);
		  $count = count($val);
		for($i=0;$i<$count;$i++)
		{
			$objSql = new SqlClass();
			
			 $sql="delete from test_course where course_id='$val[$i]'";
			 //$page=$_REQUEST['page'];
			 $objSql->executeSql($sql);
			
			
		} 
        	$_SESSION['msg']="<font color='#0099FF' size='2'>Course Delete Successfully</font>";
			print "<script>";
				print 'location.href = "index.php?pageNumber='.$_GET['pageNumber'].'";';
			print "</script>"; 
			exit;

	}	

?>

