<?php
session_start();
include_once 'lib/db.php';
include_once ("lib/class_exam_curriculum.php");
user_login_check();	
$queries = new Queries();
$objSql = new SqlClass;
$curiculum=new exams_curriculum();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo Site_Title; ?></title>
<link rel="shortcut icon" href="favicon.png" type="image/x-icon" />
<link rel="stylesheet" href="css/site_styles.css" />
</head>

<body>
<?php include 'includes/light_box.php'; ?>
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
            <td width="100%" background="images/sprite_07.jpg" class="content_head" ><strong>Curriculum</strong></td>
            <td width="0%" align="right" ><img src="images/sprite_06.jpg" width="6" height="27" /></td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top" class="sprite_padding_1 main_box_border">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr> 
				<?php
					$sql="select distinct(cur_id) from test_course where school_id='".$_SESSION['school_id']."'";
					$curi=$objSql->executeSql($sql);
					  for($i=1;$i<=count($curi);$i++)
					  {
					
					  $curicullums=$curiculum->curriculum_name_select($curi[$i-1]['cur_id']);
				?>
               
                  <td align="center"><a href="grades.php?curid=<?php echo $curicullums[0]['cur_id'];?>"><img src="<?php echo $curicullums[0]['cur_image'];?>" width="165" height="111" border="0" /></a></td>
                 <?php
					  if($i%4==0)
					  {
					  ?>
                </tr>
                <tr>
                 <?
					  }
					  }
				  ?>
            </table>
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
