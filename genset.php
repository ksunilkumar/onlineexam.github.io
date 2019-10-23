<?php
session_start();

include 'lib/db.php';
include_once ("lib/test_gen_class.php");

$generator = new TestGenerator();

if(isset($_REQUEST['testname']) && isset($_SESSION['ids']) && $_SESSION['ids']!='')
{
	$testname=$_REQUEST['testname'];
	$mrkpq=$_REQUEST['mrkpq'];
	$negmrk=$_REQUEST['negmrk'];
	$numques=$_REQUEST['numques'];
	$testtime=$_REQUEST['testtime'];
	$catwqs=serialize($_SESSION['catwqs']);
	
	$qry='insert into test_tests (test_name,user_id,sections,categories,numques,catwqs,mrkpq,negmrk,testtime) values("'.$testname.'",'.$_SESSION['user_id'].',"'.$_SESSION['section'].'","'.$_SESSION['ids'].'","'.$numques.'",\''.$catwqs.'\',"'.$mrkpq.'","'.$negmrk.'","'.$testtime.'")';
	
		$objSql = new SqlClass();
		$objSql->executeSql($qry);
	
	
	$qry2="select max(test_id) as test_id from test_tests where user_id=".$_SESSION['user_id'];
	
		$objSql2 = new SqlClass();
		$rs2=$objSql2->executeSql($qry2);
		$row2=$objSql2->fetchRow($rs2);

		unset($_SESSION['ids']);
		unset($_SESSION['catwqs']);
	//	echo '<script>window.open("test_gen.php","_parent");<script>';
}
else
{
		//echo '<script>window.open("test_gen.php","_parent");</script>';
}
?>
<head>
<link rel="SHORTCUT ICON" href="images/favicon.png">
<link rel="stylesheet" href="css/test_style.css" type="text/css">
<style type="text/css">
.web_border_1 {
    border: 1px solid #D3D3D3;
    padding: 3pt;
}
</style>
<script src="js/mootools.js" type="text/javascript"></script>
<script src="js/common.js"></script>
</head>
<body style="background:none;">
<div id="newGenTestDiv" style="display: block; padding: 10px; background-color: rgb(255, 255, 255); z-index: 3; width: 450px; height: 250px; border: 1px solid rgb(102, 102, 102); position: absolute; left: 458px; top: 164px;">
        	<div class="Generate_test_header">
            	<div class="Generate_test_headerLogo"><img src="images/test_generator_logo.png" alt="Test Generator" title="Test Generator" ></div>
              <div class="Generate_test_headerClose"><a href="javascript:void(0);" onClick="javascript:window.location.href='test_gen.php';"><img src="images/close_icon.gif" alt="Close" title="Close" border="0" width="46" height="17"></a></div>
            </div>
            <div class="Generate_test_congo"><strong>Congratulations! Test generated successfully.</strong></div>
            
<div class="Generate_test_congo" align="center" style="text-align:center">
  <table width="300" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td bgcolor="#FF9900" class="web_border_1"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
          <tr>
            <td bgcolor="#f8f8f8" class="web_padding_1" align="center"><table width="300" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
                  <td height="33" align="center" bgcolor="#FFE2C6"><strong><?php echo $_REQUEST['testname']; ?></strong></td>
                </tr>
                <tr>
                  <td height="35" align="center" bgcolor="#FFE2C6"><a href="javascript:void();"><img src="images/001_TEST.png" width="110" height="26" border="0" onClick="javascript:window.location.href='Generate.php?testids=<?php echo $row2['test_id']; ?>gen&section=0&paidTest=1&qno=<?php echo $numques; ?>&type=<?php echo 'new'; ?>';" /></a></td>
                </tr>
            </table></td>
          </tr>
      </table></td>
    </tr>
  </table>
</div>


</div>
<div id="backgroundPopup" style="opacity: 0.7; display: block;"></div>         
</body>