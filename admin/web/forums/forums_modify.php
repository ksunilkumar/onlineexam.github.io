<?php 
	session_start();
	//include_once '../../../lib/functions.php';
	include_once '../../../lib/class_ise_forums.php';
	include_once '../../../lib/db.php';
	//admin_login_check();
	include_once '../../../lib/ise_settings.class.php';
	$queries = new Queries();
	$ise_settings = new ise_Settings();
	//$settings = new Settings();
	$objSql1 = new SqlClass();
	$objSql = new SqlClass();
	//$group = new Group();
	$sql = "SELECT * FROM ise_forums WHERE forum_id = '".$_GET['id']."' and school_id =".$_POST['selschool']."";
	$objSql = new SqlClass();
	$recore = $objSql->executeSql($sql);
	$row = $objSql->fetchRow($recore);
	if(!empty($_POST))
	{
			
	 $sq = "SELECT forum_id FROM ise_forums WHERE forum_name = '".$_POST['forum_name']."' AND forum_id!='".$_GET['id']."' and  and school_id =".$_POST['selschool'];
	
		$recor = $objSql->executeSql($sq);
		$row13 = $objSql->fetchRow($recor);
		
		if(empty($row13['forum_id']))
		{
	
			 $sql1 = "UPDATE ise_forums SET forum_name='".$_POST['forum_name']."',forum_description = '".addslashes($_POST['forum_desc'])."',school_id =".$_POST['selschool'].", forum_category=".$_REQUEST['selgroup'].",status=".$_REQUEST['stat']." WHERE forum_id = '".$_GET['id']."' ";
			
			//echo $sql1;exit;
			$objSql1->executeSql($sql1);
			$_SESSION['msg'] = "<div class='success'>Forum Modified Successfully</div>";
			print "<script>";
			print " self.location='index.php?pageNumber=".$_REQUEST['pageNumber']."&al=".$_REQUEST['al']."&school=".$_POST['selschool']."';";
			print "</script>"; 
			exit;
			}
			else{
			$_SESSION['msg'] = "<div class='wrong'>Forum Name exists in this category</div>";
			}
			
			
			
		
	}
	
		$val = $queries->makeselectallquery('ise_forums',"forum_id","".$_GET['id']."");		
		
			
			
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
<script language="javascript" src="../../../Scripts/check.js"></script>
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
	
		
		getForm("new_category");
		if(!IsEmpty("forum_name","Provide a valid Forum Name"))return false;
		if(!IsEmpty("forum_desc","Please Enter Description"))return false;
		
		if(!IsEmpty("'selgroup'","Please Select a Category"))return false;
		if(!confirm('Are you sure you want to modify the Forum?\n- to modify the Forum, hit OK\n- otherwise, hit Cancel'))
		return false;
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
					<a href="<?php echo $admin_path;?>forums/index.php"  class="active1"> 
						Manage Forums
					</a> 
				</li>
				<li> 
					<a href=""  class="active"> 
						Edit Forum
					</a> 
				</li> 
			</ul>	
			<!-- End 1st level tab --> 
			<div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			<br class="clear"/> 
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
			
			
				
				<div class="content nomargin"  > 
			<table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="global">
										<tbody>
										
                                            
                                            
											<tr><td colspan="3"><?php echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td></tr>
                                        
                                            	
											<tr>
												<td colspan="6">
													<form name="new_category" action="#" method="post" enctype="multipart/form-data" onsubmit="return check()">
                                                    <input type="hidden" name="pageNumber" id="pageNumber" value="<?php echo $_REQUEST['pageNumber'];?>" />
                                                    <input type="hidden" name="al" id="al" value="<?php echo $_REQUEST['al'];?>" />
													<table width="100%" border="0" style="line-height:30px;" cellpadding="3" cellspacing="1" class="tborder">
                  									
									                  <tr>
									                    <td height="24" align="right" ><label><font color="#FF0000" size="4"><b>
                                                          *</b></font>Forum Name </label> </td>
									                    <td>:</td>
									                    <td>
                                                        <input type="hidden" name="forum_name1"  value="<?php echo $row['forum_name'];?>" id="forum_title1" size="25" maxlength="50"/>
                                                        <input type="text" name="forum_name"  value="<?php echo $val['forum_name'];?>" id="forum_name" size="25" maxlength="50"/></td>
								                      </tr>
                                                       
													  <tr>
										                  <td width="42%" height="24" align="right" ><label><font color="#FF0000" size="4"><b>
                                                          *</b></font>Forum Description</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><textarea   rows="6" cols="30" name="forum_desc" ><?php if(!empty($_POST)) {echo $_POST['forum_desc'];}else{echo $val['forum_description'];}?></textarea></td>
										              </tr>
									                  
													   <tr>
										                  <td width="42%" height="24" align="right" ><label><font color="#FF0000" size="4"><b>
                                                          *</b></font>Category</label></td>
														  <td width="2%">:</td>
														  <td width="56%">
                                            <?php if(!empty($_POST)){echo $ise_settings->get_admin_sel_group($_POST['selgroup']);}
											else{echo $ise_settings->get_admin_sel_group($val['forum_category']);}?>                                                          </td>
										              </tr>
                                                       <tr>
										                  <td width="42%" height="24" align="right" ><label><font color="#FF0000" size="4"><b>
                                                          *</b></font>School</label></td>
														  <td width="2%">:</td>
														  <td width="56%">
                                            <?php if(!empty($_POST)){echo $ise_settings->get_sel_schools($_POST['selschool']);}else{echo $ise_settings->get_sel_schools($val['school_id']);}?></td>
										              </tr>
                                                        <tr>
										                  <td width="42%" height="24" align="right" ><label>Status</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><select name="stat"><option value="active">Active</option>
<option value="inactive">InActive</option>
</select></td>
										              </tr>
										  

																				  <tr>
													  	<td colspan="3" align="center" >
											            	<input type="submit" name="add_new" value="Modify Forum" class="button_light" id="add_new">
												            <input type="button" name="back" value="Back" onClick="history.go(-1)" class="button_light" id="back">            </td>
													  </tr>
													</table>
													</form>
												</td>
											</tr>
										</tbody>
									</table>
				    <?php // include '../pageNation.php';?>	
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
