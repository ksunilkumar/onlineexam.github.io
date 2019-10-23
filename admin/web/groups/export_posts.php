<?php
session_start();
include_once '../../../lib/functions.php';
include_once '../../../lib/db.php';
include_once '../../../lib/functions_admin.php';
include_once '../../../lib/calss_qatar_groups.php';
include_once '../../../lib/calss_qatar_users.php';
$objSql1 = new SqlClass();
$grp_posts=new grp_posts();
$qatar_users = new qatar_users();
//admin_login_check();
//$blog = new Blog();
//$user = new User();
//echo $sql;
$qatar_groups = new qatar_groups();
	if(isset($_REQUEST['exprt']) && !empty($_REQUEST['exprt']))
	{
	
		$val = explode(',', $_REQUEST['exprt']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			$users=$grp_posts->display_grp_posts_all($_REQUEST['id']);
			//$users=$objSql1->executeSql($sql);
		}
	}
    else
	{
		$users=$grp_posts->display_grp_posts_all($_REQUEST['id']);
	}	

	if(is_array($users))
		{
		
				$filename ="groups_report".time().".doc";
				$title = "";
				$contents="<table align='center' border=1 width='100%' bordercolor='black' style='font-family:verdana; font-size:11px;'>
				<tr bgcolor='#72ACF3'><td colspan='2' height='30' align='center' style='font-size:14px;'><b>".Site_Title."</b></td></tr>
				<tr  bgcolor='#72ACF3'>
				<td>Search Criteria: Groups Posts</td> 
				<td>Total Records: ".count($users)."</td></tr>
				<tr><td colspan='2' align='center' style='color:#336699; font-size:16px;'><strong>Groups Posts</strong></td></tr>";
				
				for($i=0;$i<count($users);$i++)
				{
					if($i%2==0)
						$bgcolor=' background-color:#FFFFFF;';
					else
						$bgcolor=' background-color:#F4FCFF;';
					$contents.= "<tr><td colspan='2'>
					<table border=0 width='100%' style='font-family:verdana; font-size:11px; ".$bgcolor." '>
					
					<tr><td><strong>Status : ";
						$contents.=$users[$i]['status'];
					
					$contents.= "</strong> </td></tr>
					<tr><td style='padding-left:5px;'><strong>Post Message</strong>".$users[$i]['message']."</td></tr>
					<tr><td style='padding-left:5px;'><strong>Posted Date</strong>".$users[$i]['posted_date']."</td></tr>
					<tr><td style='padding-left:5px;'><strong>Post Username</strong>".$qatar_users->qatar_users_select('username','user_id',$users[$i]['user_id'])."</td></tr>
					<tr><td>&nbsp;</td></tr>";
				
				$contents.="</table>";

				$fp  =  fopen("../exports/".$filename,  'w+'); 
				$str  =  $contents; 
				fwrite($fp,  $str); 
				fclose($fp);

			print '<form action="view_posts.php" method="post" name="download_form">
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
			print("self.location='view_posts.php'");
			print("</script>");
		}
?>