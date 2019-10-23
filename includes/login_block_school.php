<script type="text/javascript">
function login_form_check()
{
	uname=(eval("document.login_form.uname.value"));
	pswd=(eval("document.login_form.pswd.value"));
	
	if(uname.length==0)
	{
		document.getElementById('login_err').innerHTML='Please Enter Email ID';
		document.login_form.uname.focus();
		return false;
	}
	if(pswd.length==0)
	{
		document.getElementById('login_err').innerHTML='Please Enter Password';
		document.login_form.pswd.focus();
		return false;
	}
}
</script>
<?php
if(isset($_SESSION['user_id']) && $_SESSION['user_id']!='')
{
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="22" align="left" class="sprite_font_3">Welcome <strong><?php echo $_SESSION['user_name']; ?></strong>,</td>
          </tr>
         
          <tr>
            <td height="22" align="left" class="sprite_font_4"><span class="sprite_font_5"><a href="javascript:void();" class="sprite_font_4" style="text-decoration:none;" onclick="loadwindow('change_pswd_school.php','400','250')"><strong>Change Password</strong></a>&nbsp;|&nbsp;<a href="logout.php" class="sprite_font_4" style="text-decoration:none;"><strong>Logout</strong></a></span></td>
          </tr>
          <tr>
            <td height="22" align="left" class="sprite_font_4">Last Login : <?php echo date("d-m-Y H:i:s",strtotime($_SESSION['last_login'])); ?></td>
          </tr>
          <tr>
            <td height="22" align="left" class="sprite_font_4">&nbsp;</td>
          </tr>
        </table>
<?php } else { ?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="login_form" name="login_form" method="post" enctype="multipart/form-data" onsubmit="javascript:return login_form_check();">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="22" colspan="3" align="center" class="sprite_font_2"><strong>Member</strong>
            <span class="sprite_font_3"><strong>Login</strong></span></td>
          </tr>
          <tr>
            <td width="88" align="right" class="sprite_font_4"><strong>Email ID:</strong></td>
            <td width="94"><input name="uname" type="text" class="sprite_text_field" id="uname" value="<?php if(isset($_POST))echo $_POST['uname']; ?>" /></td>
            <td width="24" height="22">&nbsp;</td>
          </tr>
          <tr>
            <td height="22" align="right" class="sprite_font_4"><strong>Password:</strong></td>
            <td><input name="pswd" type="password" class="sprite_text_field" id="pswd" /></td>
            <td align="center"><a href="#"><input type="image" src="images/go_btn.png" name="login" width="16" height="16" border="0" id="login" />
            </a></td>
          </tr>
          <tr>
            <td align="right" class="sprite_font_4"><input name="type" type="radio" id="radio" value="student" <?php if(isset($_POST) && $_POST['type']!='school') { ?> checked="checked" <?php } ?> />
            Student</td>
            <td colspan="2" align="left" class="sprite_font_4"><input type="radio" name="type" id="radio2" value="school" <?php if(isset($_POST) && $_POST['type']=='school') { ?> checked="checked" <?php } ?> />
            School</td>
          </tr>
          <tr>
            <td align="right" class="sprite_font_4">&nbsp;</td>
            <td colspan="2" align="left" class="sprite_font_4"><a href="#" class="sprite_font_5" style="text-decoration:none;" onclick="loadwindow('forget_password.php','480','200')"><strong>Forgot Password?</strong></a></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td colspan="2" class="sprite_font_5"><a href="register.php" class="sprite_font_4" style="text-decoration:none;"><strong>New User !</strong>&nbsp;</a><a href="register.php" class="sprite_font_5" style="text-decoration:none;"><strong>Sign up</strong></a></td>
          </tr>
          <tr>
            <td colspan="3"></td>
          </tr>
        </table>
</form>

<?php 	} ?>