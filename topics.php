<?php
session_start();

include "lib/db.php";
user_login_check();	
	//include "lib/functions.php";
	
include "lib/class_exam_curriculum.php";
include "lib/class_exam_subject.php";
include "lib/class_exam_course.php";
include "lib/class_exam_grades.php";
include "lib/class_exam_chapters.php";
$exams_curriculum = new exams_curriculum();
$queries = new Queries();
$objSql = new SqlClass();
$exams_subject = new exams_subject();
$exams_course = new exams_course();
$exams_grades = new exams_grades();
$exams_chapters = new exams_chapters();


$curid=$_REQUEST['curid'];
 $subid=$_REQUEST['sid'];
 $course=$_REQUEST['course'];
 $grade2 = $_REQUEST['grade'];


$cur = $exams_curriculum->curriculum_name_select(cur_id,$curid);
$curri = $objSql->fetchRow($cur);
$sub= $exams_subject->subject_all_select($subid);
$subject = $objSql->fetchRow($sub);
$grade = $exams_grades->grades_all_select($grade2);
$grade1 = $objSql->fetchRow($grade);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo Site_Title; ?></title>
<link rel="shortcut icon" href="favicon.png" type="image/x-icon" />

<!--CSS/Style Sheet Part Starting-->
<link rel="stylesheet" href="css/site_styles.css" />
<!--CSS/Style Sheet Part Ending-->

<!-- Javascript Part Starting-->

<!-- Javascript Part Ending-->
</head>

<body>
<?php include 'includes/light_box.php'; ?>
<!-- Main Table with 3 columns -->
<table width="947" border="0" align="center" cellpadding="0" cellspacing="0">
<!-- Header Row Content -->
<?php
include_once 'includes/header.php';
?>
<!-- Header Row Content -->

<!-- Breadcrum() -->
<tr><td colspan="3" align="left" style="padding:5px; background-image:url(images/sprite_01.jpg); background-repeat:repeat-x;">&nbsp;<?php breadcrum(); ?></td></tr>
<!-- Breadcrum()-->

<!-- Middle Row Content -->
<tr>
   <td colspan="3" bgcolor="#FFFFFF" class="sprite_padding_1">

    <table width="100%" border="0" cellspacing="0" cellpadding="0" height="200">
      <tr>
        <!-- Left Coloumn Code -->
        <td width="185" style="padding-left:0px; padding-right:0px;" valign="top"><?php include_once 'tab_01_templete.php'; ?><?php include_once 'tab_03_templete.php'; ?></td>
        <!-- Center Coloumn Code -->
        <td width="*" style="padding-left:6px; padding-right:6px;" valign="top">
        
        <?php echo ucwords($_SESSION['msg']); if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="0%" ><img src="images/sprite_05.jpg" width="6" height="27" /></td>
            <td width="100%" background="images/sprite_07.jpg" class="content_head" ><strong><?=$grade1['grade_name']?> Grade <?=$curri['cur_name']?> Subjects</strong></td>
            <td width="0%" align="right" ><img src="images/sprite_06.jpg" width="6" height="27" /></td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top" class="sprite_padding_1" style="border-bottom:#ce3918 solid 1px;border-left:#ce3918 solid 1px;border-right:#ce3918 solid 1px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>  
																	  
					
					
															   
					 <?php 	$i =0;	
						  
					$chap3 = $exams_chapters->chapters_chapname_select($course);	
					if(is_array($chap3))
					{
						 for($i=1;$i<=(count($chap3)-2);$i++){
							
						   ?>
				
               
                  			<td align="center">
                            <div id="box">
                  <div class="sprite_font_box1" id="box_1"><?=$chap3[$i-1]->chap_name?></div>
                  <div id="box_2">
                           <img src="<?=$chap3[$i-1]->chap_image?>" width="113" height="76" border="0" />
                            </div>
                  <div id="box_3"><a href="online2.php?curid=<?=$curid?>&sid=<?=$subid?>&course=<?=$course?>&grade=<?=$grade2?>&chap=<?=$chap3[$i-1]->chap_id?>">Details</a></div>
                  </div>
                            </td>
                 <?php
								  if($i%3==0)
								  {
								  ?>
                </tr>
                <tr> 
                 <?
								  }
								
								  }
								  }
								  else
								  {
								   ?>
                                   <td align="center">No Grades Available Under <?php echo $curname[0]['cur_name']; ?></td>
                                   <?php
								  }
								  ?>
                <!-- /* <td align="center"><img src="images/cbse.png" width="165" height="111" border="0" usemap="#MapMap" /></td>
                  <td align="center"><img src="images/AIEEE.png" width="165" height="111" border="0" usemap="#Map2Map" /></td>
                  <td align="center"><img src="images/AIPMT.png" width="165" height="111" border="0" usemap="#Map3Map" /></td>
                  <td align="center"><img src="images/ICSE.png" width="165" height="111" border="0" usemap="#Map4Map" /></td>*/
                </tr>-->
               
                </tr>
            </table>
            </td>
          </tr>
        </table>
        </td>
        <!-- Right Coloumn Code -->
        <td width="0" style="padding-left:0px; padding-right:0px;" valign="top"></td>
      </tr>
    </table>

  </td>
</tr>
<!-- Middle Row Content -->

<!-- Footer Row Content -->
<?php
include_once 'includes/footer.php';
?>
<!-- Footer Row Content -->

</table>
<!-- Main Table Ending -->
</body>
</html>
