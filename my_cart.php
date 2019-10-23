<?php
session_start();
 include_once 'lib/db.php';
 user_login_check();	
 include "lib/class_exam_test.php";
	include "lib/class_exam_cost.php";
	include "lib/class_exam_bag.php";
	include "lib/class_exam_users.php";
	include "lib/class_exam_settings.php";
	include'lib/class_exam_chapters.php';
	
	$queries = new Queries();
	$objSql = new SqlClass();
	
	$exams_test = new exams_test();
	$exams_cost = new exams_cost();
	$exams_bag = new exams_bag();
	$exams_users = new exams_users();
	$exam_settings = new exam_settings();
	$exams_chapters = new exams_chapters();
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
            <td width="705" background="images/sprite_07.jpg" class="content_head" ><strong>My Cart</strong></td>
            <td width="6" style="background:url(images/sprite_06.jpg) right no-repeat;" height="27">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top" class="sprite_padding_1 main_box_border">
            <?PHP 
							$username = 1;
							$gen=time();
							$acode=substr(md5($gen),2,8);
							$tran_num=TRAN.$gen;
							$chap=$_REQUEST["chap"];
							$course= $_REQUEST["course"];
							$number = $_REQUEST["num"];
							$sttab= array("nstatus=0");
							 
							$where= array("user=".$username."","nstatus=1");
							$upbag = $exams_bag->bag_update($sttab,$where);
							
							//$user = $exams_users->users_selectall(userid,$username);
							$chapget = $exams_chapters->chapters_selectall(chap_id,$chap);
							
							/*$fname = $user['firstname'];
							$lname = $user['lastname'];
							$usermail = $user['emailid'];
							$fromaddress = "tolearnnow.com";
							$fromname = "tolearnnow.com";
							$subject = "Quiz Activation Code";*/
							$count = 0;
							
							for($j=1;$j<=$number;$j++){
								if($_REQUEST["chk".$j]==on){
									$count++;
									//echo "opton =".$_REQUEST["chk".$j]."<br>";
									//echo "testid$j=".$tb = $_REQUEST["testid".$j]."<br>";
									$time=date("Y-m-d");
							
									$tab= array("tid=".$tran_num."","user=".$username."","courseid=".$course."","chapterid=".$chap."","quizid=".$_REQUEST["testid".$j]."","pwd=".$acode."","time=".$time."","nstatus=1");
									$inbag = $exams_bag->bag_insert($tab);
								}
							}
							if($count <=0){ echo "<b>NO TEST IS SELECTED .Please select a test</b> ";}else{
							?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                
                
                <tr>
                  <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="1%"><img src="images/sg_25.gif" width="13" height="36" /></td>
                            <td width="97%" background="images/sg_26.gif"><strong class="sprite_font_2">Thank you for your order. Your order number is <?=$tran_num?>.</strong></td>
                            <td width="1%" align="right"><img src="images/sg_27.gif" width="11" height="36" /></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="65" bgcolor="#F8F5F0" style=" padding-left:12pt;padding-right:12pt;font-family: Myriad Pro; font-size:14px; color:#333333;"><strong> We have e-mailed a copy of this order summary to you.
                        We will process your order within two business days and send you a confirmation e-mail. </strong></td>
                    </tr>
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="1%"><img src="images/sg_25.gif" width="13" height="36" /></td>
                            <td width="97%" background="images/sg_26.gif" class="sprite_font_2"><strong>To activate your e-learning, click the <a href="shopping_cart.php" class="hed_txt"><span class="sprite_font_1">MyCart</span></a> with your Activation Code is <?=$acode?></strong></td>
                            <td width="1%" align="right"><img src="images/sg_27.gif" width="11" height="36" /></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="77" bgcolor="#F8F5F0" style=" padding-left:12pt;padding-right:12pt;font-family: Myriad Pro; font-size:14px; color:#333333;">If ordering e-learning for another user, you'll receive an e-mail with instructions to forward to the user(s). Users will be
                        required to accept the <a href="#" class="">license agreement</a> during the activation process. </td>
                    </tr>
                  </table></td>
                  </tr>
            </table>
            <?php
							}
							?>
            &nbsp;</td>
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
