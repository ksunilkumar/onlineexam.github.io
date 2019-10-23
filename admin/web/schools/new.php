<?php 
	session_start();
	include_once '../../../lib/db.php';
	include_once '../../../lib/calss_qatar_skoolinfo.php';
	include_once '../../../lib/calss_qatar_settigs.php';
	include_once '../../../lib/calss_qatar_keys.php';
	
	
	
	include_once"../../../lib/admin_check.php";
	admin_login_check('0','admin');
	$skool_ifo=new qatar_skoolinfo();
	$qatar_settings = new qatar_settings();
	$queries = new Queries();
	if(!empty($_POST))
	{
		//$object=new Keys();
		 $value=insertKeys('1');
		print "<script>";
		//print " self.location='index.php';";
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
 
 
<script language="javascript" src="../../../script/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" language="javascript">
tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	elements : "elm1",
    theme_advanced_toolbar_location : "top",
	theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,forecolorpicker,backcolorpicker,charmap,visualaid,bullist,numlist,undo,redo,code",
	theme_advanced_buttons2 : "fontselect,fontsizeselect,formatselect,styleselect,forecolor,cleanup,visualaid",
	theme_advanced_buttons3 : ""
});
</script>
<script language="javascript" src="../../../Scripts/check.js"></script>
<script language="javascript">
	function check(){
		getForm("group_new");
		if(!IsEmpty("txttitle","Provide Skool Title"))return false;
		if(!IsEmpty("images","Upload Group Image"))return false;
		updateRTE('about');
		alert(document.group_new.about.value);
		
		/*
		if(!IsEmpty("about","Please enter About us"))return false;
		if(!IsEmpty("admission","Please enter Admissions details"))return false;
		if(!IsEmpty("faculty","Please enter Faculty details"))return false;
		if(!IsEmpty("student","Please enter student life details"))return false;*/
		
		
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
					<a href="<?php echo $admin_path;?>schools/index.php"> 
						Manage Schools
					</a> 
				</li>
				<li> 
					<a href="<?php echo $admin_path;?>schools/new.php"  class="active"> 
						 Generate Keys
					</a> 
				</li> 
                 <li> 
					<a href="<?php echo $admin_path;?>schools/viewkeys.php"> 
						 View Keys
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
                                            
										
                                            <tr>
												<td align="center" colspan="6"><h2>Generate New Key</h2></td>
											</tr>
											<tr>
												<td colspan="6">
											<form name="group_new" id="group_new" method="post" action="#"  enctype="multipart/form-data"  onsubmit="return check()">
													<table width="100%" border="0" style="line-height:30px;" cellpadding="3" cellspacing="1" class="tborder">
                  									
									                  <tr>
									                    <td height="24" align="right" width="50%" ><label>Key Value</label></td>
									                    <td>:</td>
									                    <td><?php if(!empty($_POST)){echo $value;}?></td>
								                      </tr>
													  
									                  <tr>
													  	<td colspan="3" align="center">
                                                  
											             <?php if(empty($_POST)){?> <input type="submit" name="generate" value="Generate" class="button" id="add_new"><?php }else {?> <input type="button" name="OK" value="OK" class="button" id="add_new" onclick="javascript:location.href='index.php';"><?php }?>        </td>
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
