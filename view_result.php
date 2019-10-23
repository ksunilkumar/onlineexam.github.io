<?php
session_start();
include_once "lib/db.php";
include_once "lib/test_gen_class.php";
user_login_check();

$generator = new TestGenerator();

$objSql = new SqlClass();

$test_id=$_REQUEST['test_id'];
$result_id=$_REQUEST['ttaken'];
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
<script type="text/javascript" src="js/test_scripts.js"></script>
<script type="text/javascript">
function showQuesSec(n){
		
		// alert(n);
			ajaxCode('get_question.php?qid='+n+'&test_id=<?php echo $test_id; ?>&ttaken=<?php echo $result_id; ?>', 'question_view');
	}

function getChart(path){
		
		// alert(path);
		 ajaxCode('get_chart.php?path='+path+'xml', 'question_view');
	}
</script>
<!-- Javascript Part Ending--></head>

<body>
<?php include 'includes/light_box.php'; ?>

<?php

$sql="select * from test_test_results where test_id=".$test_id." and result_id=".$result_id;
$res=$objSql->executeSql($sql);
$row=$objSql->fetchRow($res);

$test_name=$row['test_name'];
$test_date=$row['test_date'];
$test_time=$row['test_time'];
$taken_time=$row['taken_time'];
$ques=unserialize($row['result']);
$totques=$row['tot_ques'];
$attempt=$row['attempt'];
$not_attempt=$row['not_attempt'];
$correct=$row['correct'];
$incorrect=$row['incorrect'];

$mrkpq=$row['mrkpq'];
$negmrk=$row['negmrk'];
$totmrks=$row['tot_mrks'];
$mrksget=$row['mrkget'];

$correct_per = round(($correct/$totques)*100,2);
$incorrect_per = round(($incorrect/$totques)*100,2);
$notattempt_per = round(($not_attempt/$totques)*100,2);
?>
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
        <td width="185" style="padding-left:0px; padding-right:0px;" valign="top"><?php include_once 'tab_02_templete.php'; ?><?php include_once 'tab_01_templete.php'; ?><?php include_once 'tab_03_templete.php'; ?></td>
        <!-- Center Coloumn Code -->
        <td width="*" style="padding-left:6px; padding-right:6px;" valign="top">
        <?php echo ucwords($_SESSION['msg']); if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
          <tr bgcolor="#F68122">
            <td width="6" style="background:url(images/sprite_05.jpg) left no-repeat;" height="27">&nbsp;</td>
            <td width="705" background="images/sprite_07.jpg" class="content_head" ><strong>Result Page</strong></td>
            <td width="6" style="background:url(images/sprite_06.jpg) right no-repeat;" height="27">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top" class="sprite_padding_1 main_box_border">
            <table width="700" border="0" cellspacing="0" cellpadding="0" style="border: 1px solid rgb(219, 219, 219);">
              <tr class="tst_eng_inr_bg">
                <td width="270" height="35" align="left" valign="middle" style="padding-left:10px;"><img src="images/test_head_icon.png" alt="icon" width="21" height="20" align="absmiddle" /> <span class="profile_info_text">Test Description</span></td>
                <td width="470" align="left" valign="middle" >&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="top" style="padding-left:5px; padding-right:5px;"><div >
                    <div class="width3">
                      <h4>Test Details</h4>
                      <hr />
                      <table class="no-style full" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                          <tr>
                            <td style="padding-left:10px;">Test Name </td>
                            <td class="ta-right">:</td>
                            <td class="ta-left"><?php echo $test_name; ?></td>
                          </tr>
                          <tr>
                            <td style="padding-left:10px;">Test Date</td>
                            <td class="ta-right">:</td>
                            <td class="ta-left"><?php echo date("d-M-Y",strtotime($test_date)); ?></td>
                          </tr>
                          <tr>
                            <td style="padding-left:10px;">Total Questions</td>
                            <td class="ta-right">:</td>
                            <td class="ta-left"><?php echo $totques; ?></td>
                          </tr>
                          <tr>
                            <td style="padding-left:10px;">Test Time</td>
                            <td class="ta-right">:</td>
                            <td class="ta-left"><?php echo ($test_time/60).' Mins : '.($test_time%60).' Sec'; ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                </div></td>
                <td align="left" valign="top"><div class="width3" style="margin:0px 5px 0px 5px;">
                    <h4>Test Result<a href="#"></a></h4>
                  <hr />
                    <table class="no-style full width3" cellpadding="0" cellspacing="0" border="0">
                      <tbody>
                        <tr>
                          <td>Marks Per 1 Question</td>
                          <td class="ta-right">:</td>
                          <td class="ta-left"><?php echo $mrkpq; ?></td>
                        </tr>
                        <tr>
                          <td>Negative Marking</td>
                          <td class="ta-right">:</td>
                          <td class="ta-left"><?php echo $negmrk; ?></td>
                        </tr>
                        <tr>
                          <td>Test Completed In</td>
                          <td class="ta-right">:</td>
                          <td class="ta-left"><?php echo floor($taken_time/60).' Mins : '.($taken_time%60).' Sec'; ?></td>
                        </tr>
                        <tr>
                          <td>Total Marks Get</td>
                          <td class="ta-right">:</td>
                          <td class="ta-left" style="color:#F40000"><strong><?php echo $mrksget; ?> / <?php echo $totmrks; ?></strong></td>
                        </tr>
                      </tbody>
                    </table>
                </div></td>
              </tr>
              <tr>
                <td align="left" valign="top" style="padding-left:5px; padding-right:5px;"><div >
                    <div class="width3">
                      <h4>Questions Status</h4>
                      <hr />
                      <table class="no-style full" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                          <tr>
                            <td style="padding-left:10px;">Correct</td>
                            <td class="ta-right"><?php echo $correct; ?>/<?php echo $totques; ?></td>
                            <td><div value="1" id="progress1" class="progress full progress-green"><span style="width: <?php echo $correct_per; ?>%; display: block;"><b style="display: inline;"><?php echo $correct_per; ?>%</b></span></div></td>
                          </tr>
                          <tr>
                            <td style="padding-left:10px;">Incorrect</td>
                            <td class="ta-right"><?php echo $incorrect; ?>/<?php echo $totques; ?></td>
                            <td><div value="2" id="progress2" class="progress full progress-red"><span style="width: <?php echo $incorrect_per; ?>%; display: block;"><b style="display: inline;"><?php echo $incorrect_per; ?>%</b></span></div></td>
                          </tr>
                          <tr>
                            <td style="padding-left:10px;">Attempted</td>
                            <td class="ta-right"><?php echo $attempt; ?>/<?php echo $totques; ?></td>
                            <td><div value="2" id="progress4" class="progress full progress-orange"><span style="width: <?php echo (100-$notattempt_per); ?>%; display: block;"><b style="display: inline;"><?php echo (100-$notattempt_per); ?>%</b></span></div></td>
                          </tr>
                          <tr>
                            <td style="padding-left:10px;">Not Attempt</td>
                            <td class="ta-right"><?php echo $not_attempt; ?>/<?php echo $totques; ?></td>
                            <td><div value="2" id="progress3" class="progress full progress-blue"><span style="width: <?php echo $notattempt_per; ?>%; display: block;"><b style="display: inline;"><?php echo $notattempt_per; ?>%</b></span></div></td>
                          </tr>
                          <tr>
                            <td colspan="3" style="padding-left:10px;" align="center"><span style="font-weight: bold"><a href="javascript:showQuesSec(0);" style="font-family:Trebuchet MS; font-size:13px; color:#484848; text-decoration:none;">Queston wise Analysis</a> | <a href="exports.php?test_id=<?php echo $test_id; ?>&amp;ttaken=<?php echo $result_id; ?>" style="font-family:Trebuchet MS; font-size:13px; color:#484848; text-decoration:none;">Export as Word</a></span></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                </div></td>
                <td align="left" valign="top"><div class="width3" style="margin-left:5px; margin-right:5px;">
                    <h4>Reports</h4>
                  <hr />
                    <iframe width="340" height="220" frameborder="0" src="get_chart.php?url=http://localhost/ismart&path=<?php echo $test_id; ?>xml" style="background-color:#FFFFFF;"></iframe>
                </div></td>
              </tr>
              <tr>
                <td colspan="2" align="left" valign="top" style="padding-left:5px; padding-right:5px;" id="question_view">&nbsp;</td>
              </tr>
            </table></td>
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
