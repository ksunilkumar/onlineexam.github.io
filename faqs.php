<?php
session_start();
 include_once 'lib/db.php';
 
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
        <td width="185" style="padding-left:0px; padding-right:0px;" valign="top"><?php include_once 'tab_02_templete.php'; ?><?php include_once 'tab_01_templete.php'; ?><?php include_once 'tab_03_templete.php'; ?></td>
        <!-- Center Coloumn Code -->
        <td width="*" style="padding-left:6px; padding-right:6px;" valign="top">
        <?php echo ucwords($_SESSION['msg']); if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0"  id="top">
          <tr bgcolor="#F68122">
            <td width="6" style="background:url(images/sprite_05.jpg) left no-repeat;" height="27">&nbsp;</td>
            <td width="705" background="images/sprite_07.jpg" class="content_head" ><strong>FAQs</strong></td>
            <td width="6" style="background:url(images/sprite_06.jpg) right no-repeat;" height="27">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top" class="sprite_padding_1 main_box_border">
            <?php
				 $nop=0;
				$sql = "SELECT * FROM ise_faqs where status='active' ORDER BY create_date DESC";
				$pagination_key = new pagination_new;
										//$query = "select * from test_bag where tid!='offer' and nstatus!='pending' and nstatus!='process' and status=2";
										
				$pagination_key->createPaging($sql,6);
				$bagsize=$pagination_key->recordsize();
				$i=0;
				while($row = mysql_fetch_object($pagination_key->resultpage)){
					if($i==0)
					{
						$backgrnd='#f1f2f2';$i=1;
					}
					else
					{
						$backgrnd='#ffffff';$i=0;
					}
			?>
            <div style="background-color:<?php echo $backgrnd; ?>">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding:5px;">
                  <tr>
                    <td align="left" height="40"><span class="content_title"><strong><?php echo $row->faq_question;?></strong></span><br />
                      <span class="content_small">Added On :<?php echo  $date = strftime( "%d-%m-%Y ", strtotime( $row->create_date));?> </span></td>
                  </tr>
                  <tr>
                    <td align="justify">
                   <?php echo $row->faq_answer;?>
					</td>
                  </tr>
                  <tr>
                    <td align="right" class="top_link"><a href="#top">Top</a></td>
                  </tr>
                </table>
            </div>
			<?php		
				}
			?>
            </td>
          </tr>
          <tr valign="middle">
                                            
                                              <td colspan="3" class="pagesnum" align="right" height="26" bgcolor="#FFFFFF">
                                               <?=$pagination_key->totalrecords()?>&nbsp;&nbsp;&nbsp;<?=$pagination_key->displayPaging();?></td>
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
