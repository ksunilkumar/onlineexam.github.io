<?php 
	session_start();
	include_once '../../../lib/db.php';
	include_once"../../../lib/admin_check.php";
	include_once '../../../lib/calss_qatar_keys.php';
	admin_login_check('0','admin');
	include_once '../../../lib/calss_qatar_school.php';
	include_once '../../../lib/calss_qatar_skoolinfo.php';
	
	
	//User send message to user from admin side

	if($_GET['state']!='' && (!empty($_GET['id'])))
	{
		
		$tab = array("act_status =activated");
		$where = "school_id =".$_GET['id']."";
		
		$school=new qatar_schools();
		$val = $school->qatar_schools_set_function($tab,$where);
		$arr=array("status=1");   
		$where1 = "school_id =".$_GET['id']."";
		$school=new qatar_schools();
		$val = $school->qatar_emp_set_function($arr,$where1);	
		
		
		
				echo $sq="select * from qse_schools where school_id=$_GET['id']";
				unset($objSql);
				$objSql = new SqlClass();
				$school=$objSql->fetchRow($objSql->executeSql($sq));
		
		
		$message=" Dear ".$school['contact_name']."<br><br>Thanks For Your School Registration.<br><br>
		Your School is activated successfully.
		<br><br>Please Contact for Further Details <a href='mailto:admin@qatarexamcenter.com'>admin@qatarexamcenter.com</a><br><br>";
				
				
	    sendLoginMail("QatarSmartEducation","admin@qatarsmarteducation.com", $school['contact_name'], $school['contact_email'], "School Login Username and Password", $message);
			$_SESSION['msg'] = "<font size='2' color='#FF0000'>Your School Activated Successfully.Login Details Sent To Your Mail.</font>";
		
		
		
		
		
		
		
		
		
		
		
		
		
		$_SESSION['msg'] = "<font size='2' color='#FF0000'> School Activated Successfully</font>";
		echo "<script language='JavaScript'>
			location.href = 'index.php?pageNumber=".$_REQUEST['page']."&al=".$_REQUEST['al']."'
			</script>";
			exit;
	}
	if(!empty($_POST['delet']))
	{		
		$val = explode(',', $_POST['delet']);
		$count = count($val);
			print_r($val);
		for($i=1;$i<$count;$i++)
		{
			
				qatar_keys_delete("keyId",$val[$i]);
				
			$_SESSION['msg'] = "<font size='3' color='#0099FF'>Deleted Successfully</font>";
		}
		echo "<script language='JavaScript'>
			location.href = 'viewkeys.php?pageNumber=".$_REQUEST['page']."$al=".$_REQUEST['al']."'
			</script>";
			exit;	
			
			}
?>

