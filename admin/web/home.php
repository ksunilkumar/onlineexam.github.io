<?php  ob_start();
	session_start();
	include_once '../../lib/functions.php';
	include_once '../../lib/db.php';
	//$_SESSION['school_id']=1;
		//admin_login_check();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
 
<!-- Website Title --> 
 
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
 
<title>IsmartExams :: Admin</title></head> 
<body> 
<?php include_once 'header_one.php';?>
		<!-- End main menu --> 
		
		
		<!-- Begin shortcut menu --> 
		<?php include 'left_one.php'; ?> 
		<!-- End shortcut menu --> 
		
		<br class="clear"/> 
		
		<!-- Begin content --> 
		<div id="content_wrapper"> 
        <table width="97%" align="center" border="0" cellpadding="0" cellspacing="0" class="global">
   <?php
                    	if($_REQUEST['opt']=='mu')
                   		include 'code/manageusers/user.php';
  			else if($_REQUEST['opt']=='amu')
                 		include 'code/manageusers/add_user.php';
  			else if($_REQUEST['opt']=='edu')
				include 'code/manageusers/edit_user.php';
else if($_REQUEST['opt']=='cr')
                 		include 'code/managecareerresource/main_manage_career.php';
						else if($_REQUEST['opt']=='ecr')
                 		include 'code/managecareerresource/edit_careers.php';
						else if($_REQUEST['opt']=='mncr')
                 		include 'code/managecareerresource/manage_career.php';			
else if($_REQUEST['opt']=='ms')
   				include 'code/manageskools/main_manage_skools.php';
			else if($_REQUEST['opt']=='adds')
    				include 'code/manageskools/manage_skools.php';
else if($_REQUEST['opt']=='sph')
				include 'code/manageskools/manage_programsheaders.php';
else if($_REQUEST['opt']=='sphm')
				include 'code/manageskools/main_manage_programheaderss.php';
			else if($_REQUEST['opt']=='eds')
    				include 'code/manageskools/edit_skool.php';
			else if($_REQUEST['opt']=='suc')
				include 'code/manageskools/success.php';
			else if($_REQUEST['opt']=='skp')
				include 'code/manageskools/manage_programs.php';
			else if($_REQUEST['opt']=='skc')
				include 'code/manageskools/manage_careeroptions.php';
			else if($_REQUEST['opt']=='ma')
				include 'code/manageads/main_manage_ads1.php';
			else if($_REQUEST['opt']=='ma1')
				include 'code/manageads/main_manage_ads.php';
			else if($_REQUEST['opt']=='aa')
 				include 'code/manageads/add_ads.php';
				else if($_REQUEST['opt']=='addform')
 				include 'code/manageonlineform/add_form.php';
					else if($_REQUEST['opt']=='addfield')
 				include 'code/manageonlineform/add_formfield.php';
			else if($_REQUEST['opt']=='ea')
 				include 'code/manageads/manage_ads.php';
else if($_REQUEST['opt']=='da')
 				include 'code/manageads/updatedefaultimage.php';
			else if($_REQUEST['opt']=='md')
				include 'code/manageusers/multiple_address.php';
			else if($_REQUEST['opt']=='address')
				include 'code/manageusers/add_address.php';
			else if($_REQUEST['opt']=='aee')
				include 'code/manageexams/add_examevent.php';
			else if($_REQUEST['opt']=='eee')
				include 'code/manageexams/edit_examevent.php';
			else if($_REQUEST['opt']=='sid')
				include 'code/manageskools/manage_skoolimportantdates.php';
			else if($_REQUEST['opt']=='ase')
				include 'code/manageskools/add_skoolevent.php';
			else if($_REQUEST['opt']=='ese')
				include 'code/manageskools/edit_skoolevent.php';
			else if($_REQUEST['opt']=='mmpro')
				include 'code/manageskools/main_manage_programs.php';
			else if($_REQUEST['opt']=='edpro')
				include 'code/manageskools/edit_programs.php';
			else if($_REQUEST['opt']=='mmaddress')
				include 'code/manageusers/main_manage_address.php';
			else if($_REQUEST['opt']=='edit_address')
				include 'code/manageusers/edit_address.php';
			else if($_REQUEST['opt']=='mco')
				include 'code/managecareeroptions/manage_careeroptions.php';
			else if($_REQUEST['opt']=='mch')
				include 'code/managecareeroptions/manage_careerheaders.php';
			else if($_REQUEST['opt']=='mct')
				include 'code/managecareeroptions/manage_categorytype.php';
			else if($_REQUEST['opt']=='act')
				include 'code/managecareeroptions/add_categorytype.php';
				else if($_REQUEST['opt']=='moaf')
				include 'code/manageonlineform/manageonlineform.php';
				else if($_REQUEST['opt']=='moafdel')
				include 'code/manageonlineform/delfields.php';
			else if($_REQUEST['opt']=='ect')
				include 'code/managecareeroptions/edit_categorytype.php';
			else if($_REQUEST['opt']=='mcf')
				include 'code/manageotheroptions/manage_countryflags1.php';
			else if($_REQUEST['opt']=='mcfg')
				include 'code/manageotheroptions/manage_countryflags.php';
			else if($_REQUEST['opt']=='mchl')
				include 'code/manageotheroptions/manage_careerheaderlogos1.php';
			else if($_REQUEST['opt']=='mchlo')
				include 'code/manageotheroptions/manage_careerheaderlogos.php';
			else if($_REQUEST['opt']=='maul')
				include 'code/manageaboutuslinks/manage_aboutus.php';					
else if($_REQUEST['opt']=='pro_img')
	include 'code/manageusers/profileimage.php';
else
if($_REQUEST['opt']=='me')
 include 'code/manageexams/main_manage_exams.php';
else
if($_REQUEST['opt']=='aex')
include 'code/manageexams/manage_exams.php';
else
if($_REQUEST['opt']=='exs')
include 'code/manageexams/exams_success.php';
else
if($_REQUEST['opt']=='mtc')
 include 'code/manageexams/manage_testcentres.php';
else
if($_REQUEST['opt']=='atc')
 include 'code/manageexams/add_testcentre.php';
else
if($_REQUEST['opt']=='etc')
 include 'code/manageexams/edit_testcentre.php';
else
if($_REQUEST['opt']=='aeid')
  include 'code/manageexams/exam_importantdates.php';
else
if($_REQUEST['opt']=='ede')
  include 'code/manageexams/edit_exam.php';
else
if($_REQUEST['opt']=='eas')
include 'code/manageexams/manage_examassociatedskools.php';
else
if($_REQUEST['opt']=='sae')
include 'code/manageskools/manage_skoolassociatedexams.php';
else
if($_REQUEST['opt']=='mmop')
include 'code/manageotheroptions/main_manage_otheroptions.php';
else
if($_REQUEST['opt']=='mop')
include 'code/manageotheroptions/manage_otheroptions.php';
else if($_REQUEST['opt']=='menq')
	include "code/manageenquiry/main_manage_enquiry.php";
else if($_REQUEST['opt']=='senq')
	include "code/manageenquiry/show_enquiry.php";
else if($_REQUEST['opt']=='renq')
	include "code/manageenquiry/reply_enquiry.php";
else if($_REQUEST['opt']=='mmb')
	include "code/manageblogs/main_manage_blogs.php";
	else if($_REQUEST['opt']=='comm')
	include "code/manageblogs/main_manage_comments.php";
else if($_REQUEST['opt']=='mb')
	include "code/manageblogs/manage_blogs.php";
else if($_REQUEST['opt']=='edb')
	include "code/manageblogs/edit_blogs.php";
else if($_REQUEST['opt']=='mev')
  	include "code/manageevents/admin_search.php";
else if($_REQUEST['opt']=='ast')
	include "code/manageevents/admin_search_test.php";
else if($_REQUEST['opt']=='mmn')
	include "code/managenews/main_manage_news.php";
else if($_REQUEST['opt']=='mne')
	include "code/managenews/manage_news.php";
else if($_REQUEST['opt']=='ene')
	include "code/managenews/edit_news.php";
else
if($_REQUEST['opt']=='mp')
  include "code/managepolls/main_manage_polls.php";
else
if($_REQUEST['opt']=='mpa')
 include "code/managepolls/manage_polls.php";
else
if($_REQUEST['opt']=='ep')
	include "code/managepolls/edit_polls.php";
else if($_REQUEST['opt']=='mfs')
	include "code/managefeaturedskools/main_featured_skools.php";
else if($_REQUEST['opt']=='fs')
	include "code/managefeaturedskools/featured_skools.php";
else if($_REQUEST['opt']=='efs')
	include "code/managefeaturedskools/edit_featuredskool.php";
else if($_REQUEST['opt']=='chp')
	include "code/changepassword/change_password.php";
else if($_REQUEST['opt']=='aps')
	include "code/manageusers/prefferedskools.php";
else if($_REQUEST['opt']=='ape')
	include "code/manageusers/prefferedexams.php";
else
                 echo "<center><b><br><br><br><br><br><br><br><br><br><br><br><br><blink><font size='+3'>Welcome to admin section</font></blink></center></b>";
?>
</table>
	      <br class="clear"/>
        <br/><br/> 
			
			<!-- Begin one column box -->
		  <!-- End one column box --> 
		  <br class="clear"/>
		  <br/> 
			
			<!-- Begin one column box -->
		  <!-- End one column box --> 
</div>
<!-- End content --> 
		
		<br class="clear"/> 
			
		<?php include "footer.php";?>
	
	</div> 
	<!-- End control panel wrapper --> 

	
</body> 
</html>