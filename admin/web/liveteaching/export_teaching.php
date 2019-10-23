<?php
session_start();
include_once '../../../lib/functions.php';
include_once '../../../lib/db.php';
include_once '../../../lib/functions_admin.php';
include_once '../../../lib/calss_qatar_live_teach.php';
include_once '../../../lib/calss_qatar_users.php';
$qatar_live_teach = new qatar_live_teach();
$objSql1 = new SqlClass();
$qatar_users = new qatar_users();
	$members=new members();
//admin_login_check();
//$blog = new Blog();
//$user = new User();
//echo $sql;

	if(isset($_REQUEST['exprt']) && !empty($_REQUEST['exprt']))
	{
	
		$val = explode(',', $_REQUEST['exprt']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			$sql = "SELECT * FROM qatar_online_class WHERE online_cid='".$val[$i]."' and school_id=".$_SESSION['school_id']."";
			$users=$objSql1->executeSql($sql);
		}
	}
    else
	{
		$sql = "SELECT * FROM qatar_online_class where school_id=".$_SESSION['school_id']."";
		$users=$objSql1->executeSql($sql);
	}	

	if(is_array($users))
		{
		
				$filename ="text_report".time().".doc";
				$title = "";
				$contents="<table align='center' border=1 width='100%' bordercolor='black' style='font-family:verdana; font-size:11px;'>
				<tr bgcolor='#72ACF3'><td colspan='2' height='30' align='center' style='font-size:14px;'><b>".Site_Title."</b></td></tr>
				<tr  bgcolor='#72ACF3'>
				<td>Search Criteria: Live Teaching</td> 
				<td>Total Records: ".count($users)."</td></tr>
				<tr><td colspan='2' align='center' style='color:#336699; font-size:16px;'><strong>Live Teaching</strong></td></tr>";
				
				for($i=0;$i<count($users);$i++)
				{
					if($i%2==0)
						$bgcolor=' background-color:#FFFFFF;';
					else
						$bgcolor=' background-color:#F4FCFF;';
					$contents.= "<tr><td colspan='2'>
					<table border=0 width='100%' style='font-family:verdana; font-size:11px; ".$bgcolor." '>
					<tr><td style='font-size:14px; color:#009966; font-weight:bold;'><strong>Class Title:</strong>".ucfirst($users[$i]['title'])." </td></tr>
					<tr><td><strong>Status : ";
						$contents.=ucfirst($users[$i]['status']);
						$mem_count=$qatar_live_teach->qatar_live_teach_members_select("count(*) count",online_cid,$users[$i]['online_cid']);
						$comments_count=$qatar_live_teach->qatar_live_teach_comm_select("count(*) count",online_cid,$users[$i]['online_cid']);
						$contents.= "</strong> </td></tr>
					<tr><td style='padding-left:5px;'><strong> About Class:</strong>".$users[$i]['about_class']."</td></tr>
					<tr><td style='padding-left:5px;'><strong>Price:</strong>".$users[$i]['price']."</td></tr>
					<tr><td style='padding-left:5px;'><strong>Duration:</strong>".$users[$i]['duration']."</td></tr>	
					<tr><td style='padding-left:5px;'><strong>Class Start Date:</strong>".$users[$i]['class_start_date']."</td></tr>
					<tr><td style='padding-left:5px;'><strong>Class Members:</strong>".$qatar_live_teach->qatar_live_teach_members_select("count(*) count",online_cid,$users[$i]['online_cid'])."</td></tr>
					<tr><td style='padding-left:5px;'><strong>Class Comments:</strong>".$qatar_live_teach->qatar_live_teach_comm_select("count(*) count",online_cid,$users[$i]['online_cid'])."</td></tr>
				
					<tr><td>&nbsp;</td></tr>";
					if($mem_count!=0){
						$mem=$members->display_members_all($users[$i]['online_cid']);
						
						$contents.="<tr><td><table>";
						$contents.="<tr><td style='font-size:14px; color:#009966; font-weight:bold;' align='center'><strong>Group Members </strong></td></tr>";
						if(is_array($mem)){
						foreach($mem as $mems){
						$contents.="<tr><tdstyle='padding-left:5px;'><strong> User Name :".$qatar_users->user_name_two($mems['user_id'])."</strong></td></tr>";
						$contents.="<tr><tdstyle='padding-left:5px;'><strong> Status :".$mems['status']."</strong></td></tr>";
						}}
						$contents.="</table></td></tr>";
					}
					if($comments_count!=0){
					$comments=new comments();
						$comments1=$comments->display_comments_all($users[$i]['online_cid']);
						
						$contents.="<tr><td><table>";
						$contents.="<tr><td style='font-size:14px; color:#009966; font-weight:bold;' align='center'><strong>Group Comments </strong></td></tr>";
						if(is_array($comments1)){
						foreach($comments1 as $comments){
						$contents.="<tr><tdstyle='padding-left:5px;'><strong> Comment :".$comments['comment']."</strong></td></tr>";
						$contents.="<tr><tdstyle='padding-left:5px;'><strong> Status :".$comments['status']."</strong></td></tr>";
						}}
						$contents.="</table></td></tr>";
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
		}
		else
		{
			print("<script>");
			print("alert('No Records Found');");
			print("self.location='index.php'");
			print("</script>");
		}
?>