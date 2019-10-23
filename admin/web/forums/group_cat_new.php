<?php 
	session_start();
	include_once '../../lib/functions.php';
	include_once '../../lib/db.php';
	admin_login_check();
	$objSql1 = new SqlClass();
	$objSql = new SqlClass(); 
	if(!empty($_POST))
	{
		$sq = "SELECT groupcat_id FROM enm_group_cat WHERE groupcat_name = '".$_POST['txtcountry']."'";
		$recor = $objSql->executeSql($sq);
		$row13 = $objSql->fetchRow($recor);
		if(empty($row13['groupcat_id']))
		{
			$sql1 = "INSERT INTO enm_group_cat(groupcat_name, status)
					VALUES ( '".addslashes($_POST['txtcategory'])."', '".$_POST['status']."')";
			$val = $objSql1->executeSql($sql1);
			$_SESSION['msg'] = "<font size='2' color='#0099FF'>Group Category Added Successfully</font>";
			print "<script>";
			print " self.location='group_cat.php';";
			print "</script>"; 
			exit;
		}else
		{
			$_SESSION['msg'] = "<font size='2' color='#0099FF'>Category Name Already Entered</font>";
		}
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">

<link href="../images/style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../../script/check.js"></script>
<script language="javascript">
	function check(){
		getForm("new_category");
		if(!IsEmpty("txtcategory","Provide a valid Category"))return false;
	}
</script>
</head>
<body>
	<?php include 'header.php'?>
	<table width="90%" align="center" border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td width="22"><img src="../images/titlesleft.gif"></td>
				<td valign="top" background="../images/titlesbg.gif">
					<table style="padding-left: 1px;" width="100%" border="0" cellpadding="0" cellspacing="0">
						<tbody>
							<tr><td class="titles">&nbsp;</td></tr>
							<tr><td height="10"></td></tr>
							<tr><td class="pages">Manage Admins</td>                             <td class="pages">Manage Admins</td>
                            <td align="right">
                            <a href="../home.php" style="text-decoration:none">Admin</a>
                             <span class="org_arrow"><b>&raquo;</b></span>
                            <a href="index.php" style="text-decoration:none">
                             Groups Management</a>  <span class="org_arrow"><b>&raquo;</b></span> Add New Group
                             </td>
</tr>
						</tbody>
					</table>
				</td>
				<td align="right"><img src="../images/titlesright.gif"></td>
			</tr>
			<tr>
				<td width="22" background="../images/pageleftshadow.gif"><img src="../images/pageleftshadow.gif" width="22" height="1"></td>
				<td valign="top">
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tbody>
							<tr>
								<td class="navbg" style="padding-left: 1px;" valign="top" width="248" height="200">
								<?php include 'left.php'; ?>
									<table width="236" border="0" cellpadding="0" cellspacing="0">
										<tbody>
											<tr>	
												<td><img src="../images/navbottom.gif"></td>
											</tr>
										</tbody>
									</table><br><br>
								</td>
								<td style="padding-left: 16px;" valign="top" height="300">
									<form action="#" method="post" name="new_category" onsubmit="return check()">
									<table width="100%" align="left" border="0" cellpadding="0" cellspacing="0">
										<tbody>
											<tr>
												<td align="center" colspan="6"><h2>Groups</h2></td>
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
                  										<tr class="row_1">
										                    <td colspan="3" align="center">Add Group Category</td>
										              </tr>
									                  <tr>
										                  <td width="42%" height="24" align="right" >Category Name</td>
														  <td width="2%">:</td>
														  <td width="56%"><input type="text" value="<?php if(!empty($_POST)){echo $_POST['txtcategory'];}?>" name="txtcategory" id="txtcategory" size="35" maxlength="100"/></td>
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
											            	<input type="submit" name="add_new" value="Add Category" class="button" id="add_new">
												            <input type="button" name="back" value="Back" onClick="history.go(-1)" class="button" id="back"></td>
													  </tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
									</form>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
				<td width="27" background="../images/pagerightshadow.gif"><img src="../images/rightshadow.htm" width="27" height="1"></td>
			</tr>
		</tbody>
	</table>
	<?php include 'footer.php';?><br><br>
</body>
</html>