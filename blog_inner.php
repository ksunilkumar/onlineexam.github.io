<?php
session_start();
 include_once 'lib/db.php';
 user_login_check();
 
 include_once 'lib/users_class.php';
 include_once 'lib/class_ise_blogs.php';
 include_once 'lib/ise_settings.class.php';
 
 $users = new Users();
 $blogs = new Blogs();
 $settings = new ise_Settings();

if(isset($_GET['blog_id'])&& $_GET['blog_id']!='')
	$blog_id = $_GET['blog_id'];
else if(isset($_GET['option'])&& $_GET['option']!='')
	$blog_id = $_GET['option'];
else
	$blog_id = 0;

if(isset($_POST['desc']) && $_POST['desc']!='')
{
	$objSql = new SqlClass();
	$sql = "INSERT INTO ise_blog_review (blog_id, user_id,review_desc, create_date, status)
			VALUES (".$blog_id.",".$_SESSION['user_id'].",'".addslashes($_POST['desc'])."',NOW(),'inactive' )";
	$objSql->executeSql($sql);
	$_SESSION['msg'] = "<div class='success'>Your Comment Posted Successfully.This comment has admin aproval to display</div>";
	echo '<script>self.location.href="blog_inner.php?'.$_SERVER['QUERY_STRING'].'";</script>';
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
        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
          <tr bgcolor="#F68122">
            <td width="6" style="background:url(images/sprite_05.jpg) left no-repeat;" height="27">&nbsp;</td>
            <td width="705" background="images/sprite_07.jpg" class="content_head" ><strong><?php $blog_name=$blogs->get_blog_name($blog_id);echo ucwords(substr($blog_name['blog_title'],0,70)); ?> Blog</strong>
              <div style="float: right; padding-left: 25px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; color: rgb(17, 78, 171); font-weight: bold;" id="listDivWait"></div></td>
            <td width="6" style="background:url(images/sprite_06.jpg) right no-repeat;" height="27">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top" class="sprite_padding_1 main_box_border">
		<?php
			$blog_details = $blogs->get_blog_details($blog_id);
			
			if($blog_details['school_id']==$_SESSION['school_id'])
			 {
		?>
                    
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="69" rowspan="3" align="center" valign="middle" bgcolor="#D24400">
			<?php
				if($blog_details['image_path']!='' && file_exists('uploads/blogs/'.$blog_details['image_path']))
					$src='uploads/blogs/'.$user_details['image_path'];
				else
					$src='uploads/blogs/no_blog.png';
			?>
                <img src="<?php echo $src; ?>" width="60" height="60" align="absmiddle" />
                </td>
                <td width="630" height="23" bgcolor="#D24400" class="content_head">&nbsp;Blog Name : <strong><?php echo ucwords($blog_details['blog_title']); ?></strong></td>
              </tr>
              <tr>
                <td height="23" bgcolor="#D24400" class="content_head">&nbsp;Blog Category : <strong><?php echo ucwords($settings->get_cat_name($blog_details['cat_id'])); ?></strong></td>
              </tr>
              <tr>
                <td height="23" bgcolor="#D24400" class="content_head"> Blog Added On : <strong><?php echo ucwords($blog_details['create_date']); ?></strong></td>
              </tr>
              <tr>
                <td colspan="2" style="line-height:20px; padding-right:3px; text-align:justify;">
                    <span class="sprite_font_3"><strong><br />
					<u>Blog Description</u> :</strong></span><br />
                    <?php 
					  		$desc =  stripslashes(wordwrap($blog_details['blog_desc'],75,'&nbsp;',true));
							echo '<p>'.ucfirst(nl2br($desc)).'</p>';
					  ?>                   </td>
                </tr>
              <tr>
                <td colspan="2" class="sprite_font_3" style="line-height:20px; padding-right:3px; text-align:justify;"><strong><u>Blog Commetns</u> :</strong></td>
              </tr>
        <tr>
            <td colspan="2">
<?php
$sql = "SELECT * FROM ise_blog_review where blog_id=".$blog_id." and user_id=".$_SESSION['user_id']." and status='active' ORDER BY create_date DESC";

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
        $comment =  stripslashes(wordwrap($row->review_desc,75,'&nbsp;',true));
        echo ucfirst(nl2br($comment));
      ?>
<br/>
<span class="sprite_font_6"><strong>Commented By :</strong></span><strong> <span class="sprite_font_4"><?php echo ucwords($users->user_name($row->user_id)); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Commented On : <span class="sprite_font_4"><?php echo date("d-M-Y h:i:s a",strtotime($row->create_date)); ?></span></strong></div>
<?php 
	$i++;
}
?>
           <?php
           if($bagsize!=0)
		   {
		   ?>
           <div style="padding-top:10px;"><?=$pagination_key->totalrecords()?>&nbsp;&nbsp;&nbsp;<?=$pagination_key->displayPaging($blog_id);?></div>
           <?php } else { ?>
           <div class="profile_info_text" style="padding-top:10px; text-align:left">No Comments Found</div>
           <?php } ?>           </td>
        </tr>
        <tr>
          <td colspan="2" align="left" height="40">
          <a href="javascript:void();"><img src="images/add_comments.png" width="157" height="27" border="0" onclick="javascript:comment('<?php echo $blog_id;?>');" /></a>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <div id="<?php echo $blog_id;?>" style="width:400px; height:100%; display: none;">
            <form id="<?php echo $blog_id;?>" name="postcomments" action="" method="post"  onsubmit="return check()">
            <table width="400" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                <tr>
                    <td colspan="2" class="he">&nbsp;</td>
                </tr>
                
                <tr>
                    <td ><b>Enter Comments:</b></td>
                    <td align="left">
                    <textarea name="desc" cols="30" rows="3"></textarea></td>
                </tr>
                <tr>
                <td height="35" colspan="2" align="center" valign="middle">
                    <input type="image" src="images/submit.jpg" name="Submit" value="Submit Comment" />	
				</td>
                </tr>
            </table>
            </form>
            
            </div>       
          </td>
        </tr> 
		</table>
	<?php }
	else {
			echo '<div class="profile_info_text" align="center">Blog Not Available.</div>';
	} ?>    
        </td>
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
