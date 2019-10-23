<?php
session_start();
 include_once 'lib/db.php';
 user_login_check();

// include_once 'lib/users_class.php';
 include_once"lib/class_ise_blogs.php";
 include_once"lib/ise_settings.class.php";
 
 //$users = new Users();
 $blogs = new Blogs();
 $settings = new ise_Settings();

 $aray_pagination = new aray_pagination;
 //echo $_REQUEST['selgroup'];
if(isset($_REQUEST['group']) && $_REQUEST['group']!='')
	$blog_cat = $_REQUEST['group'];
else
	$blog_cat = 0;
	
	
	
	
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
<script type="text/javascript">
function change_group(sid)
{
//alert(sid);
	document.categoryforum.group.value=sid;
	document.categoryforum.submit();
}

</script>
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
                <?php
					
				?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="top">
          <tr bgcolor="#F68122">
          <td width="6" style="background:url(images/sprite_05.jpg) left no-repeat;" height="27">&nbsp;</td>
          <td width="705" background="images/sprite_07.jpg" class="content_head" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="float:right">
              <tr>
                <td width="33%"><strong>
                <?php
					if($blog_cat!=0)
						echo ucwords($settings->get_group_name($blog_cat));
					else
						echo 'All';
				?>&nbsp;Blogs</strong></td>
                <td width="42%" align="right"><strong>Select Category :</strong></td>
                <td width="25%">
                
                      <?php
					// $categories=$settings->get_groups_dropdown();
					 if(!empty($_REQUEST)){echo $settings->get_sel_group($_REQUEST['group']);}else{echo $settings->get_groupcategory_dropdown($blog_cat);}?>
                    
				
               
                </td>
              </tr>
            </table>
            <form action="" method="post" name="categoryforum" id="categoryforum">
                 <input type="hidden" name="group" id="group" /></form><br class="clear"/>
            </td>
            <td width="6" style="background:url(images/sprite_06.jpg) right no-repeat;" height="27">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top" class="sprite_padding_1 main_box_border">
	<?php
		
 	if($blog_cat!=0)
		$all_blogs = $blogs->get_category_blogs($blog_cat);
	else
		$all_blogs = $blogs->get_all_blogs();
	
	if(is_array($all_blogs))
	{
        // $rec_limit=10;
		if (count($all_blogs)) {
          // Parse through the pagination class
         $productPages = $aray_pagination->generate($all_blogs,5);
		  // If we have items 
          if (count($productPages) != 0) {
            // Create the page numbers
            $pageNumbers = '<div align="left" style="padding-top:7px;">'.$aray_pagination->links().'</div>';
            // Loop through all the items in the array

				$i=0;
            foreach ($productPages as $blog_details)
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
                      <td width="11%" height="25" align="left" valign="middle">&nbsp;</td>
                      <td width="89%" align="left" valign="middle"><span class="content_title"><strong><?php echo ucwords($blog_details['blog_title']);?></strong></span></td>
                      </tr>
                    <tr>
                      <td align="center" style="line-height:16px;" valign="top">
                      <?php
						if($blog_details['image_path']!='' && file_exists('uploads/blogs/'.$blog_details['image_path']))
						$src='uploads/blogs/'.$user_details['image_path'];
						else
						$src='uploads/blogs/no_blog.png';
					  ?>
                      <img src="<?php echo $src; ?>" width="60" height="60" align="top" /></td>
                      <td align="justify" style="line-height:16px; padding-right:60px; text-align:justify;" valign="top">
					  <?php 
					  		$desc =  substr(stripslashes(wordwrap($blog_details['blog_desc'],75,'&nbsp;',true)),0,300);
							echo ucfirst(nl2br($desc));
							if(strlen($blog_details['blog_desc'])>150) echo '<strong>...</strong>';
					  ?></td>
                      </tr>
                    <tr>
                      <td height="20" align="left" valign="middle">&nbsp;</td>
                      <td align="left" valign="middle"><span class="content_small">Added On : <?php echo  $date = date( "d-M-Y", strtotime( $blog_details['create_date']));?></span></td>
                      </tr>
                    <tr>
                      <td align="right" class="top_link">&nbsp;</td>
                      <td align="right" ><a href="blog_inner.php?blog_id=<?php echo $blog_details['blog_id'];?>" class="page_txt1"/> More &raquo;&raquo;</a></td>
                      </tr>
                  </table>
                </div>
              <?php		
				}
            // print out the page numbers beneath the results
            echo $pageNumbers;
          }
        }
	}
	else
	{
		echo '<div class="profile_info_text" align="center">No Blogs Found</div>';
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
