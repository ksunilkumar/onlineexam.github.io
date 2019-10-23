<?php session_start();ob_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Mirrored from www.gallyapp.com/tf_themes/fulladmin/web/index.html by HTTrack Website Copier/3.x [XR&CO'2010], Sat, 10 Jul 2010 19:42:24 GMT -->
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
 
<!-- Website Title --> 
<title>IsmartExams :: Admin </title>

<!-- Meta data for SEO -->
<meta name="description" content=""/>
<meta name="keywords" content=""/>

<!-- Template stylesheet -->
<link rel="stylesheet" href="css/screen.css" type="text/css" media="all"/>
<link href="css/datepicker.css" rel="stylesheet" type="text/css" media="all"/>
<link rel="stylesheet" href="css/tipsy.css" type="text/css" media="all"/>
<link rel="stylesheet" href="js/jwysiwyg/jquery.wysiwyg.css" type="text/css" media="all"/>
<link href="js/visualize/visualize.css" rel="stylesheet" type="text/css" media="all"/>
<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.0.css" media="screen"/>

<!--[if IE 7]>
	<link href="css/ie7.css" rel="stylesheet" type="text/css" media="all">
<![endif]-->

<!--[if IE]>
	<script type="text/javascript" src="js/excanvas.js"></script>
<![endif]-->

<!-- Jquery and plugins -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery.img.preload.js"></script>
<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.0.js"></script>
<script type="text/javascript" src="js/jwysiwyg/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="js/hint.js"></script>
<script type="text/javascript" src="js/visualize/jquery.visualize.js"></script>
<script type="text/javascript" src="js/jquery.tipsy.js"></script>
<script type="text/javascript" src="js/browser.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script language="javascript" src="../../script/check.js"></script>
<script>
function validate(){
getForm("form_login");
		if(!IsEmpty("username","Please Enter  Username"))return false;
		//if(!IsEmail("txtuser_email","Please Enter Valid  Email"))return false;
		if(!IsEmpty("password","Please Enter Password"))return false;
		
}
</script>
</head>
<body class="login">
	
	<!-- Begin control panel wrapper -->
	<div id="wrapper">
	
		<div id="login_top"><img src="images/site_logo.jpg" alt=""/></div>
		
  <br class="clear"/><br/>
	
		<!-- Begin one column box -->
			<div class="onecolumn" style="width:340px;margin:auto">
				
				<div class="header">
				
					<h2>Login</h2>
					
				</div>
				
				<div class="content">
				<?php if($_SESSION['msg']!=''){?>
					<div id="login_info" class="alert_info" style="margin:auto;padding:auto;">
					
                        <p>
							<img src="images/icon_info.png" alt="success" class="middle"/>
							<?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?>
					  </p>
					</div>
					<?php } ?>
					<br class="clear"/>
				
					<form action="login.php" method="post" id="form_login" name="form_login" onSubmit="return validate();">
						<p>
							<input type="text" id="username" name="username" style="width:285px"/>
						</p>
						<br/>
						<p>
							<input type="password" id="password" name="password" style="width:285px" />
						</p>
						<br/>
						<!--<input type="checkbox" id="remember" name="remember"/><span style="font-size:11px;margin-left:5px">Remember my password</span>-->
						<p style="margin-top:30px">
							<input type="submit" class="button_dark" value="Signin"/>	
						</p>
					</form>
				
				</div>
				
			</div>
	
	</div>
	<!-- End control panel wrapper -->
	<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-203192-14']);
  _gaq.push(['_setDomainName', 'none']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</body>

</html>