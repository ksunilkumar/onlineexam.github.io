<?php 
	session_start();
	include_once '../../../lib/db.php';
	include_once '../../../lib/functions.php';
		include_once '../../../lib/functions_admin.php';
	include_once '../../../lib/calss_qatar_tutors.php';
	
	$qatar_users = new qatar_tutors();
	
	//admin_login_check();
	$settings = new Settings();
	$user = new Professor();
	//$course = new Course();
	$objSql1 = new SqlClass();
	$objSql = new SqlClass();
	if(!empty($_POST))
	{
		//echo $_POST['doj'];exit;
		
		define ("MAX_SIZE","50"); 
		 function getExtension($str) 
		 {
			 $i = strrpos($str,".");
			 if (!$i) { return ""; }
			 $l = strlen($str) - $i;
			 $ext = substr($str,$i+1,$l);
			 return $ext;
		 }
		$error = '0';$image_name='';
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
				$newname="../../../uploads/tutor_images/".$image_name;
				$copied = copy($_FILES['image']['tmp_name'], $newname);
			}
		}
		
			
			$sql1 = "UPDATE sis_employee SET firstname = '".$_POST['txtfname']."', 	lastname = '".$_POST['txtlname']."', "; 
			if($image != '')
			{
				$sql1.= "photo = '".$image_name."',";
			}
			
			$sql1.= "gender = '".$_POST['gender']."', 
				dob ='".$_POST['txtdob']."',doj ='".$_POST['doj']."', qualification = '".addslashes($_POST['Qualification'])."',
					designation = '".$_POST['designation']."', experience = '".$_POST['experience']."', alias = '".$_POST['alias']."',
				basic_salary = '".$_POST['basic_salary']."' WHERE emp_id = '".$_REQUEST['id']."'";
			
			$objSql1->executeSql($sql1);
			$sql="update sis_address set address1='".$_POST['address1']."', address2='".$_POST['address2']."', Phone='".$_POST['Phone']."',Email='".$_POST['Email']."',country='".$_POST['countryid1']."',	state='".$_POST['stateid1']."',city='".$_POST['cityid1']."' where id='".$_REQUEST['id']."'";
			$objSql1->executeSql($sql);
			$_SESSION['msg'] = "<font size='2' color='#0099FF'>User Modified Successfully</font>";
			print "<script>";
			print " self.location='index.php?pageNumber=".$_REQUEST['page']."&al=".$_REQUEST['al']."';";
			print "</script>"; 
			exit;
		
	}
	$row = $qatar_users->user_values($_GET['id']);
	$address=$qatar_users->user_Address($_GET['id']);
	
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
<link href="../images/style.css" rel="stylesheet" type="text/css">
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
	function check()
	{
	if(!confirm('Are you sure you want to modify the user details?\n- to Modify the User, hit OK\n- otherwise, hit Cancel'))
	return false;
	
		getForm("new_user");
		
		if(!IsEmpty("txtfname","Please Enter First Name"))return false;
		if(!IsEmpty("txtlname","Please Enter last Name"))return false;
		/*alert(document.getElementById('gender').checked);
		if(document.getElementById('gender').checked==false)
		{
		alert("Select gender");
		return false;
		}	*/
		if(!IsEmpty("txtdob","Please Select Date of Birth"))return false;
		if(!IsFurDate('txtdob','You Have Entered Future Date')) return false;
		if(!IsEmpty("doj","Please Select Date of Birth"))return false;
		if(!IsEmpty("Qualification","Please Enter Qualification"))return false;
		if(!IsEmpty("designation","Please Enter designation"))return false;
		
		if(!IsEmpty("experience","Please Enter experience"))return false;
		if(!IsEmpty("basic_salary","Please Enter Basic salary"))return false;
		if(!IsEmpty("address1","Please Enter  Adress"))return false;
		if(!IsEmpty("countryid1","Please Select Country"))return false;
		if(!IsEmpty("stateid1","Please Select State"))return false;
		if(!IsEmpty("cityid1","Please Select City"))return false;
		if(!IsPhone_new("Phone",10,"Please Enter valid Phone Number"))return false;
		if(!IsEmpty("Email","Please Enter  Email"))return false;
		if(!IsEmail("Email","Please Enter Valid  Email"))return false;
		
	/*	if(!IsEmpty("txtuser_email","Please Enter  Email"))return false;
		if(!IsEmail("txtuser_email","Please Enter Valid  Email"))return false;
		if(!IsEmpty("txtfname","Please Enter First Name"))return false;
		if(!IsEmpty("txtlname","Please Enter last Name"))return false;
		if(!IsEmpty("txtdob","Please Select Date of Birth"))return false;
		if(!IsFutureDate('txtdob')) return false;
		if(!IsEmpty("txtmobile","Please Enter Mobileno"))return false;
		if(!IsPhone_new("txtmobile",10,"Please Enter valid Phone Number"))return false;*/
		
	}
	function getUserDetails1(url,formname,div,val1)
	{
		/*alert(url);
		alert(formname);*/
		//alert(div);
		
		var url_string='';
		var i;
		
		
			url_string = url_string+'id='+val1;
		
		xmlhttp=GetXmlHttpObject();
			
		if (xmlhttp==null)
		{
			  alert ("Browser does not support HTTP Request");
			  return;
		}
 		var url=url+"?"+url_string;
		//alert("checkhere");
		
		xmlhttp.onreadystatechange=function()
    	{
		 
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				
				document.getElementById(div).innerHTML='';
				//alert(xmlhttp.responseText);
				 document.getElementById(div).innerHTML=xmlhttp.responseText;
				 document.getElementById('cityid2').value='';
				 
			}
		}
		 
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
		return false;
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
<script type="text/javascript" src="../../../script/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" language="javascript">
tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	elements : "elm1",
    theme_advanced_toolbar_location : "top",
	theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,forecolorpicker,backcolorpicker,bullist,numlist,link,unlink,blockquote,code",
	theme_advanced_buttons2 : "fontselect,fontsizeselect,formatselect,removeformat,forecolor,cleanup,backcolor",
	theme_advanced_buttons3 : "",
});
</script>
</head>
<body>
<?php include"../header_one.php";?>
    <?php  include '../left.php'; ?>
    <br class="clear"/> 
		
		<!-- Begin content --> 
		<div id="content_wrapper" style="margin-right:30px;"> 
		
			<!-- Begin one column box --> 
		
			
			<!-- Begin 1st level tab --> 
			<ul class="first_level_tab"> 
				<li> 
					<a href="<?php echo $admin_path;?>tutors/index.php" class="active"> 
						Manage Tutors
					</a> 
				</li> 
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/>  <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
			
			
				
				<div class="content nomargin"  > 
					
					<!-- Begin example table data --> 
                   <table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="global">
										<tbody>
									
											<tr><td colspan="3"><?php echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td></tr>
										
											<tr>
												<td colspan="6">
													<form name="new_user" action="" method="post" enctype="multipart/form-data" onsubmit="return check()">
													<table width="100%" border="0" style="line-height:30px;" cellpadding="3" cellspacing="1" class="tborder">
                  										<tr class="row_1">
										                    <td colspan="3" align="center"><h2>Modify Tutor</h2></td>
										              </tr>
									                 
                                                    
													  <tr>
										                  <td width="42%" height="24" align="right" ><label>
                                                          <font color="#FF0000" size="4"><b>
                                                          *</b></font>
                                                          First Name</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><input type="text" name="txtfname" value="<?php if(!empty($_POST)) {echo $_POST['txtfname'];}else{echo $row['firstname'];}?>" id="txtfname" size="25" maxlength="50"/></td>
										              </tr>
									                  <tr>
									                    <td height="24" align="right" ><label>
                                                        <font color="#FF0000" size="4"><b>
                                                          *</b></font>Last Name</label></td>
									                    <td>:</td>
									                    <td><input type="text" name="txtlname" id="txtlname" value="<?php if(!empty($_POST)) {echo $_POST['txtlname'];}else{echo $row['lastname'];}?>" size="25" maxlength="50"/></td>
								                      </tr>
                                                      <tr>
									                    <td height="24" align="right" ><label>Alias</label></td>
									                    <td>:</td>
									                    <td><input type="text" name="alias" id="alias" value="<?php if(!empty($_POST)) {echo $_POST['alias'];}else{echo $row['alias'];}?>" size="25" maxlength="50"/></td>
								                      </tr>
													  <tr>
									                    <td height="24" align="right" ><label>Upload Image</label></td>
									                    <td>:</td>
									                    <td><input type="file" name="image" value="<?php echo $row['photo'];?>"><img src="<?php if($row['photo'] == ""){?>../../../images/noimage.jpg<?php }else{ echo "../../../uploads/tutor_images/".$row['photo'];}?>" width="117" height="26" /></td>
								                      </tr>
													  <tr>
									                    <td height="24" align="right" ><label><font color="#FF0000" size="4"><b>
                                                          *</b></font>Gender</label></td>
									                    <td>:</td>
									                    <td><input name="gender" type="radio" <?php if($row['gender'] == 'male'){echo "checked";}?> id="gender" value="male" /> Male &nbsp;&nbsp;&nbsp;<input name="gender" id="gender" <?php if($row['gender'] == 'female'){echo "checked";}?> type="radio"  value="female"  /> Female</td>
								                      </tr>
													  <tr>
									                    <td height="24" align="right" ><label>
                                                        <font color="#FF0000" size="4"><b>
                                                          *</b></font>Date of Birth</label></td>
									                    <td>:</td>
									                    <td><input type="text" name="txtdob" id="txtdob" size="25" value="<?php if(!empty($_POST)){echo $_POST['txtdob'];}else{echo $row['dob'];} ?>" onclick="cal.select(document.forms['new_user'].txtdob,'txtdob','yyyy-MM-dd'); return false;"   />
															<a href="#" onclick="cal.select(document.forms['new_user'].txtdob,'dob','yyyy-MM-dd'); return false;" name="dob" id="dob"><img src="../../../images/calendar.jpg" border="0" height="20" width="20"/></a>
														</td>
								                      </tr>	
                                                      <tr>
									                    <td height="24" align="right" ><label>
                                                        <font color="#FF0000" size="4"><b>
                                                          *</b></font>Date of Join</label></td>
									                    <td>:</td>
									                    <td><input type="text" name="doj" id="doj" size="25" value="<?php if(!empty($_POST)){echo $_POST['doj'];}else{echo $row['doj'];} ?>" onclick="cal.select(document.forms['new_user'].doj,'doj','yyyy-MM-dd'); return false;"   />
															<a href="#" onclick="cal.select(document.forms['new_user'].doj,'doj','yyyy-MM-dd'); return false;" name="dob" id="dob"><img src="../../../images/calendar.jpg" border="0" height="20" width="20"/></a>
														</td>
								                      </tr>
													  								
                                                       <tr>
									                    <td height="24" align="right" ><label><font color="#FF0000" size="4"><b>
                                                          *</b></font>Qualification</label></td>
									                    <td>:</td>
									                    <td><input type="text" name="Qualification" id="Qualification"  value="<?php if(!empty($_POST)){echo $_POST['Qualification'];}else{echo $row['qualification'];}?>" size="25" />
														</td>
								                      </tr>
                                                         <tr>
									                    <td height="24" align="right" ><label><font color="#FF0000" size="4"><b>
                                                          *</b></font>Designation</label></td>
									                    <td>:</td>
									                    <td><input type="text" name="designation" id="designation"  value="<?php if(!empty($_POST)){echo $_POST['designation'];}else{echo $row['designation'];}?>" size="25" />
														</td>
								                      </tr>
                                                        <tr>
									                    <td height="24" align="right" ><label><font color="#FF0000" size="4"><b>
                                                          *</b></font>experience</label></td>
									                    <td>:</td>
									                    <td><input type="text" name="experience" id="experience" value="<?php if(!empty($_POST)){echo $_POST['experience'];}else{echo $row['experience'];}?>" size="25" />
														</td>
								                      </tr>
                                                         <tr>
									                    <td height="24" align="right" >	<label><font color="#FF0000" size="4"><b>
                                                          *</b></font>basic_salary</label></td>
									                    <td>:</td>
									                    <td><input type="text" name="basic_salary" id="basic_salary"  value="<?php if(!empty($_POST)){echo $_POST['basic_salary'];}else{echo $row['basic_salary'];}?>" size="25" />
														</td>
								                      </tr>
                                                      <tr>
                                                      <td colspan="3" align="center"><h3>Modify Address</h3></td>
                                                      </tr>
                                                      
                                                       <tr>
									                    <td height="24" align="right" ><label><font color="#FF0000" size="4"><b>
                                                          *</b></font>Address1</label></td>
									                    <td>:</td>
									                    <td><input type="text" name="address1" id="	address1"  value="<?php if(!empty($_POST)){echo $_POST['address1'];}else{echo $address['address1'];}?>" size="25" />
														</td>
								                      </tr>
                                                       <tr>
									                    <td height="24" align="right" ><label>Address2</label></td>
									                    <td>:</td>
									                    <td><input type="text" name="address2" id="address2"  value="<?php if(!empty($_POST)){echo $_POST['address2'];}else{echo $address['address2'];}?>" size="25" />
														</td>
								                      </tr>
                                                       <tr>
									                    <td height="24" align="right" ><label><font color="#FF0000" size="4"><b>
                                                          *</b></font>Country</label></td>
									                    <td>:</td>
									                    <td><?php echo   $settings->get_country1($address['country']);?>  
														</td>
								                      </tr>
                                                  <tr>
									                    <td height="24" align="right" ><label><font color="#FF0000" size="4"><b>
                                                          *</b></font>State</label></td>
									                    <td>:</td>
									                    <td><div id="statediv1"><?php echo   $settings->get_state1($address['country'],$address['state']);?></div>
														</td>
								                      </tr>
                                                      <tr>
									                    <td height="24" align="right" ><label><font color="#FF0000" size="4"><b>
                                                          *</b></font>City</label></td>
									                    <td>:</td>
									                    <td> <div id="citydiv1"><?php echo   $settings->get_city1($address['state'],$address['city']);?> </div>
														</td>
								                      </tr>
                                                        <tr>
									                    <td height="24" align="right" ><label>
                                                        <font color="#FF0000" size="4"><b>
                                                          *</b></font>Phone</label></td>
									                    <td>:</td>
									                    <td><input type="text" name="Phone" id="Phone"  value="<?php if(!empty($_POST)){echo $_POST['Phone'];}else{echo $address['Phone'];}?>" size="25" />
														</td>
								                      </tr>
                                                         <tr>
									                    <td height="24" align="right" ><label>
                                                        <font color="#FF0000" size="4"><b>
                                                          *</b></font>Email</label></td>
									                    <td>:</td>
									                    <td><input type="text" name="Email" id="Email"  value="<?php if(!empty($_POST)){echo $_POST['Email'];}else{echo $address['Email'];}?>" size="25" />
														</td>
								                      </tr>
													  <tr>
													  	<td colspan="3" align="center" >
											            	<input type="submit" name="add_new" value="Modify Tutor" class="button_light" id="add_new">
												            <input type="button" name="back" value="Back" onClick="history.go(-1)" class="button_light" id="back">            </td>
													  </tr>
													</table>
													</form>
												</td>
											</tr>
										</tbody>
									</table>
									</form>
				    <?php //include '../pageNation.php';?>	
				<br class="clear"/>
				</div> 
				</div></div>
			
			<br class="clear"/>
			
</div> 
</div> 

<br class="clear"/> 
	
	<?php include '../footer.php';?>
</body>
</html>
	