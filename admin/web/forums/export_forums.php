<?php
session_start();
ob_start();

include_once '../../../lib/class_ise_forums.php';
include_once '../../../lib/ise_settings.class.php';
include_once '../../../lib/db.php';
$ise_settings = new ise_Settings();
$objSql1 = new SqlClass();
//admin_login_check();
//echo $sql;
if($_REQUEST['school']!='')
$sid=$_REQUEST['school'];

$forums=new Forums();
$forums1=new Forums();
if($_REQUEST['school']==''){
	if(isset($_REQUEST['exprt']) && !empty($_REQUEST['exprt']))
	{
		//$users='';
		$val = explode(',', $_REQUEST['exprt']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			$sql = "SELECT * FROM ise_forums WHERE forum_id='".$val[$i]."'";
			$users=$objSql1->executeSql($sql);
		}
	}
    else
	{
		$sql = "SELECT * FROM ise_forums ";
		$users=$objSql1->executeSql($sql);
	}	
}else{

  if(isset($_REQUEST['exprt']) && !empty($_REQUEST['exprt']))
	{
		//$users='';
		$val = explode(',', $_REQUEST['exprt']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			$sql = "SELECT * FROM ise_forums WHERE forum_id='".$val[$i]."' and school_id=".$sid."";
			$users=$objSql1->executeSql($sql);
		}
	}
    else
	{
		$sql = "SELECT * FROM ise_forums where school_id=".$sid;
		$users=$objSql1->executeSql($sql);
	}	








}

if(is_array($users))
{

$filename ="forums_report".time().".doc";
$title = "";
$school=$ise_settings->get_school_name($sid);
$contents="<table align='center' border=1 width='100%' bordercolor='black'>
<tr bgcolor='#72ACF3'><td colspan='6' height='30' align='center'><b>".Site_Title."</b></td></tr>
<tr bgcolor='#72ACF3'><td>Search Criteria:<br>";
if($sid!=''){
$contents.=$school;

$contents.='  School';
}
$contents.=" Forums</td> <td colspan='5'>Total Records: ".count($users)."</td></tr>
<tr bgcolor='#CCCCCC'><td>Forum Name </td> <td>Description </td><td>NoOf SubForums </td><td>NoOf Comments</td>
<td>Created Date</td></tr>";
for($i=0;$i<count($users);$i++)
{
$totalComments=$forums->totalNoOfforumcomments($users[$i]['forum_id']);
$totalEntries=$forums1->totalNoOfforums_export($users[$i]['forum_id']);
	$contents.= "<tr><td>".ucfirst($users[$i]['forum_name'])." </td><td>".ucfirst($users[$i]['forum_description'])." </td><td>".$totalEntries." </td>
	<td>".$totalComments." </td>
	<td>".$users[$i]['create_date']." </td></tr>";
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