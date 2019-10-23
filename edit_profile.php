<?php
session_start();
 include_once 'lib/db.php';
 
 include_once 'lib/ise_settings.class.php';
 include_once 'lib/users_class.php';

 user_login_check();
 $settings = new ise_Settings();
 $users = new Users();

?>
<?php
$prof_obj = new SqlClass();
	if(!empty($_POST))
	{
		$prof_sql = "UPDATE ise_users SET user_fname = '".$_POST['fname']."', user_lname = '".$_POST['lname']."', user_gender = '".$_POST['gender']."', dob = '".$_POST['txtdob']."', mobile_no = '".$_POST['mobno']."', city = '".$_POST['city']."', state = '".$_POST['selstate']."', country = '".$_POST['selcountry']."', contact_method ='".$_POST['con_method']."', biography =  '".addslashes($_POST['biography'])."', interest = '".$_POST['interest']."' WHERE user_id = ".$_SESSION['user_id'];
		$prof_obj->executeSql($prof_sql);
		$_SESSION['msg'] = "<div class='success'>Profile Update Successfully</div>";
		$_SESSION['user_name'] =ucwords($_POST['fname'].' '.$_POST['lname']);
		
		echo '<script>parent.location.href="my_profile.php";</script>';
		
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo Site_Title; ?></title>
<link rel="stylesheet" href="css/site_styles.css" />
<!-- Javascript Part Starting-->
<script language="javascript" src="js/datetimepicker.js"></script>
<script language="javascript" src="js/check.js"></script>
<script>
function check()
{
	getForm('edit_profile');
	if(!IsEmpty("fname","Please Enter First Name"))return false;
	if(!IsEmpty("lname","Please Enter Last Name"))return false;
	if(!IsEmpty("txtdob","Please Select Date of Birth"))return false;
	if(!IsFurDate("txtdob","You Selected Future Date, Please Select Past Date"))return false;
	if(!IsCheckDOB("txtdob",10,"Your Age is lessthan 10 years."))return false;
	if(!IsEmpty("selcountry","Please Select Country"))return false;
	if(!IsEmpty("selstate","Please Select State"))return false;
	if(!IsEmpty("city","Please Enter City Name"))return false;
	if(!IsEmpty("mobno","Please Enter Mobile Number"))return false;
	if(!IsPhone_new("mobno",10,"Please Enter 10 Digits Mobile Number"))return false;
//	if(!IsEmpty("school","Please enter School"))return false;
}

	var xmlhttp;
	function state_onchange(str)
	{
		xmlhttp=GetXmlHttpObject();
		if (xmlhttp==null)
		  {
			  alert ("Browser does not support HTTP Request");
			  return;
		  }
		var url="state_change.php";
		url=url+"?cou="+str;
		//alert(url);
		xmlhttp.onreadystatechange=stateChanged;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
	}
	function stateChanged()
	{
		if (xmlhttp.readyState==4)
		{
			document.getElementById("txtstate").innerHTML=xmlhttp.responseText;
		}
	}
	function GetXmlHttpObject()
	{
		if (window.XMLHttpRequest)
		{
		  return new XMLHttpRequest();
		}
		if (window.ActiveXObject)
		{
		  return new ActiveXObject("Microsoft.XMLHTTP");
	    }
		return null;
	}
</script>
<!-- Javascript Part Ending-->

</head>
<?php
$user_details=$users->get_user_details($_SESSION['user_id']);
?>
<body style="background:none;">
<div>
<form action="#" method="post" enctype="multipart/form-data" name="edit_profile" id="edit_profile"  onsubmit="javascript:return check();">
  <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
      <tr>
        <td width="160" height="25" align="left"  style="border-bottom:#666666 dashed 1px;" valign="top" class="pad1 menu_headsmall"><strong>Personal Information</strong></td>
        <td  style="border-bottom:#666666 dashed 1px;">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" align="left" valign="top" class="teach_text">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" valign="middle" width="160" height="29"><span class="required">* </span>First Name:</td>
        <td align="left" valign="middle" class="web_font_19"><input name="fname" type="text" class="mine_text_field_7" id="fname" size="50" value="<?php echo $user_details['user_fname']; ?>" /></td>
      </tr>
      <tr>
        <td align="right" valign="middle" height="29"><span class="required">* </span>Last Name:</td>
        <td align="left" valign="middle" class="web_font_19"><input name="lname" type="text" class="mine_text_field_7" id="lname" size="50" value="<?php echo $user_details['user_lname']; ?>" /></td>
      </tr>
      <tr>
        <td align="right" valign="middle" height="29"><span class="required">* </span>D.O.B:</td>
        <td width="132" align="left" valign="middle" class="web_font_19"><table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tbody>
              <tr>
                <td width="150"><input class="mine_text_field_7" name="txtdob" id="txtdob" size="25" readonly="readonly" type="text" value="<?php echo $user_details['dob']; ?>"  /></td>
                <td align="left"><a href="javascript:NewCssCal('txtdob','yyyymmdd')"><img src="images/Calendarsmall.png" width="20" height="21" border="0" /></a></td>
              </tr>
            </tbody>
        </table></td>
      </tr>
      <tr>
        <td align="right" valign="middle" height="29"><span class="required">* </span>Country:</td>
        <td align="left" valign="middle" class="web_font_19"><?php if($_POST['selcountry']!=''){
													  echo $settings->country_onchange_select($_POST['selcountry']);
													  }else{
													  echo $settings->country_onchange_select($user_details['country']);
													  }?>        </td>
      </tr>
      <tr>
        <td align="right" valign="middle" height="29"><span class="required">* </span>State:</td>
        <td align="left" valign="middle" class="web_font_19"><div id="txtstate">
            <?php if($_POST['selstate']!=''){
						echo $settings->state_onchange_select($_POST['selcountry'],$_POST['selstate']);
					}else{
					echo $settings->state_onchange_select($user_details['country'],$user_details['state']);
					}
					?>
        </div></td>
      </tr>
      <tr>
        <td align="right" valign="middle" height="29"><span class="required">* </span>City / town:</td>
        <td align="left" valign="middle" class="web_font_19"><input name="city" type="text" class="mine_text_field_7" id="city" size="50" value="<?php echo $user_details['city']; ?>" /></td>
      </tr>
      <tr>
        <td align="right" valign="middle" height="29"><span class="required">* </span>Mobile No:</td>
        <td align="left" valign="middle" class="web_font_19"><input name="mobno" type="text" class="mine_text_field_7" id="mobno" size="50" value="<?php echo $user_details['mobile_no']; ?>" /></td>
      </tr>
      <tr>
        <td align="right" valign="middle" height="29"><span class="required">*</span> School:</td>
        <td align="left" valign="middle" class="web_font_19"><span class="teach_pad">
          <input name="school" type="text" class="mine_text_field_7" id="school" size="50" value="<?php echo ucwords($settings->get_school_name($user_details['school'])); ?>" disabled="disabled" />
        </span></td>
      </tr>
      <tr>
        <td align="right" valign="middle" height="29"><span class="required">*</span> Gender:</td>
        <td align="left" valign="middle" class="web_font_19"><input name="gender" id="con_method2" value="male" type="radio" <?php if($user_details['user_gender'] == 'male'){echo "checked";}?> />
          Male
            <input name="gender" id="con_method2" value="female" type="radio" <?php if($user_details['user_gender'] == 'female'){echo "checked";}?> />
          Female </td>
      </tr>


      <tr>
        <td align="right" valign="middle" height="29"><span class="required">*</span> Contact Method:</td>
        <td align="left" valign="middle" class="web_font_19">
        <input name="con_method" id="con_method" value="1" type="radio" <?php if($user_details['contact_method'] == '1'){echo "checked";}?> />
          Phone
          <input name="con_method" id="con_method" value="2" type="radio" <?php if($user_details['contact_method'] == '2'){echo "checked";}?> />
          Email </td>
      </tr>
      <tr>
        <td align="right" valign="middle" height="29">Biography:</td>
        <td align="left" valign="top" class="web_font_19"><textarea name="biography" id="biography" cols="40" rows="3"><?php echo stripslashes($user_details['biography']);?></textarea>        </td>
      </tr>
      <tr>
        <td align="right" valign="middle" height="29">Interest:</td>
        <td align="left" valign="top" class="web_font_19"><textarea name="interest" cols="40" rows="3" id="interest"><?php echo stripslashes($user_details['interest']);?></textarea>        </td>
      </tr>
      <tr>
        <td></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td></td>
        <td><input type="image" name="imageField" id="imageField" src="images/submit.jpg" /></td>
      </tr>
    </tbody>
  </table>
</form>
</div>
</body>
</html>
