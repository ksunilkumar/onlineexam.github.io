<?php
session_start();
include_once '../../../lib/functions.php';
include_once '../../../lib/db.php';
$objSql1 = new SqlClass();
//admin_login_check();

//echo $sql;

		$sql = "SELECT * FROM test_grades";
		$users=$objSql1->executeSql($sql);
		

	if(is_array($users))
		{
		
				$filename ="blog_report".time().".doc";
				$title = "";
				$contents="<table align='center' border=1 width='100%' bordercolor='black' style='font-family:verdana; font-size:11px;'>
				<tr bgcolor='#72ACF3'><td colspan='2' height='30' align='center' style='font-size:14px;'><b>".Site_Title."</b></td></tr>
				<tr  bgcolor='#72ACF3'>
				<td>Search Criteria: Grade</td> 
				<td>Total Records: ".count($users)."</td></tr>
				<tr><td colspan='2' align='center' style='color:#336699; font-size:16px;'><strong>Grade</strong></td></tr>";
				
				for($i=0;$i<count($users);$i++)
				{
					if($i%2==0)
						$bgcolor=' background-color:#FFFFFF;';
					else
						$bgcolor=' background-color:#F4FCFF;';
					$contents.= "<tr><td colspan='2'>
					<table border=0 width='100%' style='font-family:verdana; font-size:11px; ".$bgcolor." '>
					<tr><td style='font-size:14px; color:#009966; font-weight:bold;'>Grade Name".ucfirst($users[$i]['grade_name'])." </td></tr>
					<tr><td><strong> ";
					
					$contents.="</strong> </td></tr>
					<tr><td style='padding-left:5px;'><img src=".URL.'gradeimages/'.$users[$i]['grade_image']." height='80' width='80'></td></tr>
					<tr><td>&nbsp;</td></tr>
					";
					
		
					$contents.="<tr><td>&nbsp;</td></tr>";
					
					$contents.="</table>
					</td></tr>";
				}
				$contents.="</table>";

				$fp  =  fopen("../exports/".$filename,  'w+'); 
				$str  =  $contents; 
				fwrite($fp,  $str); 
				fclose($fp);

			print '<form action="manage_grade.php" method="post" name="download_form">
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
			print("self.location='manage_grade.php'");
			print("</script>");
		}
?>