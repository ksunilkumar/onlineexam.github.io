<?php
session_start();
 include_once 'lib/db.php';
 
 include_once 'lib/ise_settings.class.php';

 $settings = new ise_Settings();
 
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo Site_Title; ?></title>
<link rel="shortcut icon" href="favicon.png" type="image/x-icon" />

<!--CSS/Style Sheet Part Starting-->
<link rel="stylesheet" href="css/site_styles.css" />
<!--CSS/Style Sheet Part Ending-->

<!-- Javascript Part Starting-->
<script language="javascript" src="js/datetimepicker.js"></script>
<script language="javascript" src="js/check.js"></script>
<script>
function check()
{
	getForm('user_register');
	if(!IsEmpty("email","Please Enter Email ID"))return false;
	if(!IsEmail("email","Please Enter valid Email ID"))return false;
	if(!IsEmpty("password","Please Enter Password"))return false;
	//if(!ChkLength("password",6,"Please enter atleast 6 charecters"));return false;
	if(!IsEmpty("conpassword","Please Enter Confirm Password"))return false;
	if(!IsSame("password","conpassword","Confirm Password did not match with Password"))return false;
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
	if(!IsEmpty("selschool","Please Select School Name"))return false;

		var flag=0;
		for(var i=0; i < document.user_register.gender.length; i++)
		{
			if(document.user_register.gender[i].checked)
			{
				var gender=document.user_register.gender[i].value;
				var flag=1;
			}
		}

		if(flag==0){alert("Please select Gender"); document.user_register.gender[0].focus(); return false;}

		for(var i=0; i < document.user_register.con_method.length; i++)
		{
			if(document.user_register.con_method[i].checked)
			{
				var contact_method=document.user_register.con_method[i].value;
				var flag=2;
			}
		}
		
		if(flag!=2){alert("Please select Contact Method"); document.user_register.con_method[0].focus(); return false;}
		if(!IsEmpty("security_code","Please Enter Security Code"))return false;
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

<body>
<?php include 'includes/light_box.php'; ?>

<!-- Main Table with 3 columns -->
<table width="947" border="0" align="center" cellpadding="0" cellspacing="0">
<!-- Header Row Content -->
<?php
include_once 'includes/header.php';
?>
<!-- Header Row Content -->

<!-- Breadcrum() -->
<tr><td colspan="3" align="left" style="padding:5px; background-image:url(images/sprite_01.jpg); background-repeat:repeat-x;">&nbsp;<?php breadcrum(); ?></td></tr>
<!-- Breadcrum()-->

<!-- Middle Row Content -->
<tr>
   <td colspan="3" bgcolor="#FFFFFF" class="sprite_padding_1">

    <table width="100%" border="0" cellspacing="0" cellpadding="0" height="200">
      <tr>
        <!-- Left Coloumn Code -->
        <td width="185" style="padding-left:0px; padding-right:0px;" valign="top"><?php include_once 'tab_01_templete.php'; ?><?php include_once 'tab_03_templete.php'; ?></td>
        <!-- Center Coloumn Code -->
        
        <td width="*" style="padding-left:6px; padding-right:6px;" valign="top">
        <?php echo ucwords($_SESSION['msg']); if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
          <tr bgcolor="#F68122">
            <td width="6" style="background:url(images/sprite_05.jpg) left no-repeat;" height="27">&nbsp;</td>
            <td width="705" background="images/sprite_07.jpg" class="content_head" ><strong>Registration</strong></td>
            <td width="6" style="background:url(images/sprite_06.jpg) right no-repeat;" height="27">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top" class="sprite_padding_1 main_box_border" >
            <div>
             <form name="user_register" action="user_register.php" method="POST" onsubmit="return check()" enctype="multipart/form-data">
              <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                  <tr>
                    <td height="40" colspan="3" align="left" style="border-bottom: 1px solid rgb(153, 153, 153);" span="span" class="font_77"><span class="font_78">Complete your personal profile</span><br />
                        <span class="font_2">(<span class="required">* </span> mark fields are required)</span></td>
                  </tr>
                  <tr>
                    <td colspan="3" align="left" valign="top" height="25">&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="tech_bdr" align="left" valign="top" width="503" height="152"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                          <tr>
                            <td colspan="2" class="teach_text20" align="center" bgcolor="#999999"></td>
                          </tr>
                          <tr>
                            <td width="160" height="25" align="left" valign="top" class="menu_headsmall"><strong>Create Student Account</strong></td>
                            <td width="337">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="teach_text" align="left" valign="middle" height="35"><span class="required">* </span>Email ID:</td>
                            <td align="left"><input name="email" type="text" class="mine_text_field_7" id="email" size="50" />
                              <a href="#"></a>
                                <div id="username_availability_result"></div></td>
                            </tr>
                          <tr>
                            <td class="teach_text" align="left" valign="top" height="35"><span class="required">* </span>Password:<br />
                              (6-32 characters)</td>
                            <td align="left" valign="top"><input name="password" type="password" class="mine_text_field_7" id="password" size="50" /></td>
                          </tr>
                          <tr>
                            <td class="teach_text" align="left" valign="top" height="35"><span class="required">* </span>Re-enter Password:<br />
                              (6-32 characters)</td>
                            <td align="left" valign="top" class="teach_pad"><input name="conpassword" type="password" class="mine_text_field_7" id="conpassword" size="50" /></td>
                          </tr>
                        </tbody>
                    </table></td>
                    <td class="tech_bdr" align="left" valign="top" width="22"><img src="images/teach_com.gif" width="15" height="14" /></td>
                    <td class="teach_text teach_pad tech_bdr" align="left" valign="top" width="185"><strong>What is an Email ID?</strong><br />
                        <span class="teach_text1">You will use your Email ID to access certain information and resources, or to register for an event.</span></td>
                  </tr>
                  
                  <tr>
                    <td class="tech_bdr" align="left" valign="top" height="152"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                          <tr>
                            <td width="160" height="25" align="left"  style="border-bottom:#666666 dashed 1px;" valign="top" class="pad1 menu_headsmall"><strong>Personal Information</strong></td>
                            <td colspan="2"  style="border-bottom:#666666 dashed 1px;">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="3" align="left" valign="top" class="teach_text">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="teach_text" align="left" valign="top" width="160" height="35"><span class="required">* </span>First Name:</td>
                            <td colspan="2" align="left" valign="top"><input name="fname" type="text" class="mine_text_field_7" id="fname" size="50" /></td>
                          </tr>
                          <tr>
                            <td class="teach_text" align="left" valign="top" height="35"><span class="required">* </span>Last Name:</td>
                            <td colspan="2" align="left" valign="top"><input name="lname" type="text" class="mine_text_field_7" id="lname" size="50" /></td>
                          </tr>
                          <tr>
                            <td class="teach_text" align="left" valign="top" height="35"><span class="required">* </span>D.O.B:</td>
                            <td width="132" colspan="2" align="left" valign="top"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                  <tr>
                                    <td width="150"><input class="mine_text_field_7" name="txtdob" id="txtdob" size="25" readonly="readonly" type="text" /></td>
                                    <td align="left"><a href="javascript:NewCssCal('txtdob','yyyymmdd')"><img src="images/Calendarsmall.png" width="20" height="21" border="0" /></a></td>
                                  </tr>
                                </tbody>
                            </table></td>
                          </tr>
                          <tr>
                            <td class="teach_text" align="left" valign="top" height="35"><span class="required">* </span>Country:</td>
                            <td colspan="2" align="left" valign="top">
                            <?php if($_POST['selcountry']!=''){
													  echo $settings->country_onchange_select($_POST['selcountry']);
													  }else{
													  echo $settings->country_onchange();
													  }?>                          </td>
                          </tr>
                          <tr>
                            <td class="teach_text" align="left" valign="top" height="35"><span class="required">* </span>State:</td>
                            <td colspan="2" align="left" valign="top"><div id="txtstate">
                                                    <?php if($_POST['selstate']!=''){echo $settings->state_onchange($_POST['selstate']);}else{?>
                                                      <select name="selstate">
                                                        <option value=''>Select State</option>
                                                      </select><?php }?>
                                                      </div></td>
                          </tr>
                          <tr>
                            <td class="teach_text" align="left" valign="top" height="35"><span class="required">* </span>City / town:</td>
                            <td colspan="2" align="left" valign="top"><input name="city" type="text" class="mine_text_field_7" id="city" size="50" /></td>
                          </tr>
                          <tr>
                            <td class="teach_text" align="left" valign="top" height="35"><span class="required">* </span>Mobile No:</td>
                            <td colspan="2" align="left" valign="top" class="teach_pad"><input name="mobno" type="text" class="mine_text_field_7" id="mobno" size="50" /></td>
                          </tr>
                          <tr>
                            <td class="teach_text" align="left" valign="top" height="35"><span class="required">* </span>School:</td>
                            <td colspan="2" align="left" valign="top"><?php if($_POST['selschool']!=''){
													  echo $settings->get_sel_schools($_POST['selschool']);
													  }else{
													  echo $settings->get_schools();
													  }?>
                            </td>
                          </tr>
                          <tr>
                            <td class="teach_text" align="left" valign="top" height="35">Upload Image:</td>
                            <td colspan="2" align="left" valign="top"><input name="pic" type="file" id="pic" /></td>
                          </tr>
                          <tr>
                            <td class="teach_text" align="left" valign="top" height="35"><span class="required">*</span> Gender:</td>
                            <td colspan="2" align="left" valign="top" class="teach_text"><input name="gender" id="gender" value="male" type="radio" />
                              Male
                              <input name="gender" id="gender" value="female" type="radio" />
                              Female </td>
                          </tr>
                          <tr>
                            <td class="teach_text" align="left" valign="top" height="35"><span class="required">*</span> Contact Method :</td>
                            <td colspan="2" align="left" valign="top" class="teach_text"><input name="con_method" id="con_method" value="1" type="radio" />
                              Phone
                              <input name="con_method" id="con_method" value="2" type="radio" />
                              Email </td>
                          </tr>
                          <tr>
                            <td class="teach_text" align="left" valign="top" height="35">Biography</td>
                            <td colspan="2" align="left" valign="top"><textarea name="biography" id="biography" cols="40" rows="4"></textarea>                            </td>
                          </tr>
                          <tr>
                            <td class="teach_text" align="left" valign="top" height="35">Interest:</td>
                            <td colspan="2" align="left" valign="top"><textarea name="interest" cols="40" rows="4" id="interest"></textarea>                            </td>
                          </tr>
                          <tr>
                            <td></td>
                            <td colspan="2">&nbsp;</td>
                          </tr>
                          
                          <tr>
                            <td class="teach_text" align="left" valign="top" height="35"><span class="required">* </span>Security Code</td>
                            <td><input name="security_code" type="text" class="mine_text_field_6" id="security_code" maxlength="32" /></td>
                            <td><img src="js/captcha.php?width=100&height=35&characters=6" /></td>
                          </tr>
                          <tr>
                    <td colspan="3" align="center"><input type="image" src="images/submit.jpg" width="89" height="31" border="0" value="Submit" /></td>
                  </tr>
                        </tbody>
                    </table></td>
                    <td class="tech_bdr pad1" align="left" valign="top" width="22"><img src="images/teach_com.gif" width="15" height="14" /></td>
                    <td class="teach_text pad1 tech_bdr" align="left" valign="top" width="185"><strong>Your Contact Information</strong><br />
                        <span class="teach_text1">To ensure your registration is processed 
                          properly, enter your real first and last name and refrain from using 
                          aliases or organization names within the name fields.<br />
                                <br />
                          Your privacy is a priority at Teacher, and we go to great lengths to 
                          protect it. To learn how Teacher safeguards your personal information</span></td>
                  </tr>
                  
                </tbody>
              </table>
            
            </form>
            </div>
            </td>
          </tr>
        </table>
        </td>
        <!-- Right Coloumn Code -->
        <td width="0" style="padding-left:0px; padding-right:0px;" valign="top"></td>
      </tr>
    </table>

  </td>
</tr>
<!-- Middle Row Content -->

<!-- Footer Row Content -->
<?php
include_once 'includes/footer.php';
?>
<!-- Footer Row Content -->

</table>
<!-- Main Table Ending -->
</body>
</html>
