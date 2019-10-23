<?php 
	session_start();
	include_once '../../../lib/functions.php';
	//include_once '../../../lib/forums_class.php';
	include_once '../../../lib/functions_admin.php';
	include_once '../../../lib/db.php';
	//admin_login_check();
	$settings = new Settings();
	$objSql1 = new SqlClass();
	$objSql = new SqlClass(); 
	$forums = new Forums();
	if(!empty($_POST))
	{
		 $sq = "SELECT forum_id FROM forums WHERE forum_title = '".$_POST['forumname']."'";
		
		$recor = $objSql->executeSql($sq);
		$row13 = $objSql->fetchRow($recor);
		
		if(empty($row13['forum_id']))
		{
		 $sq123 = "SELECT cat_id FROM forums WHERE forum_id = '".$_GET['id']."'";
		 $recor123 = $objSql->executeSql($sq123);
		$row123 = $objSql->fetchRow($recor123);
		//echo $row123['cat_id'];
		//exit;
			$sql1 = "INSERT INTO forums(forum_title,cat_id, forum_desc,forum_state,create_date)
					VALUES ( '".addslashes($_POST['forumname'])."','".$row123['cat_id']."','".addslashes($_POST['forum_desc'])."','".$_REQUEST['id']."',now())";
				
			
			$val = $objSql1->executeSql($sql1);
			$_SESSION['msg'] = "<font size='2' color='#FF0000'>Sub Forum Added Successfully</font>";
			print "<script>";
			print " self.location='subforums.php?id=".$_GET['id']."';";
			print "</script>"; 
			exit;
		}else
		{
			$_SESSION['msg'] = "<font size='2' color='#FF0000'>Sub Forum Name Already Entered</font>";
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
<script type="text/javascript" src="../../../script/tiny_mce/tiny_mce.js"></script>
<script language="javascript" src="../../../script/check.js"></script>
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
<script language="javascript">
	function check(){
		/*if(!confirm('Are you sure you want to add the group?\n- to Add the Group, hit OK\n- otherwise, hit Cancel'))
		return false;*/
		getForm("new_category");
		if(!IsEmpty("forumname","Provide a valid Sub Forum Name"))return false;
		//if(!IsEmpty("selcategory","Please  Select a Category"))return false;
		//if(!IsEmpty("group_desc","Please Enter Description"))return false;
		
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
					<a href="<?php echo $admin_path;?>forums/index.php"  class="active"> 
						Manage Forums
					</a> 
				</li> 
				<li> 
					<a href="<?php echo $admin_path;?>forums/forums_new.php"> 
						Add Forum
					</a> 
				</li> 
			</ul>		
			<!-- End 1st level tab --> 
			
			<br class="clear"/> <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
			
			
				
				<div class="content nomargin"  > 
				<form action="#" method="post" name="new_category" onsubmit="return check()">
                <input type="hidden" name="id" id="id" value="<?php echo $_REQUEST['id'];?>" />
					<table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="global">
										<tbody>
											<tr>
												<td align="center" colspan="6"><h2>Add Sub Forums</h2></td>
											</tr>
											<tr align="right">
												<td colspan="6"><?php
if (isset($HTTP_REFERER)) {
echo "<a href='$HTTP_REFERER'>Back to list</a>";
} else {
echo "<a href='javascript:history.back()'>Back to list</a>";
} 
?></td>
											</tr>
											<tr>
												<td colspan="6"><?php echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td>
											</tr>
											<tr>
												<td colspan="6">
													<table width="100%" border="0" style="line-height:30px;" cellpadding="3" cellspacing="1" class="tborder">
                  									
									                  <tr>
										                  <td width="42%" height="24" align="right" >Sub Forum Name</td>
														  <td width="2%">:</td>
														  <td width="56%"><input type="text" value="<?php if(!empty($_POST)){echo $_POST['forumname'];}?>" name="forumname" id="forumname" size="35" maxlength="100"/></td>
										              </tr>
                                                      
                                                      <tr>
										                  <td width="42%" height="24" align="right" >Forum Description</td>
														  <td width="2%">:</td>
														  <td width="56%"><textarea   rows="6" cols="30" name="forum_desc" ><?php if(!empty($_POST)) {echo $_POST['fourm_desc'];}else{echo $row['forum_desc'];}?></textarea></td>
										              </tr>
									                  <!--<tr>
									                    <td height="24" align="right" >Status</td>
									                    <td>:</td>
									                    <td>
															<select name="status" id="status">
																<option <?php if((!empty($_POST))&&($_POST['status'] == 'active')){echo 'selected';}?> value="active">Active</option>
																<option <?php if((!empty($_POST))&&($_POST['status'] == 'inactive')){echo 'selected';}?> value="inactive">Deactive</option>
												            </select>
														</td>
								                      </tr>-->
													  <tr>
													  	<td colspan="3" align="center" bgcolor="#D8D8F3">
											            	<input type="submit" name="add_new" value="Add Forum" class="button" id="add_new">
												            <input type="button" name="back" value="Back" onClick="history.go(-1)" class="button" id="back"></td>
													  </tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
									</form>
									
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
