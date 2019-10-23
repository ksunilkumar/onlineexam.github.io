<?php
session_start();
include_once '../../../lib/functions.php';
include_once '../../../lib/db.php';
include_once '../../../lib/functions_admin.php';
include_once '../../../lib/calss_qatar_live_teach.php';
include_once '../../../lib/functions.php';
$qatar_live_teach = new qatar_live_teach();
$objSql1 = new SqlClass();
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
			$sql = "SELECT * FROM contact WHERE id ='".$val[$i]."'";
			$users=$objSql1->executeSql($sql);
		}
	}
    else
	{
		$sql = "SELECT * FROM contact";
		$users=$objSql1->executeSql($sql);
	}	

	if(is_array($users))
		{
		
				$filename ="text_feedback".time().".doc";
				$title = "";
				$contents="<table align='center' border=1 width='100%' bordercolor='black' style='font-family:verdana; font-size:11px;'>
				<tr bgcolor='#72ACF3'><td colspan='2' height='30' align='center' style='font-size:14px;'><b>".Site_Title."</b></td></tr>
				<tr  bgcolor='#72ACF3'>
				<td>Search Criteria: Feedback</td> 
				<td>Total Records: ".count($users)."</td></tr>
				<tr><td colspan='2' align='center' style='color:#336699; font-size:16px;'><strong>Contact Us</strong></td></tr>";
				
				for($i=0;$i<count($users);$i++)
				{
					if($i%2==0)
						$bgcolor=' background-color:#FFFFFF;';
					else
						$bgcolor=' background-color:#F4FCFF;';
					$user=new Users();
					$arr=$user->qatar_users_selectall('user_id',$users[$i]['userid']);	
						
					$contents.= "<tr><td colspan='2'>
					<table border=0 width='100%' style='font-family:verdana; font-size:11px; ".$bgcolor." '>
					<tr><td style=' font-weight:bold;'><strong>UserName:</strong>".ucfirst($arr['user_name'])." </td></tr>
					<tr><td><strong>Status : ";
						$contents.=ucfirst($users[$i]['status']);
						$contents.= "</strong> </td></tr>
					<tr><td style='padding-left:5px;'><strong> FeedBack:</strong>".$users[$i]['fb_message']."</td></tr>
					<tr><td style='padding-left:5px;'><strong>Create Date :</strong>".$users[$i]['create_date']."</td></tr>
					
					
					<tr><td>&nbsp;</td></tr>";
				
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