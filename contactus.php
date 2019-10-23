<?php session_start();
	
	include_once 'lib/db.php';
	$objSql1 = new SqlClass();
	if(!empty($_POST))
	{
		$name = $_POST['fname'].' '.$_POST['lname'];
		$sql1 = "INSERT INTO contactus(first_name,last_name, e_mail, company_name, complete_address, Mobile, Fax, Subject, Comments, create_date, status)
				VALUES ( '".$_POST['fname']."', '".$_POST['lname']."','".$_POST['email']."', '".$_POST['compname']."', '".addslashes($_POST['addrs'])."',
				'".$_POST['phone']."', '".$_POST['fax']."', '".$_POST['subject']."', '".addslashes($_POST['comment'])."', NOW(), 'inactive')";
		 $objSql1->executeSql($sql1);
		 
		 $fromname = 'ismartexams.com';$fromaddress = 'admin@ismartexams.com' ;$toname = $name;
		 $toaddress = $_POST['email'];$subject = 'Thanks for Contacting Us';
		 $message = "Dear ".$name."<br><br>
			Your Contact Information Has Send to Admin. We Will Get back You soon <br><br>
			<br><br>
			Thanks for using Ismartexams. Let us know if you have questions by emailing <br>info@ismartexams.in
			<br><br>Ismartexams Team<br>
			info@ismartexams.in";
		sendMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);
		
		$_SESSION['msg'] = "<div class = 'success'>Your Information has been send to admin.</div>";
		print "<script>";
		print " self.location='contactus.php';";
		print "</script>"; 
		exit;
	}
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
<script language="javascript" src="js/check.js"></script>
<script language="javascript">
function check(){
		getForm("contact_form");
		if(!IsEmpty("fname","Please Enter First Name"))return false;
		if(!IsEmpty("lname","Please Enter Last Name"))return false;
		if(!IsEmpty("email","Please Enter Email"))return false;
		if(!IsEmail("email","Enter Valid Email"))return false;
		if(document.contact_form.phone.value!='')
		{
			if(!IsNumber("txtphone", "Phone Number Contains Only Numeric Values"))return false;
		}
		if(document.contact_form.fax.value!='')
		{
			if(!IsNumber("txtfax", "Fax Number Contains Only Numeric Values"))return false;
		}
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
        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
          <tr bgcolor="#F68122">
            <td width="6" style="background:url(images/sprite_05.jpg) left no-repeat;" height="27">&nbsp;</td>
            <td width="705" background="images/sprite_07.jpg" class="content_head" ><strong>Contact Us</strong></td>
            <td width="6" style="background:url(images/sprite_06.jpg) right no-repeat;" height="27">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" align="center" valign="top" class="sprite_padding_1 main_box_border">
            <form name="contact_form" action="" method="POST" onsubmit="return check();">
            <table width="90%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="27%" height="33" align="left"><span class="required">* </span>First Name: </td>
                <td width="73%" height="33" align="left"><span style="padding-left:4pt;">
                  <input name="fname" type="text"  id="fname" />
                </span></td>
              </tr>
              <tr>
                <td height="33" align="left"><span class="required">* </span>Last Name: </td>
                <td height="33" align="left"><span style="padding-left:4pt;">
                  <input name="lname" type="text"  id="lname" />
                </span></td>
              </tr>
              <tr>
                <td height="33" align="left"><span class="required">* </span>E-Mail: </td>
                <td height="33" align="left"><p><span style="padding-left:4pt;">
                    <input name="email" type="text"  id="email" />
                </span></p></td>
              </tr>
              <tr>
                <td height="33" align="left">Company Name: </td>
                <td height="33" align="left"><span style="padding-left:4pt;">
                  <input name="compname" type="text"  id="compname" />
                </span></td>
              </tr>
              <tr>
                <td height="33" align="left" valign="top">Complete Address: </td>
                <td height="33" align="left">&nbsp;<textarea name="addrs" id="addrs" cols="25" rows="5"></textarea></td>
              </tr>
              <tr>
                <td height="33" align="left">Telephone: </td>
                <td height="33" align="left"><span style="padding-left:4pt;">
                  <input name="phone" type="text"  id="phone" />
                </span></td>
              </tr>
              <tr>
                <td height="33" align="left">Fax: </td>
                <td height="33" align="left" ><span style="padding-left:4pt;">
                  <input name="fax" type="text"  id="fax" />
                </span></td>
              </tr>
              <tr>
                <td height="33" align="left">Subject: </td>
                <td height="33" align="left"><span style="padding-left:4pt;">
                  <input name="subject" type="text"  id="subject" />
                </span></td>
              </tr>
              <tr>
                <td height="33" align="left">Comments: </td>
                <td height="33" align="left">&nbsp;<textarea name="comment" id="comment" cols="25" rows="5"></textarea></td>
              </tr>
              <tr>
                <td height="33">&nbsp;</td>
                <td height="33" align="left"><input type="image" src="images/submit.jpg" width="80" height="27" /></td>
              </tr>
            </table></form></td>
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
