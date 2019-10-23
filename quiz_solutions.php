<?php 
session_start();

include "lib/db.php";
include "lib/class_exam_questions.php";
include "lib/class_exam_course.php";
include "lib/class_exam_grades.php";
include "lib/class_exam_chapters.php";
include "lib/class_exam_test.php";
$queries = new Queries();
$objSql = new SqlClass();
$exams_course = new exams_course();
$exams_grades = new exams_grades();
$exams_chapters = new exams_chapters();
$exams_test = new exams_test();
$exams_questions = new exams_questions();

			$chap = $_GET['chid'];
 
 			$course =$_GET['cid'];
           	$test = $_GET['qid'];
			$cpname1 = $exams_chapters->chapters_sel(chap_id,$chap);
			$cname = $objSql->fetchrow($cpname1);
			$tename = $exams_test->test_select(test_id,$test);	
			$test_name = $objSql->fetchrow($tename);	
			$testname = $test_name['test_name'];
			$time=$tename[0]->time;
			$allnames= $exams_test->test_to_select($course,$chap);
			
			$hj=1;
			while($a = $objSql->fetchrow($allnames)){
			
			if($a['test_name']==$testname){
			
			$tn =$hj;}
			$hj++;
			}
			
			$detcourse = $exams_course->course_select(course_id,$course); 
				$allcourse = $objSql->fetchrow($detcourse);
				$grade = $exams_grades->grades_all_select($allcourse['grade_id']);
				$gradeall= $objSql->fetchrow($grade);
				$i = 1;
				$curriculum = $allcourse['cur_id'];
				$grade_id = $allcourse['grade_id'];
				$sub_id = $allcourse['subject_id'];
				 $aor = $_GET['aor'];
				 $bor = $_GET['bor'];
				 $or = $_GET['or'];
			$dor = $_GET['dor'];
function questions2($chapid,$course,$testnum,$section,$or){

			$sql = "select * from test_questions where chapter_id =$chapid and section='".$section."' order by que_number ";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$num_of_que= $objSql->getNumRecord($record);
			$exams_test = new exams_test();
		
			$num_of_tests = $exams_test->test_count($course,$chapid);
		
			$displyque = round($num_of_que/$num_of_tests);
			if($testnum == 1){$min =0;
			
			$max = $displyque;
	}	else { $min =$displyque*($testnum-1);
				$max = $displyque*($testnum-1)+$displyque;
	}	
	//echo $or;
	if($or ==0){ $max =$max;}else {$max =$max+1;}
	$sqlobject = new SqlClass();
			$sql55 = "select * from test_questions where chapter_id =$chapid and section='".$section."' order by que_number limit $min , $displyque ";
			$_SESSION[$section] =$section ."-".$min."-".$max;
				//echo $section ."-".$min."-".$max;
		$s= $sqlobject->executeSql($sql55);
		
		while($num=$sqlobject->fetchRow($s)){
		  $queg[] = $num;
		}
			return $queg;
			}
			
		 function options2($chapid ,$section,$num)
		 {	
					$sql = "select * from test_options where chapter_id=$chapid and section ='". $section ."' and option_number = $num order by opt_id ";
					// echo $sql;
					$objSql = new SqlClass();
					$record = $objSql->executeSql($sql);
					return $record;
		 }
  function correct($chapid ,$section,$num){
$sql= "select * from test_answers where 	chapter_id= $chapid  and section='$section' and ans_number=$num order by ans_id";
//echo $sql;
$objSql = new SqlClass();
$record = $objSql->executeSql($sql);
return $record;
}
function getpdf($chapid ,$section,$num){
$sql= "select * from test_pdf where chapterid= $chapid  and section ='$section' and queid=$num";
//echo $sql;
$objSql = new SqlClass();
$record = $objSql->executeSql($sql);
return $record;
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
            <td width="100%" background="images/sprite_07.jpg" class="content_head" ><strong></strong></td>
            <td width="0%" align="right" ><img src="images/sprite_06.jpg" width="6" height="27" /></td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top" class="sprite_padding_1" style="border-bottom:#ce3918 solid 1px;border-left:#ce3918 solid 1px;border-right:#ce3918 solid 1px;">
           
          <table border="0" width="100%"><tbody>
<tr><td colspan="3" align="center"><b><?=$cname['chap_name']?> (<?=$tename[0]->test_name?>)</b></td>
<td align="right">&nbsp;</td></tr><tr><td colspan="3" align="center"><b><?=$gradeall['grade_name']?></b></td></tr><tr><td colspan="3"><h3>
<div id="disp" style="position: absolute; left: 120px; width: 100px; height: 5px; visibility: hidden; top: 400px; background-color: rgb(255,0, 0);">hi</div>
<div id="layer1" style="position: absolute; left: 50px; width: 100px; height: 10px; visibility: visible; top: 220px;">
   <font face="verdana, arial, helvetica, sans-serif" size="2">
    <div style="float: left; background-color: white; padding: 0px; border: 0px solid black;">
 
<!--<input name="display" size="6" value="1:57:66" style="border: 0px solid white; font-weight: bold; font-size: 15px;" type="text">
--></div>  </font></div>
</h3></td></tr><tr>  <td align="left"><b>[Time Allowed: <?php echo $time;?> mins]</b></td>
  <td>&nbsp;</td><td align="right"><b>[Maximum Marks: <?php echo $_REQUEST['total'];?>]</b></td></tr>
<tr><td colspan="3" align="center"><hr><table width="100%"><tbody><tr><td>

<center><b>SECTION A</b></center>
<?php 

$ab = questions2($chap,$course,$tn,'section a',$aor);
$aquestions = sizeof($ab);
if($aor!=0)
{
$aquestions= $aquestions-1;
}
$alt=0;
 $j=1;
 foreach($ab as $row)
  {
   if($j==$aor ){
  $i--;
  	echo  "<br><center><b>OR</b></center><br>";
	
		}else {
?>

<fieldset><legend>Question <?=$i ?> </legend>
<?php  $k=0 ;
}?>
<table width="100%"><tbody><tr><td class="dispquestiontd">
<?php 
$que=str_replace("papers/","",$row["question"]);
$que=str_replace("src='","src='admin/papers/",$que);
$que=str_replace('src="','src="admin/papers/',$que);
$que= str_replace('<p','<span',$que);
		 $que= str_replace('</p>','</span>',$que);
		 $que=str_replace('<span ','<span class="dispquestion1"',$que);
$o1="<img";
		$d1="<img align='absmiddle'";
		$que = str_replace('<!--[endif]-->','',$que);
		 $que = str_replace('<!--[if !vml]-->','',$que);
		 $que = str_replace('<![if !vml]>','',$que);
		 $que = str_replace('<![endif]>','',$que);
		$que=str_replace($o1,$d1,$que);
		
echo $que;
?></td></tr></tbody></table><table align="center" width="100%"><tbody>
 <?php
 $opt = options2($row["chapter_id"],$row["section"],$row["que_number"]);

while($r=$objSql->fetchRow($opt))
		{
		$op = explode('#$',$r['options']);
		$size =  sizeof($op);
		if($j==($aor-1) || $j==$aor ){ 
		for($a=0;$a<$size;$a++){
		
		if($a%2==0){
		$opt=str_replace("papers/","",$op[$a]);
		
		$opt=str_replace("src='","src='admin/papers/",$opt);
		$opt=str_replace('src="','src="admin/papers/',$opt);
		$opt= str_replace('<p','<span',$opt);
		 $opt= str_replace('</p>','</span>',$opt);
		 $opt=str_replace('<span ','<span class="dispquestion1"',$opt);

		 
		$opt = str_replace('<!--[endif]-->','',$opt);
		 $opt = str_replace('<!--[if !vml]-->','',$opt);
		  $opt = str_replace('<![if !vml]>','',$opt);
         $opt = str_replace('<![endif]>','',$opt);
		print_r("<tr><td width='50%' class='dispquestiontd'><input type='radio' name='aabc' value='$alt'> ".$opt."</td>");
		}else{
		$opt=str_replace("papers/","",$op[$a]);
		$opt=str_replace("src='","src='admin/papers/",$opt);
		$opt=str_replace('src="','src="admin/papers/',$opt);
		$opt= str_replace('<p','<span',$opt);
		 $opt= str_replace('</p>','</span>',$opt);
		 $opt=str_replace('<span ','<span class="dispquestion1"',$opt);
		
		$opt = str_replace('<!--[endif]-->','',$opt);
		 $opt = str_replace('<!--[if !vml]-->','',$opt);
		  $opt = str_replace('<![if !vml]>','',$opt);
         $opt = str_replace('<![endif]>','',$opt);
		print_r("<td width='50%' class='dispquestiontd'><input type='radio' name='aabc' value='$alt'> ".$opt."</td></tr>");
		}
		$alt++;
		}
		}else {
		
			for($a=0;$a<$size;$a++){
			if($a%2==0){
			$opt=str_replace("papers/","",$op[$a]);
		$opt=str_replace("src='","src='admin/papers/",$opt);
		$opt=str_replace('src="','src="admin/papers/',$opt);
		$opt= str_replace('<p','<span',$opt);
		 $opt= str_replace('</p>','</span>',$opt);
		 $opt=str_replace('<span ','<span class="dispquestion1"',$opt);
		
			$o1="<img";
		$d1="<img align='absmiddle'";
		$opt = str_replace('<!--[endif]-->','',$opt);
		 $opt = str_replace('<!--[if !vml]-->','',$opt);
		  $opt = str_replace('<![if !vml]>','',$opt);
         $opt = str_replace('<![endif]>','',$opt);
		$opt=str_replace($o1,$d1,$opt);
		
		print_r("<tr><td width='50%' class='dispquestiontd'><input type='radio' name='a".$row["que_number"]."' value='$a'> ".$opt."</td>");
		}else{
		$opt=str_replace("papers/","",$op[$a]);
		$opt=str_replace("src='","src='admin/papers/",$opt);
		$opt=str_replace('src="','src="admin/papers/',$opt);
		$opt= str_replace('<p','<span',$opt);
		 $opt= str_replace('</p>','</span>',$opt);
		 $opt=str_replace('<span ','<span class="dispquestion1"',$opt);
		
		$o1="<img";
		$d1="<img align='absmiddle'";
		$opt=str_replace($o1,$d1,$opt);
		$opt = str_replace('<!--[endif]-->','',$opt);
		 $opt = str_replace('<!--[if !vml]-->','',$opt);
		  $opt = str_replace('<![if !vml]>','',$opt);
         $opt = str_replace('<![endif]>','',$opt);
		print_r("<td width='50%' class='dispquestiontd'><input type='radio' name='a".$row["que_number"]."' value='$a'> ".$opt."</td></tr>");
		}
	}
	}
	}
	$j++;
	$i++ ; 
	
		 ?>
<span style="font-weight: normal; text-decoration: none;"></span>

</td></tr>
<tr><td class="dispquestiontd" colspan="2"> <?php	//answer
	
		$answer = correct($row['chapter_id'],$row['section'],$row['que_number']);
		while($a=$objSql->fetchRow($answer))
		{
		$ans = explode('#$',$a['answer']);
		$answer=str_replace("papers/","",$ans[1]);
		$answer=str_replace("src='","src='admin/papers/",$answer);
		$answer=str_replace('src="','src="admin/papers/',$answer);
		$o1="<img";
		$d1="<img align='absmiddle'";
		$answer=str_replace($o1,$d1,$answer);
		$answer = str_replace('<!--[endif]-->','',$answer);
		 $answer = str_replace('<!--[if !vml]-->','',$answer);
		 $answer= str_replace('<p','<span',$answer);
		 $answer= str_replace('</p>','</span>',$answer);
		
		echo "<b>Answer: ".$answer."</b>";
		} ?></td> </tr>
        
        <?php 
        $pdf = getpdf($row['chapter_id'],$row['section'],$row['que_number']);
		$a=$objSql->fetchRow($pdf);
		$ans = $a['path'];
		if($ans!=''){
		?>
	  		<tr><td align="right" colspan="2">
        <a href="javascript:void()" onclick="window.open('admin/<?php echo $ans;?>','a','height=400,width=900,left=150,top=200,addressbar=no,toolbars=no,navigationbar=no,scrollbars=no,menubar=no,status=no')" style="text-decoration:none"><font color="#FF0000"><strong>View Descriptive Solution</strong></font></a></td>
		</td></tr>
		</td></tr>
        <?php }?>
</tbody></table>

 <?php 
 if($j!=$aor){
echo"</fieldset>";
 }
 }
 ?>

 <center><b>SECTION B</b></center>
 <?php 
$ab = questions2($chap,$course,$tn,'section b',$bor);
 $bquestions = sizeof($ab);

if($bor!=0)
{
 $bquestions= $bquestions-1;
}

$alt=0;
 $j=1;
 foreach($ab as $row)
  {
   if($j==$bor ){
  $i--;
  	echo  "<br><center><b>OR</b></center><br>";
	
		}else {
?>

<fieldset><legend>Question <?=$i ?> </legend>
<?php  $k=0 ;
}?>
<table width="100%"><tbody><tr><td class="dispquestiontd">
<?php 
$que=str_replace("papers/","",$row["question"]);
$que=str_replace("src='","src='admin/papers/",$que);
$que=str_replace('src="','src="admin/papers/',$que);
$que= str_replace('<p','<span',$que);
		 $que= str_replace('</p>','</span>',$que);
		 $que=str_replace('<span ','<span class="dispquestion1"',$que);

$que = str_replace('<!--[endif]-->','',$que);
		 $que = str_replace('<!--[if !vml]-->','',$que);
		  $que = str_replace('<![if !vml]>','',$que);
		 $que = str_replace('<![endif]>','',$que);
$o1="<img";
		$d1="<img align='absmiddle'";
		$que=str_replace($o1,$d1,$que);
echo $que;
?></td></tr></tbody></table><table align="center" width="100%"><tbody>
 <?php
 $opt = options2($row["chapter_id"],$row["section"],$row["que_number"]);

while($r=$objSql->fetchRow($opt))
		{
		$op = explode('#$',$r['options']);
		$size =  sizeof($op);
		if($j==($bor-1) || $j==$bor ){ 
		for($a=0;$a<$size;$a++){
		
		if($a%2==0){
		$opt=str_replace("papers/","",$op[$a]);
		$opt=str_replace("src='","src='admin/papers/",$opt);
		$opt=str_replace('src="','src="admin/papers/',$opt);
		$opt= str_replace('<p','<span',$opt);
		 $opt= str_replace('</p>','</span>',$opt);
		 $opt=str_replace('<span ','<span class="dispquestion1"',$opt);
		
		$o1="<img";
		$d1="<img align='absmiddle'";
		$opt=str_replace($o1,$d1,$opt);
		$opt = str_replace('<!--[endif]-->','',$opt);
		 $opt = str_replace('<!--[if !vml]-->','',$opt);
		  $opt = str_replace('<![if !vml]>','',$opt);
         $opt = str_replace('<![endif]>','',$opt);
		print_r("<tr><td width='50%' class='dispquestiontd'><input type='radio' name='babc' value='$alt'> ".$opt."</td>");
		}else{
		$opt=str_replace("papers/","",$op[$a]);
		$opt=str_replace("src='","src='admin/papers/",$opt);
		$opt=str_replace('src="','src="admin/papers/',$opt);
		$opt= str_replace('<p','<span',$opt);
		 $opt= str_replace('</p>','</span>',$opt);
		 $opt=str_replace('<span ','<span class="dispquestion1"',$opt);
		
		$o1="<img";
		$d1="<img align='absmiddle'";
		$opt = str_replace('<!--[endif]-->','',$opt);
		 $opt = str_replace('<!--[if !vml]-->','',$opt);
		  $opt = str_replace('<![if !vml]>','',$opt);
         $opt = str_replace('<![endif]>','',$opt);
		$opt=str_replace($o1,$d1,$opt);
		print_r("<td width='50%' class='dispquestiontd'><input type='radio' name='babc' value='$alt'> ".$opt."</td></tr>");
		}
		$alt++;
		}
		}else {
		
			for($a=0;$a<$size;$a++){
			if($a%2==0){
			$opt=str_replace("papers/","",$op[$a]);
		$opt=str_replace("src='","src='admin/papers/",$opt);
		$opt=str_replace('src="','src="admin/papers/',$opt);
		$opt= str_replace('<p','<span',$opt);
		 $opt= str_replace('</p>','</span>',$opt);
		 $opt=str_replace('<span ','<span class="dispquestion1"',$opt);
		
		$o1="<img";
		$d1="<img align='absmiddle'";
		$opt=str_replace($o1,$d1,$opt);
		$opt = str_replace('<!--[endif]-->','',$opt);
		 $opt = str_replace('<!--[if !vml]-->','',$opt);
		  $opt = str_replace('<![if !vml]>','',$opt);
         $opt = str_replace('<![endif]>','',$opt);
		print_r("<tr><td width='50%' class='dispquestiontd'><input type='radio' name='b".$row["que_number"]."' value='$a'> ".$opt."</td>");
		}else{
		$opt=str_replace("papers/","",$op[$a]);
		$opt=str_replace("src='","src='admin/papers/",$opt);
		$opt=str_replace('src="','src="admin/papers/',$opt);
		$opt= str_replace('<p','<span',$opt);
		 $opt= str_replace('</p>','</span>',$opt);
		 $opt=str_replace('<span ','<span class="dispquestion1"',$opt);
		
		$o1="<img";
		$d1="<img align='absmiddle'";
		$opt=str_replace($o1,$d1,$opt);
		$opt = str_replace('<!--[endif]-->','',$opt);
		 $opt = str_replace('<!--[if !vml]-->','',$opt);
		  $opt = str_replace('<![if !vml]>','',$opt);
         $opt = str_replace('<![endif]>','',$opt);
		print_r("<td width='50%' class='dispquestiontd'><input type='radio' name='b".$row["que_number"]."' value='$a'> ".$opt."</td></tr>");
		}
	}
	}
	}
	$j++;
	$i++ ; 
	
		 ?>
<span style="font-weight: normal; text-decoration: none;"></span>

</td></tr>
<tr><td class="dispquestiontd" colspan="2"> <?php	//answer
	
		$answer = correct($row['chapter_id'],$row['section'],$row['que_number']);
			while($a=$objSql->fetchRow($answer))
		{
		$ans = explode('#$',$a['answer']);
		$answer=str_replace("papers/","",$ans[1]);
		$answer=str_replace("src='","src='admin/papers/",$answer);
		$answer=str_replace('src="','src="admin/papers/',$answer);
		$o1="<img";
		$d1="<img align='absmiddle'";
		$answer = str_replace('<!--[endif]-->','',$answer);
		 $answer = str_replace('<!--[if !vml]-->','',$answer);
		 $answer= str_replace('<p','<span',$answer);
		 $answer= str_replace('</p>','</span>',$answer);
		$answer=str_replace($o1,$d1,$answer);
		
		
		echo "<b>Answer: ".$answer."</b>";
	  
		} ?></td> </tr>
        <?php 
        $pdf = getpdf($row['chapter_id'],$row['section'],$row['que_number']);
		$a=$objSql->fetchRow($pdf);
		$ans = $a['path'];
		//print_r($ans);
		if($ans!=''){
		?>
	 <tr><td align="right" colspan="2">
        <a href="javascript:void()" onclick="window.open('admin/<?php echo $ans;?>','a','height=400,width=900,left=150,top=200,addressbar=no,toolbars=no,navigationbar=no,scrollbars=no,menubar=no,status=no')" style="text-decoration:none"><font color="#FF0000"><strong>View Descriptive Solution</strong></font></a>
		</td></tr>
        <?php } ?>
</tbody></table>

 <?php 
 if($j!=$bor){
echo"</fieldset>";
 }
 }
 echo"</fieldset>";
 ?>

 
 
<center><b>SECTION C</b></center>
<?php


 $ab = questions2($chap,$course,$tn,'section c',$or);
$cquestions = sizeof($ab);
if($or!=0)
{
$cquestions= $cquestions-1;
}

 $alt=0;
 $j=1;
 foreach($ab as $row)
  {
   if($j==$or ){
  $i--;
  	echo  "<br><center><b>OR</b></center><br>";
	
		}else {
?>

<fieldset><legend>Question <?=$i ?> </legend>
<?php  $k=0 ;
}?>
<table width="100%"><tbody><tr><td class="dispquestiontd">
<?php 
$que=str_replace("papers/","",$row["question"]);
$que=str_replace("src='","src='admin/papers/",$que);
$que=str_replace('src="','src="admin/papers/',$que);
$que= str_replace('<p','<span',$que);
		 $que= str_replace('</p>','</span>',$que);
		 $que=str_replace('<span ','<span class="dispquestion1"',$que);

$o1="<img";
		$d1="<img align='absmiddle'";
		$que=str_replace($o1,$d1,$que);
		$que = str_replace('<!--[endif]-->','',$que);
		 $que = str_replace('<!--[if !vml]-->','',$que);
		  $que = str_replace('<![if !vml]>','',$que);
		 $que = str_replace('<![endif]>','',$que);
echo $que;
?>
</td></tr></tbody></table><table align="center" width="100%"><tbody>
 <?php
 $opt = options2($row["chapter_id"],$row["section"],$row["que_number"]);

while($r=$objSql->fetchRow($opt))
		{
		$op = explode('#$',$r['options']);
		$size =  sizeof($op);
		if($j==($or-1) || $j==$or ){ 
		for($a=0;$a<$size;$a++){
		
		if($a%2==0){
		$opt=str_replace("papers/","",$op[$a]);
		$opt=str_replace("src='","src='admin/papers/",$opt);
		$opt=str_replace('src="','src="admin/papers/',$opt);
		$opt= str_replace('<p','<span',$opt);
		 $opt= str_replace('</p>','</span>',$opt);
		 $opt=str_replace('<span ','<span class="dispquestion1"',$opt);
		
		$o1="<img";
		$d1="<img align='absmiddle'";
		$opt = str_replace('<!--[endif]-->','',$opt);
		 $opt = str_replace('<!--[if !vml]-->','',$opt);
		  $opt = str_replace('<![if !vml]>','',$opt);
         $opt = str_replace('<![endif]>','',$opt);
		$opt=str_replace($o1,$d1,$opt);
		print_r("<tr><td width='50%' class='dispquestiontd'><input type='radio' name='abc' value='$alt'> ".$opt."</td>");
		}else{
		$opt=str_replace("papers/","",$op[$a]);
		$opt=str_replace("src='","src='admin/papers/",$opt);
		$opt=str_replace('src="','src="admin/papers/',$opt);
		$opt= str_replace('<p','<span',$opt);
		 $opt= str_replace('</p>','</span>',$opt);
		 $opt=str_replace('<span ','<span class="dispquestion1"',$opt);
		
		$o1="<img";
		$d1="<img align='absmiddle'";
		$opt = str_replace('<!--[endif]-->','',$opt);
		 $opt = str_replace('<!--[if !vml]-->','',$opt);
		  $opt = str_replace('<![if !vml]>','',$opt);
         $opt = str_replace('<![endif]>','',$opt);
		$opt=str_replace($o1,$d1,$opt);
		print_r("<td width='50%' class='dispquestiontd'><input type='radio' name='abc' value='$alt'> ".$opt."</td></tr>");
		}
		$alt++;
		}
		}else {
		
			for($a=0;$a<$size;$a++){
			if($a%2==0){
			$opt=str_replace("papers/","",$op[$a]);
		$opt=str_replace("src='","src='admin/papers/",$opt);
		$opt=str_replace('src="','src="admin/papers/',$opt);
		$opt= str_replace('<p','<span',$opt);
		 $opt= str_replace('</p>','</span>',$opt);
		 $opt=str_replace('<span ','<span class="dispquestion1"',$opt);
		
		$o1="<img";
		$d1="<img align='absmiddle'";
		$opt=str_replace($o1,$d1,$opt);
		$opt = str_replace('<!--[endif]-->','',$opt);
		 $opt = str_replace('<!--[if !vml]-->','',$opt);
		  $opt = str_replace('<![if !vml]>','',$opt);
         $opt = str_replace('<![endif]>','',$opt);
		print_r("<tr><td width='50%' class='dispquestiontd'><input type='radio' name='c".$row["que_number"]."' value='$a'> ".$opt."</td>");
		}else{
		$opt=str_replace("papers/","",$op[$a]);
		$opt=str_replace("src='","src='admin/papers/",$opt);
		$opt=str_replace('src="','src="admin/papers/',$opt);
		$opt= str_replace('<p','<span',$opt);
		 $opt= str_replace('</p>','</span>',$opt);
		 $opt=str_replace('<span ','<span class="dispquestion1"',$opt);
		
		$o1="<img";
		$d1="<img align='absmiddle'";
		$opt=str_replace($o1,$d1,$opt);
		$opt = str_replace('<!--[endif]-->','',$opt);
		 $opt = str_replace('<!--[if !vml]-->','',$opt);
		  $opt = str_replace('<![if !vml]>','',$opt);
         $opt = str_replace('<![endif]>','',$opt);
		print_r("<td width='50%' class='dispquestiontd'><input type='radio' name='c".$row["que_number"]."' value='$a'> ".$opt."</td></tr>");
		}
	}
	}
	}
	$j++;
	$i++ ; 
	
		 ?>
<span style="font-weight: normal; text-decoration: none;"></span>

</td></tr>
<tr><td class="dispquestiontd" colspan="2"><?php	//answer
	
		$answer = correct($row['chapter_id'],$row['section'],$row['que_number']);
			while($a=$objSql->fetchRow($answer))
		{
		$ans = explode('#$',$a['answer']);
		
	  			$answer=str_replace("papers/","",$ans[1]);
		$answer=str_replace("src='","src='admin/papers/",$answer);

	$answer=str_replace('src="','src="admin/papers/',$answer);
	$o1="<img";
		$d1="<img align='absmiddle'";
		$answer=str_replace($o1,$d1,$answer);
		$answer= str_replace('<p','<span',$answer);
		 $answer= str_replace('</p>','</span>',$answer);
		$answer = str_replace('<!--[endif]-->','',$answer);
		 $answer = str_replace('<!--[if !vml]-->','',$answer);
		 $answer= str_replace('<p','<span',$answer);
		 $answer= str_replace('</p>','</span>',$answer);
		echo "<b>Answer: ".$answer."</b>";
		} ?></td> </tr>
        <?php 
        $pdf = getpdf($row['chapter_id'],$row['section'],$row['que_number']);
		$a=$objSql->fetchRow($pdf);
		$ans = $a['path'];
		//print_r($ans);
		if($ans!=''){
		?>
	<tr><td align="right" colspan="2">
        <a href="javascript:void()" onclick="window.open('admin/<?php echo $ans;?>','a','height=400,width=900,left=150,top=200,addressbar=no,toolbars=no,navigationbar=no,scrollbars=no,menubar=no,status=no')" style="text-decoration:none"><font color="#FF0000"><strong>View Descriptive Solution</strong></font></a></td>
		</td></tr>
        <?php }?>
</tbody></table>

 <?php 
 if($j!=$or){
echo"</fieldset>";
 }
 }
 ?>
 <?php 
 
$sec=0;
	if($sub_id ==12){	
 if($grade_id==19 || $grade_id==20){
$sec ="1";
//echo "9th,10th";
 }else{
 $sec ="0";
 //echo "diif grade";
 }
} 
 if($sub_id !=12){	
$sec ="1";
 }
 
	if($sub_id !=12){	

$sec ="1";
//echo "all";
 }
 if($sec==1){
 ?>


<center><b>SECTION D</b></center>
<?php


 $ab = questions2($chap,$course,$tn,'section d',$dor);
$cquestions = sizeof($ab);
if($dor!=0)
{
$cquestions= $cquestions-1;
}

 $alt=0;
 $j=1;
 foreach($ab as $row)
  {
   if($j==$dor ){
  $i--;
  	echo  "<br><center><b>OR</b></center><br>";
	
		}else {
?>

<fieldset><legend>Question <?=$i ?> </legend>
<?php  $k=0 ;
}?>
<table width="100%"><tbody><tr><td class="dispquestiontd">
<?php 
$que=str_replace("papers/","",$row["question"]);
$que=str_replace("src='","src='admin/papers/",$que);
$que=str_replace('src="','src="admin/papers/',$que);
$que= str_replace('<p','<span',$que);
		 $que= str_replace('</p>','</span>',$que);
		 $que=str_replace('<span ','<span class="dispquestion1"',$que);

$o1="<img";
		$d1="<img align='absmiddle'";
		$que=str_replace($o1,$d1,$que);
		$que = str_replace('<!--[endif]-->','',$que);
		 $que = str_replace('<!--[if !vml]-->','',$que);
		  $que = str_replace('<![if !vml]>','',$que);
		 $que = str_replace('<![endif]>','',$que);
echo $que;
?>
</td></tr></tbody></table><table align="center" width="100%"><tbody>
 <?php
 $opt = options2($row["chapter_id"],$row["section"],$row["que_number"]);

while($r=$objSql->fetchRow($opt))
		{
		$op = explode('#$',$r['options']);
		$size =  sizeof($op);
		if($j==($dor-1) || $j==$dor ){ 
		for($a=0;$a<$size;$a++){
		
		if($a%2==0){
		$opt=str_replace("papers/","",$op[$a]);
		$opt=str_replace("src='","src='admin/papers/",$opt);
		$opt=str_replace('src="','src="admin/papers/',$opt);
		$opt= str_replace('<p','<span',$opt);
		 $opt= str_replace('</p>','</span>',$opt);
		 $opt=str_replace('<span ','<span class="dispquestion1"',$opt);
		
		$o1="<img";
		$d1="<img align='absmiddle'";
		$opt = str_replace('<!--[endif]-->','',$opt);
		 $opt = str_replace('<!--[if !vml]-->','',$opt);
		  $opt = str_replace('<![if !vml]>','',$opt);
         $opt = str_replace('<![endif]>','',$opt);
		$opt=str_replace($o1,$d1,$opt);
		print_r("<tr><td width='50%' class='dispquestiontd'><input type='radio' name='abc' value='$alt'> ".$opt."</td>");
		}else{
		$opt=str_replace("papers/","",$op[$a]);
		$opt=str_replace("src='","src='admin/papers/",$opt);
		$opt=str_replace('src="','src="admin/papers/',$opt);
		$opt= str_replace('<p','<span',$opt);
		 $opt= str_replace('</p>','</span>',$opt);
		 $opt=str_replace('<span ','<span class="dispquestion1"',$opt);
		
		$o1="<img";
		$d1="<img align='absmiddle'";
		$opt = str_replace('<!--[endif]-->','',$opt);
		 $opt = str_replace('<!--[if !vml]-->','',$opt);
		  $opt = str_replace('<![if !vml]>','',$opt);
         $opt = str_replace('<![endif]>','',$opt);
		$opt=str_replace($o1,$d1,$opt);
		print_r("<td width='50%' class='dispquestiontd'><input type='radio' name='abc' value='$alt'> ".$opt."</td></tr>");
		}
		$alt++;
		}
		}else {
		
			for($a=0;$a<$size;$a++){
			if($a%2==0){
			$opt=str_replace("papers/","",$op[$a]);
		$opt=str_replace("src='","src='admin/papers/",$opt);
		$opt=str_replace('src="','src="admin/papers/',$opt);
		$opt= str_replace('<p','<span',$opt);
		 $opt= str_replace('</p>','</span>',$opt);
		 $opt=str_replace('<span ','<span class="dispquestion1"',$opt);
		
		$o1="<img";
		$d1="<img align='absmiddle'";
		$opt=str_replace($o1,$d1,$opt);
		$opt = str_replace('<!--[endif]-->','',$opt);
		 $opt = str_replace('<!--[if !vml]-->','',$opt);
		  $opt = str_replace('<![if !vml]>','',$opt);
         $opt = str_replace('<![endif]>','',$opt);
		print_r("<tr><td width='50%' class='dispquestiontd'><input type='radio' name='c".$row["que_number"]."' value='$a'> ".$opt."</td>");
		}else{
		$opt=str_replace("papers/","",$op[$a]);
		$opt=str_replace("src='","src='admin/papers/",$opt);
		$opt=str_replace('src="','src="admin/papers/',$opt);
		$opt= str_replace('<p','<span',$opt);
		 $opt= str_replace('</p>','</span>',$opt);
		 $opt=str_replace('<span ','<span class="dispquestion1"',$opt);
		
		$o1="<img";
		$d1="<img align='absmiddle'";
		$opt=str_replace($o1,$d1,$opt);
		$opt = str_replace('<!--[endif]-->','',$opt);
		 $opt = str_replace('<!--[if !vml]-->','',$opt);
		  $opt = str_replace('<![if !vml]>','',$opt);
         $opt = str_replace('<![endif]>','',$opt);
		print_r("<td width='50%' class='dispquestiontd'><input type='radio' name='c".$row["que_number"]."' value='$a'> ".$opt."</td></tr>");
		}
	}
	}
	}
	$j++;
	$i++ ; 
	
		 ?>
<span style="font-weight: normal; text-decoration: none;"></span>

</td></tr>
<tr><td class="dispquestiontd" colspan="2"> <?php	//answer
	
		$answer = correct($row['chapter_id'],$row['section'],$row['que_number']);
			while($a=$objSql->fetchRow($answer))
		{
		$ans = explode('#$',$a['answer']);
		
	  			$answer=str_replace("papers/","",$ans[1]);
		$answer=str_replace("src='","src='admin/papers/",$answer);

	$answer=str_replace('src="','src="admin/papers/',$answer);
	$o1="<img";
		$d1="<img align='absmiddle'";
		$answer=str_replace($o1,$d1,$answer);
		$answer= str_replace('<p','<span',$answer);
		 $answer= str_replace('</p>','</span>',$answer);
		$answer = str_replace('<!--[endif]-->','',$answer);
		 $answer = str_replace('<!--[if !vml]-->','',$answer);
		 $answer= str_replace('<p','<span',$answer);
		 $answer= str_replace('</p>','</span>',$answer);
		echo "<b>Answer: ".$answer."</b>";
		} ?></td> </tr>
        <?php 
        $pdf = getpdf($row['chapter_id'],$row['section'],$row['que_number']);
		$a=$objSql->fetchRow($pdf);
		$ans = $a['path'];
		//print_r($ans);
		if($ans!=''){
		?>
	<tr><td align="right" colspan="2">
        <a href="javascript:void()" onclick="window.open('admin/<?php echo $ans;?>','a','height=400,width=900,left=150,top=200,addressbar=no,toolbars=no,navigationbar=no,scrollbars=no,menubar=no,status=no')" style="text-decoration:none"><font color="#FF0000"><strong>View Descriptive Solution</strong></font></a></td>
		</td></tr>
        <?php }?>
</tbody></table>

 <?php 
 if($j!=$dor){
echo"</fieldset>";
 }
 }
 }
 
 ?>




        
        
       </td>
  </tr>
  
 </table>
           
           
           
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
