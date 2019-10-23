<?php 
	session_start();
	include_once '../../../lib/db.php';
	//include_once"../../../lib/admin_check.php";
	//admin_login_check('0','Others');
	include_once"../../../lib/class_ise_blogs.php";
	include_once '../../../lib/ise_settings.class.php';
	
	$queries = new Queries();
	$ise_settings = new ise_settings();
	$ise_blogs=new Blogs();
	/*echo"<pre>";
	print_r($_POST);*/

if(isset($_POST['add_new']))
{	
		$where=array("blog_title=". $_POST['blog_title']."","school_id=". $_POST['selschool']."");
		$count = $queries->makeselectallvalues('ise_blogs',$where);
		if(!is_array($count))
		{
		
				
					$image=$_FILES['upload_img']['name']; 
					if($image != "")
					{
						$image=$_FILES['upload_img']['name']; $error = '0';$upload='';$extension='';
						define ("MAX_SIZE","50"); 
						
						$filename = stripslashes($_FILES['upload_img']['name']);
						$extension = getExtension($filename);
						$extension = strtolower($extension);
						// Image Size
						$size=filesize($_FILES['upload_img']['tmp_name']);
						if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
						{
							$_SESSION['errmsg'] = "<div class='wrong'>Upload Unknown File extension! Please Upload Onely png,gif,jpg,jpeg File</div>";
							$error='1';
						}else
						{
							$upload=time().".".$extension;
							$newname="../../../uploads/blogs/".$upload;
					
							$copied = copy($_FILES['upload_img']['tmp_name'], $newname);
						}				
					}
					
					if($_POST['selgroup']!=''){
					
					$schoo_id=$ise_blogs->get_group_school($_POST['selgroup']);
					}
					
					
					//else $upload='';
					if($error==0){	
					$date = date('Y-m-d H:i:s');
					//echo $upload;
					$tab = array("cat_id=".$_POST['selgroup']."","blog_title =".addslashes($_POST['blog_title'])."", "blog_desc=".addslashes($_POST['blog_desc'])."","user_id=1","blog_rating=1","image_path=".$upload."","create_date=$date","status=".$_POST['stat']."","school_id =".$_POST['selschool']."");
					
					$val = $queries->makeinsertquery('ise_blogs',$tab);
					
					
					if($val){ 
					$_SESSION['msg'] = "<div class='success'>Blog Added Successfully</div>";
					?>
					<script language="JavaScript">
					location.href = "index.php?pageNumber=<?=$_REQUEST['pageNumber']?>&al=<?php echo $_REQUEST['al'];?>";
					</script>
					<?
						exit;
					}
					}
					else{
						$_SESSION['errmsg'] = "<div class='wrong'>Upload Unknown File extension! Please Upload Onely png,gif,jpg,jpeg File</div>";
					}
					
			}
		
		else
		{
			$_SESSION['errmsg'] = "<div class='wrong'>Blog Title Already Existed</div>";
		}
}
			
?>
 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>

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
		/*if(!confirm('Are you sure you want to add the blog?\n- to Add the Blog, hit OK\n- otherwise, hit Cancel'))
		return false;*/
		getForm("new_blog");
		if(!IsEmpty("blog_title","Please Enter Blog Title"))return false;
		if(!IsEmpty("blog_desc","Please Enter Blog Description"))return false;
		if(!IsEmpty("selgroup","Please Select Category"))return false;
		if(!IsEmpty("selschool","Select School"))return false;
		if(!IsEmpty("upload_img","Please Upload Image"))return false;

		
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
					<a href="<?php echo $admin_path;?>blog/index.php" class="active1"> 
						Manage Blogs
					</a> 
				</li> 
				<li> 
					<a href="<?php echo $admin_path;?>blog/blog_add.php" class="active"> 
						Add Blog
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
											
											<tr><td colspan="3"><?php echo $_SESSION['errmsg']; if(!empty($_SESSION['errmsg']))unset($_SESSION['errmsg']);?></td></tr>
											
                                           
											<tr>
												<td colspan="6">
													<form name="new_blog" action="" method="post" enctype="multipart/form-data" onSubmit="return check()">
													<table width="100%" border="0" style="line-height:30px;" cellpadding="3" cellspacing="1" class="tborder">
                  									
									                  <tr>
									                    <td height="24" align="right" > <font color="#FF0000" size="4"><b>
                                                          *</b></font>Blog Title &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                </td>
									                    <td>:</td>
									                    <td><input type="text" name="blog_title" value="<?php echo $_POST['blog_title'];?>" id="blog_title" size="25" maxlength="50"/></td>
								                      </tr>
													  <tr>
										                  <td width="42%" height="24" align="right" > <font color="#FF0000" size="4"><b>
                                                          *</b></font>Blog Description</td>
														  <td width="2%">:</td>
														  <td width="56%"><textarea   rows="6" cols="30" name="blog_desc" ><?php if(!empty($_POST)) {echo $_POST['blog_desc'];}else{echo $row['blog_description'];}?></textarea></td>
										              </tr>
                                                       <tr>
										                  <td width="42%" height="24" align="right" > <font color="#FF0000" size="4"><b>
                                                          *</b></font>Category</td>
														  <td width="2%">:</td>
														  <td width="56%">
                                                          <?php if(!empty($_POST)){echo $ise_settings->get_admin_sel_group($_POST['selgroup']);}else{echo $ise_settings->get_groups_dropdown();}?></td>
										              </tr>
                                                       <tr>
										                  <td width="42%" height="24" align="right" > <font color="#FF0000" size="4"><b>
                                                          *</b></font>School</td>
														  <td width="2%">:</td>
														  <td width="56%">
                                                          <?php if(!empty($_POST)){echo $ise_settings->get_sel_schools($_POST['selschool']);}else{echo $ise_settings->get_schools();}?></td>
										              </tr>
                                                      
                                    
                                                       <tr>
										                  <td width="42%" height="24" align="right" > <font color="#FF0000" size="4"><b>
                                                          *</b></font>Upload Image</td>
														  <td width="2%">:</td>
														  <td width="56%"><input type="file" name="upload_img" id="upload_img"  />
                                                          <input type="hidden" name="upload_image1" id="upload_img1" value="<?php if(!empty($_POST))echo $_POST['upload_image'];?>"
                                                          
                                                          </td>
										              </tr>
													  <tr>
										                  <td width="42%" height="24" align="right" >Status</td>
													    <td width="2%">:</td>
														  <td width="56%"><select name="stat"><option value="active">Active</option>
<option value="inactive">InActive</option>
</select></td>
										              </tr>
										  

																				  <tr>
													  	<td colspan="3" align="center" >
											            	<input type="submit" name="add_new" value="Add Blog" class="button_light" id="add_new" style="cursor:pointer">
												            <input type="button" name="back" value="Back" onClick="history.go(-1)" class="button_light" id="back" style="cursor:pointer">            </td>
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
