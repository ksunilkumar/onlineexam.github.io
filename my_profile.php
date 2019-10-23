<?php
session_start();
 include_once 'lib/db.php';
 
 include_once 'lib/users_class.php';
 include_once 'lib/ise_settings.class.php';

 user_login_check();

 $users=new Users();
 $user_details=$users->get_user_details($_SESSION['user_id']);
 
 $settings=new ise_Settings();
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
            <td width="705" background="images/sprite_07.jpg" class="content_head" ><strong>My Profile</strong></td>
            <td width="6" style="background:url(images/sprite_06.jpg) right no-repeat;" height="27">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top" class="sprite_padding_1 main_box_border"><table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
                <tr>
                  <td width="100%"><table class="profile_border" border="0" cellpadding="0" cellspacing="5" width="99%">
                      <tbody>
                        <tr>
                          <td rowspan="4" align="center" width="20%" valign="middle">
                          <?php
                          	if($user_details['user_pic_add']!='' && file_exists('user_images/'.$user_details['user_pic_add']))
							$src='user_images/'.$user_details['user_pic_add'];
							else
							$src='user_images/no_image.png';
						  ?>
                          <img src="<?php echo $src; ?>" width="100" height="100" />                          </td>
                          <td style="border-bottom: 1px dashed rgb(204, 204, 204);" valign="middle" height="30" width="80%"><strong><?php echo ucwords($user_details['user_fname'].' '.$user_details['user_lname']); ?></strong><br /></td>
                        </tr>
                        <tr>
                          <td style="border-bottom: 1px dashed rgb(204, 204, 204);" valign="middle" height="30"><?php echo ucfirst($user_details['user_gender']);?> , <?php echo $users->get_age($user_details['dob'],'-','yyyymmdd').' Years'; ?></td>
                        </tr>
                        <tr>
                          <td style="border-bottom: 1px dashed rgb(204, 204, 204);" valign="middle" height="30"><?php echo ucwords($user_details['city']); ?> . <?php echo $settings->get_state_name(ucwords($user_details['state'])); ?> . <?php echo $settings->get_country_name(ucwords($user_details['country'])); ?></td>
                        </tr>
                        <tr>
                          <td class="normal_link" align="left" valign="middle" height="30"><a href="javascript:void();" onclick="loadwindow('change_photo.php?path=<?php echo $src; ?>','520','180')">Change photo</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void();" onclick="loadwindow('edit_profile.php','700','550')" >Edit Profile</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void();" onclick="loadwindow('change_pswd.php','400','230')">Change Password</a></td>
                        </tr>
                        <tr>
                          <td colspan="2" align="left" height="22" style="border-top: 1px dashed rgb(204, 204, 204); padding-top:5px;">
						  <table border="0" cellpadding="0" cellspacing="0" width="100%">
                              <tr>
                                  <td width="235" valign="top">
								<img src="images/info_top.png" width="225" height="29" />
                                <table border="0" align="left" cellpadding="0" cellspacing="0" width="225" style="border:#008000 thin solid;">
                                      <tbody>
                                        <tr>
                                          <td colspan="2" height="8"></td>
                                        </tr>
                                        <tr>
                                          <td >&nbsp;</td>
                                          <td><span class="profile_info_text">Date of Birth</span><br />
                                            <?php echo date("d-M-Y",strtotime($user_details['dob'])); ?></td>
                                        </tr>
                                        <tr>
                                          <td style="color: rgb(169, 222, 129);" colspan="2">............................................</td>
                                        </tr>
                                        <tr>
                                          <td>&nbsp;</td>
                                          <td><span class="profile_info_text">Mobile Number</span><br />
                                           <?php echo $user_details['mobile_no']; ?></td>
                                        </tr>
                                        <tr>
                                          <td style="color: rgb(169, 222, 129);" colspan="2">............................................</td>
                                        </tr>
                                        <tr>
                                          <td>&nbsp;</td>
                                          <td><span class="profile_info_text">Email ID</span><br />
                                          <?php echo $user_details['user_email']; ?></td>
                                        </tr>
                                        <tr>
                                          <td style="color: rgb(169, 222, 129);" colspan="2">............................................</td>
                                        </tr>
                                        <tr>
                                          <td>&nbsp;</td>
                                          <td><span class="profile_info_text">Contact Method</span><br />
                                           <?php if($user_details['contact_method']==1) echo 'By Phone'; else echo 'By Email'; ?></td>
                                        </tr>
                                        <tr>
                                          <td style="color: rgb(169, 222, 129);" colspan="2">............................................</td>
                                        </tr>
                                        <tr>
                                          <td>&nbsp;</td>
                                          <td><span class="profile_info_text">School Name</span><br />
                                            <?php echo ucwords($settings->get_school_name($user_details['school'])); ?></td>
                                        </tr>
                                        <tr>
                                          <td colspan="2" height="5"></td>
                                        </tr>
                                        <tr>
                                          <td colspan="2" height="10"></td>
                                        </tr>
                                      </tbody>
                                  </table>                                  </td>
                          <td valign="top">
                                            <div class="head1"><strong>My Biography</strong></div>
                                            <img height="1" width="100%" src="images/sprite_12.jpg"><br/>
									  <?php 
                                        if($user_details['biography']!='')
                                        {
                                            echo '<span style="line-height:20px;">'.nl2br($user_details['biography']).'</span><br/><br/>';
                                        }
										else
										{
											echo '<div height="100px">Not Available</div>';
										}
									  ?>
                            <hr color="#FFFFFF" style="border-bottom: 1px dashed rgb(204, 204, 204); height:0.5px;"/>
                                            <div class="head1"><strong>My Interests</strong></div>
                                            <img height="1" width="100%" src="images/sprite_12.jpg"><br/>
                                      <?php
									    if($user_details['interest']!='')
                                        {
                                            echo '<span style="line-height:20px;">'.nl2br($user_details['interest']).'</span><br/><br/>';
                                        }
										else
										{
											echo '<div height="100px">Not Available</div>';
										}
                                      ?>
                                            <hr color="#FFFFFF" style="border-bottom: 1px dashed rgb(204, 204, 204); height:0.5px;"/>
                                  </td>
                              </tr>
                          </table>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2" align="left" height="10"></td>
                        </tr>
                      </tbody>
                  </table></td>
                  <td align="right" valign="top" width="15%">&nbsp;</td>
                </tr>
              </tbody>
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
