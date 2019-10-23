<?php
session_start();

include "lib/db.php";
user_login_check();	
	
	include_once "lib/class_exam_questions.php";
	include_once "lib/class_exam_course.php";
	include_once "lib/class_exam_grades.php";
	include_once "lib/class_exam_chapters.php";
	include_once "lib/class_exam_test.php";
	include_once'lib/class_exam_optque.php';
	$queries = new Queries();
	$objSql = new SqlClass();
	$exams_course = new exams_course();
	$exams_grades = new exams_grades();
	$exams_chapters = new exams_chapters();
	$exams_test = new exams_test();
	$exams_questions = new exams_questions();
	$exams_optque = new exams_optque();

			$chap = $_GET['chid'];
			$course =$_GET['cid'];
           	$test = $_GET['qid'];
			$num_of_tests = $exams_test->test_count($course,$chap);
			//echo "num_of_tests:".$num_of_tests;
			$cpname1 = $exams_chapters->chapters_sel(chap_id,$chap,1);
			$cname = $objSql->fetchrow($cpname1);

			$allcp = $exams_chapters->chapters_chapname_select($course,1);
			$s=count($allcp);

			$s--;
			$che2 = $allcp[$s]['chap_id'];


			if($cname['chap_id']==$che2)
			{ 
				include "modelquiz.php";
			}
			else
			{
				$tename = $exams_test->test_select(test_id,$test,1);	
				$test_name = $objSql->fetchrow($tename);
	
				$testname = $test_name['test_name'];
				$allnames= $exams_test->test_to_select($course,$chap,1);
	
				$hj=1;
			
				while($a=$objSql->fetchrow($allnames))
				{
					if($a['test_name']==$testname)
					{
						$tn=$hj;
					}
				  $time=$tename[0]->time;
				}
			
				$detcourse = $exams_course->course_select(course_id,$course); 
				$allcourse = $objSql->fetchrow($detcourse);
	
				$grade = $exams_grades->grades_all_select($allcourse['grade_id']);
				$gradeall= $objSql->fetchrow($grade);
				$i = 1;
						
			
			$curriculum = $allcourse['cur_id'];
			$grade_id = $allcourse['grade_id'];
			$sub_id = $allcourse['subject_id'];
			$op = $exams_optque->optque_select_all($curriculum,$sub_id,$grade_id);
			$opvalue = $objSql->fetchrow($op);
		
			 $aor =$opvalue["section_a"];
			 $bor =$opvalue["section_b"];
			 $or =$opvalue["section_c"];
			 $dor =$opvalue["section_d"];
			 	    
		//echo "in quiz";	
			function questions2($chapid,$course,$testnum,$section,$or)
			{
						$sql = "select * from test_questions where chapter_id =$chapid and section='".$section."' order by que_number ";
						$objSql = new SqlClass();
						$record = $objSql->executeSql($sql);
						$num_of_que= count($record);
						$exams_test = new exams_test();
						
						$num_of_tests = $exams_test->test_count($course,$chapid);
						$displyque = round($num_of_que/$num_of_tests);
			
						if($testnum == 1)
						{
							$min =0;
							$max = $displyque;
						}	
						else
						{ 
							$min =$displyque*($testnum-1);
							$max = $displyque*($testnum-1)+$displyque;
						}
						
						$sqlobject = new SqlClass();
						$sql55 = "select * from test_questions where chapter_id =$chapid and section='".$section."' order by que_number limit 0 , $displyque ";
						$s= $sqlobject->executeSql($sql55);
						
						$_SESSION[$section]=$section."-".$min."-".$max;
					
					while($num=$sqlobject->fetchRow($s))
					{
					  $queg[] = $num;
					}
					return $queg;
			}
						
			function options2($chapid,$section,$num)
			 {	
						$sql = "select * from test_options where chapter_id=$chapid and section ='". $section ."' and option_number = $num order by opt_id ";
						// echo $sql;
						$objSql = new SqlClass();
						$record = $objSql->executeSql($sql);
						return $record;
			 }

		}
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
            <td width="100%" background="images/sprite_07.jpg" class="content_head" ><strong>Question Paper</strong></td>
            <td width="0%" align="right" ><img src="images/sprite_06.jpg" width="6" height="27" /></td>
          </tr>
          <tr>
           <td colspan="3" align="left" valign="top" class="sprite_padding_1" style="border-bottom:#ce3918 solid 1px;border-left:#ce3918 solid 1px;border-right:#ce3918 solid 1px;">
           Code Starting Here<br />
<form name="testform" method="POST" action="results.php">

<!-- Table1 Starting -->
<table width="99%" border="0" align="right" cellpadding="0" cellspacing="0">
<tr><td colspan="3" align="center"><b><?=$cname['chap_name']?> (<?=$tename[0]->test_name?>)</b></td></tr>
<tr><td colspan="3" align="center"><b><?=$gradeall['grade_name']?></b></td></tr>
<tr><td colspan="3"><h3><?php include "rt.html" ;?></h3></td></tr>
<tr>
<td align="left"><b>[Time Allowed: <?=$time?> mins]</b></td>
<td>&nbsp;</td>
<td align="right"><div id="marks"></div></td>
</tr>
<tr>
<td colspan="3">
<!-- Table2 Starting -->
	<table width="100%" cellpadding="0" cellspacing="0">
	<tbody>
		<tr>
        <td>
<center><b>SECTION A</b></center>
<?php 
$ab = questions2($chap,$course,$tn,'section a',$aor);

if($aor!=0)
{
	$aquestions= $aquestions-1;
}

$alt=0;
$j=1;

foreach($ab as $row)
  {
	   if($j==$aor)
	   {
		  $i--;
		  echo  "<br><center><b>OR</b></center><br>";
	   }
	   else
	   {
		 echo "<fieldset><legend>Question ".$i."</legend>";
		  $k=0;
	   }
?>

<!-- Table3 Starting -->
<table width="100%" cellpadding="0" cellspacing="0">
<tbody>
<tr><td class="dispquestiontd">
<span style="font-size: 11pt; color: black;">
<?php 
$qe = str_replace("src='","src='admin/papers/",$row["question"]);
$qe = str_replace('src="','src="admin/papers/',$qe);
$qe = strip_tags($qe,"<p><span><img><a>");
echo $qe;
?>
</span>
<span style="font-weight: normal; text-decoration: none;">
  <o:p></o:p>
</span>
</td></tr>
</tbody></table>
<!-- Table3 Ending -->
  
<!-- Table4 Starting -->
<table align="center" width="100%" cellpadding="0" cellspacing="0" border="0">
<tbody>
<tr><td colspan="2">This data in Table 4</td></tr>
<?php

$opt = options2($row["chapter_id"],$row["section"],$row["que_number"]);

while($r=$objSql->fetchRow($opt))
	{
		 $re = str_replace("src='","src='admin/papers/",$r['options']);
		 $re = str_replace('src="','src="admin/papers/',$re);
		 $re = strip_tags($re,"<p><span><img><a>");

		$op = explode('#$',$re);
		
		$size =  sizeof($op);

		if($j==($aor-1) || $j==$aor)
		{ 
			for($a=0;$a<$size;$a++)
			{
				if($a%2==0)
				{
					print_r("<tr><td width='50%' class='dispquestiontd'><input type='radio' name='aabc' value='$alt'> ".$op[$a]."</td>");
				}
				else
				{
					print_r("<td width='50%' class='dispquestiontd'><input type='radio' name='aabc' value='$alt'> ".$op[$a]."</td></tr>");
				}
			$alt++;
			}
		}
		else
		{
			for($a=0;$a<$size;$a++)
			{
				if($a%2==0)
				{
					print_r("<tr><td width='50%' class='dispquestiontd'><input type='radio' name='a".$row["que_number"]."' value='$a'> ".$op[$a]."</td>");
				}
				else
				{
					print_r("<td width='50%' class='dispquestiontd'><input type='radio' name='a".$row["que_number"]."' value='$a'> ".$op[$a]."</td></tr>");
				}
			}
		}
	} // while Ending

	$j++; $i++; 
	
?>
</tbody></table>
<!-- Table4 Enidng -->
<?php 
 if($j!=$aor)
 {
	echo"</fieldset>";
 }
 }
 ?>
</td></tr></tbody></table>
<!-- Table2 Enidng -->


<input type="hidden" name="chap" value="<?=$chap?>">
<input type="hidden" name="bid" value="<?=$_GET['bid']?>">
<input type="hidden" name="tid" value="<?=$test?>">
<input type="hidden" name="courseid" value="<?=$course?>">

<input type="hidden"value="<?=$aquestions?>" name="anum">
<input type="hidden"value="<?=$bquestions?>" name="bnum"> 
<input type="hidden"value="<?=$cquestions?>" name="cnum">
<input type="hidden"value="<?=$dquestions?>" name="dnum">
<input type="hidden"value="<?=$aor?>" name="aor">
<input type="hidden"value="<?=$bor?>" name="bor">
<input type="hidden"value="<?=$or?>" name="or">
<input type="hidden"value="<?=$dor?>" name="dor">
<?php  $num_of_que =$aquestions+$bquestions+$cquestions+$dquestions;
//$total_marks = $aquestions*$opvalue["amarks"]+$bquestions*$opvalue["bmarks"]+$cquestions*$opvalue["cmarks"];
$total_marks = $aquestions*$opvalue["amarks"]+$bquestions*$opvalue["bmarks"]+$cquestions*$opvalue["cmarks"]+$dquestions*$opvalue["dmarks"];
?>
<input type="hidden"value="<?=$num_of_que?>" name="quenum">
<input type="hidden"value="<?=$total_marks?>" name="tmarks">
</tbody></table>
</form>
           Code Ending Here<br />
           
			<script language="javascript">
            document.getElementById('marks').innerHTML="<b>[Maximum Marks:<?php echo $total_marks;?>]</b>";
            </script>
           
       </td></tr></table>
           
           
           
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