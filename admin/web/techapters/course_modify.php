<?php
	session_start();
	include_once '../../../lib/db.php';
	include_once"../../../lib/admin_check.php";
	admin_login_check('0','Others');
	//include_once '../../../lib/calss_qatar_settigs.php';
	include_once "../../../lib/db.php";
	include_once "../../../lib/class_exam_course.php";
	include_once "../../../lib/class_exam_chapters.php";
	include_once "../../../lib/class_exam_curriculum.php";
	include_once "../../../lib/class_exam_grades.php";
	include_once "../../../lib/class_exam_subject.php";
	include_once '../../../lib/ise_settings.class.php';
	$queries = new Queries();
	$qatar_settings = new ise_settings();
	$exams_course = new exams_course();
	$exams_chapters = new exams_chapters();
	$exams_curriculum = new exams_curriculum();
	$exams_grades = new exams_grades();
	$exams_subject = new exams_subject();
if(!empty($_POST))
{
			$count=$exams_chapters->get_chapter_name_count($_POST['title'],$_REQUEST['couser'],$_POST['cid']);
			if($count=='0'){
			$na=basename($_FILES['cimage']['name']);
			if($na!=""){
			$image=$_FILES['cimage']['name']; $error = '0';$upload='';$extension='';
				define ("MAX_SIZE","50"); 
				 function getExtension($str) 
				 {
					 $i = strrpos($str,".");
					 if (!$i) { return ""; }
					 $l = strlen($str) - $i;
					 $ext = substr($str,$i+1,$l);
					 return $ext;
				 }
				$filename = stripslashes($_FILES['cimage']['name']);
				$extension = getExtension($filename);
				$extension = strtolower($extension);
				// Image Size
				$size=filesize($_FILES['cimage']['tmp_name']);
				if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
				{
					$_SESSION['valid_err'] = "<font size='2' color='#FF0000'>Upload Unknown File extension! Please Upload Onely png,gif,jpg,jpeg File</font>";
					$error='1';
				}else
				{
					$upload=time().".".$extension;
					$newname="../../../uploads/cimages/".$upload;
					$copied = copy($_FILES['cimage']['tmp_name'], $newname);
				}	
				$tab = array("chap_name =".$_POST['title']."", "subtopics=".$_POST['subtopics']."", "chap_description=".$_POST['desc']."","chap_image=".$upload."");
				$where = "chap_id=".$_POST['cid']."";
}
else{
$tab = array("chap_name =".$_POST['title']."", "subtopics=".$_POST['subtopics']."", "chap_description=".$_POST['desc']."");
$where = "chap_id=".$_POST['cid']."";
}
/*echo "<pre>";
print_r($tab);
exit;*/

$page=$_REQUEST['page'];
$update = $exams_chapters->chapters_update($tab,$where);
$_SESSION['msg'] = "<font size='2' color='#0099FF'>Chapter Updated  Successfully</font>";
print "<script>";
print " self.location='index.php?pageNumber=".$_REQUEST['pageNumber']."&al=".$_REQUEST['al']."&couid=".$_REQUEST['couid']."';";
print "</script>"; 
}
else{
	$msg = "<font size='2' color='#0099FF'>Chapter Name Already Exists</font>";
	/*print "<script>";
	print " self.location='course_modify.php?pageNumber=".$_REQUEST['pageNumber']."&al=".$_REQUEST['al']."&id=".$_REQUEST['cid']."';";
	print "</script>"; */
}
}



$val = $queries->makeselectallquery('blogs',"blog_id","".$_GET['id']."");		
	
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
<script language="javascript" src="../../../script/check.js"></script>
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
		if(!confirm('Are you sure you want to modify the chapter details?\n- to Modify the chapter, hit OK\n- otherwise, hit Cancel'))
		return false;
		getForm("new_blog");
		if(!IsEmpty("blog_title","Please Enter Blog Title"))return false;

		
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
       <?php include_once"../header_one.php";?>
    <?php  include_once '../left.php'; ?>
    <br class="clear"/> 
		
		<!-- Begin content --> 
		<div id="content_wrapper" style="margin-right:30px;"> 
		
			<!-- Begin one column box --> 
		
			
			<!-- Begin 1st level tab --> 
			<ul class="first_level_tab"> 
			
				<li> 
					<a href="<?php echo $admin_path;?>techapters/index.php"  class="active"> 
						Manage Chapters
					</a> 
				</li> 
				<li> 
					<a href="<?php echo $admin_path;?>techapters/course_add.php"> 
						Add Chapter
					</a> 
				</li> 
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/> <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
			  <?php 
							    $cid=$_REQUEST['id'];
							  $couid=$_REQUEST['couid'];
							  $chap = $exams_chapters->chapters_selectall("chap_id",$cid);
							 $course =$exams_course->course_selectall("course_id",$chap["course_id"]);
							  $cur =$exams_curriculum->curriculum_selectall("cur_id",$course["cur_id"]);

							
							  ?>
			
				
				<div class="content nomargin"  > 
		<table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="global">
										<tbody>
											
									    <tr><td colspan="3"><?php echo $msg; $msg=''?></td></tr>
											
                                            <tr>
												<td align="center" colspan="6"><h2>Modify Chapter</h2></td>
										  </tr>
											<tr>
												<td colspan="6">
													<form name="chapter_form" action="" method="post" enctype="multipart/form-data" onsubmit="return check()">
                                                    <input type="hidden" name="pageNumber" id="pageNumber" value="<?php echo $_REQUEST['pageNumber'];?>" />
<input type="hidden" name="al" id="al" value="<?php echo $_REQUEST['al'];?>" />
<input type="hidden" name="couid" id="couid" value="<?php echo $_REQUEST['couid'];?>" />
					<input type="hidden" name="couser" value="<?php echo $chap["course_id"];?>" />
													<table width="100%" border="0" style="line-height:30px;" cellpadding="3" cellspacing="1" class="tborder">
                  									
									                  <tr>
									                    <td height="24" align="right" ><label>Grade Name</label>               </td>
									                    <td>:</td>
									                    <td>
                                                        <input type="hidden" name="blog_title1"  value="<?php echo $val['blog_title'];?>" id="blog_title1" size="25" maxlength="50"/>
                                                        <?php 
										  
										    $grade = $exams_grades->grades_selectall("grade_id",$course["grade_id"]);
											
											
											echo $grade["grade_name"];
											?></td>
								                      </tr>
													  <tr>
										                  <td width="42%" height="24" align="right" ><label>Curriculum</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><?php echo  $cur["cur_name"];?></td>
													  </tr>
                                                      <tr>
										                  <td width="42%" height="24" align="right" ><label>Chapter No</label></td>
														  <td width="2%">:</td>
														  <td width="56%">
                                            <?php  echo $chap["chapter_no"];?>
                                                          </td>
										              </tr>
                                                       <tr>
										                  <td width="42%" height="24" align="right" ><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Title</label></td>
														  <td width="2%">:</td>
														  <td width="56%">
                                            <input type="text" name='title' value="<?php echo $chap["chap_name"];?> ">
                                                          </td>
										              </tr>
                                                      <tr>
										                  <td width="42%" height="24" align="right" ><label>Upload image</label></td>
														  <td width="2%">:</td>
														  <td width="56%">
                                            <?php echo $chap["chap_image"]?><br /><input type="file" name='cimage' >
                                                          </td>
										              </tr>
                                                       <tr>
										                  <td width="42%" height="24" align="right" ><label>Sub Topics</label></td>
														  <td width="2%">:</td>
														  <td width="56%">
                                          <input type="text" name='subtopics' value="<?php echo $chap["subtopics"];?>" />
                                                          </td>
										              </tr>
													  <tr>
										                  <td width="42%" height="24" align="right" ><label>Description</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><textarea rows="6" cols="30" name="desc" id="desc">
										 <?php echo $chap["chap_description"];?></textarea></td>
										              </tr>
                                                    
                                                      			  

														<tr>
													  	<td colspan="3" align="center" >
                                                        <input type="hidden" value="<?php echo $cid;?>" name="cid" />
                                        <input type="hidden" value="<?php echo $couid;?>" name="couid" />
											            	<input type="submit" name="add_new" value="Modify Chapter" class="button_light" id="add_new">
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
