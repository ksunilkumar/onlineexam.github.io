<?php
include_once'../../../lib/db.php';
include_once'../../../lib/class_exam_course.php';
include_once'../../../lib/class_exam_chapters.php';
include_once'../../../lib/class_exam_curriculum.php';
include_once'../../../lib/class_exam_grades.php';
$queries = new Queries();
$objSql = new SqlClass();
$exams_course = new exams_course();
$exams_chapters = new exams_chapters();
$exams_curriculum = new exams_curriculum();
$exams_grades = new exams_grades();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" dir="ltr" xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="edit.php_files/styles.css">

   

  <form action="" method="post" accept-charset="utf-8" id="mform1" name="mform1" class="mform" onsubmit="return chkform()">
	<input type="hidden" name="id" value="<?php echo $chapid;?>" />	<input type="hidden" name="cid" value="<?php echo $couid;?>" />
  <table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="global">
										<tbody>
											
											<tr><td colspan="3"><?php // echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td></tr>
											
                                            <tr>
												<td align="center" colspan="6"><h2>edit Test</h2></td>
											</tr>
											<tr>
												<td colspan="6">  
 <table cellpadding="0" cellspacing="0" class="tborder" width="100%">
 <tr><td width="46%" align="right">Grade</td>
 <td width="54%"><?php 

 $chapid = $_GET["id"];
 $courseid = $_GET["cid"];

$cour = $exams_course->course_select("course_id",$courseid);

$rows = $objSql->fetchRow($cour);


$grade = $exams_grades->grades_all_select($rows['grade_id']);

$row1 = $objSql->fetchRow($grade);
echo $row1['grade_name'];

?></td>
 </tr>
  <tr><td align="right">Curriculum</td><td><?php
$cur =$exams_curriculum->curriculum_name_select("cur_id",$rows['cur_id']);
$rowcur = $objSql->fetchRow($cur);
echo $rowcur['cur_name'];
?></td></tr>
   <tr><td align="right">Chapter</td><td><?php
 $chap = $exams_chapters->chapters_sel("chap_id",$chapid,$_SESSION['school_id']);
while($row1 = $objSql->fetchRow($chap)){
echo $row1['chap_name'];

}
?></td></tr>
    <tr><td align="right">Quiz Full nam</td><td><input maxlength="254" size="50" name="testname" value="" type="text"></td></tr>
     <tr><td align="right">Quiz Heading</td><td><input maxlength="100" size="20" name="testheading" value=""  type="text"></td></tr>
     <tr><td align="right"> Quiz Time</td><td><input maxlength="100" size="20" name="time" id="time" value=""  type="text"> 
          (In Minutes)</td></tr>
           <tr><td align="center" colspan="2"><input name="submitbutton" value="Save changes" type="submit">
</td></tr>
          
     </table></td></tr></tbody></table>
<!--<fieldset class="clearfix" >
		<legend class="ftoggler">General Quiz Settings </legend>
		<div class="advancedbutton"></div>
		<div class="fcontainer clearfix">
		</div>

<div class="fitem">

<div class="fitemtitle">Grade

<img src="edit.php_files/help.gif"  /></div><div class="felement fselect">
<?php 

 $chapid = $_GET["id"];
 $courseid = $_GET["cid"];

$cour = $exams_course->course_select("course_id",$courseid);

$rows = $objSql->fetchRow($cour);


$grade = $exams_grades->grades_all_select($rows['grade_id']);

$row1 = $objSql->fetchRow($grade);
echo $row1['grade_name'];

?>
   </div></div>

<div class="fitem"><div class="fitemtitle">Curriculum 

<img src="edit.php_files/help.gif"  /></div><div class="felement fselect">
<?php
$cur =$exams_curriculum->curriculum_name_select("cur_id",$rows['cur_id']);
$rowcur = $objSql->fetchRow($cur);
echo $rowcur['cur_name'];
?></div></div>
<div class="fitem"><div class="fitemtitle">Chapter 

<img src="edit.php_files/help.gif"  /></div><div class="felement fselect">
<?php
 $chap = $exams_chapters->chapters_sel("chap_id",$chapid,$_SESSION['school_id']);
while($row1 = $objSql->fetchRow($chap)){
echo $row1['chap_name'];

}
?>
</div>

<div class="fitem required">
<div class="fitemtitle">
		  Quiz Full name<img  src="edit.php_files/req.gif">
		 <img src="edit.php_files/help.gif"  />
		</div><div class="felement ftext"><input maxlength="254" size="50" name="testname" value="" type="text"></div></div>
		<div class="fitem required"><div class="fitemtitle">
		
		 Quiz Short name<img  src="edit.php_files/req.gif"><img src="edit.php_files/help.gif"  />
		</div><div class="felement ftext"><input maxlength="100" size="20" name="testheading" value=""  type="text"></div></div>
				
		
	
		</div>
        <div class="fitem required">
          <div class="fitemtitle">
		
		 Quiz Time <img  src="edit.php_files/req.gif"><img src="edit.php_files/help.gif"  />
		</div>
          <div class="felement ftext"><input maxlength="100" size="20" name="time" id="time" value=""  type="text"> 
          (In Minutes)</div>
          
        </div>
		<div class="fitem"></div>
	<div class="fitem"></div>
		</div>

<div class="fitem"></div>
</div></label></fieldset>


<fieldset class="hidden"><div>
 <div class="fitem"><div class="fitemtitle"><div class="fgrouplabel">
<input name="submitbutton" value="Save changes" type="submit"> </fieldset></div>
<div class="fdescription required">There are required fields in this form marked.</div>
		</div></fieldset>

</div>

</body></html>-->

</form>




		




