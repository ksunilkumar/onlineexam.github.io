<?php 
@session_start();
ob_start();
include "../../../lib/db.php";
include "../../../lib/class_exam_course.php";
include_once'../../../lib/ise_settings.class.php';
$course=New exams_course;
$settings = new ise_Settings();
if(isset($_POST['add_new']))
{	
	$count=$course->get_course_count($_REQUEST['pname'],$_REQUEST['cur'],$_REQUEST['sname'],$_REQUEST['selschool'],$_REQUEST['id']);
	if($count=='0'){
$course->edit_course($_REQUEST['pname'],$_REQUEST['cur'],$_REQUEST['sname'],$_REQUEST['no'],$_FILES['subimage']['name'],$_FILES['subimage']['tmp_name'],
$_REQUEST['ref'],$_REQUEST['selschool'],$_REQUEST['id']);

$_SESSION['msg']="<font color='#0099FF' size='2'>Course Updated Successfully</font>";
print "<script>";
print " self.location='index.php?pageNumber=".$_REQUEST['pageNumber']."&al=".$_REQUEST['al']."&couid=".$_REQUEST['couid']."';";
print "</script>"; 
exit;
}
else{
	$_SESSION['msg']="<font color='#0099FF' size='2'>Course Already Exists</font>";
	print "<script>";
	print " self.location='course_modify.php?pageNumber=".$_REQUEST['pageNumber']."&al=".$_REQUEST['al']."&id=".$_REQUEST['id']."';";
	print "</script>"; 
	exit;
}
}
$cour = new exams_course();
$result_rec = $cour->get_course($_GET['id']);
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
<script language="javascript" src="../../../script/calendar.js"></script>
<script language="javascript">
	var cal = new CalendarPopup();
	cal.showYearNavigation();
</script>
<script language="javascript" src="../../../js/check.js"></script>
<script language="javascript">
	
	function check(){
		/*if(!confirm('Are you sure you want to add the blog?\n- to Add the Blog, hit OK\n- otherwise, hit Cancel'))
		return false;*/
		getForm("new_blog");
		if(!IsEmpty("pname","Please Select  Grade"))return false;
		if(!IsEmpty("cur","Please Select  Curriculum"))return false;
		if(!IsEmpty("sname","Please Select  Subject"))return false;
		if(!IsEmpty("selschool","Please Select  Subject"))return false;
		if(!IsNumber("no","Please Enter No.of Chapters"))return false;
		if(!IsEmpty("subimage","Please Upload Image"))return false;

		
		if(!IsEmpty("ref","Please Enter References"))return false;
		

		
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
					<a href="<?php echo $admin_path;?>tecourses/index.php"  class="active"> 
						Manage Course
					</a> 
				</li> 
				<li> 
					<a href="<?php echo $admin_path;?>tecourses/course_add.php"> 
						Add Course
					</a> 
				</li> 
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/>  <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
			
			
				
				<div class="content nomargin"  > 
		<table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="global">
										<tbody>
											
									    <tr><td colspan="3"><?php echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td></tr>
											
                                            <tr>
												<td align="center" colspan="6"><h2>Modify Course</h2>
											  </td>
										  </tr>
											<tr>
												<td colspan="6">
													<form name="new_blog" action="" method="post" enctype="multipart/form-data" onsubmit="return check()">
                                                    <input type="hidden" name="pageNumber" id="pageNumber" value="<?php echo $_REQUEST['pageNumber'];?>" />
<input type="hidden" name="al" id="al" value="<?php echo $_REQUEST['al'];?>" />
													<table width="100%" border="0" style="line-height:30px;" cellpadding="3" cellspacing="1" class="tborder">
                  									
									                  <tr>
									                    <td height="24" align="right" ><span class="tr2"><font size="4" color="#ff0000"><b>
                                                          *</b></font>Grade Name</span>                </td>
									                    <td>:</td>
									                    <td>
										<?php 
										    echo "<select name='pname'><option value=''>Select Grade</option>";
										    include_once'../../../lib/class_exam_grades.php';
											$display_cur=New exams_grades;				
											$res=$display_cur->display_select();
											$cou=count($res);
											for($i=0;$i<$cou;$i++)
											{ echo $res[$i]['grade_id'];
											
											echo "<option value=".$res[$i]['grade_id'];
											
											if($result_rec[0][grade_id] == $res[$i]['grade_id']){ echo " selected='selected'";  }
											
										   echo ">".$res[$i]['grade_name']."</option>";
										   						   
										   }
										   echo "</select>";
										   ?>                                                   </td>
								                      </tr>
													  <tr>
										                  <td width="48%" height="24" align="right" ><span class="tr2"><font size="4" color="#ff0000"><b>
                                                          *</b></font>Curriculum</span></td>
														  <td width="4%">:</td>
													    <td width="48%"><?php 
										  //echo $result_rec[0][cur_id];
											echo "<select name='cur'><option value=''>Select Curriculum</option>";
										   	require_once "../../../lib/class_exam_curriculum.php";
											$display_cur=New exams_curriculum;
											$res=$display_cur->display_select();
											$cou=count($res);
											for($i=0;$i<$cou;$i++)
											{
										   		echo $res[$i]['cur_id'];
												echo "<option value=".$res[$i]['cur_id'];
												if($result_rec[0][cur_id] == $res[$i]['cur_id']){ echo " selected='selected'";  }
												
												echo ">".$res[$i]['cur_name']."</option>";									   
										   	}
										   	echo "</select>";
										  
										   ?></td>
										              </tr>
                                                       <tr>
										                  <td width="48%" height="24" align="right" ><span class="tr2"><font size="4" color="#ff0000"><b>
                                                          *</b></font>Subject</span></td>
														  <td width="4%">:</td>
														  <td width="48%">
                                                          <?php 
										
										    echo "<select name='sname'><option value=''>Select Subject</option>";
										    include "../../../lib/class_exam_subject.php";
											$display_sub=New exams_subject;
											$res1=$display_sub->display_select();
											$cou=count($res1);
											for($i=0;$i<$cou;$i++)
										    {
												//echo $res1[$i]['sub_id'];
										   		echo "<option value=".$res1[$i]['sub_id'];
												if($result_rec[0][subject_id] == $res1[$i]['sub_id']){ echo " selected='selected'";  }
												
												echo ">".$res1[$i]['sub_name']."</option>";					   
										   	}
										    echo "</select>";
											
										   ?></td>
										              </tr>
                                                      <tr>
										                  <td width="42%" height="24" align="right" ><span class="tr2"><font size="4" color="#ff0000"><b>
                                                          </b></font>School</span></td>
														  <td width="2%">:</td>
														  <td width="56%"><?php echo $settings->get_school_name($result_rec[0]['school_id']);?>
                                                          
                                                          </td>
										              </tr>
                                    
                                                       <tr>
										                  <td width="48%" height="24" align="right" ><span class="tr2"><font size="4" color="#ff0000"><b>
                                                          *</b></font>No Of Chapters</span></td>
														  <td width="4%">:</td>
														  <td width="48%"><input type="text" name='no' value="<?php echo $result_rec[0][num_of_chapters]; ?>"></td>
										              </tr>
                                                <tr>
										                  <td width="48%" height="24" align="right" ><span class="tr2">Image</span></td>
												  <td width="4%">:</td>
												  <td width="48%"><?php echo $res->image;?><br /><input type="file" name='subimage'>&nbsp;&nbsp;&nbsp;
                                          
                                          
                                          <a  style="cursor:pointer" onclick="window.open('../../showimage.php?img=<?=$result_rec[0][course_image]?>','','width=750,height=700,scrollbars=yes')" >
                                            <?=$result_rec[0][course_image]?>
                                          </a>                                                  </td>
										              </tr>
                                                      <tr>
										                  <td width="48%" height="24" align="right" ><span class="tr2">Reference</span></td>
														  <td width="4%">:</td>
													    <td width="48%"><input type="text" value="<?php echo $result_rec[0][reference_text]; ?>" name='ref'>                                                        </td>
										              </tr>
													  <tr>
										                  <td width="48%" height="24" align="right" >Status</td>
														  <td width="4%">:</td>
													    <td width="48%"><select name="stat"><option value="active">Active</option>
<option value="inactive">InActive</option>
</select></td>
										              </tr>
										  

																				  <tr>
													  	<td colspan="3" align="center" >
											            	<input type="submit" name="add_new" value="Edit Course" class="button_light" id="add_new">
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
	
	<?php include '../footer.php';?>
</body>
</html>
