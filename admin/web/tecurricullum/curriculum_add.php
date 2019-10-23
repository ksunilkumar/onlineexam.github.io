<?php session_start();
include_once "../../../lib/db.php";
include "../../../lib/class_exam_curriculum.php";
$queries = new Queries();
$objSql = new SqlClass();
$exams_curriculum = new exams_curriculum();

if(isset($_POST['add_new']))
{	
		$count = $queries->makeselectquery('test_curriculum',"count(*) as count","cur_name", $_REQUEST['cname']);
		if($count == '0')
		{
			
		$name=$_REQUEST['cname'];
		//$s="insert into grades values(null,'$name');";
		$image=$_FILES['image']['name']; 
				$error = '0';$upload='';$extension='';
					if($image!='')
					{	
						define ("MAX_SIZE","50"); 
						$filename = stripslashes($_FILES['image']['name']);
						$extension = getExtension($filename);
						$extension = strtolower($extension);
						// Image Size
						$size=filesize($_FILES['image']['tmp_name']);
						if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
						{
							$_SESSION['msg'] = "<font size='2' color='#0099FF'>Upload Unknown File extension! Please Upload Onely png,gif,jpg,jpeg File</font>";
							$error='1';
						}else
						{
							$upload=time().".".$extension;
							$image = "../../../curimages/".$upload;
						
							$copied = copy($_FILES['image']['tmp_name'], $image);
						}
					}
		$tab = array("cur_name =".$name."","cur_image =".$upload."");
		$exams_curriculum->curriculum_insert($tab);
		$_SESSION['msg'] = "<font size='2' color='#0099FF'>Curricullum Added Successfully</font>";
		print "<script>";
		print "self.location='index.php';";
		print "</script>"; 
		exit;
		}
		
		else
		{
			$_SESSION['msg'] = "<font size='2' color='#FF0000'>Curriculum Title Already Existed</font>";
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
		/*if(!confirm('Are you sure you want to add the blog?\n- to Add the Blog, hit OK\n- otherwise, hit Cancel'))
		return false;*/
		getForm("new_blog");
		if(!IsEmpty("cname","Enter Curriculum name"))return false;
		if(!IsEmpty("image","Please Upload the image"))return false;

		
	}
</script>

<script language="javascript">
	function chkform()
	{
		getForm("course_form");
		if(!IsEmpty("cname","Enter Curriculum name"))return false;
		if(!IsEmpty("image","Please Upload the image"))return false;
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
					<a href="<?php echo $admin_path;?>tecurricullum/index.php"> 
						Manage Curriculum					</a>				</li> <li> 
					<a href="<?php echo $admin_path;?>tecurricullum/curriculum_add.php"  class="active"> 
						Add Curriculum					</a> 
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
												<td align="center" colspan="6"><h2>Add Curriculum</h2></td>
											</tr>
											<tr>
												<td colspan="6">
													<form name="new_blog" action="" method="post" enctype="multipart/form-data" onsubmit="return check()">
													<table width="100%" border="0" style="line-height:30px;" cellpadding="3" cellspacing="1" class="tborder">
													  <tr>
										                  <td width="42%" height="24" align="right" ><span class="tr2"><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Curriculum</label></span></td>
														  <td width="2%">:</td>
														  <td width="56%"><input type="text" name='cname' value="<? if($_REQUEST['cname']!="") echo $_REQUEST['cname']; ?>"></td>
										              </tr>
                                                      <tr>
										                  <td width="42%" height="24" align="right" ><span class="tr2"><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Image</label></span></td>
														  <td width="2%">:</td>
														  <td width="56%"><input type="file" name='image'>                                                          </td>
										              </tr>
										  

																				  <tr>
													  	<td colspan="3" align="center">
											            	<input type="submit" name="add_new" value="Add Curriculum" class="button_light" id="add_new">
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
