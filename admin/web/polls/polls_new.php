<?php 
	session_start();
	include_once '../../../lib/calss_qatar_polls.php';
	include_once '../../../lib/db.php';
	include_once"../../../lib/admin_check.php";
	admin_login_check('0','Others');
	$qatar_polls = new qatar_polls();
	$queries = new Queries();
	if(!empty($_POST))
	{
		$title = trim($_POST['txttitle']);
		$count = $queries->makeselectquery('polls',"count(*) as count","poll_title", $title);
		
		if($count == '0')
		{
 			$date = date('Y-m-d');
			$tab = array("poll_title =".$title."", "option_one =".$_POST['opt_one']."", "option_two = ".$_POST['opt_two']."", "option_three = ".$_POST['opt_three']."", "create_date=$date","status=".$_POST['status']."","school_id=".$_SESSION['school_id']."");
			$val = $qatar_polls->qatar_polls_insert($tab);
			$_SESSION['msg'] = "<font size='2' color='#FF0000'>New Poll Added Successfully</font>";
			print "<script>";
			print " self.location='index.php';";
			print "</script>"; 
			exit;
 		}else
		{
			$_SESSION['msg'] = "<font size='2' color='#FF0000'>Polls Title Already Existed</font>";
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
<script language="javascript" src="../../../script/check.js"></script>
<script language="javascript">
	function check(){
		/*if(!confirm('Are you sure you want to add the news?\n- to Add the news, hit OK\n- otherwise, hit Cancel'))
		return false;*/

		getForm("new_news");
		if(!IsEmpty("txttitle","Please Provide polls Title"))return false;
		
		if(!IsEmpty("opt_one","Please Provide option1"))return false;
		if(!IsEmpty("opt_two","Please Provide option2"))return false;
		if(!IsEmpty("opt_three","Please Provide option3"))return false;
		
		//if(!IsEmpty("desc","Please Provide News Description"))return false;
	}
</script>
</head>
<body>
          <?php include"../header_one.php";?>
    <?php  include '../left.php'; ?>
    <br class="clear"/> 
		<div id="content_wrapper" style="margin-right:30px;"> 
			<ul class="first_level_tab"> 
			
				<li> 
					<a href="<?php echo $admin_path;?>polls/index.php"  > 
						Manage Polls
					</a> 
				</li> 
				<li> 
					<a href="<?php echo $admin_path;?>polls/polls_new.php" class="active"> 
						Add Poll
					</a> 
				</li> 
			</ul>		
			<br class="clear"/> <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			<div style="border:1px solid #ccc;"  > 
				<div class="content nomargin"  > 
		<form action="#" method="post" name="new_news" onsubmit="return check()" enctype="multipart/form-data">
									<table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="global">
										<tbody>
											
											
                                      <tr>
												<td align="center" colspan="6"><h2>Add Polls</h2></td>
											</tr>
											<tr>
												<td colspan="6"><?php echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td>
											</tr>
											<tr>
												<td colspan="6">
													<table width="100%" border="0" style="line-height:30px;" cellpadding="3" cellspacing="1" class="tborder">
                  									
									                  <tr>
										                  <td width="42%" height="24" align="right" >Poll Title</td>
													    <td width="2%">:</td>
														  <td width="56%"><input type="text" value="<?php if(!empty($_POST)){echo $_POST['txtnews_title'];}?>" name="txttitle" id="txttitle" size="35"/></td>
										              </tr>
													 
                                                      <tr>
										                  <td width="42%" height="24" align="right" >First Option</td>
													    <td width="2%">:</td>
														  <td width="56%"><input type="text" value="<?php if(!empty($_POST)){echo $_POST['txtnews_title'];}?>" name="opt_one" id="opt_one" size="35"/></td>
										              </tr>
                                                      <tr>
										                  <td width="42%" height="24" align="right" >Second Option</td>
													    <td width="2%">:</td>
														  <td width="56%"><input type="text" value="<?php if(!empty($_POST)){echo $_POST['txtnews_title'];}?>" name="opt_two" id="opt_two" size="35"/></td>
										              </tr>
                                                      <tr>
										                  <td width="42%" height="24" align="right" >Third Option</td>
													    <td width="2%">:</td>
														  <td width="56%"><input type="text" value="<?php if(!empty($_POST)){echo $_POST['txtnews_title'];}?>" name="opt_three" id="opt_three" size="35"/></td>
										              </tr>
                                                     
                                                     
									                  <tr>
									                    <td height="24" align="right" >Status</td>
									                    <td>:</td>
									                    <td>
															<select name="status" id="status">
																<option <?php if((!empty($_POST))&&($_POST['status'] == 'active')){echo 'selected';}?> value="active">Active</option>
																<option <?php if((!empty($_POST))&&($_POST['status'] == 'inactive')){echo 'selected';}?> value="inactive">Deactive</option>
												            </select>
														</td>
								                      </tr>
													  <tr>
													  	<td colspan="3" align="center" bgcolor="#D8D8F3">
											            	<input type="submit" name="add_new" value="Add Polls" class="button" id="add_new">
												            <input type="button" name="back" value="Back" onClick="history.go(-1)" class="button" id="back"></td>
													  </tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
									</form>
									
				    <?php include '../pageNation.php';?>	
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
