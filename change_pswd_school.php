<?php
session_start();
 include_once 'lib/db.php';
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo Site_Title; ?></title>
<link rel="stylesheet" href="css/site_styles.css" />
<script type="text/javascript">
function pswd_change_check()
{
	opswd=(eval("document.change_pswd_form.old_pswd.value"));
	npswd=(eval("document.change_pswd_form.new_pswd.value"));
	ncpswd=(eval("document.change_pswd_form.new_cnfm_pswd.value"));

	if(opswd.length==0)
	{
		document.getElementById('change_pswd_err').innerHTML='<div class="wrong">Please Enter Old Password</div>';
		document.login_form.old_pswd.focus();
		return false;
	}
	else if(npswd.length==0)
	{
		document.getElementById('change_pswd_err').innerHTML='<div class="wrong">Please Enter New Password</div>';
		document.login_form.new_pswd.focus();
		return false;
	}
	else if(npswd.length<6)
	{
		document.getElementById('change_pswd_err').innerHTML='<div class="wrong">Enter New Password with more than 5 characters</div>';
		document.login_form.new_pswd.focus();
		return false;
	}
	else if(ncpswd.length==0)
	{
		document.getElementById('change_pswd_err').innerHTML='<div class="wrong">Please Enter Confirm Password</div>';
		document.login_form.new_cnfm_pswd.focus();
		return false;
	}
	else if(npswd!=ncpswd)
	{
		document.getElementById('change_pswd_err').innerHTML='<div class="wrong">Confirm password not match with password.</div>';
		document.login_form.new_cnfm_pswd.focus();
		return false;
	}
	else
	{
		document.change_pswd_form.submit();
	}
}
</script>
</head>
<?php
	if(isset($_POST['old_pswd']))
	{
			$pswd_obj1 = new SqlClass();
			$pswd_sql1 = "select school_id from ise_schools where school_id=".$_SESSION['user_id']." and password='".md5($_POST['old_pswd'])."'"; 
			$rs=$pswd_obj1->executeSql($pswd_sql1);
			if(is_array($rs))
			{
				$pswd_obj = new SqlClass();
				$pswd_sql = "UPDATE ise_schools SET password = '".md5($_POST['new_pswd'])."' WHERE school_id=".$_SESSION['user_id']; 
				$pswd_obj->executeSql($pswd_sql);
				$_SESSION['log_msg'] = "<div class='success'>Password Changed Successfully</div>";
				
				$fromname = 'ismartexmas.com';$fromaddress = 'admin@ismartexams.com' ;$toname = $_SESSION['user_name'];
				$toaddress = $_SESSION['user_email'];$subject = 'Ismart Exams Change Password Information';
				$message = "Dear ".$_SESSION['user_name']."<br><br>
					Your password has been changed! <br><br>
					User Name : ".$_SESSION['user_email']."<br>
					Password  :  ".$_POST['new_pswd']."<br>
					<br><br>
					Thanks for using Ismart Exams. Let us know if you have questions by emailing <br>info@ismartexams.com
					<br><br>IsmartExams Team<br>
					info@ismartexams.com";
				sendMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);
		  }
		  else
		  {
				$_SESSION['log_msg'] = "<div class='wrong'>Old Password is wrong</div>";
		  }
	 }
?>
<body style="background:none;">
<form id="change_pswd_form" name="change_pswd_form" method="post" action="#" onsubmit="javascript:return pswd_change_check();">
  <table width="350" border="0" cellspacing="0" cellpadding="7" style="border:#CC6600 thin dashed;" class="sprite_font_3">
    <tr>
      <td height="15" colspan="2" align="center" id="change_pswd_err"><?php echo ucwords($_SESSION['log_msg']); if(!empty($_SESSION['log_msg']))unset($_SESSION['log_msg']);?></td>
    </tr>
    <tr>
      <td align="right"><strong>Enter Old Password:</strong></td>
      <td><input type="password" name="old_pswd" id="old_pswd" /></td>
    </tr>
    <tr>
      <td width="169" align="right"><strong>Enter New Password:</strong></td>
      <td width="149"><input type="password" name="new_pswd" id="new_pswd" /></td>
    </tr>
    <tr>
      <td align="right"><strong>Enter Confirm Password:</strong></td>
      <td><input type="password" name="new_cnfm_pswd" id="new_cnfm_pswd" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><img src="images/submit.jpg" border="0" style="cursor:pointer;" onclick="javascript:return pswd_change_check();" /></td>
    </tr>
    <tr>
      <td colspan="2" height="15"></td>
    </tr>
  </table>
</form>
</body>
</html>
