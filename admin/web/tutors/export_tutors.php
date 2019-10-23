<?php
session_start();
include_once '../../../lib/functions.php';
include_once '../../../lib/db.php';
include_once '../../../lib/functions_admin.php';
include_once '../../../lib/calss_qatar_tutors.php';
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
			$sql = "SELECT * FROM sis_employee WHERE emp_id='".$val[$i]."' and school_id=".$_SESSION['school_id']."";
			$users=$objSql1->executeSql($sql);
		}
	}
    else
	{
		$sql = "SELECT * FROM sis_employee where school_id=".$_SESSION['school_id']."";
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
				<tr bgcolor='#72ACF3'><td colspan='3' height='30' align='center' style='font-size:14px;'><b>Qatarsmarteducation Tutors Report </b></td></tr>
				<tr  bgcolor='#72ACF3'>
				<td>Search Criteria: Tutors</td> 
				<td>Total Records: ".count($users)."</td>
				<td>Date:  ".date('Y-m-d')."</td></tr>
				<tr><td colspan='3' align='center' style='color:#336699; font-size:16px;'><strong>Tutors</strong></td></tr>";
				
				for($i=0;$i<count($users);$i++)
				{
					if($users[$i]['status']==1){
						$status='Active';
					}
					else{
						$status='Inactive';
					}
					if($i%2==0)
						$bgcolor=' background-color:#FFFFFF;';
					else
						$bgcolor=' background-color:#F4FCFF;';
						$arr=$qatar_users->get_email($users[$i]['emp_id']);
					$contents.= "<tr><td colspan='3'>
					<table border=0 width='100%' style='font-family:verdana; font-size:11px; ".$bgcolor." '>
					<tr><td style='font-size:14px; color:#009966; font-weight:bold;'>".ucfirst($users[$i]['firstname'])." ".ucfirst($users[$i]['lastname'])." </td></tr>
					<tr><td><strong>Status :&nbsp; ".$status."</strong> </td></tr>
					<tr><td style='padding-left:5px;'><strong>Profile Description: &nbsp;</strong>".nl2br(ucfirst($users[$i]['profile_desc']))." </td></tr>
					<tr><td style='padding-left:5px;'><strong>Qualification: &nbsp;</strong>".ucfirst($users[$i]['qualification'])." </td></tr>
					<tr><td style='padding-left:5px;'><strong>Basic_salary: &nbsp;</strong>".ucfirst($users[$i]['basic_salary'])." </td></tr>
					<tr><td style='padding-left:5px;'><strong>doj : &nbsp;</strong>".ucfirst($users[$i]['doj'])." </td></tr>
					<tr><td style='padding-left:5px;'><strong>Email: &nbsp;</strong>".$arr[0][0]." </td></tr>
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