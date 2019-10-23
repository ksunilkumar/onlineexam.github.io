<?php 
	session_start();
	include_once '../../lib/db.php';
	$queries = new Queries();
	$objSql = new SqlClass();
	if(!empty($_POST))
	{
	   $sql = "SELECT username FROM ise_admin WHERE password = '".md5($_POST['txtoldpass'])."' && username = '".$_SESSION['adminuser']."'";
		
		$recore = $objSql->executeSql($sql);
		$row = $objSql->fetchRow($recore);
		if(!empty($row)){
			  $sql = "UPDATE ise_admin SET password = '".md5($_POST['txtpass'])."' WHERE username = '".$row['username']."'";
			
				$val = $objSql->executeSql($sql);
			
			
			$_SESSION['msg'] = "<font size='2' color='#FF0000'>Password change Successfully</font>";
			print "<script>";
			print " self.location='change_password.php';";
			print "</script>";
			exit;
		}else
		{
			$_SESSION['msg'] = "<font size='2' color='#FF0000'>You Enter Wrong Old Password</font>";
		}

	}
echo $_SESSION['adminuser']; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
 
<!-- Website Title --> 
 
<!-- Meta data for SEO --> 
<meta name="description" content=""/> 
<meta name="keywords" content=""/> 
 
<!-- Template stylesheet --> 
<link rel="stylesheet" href="css/screen.css" type="text/css" media="all"/> 
<link href="css/datepicker.css" rel="stylesheet" type="text/css" media="all"/> 
<link rel="stylesheet" href="css/tipsy.css" type="text/css" media="all"/> 
<link rel="stylesheet" href="js/jwysiwyg/jquery.wysiwyg.css" type="text/css" media="all"/> 
<link href="js/visualize/visualize.css" rel="stylesheet" type="text/css" media="all"/> 
<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.0.css" media="screen"/> 
 
<!--[if IE 7]>
	<link href="css/ie7.css" rel="stylesheet" type="text/css" media="all">
<![endif]--> 
 
<!--[if IE]>
	<script type="text/javascript" src="js/excanvas.js"></script>
<![endif]--> 
 
<!-- Jquery and plugins --> 
<script type="text/javascript" src="js/jquery.js"></script> 
<script type="text/javascript" src="js/jquery-ui.js"></script> 
<script type="text/javascript" src="js/jquery.img.preload.js"></script> 
<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.0.js"></script> 
<script type="text/javascript" src="js/jwysiwyg/jquery.wysiwyg.js"></script> 
<script type="text/javascript" src="js/hint.js"></script> 
<script type="text/javascript" src="js/visualize/jquery.visualize.js"></script> 
<script type="text/javascript" src="js/jquery.tipsy.js"></script> 
<script type="text/javascript" src="js/browser.js"></script> 
<script type="text/javascript" src="js/custom.js"></script> 
 
 
<script language="javascript" src="../../script/check.js"></script>
<script language="javascript">
	function check(){
		getForm("user_new");
		if(!IsEmpty("txtoldpass","Provide Old Password"))return false;
		if(!IsEmpty("txtpass","Provide New Password"))return false;
		if(!ChkLength("txtpass","6","Password must be atleast 6 characters"))return false;
		if(!IsEmpty("txtcpass","Provide the Confirm Password"))return false;
		if(!IsSame("txtpass","txtcpass","Assign New Password and Confirm Password must be same"))return false;
	}
</script>
</head>
<body>
      <?php include"header_one.php";?>
    <?php  include'left_one.php';?>
    <br class="clear"/> 
		
		<!-- Begin content --> 
		<div id="content_wrapper" style="margin-right:30px;"> 
		
			<!-- Begin one column box --> 
		
			
			<!-- Begin 1st level tab --> 
				<ul class="first_level_tab"> 
				<!--<li> 
					<a href="<?php echo $admin_path;?>change_user.php" > 
						Change Username
					</a> 
				</li>-->
				<li> 
					<a href="<?php echo $admin_path;?>change_password.php" class="active"> 
						 Change Password
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
											
											<tr><td colspan="3"><?php  echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td></tr>
											
                                          <!--  <tr>
                                                    <td><input type="submit" name="sub3" value="Change User name" class="button" onclick="window.location='change_user.php'" />
                                                    </td>
                  									
									                  <tr>-->
                                            <tr>
												<td align="center" colspan="6"><h2>Change Password</h2></td>
											</tr>
											<tr>
												<td colspan="6">
											<form name="user_new" id="user_new" method="post" action="change_password.php" onsubmit="return check()">
													<table width="100%" border="0" style="line-height:30px;" cellpadding="3" cellspacing="1" class="tborder">
                                                    
									                    <td width="50%" height="24" align="right" ><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Old Password</label></td>
									                    <td width="17%">:
								                        <input type="password" name="txtoldpass" id="txtoldpass" /></td>
									                    <td width="33%">&nbsp;</td>
								                      </tr>
                                                      <tr>
									                    <td height="24" align="right" ><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>New Password</label></td>
									                    <td>:
								                        <input type="password" name="txtpass" id="txtpass" /></td>
									                    <td>&nbsp;</td>
                                                      </tr>
													  <tr>
									                    <td height="24" align="right" ><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Confirm Password</label></td>
									                    <td>:
								                        <input type="password" name="txtcpass" id="txtcpass" /></td>
									                    <td>&nbsp;</td>
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
	
	<?php include 'footer.php';?>
</body>
</html>
