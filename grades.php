<?php
session_start();
include_once 'lib/db.php';
include "lib/class_exam_curriculum.php";
include "lib/class_exam_subject.php";
include "lib/class_exam_course.php";
include "lib/class_exam_grades.php";
user_login_check();	
$queries = new Queries();
$objSql = new SqlClass();
$curiculum=new exams_curriculum();
$exams_subject = new exams_subject();
$exams_course = new exams_course();
$exams_grades = new exams_grades();
$curid=$_REQUEST['curid'];
$subid=$_REQUEST['sid'];
if($subid=="")
{
	$subid =0;
}

$course1 = $exams_course->course_to_select($subid,$curid,$_SESSION['school_id']);
//$crow =$objSql->fetchRow($course1);

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
            <td width="100%" background="images/sprite_07.jpg" class="content_head" ><strong><?php $curname=$curiculum->curriculum_name_select($curid);echo $curname[0]['cur_name'] ?> Grades</strong></td>
            <td width="0%" align="right" ><img src="images/sprite_06.jpg" width="6" height="27" /></td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top" class="sprite_padding_1 main_box_border">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr> <?php
								    $i =1;
									
								if(is_array($course1))
								{	
						   		while($crow =$objSql->fetchRow($course1))
								{
								$grade = $exams_grades->grades_all_select($crow['grade_id'],1);
								$grow = $objSql->fetchRow($grade);
					 			$fgh="select * from user_grade where user_id='".$_SESSION['user_id']."' and grade='".$crow['grade_id']."' and status='active' and cur_id='".$curid."'";
								$sw=new sqlClass();
								$res=$sw->executeSql($fgh);
								$num=$sw->getNumRecord();
								$num=2;
								?>
               
                  <td align="center"><a href="subjects.php?curid=<?php echo $curid?>&sid=<?php echo $subid?>&course=<?php echo $crow['course_id']?>&grade=<?php echo $grow['grade_id']?>"><img src="gradeimages/<?=$grow['grade_image']?>" width="130" height="130" border="0" /></td>
                 <?php
				  if($i%4==0)
				  {
				  ?>
                </tr>
                <tr> 
                 <?
					  }
					  $i++;
					  }
					  }
					  else
					  {
					   ?>
					   <td align="center">No Grades Available Under <?php echo $curname[0]['cur_name']; ?></td>
					   <?php
					  }
					  ?>
               
               
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
