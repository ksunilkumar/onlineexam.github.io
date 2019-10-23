<?php session_start();
include "../../../lib/db.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
<style type="text/css">

</style>
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
<link href="admin.css" rel="stylesheet" type="text/css" />
<link href="style_002.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<style type="text/css">

</style>
<link href="admin.css" rel="stylesheet" type="text/css" />
<link href="style_002.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="cart.js">
</script>
<script language="javascript" src="offers.js">
</script>
</head>
<body>
<body>
 <?php include"../header_one.php";?>
    <?php  include '../left.php'; ?>
    <div id="content_wrapper" style="margin-right:30px;"> 
		
			<!-- Begin one column box --> 
		
			
			<!-- Begin 1st level tab --> 
			<ul class="first_level_tab"> 
			<li> 
					<a href="<?php echo $admin_path;?>test_options/give_offer.php" class="active"> 
						Add Offers
					</a> 
				</li> 
				<li> 
					<a href="<?php echo $admin_path;?>test_options/edit_offers.php"> 
						Edit Offers
					</a> 
				</li>
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/> <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 
            
			<div style="border:1px solid #ccc;"  > 
				
							
				<div class="content nomargin"  > 
                   <?php
include_once'../../../lib/db.php';
include_once'../../../lib/class_exam_users.php';
include_once'../../../lib/class_exam_curriculum.php';
$queries = new Queries();
$objSql = new SqlClass();
$exams_users = new exams_users();
$exams_curriculum = new exams_curriculum();
$users = $exams_users->users_allnames_select($_SESSION['school_id']);

 //echo $users[1];

?>
<form name="ff" action="addoffer.php" method="post" enctype="multipart/form-data">

<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="global">
              <tbody><tr>
                <td><table width="100%" align="left" border="0" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                      <td align="left"><table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
                          <tbody><tr>
                            <td><table summary="Buttons" width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tbody>
                                
                                  <!--<tr>
                                    <td colspan="2" class="h2" height="30"><span class="ph"><strong>Manage Offers</strong></span></td>
                                  </tr><tr>
                                    <td colspan="2" class="h2" height="30" align="right"><span class="ph"><strong><a href="edit_offers1.php">Edit Offers</a></strong></span></td>
                                  </tr>
-->                                  <tr><td colspan="4" align="center">
								  <?php if($_REQUEST['opt']=='yes') echo "<h2><blink>Offer Added Successfully</blink></h2>";
								  else if($_REQUEST['opt']=='not') echo "<h2><blink>Please Select Proper Details</blink></h2>";?></td></tr>
                                  <?php if($_REQUEST['bagid']!=''){
								  include_once'../../../lib/class_exam_bag.php';
									include_once'../../../lib/class_exam_course.php';
									include_once'../../../lib/class_exam_curriculum.php';
									include_once'../../../lib/class_exam_subject.php';
									include_once'../../../lib/class_exam_grades.php';
									include_once'../../../lib/class_exam_chapters.php';
									include_once'../../../lib/class_exam_test.php';
									 $objSql = new SqlClass();
									 $exams_bag =new exams_bag();
									 $exam_course = new exams_course();
									 $exam_curriculum = new exams_curriculum();
									 $exam_subject =new exams_subject();
									 $exam_grade = new exams_grades();
									 $exam_chapter = new exams_chapters();
									 $exam_test = new exams_test();
								$offers= $exams_bag->get_bagid_detils($_REQUEST['bagid']);
								$course = $exam_course->course_selectall(course_id,$offers[0]['courseid']);

								$curr = $exam_curriculum->curriculum_selectall(cur_id,$course['cur_id']);
									
								$subject =  $exam_subject->subject_selectall(sub_id,$course['subject_id']); 
							
							
								$grade = $exam_grade->grades_selectall(grade_id,$course['grade_id']);
							
								$chapters =$exam_chapter->chapters_selectall(chap_id,$offers[0]['chapterid']);
							
								$test = $exam_test->test_selectall(test_id,$offers[0]['quizid']);
								?>
                                  <tr>
                                  	<td colspan="4">
                                    	<table width='100%' border='0'>
                                        <tr>
                                        <th><b>Curriculum</b></th>   <th><b>Subject</b></th>  <th><b>Course</b></th>
                                        <th><b>Chapter</b></th><th><b>Quiz</b></th> 
                                        </tr>	
                                        <tr>
                                        	<td><?php echo $curr['cur_name']?></td>
                                            <td><?php echo $subject['sub_name']?></td>
                                            <td><?php echo $grade['grade_name']?></td>
                                            <td><?php echo $chapters['chap_name']?></td>
                                            <td><?php echo $test['test_name']?></td>
                                        </tr>
                                    </td>
                                  </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                         
                            
                                <table width="100%" border="1" cellpadding="10" cellspacing="0">
                                <tbody>
                               
                                <tr valign="middle">
                                          <td class="tr2" align="right" width="35%"><label>Student</label></td><td colspan="2" class="tr2" align="left" height="26">
                                          <select name='student' onChange="javascript:call('11')" id="student">
                                          <option value=''>Select user name from List</option>
								<?php
                                    while($row_id = $objSql->fetchRow($users)){
                                    		$user_id = $row_id['user_id'];
											$user_fname = $row_id['user_fname'];
									    echo "<option value='".$user_id."'>".$user_fname."</option>";
                                }
                            ?>
		         </select>                       

			</td></tr>
                                
                                
                                <tr valign="middle">
                                          <td class="tr2" align="right"><label>Curriculum</label></td><td colspan="2" class="tr2" align="left" height="26"><div id="cur1"><select name='cur'id='cur'><option value="all">--Select--</option>
										  </select></div></td>
                                        </tr>  
										<tr>
                                          <td class="tr2" align="right"><label>Subject</label></td><td colspan="2" class="tr2" align="left" height="26"><input type="hidden"  name="cid1" id='cid1'/><div id='subject'><select name='sub' id='sub'><option value="all">--Select--</option></select></div>
										  </td>
                                        </tr>      <tr>
                                          <td class="tr2" align="right"><label>Grade Name</label></td><td colspan="2" class="tr2" align="left" height="26"><input type="hidden"  name="cid1" id='cid1'/><div id='grade12'><select name='grade1' id='grade1'><option value="all">--Select--</option></select></div>
										  </td>
                                        </tr>      
                                                                        
<tr valign="middle">
                                          <td class="tr2" align="right"><label>Chapter Name</label></td><td colspan="2" class="tr2" align="left" height="26"><div id="chap"><select><option value='all'>--select--</option></select></div></td>
                                        </tr>
                                        <tr valign="middle">
                                          <td class="tr2" align="right"><label>Quiz Name</label></td><td colspan="2" class="tr2" align="left" height="26"><div id="quizi"><select><option value='all'>--select--</option></select></div></td>
                                        </tr>
                                    
                                      
                                        <input type="hidden" value="<?php echo $cid;?>" name="cid" />
                                  <tr valign="top">
                                    <td width="99%" colspan="4" align="center">
								
								
									
                                      <table width="30%" border="0" cellpadding="0" cellspacing="0">

                    
<tr valign="middle">
                                          <td colspan="5" class="pagesnum" align="left"><input type="submit" name='sub1' value='Submit' class="button_light"></td>
                                        </tr>                  </table>
                                        
                                        
                                        
                                        </td>
                                  </tr>
                                
                              </table>
										
										</td>
                          </tr>
                        </tbody></table></td>
                    </tr>
                  </tbody></table></td>
              </tr>
            </tbody></table>
                    
             				</div> 
				</div></div>
			
			<!-- End one column box --> 
			<br class="clear"/>
			

<br class="clear"/> 
	
	<?php include '../footer.php';?>
</body>
</html>       
