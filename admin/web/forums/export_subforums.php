<?php
session_start();
ob_start();

include_once '../../../lib/class_ise_forums.php';
include_once '../../../lib/db.php';
$objSql1 = new SqlClass();
$forums=new Forums();
 $sql = "SELECT forum_name FROM ise_forums WHERE forum_id=".$_REQUEST['forumid']."";
$forum=$objSql1->executeSql($sql);

 $fname=$forum[0]['forum_name'];

//echo $sql;

	if(isset($_REQUEST['exprt']) && !empty($_REQUEST['exprt']))
	{
		//$users='';
		
		$val = explode(',', $_REQUEST['exprt']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			$sql = "SELECT * FROM ise_forums WHERE forum_id='".$val[$i]."' and forum_state=".$_REQUEST['forumid']."";
			$objSql12 = new SqlClass();
			$users=$objSql12->executeSql($sql);
		}
	}
    else
	{
		$sql = "SELECT * FROM ise_forums where forum_state=".$_REQUEST['forumid']."";
		$objSql3 = new SqlClass();
		$users=$objSql3->executeSql($sql);
	}	


if(is_array($users))
{

$filename ="subforums_report".time().".doc";
$title = "";
$contents="<table align='center' border=1 width='100%' bordercolor='black'>
<tr bgcolor='#72ACF3'><td colspan='4' height='30' align='center'><b>IsmartExams Subforums Report</b></td></tr>
<tr bgcolor='#72ACF3'>
<td>Search Criteria: Sub Forums</td>
 <td>Total Records: ".count($users)."</td>
  <td>Date:  ".date('Y-m-d')."</td>
  <td></td>
 </tr>
<tr><td colspan='4'>Main Forum:  ".ucfirst($fname)."</td></tr>
<tr bgcolor='#CCCCCC'><td>Sub Forum Name </td> <td>Description </td>
<td>No Of Comments</td>
<td>Created Date</td></tr>
";
for($i=0;$i<count($users);$i++)
{
$totalEntries=$forums->totalNoOfforumcomments($users[$i]['forum_id']);
	$contents.= "<tr><td>".ucfirst($users[$i]['forum_name'])." </td><td>".ucfirst($users[$i]['forum_description'])." </td>
	<td>".$totalEntries." </td>
	<td>".$users[$i]['create_date']." </td></tr>";
}
$contents.="</table>";
				$fp  =  fopen("../exports/".$filename,  'w+'); 
				$str  =  $contents; 
				fwrite($fp,  $str); 
				fclose($fp);

			print '<form action="subforums.php?id='.$_REQUEST['forumid'].'" method="post" name="download_form">
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
	print("self.location='subforums.php?id=".$_REQUEST['forumid']."'");
	print("</script>");
}

?>