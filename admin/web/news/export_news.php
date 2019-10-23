<?php
session_start();
include_once '../../../lib/functions.php';
include_once '../../../lib/db.php';
$objSql1 = new SqlClass();

//echo $sql;


	if(isset($_REQUEST['exprt']) && !empty($_REQUEST['exprt']))
	{
		//$users='';
		$val = explode(',', $_REQUEST['exprt']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			$sql = "SELECT * FROM news WHERE news_id='".$val[$i]."' ";
			$users=$objSql1->executeSql($sql);
		}
	}
    else
	{
			$sql = "SELECT * FROM news ";
			$users=$objSql1->executeSql($sql);
	}	


/*echo"<pre>";
print_r($users);*/
if(is_array($users))
{

$filename ="news_report".time().".doc";
$title = "";
		$contents="<table align='center' border=1 width='100%' bordercolor='black' style='font-family:verdana; font-size:11px;'>
		<tr bgcolor='#72ACF3'><td colspan='3' height='30' align='center' style='font-size:14px;'><b>Qatarsmarteducation News Report</b></td></tr>
		<tr  bgcolor='#72ACF3'>
		<td>Search Criteria: News</td> 
		<td>Total Records: ".count($users)."</td> <td>Date:  ".date('Y-m-d')."</td></tr>
		<tr><td colspan='3' align='center' style='color:#336699; font-size:16px;'><strong>News</strong></td></tr>";
		
		for($i=0;$i<count($users);$i++)
		{
			if($i%2==0)
				$bgcolor=' background-color:#FFFFFF;';
			else
				$bgcolor=' background-color:#F4FCFF;';
			$contents.= "<tr><td colspan='3'>
			<table border=0 width='100%' style='font-family:verdana; font-size:11px; ".$bgcolor." '>
			<tr><td style='font-size:14px; color:#009966; font-weight:bold;'>".ucfirst($users[$i]['news_title'])." </td></tr>
			<tr><td><strong>Status : ".$users[$i]['status']."</strong> </td></tr>
			<tr><td style='padding-left:5px;' align='justify'>".nl2br(ucfirst($users[$i]['news_desc']))." </td></tr>
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