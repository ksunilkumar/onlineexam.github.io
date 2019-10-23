<?php
session_start();
 include_once 'lib/db.php';
 user_login_check();
 include "lib/class_exam_chapters.php";
 include "lib/class_exam_bag.php";
 include "lib/class_exam_test.php";
 include "lib/class_exam_grades.php";
 $queries = new Queries();
 $objSql = new SqlClass();
 $exams_bag = new exams_bag();
 $exams_chapters = new exams_chapters();
 $exams_grades = new exams_grades();
 $exams_test = new exams_test();
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
<script language="javascript">
	var bagid=0;
	var navigate=0;
	var qi=0;
	var chid=0;
	var cid=0;
	var y1=200;
	function disp_activate(bag,q,ch,c,code)
	{
		bagid=bag;
		chid=ch;
		cid=c;
		qi=q;
		//navigate=fgh;
		var n1="?bid="+bagid+"&qid="+qi+"&chid="+chid+"&cid="+cid;
		var yck=prompt("Enter Activation Code");
		if(code==yck)
		{
			location.href="quiz.php"+n1;
		}
		else
			alert("Invalid Code");
	}
	function hide_div(value,id)
	{
		var answer = confirm  ("Are You Sure to Delete This Test")
		if (answer)
		{
			document.getElementById(value).style.display="none";
			 xmlhttp=GetXmlHttpObject(); 
			if (xmlhttp==null)
			{
				  alert ("Browser does not support HTTP Request");
				  return;
			}
			var url="updatebage.php?id="+id;
			 
			xmlhttp.onreadystatechange=function()
			{
				  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				  {
					 
				  }
			}
			xmlhttp.open("GET",url,true);
			xmlhttp.send(null);
		}
		else
		{
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
	
	
	
</script>
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
            <td width="100%" background="images/sprite_07.jpg" class="sprite_font_6" ><strong><a href="curriculum.html">Curriculum</a>|<a href="grades.html">Grades</a> | <a href="subjects.html">Subjects</a> | <a href="online2.html">Topics</a> | </strong>  <a href="online2.html"><strong>Mathematics Chapters</strong></a> <strong>|</strong> <strong><a href="shopingcart.html">Activation Code</a></strong> <strong>|</strong> <strong><a href="shopingcart.html">Exam Support </a></strong></td>
            <td width="0%" align="right" ><img src="images/sprite_06.jpg" width="6" height="27" /></td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top" class="sprite_padding_1" style="border-bottom:#ce3918 solid 1px;border-left:#ce3918 solid 1px;border-right:#ce3918 solid 1px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                
                
                <tr>
                  <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    
                   
                          <?php  
											$sqldc = "SELECT * FROM test_subject";	
											 $objSql_sub = new SqlClass();
											 $recorddc = $objSql_sub->executeSql($sqldc);
											 while($row = $objSql_sub->fetchRow($recorddc)){
										}
                                        $username=1;
					 $getbag = $exams_bag->bag_tests(user,$username);
					 
					 $i =0 ;
					 while($row = $objSql->fetchRow($getbag)){
					 
						$j_1=$j_1+1;
					 $chap = $exams_chapters->chapters_sel(chap_id,$row['chapterid'],$_SESSION['school_id']);
					 $chapde =$objSql->fetchRow($chap);
					 $test1 = $exams_test->test_select(test_id,$row['quizid'],$_SESSION['school_id']);
					
					 //$testde =$objSql->fetchRow($test);
					 
					 $status ==$row['status'];
					 $bag = $row['Bagid'];
					 $chapter = $row['chapterid'];
					 $test = $row['quizid'];
					 $code = $row['pwd'] ;
					 $course =$row['courseid'];
					
					$sqldc = "SELECT test_course.grade_id , test_course.subject_id, test_subject.sub_name as sub_name FROM test_course, test_subject where course_id =".$course." AND (test_course.subject_id = test_subject.sub_id)";	
					 $objSql_sub = new SqlClass();
					 $recorddc = $objSql_sub->executeSql($sqldc);
					 $row = $objSql_sub->fetchRow($recorddc);
					$grade=$row['grade_id'];
					$grade_img=$exams_grades->grades_all_select($grade);
					//print_r($test1[0]);exit;
					$count='0';
					if($_GET['sub_id']==''){
					$count='1';
                    ?>
                           <tr>
                      <td width="300%" colspan="3" align="left" class="web_border_1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="85%" align="left" valign="top" background="images/sg_44.jpg" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="18%" height="30" align="right" class="sprite_font_2" style="border-bottom:#ffffff solid 1px; padding-right:6pt;"><strong>Subject :</strong></td>
                                  <td width="82%" style="border-bottom:#ffffff solid 1px;font-family:verdana; font-size:12px; color:#414141;"><?php echo $row['sub_name']?></td>
                                </tr>
                                <tr>
                                  <td width="18%" height="30" align="right" class="sprite_font_2" style="border-bottom:#ffffff solid 1px; padding-right:6pt;"><strong>Chapter : </strong></td>
                                  <td style="border-bottom:#ffffff solid 1px;font-family:verdana; font-size:12px; color:#414141;"><?=$chapde['chap_name']?></td>
                                </tr>
                                <tr>
                                  <td width="18%" height="30" align="right" class="sprite_font_2" style="border-bottom:#ffffff solid 1px; padding-right:6pt;"><strong>Test :</strong></td>
                                  <td style="border-bottom:#ffffff solid 1px;font-family:verdana; font-size:12px; color:#414141;"><?php if(is_array($test1)){?><?=$test1[0]['test_name']?><?php }else{?>Not Available<?php }?></td>
                                </tr>
                                <tr>
                                 <td width="18%" height="30" align="right" class="sprite_font_2" style="border-bottom:#ffffff solid 1px; padding-right:6pt;"><strong>Description :</strong></td>
                                  <td style="font-family:verdana; font-size:12px;   padding-right:6pt;"><div align="justify"><?php echo $chapde['chap_description']?></div></td>
                                </tr>
                            </table></td>
                            <td  align="center" background="images/sg_44.jpg"><?php if($status==3){echo "completed";}elseif($status==2){echo "pending";}elseif($status==0){ ?><img src="gradeimages/<?php echo $grade_img[0]['grade_image'];?>" width="156" height="122" border="0" onclick="javascript:disp_activate('<?=$bag?>','<?=$test?>','<?=$chapter?>','<?=$course?>','<?=$code?>')"/><? } ?> </td>
                            </tr> </table></td>
                    </tr> 
                    <tr>
                      <td height="8" colspan="3" align="left"></td>
                    </tr>
                            <?php }}if($count==0){?>
           	No Test Avaliable in <?php echo $_GET['name'];?> Subject
           <?php }?>
                     
                   
                    
                  </table></td>
                  </tr>
            </table></td>
          </tr>
        </table>
            
            &nbsp;</td>
         
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
