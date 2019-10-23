<?php
session_start();
include_once 'lib/db.php';

user_login_check();
include_once 'lib/users_class.php';

if(!file_exists($_GET['path']))
	$image_name='user_images/no_image.png';
else
	$image_name=$_GET['path'];
?>
<?php
	if(isset($_GET['pic_url']))
	{
		if($_GET['pic_url']!='user_images/no_image.png')
			unlink($_GET['pic_url']);
	}

	if(!empty($_FILES["profile_image"]))
	{
			$filename = stripslashes($_FILES['profile_image']['name']);
			$extension = getExtension($filename);
			$extension = strtolower($extension);
			
			$error=0;

		if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
		{
			$_SESSION['msg'] = "<div class='success'>Unknown Profile Image Extension ( ".$extension." )! Please Upload Onely png, jpg, jpeg, gif Image</div>";
			$image_name=$_POST['path'];
			$error = '1';
		}
		if($error == '0')
		{

			$image_name = time().".".$extension;
			$newname = "user_images/".$image_name;
			$copied = copy($_FILES['profile_image']['tmp_name'], $newname);
			
			if($_POST['path']!='user_images/no_image.png')
				unlink($_POST['path']);

			$prof_obj = new SqlClass();
			$prof_sql = "UPDATE ise_users SET user_pic_add='".$image_name."' where user_id=".$_SESSION['user_id'];
			$prof_obj->executeSql($prof_sql);
			$_SESSION['msg']='<div class="success">Profile Image Changed Successfully</div>';
			echo '<script>parent.location.href="my_profile.php";</script>';
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo Site_Title; ?></title>
<link rel="stylesheet" href="css/site_styles.css" />
<script type="text/javascript">
function getFileType(sValue)
{
  // alert(sValue);
  var aParts = sValue.split("/");
  var iParts = aParts.length;

  if( iParts >= 1 && aParts[0].length>0)
  {
    var sFile = aParts[ iParts - 1 ];
    var aFile = sFile.split( "." );
    if( aFile.length == 2 )
    {
      sName = aFile[0];
      sExt = aFile[1];
      
		  if(sExt=='png' || sExt=='PNG' || sExt=='jpg' || sExt=='JPG' || sExt=='jpeg' || sExt=='JPEG' || sExt=='gif' || sExt=='GIF')
		  {
			//alert("Filename is: "+sName+" extension is: "+sExt);
			return true;
		  }
		  else
		  {
			alert('Please Upload Only .jpg, .png, .jpeg, .gif Images.!');
			return false;
		  }
    }
    else
    {
      alert("Bad filespec; should have one dot between name and extension");
	  return false;
    }
  }
  else
  {
    alert("Please Upload Profile Image");
	return false;
  }
}

function remove_image()
{
	var stat=confirm("Are you sure want to delete the profile image");
	if(stat)
	{
		var path=document.getElementById('path').value;
		// alert(path);
		window.location.href='change_photo.php?pic_url='+path;
		return true;
	}
}
</script>
</head>
<body style="background:none;">
<form action="change_photo.php" method="post" enctype="multipart/form-data" name="change_photo" target="_self" id="change_photo" onSubmit="return getFileType(this.profile_image.value)">
  <table width="500" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="3" style="border-bottom:#666666 dashed 1px;" valign="top" class="pad1 menu_headsmall" height="25"><strong>Change Profile Image</strong></td>
    </tr>
    <tr>
      <td colspan="3"><span style="padding-left:6px; padding-right:6px;"><?php echo ucwords($_SESSION['msg']); if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></span></td>
    </tr>
    <tr>
      <td valign="top" width="29%">Upload Profile Image &nbsp;:</td>
      <td width="53%" valign="middle"><input type="file" name="profile_image" value="" id="profile_image" />
          <br />
          <span class="required">Upload Only .jpg, .png, .jpeg, .gif Images.! </span></td>
      <td width="18%" rowspan="2" align="center" valign="middle"><img src="<?php echo $image_name; ?>" width="80" height="70" align="absmiddle" /><br />
      <?php if($image_name!='user_images/no_image.png') { ?>
      <a href="javascript:remove_image();" style="color:#FF0000; text-decoration:none;"> Remove Image</a></td>
      <?php } ?>
    </tr>
    <tr>
      <td height="40"></td>
      <td valign="middle">
      <input type="image" src="images/submit.jpg" />
      <input type="hidden" name="path" id="path" value="<?php echo $image_name; ?>" />
      </td>
    </tr>
  </table>
</form>
</body>
</html>