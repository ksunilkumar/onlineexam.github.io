<?php
session_start();
 include_once 'lib/db.php';
 user_login_check();
 
 include_once 'lib/users_class.php';
 include_once 'lib/class_ise_groups.php';
 include_once 'lib/ise_settings.class.php';
 
 $users = new Users();
 $user_details=new Users();
 $groups = new ise_groups();
 $isgroupmem = new ise_groups();
 $group_members = new ise_groups();
 $groupmembers = new ise_groups();
 $settings = new ise_Settings();

if(isset($_GET['group_id'])&& $_GET['group_id']!='')
	$group_id = $_GET['group_id'];
else if(isset($_GET['option'])&& $_GET['option']!='')
	$group_id = $_GET['option'];
else
	$group_id = 0;

if(isset($_POST['desc']) && $_POST['desc']!='')
{
	$objSql = new SqlClass();
	$sql = "INSERT INTO ise_group_posts (user_id,group_id, message, posted_date, status)
			VALUES (".$_SESSION['user_id'].",".$group_id.",'".addslashes($_POST['desc'])."',NOW(),'inactive' )";
	$objSql->executeSql($sql);
	$_SESSION['msg'] = "<div class='success'>Your Comment Posted Successfully.This comment has admin aproval to display</div>";
	echo '<script>self.location.href="groups_inner.php?'.$_SERVER['QUERY_STRING'].'";</script>';
	exit;
}
	
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
<script type="text/javascript" src="js/check.js"></script>
<script type="text/javascript">
function check()
{
	getForm("postcomments");
	if(!IsEmpty("desc","Please Enter Comments"))return false;
}

function comment(id)
{
	var state = document.getElementById(id).style.display;
	if (state == 'block')
	{
		document.getElementById(id).style.display = 'none';
	} else {
		document.getElementById(id).style.display = 'block';
	}
}



function confirmation(){
var answer=confirm("Are you sure want to leave this group");
if(answer)
return true;
else
return false;
}
function addconfirmation(){
var answer=confirm("Are you sure want to join this group");
if(answer)
return true;
else
return false;
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
  <tr>
    <td colspan="3" align="left" style="padding:5px; background-image:url(images/sprite_01.jpg); background-repeat:repeat-x;">&nbsp;
      <?php breadcrum(); ?></td>
  </tr>
  <!-- Breadcrum()-->
  <!-- Middle Row Content -->
  <tr>
    <td colspan="3" bgcolor="#FFFFFF" class="sprite_padding_1"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="200">
        <tr>
          <!-- Left Coloumn Code -->
          <td width="185" style="padding-left:0px; padding-right:0px;" valign="top"><?php include_once 'tab_02_templete.php'; ?>
            <?php include_once 'tab_01_templete.php'; ?>
            <?php include_once 'tab_03_templete.php'; ?></td>
          <!-- Center Coloumn Code -->
          <td width="*" style="padding-left:6px; padding-right:6px;" valign="top"><?php  if(!empty($_SESSION['msg'])){echo ucwords($_SESSION['msg']);unset($_SESSION['msg']);}?>
            <?php $group_details = $groups->get_group_info($group_id);
		$noofmembers=$groupmembers->get_group_noofmembers($_SESSION['school_id'],$group_details['group_id']);
		?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
              <tr bgcolor="#F68122">
                <td width="6" style="background:url(images/sprite_05.jpg) left no-repeat;" height="27"></td>
                <td width="705" background="images/sprite_07.jpg" class="content_head" ><table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="80%"><strong><?php echo ucwords(substr($group_details['group_name'],0,70)); ?> Group Members</strong></td>
                      
                      </tr>
                  </table></td>
                <td width="6" style="background:url(images/sprite_06.jpg) right no-repeat;" height="27">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3" align="left" valign="top" class="sprite_padding_1 main_box_border">
				<?php
			if($group_details['school_id']==$_SESSION['school_id'])
			 {
		?>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  
                    <tr>
                      <td colspan="2" align="center" valign="middle" bgcolor="#D24400"  class="content_head" style="line-height:20px; padding-right:3px; text-align:justify;"><strong>Group Members:</strong>&nbsp;<strong><?php echo $noofmembers;?></strong> Members</td>
                    </tr>
                    <tr>
                      <td colspan="2"><table width="100%" cellpadding="0" cellspacing="0">
                          <tr>
                            <?php 
			   $members=$group_members->get_group_members($_SESSION['school_id'],$group_id);
			  
			  if(is_array($members)){
			 $j=0;
			  for($i=0;$i<count($members) && $i<4;$i++){
			  $j++;
			  $user=$user_details->get_user_details($members[$i]['user_id']);
			 
			  if($user['user_pic_add']!='' && file_exists("users/".$user['user_pic_add']))
			  $image=$user['user_pic_add'];
			  else
			  $image='no_image.png';
			  $name=$user['user_fname'];
			  ?>
                            <td align="left" valign="middle" width="25%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td  align="left"><!--<a href="profile.php?fid=<?php echo $members[$i]['user_id'];?>" style="text-decoration:none">-->
                                    <img src="user_images/<?php echo $image;?>" width="80" height="90" border="0" />
                                    <!--</a>--></td>
                                </tr>
                                <tr>
                                  <td height="25" align="left" style="color:#000; font-weight:bold; padding-left:15px;" ><?php echo ucwords($name);?></td>
                                </tr>
                              </table></td>
                            <?php if($j%4==0){?>
                            </tr><tr>
                            <?php
							}
							}
			  if(count($members)<4){
			  for($z=0;$z<4-count($members);$z++){
			  ?>
                            <td width="25%"></td>
                            <?php } }}else{
			   ?>
                            <td colspan="4"><div class="profile_info_text" style="padding-top:10px; text-align:left">No Members in this Group</div></td>
                            <?php }
			 ?>
                          </tr>
                        
                        </table></td>
                    </tr>
                   
                   
                  
                    
                  </table>
                  <?php }
	else {
			echo '<div class="profile_info_text" align="center">Group Not Available</div>';
	} ?>
                </td>
              </tr>
            </table></td>
          <!-- Right Coloumn Code -->
          <td width="0" style="padding-left:0px; padding-right:0px;" valign="top"></td>
        </tr>
      </table></td>
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
