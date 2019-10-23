<?php
session_start();
 include_once 'lib/db.php';
 include_once 'lib/users_class.php';
 
 $users=new Users();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo Site_Title; ?></title>
<link rel="stylesheet" href="css/site_styles.css" />
<script language="javascript" src="js/check.js"></script>
<script language="javascript" >
	function check()
	{
		getForm("forget_pswd");
		if(!IsEmpty("type","Please Enter Email ID"))return false;
		if(!IsEmpty("txtemail","Please Enter Email ID"))return false;
		if(!IsEmail("txtemail","Please Enter Valid Email ID"))return false;
		
	}
</script>
</head>
<?php
	if($_POST['type']=='student')
	{
		$pswd_obj1 = new SqlClass();
		$sq = "SELECT user_id, user_fname, user_lname, user_email FROM ise_users WHERE user_email = '".$_POST['txtemail']."'";
		$recor = $pswd_obj1->executeSql($sq);

			$forget_array = $pswd_obj1->fetchRow($recor);
			
			if(is_array($forget_array))
			{
				$gen_code = $users->generateCode(8);
				
				$pswd_obj2 = new SqlClass();
				$sq2 = "UPDATE ise_users set password='".md5($gen_code)."' WHERE user_email = '".$_POST['txtemail']."' and user_id='".$forget_array['user_id']."'";
				$pswd_obj2->executeSql($sq2);
				//echo $up;
				
				$fromname = 'IsmartExams Team';
				$fromaddress = 'info@ismartexams.com';
				$toname =$forget_array['user_fname']." ".$forget_array['user_fname'];
				$toaddress = $forget_array['user_email'];$subject = 'Ismart Exams New password Details';
				$message = "Ismart Exams New Password Details <br>Full Name:".$forget_array['user_fname']." ".$forget_array['user_lname']."<br>
							Email ID : ".$forget_array['user_email']."<br> Password:".$gen_code;
				sendMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);
				$_SESSION['msg'] = "<div class='success'>New Password Send to Your Mail Id</div>";	
		   }
			else
			{
				$_SESSION['msg'] = "<div class='wrong'>Email ID not found in our database</div>";
			}
	}
	else if($_POST['type']=='school')
	{
		$pswd_obj1 = new SqlClass();
		$sq = "SELECT school_id, school_name, user_name FROM ise_schools WHERE user_name = '".$_POST['txtemail']."'";
		$recor = $pswd_obj1->executeSql($sq);

			$forget_array = $pswd_obj1->fetchRow($recor);
			
			if(is_array($forget_array))
			{
				$gen_code = $users->generateCode(8);
				
				$pswd_obj2 = new SqlClass();
				$sq2 = "UPDATE ise_schools set password='".md5($gen_code)."' WHERE user_name = '".$_POST['txtemail']."' and school_id='".$forget_array['school_id']."'";
				$pswd_obj2->executeSql($sq2);
				//echo $up;
				
				$fromname = 'IsmartExams Team';
				$fromaddress = 'info@ismartexams.com';
				$toname =$forget_array['school_name'];
				$toaddress = $forget_array['user_name'];$subject = 'Ismart Exams New password Details';
				$message = "Ismart Exams New Password Details <br>Full Name:".$forget_array['school_name']."<br>
							Email ID : ".$forget_array['user_name']."<br> Password:".$gen_code;
				sendMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);
				$_SESSION['msg'] = "<div class='success'>New Password Send to Your Mail Id</div>";	
		   }
			else
			{
				$_SESSION['msg'] = "<div class='wrong'>Email ID not found in our database</div>";
			}
	}
?>
<body style="background:none;">
<form id="forget_pswd" name="forget_pswd" method="post" action="#" onsubmit="javascript:return check();">
  <table width="450" border="0" cellspacing="0" cellpadding="7" style="border:#CC6600 thin dashed;" class="sprite_font_3">
    <tr>
      <td width="122" rowspan="3" align="center" id="change_pswd_err"><img src="images/forget_pswd.png" width="100" height="100" /></td>
      <td height="15" align="center" id="change_pswd_err"><?php echo ucwords($_SESSION['msg']); if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td>
    </tr>
     <tr>
      <td width="296">Type :
      <select name="type">
      	<option value="student">Student</option>
        <option value="school">School</option>
      </select></td>
    </tr>
    <tr>
      <td width="296">Enter Your Email ID :
      <input type="text" name="txtemail" id="txtemail" /></td>
    </tr>
    <tr>
      <td height="15" align="center" valign="middle"><input type="image" name="imageField" id="imageField" src="images/submit.jpg" /></td>
    </tr>
  </table>
</form>
</body>
</html>
