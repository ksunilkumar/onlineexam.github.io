<!-- javascript file using for all pages -->
<script src="js/mootools.js" type="text/javascript"></script>
<script src="js/common.js" type="text/javascript"></script>
<!-- javascript file using for all pages ending -->

<!-- Stylesheets using for all pages -->
<link rel="stylesheet" type="text/css" href="css/test_gen.css" />
<link rel="stylesheet" type="text/css" href="css/test_style.css" />
<link rel="stylesheet" type="text/css" href="css/style_online.css" />
<!-- Stylesheets using for all pages ending-->



<!-- User Login Control Code -->
<?php
	$login_obj = new SqlClass();
	if(isset($_POST['uname']) && $_POST['uname']!='')
	{
	//######## IF Student Login ###########//
		if($_POST['type']=='student')
		{
			$login_sql = "select * from ise_users where user_email='".$_POST['uname']."'";
			$login_rs=$login_obj->executeSql($login_sql);
			if(is_array($login_rs))
			{
				$login_row = $login_obj->fetchRow($login_rs);
				if($login_row['password']==md5($_POST['pswd']))
				{
					$_SESSION['user_email'] = $login_row['user_email'];
					//$_SESSION['login'] = "student";
					$_SESSION['last_login'] = $login_row['last_login'];
					$_SESSION['user_id'] = $login_row['user_id'];
					$_SESSION['school_id'] = $login_row['school'];
					$_SESSION['type'] = $_POST['type'];
					$_SESSION['user_name'] = ucfirst(strtolower($login_row['user_fname']))." ".ucfirst(strtolower($login_row['user_lname']));
					// $_SESSION['log_msg']='Login Successful';
					
					$login_obj1 = new SqlClass();
					$login_update_sql = "update ise_users set last_login='".date('Y-m-d H:i:s')."' where user_id='".$_SESSION['user_id']."'";
					$login_obj1->executeSql($login_update_sql);
					$_SESSION['msg']='<div class="success">Welcome '.$_SESSION['user_name'].'</div>';
					echo '<script>window.location.href="'.$_SESSION['navigation'].'";</script>';
					exit;
				}
				else
				{
					$_SESSION['log_msg']='Password Invalid';
				}
			}
			else
			{
				$_SESSION['log_msg']='Email ID Invalid';
			}

		}
	//######## IF Student Login End ###########//
	//######## IF Student Login ###########//
		else if($_POST['type']=='school')
		{
			$login_sql = "select * from ise_schools where user_name='".$_POST['uname']."'";
			$login_rs=$login_obj->executeSql($login_sql);
			if(is_array($login_rs))
			{
				$login_row = $login_obj->fetchRow($login_rs);
				if($login_row['password']==md5($_POST['pswd']))
				{
					$_SESSION['user_email'] = $login_row['user_name'];
					//$_SESSION['login'] = "student";
					$_SESSION['user_id'] = $login_row['school_id'];
					$_SESSION['school_id'] = $login_row['school_id'];
					$_SESSION['user_name'] = ucfirst(strtolower($login_row['school_name']));
					// $_SESSION['log_msg']='Login Successful';
					
					//$login_obj1 = new SqlClass();
					//$login_update_sql = "update ise_users set last_login='".date('Y-m-d H:i:s')."' where user_id='".$_SESSION['user_id']."'";
					//$login_obj1->executeSql($login_update_sql);
					$_SESSION['msg']='<div class="success">Welcome '.$_SESSION['user_name'].'</div>';
					echo '<script>window.location.href="index_school.php";</script>';
					exit;
				}
				else
				{
					$_SESSION['log_msg']='Password Invalid';
				}
			}
			else
			{
				$_SESSION['log_msg']='Email ID Invalid';
			}
		}
	}

?>
<!-- User Login Control Code End -->

<!-- Top Menu Coding -->
<?php
include_once 'top_menu_school.php';
?>
<!-- Top Menu Coding End -->
  <tr>
    <td height="5" colspan="3" background="images/sprite_02.jpg"></td>
  </tr>

<tr>
 	<td colspan="3">
    <!-- Logo & Login Block Coloumn Coding -->
    <table width="947" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td background="images/qse_006_03.jpg"></td>
        <td background="images/qse_006_03.jpg"></td>
        <td background="images/qse_006_03.jpg"></td>
        <td background="images/qse_006_03.jpg" colspan="2" style="color:#E60000; font-size:10px;" align="center" id="login_err"><?php echo ucwords($_SESSION['log_msg']); if(!empty($_SESSION['log_msg']))unset($_SESSION['log_msg']);?></td>
      </tr>
      <tr>
        <td width="23" height="120" rowspan="3" background="images/qse_006_03.jpg">&nbsp;</td>
        <td width="254" height="26" background="images/qse_006_04.jpg">&nbsp;</td>
        <td width="373" rowspan="3" background="images/qse_006_05.jpg">&nbsp;</td>
        <td rowspan="3" valign="top" background="images/qse_006_06.jpg">
	<!-- Login Form Coding Start -->        

	<?php
    include_once 'login_block_school.php';
    ?>
        
	<!-- Login Form Coding Ending -->        </td>
        <td width="91" rowspan="3" background="images/qse_006_07.jpg">&nbsp;</td>
      </tr>
      <tr>
        <td height="64" id="site_logo">&nbsp;</td> 	<!-- Logo Code Here Logo is named as site_logo.jpg and integrated in site_style.css with in the #site_logo style -->
      </tr>
      <tr>
        <td height="30" background="images/qse_006_07-10.jpg">&nbsp;</td>
      </tr>
    </table>
    <!-- Logo & Login Block Coloumn Code Ending -->
    </td>
</tr>
<!-- Header Middle Banner in Image Format-->
<tr>
    <td height="178" colspan="3" background="images/header_middle_banner.jpg">&nbsp;</td>
</tr>
<!-- Header Middle Banner -->
