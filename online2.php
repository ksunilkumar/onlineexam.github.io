<?php
session_start();
 include_once 'lib/db.php';
 user_login_check();	
include "lib/class_exam_curriculum.php";
	include "lib/class_exam_subject.php";
	include "lib/class_exam_course.php";
	include "lib/class_exam_grades.php";
	include "lib/class_exam_chapters.php";
	include "lib/class_exam_test.php";
	include "lib/class_exam_cost.php";
	
	$exams_curriculum = new exams_curriculum();
	$queries = new Queries();
	$objSql = new SqlClass();
	$exams_subject = new exams_subject();
	$exams_course = new exams_course();
	$exams_grades = new exams_grades();
	$exams_chapters = new exams_chapters();
	$exams_test = new exams_test();
	$exams_cost = new exams_cost();
	$curid=$_REQUEST['curid'];
	 $subid=$_REQUEST['sid'];
	 $course=$_REQUEST['course'];
	 $grade = $_REQUEST['grade'];
	$chapter = $_REQUEST['chap'];
	
	$cur = $exams_curriculum->curriculum_name_select(cur_id,$curid);
	$curri = $objSql->fetchRow($cur);
	$sub= $exams_subject->subject_all_select($subid);
	$subject = $objSql->fetchRow($sub);
	$grade = $exams_grades->grades_all_select($grade);
	$grade1 = $objSql->fetchRow($grade);
	$ch = $exams_chapters->chapters_sel(chap_id,$chapter);
	
	$chp = $objSql->fetchRow($ch);
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
<script type="text/javascript">

	function select1(x,chk,t)
	{
	x=x-1;
	var vg=document.getElementById('checksele').value;
		if(vg=='off')
	document.getElementById('checksele').value='on';
	else 
	document.getElementById('checksele').value='off';
			for(var jk=1;jk<=x;jk++)
		{
			if(vg=='off')
			{
			document.getElementById('chk'+jk).checked=true;
			document.getElementById('chk'+jk).value='on';
			//document.getElementById('tot').value=t;
			//document.getElementById('total').innerHTML="Total=<font color='blue'>"+t+"</font>";
			
			}
			else
			if(vg=='on')
			{
			t=0;
			document.getElementById('chk'+jk).checked=false;
			document.getElementById('chk'+jk).value='off';
			//document.getElementById('tot').value=t;
			//document.getElementById('total').innerHTML="Total=<font color='blue'>"+'0'+"</font>";
			
			
			}
		}
	
	x=x-1;

	//document.getElementById('tot').value=t;
	//document.getElementById('total').innerHTML="Total=<font color='blue'>"+t+"</font>";
	var i=1;
	for(i=1;i<=5;i++)
	document.getElementById('d'+i).innerHTML="<input type='checkbox' name=chk[] checked='checked' id='chk[]>";
	document.getElementById('desc').innerHTML="<input name='checksele' id='checksele' value='d' type='checkbox' onclick='desel(x);'>Deselect All";
	
	}
	function addtotal(no,cost)
	{
	var cvg=document.getElementById('chk'+no).value;

	if(cvg=='off')
	{
	document.getElementById('chk'+no).value='on';
	//var oco=document.getElementById('tot').value;
	//var newcost=parseInt(oco)+parseInt(cost);
	}
	else
	{
	document.getElementById('chk'+no).value='off';
	//var oco=document.getElementById('tot').value;
	//var newcost=parseInt(oco)-parseInt(cost);
	}
	
	//document.getElementById('tot').value=newcost;
	//document.getElementById('total').innerHTML="Total=<font color='blue'>"+newcost+"</font>";
	}
	function test_select()
	{
		if(val==0)
		{
			alert('Please select a test');	 	
			 return false;
		}
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
            <td width="100%" background="images/sprite_07.jpg" class="content_head" ><strong><?=$grade1['grade_name']?> Grade <?=$curri['cur_name']?> <?=$subject['sub_name']?> Chapters</strong></td>
            <td width="0%" align="right" ><img src="images/sprite_06.jpg" width="6" height="27" /></td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top" class="sprite_padding_1" style="border-bottom:#ce3918 solid 1px;border-left:#ce3918 solid 1px;border-right:#ce3918 solid 1px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                
                
                <tr>
                  <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="115" align="left" valign="top" background="images/sg_20.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="83%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="85%" height="30" align="left" class="sprite_font_2" ><strong><?=$chp['chap_name']?></strong></td>
                                  <td width="15%" rowspan="2" align="left" class="sprite_font_2" ><img src="uploads/<?=$chp['chap_image']?>" width="113" height="76" /></td>
                                </tr>
                                <tr>
                                  <td align="left" style="font-family: 'verdana'; font-size:11px; color:#6a6a6a; padding-right:7pt;"><div align="justify"><?=$chp['chap_description']?> </div></td>
                                  </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="7"></td>
                    </tr>
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="1%"><img src="images/sg_25.gif" width="13" height="36" /></td>
                            <td width="100%" background="images/sg_26.gif" class="sprite_font_2"><strong><?=$chp['chap_name']?></strong></td>
                            <td width="1%"><img src="images/sg_27.gif" width="11" height="36" /></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td class="web_border_1">
                      <form name='cart' method='post' action ='my_cart.php'>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="2" colspan="3"></td>
                          </tr>
                          <?php
						  $t = $exams_test->test_all_select($chapter);
										$i=1;
										$total =0;
										 if(is_array($t))
										 {
						  ?>
                          <tr>
                            <td width="67%" bgcolor="#000000" style="border-bottom:#FFFFFF solid 1px;border-right:#FFFFFF solid 1px; padding-left:8pt;"class="sprite_font_2"><strong>Options</strong></td>
                            <td width="18%" bgcolor="#000000" style="border-bottom:#FFFFFF solid 1px;border-right:#FFFFFF solid 1px; padding-left:8pt;"span class="sprite_font_2"><strong>Test Status</strong></td>
                            <td width="15%" height="25" bgcolor="#000000" style="border-bottom:#FFFFFF solid 1px; padding-left:8pt;" class="sprite_font_2"><strong>Level</strong></td>
                          </tr>
                          <?php 
										
										while($test = $objSql->fetchRow($t)){
										$c= $exams_cost->cost_select(test_id,$test['test_id']);
										//print_r($t);
										$cost = $objSql->fetchRow($c);
								
								   		?>
                          <tr>
                            <td bgcolor="#f4f4f4" style="border-bottom:#FFFFFF solid 1px;border-right:#FFFFFF solid 1px;font-family: 'Myriad Pro'; font-size:11pt; color:#414141; padding-left:8pt;"><input type="checkbox"  value='off' name="chk<?=$i?>" id="chk<?=$i?>" onclick="javascript:addtotal(<?php echo $i;?>,<?php if($cost['cost']==""){echo 0;}else{echo $cost['cost']; }?>)"><input type="hidden" name="test<?=$i?>" value="<?=$test['test_name']?>"> <input type="hidden" name="testid<?=$i?>" value="<?=$test['test_id']?>">
                              &nbsp;<?=$test['test_name']?></td>
                            <td bgcolor="#f4f4f4" style="border-bottom:#FFFFFF solid 1px;border-right:#FFFFFF solid 1px;font-family: 'Myriad Pro'; font-size:11pt; color:#414141; padding-left:8pt;">Active</td>
                            <td height="25" bgcolor="#f4f4f4" style="border-bottom:#FFFFFF solid 1px;font-family: 'Myriad Pro'; font-size:11pt; color:#414141; padding-left:8pt;">Level 1</td>
                          </tr>
                          <?php
								 $total = $total+$cost['cost'];
								
								 $i++;
								  } 
								  
								  
								 ?> 
                                 <input type="hidden" name="num" value="<?=$i-1?>">
                          <tr>
                            <td height="25" colspan="3" bgcolor="#F4F4F4" style="border-bottom:#FFFFFF solid 1px;border-right:#FFFFFF solid 1px;font-family: 'Myriad Pro'; font-size:11pt; color:#0066ac; padding-left:8pt;"><span class="style4">
                              <input  name="checksele" id="checksele" value="off" type="checkbox" onClick="javascript:select1(<?php echo $i;?>,'document.cart.checkselect1',<?php echo $total;?>)" />
                              </span><span class="sprite_font_2">Select All </span></td>
                          </tr>
                          <tr>
                            <td height="35" colspan="3" style="border-bottom:#FFFFFF solid 1px;border-right:#FFFFFF solid 1px;font-family: 'Myriad Pro'; font-size:11pt; color:#414141; padding-left:8pt;"><input type="hidden" name="course" value="<?=$course?>">
                             <input type="hidden" name="chap" value="<?=$_REQUEST['chap']?>"><img src="images/001_TEST.png" width="154" height="41" border="0" onclick="javascript:document.cart.submit();"/></td>
                          </tr>
                          <?php
						  }
						  else
						  {
						  ?>
                          <tr>
            <td align="center" colspan="3"><div class="profile_info_text" align="center">No Tests Available.</div></td>
          </tr>
                          <?php
						  }
						  ?>
                      </table>
                      </form>
                      </td>
                    </tr>
                  </table></td>
                  </tr>
            </table></td>
          </tr>
        </table>
        </td>
        <!-- Right Coloumn Code -->
        <td width="185" style="padding-left:0px; padding-right:0px;" valign="top"><?php include_once 'tab_02_templete.php'; ?></td>
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
