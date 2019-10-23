<?php
	session_start();
	include_once 'lib/db.php';
	user_login_check();	
	include_once 'lib/class_exam_test.php';
	//include_once 'lib/db.php';
	$exams = new exams_test();
	$objSql = new SqlClass(); 


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
            <td width="100%" background="images/sprite_07.jpg" class="content_head" ><strong>Reports</strong></td>
            <td width="0%" align="right" ><img src="images/sprite_06.jpg" width="6" height="27" /></td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top" class="sprite_padding_1 main_box_border">
           
           
           
           <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr class="blue1px">
                <td width="247" height="32" align="center" valign="middle" background="images/blue1px.gif" bgcolor="#4FC5F3" class="paratext_body" ><strong class="para1">Test Name</strong></td>
                <td width="73" align="center" valign="middle" background="images/blue1px.gif" bgcolor="#4FC5F3" class="paratext" id="bdr_table"><strong>Total Marks</strong></td>
                
                <td width="247" valign="middle" background="images/blue1px.gif" bgcolor="#4FC5F3" id="bdr_table"><strong class="para1">Marks Obtained</strong></td>
              </tr>
              <?php  $nop=0;
			  	if(isset($_REQUEST['option']) && $_REQUEST['option']!='')
				{
					$_REQUEST['userid']=$_REQUEST['option'];
				}
				$sql = "SELECT * FROM test_bag where user=".$_REQUEST['userid']." and status=1 ORDER BY time"; 
				$pagination_key = new pagination_new;
										//$query = "select * from test_bag where tid!='offer' and nstatus!='pending' and nstatus!='process' and status=2";
										
				$pagination_key->createPaging($sql,4);
				$bagsize=$pagination_key->recordsize();
				if($bagsize!=0)
				{
				while($rec = mysql_fetch_object($pagination_key->resultpage))
				{
				?>
              <tr bgcolor="#F6F6F6">
                <td height="87" class="para1" id="bdr_table1"><?php echo $exams->get_test_name($rec->quizid);?></a><br />
                    <strong></strong></td>
                <td align="center" valign="middle" class="paratext" id="bdr_table"><strong><?php echo $rec->total;?></strong></td>
               
                <td bgcolor="#F6F6F6" class="para1" id="bdr_table_1"><strong class="sidetextblue"><?php echo $rec->marks;?></strong><br />
                    </td>
              </tr>
              <?php }}else{?>
          <tr>
            <td align="center" colspan="3"><div class="profile_info_text" align="center">No Forums Found.</div></td>
          </tr>
          <?php }?>
              <tr valign="middle">
                                            
                                              <td colspan="3" class="pagesnum" align="right" height="26" bgcolor="#FFFFFF">
                                              <?php if($bagsize!=0)
                                              {
											  ?>
                                               <?=$pagination_key->totalrecords()?>&nbsp;&nbsp;&nbsp;<?=$pagination_key->displayPaging($_REQUEST['userid']);?><?php }?></td>
                                            </tr>
            </table>
           
           
           
           
           
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
