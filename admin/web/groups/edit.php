<?php 
	session_start();
	include_once '../../../lib/class_ise_groups.php';
	include_once '../../../lib/ise_settings.class.php';
	include_once '../../../lib/db.php';
	//include_once"../../../lib/admin_check.php";
	//admin_login_check('0','admin');
	$ise_groups = new ise_groups();
	$ise_settings = new ise_Settings();
	$queries = new Queries();
	if(!empty($_POST))
	{
		//$count = $queries->makeselectquery('ise_groups',"count(*) as count","group_name", $_POST['txttitle']);
		$sql="SELECT group_id from ise_groups where group_name='".$_POST['txttitle']."' and group_id<> '".$_REQUEST['id']."'";
		//echo $sql;
		$objSql = new SqlClass();
			$record1 = $objSql->executeSql($sql);
			$row=$objSql->fetchRow($record1);
		//echo $row['group_id'];
		//print_r($row);
		//exit;
		//echo $count;exit;
		if(empty($row['group_id']))
		{
			$image=$_FILES['images']['name']; $error = '0';$upload='';$extension='';
			if($image!='')
			{			
				
				define ("MAX_SIZE","50"); 
				
				$filename = stripslashes($_FILES['images']['name']);
				$extension = getExtension($filename);
				$extension = strtolower($extension);
				// Image Size
				$size=filesize($_FILES['images']['tmp_name']);
				if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
				{
					
					$_SESSION['msg'] = "<div class='wrong'>Upload Unknown File extension! Please Upload Onely png,gif,jpg,jpeg File</div>";
					$error='1';
				}else
				{
					$upload=time().".".$extension;
					$newname="../../../uploads/groups/".$upload;
					$copied = copy($_FILES['images']['tmp_name'], $newname);
				}
			} 
			if($error=='0')
			{	
				
				$date = date('Y-m-d');
				if($image=="")
				{
					$tab = array("group_name =".$_POST['txttitle']."", "group_desc=".addslashes($_POST['desc'])."",  "school_id =".$_POST['selschool']."", "create_date=$date","status=".$_POST['state']."");
				}else
				{
					$tab = array("group_name =".$_POST['txttitle']."", "group_desc=".addslashes($_POST['desc'])."", "school_id =".$_POST['selschool']."", "group_pic = ".$upload."", "create_date=$date","status=".$_POST['state']."");
				}
				$where = "group_id=".$_GET['id']."";
				$val = $ise_groups->ise_groups_update($tab,$where);
				$_SESSION['msg'] = "<div class='success'>Group Edited Successfully</div>";
				$page=$_REQUEST['page'];
				print "<script>";
				print " self.location='index.php?pageNumber=".$page."&al=".$_REQUEST['al']."'";
				print "</script>"; 
			}
		}else
		{
			$_SESSION['errmsg'] = "<div class='wrong'>Group Title Already Existed</div>";
		}
	}
	$row = $ise_groups->ise_groups_selectall("group_id",$_GET['id']);
	/*echo '<pre>';
	print_r($row);*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Ismartexams Admin Panel</title>
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
<script language="javascript" src=" ../../../script/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" language="javascript">
tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	elements : "elm1",
    theme_advanced_toolbar_location : "top",
	theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,forecolorpicker,backcolorpicker,charmap,visualaid,bullist,numlist,undo,redo,code",
	theme_advanced_buttons2 : "fontselect,fontsizeselect,formatselect,styleselect,forecolor,cleanup,visualaid",
	theme_advanced_buttons3 : "",
});
</script>
<script language="javascript" src="../../../Scripts/check.js"></script>
<script language="javascript">
	function check(){
	
		getForm("group_new");
	if(!IsEmpty("txttitle","Provide Group Title"))return false;
		if(!IsEmpty("desc","Provide Group Description"))return false;
		//if(!IsEmpty("seluser","Select Group Owner"))return false;
		if(!IsEmpty("selschool","Select School"))return false;
		//if(!IsEmpty("images","Upload Group Image"))return false;
		
	}
	var newwindow;
	function popup(url)
	{
		newwindow=window.open(url,'News Image','height=300,width=400');
		if (window.focus) {newwindow.focus()}
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
					<a href="<?php echo $admin_path;?>groups/index.php" class="active" > 
						Edit Groups
					</a> 
				</li>
				<!--<li> 
					<a href="<?php echo $admin_path;?>groups/new.php"> 
						 Add Groups
					</a> 
				</li> -->
				
			</ul>
			<!-- End 1st level tab --> 
			
			<br class="clear"/> <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 	
			<div style="border:1px solid #ccc;"  >
				
			
		
				
				<div class="content nomargin"  > <form name="group_new" id="group_new" method="post" action="#"  enctype="multipart/form-data"  onsubmit="return check()">
                   <input type="hidden" name="page" value="<?php echo $_GET['page'];?>" />
		<table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="global">
										<tbody>
											
									    <tr><td colspan="3"><?php // echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td></tr>
											
                                       	 <tr><td width="100%" colspan="5"><b><?php echo $_SESSION['errmsg']; if(!empty($_SESSION['errmsg']))unset($_SESSION['errmsg']);?></b></td></tr>
											<tr>
												<td colspan="6">
													
													<table width="100%" border="0" style="line-height:30px;" cellpadding="3" cellspacing="1" class="tborder">
                  									
									                  <tr>
									                    <td height="24" align="right" ><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Group Title</label></td>
									                    <td>:</td>
									                    <td>
                                                        <input type="text" value="<?php if(!empty($_POST)){echo $_POST['txttitle'];}else{echo $row['group_name'];}?>" name="txttitle" id="txttitle" /></td>
								                      </tr>
													  <tr>
										                  <td width="42%" height="24" align="right" ><label>Group Description</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><textarea name="desc" id="desc"><?php if(!empty($_POST)){echo $_POST['desc'];}else{echo $row['group_desc'];}?></textarea></td>
										              </tr>
                                                    <!--  
									                  <tr>
										                  <td width="42%" height="24" align="right" ><label>Group Website</label></td>
														  <td width="2%">:</td>
														  <td width="56%"> <input type="text" value="<?php if(!empty($_POST)){echo $_POST['website'];}else{echo $row['grp_website'];}?>" name="website" id="website" /></td>
										              </tr>
													  <tr>
										                  <td width="42%" height="24" align="right" ><label>Group Email</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><input type="text" value="<?php if(!empty($_POST)){echo $_POST['email'];}else{echo $row['grp_emailid'];}?>" name="email" id="email" /></td>
										              </tr>-->
										               <tr>
										                  <td width="42%" height="24" align="right" ><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>School</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><?php if(!empty($_POST)){echo $ise_settings->get_sel_schools($_POST['selschool']);}else{echo $ise_settings->get_sel_schools($row['school_id']);}?></td>
										              </tr>
                                                      <tr>
										                  <td width="42%" height="24" align="right" ><label>Group  Image</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><input type="file" name="images" value="<?php if(!empty($_POST)){echo $_POST['images'];}?>" id="images" />
                                <a href="#" onclick="popup('../../../uploads/groups/<?= $row['group_pic'];?>')"><?php echo $row['group_pic']; ?></td>
										              </tr>
                                                      <tr>
										                  <td width="42%" height="24" align="right" ><label>Status</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><select name="state" id="state" style="width:150px;">
                        	<option value="active" <?php if((!empty($_POST))&&($_POST['state']=='active')){echo "selected";}?> >Active</option>
                            <option value="inactive" <?php if((!empty($_POST))&&($_POST['state']=='inactive')){echo "selected";}?> >Inactive</option>
                        </select>  </td>
										              </tr>
                                                      

																				  <tr>
													  	<td colspan="3" align="center" >
											            	<input type="submit" name="button" id="button" value="Submit"  class="button_light">
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

