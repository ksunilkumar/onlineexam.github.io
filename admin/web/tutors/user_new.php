<?php 
	session_start();
	include_once '../../../lib/functions.php';
		include_once '../../../lib/functions_admin.php';

	include_once '../../../lib/db.php';
	admin_login_check();
	$settings = new Settings();
	$course = new Course();
	$objSql1 = new SqlClass();
	$objSql = new SqlClass();
	if(!empty($_POST))
	{
		define ("MAX_SIZE","50"); 
		 function getExtension($str) 
		 {
			 $i = strrpos($str,".");
			 if (!$i) { return ""; }
			 $l = strlen($str) - $i;
			 $ext = substr($str,$i+1,$l);
			 return $ext;
		 }
		$sq = "SELECT user_id FROM ml_professors WHERE user_email = '".$_POST['txtuser_email']."'";
		$recor = $objSql->executeSql($sq);
		$row13 = $objSql->fetchRow($recor);
		if(empty($row13['user_id']))
		{
			$error = '0';
			
			$image=$_FILES['image']['name'];
			if($image != '')
			{
				$filename = stripslashes($_FILES['image']['name']);
				$extension = getExtension($filename);
				$extension = strtolower($extension);
				$size=filesize($_FILES['image']['tmp_name']);
				if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
				{
					$_SESSION['msg'] = "<font size='3' color='#0099FF'>Unknown Course Image extension ( ".$extension." )! Please Upload Onely png, jpg, jpeg, gif Image</font>";
					$error = '1';
				}
				if($error == '0')
				{
					$image_name=time().".".$extension;
					$newname="../../../uploads/professor_images/".$image_name;
					$copied = copy($_FILES['image']['tmp_name'], $newname);
				}
			}
		
				
			 $sql1 = "INSERT INTO ml_professors(user_email,user_fname, user_lname,image, gender, dob,
						   	mobile, qualification,working_filed,experience,Languages, create_date, status)
						VALUES ( '".addslashes($_POST['txtuser_email'])."', '".addslashes($_POST['txtfname'])."', '".$_POST['txtlname']."', '".$image_name."', '".$_POST['gender']."', '".$_POST['txtdob']."', 
						'".$_POST['txtmoblie']."', '".addslashes($_POST['Qualification'])."', '".$_POST['working_filed']."', '".$_POST['experience']."', 
						'".$_POST['Languages']."', NOW(), 'active')";
						
				$objSql1->executeSql($sql1);
				
				$_SESSION['msg'] = "<font size='2' color='#0099FF'>Professor Added Successfully</font>";
				print "<script>";
				print " self.location='index.php';";
				print "</script>"; 
				exit;
			
		}else
		{
			$_SESSION['msg'] = "<font size='2' color='#0099FF'>Email Already Exists</font>";
		}
	}
$date=date('d-m-Y');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link rel="stylesheet" href="../css/screen.css" type="text/css" media="all"/> 
<link href="../css/datepicker.css" rel="stylesheet" type="text/css" media="all"/> 
<link rel="stylesheet" href="../css/tipsy.css" type="text/css" media="all"/> 
<link rel="stylesheet" href="../js/jwysiwyg/jquery.wysiwyg.css" type="text/css" media="all"/> 
<link href="../js/visualize/visualize.css" rel="stylesheet" type="text/css" media="all"/> 
<link rel="stylesheet" type="text/css" href="../js/fancybox/jquery.fancybox-1.3.0.css" media="screen"/> 
 
<!--[if IE 7]>
	<link href="css/ie7.css" rel="stylesheet" type="text/css" media="all">
<![endif]--> 
 
<!--[if IE]>
	<script type="text/javascript" src="js/excanvas.js"></script>
<![endif]--> 
 
<!-- Jquery and plugins --> 
<script type="text/javascript" src="../js/jquery.js"></script> 
<script type="text/javascript" src="../js/jquery-ui.js"></script> 
<script type="text/javascript" src="../js/jquery.img.preload.js"></script> 
<script type="text/javascript" src="../js/fancybox/jquery.fancybox-1.3.0.js"></script> 
<script type="text/javascript" src="../js/jwysiwyg/jquery.wysiwyg.js"></script> 
<script type="text/javascript" src="../js/hint.js"></script> 
<script type="text/javascript" src="../js/visualize/jquery.visualize.js"></script> 
<script type="text/javascript" src="../js/jquery.tipsy.js"></script> 
<script type="text/javascript" src="../js/browser.js"></script> 
<script type="text/javascript" src="../js/custom.js"></script> 
<link href="../../images/style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../../../script/calendar.js"></script>
<script language="javascript">
	var cal = new CalendarPopup();
	cal.showYearNavigation();
</script>
<script language="javascript" src="../../../script/check.js"></script>
<script language="javascript">
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
	function check(){
		/*if(!confirm('Are you sure you want to add the user?\n- to Add the User, hit OK\n- otherwise, hit Cancel'))
		return false;*/
		getForm("new_user");
		
		if(!IsEmpty("txtuser_email","Please Enter  Email"))return false;
		if(!IsEmail("txtuser_email","Please Enter Valid  Email"))return false;
		if(!IsEmpty("txtfname","Please Enter First Name"))return false;
		if(!IsEmpty("txtlname","Please Enter last Name"))return false;
		if(!IsEmpty("image","Please Upload Image"))return false;
		
		if(!IsEmpty("txtdob","Please Select Date of Birth"))return false;
		
		
		if(!IsFutureDate('txtdob')) return false;
		if(!IsEmpty("txtmobile","Please Enter Mobileno"))return false;
		//if(!IsPhone_new("txtmobile", "Phone Number Contains Only Numeric Values"))return false;
		if(!IsPhone_new("txtmobile",10,"Please Enter valid Phone Number"))return false;

		
		if(!IsEmpty("Qualification","Please Enter Qualification"))return false;
		if(!IsEmpty("working_filed","Please Enter working Filed"))return false;
		if(!IsEmpty("experience","Please Enter experience"))return false;
		if(!IsEmpty("Languages","Please Enter Languages"))return false;
		
	}



</script>
<script src="../../../script/check.js"></script>
<script type="text/javascript" src="../../../script/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" language="javascript">
tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	elements : "elm1",
    theme_advanced_toolbar_location : "top",
	theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,forecolorpicker,backcolorpicker,bullist,numlist,link,unlink,blockquote,code",
	theme_advanced_buttons2 : "fontselect,fontsizeselect,formatselect,removeformat,forecolor,cleanup,backcolor",
	theme_advanced_buttons3 : ""
});
</script>
</head>
<body>
	</form>
	<?php include"../header.php";?>
    <?php  include '../left.php'; ?>
    <br class="clear"/> 
		
		<!-- Begin content --> 
		<div id="content_wrapper" style="margin-right:30px;"> 
		
			<!-- Begin one column box --> 
		
			
			<!-- Begin 1st level tab --> 
			<ul class="first_level_tab"> 
			
				<!--<li> 
					<a href=""> 
						Graph
					</a> 
				</li> 
				<li> 
					<a href=""> 
						Form Elements
					</a> 
				</li> -->
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/> 
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				<div class="content nomargin"  > 
                   
					<table class="global" width="100%"  cellpadding="0" cellspacing="0"> 
                    <tr>
					<td style="padding-left: 16px;" valign="top" height="300">
									<table width="100%" align="left" border="0" cellpadding="0" cellspacing="0">
										<tbody>
											<!--<tr>
												<td align="center" colspan="6"><h2>Registered Professors</h2></td>
											</tr>-->
											<tr><td colspan="3"><?php echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td></tr>
											<tr align="right">
												<td colspan="6"> <?php breadcrum();?></td>
											</tr>
											<tr>
												<td colspan="6">
													<form name="new_user" action="#" method="post" enctype="multipart/form-data" onsubmit="return check()">
													<table width="100%" border="0" style="line-height:30px;" cellpadding="3" cellspacing="1" class="tborder">
                  										<tr class="row_1">
										                    <td colspan="3" align="center">
                                                            <input type="hidden" id="hiddate" name="hiddate" value="<? echo $date; ?>" /><h3>Add New Professor</h3></td>
										              </tr>
                                                    <!--      <tr>
									                    <td height="24" align="right" >Login Name</td>
									                    <td>:</td>
									                    <td><input type="text" name="txtuser_loginname" value="<?php if(!empty($_POST)) echo $_POST['txtuser_loginname']?>" id="txtuser_loginname" size="25" maxlength="50"/></td>
								                      </tr>
                                                          <tr>
									                    <td height="24" align="right" >User Type</td>
									                    <td>:</td>
									                    <td><select name="txtuser_type" value="<?php if(!empty($_POST)) echo $_POST['txtuser_type']?>" ><option value="">Select User Type</option>
                                                        <option value="student">Student</option>
                                                        <option value="teacher">Teacher</option>
                                                        <option value="school">School</option>
                                                        <option value="parent">Parent</option></select> </td>
								                      </tr>-->
									                  <tr>
									                    <td height="24" align="right" >User Email</td>
									                    <td>:</td>
									                    <td><input type="text" name="txtuser_email" value="<?php if(!empty($_POST)) echo $_POST['txtuser_email']?>" id="txtuser_email" size="25" maxlength="50"/></td>
								                      </tr>
													  <tr>
										                  <td width="42%" height="24" align="right" >First Name</td>
														  <td width="2%">:</td>
														  <td width="56%"><input type="text" name="txtfname" value="<?php if(!empty($_POST)) echo $_POST['txtfname']?>" id="txtfname" size="25" maxlength="50"/></td>
										              </tr>
									                  <tr>
									                    <td height="24" align="right" >Last Name</td>
									                    <td>:</td>
									                    <td><input type="text" name="txtlname" id="txtlname" value="<?php if(!empty($_POST)) echo $_POST['txtlname']?>" size="25" maxlength="50"/></td>
								                      </tr>
													 <!-- <tr>
									                    <td height="24" align="right" > Password</td>
									                    <td>:</td>
									                    <td><input type="password" name="txtpass" id="txtpass" size="25" maxlength="50"/></td>
								                      </tr>
									                  <tr>
									                    <td height="24" align="right" >Confirm Password</td>
									                    <td>:</td>
									                    <td><input type="password" name="txtconpass" id="txtconpass" size="25" maxlength="50"/></td>
								                      </tr>-->
													  <tr>
									                    <td height="24" align="right" >Upload Image</td>
									                    <td>:</td>
									                    <td><input type="file" name="image" value=""></td>
								                      </tr>
													  <tr>
									                    <td height="24" align="right" >Gender</td>
									                    <td>:</td>
									                    <td><input name="gender" type="radio" checked id="gender" value="male" /> Male &nbsp;&nbsp;&nbsp;<input name="gender" id="gender" type="radio"  value="female"  /> Female</td>
								                      </tr>
													  <tr>
									                    <td height="24" align="right" >Date of Birth</td>
									                    <td>:</td>
									                    <td><input type="text" name="txtdob" id="txtdob" size="25" value="" onclick="cal.select(document.forms['new_user'].txtdob,'txtdob','yyyy-MM-dd'); return false;"   />
															<a href="#" onclick="cal.select(document.forms['new_user'].txtdob,'dob','yyyy-MM-dd'); return false;" name="dob" id="dob"><img src="../../images/calendar.jpg" border="0" /></a>
														</td>
								                      </tr>
													  <tr>
									                    <td height="24" align="right" >Mobile Number</td>
									                    <td>:</td>
									                    <td><input type="text" name="txtmobile" id="txtmoblie"  value="<?php if(!empty($_POST)){echo $_POST['txtmobile'];}?>" size="25" />
														</td>
								                      </tr>
                                                        <tr>
									                    <td height="24" align="right" >Qualification</td>
									                    <td>:</td>
									                    <td><input type="text" name="Qualification" id="Qualification"  value="<?php if(!empty($_POST)){echo $_POST['Qualification'];}?>" size="25" />
														</td>
								                      </tr>
                                                         <tr>
									                    <td height="24" align="right" >working_filed</td>
									                    <td>:</td>
									                    <td><input type="text" name="working_filed" id="working_filed"  value="<?php if(!empty($_POST)){echo $_POST['working_filed'];}?>" size="25" />
														</td>
								                      </tr>
                                                        <tr>
									                    <td height="24" align="right" >experience</td>
									                    <td>:</td>
									                    <td><input type="text" name="experience" id="experience"  value="<?php if(!empty($_POST)){echo $_POST['experience'];}?>" size="25" />
														</td>
								                      </tr>
                                                         <tr>
									                    <td height="24" align="right" >Languages</td>
									                    <td>:</td>
									                    <td><input type="text" name="Languages" id="Languages"  value="<?php if(!empty($_POST)){echo $_POST['Languages'];}?>" size="25" />
														</td>
								                      </tr>
													 <!-- <tr>
									                    <td height="24" align="right" >City</td>
									                    <td>:</td>
									                    <td><input type="text" name="txtcity" id="txtcity" value="<?php if(!empty($_POST)) echo $_POST['txtcity']?>" size="25" maxlength="80"/></td>
								                      </tr>
													  <tr>
									                    <td height="24" align="right" >Country</td>
									                    <td>:</td>
									                    <td><?php if(!empty($_POST)){echo $settings->country_onchange_select($_POST['selcountry']);} else {echo $settings->country_onchange();}?></td>
								                      </tr>
													   <tr>
									                    <td height="24" align="right" >State</td>
									                    <td>:</td>
									                    <td><div id="txtstate"><?php if(!empty($_POST)){echo $settings->state_onchange_select($_POST['selstate'],$_POST['selcountry']);} else {echo $settings->state_onchange();}?></div></td>
								                      </tr>
													  <tr>
									                    <td height="24" align="right" >Nationality</td>
									                    <td>:</td>
									                    <td><?php if(!empty($_POST)){echo $settings->nationality_dropdown_select($_POST['selnationality']);} else {echo $settings->nationality_dropdown();}?></td>
								                      </tr>
									                  <tr>
									                    <td height="24" align="right" >Email Subscription</td>
									                    <td>:</td>
									                    <td><input type="text" name="txtsub_email" value="<?php if(!empty($_POST)) echo $_POST['txtsub_email']?>" id="txtsub_email" size="25" maxlength="50"/></td>
								                      </tr>
									                  
									                  <tr>
									                    <td height="24" align="right" >Preferred Courses</td>
									                    <td>:</td>
									                    <td><?php echo $course->course_multidrop();?></td>
								                      </tr>
									                  <tr>
									                    <td height="24" align="right" >Contact Method</td>
									                    <td>:</td>
									                    <td><input name="con_method" type="radio" id="con_method" value="1" />Phone &nbsp;&nbsp;&nbsp;<input name="con_method" checked id="con_method" type="radio"  value="2"  /> Email</td>
								                      </tr>
													  <tr>
									                    <td height="24" align="right" >Biography</td>
									                    <td>:</td>
									                    <td><textarea name="biography" id="biography"><?php if(!empty($_POST)){echo $_POST['biography'];}?></textarea></td>
								                      </tr>-->
													  
													  <tr>
													  	<td colspan="3" align="center" bgcolor="#D8D8F3">
											            	<input type="submit" name="add_new" value="Add New Professor" class="button" id="add_new">
												            <input type="button" name="back" value="Back" onClick="history.go(-1)" class="button" id="back">            </td>
													  </tr>
													</table>
													</form>
												</td>
											</tr>
										</tbody>
									</table>
								</td> 
                                </tr>
					</table> 
									</form>
				    <?php //include '../pageNation.php';?>	
				<br class="clear"/>
				</div> 
				</div></div>
			
			<!-- End one column box --> 
			<br class="clear"/>
			
			<!-- Begin one column box -->
<!-- End one column box --> 
</div> 
</div> 
<!-- End content --> 
<br class="clear"/> 
	
	<?php include '../footer.php';?>
</body>
</html>
	