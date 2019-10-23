<?php 
	session_start();
	include_once '../../../lib/db.php';
	include_once"../../../lib/admin_check.php";
	admin_login_check('0','Debates');
	include_once '../../../lib/calss_qatar_live_teach.php';
	$qatar_live_teach = new qatar_live_teach();
	$queries = new Queries();
	if(!empty($_POST))
	{
		
		
			
			list($date_1,$time_1)=explode(" ",$_POST['txtstart']);
			list($d_1,$d_2,$d_3) = explode(":",$time_1);
			$date = date('Y-m-d H:i:s');
			$tab = array("title =".$_POST['txtname']."","teacher_id =".$_POST['selteacher']."", "subject_id=".$_POST['selsubject']."", "grade_id=".$_POST['selgrade']."", "price=".$_POST['txtprice']."", "duration =".$_POST['txtduration']."", "about_class =".addslashes($_POST['desc'])."", "class_start_date=".$_POST['txtstart']."", "class_start_hours=".$d_1."", "class_start_minits=".$d_2."");
			$where = "online_cid=".$_REQUEST['id']."";
			
			$val = $qatar_live_teach->qatar_live_teach_class_update($tab,$where);
			$_SESSION['msg'] = "<font  color='#FF0000'>Updated Successfully</font>";
			$page=$_REQUEST['page'];
			print "<script>";
			print " self.location='index.php?pageNumber=".$page."&al=".$_REQUEST['al']."'";
			print "</script>";
			}
		else
		{
			$_SESSION['msg'] = "<font size='3' class = 'linkl'>Class Title Already Existed</font>";
		}
		
	
	$row = $qatar_live_teach->qatar_live_teach_class_selectall("online_cid",$_GET['id']);
	/*echo '<pre>';
	print_r($row);*/
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
<script language="javascript" src="../../../script/datetimepicker.js"></script> 
<script language="javascript" src="../../../script/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" language="javascript">
tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	elements : "elm1",
    theme_advanced_toolbar_location : "top",
	theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,forecolorpicker,backcolorpicker,charmap,visualaid,bullist,numlist,undo,redo,code",
	theme_advanced_buttons2 : "fontselect,fontsizeselect,formatselect,removeformat,styleselect,forecolor,cleanup,visualaid",
	theme_advanced_buttons3 : "",
	theme_advanced_toolbar_location : "top", 
	theme_advanced_toolbar_align : "left", 
	theme_advanced_statusbar_location : "bottom", 
	theme_advanced_resizing : true, 
});
</script>
<script language="javascript" src="../../../script/check.js"></script>
<script language="javascript">
	function check(){
		getForm("add_online_class");
		if(!IsEmpty("txtname","Please Enter Class Title"))return false;
		if(!IsEmpty("selteacher","Please Select Teacher"))return false;
		if(!IsEmpty("selsubject","Please Select Subject"))return false;
		if(!IsEmpty("selgrade","Please Select Grade"))return false;
		if(!IsEmpty("txtprice","Please Enter Price"))return false;
		if(!IsNumber("txtduration","Please Numeric value for Class Duration"))return false;
		if(!IsEmpty("txthours","Please Enter Class Starting Time"))return false;
		if(!IsEmpty("txtmin","Please Enter Class Starting Time"))return false;
		if(!IsEmpty("selhours","Please Select Hours"))return false;
		if(!IsEmpty("selmin","Please Select  Minutes"))return false;
		if(!IsEmpty("txtstart","Please Enter Class Starting Time"))return false;
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
					<a href="<?php echo $admin_path;?>liveteaching/index.php" class="active"> 
						Manage Live Teaching
					</a> 
				</li>
				<li> 
					<a href="<?php echo $admin_path;?>liveteaching/new.php"> 
						 Add Live Classes
					</a> 
				</li> 
				
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/>  <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 	
			<div style="border:1px solid #ccc;"  >
				
			
		
				
				<div class="content nomargin"  >  <form name="add_online_class" id="add_online_class" method="POST" action="#"  onsubmit="return check()">
                <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
              
		<table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="global">
										<tbody>
											
									    <tr><td colspan="3"><?php // echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td></tr>
											
                                            <tr>
												<td align="center" colspan="6"><h2>Edit Online Teaching Classes</h2></td>
										  </tr>
											<tr>
												<td colspan="6">
													
													<table width="100%" border="0" style="line-height:30px;" cellpadding="3" cellspacing="1" class="tborder">
                  									
									                  <tr>
									                    <td height="24" align="right" ><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Class Title</label></td>
									                    <td>:</td>
									                    <td>
                                                         <input type="text" value="<?php if(!empty($_POST)){echo $_POST['txtname'];}else{echo $row['title'];}?>" name="txtname" id="txtname" /></td>
								                      </tr>
													  <tr>
										                  <td width="42%" height="24" align="right" ><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Teacher</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><?php  if(!empty($_POST)){echo $qatar_live_teach->qatar_live_teschers_dropdown_select($_POST['selteacher'],$_SESSION['school_id']);}else{echo $qatar_live_teach->qatar_live_teschers_dropdown_select($row['teacher_id'],$_SESSION['school_id']);}?></td>
										              </tr>
                                                      
									                  <tr>
										                  <td width="42%" height="24" align="right" ><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Subject</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><?php if(!empty($_POST)){echo $qatar_live_teach->qatar_subject_dropdown_select($_POST['selsubject'],$_SESSION['school_id']);}else{echo $qatar_live_teach->qatar_subject_dropdown_select($row['subject_id'],$_SESSION['school_id']);}?></td>
										              </tr>
													  <tr>
										                  <td width="42%" height="24" align="right" ><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Grade</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><?php if(!empty($_POST)){echo $qatar_live_teach->qatar_grade_dropdown_select($_POST['selgrade'],$_SESSION['school_id']);}else{echo $qatar_live_teach->qatar_grade_dropdown_select($row['grade_id'],$_SESSION['school_id']);}?></td>
										              </tr>
										               <tr>
										                  <td width="42%" height="24" align="right" ><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Price</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><input type="text" name="txtprice" id="txtprice" <?php if(!empty($_POST)){?>value="<?php echo $_POST['txtprice']?>"<?php }else{?> value="<?=$row['price']?>" /><?php }?></td>
										              </tr>
                                                      <tr>
										                  <td width="42%" height="24" align="right" ><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Class Duration</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><input type="text" name="txtduration" id="txtduration" value="<?php if(!empty($_POST)){echo $_POST['txtduration'];}else{echo $row['duration'];}?>" /></td>
										              </tr>
                                                      <tr>
										                  <td width="42%" height="24" align="right" ><label>Description</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><textarea name="desc" id="desc"><?php if(!empty($_POST)){echo $_POST['desc'];}else{echo $row['about_class'];}?></textarea></td>
										              </tr>
                                                      <tr>
										                  <td width="42%" height="24" align="right" ><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Class Starting Time</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><input type="text" class="none" name="txtstart" id="txtstart" size="20" value="<?php if(!empty($_POST)){echo $_POST['txtstart'];}else{echo $row['class_start_date'];}?>" />&nbsp;&nbsp;
                                      <a href="javascript: NewCssCal('txtstart','yyyymmdd','dropdown',true,24,false)"><img src="../../images/calendar.jpg" width="16" height="16" border="0" alt="Pick a date"></a></td>
										              </tr>

																				  <tr>
													  	<td colspan="3" align="center" >
											            	<input type="submit" name="button" id="button" value="Submit" class="button_light">
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

