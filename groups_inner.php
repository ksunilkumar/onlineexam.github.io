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
function show()
{
alert(document.getElementById('mail_content').style.display);
if(document.getElementById('mail_content').style.display == 'block')
{
	document.getElementById('mail_content').style.display = 'none'; 
} 
else if(document.getElementById('mail_content').style.display == 'none')
{
	document.getElementById('mail_content').style.display = 'block'; 
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
            <table width="100%" border="0" cellspacing="0" cellpadding="0" >
              <tr bgcolor="#F68122">
                <td width="6" style="background:url(images/sprite_05.jpg) left no-repeat;" height="27"></td>
                <td width="705" background="images/sprite_07.jpg" class="content_head" ><table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="80%"><strong><?php echo ucwords(substr($group_details['group_name'],0,70)); ?> Group</strong></td>
                      <td><?php if($_SESSION['type']=='student')
					{
					$result=$isgroupmem->get_user_memeber($group_details['group_id'],$_SESSION['user_id']);
				
				  	
					/*echo $res[$i]->group_id;
					exit;*/
				  if($result=='Not Group member'){?>
                        <form name="join" method="post" action="join_group.php?gid=<?php echo $group_details['group_id'];?>" onsubmit="return addconfirmation()">
                          <input type="image" src="images/join_group.jpg" width="110" height="19" border="0" />
                        </form>
                        <?php } else if($result=='Group member'){?>
                        <form name="leave" method="post" action="leave_group.php?gid=<?php echo $group_details['group_id'];?>" onsubmit="return confirmation()">
                          <input type="image" src="images/unjoin_group.jpg" width="110" height="19" border="0"/>
                        </form>
                        <?php }} ?>
                      </td>
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
                      <td width="69" rowspan="3" align="center" valign="middle" bgcolor="#D24400">
					  <?php
				if($group_details['group_pic']!='' && file_exists('uploads/groups/'.$group_details['group_pic']))
					$src='uploads/groups/'.$group_details['group_pic'];
				else
					$src='uploads/groups/no_image.png';
			?>
                        <img src="<?php echo $src; ?>" width="60" height="60" align="absmiddle" /> </td>
                      <td width="630" height="23" bgcolor="#D24400" class="content_head">&nbsp;Group Name : <strong><?php echo ucwords($group_details['group_name']); ?></strong></td>
                    </tr>
                    <tr>
                      <td height="23" bgcolor="#D24400" class="content_head">&nbsp;School: <strong><?php echo ucwords($settings->get_school_name($group_details['school_id'])); ?></strong></td>
                    </tr>
                    <tr>
                      <td height="23" bgcolor="#D24400" class="content_head">Group Added On : <strong><?php echo date("d-M-Y",strtotime($group_details['create_date'])); ?></strong></td>
                    </tr>
                    <tr>
                      <td colspan="2" style="line-height:20px; padding-right:3px; text-align:justify;"><span class="sprite_font_3"><strong><br />
                        <u>Group Description</u> :</strong></span><br />
                        <?php 
					  		$desc =  stripslashes(wordwrap($group_details['group_desc'],75,'&nbsp;',true));
							echo '<p>'.ucfirst(nl2br($desc)).'</p>';
					  ?>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2" align="center" valign="middle" bgcolor="#D24400"  class="content_head" style="line-height:20px; padding-right:3px; text-align:justify;"><strong>Group Members:</strong>&nbsp;<strong><?php echo $noofmembers;?></strong> Members<div style="float:right;"><a onclick="show()" class="content_head" style="cursor:pointer">Send a Mail</a></div></td>
                      
                    </tr><form name="group_mems" method="POST" action="group_send_mails.php">
                    <tr>
                      
                      <td align="left" valign="middle" width="25%">
                          <div id="mail_content" style="display:none">
                          <table>
                          	<tr>
                            	<td>Subject</td>
                                <td><input type="text" name="subject" /></td>
                            </tr>
                            <tr>
                            	<td>Message</td>
                                <td><textarea name='message'></textarea></td>
                            </tr>
                            <tr>
                            	<td>Message</td>
                                <td><input type="submit" name="Submit" value="Submit"/></td>
                            </tr>
                          </table>
                          
                          </div>
                          </td>
                          </tr>
                          <tr>
                          <td colspan="2"><table width="100%" cellpadding="0" cellspacing="0">
                          <tr>
                          
                            <?php 
			   $members=$group_members->get_group_members($_SESSION['school_id'],$group_id);
			  
			  if(is_array($members)){
			  for($i=0;$i<count($members) && $i<4;$i++){
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
                                    <img src="user_images/<?php echo $image;?>" width="80" height="90" border="0" /><br />
                                    <!--</a>--></td>
                                </tr>
                                <tr>
                                  <td height="25" align="left" style="color:#000; font-weight:bold; padding-left:15px;" ><?php if($_SESSION['type']=='school')
					{?><input name="user_id[]" type="checkbox" value="<?php echo $members[$i]['user_id'];?>" /><?php } ?><?php echo ucwords($name);?></td>
                                </tr>
                              </table></td>
                            <?php }
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
                          <?php 
                  if(count($members)>4){?>
                          <tr bgcolor="#FAD0BE" height="25">
                            <td colspan="4" align="right"><a href="group_members_all.php?group_id=<?php echo $group_id;?>" class="page_txt1"/> More &raquo;&raquo;</a></td>
                          </tr>
                          <?php }?>
                        </table></td>
                    </tr></form>
                    <tr>
                      <td bgcolor="#D24400" colspan="2" width="200" class="content_head" style="line-height:20px; padding-right:3px; text-align:justify;"><strong>Group Commetns</strong></td>
                      
                    </tr>
                    <tr>
                      <td colspan="2"><?php
$sql = "SELECT * FROM ise_group_posts where group_id=".$group_id." and user_id=".$_SESSION['user_id']." and status='active' ORDER BY posted_date DESC";

$pagination_key = new pagination_new;
						
$pagination_key->createPaging($sql,5);
$bagsize=$pagination_key->recordsize();
$i=0;

$i=1;
while($row=mysql_fetch_object($pagination_key->resultpage))
{

?>
                        <div style="width:500px; padding:5px; border-bottom:#EC4D00 thin dashed; text-align:justify; line-height:16px;">
                          <?php 
        $comment =  stripslashes(wordwrap($row->message,75,'&nbsp;',true));
        echo ucfirst(nl2br($comment));
      ?>
                          <br/>
                          <span class="sprite_font_6"><strong>Commented By :</strong></span><strong> <span class="sprite_font_4"><?php echo ucwords($users->user_name($row->user_id)); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Commented On : <span class="sprite_font_4"><?php echo date("d-M-Y h:i:s a",strtotime($row->posted_date)); ?></span></strong></div>
                        <?php 
	$i++;
}
?>
                        <?php
           if($bagsize!=0)
		   {
		   ?>
                        <div style="padding-top:10px;">
                          <?=$pagination_key->totalrecords()?>
                          &nbsp;&nbsp;&nbsp;
                          <?=$pagination_key->displayPaging($group_id);?>
                        </div>
                        <?php } else { ?>
                        <div class="profile_info_text" style="padding-top:10px; text-align:left">No Comments Found</div>
                        <?php } ?>
                      </td>
                    </tr>
                    <?php  if($result=='Group member'){?>
                    <tr>
                      <td colspan="2" align="left" height="40"><a href="javascript:void();" onclick="javascript:comment('<?php echo $group_id;?>');"><img src="images/add_comments.png" width="157" height="27" border="0"</a> </td>
                    </tr>
                    <?php }?>
                    <tr>
                      <td colspan="2"><div id="<?php echo $group_id;?>" style="width:400px; height:100%; display: none;">
                          <form id="<?php echo $group_id;?>" name="postcomments" action="" method="post"  onsubmit="return check()">
                            <table width="400" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                              <tr>
                                <td colspan="2" class="he">&nbsp;</td>
                              </tr>
                              <tr>
                                <td ><b>Enter Comments:</b></td>
                                <td align="left"><textarea name="desc" cols="30" rows="3"></textarea></td>
                              </tr>
                              <tr>
                                <td height="35" colspan="2" align="center" valign="middle"><input type="image" src="images/submit.jpg" name="Submit" value="Submit Comment" />
                                </td>
                              </tr>
                            </table>
                          </form>
                        </div></td>
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
