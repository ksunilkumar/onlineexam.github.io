<?php
session_start();
 include_once 'lib/db.php';
 //user_login_check();

// include_once 'lib/users_class.php';
 //include_once"lib/class_ise_blogs.php";
 include_once"lib/ise_settings.class.php";
 
 //$users = new Users();
// $blogs = new Blogs();
 $settings = new ise_Settings();

 $aray_pagination = new aray_pagination;
 if($_REQUEST['blogs']=='blogs')
 {
 	$id=blog_id;
 	$field1=blog_title;
	$field2=blog_desc;
	$table=ise_blogs;
 }
 else
 {
 	$id=forum_id;
 	$field1=forum_name;
	$field2=forum_description;
	$table=ise_forums;
 }
 if(!isset($_SESSION['school_id']))
 {
 	$school_id=1;
 }
 else
 {
 	$school_id=$_SESSION['school_id'];
 }
 
$search_result=$settings->site_search($id,$field1,$field2,$table,$_REQUEST['keywords'], $school_id)

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
                
        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="top">
          <tr bgcolor="#F68122">
          <td width="6" style="background:url(images/sprite_05.jpg) left no-repeat;" height="27">&nbsp;</td>
          <td width="705" background="images/sprite_07.jpg" class="content_head" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="float:right">
              <tr>
                <td width="33%"><strong>
               Search Results</strong></td>
                <td width="42%" align="right"><strong>Select Category :</strong></td>
                <td width="25%">
                
                </td>
              </tr>
            </table>
            </td>
            <td width="6" style="background:url(images/sprite_06.jpg) right no-repeat;" height="27">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top" class="sprite_padding_1 main_box_border">
	<?php
		
 	
	if(is_array($search_result))
	{
        // $rec_limit=10;
		// Loop through all the items in the array

				$i=0;
            foreach ($search_result as $blog_details)
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
                <div style="background-color:<?php echo $backgrnd; ?>">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding:5px;">
                    <tr>
                      
                      <td width="89%" align="left" valign="middle"><span class="content_title"><strong>
					   <?php
					  if($_REQUEST['blogs']=='blogs')
					  {
					  ?>
                      <a href="blog_inner.php?blog_id=<?php echo $blog_details['id'];?>" class="content_title" style="text-decoration:none"/>
                      <?php
					  }
					  else
					  {
					  ?>
                      <a href="forums_inner_search.php?fid=<?php echo $blog_details['id'];?>" class="content_title" style="text-decoration:none"/>
                      <?php
					  }
					  echo ucwords($blog_details['name']);
					  ?></a></strong></span></td>
                      </tr>
                    <tr>
                      
                      <td align="justify" style="line-height:16px; padding-right:60px; text-align:justify;" valign="top">
					  </td>
                      </tr>
                    <tr>
                     
                      <td align="left" valign="middle"><span class="content_small"></span></td>
                      </tr>
                    <tr>
                      
                      <td align="right" >
                     
                      </td>
                      </tr>
                  </table>
                </div>
              <?php		
				}
            // print out the page numbers beneath the results
            echo $pageNumbers;
          }
     
	
	else
	{
		echo '<div class="profile_info_text" align="center">No Results Found</div>';
	}	?>
            </td>
          </tr>
          <tr valign="middle">
            <td colspan="3" class="pagesnum" align="right" height="26" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;
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
