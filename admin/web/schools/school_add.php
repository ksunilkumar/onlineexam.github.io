<?php session_start();
include_once "../../../lib/db.php";
include "../../../lib/schools_class.php";
$queries = new Queries();
$objSql = new SqlClass();
$exams_curriculum = new School();

if(isset($_POST['add_new']))
{	
		
		$count = $queries->makeselectquery('ise_schools',"count(*) as count","school_name", $_REQUEST['schoolname']);
		if($count == '0')
		{
			$count = $queries->makeselectquery('ise_schools',"count(*) as count","user_name", $_REQUEST['username']);
			if($count == '0')
			{
				$name=$_REQUEST['schoolname'];
				//$s="insert into grades values(null,'$name');";
				$status=$_REQUEST['stat']; 
				$username=$_REQUEST['username'];
				$password=$_REQUEST['password'];
							
				$tab = array("school_name =".$name."","user_name =".$username."","password =".md5($password)."","status =".$status."");
				$exams_curriculum->school_insert($tab);
				$fromname = 'ismartexams.com';$fromaddress = 'admin@ismartexams.com' ;$toname = $_POST['schoolname'];
				$toaddress = $_POST['username'];$subject = 'Your School Login Details mailed-by Ismartexams.com';
				$message = "Dear ".$_POST['schoolname']."<br><br>You are registered with Ismartexams<br>
						Please find your account information below. The account information will allow you access the Ismartexams website.<br><br>
						Account Information: <br>Username =".$_POST['username']."<br>Password:".$_POST['password']."<br><br>
						If you have any questions or concerns please contact us. We can be reached via the support chat, email, or call our direct support line.<br><br>Ismartexams Team<br>
						info@ismartexams.in";
				sendMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);
				$_SESSION['msg'] = "<font size='2' color='#0099FF'>School Added Successfully</font>";
				print "<script>";
				print "self.location='index.php';";
				print "</script>"; 
				exit;
			}
			else
			{
				$_SESSION['msg'] = "<font size='2' color='#FF0000'>Username Already Existed</font>";
			}
		}
		
		else
		{
			$_SESSION['msg'] = "<font size='2' color='#FF0000'>School Name Already Existed</font>";
		}
}
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
<link href="../../../images/style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../../../js/calendar.js"></script>
<script language="javascript">
	var cal = new CalendarPopup();
	cal.showYearNavigation();
</script>
<script language="javascript" src="../../../js/check.js"></script>
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
		/*if(!confirm('Are you sure you want to add the blog?\n- to Add the Blog, hit OK\n- otherwise, hit Cancel'))
		return false;*/
		getForm("new_blog");
		if(!IsEmpty("schoolname","Please enter school name"))return false;
		if(!IsEmail("username","Please enter valid Email"))return false;
		if(!IsEmpty("password","Please enter Password"))return false;

		
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
	theme_advanced_buttons3 : ""
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
					<a href="<?php echo $admin_path;?>schools/index.php"> 
						Manage School					</a>				</li> 
			<li> 
					<a href="<?php echo $admin_path;?>schools/school_add.php"  class="active"> 
						Add School					</a> 
				</li>
			</ul>		
	    <!-- End 1st level tab --> 
			
			<br class="clear"/>  <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
			
			
				
				<div class="content nomargin"  > 
			<table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="global">
										<tbody>
											
											<tr><td colspan="3"><?php  echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td></tr>
										
                                            <tr>
												<td align="center" colspan="6"><h2>Add School</h2></td>
											</tr>
											<tr>
												<td colspan="6">
													<form name="new_blog" action="" method="post" enctype="multipart/form-data" onsubmit="return check()">
													<table width="100%" border="0" style="line-height:30px;" cellpadding="3" cellspacing="1" class="tborder">
													  <tr>
										                  <td width="42%" height="24" align="right" ><span class="tr2">
										                  <label><font size="4" color="#ff0000"><b>
                                                          *</b></font>School</label>
										                  </span></td>
														  <td width="2%">:</td>
														  <td width="56%"><input type="text" name='schoolname' value="<? if($_REQUEST['schoolname']!="") echo $_REQUEST['schoolname']; ?>"></td>
										              </tr>
                                                       <tr>
										                  <td width="42%" height="24" align="right" ><span class="tr2">
										                  <label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Email</label>
										                  </span></td>
														  <td width="2%">:</td>
														  <td width="56%"><input type="text" name='username' value="<? if($_REQUEST['username']!="") echo $_REQUEST['username']; ?>"></td>
										              </tr>
                                                       <tr>
										                  <td width="42%" height="24" align="right" ><span class="tr2">
										                  <label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Password</label>
										                  </span></td>
														  <td width="2%">:</td>
														  <td width="56%"><input type="password" name='password' value="<? if($_REQUEST['password']!="") echo $_REQUEST['password']; ?>"></td>
										              </tr>
                                                      <tr>
										                  <td width="42%" height="24" align="right" ><span class="tr2"><label><font size="4" color="#ff0000"><b>
                                                          </b></font>Status</label></span></td>
														  <td width="2%">:</td>
														  <td width="56%"><select name="stat"><option value="active">Active</option>
<option value="inactive">InActive</option>
</select>                                                          </td>
										              </tr>
										  

																				  <tr>
													  	<td colspan="3" align="center">
											            	<input type="submit" name="add_new" value="Add School" class="button_light" id="add_new">
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
