<?php
	
	session_start();
	include_once'lib/db.php';
	include_once'lib/class_exam_optque.php';
	include_once'lib/class_exam_answers.php';
	include_once'lib/class_exam_bag.php';
    include "lib/class_exam_course.php";
	include "lib/class_exam_chapters.php";
	include "lib/class_exam_test.php";
	$queries = new Queries();
	$objSql = new SqlClass();
	$exams_bag = new exams_bag();
	$exams_course = new exams_course();
	$exams_optque = new exams_optque();
	$exams_chapters = new exams_chapters();
	$exams_test = new exams_test();
	$course =$_POST['courseid'];
	$chap = $_POST["chap"];
	$quiz = $_POST['tid'] ;

 	$detcourse = $exams_course->course_select(course_id,$course); 
 	$allcourse = $objSql->fetchrow($detcourse);
 	$curriculum = $allcourse['cur_id'];
 	$grade_id = $allcourse['grade_id'];
	$sub_id = $allcourse['subject_id'];
	$op = $exams_optque->optque_select_all($curriculum,$sub_id,$grade_id);
	$opvalue = $objSql->fetchrow($op);
 	$am = $opvalue['amarks'];
	$bm  =$opvalue['bmarks'];
	$cm =$opvalue['cmarks'];
	$dm = $opvalue['dmarks'];
	//print_r($opvalue);
	$test = $_REQUEST['tid'];
	 function correct($chapid,$section,$min,$max){
		$sql= "select * from test_answers where chapter_id =$chapid and section='$section'  order by ans_number limit $min , $max";
		//echo $sql."<br>";
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		return $record;
	}

	//echo "<pre>";
	//get section a
	 $sessiona = $_SESSION['section a'];
	 $total_attened=0;
	 $ss = explode("-",$sessiona);
	 for($i=$ss[1]+1;$i<=$ss[2]+1;$i++){
	    	$a[]= $_POST["a$i"];
	 }
	 //print_r($a);
	//get section b
	
	$sessionb = $_SESSION['section b'];
	$ssb = explode("-",$sessionb);
	for($i=$ssb[1]+1;$i<=$ssb[2]+1;$i++){
	  	 $b[]= $_POST["b$i"];
	}
	
	//get section c
	$sessionc = $_SESSION['section c'];
	$ssc = explode("-",$sessionc);
	for($i=$ssc[1]+1;$i<=$ssc[2]+1;$i++){
	 	$c[]= $_POST["c$i"];
	}
	// print_r($c);
	$sessiond = $_SESSION['section d'];
	$ssd = explode("-",$sessiond);
	for($i=$ssd[1]+1;$i<=$ssd[2]+1;$i++){
	 	$d[]= $_POST["d$i"];
	}
	
	$amarks =0;
	$attan = 0;
	$i=0;
	//section a
	$aor = $_POST['aor'];
	$answer =correct($chap,'section a' , $ss[1] ,$ss[2]-0);
	$altque1 = $_POST['aabc'];
	while($row=$objSql->fetchRow($answer)){
		
		$ans = explode('#$',$row['answer']);
		$val_1=trim($a[$i]);
		$val_2=trim(strip_tags($ans[0]));
		if($aor!=0){
			if($i==($aor-2)){
			if($altque1 <4){
				$val_1 = $altque1;
	   		}
	 	}
		if ($val_1!= null){$val_1++;$total_attened=$total_attened+1;}
		if($i==$aor-1){
			 if($altque1>=4){
				$val_1 = $altque1-3;
			  }
		}
		//echo $val_1.",val_2 : ".$val_2. "<br>";
		if(($val_1)==($val_2)){
			$amarks++;
			$attan++;
			
		}
	} else if($aor==0){
	

		 if ($val_1!= null){$val_1++;$total_attened=$total_attened+1;}
		 
					// echo $val_1.",val_2 : ".$val_2. "<br>";		 
			 if(($val_1)==($val_2))
			 {
				$amarks++;
				$attan++;
			}
 		}
		 
		$i++;
	}
//echo "Section a end"."<br>";
//echo "marks".$amarks ;


/*if ($val_1!= null){$val_1++;}
if(($val_1)==($val_2)){
 $amarks++;
//echo "aaaaaaa $i option".$val_1."ans".$val_2 ."<br>";
}else
{		}	
		$i++;
}*/
//section b
	$bmarks =0;
	$i=0;
	$bor = $_POST['bor'];
	$bans =correct($chap,'section b' ,$ssb[1] ,$ssb[2]-0);
	$altque2 = $_POST['babc'];
	while($row=$objSql->fetchRow($bans)){
		$ans = explode('#$',$row['answer']);
		$val_1=trim($b[$i]);
		$val_2=trim(strip_tags($ans[0]));
	//if choice  for question 
		if($bor!=0){
			if($i==($bor-2)){
				if($altque2 <4){
					 $val_1 = $altque2;
			   }
		    }
		   if ($val_1!= null){$val_1++;$total_attened=$total_attened+1;}
		   if($i==$bor-1){
			 if($altque2>=4){
				  $val_1 = $altque2-3;
			 }
		   }
		//echo $val_1.",val_2 : ".$val_2. "<br>";
		if(($val_1)==($val_2)){
			$bmarks++;
			$attan++;
		}
	} else if($bor==0){
	 
	 if ($val_1!= null){$val_1++;$total_attened=$total_attened+1;}
	 		 //echo $val_1.",val_2 : ".$val_2. "<br>";
	 if(($val_1)==($val_2)){
		$bmarks++;
		$attan++;
	}	
 }
 	 //$total_attened=$total_attened+1;
		$i++;
	}

//echo "Section b end"."<br>";
/*while($row=$objSql->fetchRow($bans)){
$ans = explode('#$',$row['answer']);
$val_1=trim($b[$i]);
$val_2=trim(strip_tags($ans[0]));
if ($val_1!= null){$val_1++;}
if(($val_1)==($val_2)){
//echo "bbbbb $i if option".$val_1."ans".$val_2."<br>";
$bmarks++;
}else{	}	
$i++;
}*/

//section c
	$cmarks =0;
	$i=0;
	$answer1 =correct($chap,'section c' ,$ssc[1] ,$ssc[2]-0);
	//internal choise question's answer
	 $or = $_POST['or'];
	  $altque = $_POST['abc'];
	while($row=$objSql->fetchRow($answer1)){
		$ans = explode('#$',$row['answer']);
		$val_1=trim($c[$i]);
		$val_2=trim(strip_tags($ans[0]));
	//if choice  for question 
		if($or!=0){
			if($i==($or-2)){
				if($altque <4){
				// echo "i $i r $or alt is less than 4";
					 $val_1 = $altque;
				   }
			 }
			 if ($val_1!= null){$val_1++;$total_attened=$total_attened+1;}
			 if($i==$or-1){
				 if($altque>=4){
				 // echo "i $i r $or alt is gre than 4";
					 $val_1 = $altque-3;}
			}
			//echo $val_1.",val_2 : ".$val_2. "<br>";
			if(($val_1)==($val_2)){
				$cmarks++;
				$attan++;
			}
		} else if($or==0){
		
		 if ($val_1!= null){$val_1++;$total_attened=$total_attened+1;}
		 		// echo $val_1.",val_2 : ".$val_2. "<br>";
		 if(($val_1)==($val_2)){
			$cmarks++;
			$attan++;
		}
	 }
	  //$total_attened=$total_attened+1;
			$i++;
	}
	//echo "Section c end"."<br>";
	$dmarks =0;
	$i=0;
	$dor = $_POST['dor'];
	$answer =correct($chap,'section d' , $ssd[1] ,$ssd[2]-0);
	$altque4 = $_POST['dabc'];
	
	while($row=$objSql->fetchRow($answer)){
	
		$ans = explode('#$',$row['answer']);
		$val_1=trim($d[$i]);
		$val_2=trim(strip_tags($ans[0]));
	
		if($dor!=0){
	
			if($i==($dor-2)){
			if($altque4 <4){
				$val_1 = $altque4;
	   		}
	 	}
		if ($val_1!= null){$val_1++;$total_attened=$total_attened+1;}
			
		if($i==$dor-1){
			 if($altque4>=4){
				$val_1 = $altque4-3;
			  }
		}
		//echo $val_1.",val_2 : ".$val_2. "<br>";
		if(($val_1)==($val_2)){
			$dmarks++;
		}
	} else if($dor==0){

		 if ($val_1!= null){$val_1++;$total_attened=$total_attened+1;}
		// echo $val_1.",val_2 : ".$val_2. "<br>";
		// echo $val_1.",val_2 : ".$val_2. "<br>";
			 if(($val_1)==($val_2))
			 {
				$dmarks++;
			}
 		}
		 
		$i++;
	}
	//echo "Section d end"."<br>";
//echo "$amarks * $am + $bmarks *$bm +$cmarks *$cm" ;
//echo "<br>marks : ".$marks;
$marks = $amarks * $am + $bmarks *$bm +$cmarks *$cm+$dmarks *$dm;
$cor_answers = $amarks + $bmarks  +$cmarks +$dmarks ; 
 $tab= array("marks=".$marks."","nstatus=0","status=1","total=".$_POST['tmarks']."");
 $where =array("Bagid=".$_POST['bid']."");
$bagup = $exams_bag->bag_update($tab,$where);
$rank_list = $exams_bag->bag_ranks($course,$chap,$quiz);
//echo $size = sizeof($rank_list);
$r=1;
//echo $_POST["bid"];
while($row=$objSql->fetchRow($rank_list)){
//echo "<br>". $_POST['bid']."sssss".$row['Bagid'];
if($_POST["bid"]==$row['Bagid']){ $rank = $r;}
$r++;
}
$nusers  = $exams_bag->bag_users($course,$chap,$quiz);
$tusers =sizeof($nusers);

$num_of_que = $_POST["quenum"];
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
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
          <tr bgcolor="#F68122">
            <td width="6" style="background:url(images/sprite_05.jpg) left no-repeat;" height="27">&nbsp;</td>
            <td width="705" background="images/sprite_07.jpg" class="content_head" ><strong>Test Result</strong></td>
            <td width="6" style="background:url(images/sprite_06.jpg) right no-repeat;" height="27">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top" class="sprite_padding_1 main_box_border">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  
                  <tr>
                    <td width="100%" colspan="4" style="border:#dbdbdb solid 1px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr >
                          <td width="19%" align="center" background="images/ismart_25.jpg" class="web_font_9" style="border-right:#dbdbdb solid 1px;border-bottom:#dbdbdb solid 1px;"><strong>Name of the Test :</strong></td>
                          <td width="12%" background="images/ismart_25.jpg" class="web_font_19" style="border-right:#dbdbdb solid 1px;border-bottom:#dbdbdb solid 1px;"><?php $cpname1 = $exams_chapters->chapters_sel(chap_id,$chap,1);
			$cname = $objSql->fetchrow($cpname1); echo $cname['chap_name'];?></td>
                          <td width="26%" align="left" background="images/ismart_25.jpg"  class="web_font_9" style="border-right:#dbdbdb solid 1px;border-bottom:#dbdbdb solid 1px;"><strong class="web_font_19">Rank :</strong></td>
                          <td width="5%" align="center" background="images/ismart_25.jpg" class="web_font_9" style="border-right:#dbdbdb solid 1px;border-bottom:#dbdbdb solid 1px;"><?php echo $rank;?></td>
                          <td width="22%" align="left" background="images/ismart_25.jpg" class="web_font_19" style="border-right:#dbdbdb solid 1px;border-bottom:#dbdbdb solid 1px;"><strong>Total Give Time :</strong></td>
                          <td width="16%" height="26" align="left" background="images/ismart_25.jpg" class="web_font_19" style="border-bottom:#dbdbdb solid 1px;"><?php $tename = $exams_test->test_select(test_id,$test,1); echo $tename[0]['time']." Mins";?></td>
                        </tr>
                        <tr>
                          <td align="center" background="images/ismart_26.jpg" class="web_font_9" style="border-right:#dbdbdb solid 1px;border-bottom:#dbdbdb solid 1px;"><strong>Test Attend Date :</strong></td>
                          <td background="images/ismart_26.jpg" class="web_font_19" style="border-right:#dbdbdb solid 1px;border-bottom:#dbdbdb solid 1px;">01-Nov-2010</td>
                          <td align="left" background="images/ismart_26.jpg" class="web_font_9" style="border-right:#dbdbdb solid 1px;border-bottom:#dbdbdb solid 1px;"><strong class="web_font_19">Total Number of students</strong></td>
                          <td align="center" background="images/ismart_26.jpg" class="web_font_9" style="border-right:#dbdbdb solid 1px;border-bottom:#dbdbdb solid 1px;"><?php echo ($size+1);?></td>
                          <td align="left" background="images/ismart_26.jpg" class="web_font_19" style="border-right:#dbdbdb solid 1px;border-bottom:#dbdbdb solid 1px;"><strong>Attempted :</strong></td>
                          <td height="26" align="left" background="images/ismart_26.jpg" class="web_font_19" style="border-bottom:#dbdbdb solid 1px;">(<?php echo $total_attened;?>/<?=$num_of_que?>)</td>
                        </tr>
                        <tr>
                          <td align="center" background="images/ismart_25.jpg" class="web_font_9" style="border-right:#dbdbdb solid 1px;border-bottom:#dbdbdb solid 1px;"><strong>Percentage:</strong></td>
                          <td background="images/ismart_25.jpg" class="web_font_19" style="border-right:#dbdbdb solid 1px;border-bottom:#dbdbdb solid 1px;"><?php echo $p=($total_attened/$num_of_que)*100;?></td>
                          <td align="left" background="images/ismart_25.jpg" class="web_font_9" style="border-right:#dbdbdb solid 1px;border-bottom:#dbdbdb solid 1px;"><strong class="web_font_19">Total Marks</strong></td>
                          <td align="center" background="images/ismart_25.jpg" class="web_font_9" style="border-right:#dbdbdb solid 1px;border-bottom:#dbdbdb solid 1px;"><?=$_POST['tmarks']?></td>
                          <td align="left" background="images/ismart_25.jpg" class="web_font_19" style="border-right:#dbdbdb solid 1px;border-bottom:#dbdbdb solid 1px;"><strong>Not Attempted :</strong></td>
                          <td height="26" align="left" background="images/ismart_25.jpg" class="web_font_19" style="border-bottom:#dbdbdb solid 1px;">(<?php echo ($num_of_que-$total_attened);?>/<?=$num_of_que?>)</td>
                        </tr>
                        <tr>
                          <td align="center" background="images/ismart_25.jpg" class="web_font_9" style="border-right:#dbdbdb solid 1px;border-bottom:#dbdbdb solid 1px;"><strong>Questions in Test :</strong></td>
                          <td background="images/ismart_25.jpg" class="web_font_19" style="border-right:#dbdbdb solid 1px;border-bottom:#dbdbdb solid 1px;"><?=$num_of_que?></td>
                          <td align="left" background="images/ismart_25.jpg" class="web_font_9" style="border-right:#dbdbdb solid 1px;border-bottom:#dbdbdb solid 1px;"><strong class="web_font_19">Marks get :</strong></td>
                          <td align="center" background="images/ismart_25.jpg" class="web_font_9" style="border-right:#dbdbdb solid 1px;border-bottom:#dbdbdb solid 1px;"><?=$marks?></td>
                          <td align="left" background="images/ismart_25.jpg" class="web_font_19" style="border-right:#dbdbdb solid 1px;border-bottom:#dbdbdb solid 1px;"><strong>Correct :</strong></td>
                          <td height="26" align="left" background="images/ismart_25.jpg" class="web_font_19" style="border-bottom:#dbdbdb solid 1px;">(<?=$cor_answers?>/<?=$num_of_que?>)</td>
                        </tr>
                        <tr>
                          <td height="41" colspan="6" align="left" background="images/web_35.jpg" class="web_font_9"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="34%" height="25" align="center" bgcolor="#F6F3EC" class="ismart_font_1" style="border-right:#FFFFFF solid 1px;"><strong><a href="quiz_solutions.php?bid=<?=$_POST['bid']?>&chid=<?=$_POST['chap']?>&cid=<?=$_POST['courseid']?>&qid=<?=$_POST['tid']?>&aor=<?=$aor?>&bor=<?=$bor?>&or=<?=$or?>&dor=<?=$dor?>&total=<?php echo $_POST['tmarks'];?>" class="hed_txt_org">View Question Wise Result</a></strong></td>
                                <td width="34%" align="center" bgcolor="#F6F3EC" class="ismart_font_1" style="border-right:#FFFFFF solid 1px;"><strong>View Test Result in chart</strong></td>
                                <td width="32%" align="center" bgcolor="#F6F3EC" class="ismart_font_1"><strong>Export as Word</strong></td>
                              </tr>
                          </table></td>
                        </tr>
                        
                    </table>
            </td></tr></table>
            </td></tr></table>
            </td>
          </tr>
        </table>
        </td>
        <!-- Right Coloumn Code -->
       
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
