<?php
session_start();
include_once '../../../lib/functions.php';
include_once '../../../lib/db.php';
include_once '../../../lib/functions_admin.php';
include_once '../../../lib/class_ise_groups.php';
include_once '../../../lib/class_ise_group_members.php';
include_once '../../../lib/ise_settings.class.php';
$ise_group_members = new ise_group_members();
$objSql1 = new SqlClass();
//admin_login_check();
//$blog = new Blog();
//$user = new User();
//echo $sql;
$ise_settings=new ise_Settings();
$ise_groups = new ise_groups();
	if(isset($_REQUEST['exprt']) && !empty($_REQUEST['exprt']))
	{
	
		$val = explode(',', $_REQUEST['exprt']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			$sql = "SELECT * FROM ise_groups WHERE group_id='".$val[$i]."'";
			$users=$objSql1->executeSql($sql);
		}
	}
    else
	{
		$sql = "SELECT * FROM ise_groups ";
		$users=$objSql1->executeSql($sql);
	}	


	if(is_array($users))
		{
		
				$filename ="groups_report".time().".doc";
				$title = "";
				$contents="<table align='center' border=1 width='100%' bordercolor='black' style='font-family:verdana; font-size:11px;'>
				<tr bgcolor='#72ACF3'><td colspan='2' height='30' align='center' style='font-size:14px;'><b>".Site_Title."</b></td></tr>
				<tr  bgcolor='#72ACF3'>
				<td>Search Criteria: Groups</td> 
				<td>Total Records: ".count($users)."</td></tr>
				<tr><td colspan='2' align='center' style='color:#336699; font-size:16px;'><strong>Groups</strong></td></tr>";
				
				for($i=0;$i<count($users);$i++)
				{ 
					if($i%2==0)
						$bgcolor=' background-color:#FFFFFF;';
					else
						$bgcolor=' background-color:#F4FCFF;';
					$contents.= "<tr><td colspan='2'>
					<table border=0 width='100%' style='font-family:verdana; font-size:11px; ".$bgcolor." '>
					
					<tr><td><strong>Status :&nbsp; ";
						$contents.=$users[$i]['status'];
						if($ise_settings->get_school_name($users[$i]['school_id'])!='')
					$school=$ise_settings->get_school_name($users[$i]['school_id']);
					else
					$school='Not Available';
					$noofusers=$ise_groups->ise_groups_memb_select("count(*) as count","group_id", $users[$i]['group_id']);
					$noofcomments=$ise_group_members->ise_group_post_select("count(*) as count","group_id",$users[$i]['group_id']);
					$contents.= "</strong> </td></tr>
					<tr><td style='padding-left:5px;'><strong>Group Name:&nbsp;</strong>".$users[$i]['group_name']."</td></tr>
					<tr><td style='padding-left:5px;'><strong>No Of Users:&nbsp;</strong>".$noofusers."</td></tr>
					<tr><td style='padding-left:5px;'><strong>School:&nbsp;</strong> ".$school."</td></tr>
					<tr><td style='padding-left:5px;'><strong>No Of Comments:&nbsp;</strong>".$noofcomments."</td></tr>
					
					<tr><td>&nbsp;</td></tr>";
				
				$contents.="</table>";
//echo $contents;exit;
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
		}
		else
		{
			print("<script>");
			print("alert('No Records Found');");
			print("self.location='index.php'");
			print("</script>");
		}
?>