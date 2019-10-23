<?php
	session_start();
	include_once 'lib/db.php';
	user_login_check();	
	include_once 'lib/forums_class.php';
	//include_once 'lib/db.php';
	$forum = new Forums();
	$objSql = new SqlClass(); 
	$aray_pagination = new aray_pagination;
	$rec = $forum->get_active_forums($_SESSION['school_id']);

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
            <td width="100%" background="images/sprite_07.jpg" class="content_head" ><strong>Forums</strong></td>
            <td width="0%" align="right" ><img src="images/sprite_06.jpg" width="6" height="27" /></td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top" class="sprite_padding_1 main_box_border">
           
           
           
           <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr class="blue1px">
                <td width="247" height="32" align="center" valign="middle" background="images/blue1px.gif" bgcolor="#4FC5F3" class="paratext_body" ><strong class="para1">Forum Title</strong></td>
                <td width="73" align="center" valign="middle" background="images/blue1px.gif" bgcolor="#4FC5F3" class="paratext" id="bdr_table"><strong>Topics</strong></td>
                <td width="73" align="center" valign="middle" background="images/blue1px.gif" bgcolor="#4FC5F3" class="paratext" id="bdr_table"><strong>Posts</strong></td>
                <td width="247" valign="middle" background="images/blue1px.gif" bgcolor="#4FC5F3" id="bdr_table"><strong class="para1">Created On</strong></td>
              </tr>
              <?php 
			  
			  if(is_array($rec)){
		 if (count($rec)) {
          // Parse through the pagination class
         $productPages = $aray_pagination->generate($rec,5);
		  // If we have items 
          if (count($productPages) != 0) {
            // Create the page numbers
            $pageNumbers = '<div align="left" style="padding-top:7px;">'.$aray_pagination->links().'</div>';
            // Loop through all the items in the array

				$i=0;
            foreach ($productPages as $row)
			{
					if($i==0)
					{
						$backgrnd='#F1F1E4';$i=1;
					}
					else
					{
						$backgrnd='#ffffff';$i=0;
					}
				?>
              <tr bgcolor="<?php echo $backgrnd;?>">
                <td height="87" class="para1" id="bdr_table1"><a href="forums_inner.php?fid=<?=$row['forum_id']?>" class="sidetextblue"><?=$row['forum_name']?></a><br />
                    <strong><?php echo substr($row['forum_description'],0,200);?></strong></td>
                <td align="center" valign="middle" class="paratext" id="bdr_table"><strong><?php echo $noofsubforums = $forum->totalNoOf_active_Subforums($row['forum_id']);?></strong></td>
                <td align="center" valign="middle" class="paratext" id="bdr_table"><strong><?php echo $total=$forum->totalNoOf_active_Comments($row['forum_id']);?></strong></td>
                <td bgcolor="#F6F6F6" class="para1" id="bdr_table_1"><strong class="sidetextblue"><?php $date=strtotime($row['create_date']);echo date("d-M-Y",$date)?> </strong><br />
                    </td>
              </tr>
              <?php }?>
              <tr>
              <td colspan="4">
              <?php
            // print out the page numbers beneath the results
            echo $pageNumbers;
			?>
            </td>
            </tr>
           <?php }}}else{?>
          <tr>
            <td align="center"><div class="profile_info_text" align="center">No Forums Found.</div></td>
          </tr>
          <?php }?>
              
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
