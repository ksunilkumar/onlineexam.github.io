<?php 
	session_start();
	include_once '../../../lib/db.php';
	$queries = new Queries();
	if(!empty($_POST))
	{
		$count = $queries->makeselectquery('category',"count(*) as count","cat_name", $_POST['txttitle']);
		if(($count == '0')||($count == '1'))
		{
			$date = date('Y-m-d');
			$tab = array("cat_name =".$_POST['txttitle']."", "create_date=$date","status=".$_POST['state']."");
			$where = "cat_id=".$_GET['id']."";
			$val = $queries->makeupdatequery('category',$tab,$where);
			$_SESSION['msg'] = "<font size='2' color='#FF0000'>Category Name Updated Successfully</font>";
			$page=$_REQUEST['page'];
			print "<script>";
			print " self.location='index.php?pageNumber=".$page."&al=".$_REQUEST['al']."'";
			print "</script>"; 
		}else
		{
			$_SESSION['msg'] = "<font size='3' class = 'linkl'>Category Title Already Existed</font>";
		}
	}
	$row = $queries->makeselectallquery('category',"cat_id",$_GET['id']);
	//print_r($row);
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
<script language="javascript" src="../../../script/check.js"></script>
<script language="javascript">
	function check(){
		getForm("category");
		if(!IsEmpty("txttitle","Provide Category Name"))return false;
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
					<a href="<?php echo $admin_path;?>settings/index.php" class="active"> 
						Manage Categories
					</a> 
				</li>
				<li> 
					<a href="<?php echo $admin_path;?>settings/new.php"> 
						 Add Category
					</a> 
				</li> 
				
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/> <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 	
			<div style="border:1px solid #ccc;"  >
				
			
		
				
				<div class="content nomargin"  > <form name="category" id="category" method="post" action="#"  onsubmit="return check()">
                        <input type="hidden" name="page" value="<?php echo $_GET['page'];?>" />
		<table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="global">
										<tbody>
											
									    <tr><td colspan="3"><?php // echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td></tr>
											
                                            <tr>
												<td align="center" colspan="6"><h2>Edit Category</h2></td>
										  </tr>
											<tr>
												<td colspan="6">
													
													<table width="100%" border="0" style="line-height:30px;" cellpadding="3" cellspacing="1" class="tborder">
                  									
									                  <tr>
									                    <td height="24" align="right" ><label>Category Name</label></td>
									                    <td>:</td>
									                    <td>
                                                       <input type="text" value="<?php if(!empty($_POST)){echo $_POST['txttitle'];}else{echo $row['cat_name'];}?>" name="txttitle" id="txttitle" /></td>
								                      </tr>
													
                                                      <tr>
										                  <td width="42%" height="24" align="right" ><label>Status</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><select name="state" id="state" style="width:150px;">
                        	<option value="active" <?php if((!empty($_POST))&&($_POST['state']=='active')){echo "selected";}else{if($row['status']=='active')echo "selected";}?> >Active</option>
                            <option value="inactive" <?php if((!empty($_POST))&&($_POST['state']=='inactive')){echo "selected";}else{if($row['status']=='inactive')echo "selected";}?> >Inactive</option>
                        </select>   </td>
										              </tr>
                                                      

																				  <tr>
													  	<td colspan="3" align="center" >
											            	<input type="submit" name="button" id="button" value="Submit" class="button_light" >
												            <input type="button" name="back" value="Back" onClick="history.go(-1)" class="button_light" id="back">            </td>
													  </tr>
													</table>
													
												</td>
											</tr>
										</tbody>
									</table></form>
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

