<?php session_start();?>
<?php 
		include_once '../../../lib/db.php';
		include_once"../../../lib/admin_check.php";
		include_once '../../../lib/functions.php';
		include_once '../../../lib/functions_admin.php';
	admin_login_check('0','admin');
	super_admin_login_check('0','superadmin');
	admin_login_check('0','admin');
	$country=new country();
	$state=new state();
	$city=new city();
	$settings = new Settings();
	$queries = new Queries();
	if(!empty($_POST))
	{
				$tab = array("city_name =".$_POST['cityid']."","stateid =".$_POST['stateid1']."");
				$val = $city->city_insert($tab);
				$_SESSION['msg'] = "<font size='2' color='#FF0000'>City Added Successfully</font>";
				print "<script>";
				print " self.location='city_index.php';";
				print "</script>"; 
		
		
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
 
<!-- Website Title --> 
<title>Qatar Learning Gateway Admin</title> 
 
<!-- Meta data for SEO --> 
<meta name="description" content=""/> 
<meta name="keywords" content=""/> 
 
<!-- Template stylesheet --> 
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
 
 
<script type="text/javascript" language="javascript">
tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	elements : "elm1",
    theme_advanced_toolbar_location : "top",
	theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,forecolorpicker,backcolorpicker,charmap,visualaid,bullist,numlist,undo,redo,code",
	theme_advanced_buttons2 : "fontselect,fontsizeselect,formatselect,styleselect,forecolor,cleanup,visualaid",
	theme_advanced_buttons3 : "",
});
</script>
<script language="javascript" src="../../../script/check.js"></script>
<script language="javascript" src=""></script>
<script language="javascript">
	function check()
	{
		getForm("group_new");
		if(!IsEmpty("countryid1","Provide Country Name"))return false;
		if(!IsEmpty("stateid1","Provide Country Name"))return false;
		if(!IsEmpty("cityid","Provide City Name"))return false;
			
		
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
					<a href="<?php echo $admin_path;?>otherotions/city_index.php" > 
						Manage City
					</a> 
				</li>
				<li> 
					<a href="<?php echo $admin_path;?>otherotions/city_new.php" class="active"> 
						 Add City
					</a> 
				</li> 
				
			</ul>		
			<!-- End 1st level tab --> 
			
			<br class="clear"/> <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
			
			
				
				<div class="content nomargin"  > 
			<table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="global">
										<tbody>
											
											<tr><td colspan="3"><?php // echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td></tr>
											<!--<tr align="right">
												<td colspan="6"><?php breadcrum();?></td>
											</tr>-->
                                            <tr>
												<td align="center" colspan="6"><h2>Add City</h2></td>
											</tr>
											<tr>
												<td colspan="6">
													<form name="group_new" id="group_new" method="post" action="#"  enctype="multipart/form-data"  onsubmit="return check()">
													<table width="100%" border="0" style="line-height:30px;" cellpadding="3" cellspacing="1" class="tborder">
                  									  <tr>
									                    <td height="24" align="right" ><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Country Name</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                </td>
									                    <td>:</td>
									                    <td><?php echo   $country->get_country1();?></td>
								                      </tr>
									                  <tr>
									                    <td height="24" align="right" ><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>State Name</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                </td>
									                    <td>:</td>
									                    <td><div id="statediv1"><?php echo   $state->get_state1($address['country']);?></div>
                                                       </td>
								                      </tr>
													     <tr>
									                    <td height="24" align="right" ><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>City Name</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                </td>
									                    <td>:</td>
									                    <td><input type="text" name="cityid" />
                                                       </td>
								                      </tr>

																				  <tr>
													  	<td colspan="3" align="center" >
                                                  
											            	<input type="submit" name="button" id="button" value="Submit" class="button_light"/>
												            <input type="button" name="back" value="Back" onClick="history.go(-1)" class="button_light" id="back">            </td>
													  </tr>
													</table>
													</form>
												</td>
											</tr>
										</tbody>
									</table>
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
