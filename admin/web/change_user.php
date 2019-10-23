<?php 
 
	session_start();
	include_once '../../lib/db.php';
	include_once '../../lib/calss_qatar_settigs.php';
	$queries = new Queries();
	$objSql = new SqlClass();
	$qatar_settings = new qatar_settings();
	if(!empty($_POST))
	{
		$sql = "SELECT emp_id,username,password FROM sis_employee WHERE username = '".$_POST['txtuser_name']."' && emp_id = '".$_SESSION['admin_id']."'";
		$recore = $objSql->executeSql($sql);
		$row = $objSql->fetchRow($recore);
		if(!empty($row)){
			$sql = "UPDATE sis_employee SET username = '".$_POST['txtnew_user']."' WHERE emp_id = '".$row['emp_id']."'"; 
				$val = $objSql->executeSql($sql);
				
			$_SESSION['msg'] = "<font size='2' color='#FF0000'>Admin User Name change Successfully</font>";
			
			$fromname = 'qatarsmarteducation';$fromaddress = 'admin@qatarsmarteducation.com' ;$toname = $row['email'];
			$toaddress = $row['email'];$subject = 'qatarsmarteducation Change Admin User Name Details Information';
			$message = "Qatarsmarteducation Admin Change Details<br><br><br>
				Old Admin User Namne     :".$row['username']."<br>
				New Admin User Name      : ".$_POST['txtuser_name']."<br>
				If you have any questions or concerns please contact us. We can be reached via the support chat, email.<br><br>qatarexamcenter Team<br>
				info@qatarsmarteducation.com";
			$qatar_settings->sendMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);
		}else
		{
			$_SESSION['msg'] = "<font size='2' color='#FF0000'>You Enter Wrong User Name</font>";
		}

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
<script type="text/javascript" src="s/jquery-ui.js"></script> 
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
		if(!IsEmpty("txtuser_name","Provide Old Admin User Name"))return false;
		if(!IsEmpty("txtnew_user","Provide New Admin User Name"))return false;
		if(!ChkLength("txtnew_user","5","User Name must be atleast 5 characters"))return false;
		if(!IsEmpty("txtcnew_user","Provide Confirm User Name"))return false;
		if(!IsSame("txtnew_user","txtcnew_user","Assign New Name and Confirm Name must be same"))return false;
	}
</script>
</head>
<body>
      <?php include"header_one.php";?>
    <?php  include 'left_one.php'; ?>
    <br class="clear"/> 
		
		<!-- Begin content --> 
		<div id="content_wrapper" style="margin-right:30px;"> 
		
			<!-- Begin one column box --> 
		
			
			<!-- Begin 1st level tab --> 
			<ul class="first_level_tab"> 
				<li> 
					<a href="<?php echo $admin_path;?>change_user.php" class="active"> 
						Change Username
					</a> 
				</li>
				<li> 
					<a href="<?php echo $admin_path;?>change_password.php"> 
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
											
											<tr><td colspan="3"><b><?php echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></b></td></tr>
										
                                            <tr>
												<td align="center" colspan="6"><h2>Change user name</h2></td>
											</tr>
											<tr>
												<td colspan="6">
											<form name="user_new" id="user_new" method="post" action="#" onsubmit="return check()">
													<table width="100%" border="0" style="line-height:30px;" cellpadding="3" cellspacing="1" class="tborder">
                  									
									                  <tr>
									                    <td width="51%" height="24" align="right" ><label>Old User Name</label></td>
									                    <td width="39%">:
								                        <input type="test" name="txtuser_name" id="txtuser_name" /></td>
									                    <td width="10%">&nbsp;</td>
								                      </tr>
                                                      
									                  <tr>
									                    <td height="24" align="right" ><label>New User Name</label></td>
									                    <td>:
								                        <input type="text" name="txtnew_user" id="txtnew_user" /></td>
									                    <td>&nbsp;</td>
									                  </tr>
													  
                                                      
									                  <tr>
									                    <td height="24" align="right" ><label>Confirm User Name</label></td>
									                    <td>:
								                        <input type="text" name="txtcnew_user" id="txtcnew_user" /></td>
									                    <td>&nbsp;</td>
								                      </tr>
													  
													  
                                                      
									                 
									                 			  <tr>
													  	<td colspan="3" align="center" >
                                                  
											            	<input type="submit" name="button" id="button" value="Submit" class="button_light">
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
