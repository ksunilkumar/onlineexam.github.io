<?php
session_start();
include_once '../../../lib/functions.php';
include_once '../../../lib/db.php';
$objSql1 = new SqlClass();
//admin_login_check();
//echo $sql;


	if(isset($_REQUEST['exprt']) && !empty($_REQUEST['exprt']))
	{
		//$users='';
		$val = explode(',', $_REQUEST['exprt']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			$sql = "SELECT * FROM polls WHERE news_id='".$val[$i]."' and school_id=".$_SESSION['school_id']."";
			$users=$objSql1->executeSql($sql);
		}
	}
    else
	{
			$sql = "SELECT * FROM polls where school_id=".$_SESSION['school_id']."";
			$users=$objSql1->executeSql($sql);
	}	


 
if(is_array($users))
{

$filename ="news_report".time().".doc";
$title = "";
		$contents="<table align='center' border=1 width='100%' bordercolor='black' style='font-family:verdana; font-size:11px;'>
		<tr bgcolor='#72ACF3'><td colspan='3' height='30' align='center' style='font-size:14px;'><b>Qatarsmarteducation Polls Report</b></td></tr>
		<tr  bgcolor='#72ACF3'>
		<td>Search Criteria: Polls</td> 
		<td>Total Records: ".count($users)."</td> <td>Date:  ".date('Y-m-d')."</td></tr>
		<tr><td colspan='3' align='center' style='color:#336699; font-size:16px;'><strong>Polls</strong></td></tr>";
		
		for($i=0;$i<count($users);$i++)
		{
			if($i%2==0)
				$bgcolor=' background-color:#FFFFFF;';
			else
				$bgcolor=' background-color:#F4FCFF;';
			$contents.= "<tr><td colspan='3'>
			<table border=0 width='100%' style='font-family:verdana; font-size:11px; ".$bgcolor." '>
			<tr><td style='font-size:14px; color:#009966; font-weight:bold;'>".ucfirst($users[$i]['poll_title'])." </td></tr>
			<tr><td><strong>Status : </strong> ".$users[$i]['status']."</td></tr>
			<tr><td><strong>Options:</strong> </td></tr>
			<tr><td>Option1 : ".$users[$i]['option_one']." </td></tr>
			<tr><td>Option2 : ".$users[$i]['option_two']." </td></tr>
			<tr><td>Option3 : ".$users[$i]['option_three']." </td></tr>
			<tr><td><strong>Votes:</strong> </td></tr>
			<tr><td>Option1 : ".$users[$i]['vote_opt_one']." </td></tr>
			<tr><td>Option2 : ".$users[$i]['vote_opt_two']." </td></tr>
			<tr><td>Option3 : ".$users[$i]['vote_opt_three']." </td></tr>
			
			<tr><td>&nbsp;</td></tr>
			</table>
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
}
else
{
	print("<script>");
	print("alert('No Records Found');");
	print("self.location='index.php'");
	print("</script>");
}

?>