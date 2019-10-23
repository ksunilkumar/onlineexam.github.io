<?php
 session_start();
 include_once 'lib/db.php';
 include_once 'lib/class_ise_groups.php';
  include_once 'lib/class_ise_group_members.php';
 
  user_login_check();
 $group=new ise_groups();
 $groupmembers=new ise_groups();
 $ogroupmembers=new ise_groups();
 $groupcomments=new ise_group_members();
 $groupcomments1=new ise_group_members();
 if($_SESSION['user_id']!=''){
  $group=new ise_groups();
  $rec=$group->get_active_mygroups($_SESSION['school_id'],$_SESSION['user_id']);
  }
  if($_SESSION['school_id']==''){
   $ogroup=new ise_groups();
  $othergroups=$ogroup->get_active_groups($_SESSION['user_id']);
  }else{
   $ogroup=new ise_groups();
  $othergroups=$ogroup->get_active_groups($_SESSION['school_id'],$_SESSION['user_id']);
  }
  //echo $_SESSION['school_id'];

// user_login_check();
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


        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
          <tr bgcolor="#F68122">
            <td width="6" style="background:url(images/sprite_05.jpg) left no-repeat;" height="27">&nbsp;</td>
            <td width="705" background="images/sprite_07.jpg" class="content_head" ><strong>Other Groups</strong></td>
            <td width="6" style="background:url(images/sprite_06.jpg) right no-repeat;" height="27">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top" class="sprite_padding_1 main_box_border"><?php
			if(is_array($othergroups)){
			for($j=0;$j<count($othergroups) && $j<6;$j++)
			{
			if($othergroups[$j]['group_pic']!='' && file_exists("uploads/groups/".$othergroups[$j]['group_pic']))
			$image1=$othergroups[$j]['group_pic'];
			else
			$image1='no_image.png';
			$totalnoofmembers1=$ogroupmembers->get_group_noofmembers($_SESSION['school_id'],$othergroups[$j]['group_id']);
			$totalnoofcomments1=$groupcomments1->totalNoOfgrp_comments_active($othergroups[$j]['group_id']);
			?>
              <div style="width:335px; float:left; margin:5px 5px 5px 8px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="27%" height="111" align="center" background="images/ismart_48.jpg" style="border-left:#dadada solid 1px;"><img src="uploads/groups/<?php echo $image1;?>" width="77" height="66" /></td>
                    <td width="73%" background="images/ismart_48.jpg" style="border-right:#dadada solid 1px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="30" colspan="3"><span class="web_font_11"><strong><?php echo replace_p_tags(substr(ucfirst($othergroups[$j]['group_name']),0,50));?></strong></span></td>
                        </tr>
                        <tr>
                          <td colspan="3" align="left"><span class="web_font_9"><strong><?php echo replace_p_tags(substr(ucfirst($othergroups[$j]['group_desc']),0,150));?></strong></span></td>
                        </tr>
                        <tr>
                          <td width="40%" height="30" class="top_link"><a href="groups_inner.php?group_id=<?php echo $othergroups[$j]['group_id'];?>"><strong><?php echo $totalnoofcomments1;?>&nbsp;comments</strong></a></td>
                          <td width="40%" height="30" class="top_link"><a href="groups_inner.php?group_id=<?php echo $othergroups[$j]['group_id'];?>"><strong><?php echo $totalnoofmembers1;?>&nbsp; Members</strong></a></td>
                          <td width="20%" class="top_link"><a href="groups_inner.php?group_id=<?php echo $othergroups[$j]['group_id'];?>"><strong>More...</strong></a></td>
                        </tr>
                    </table></td>
                  </tr>
                </table>
                <br />
              </div>
              <?php
			}}else{
			echo '<div class="profile_info_text" align="center">No Groups Found</div>';
			}
			//if(count($othergroups)>0){
			?>
          <!--  <div align="right"><a href="viewall_otherGroups.php" class="page_txt1"/> More &raquo;&raquo;</a></div>-->
            <?php /*}*/?>
			
          
            </td>
          </tr>
        </table></td>
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
