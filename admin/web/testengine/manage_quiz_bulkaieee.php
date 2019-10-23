<?php session_start();
include_once'../../../lib/db.php';
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 
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
<style type="text/css">
<!--

-->
</style>
<link href="admin.css" rel="stylesheet" type="text/css" />
<link href="style_002.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="get_cur.js"></script>
</head>

<body >
<?php include"../header_one.php";?>
    <?php  include '../left.php'; ?>
    
		<br class="clear"/> 
		
		<!-- Begin content --> 
		<div id="content_wrapper" style="margin-right:30px;"> 
		
			<!-- Begin one column box --> 
		
			
			<!-- Begin 1st level tab --> 
			<ul class="first_level_tab"> 
				<li> 
					<a href="<?php echo $admin_path;?>testengine/manage_quiz_bulkaieee.php" class="active"> 
						Manage Questions
					</a> 
				</li>
				<!--<li> 
					<a href="<?php echo $admin_path;?>clients/new.php"> 
						 Add Clients
					</a> 
				</li> -->
				
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/> <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
			
			
				
				<div class="content nomargin"  >                     
                    <?php 

							include_once "../../../lib/class_exam_questions.php";
							include_once "../../../lib/class_exam_grades.php";
							include_once "../../../lib/class_exam_course.php";
							include_once  "../../../lib/class_exam_chapters.php";
							include_once "../../../lib/ise_settings.class.php";
							$queries = new Queries();
							$pagination_key = new pagination_key();
							$exams_grades = new exams_grades();
							$exams_course = new exams_course();
							$exams_chapters = new exams_chapters();
							$settings = new ise_Settings();
	
							$objSql = new SqlClass();
	
							$grades = $exams_grades->grades_select_one($_SESSION['school_id']);
							
							$course_details = $exams_course->get_grade_chapters($grades[0]['grade_id']);
							
							if(!empty($_POST))
							{
								$_SESSION['grade']=$_POST['grade_id'];
								$_SESSION['cur_id']=$_POST['cur_id'];
								$_SESSION['subject_id']=$_POST['subject_id'];
								$_SESSION['school_id']=$_POST['school'];
								$course_id = $exams_course->select_course('course_id','grade_id='.$_POST['grade_id'].' and cur_id = '.$_POST['cur_id'].' and subject_id ',$_POST['subject_id']);
								$chp = $exams_chapters->chapters_chapname_select($course_id,$_SESSION['school_id']);
								
							}
							else if(!empty($_SESSION['grade']) && !is_array($_SESSION['grade']) && !empty($_SESSION['cur_id']) && !empty($_SESSION['subject_id']))
							{
									$course_id = $exams_course->select_course('course_id','grade_id='.$_SESSION['grade'].' and cur_id = '.$_SESSION['cur_id'].' and subject_id ',$_SESSION['subject_id']);
									$chp = $exams_chapters->chapters_chapname_select($course_id,$_SESSION['school_id']);
							}
	
	
	
?>
<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="global">
              <tbody><tr>
                <td><table width="100%" align="left" border="0" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                      <td align="left"><table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
                          <tbody><tr>
                            <td><table summary="Buttons" width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tbody>
                                  
                                  <tr>
                                    <td colspan="2" class="h2" height="30"><span class="ph"><strong>Manage Questions</strong></span></td>
                                  </tr>
                                
                                </tbody>
                              </table>
                              <table align="center" width="100%" class="borderlistings" >
<form action="" method="post" name="mng_ques" >

<tr valign="middle">
                                          
                                          <td colspan="4" class="tr2" align="center" height="26">
                                         <select name='school' onchange="load_school(this.value)" id='school'>
                                          <option value="all">--Select--</option>
										  <?php 
										  $schools=$settings->get_school_all_names();
										  while($school_row = $objSql->fetchRow($schools))
										  {
										   ?>
                                           <option value='<?php echo $school_row['school_id'];?>' <?php if($_REQUEST['school']== $school_row['school_id']){ ?> selected="selected"<?php } ?>><?php echo $school_row['school_name'];?></option>
                                           <?php
										   }
										  ?>
                                          </select>
                                          </td>
                                </tr> 
                                
<tr>
  <td height="35" colspan="4" class="tr2" align="center" valign="middle">
 
  <div id="grade_div">
  <select name="grade" id="grade" onchange="load_grade(this.value)">
    <option value="">Select grade</option>
    <?php
	
	foreach($grades as $gra) { ?>
    <option <?php if($_POST['grade_id'] == $gra['grade_id']){ echo "selected='selected'";} ?> value="<?=$gra['grade_id']?>"><?=$gra['grade_name']?></option>
    <?php } ?>
  </select></div><input type="hidden" name="grade_id" id="grade_id"/></td>
  </tr>
<tr>
  <td height="35" colspan="4" class="tr2" align="center" valign="middle">
  <div id="curr_div">
  
  <?php if($_REQUEST['cur_id']!=''){
  	
	include_once "../../../lib/class_exam_course.php";
	include_once "../../../lib/class_exam_curriculum.php";
	include_once "../../../lib/class_exam_subject.php";

	$queries = new Queries();
	$exams_course = new exams_course();
	$exams_curriculum = new exams_curriculum();
	$exams_subject = new exams_subject();
	$val = $exams_course->course_curr($_REQUEST['grade_id'],$_REQUEST['school']);
  	
  ?>
  	<select name='sel_curr' id='sel_curr' onChange='load_sub(this.value)'>
    <option value="">Select Curriculum</option>
    <?php foreach($val as $ref) { ?>
    <option value="<?= $ref['cur_id'] ?>" <?php if($_REQUEST['cur_id']==$ref['cur_id']){ ?> selected="selected"<?php } ?>><?php echo $exams_curriculum->select_curriculum('cur_name','cur_id',$ref['cur_id']); ?></option>
    <?php } ?>

</select>
  <?php } else{ ?>
  <select name="sel_curr"><option>Select Curriculum</option></select>
  <?php  }?>
  </div>
      <input type="hidden" name="cur_id" id="cur_id"  />
      </td>
  </tr>

<tr>
  <td height="35" colspan="4" class="tr2" align="center" valign="middle">
  <div id="sbjt_div">
  <?php if($_REQUEST['subject_id']!=''){

include_once "../../../lib/class_exam_course.php";
include_once "../../../lib/class_exam_curriculum.php";
include_once "../../../lib/class_exam_subject.php";

	$queries = new Queries();
	$exams_course = new exams_course();
	$exams_curriculum = new exams_curriculum();
	$exams_subject = new exams_subject();
	$val = $exams_course->course_sub($_REQUEST['grade_id'],$_REQUEST['cur_id']);
	
  ?>
  <select name='sel_subject' id="sel_subject" onChange='sub_form(this.value);'>
<option value="">Select Subject</option>
<?php foreach($val as $ref) { ?>
<option value="<?= $ref['subject_id'] ?>"  <?php if($_REQUEST['subject_id']==$ref['subject_id']){ ?> selected="selected"<?php } ?>><?php echo $exams_subject->select_subject('sub_name','sub_id',$ref['subject_id']); ?></option>
<?php } ?>

</select>
  <?php } else{ ?>
  <select name="sel_subject" id="sel_subject"><option>Select Subject</option></select>
  <?php } ?>
  </div>    <input type="hidden" name="subject_id" id="subject_id"  /></td>
  </tr>
</form>
<tr>
  <td colspan="4" align="center">&nbsp;</td>
  </tr>
<tr>
  <th align="left" class="listingheadings"><strong>Chapter Name</strong></th>
  <th align="left" class="listingheadings"><strong>Description</strong></th>
  <th align="left" class="listingheadings"><strong>Image</strong></th>
  <th align="left" class="listingheadings"><strong>Options</strong></tdh>
</tr>
<?php  if(count($chp)!=2){ 
for($i=0;$i<=count($chp)-3;$i++){ ?>
<tr>
  <td class="tr2" align="left" width="20%"><?= $chp[$i]->chap_name ?></td>
  <td class="tr2" align="left" width="50%"><?= $chp[$i]->chap_description ?></td>
  <td class="tr2" align="left" width="15%"><img src="../../../uploads/cimages/<?= $chp[$i]->chap_image ?>" height="60" width="60" /></td>
  <td class="tr2" align="left" v><a href="manage_quiz_int_bulk.php?cid=<?= $chp[$i]->chap_id ?>">view</a></td>
</tr>
<?php } ?>
 <tr><td colspan="4" align="right"> </td></tr>
<?php } else{ ?>
 <tr><td colspan="4" align="center"><b> No Records Found </b></td></tr>
<?php } ?>

</table>
									</form>
                                     </td>
                                  </tr>
                                </tbody>
                              </table></td>
                          </tr>
                        </tbody></table></td>
                    </tr>
                  </tbody></table>
                  <div class="pagination">
             <?php  echo $chp['total_rec'];	?>  &nbsp;&nbsp;&nbsp;<?php echo $chp['dis_page']; ?>        
             </div>
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