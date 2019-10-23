<?php
session_start();

include_once '../../../lib/db.php';
include_once '../../../lib/class_ise_blogs.php';

$objSql1 = new SqlClass();
$blog=new Blogs();

//echo $sql;

	if(isset($_REQUEST['exprt']) && !empty($_REQUEST['exprt']))
	{
		//$users='';
		$val = explode(',', $_REQUEST['exprt']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			$sql = "SELECT * FROM ise_blogs WHERE blog_id='".$val[$i]."'";
			$users=$objSql1->executeSql($sql);
		}
	}
    else
	{
		$sql = "SELECT * FROM ise_blogs ";
		$users=$objSql1->executeSql($sql);
	}	
	/*echo "<pre>";
				print_r($users);
				exit;*/
//echo URL;exit;
	if(is_array($users))
		{
		
				$filename ="blog_report".time().".doc";
				$title = "";
				$contents="<table align='center' border=1 width='100%' bordercolor='black' style='font-family:verdana; font-size:11px;'>
				<tr bgcolor='#72ACF3'><td colspan='3' height='30' align='center' style='font-size:14px;'><b>IsmartExams Blogs Report</b></td></tr>
				<tr  bgcolor='#72ACF3'>
				<td>Search Criteria: Blogs</td> 
				<td>Total Records: ".count($users)."</td><td>Date:  ".date('Y-m-d')."</td></tr>
				<tr><td colspan='3' align='center' style='color:#336699; font-size:16px;'><strong>Blogs</strong></td></tr>";
				
				for($i=0;$i<count($users);$i++)
				{
					if($i%2==0)
						$bgcolor=' background-color:#FFFFFF;';
					else
						$bgcolor=' background-color:#F4FCFF;';
						
						if($users['image_path']!='' && file_exists("../../../uploads/blogs/".$users['image_path']))
						$image=$users['image_path'];
						else
						$image='no_blog.png';
						$src="uploads/blogs/".$image;
					$contents.= "<tr ".$bgcolor."><td colspan='3'>
					<table border=0 width='100%' style='font-family:verdana; font-size:11px;  '>
					<tr>
					<td width='100'><img src='".URL."uploads/blogs/".$image."' height='80' width='80'></td>
					<td>
					 <table>
					<tr><td style='font-size:14px; color:#009966; font-weight:bold;'>".ucfirst($users[$i]['blog_title'])." </td></tr>
					
					<tr><td style='padding-left:5px;'>".nl2br(ucfirst($users[$i]['blog_desc']))." </td></tr>
					</table>
					</td>
					</tr>
					</table>
					";
					
				
					$contents.="</td></tr>";
					
					
					
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