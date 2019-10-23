<?php session_start();
	include_once '../../../lib/functions.php';
	include_once '../../../lib/db.php';
	//admin_login_check();
	$settings = new Settings();
	//$user = new User();
	//$course = new Course();
	$objSql1 = new SqlClass();
	$queries = new Queries();
	$objSql = new SqlClass();
	//$group = new Group();
	$sql = "SELECT * FROM ise_forums WHERE forum_id = '".$_GET['id']."' ";
	$objSql = new SqlClass();
	$recore = $objSql->executeSql($sql);
	$row = $objSql->fetchRow($recore);
	if(!empty($_POST))
	{
			
	echo $sq = "SELECT forum_id FROM ise_forums WHERE forum_name = '".$_POST['forum_name1']."' and school_id=".$_POST['school_id']." and forum_id<>".$_GET['id'];
		$recor = $objSql->executeSql($sq);
		$row13 = $objSql->fetchRow($recor);
		if(empty($row13['forum_id']))
		{
	
			$sql1 = "UPDATE ise_forums SET forum_name = '".addslashes($_POST['forum_name1'])."', forum_description = '".addslashes($_POST['forum_desc'])."' WHERE forum_id = '".$_GET['id']."' ";
			
			
			$objSql1->executeSql($sql1);
			$_SESSION['msg'] = "<font size='2' color='#FF0000'>Sub Forum Modified Successfully</font>";
			print "<script>";
			print " self.location='subforums.php?id=".$_POST['pid']."&al=".$_REQUEST['al']."';";
			print "</script>"; 
			exit;
			}
			else{
			$_SESSION['msg'] = "<font size='2' color='#0099FF'>Sub Forum Name exists in this category</font>";
			}
			
			
			
		
	}
	
		$val = $queries->makeselectallquery('ise_forums',"forum_id","".$_GET['id']."");	
		$val1 = $queries->makeselectallquery('ise_forums',"forum_id","".$_GET['pid']."");	
		
			

			
			
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
				<table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="global">
										<tbody>
											<!--<tr>
												<td align="center" colspan="6"><h2>Edit&nbsp;&nbsp;SubForums</h2></td>
											</tr>
                                            -->
                                            
											<tr><td colspan="3"><?php echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td></tr>
                                         
										
											<tr>
												<td colspan="6">
													<form name="new_category" action="" method="post" enctype="multipart/form-data" onsubmit="return check()">
													<table width="100%" border="0" style="line-height:30px;" cellpadding="3" cellspacing="1" class="tborder">
                  										<tr class="row_1">
										                    <td colspan="3" align="center"><h3>Modify SubForum</h3></td>
										              </tr>
									                  <tr>
									                    <td height="24" align="right" >Forum Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                </td>
									                    <td>:</td>
									                    <td>
                                                        <input type="hidden" name="school_id"  value="<?php echo $val['school_id'];?>" id="forum_title1" size="25" maxlength="50"/>
                                                        <input type="hidden" name="forum_name1"  value="<?php echo $val['forum_name'];?>" id="forum_title1" size="25" maxlength="50"/>
                                                        <input type="text" name="forum_name" disabled="disabled" value="<?php echo $val['forum_name'];?>" id="forum_title" size="25" maxlength="50"/></td>
								                      </tr>
                                                        
													  <tr>
										                  <td width="42%" height="24" align="right" >Forum Description</td>
														  <td width="2%">:</td>
														  <td width="56%"><textarea   rows="6" cols="30" name="forum_desc" ><?php if(!empty($_POST)) {echo $_POST['forum_desc'];}else{echo $val['forum_description'];}?></textarea></td>
										              </tr>
									                  
													  
										  

																				  <tr>
													  	<td colspan="3" align="center" bgcolor="#D8D8F3">
											            	<input type="submit" name="add_new" value="Modify SubForum" class="button" id="add_new">
                                                            <input type="hidden" name="pid" value="<?=$_GET['pid']?>" />
												            <input type="button" name="back" value="Back" onClick="history.go(-1)" class="button" id="back">            </td>
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
	