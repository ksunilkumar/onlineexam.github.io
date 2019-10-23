<?php
session_start();
include_once '../../../lib/functions.php';
include_once '../../../lib/db.php';
include_once '../../../lib/functions_admin.php';
include_once '../../../lib/calss_qatar_tutors.php';
include_once '../../../lib/calss_qatar_users.php';
include_once '../../../lib/ise_Settings.class.php';
$settings=new ise_settings();
$qatar_users = new qatar_tutors();
$objSql1 = new SqlClass();
$blog=new Blog();

//echo $sql;

	if(isset($_REQUEST['exprt']) && !empty($_REQUEST['exprt']))
	{
		//$users='';
		$val = explode(',', $_REQUEST['exprt']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			//$sql = "SELECT * FROM sis_employee WHERE emp_id='".$val[$i]."' and school_id=".$_SESSION['school_id']."";
			 $sql = "SELECT * FROM ise_users where user_id='".$val[$i]."'";
			 if($_REQUEST['school_id']!='')
			 	$sql.= " and school=".$_REQUEST['school_id'];
			$users=$objSql1->executeSql($sql);
		}
	}
    else
	{
		$sql = "SELECT * FROM ise_users";
		if($_REQUEST['school_id']!='')
			 	$sql.= " where school=".$_REQUEST['school_id'];
				
		$users=$objSql1->executeSql($sql);
	}	
	/*echo "<pre>";
				print_r($users);
				exit;*/

	if(is_array($users))
		{
		
				$filename ="tutors_report".time().".doc";
				$title = "";
				$contents="<table align='center' border=1 width='100%' bordercolor='black' style='font-family:verdana; font-size:11px;'>
				<tr bgcolor='#72ACF3'><td colspan='3' height='30' align='center' style='font-size:14px;'><b>Qatarsmarteducation Users Report </b></td></tr>
				<tr  bgcolor='#72ACF3'>
				<td>Search Criteria: Users</td> 
				<td>Total Records: ".count($users)."</td>
				<td>Date:  ".date('Y-m-d')."</td></tr>
				<tr><td colspan='3' align='center' style='color:#336699; font-size:16px;'><strong>Users</strong></td></tr>";
				
				for($i=0;$i<count($users);$i++)
				{
					$user=new qatar_users();
					//$arr=$user->get_email($users[$i]['user_id']);
					$class=$settings->get_school_names($users[$i]['school']);  
					
					
					
					
					
					
					if($i%2==0)
						$bgcolor=' background-color:#FFFFFF;';
					else
						$bgcolor=' background-color:#F4FCFF;';
						
					$contents.= "<tr><td colspan='3'>
					<table border=0 width='100%' style='font-family:verdana; font-size:11px; ".$bgcolor." '>
					<tr><td style='font-size:14px; color:#009966; font-weight:bold;'>".ucfirst($users[$i]['user_fname'])." ".ucfirst($users[$i]['user_lname'])." </td></tr>
					<tr><td><strong>Status :&nbsp; ".$users[$i]['status']."</strong> </td></tr>
					<tr><td style='padding-left:5px;'><strong>Email &nbsp;</strong>".$users[$i]['user_email']." </td></tr>
					<tr><td style='padding-left:5px;'><strong>Class: &nbsp;</strong>".$class." </td></tr>
					
					<tr><td style='padding-left:5px;'><strong>doj : &nbsp;</strong>".ucfirst($users[$i]['create_date'])." </td></tr>
					
					<tr><td>&nbsp;</td></tr>
					";
				
					
					$contents.="</table>
					</td></tr>";
				}
				$contents.="</table>";

				$fp  =  fopen("../exports/".$filename,  'w+'); 
				$str  =  $contents; 
				fwrite($fp,  $str); 
				fclose($fp);

			print '<form action="index.php" method="post" name="download_form">
			  <input type="text" name="filename" id="filename" value="'.$filename.'" style="border:none; color:white;" />
			</form>';
			print("<script>");
			print("document.download_form.submit();");
			print("</script>");

/*header('Content-type: application/vnd.ms-word');

header('Content-Disposition: attachment; filename='.$filename);
echo $title;
echo $contents;

print("<script>");
print("self.location='index.php'");
print("</script>");
*/
		}
		
				
		else
		{
			print("<script>");
			print("alert('No Records Found');");
			print("self.location='index.php'");
			print("</script>");
		}
?>