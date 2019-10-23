<?php
	session_start();
	include_once'../../../lib/db.php';
include_once'../../../lib/class_exam_course.php';
include_once'../../../lib/class_exam_chapters.php';
include_once'../../../lib/class_exam_curriculum.php';
include_once'../../../lib/class_exam_test.php';
$queries = new Queries();
$objSql = new SqlClass();
$exams_course = new exams_course();
$exams_chapters = new exams_chapters();
$exams_curriculum = new exams_curriculum();
$exams_test = new exams_test();


if(!empty($_POST))
	{
	include_once'../../../lib/class_exam_test.php';
	$exams_test = new exams_test();
	$testid = $_REQUEST['qid'];
	$couid = $_POST['cid'];
	$grade = $_POST['grade'];
	$chap = $_POST['chno'];
	$chapid = $_POST['id'];
	$name = $_POST['testname'];
	$time=$_REQUEST['time'];
	$heading = $_POST['testheading'];
 $tab = array("test_name=".$name."","test_heading=".$heading."","time=".$time."");
 $where = array("test_id =".$testid."");

 $testupdate = $exams_test->test_update($tab,$where);
$page=$_POST['page'];
$_SESSION['msg'] = "<font size='2' color='#0099FF'>Test Updated Successfully</font>";
		print "<script>"; 
print " self.location='index.php?id=$chapid&cid=$couid&pageNumber=".$_REQUEST['pageNumber']."&al=".$_REQUEST['al']."';";
	print "</script>"; 
	}
$qid=$_REQUEST['id'];
$t = $exams_test->test_select_one("test_id",$qid);
$test = $objSql->fetchRow($t);

$c = $exams_course->course_select("course_id",$test['course_id']);
$course = $objSql->fetchRow($c);

$ch = $exams_chapters->chapters_sel("chap_id",$test['chapter_id']);
$chapter =$objSql->fetchRow($ch);

$cur = $exams_curriculum->curriculum_name_select("cur_id",$course['cur_id']);
$curri = $objSql->fetchRow($cur);





	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title></title>
<link rel="stylesheet" href="../css/screen.css" type="text/css" media="all"/> 
<link href="../css/datepicker.css" rel="stylesheet" type="text/css" media="all"/> 
<link rel="stylesheet" href="../css/tipsy.css" type="text/css" media="all"/> 
<link rel="stylesheet" href="../js/jwysiwyg/jquery.wysiwyg.css" type="text/css" media="all"/> 
<link href="../js/visualize/visualize.css" rel="stylesheet" type="text/css" media="all"/> 
<link rel="stylesheet" type="text/css" href="../js/fancybox/jquery.fancybox-1.3.0.css" media="screen"/> 
 
<!--[if IE 7]>
	<link href="css/ie7.css" rel="stylesheet" type="text/css" media="all">
<![endif]--> 
 
<!--[if IE]>
	<script type="text/javascript" src="js/excanvas.js"></script>
<![endif]--> 
 
<!-- Jquery and plugins --> 
<script type="text/javascript" src="../js/jquery.js"></script> 
<script type="text/javascript" src="../js/jquery-ui.js"></script> 
<script type="text/javascript" src="../js/jquery.img.preload.js"></script> 
<script type="text/javascript" src="../js/fancybox/jquery.fancybox-1.3.0.js"></script> 
<script type="text/javascript" src="../js/jwysiwyg/jquery.wysiwyg.js"></script> 
<script type="text/javascript" src="../js/hint.js"></script> 
<script type="text/javascript" src="../js/visualize/jquery.visualize.js"></script> 
<script type="text/javascript" src="../js/jquery.tipsy.js"></script> 
<script type="text/javascript" src="../js/browser.js"></script> 
<script type="text/javascript" src="../js/custom.js"></script> 
<link href="../../../images/style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../../../script/calendar.js"></script>
<script language="javascript">
	var cal = new CalendarPopup();
	cal.showYearNavigation();
</script>
<script language="javascript" src="../../../script/check.js"></script>
<script language="javascript">
	var xmlhttp;
	function state_onchange(str)
	{
		xmlhttp=GetXmlHttpObject();
		if (xmlhttp==null)
		  {
			  alert ("Browser does not support HTTP Request");
			  return;
		  }
		var url="state_change.php";
		url=url+"?cou="+str;
		xmlhttp.onreadystatechange=stateChanged;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
	}
	function stateChanged()
	{
		if (xmlhttp.readyState==4)
		{
			document.getElementById("txtstate").innerHTML=xmlhttp.responseText;
		}
	}
	function GetXmlHttpObject()
	{
		if (window.XMLHttpRequest)
		{
		  return new XMLHttpRequest();
		}
		if (window.ActiveXObject)
		{
		  return new ActiveXObject("Microsoft.XMLHTTP");
	    }
		return null;
	}
	function check(){
		if(!confirm('Are you sure you want to modify the blog details?\n- to Modify the Blog, hit OK\n- otherwise, hit Cancel'))
		return false;
		getForm("new_blog");
		if(!IsEmpty("blog_title","Please Enter Blog Title"))return false;

		
	}
</script>
<script type="text/javascript" src="../../../script/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" language="javascript">
tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	elements : "elm1",
    theme_advanced_toolbar_location : "top",
	theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,forecolorpicker,backcolorpicker,bullist,numlist,link,unlink,blockquote,code",
	theme_advanced_buttons2 : "fontselect,fontsizeselect,formatselect,removeformat,forecolor,cleanup,backcolor",
	theme_advanced_buttons3 : ""
});
</script>
</head>
<body>
       <?php include_once"../header_one.php";?>
    <?php  include_once '../left.php'; ?>
    <br class="clear"/> 
		
		<!-- Begin content --> 
		<div id="content_wrapper" style="margin-right:30px;"> 
		
			<!-- Begin one column box --> 
		
			
			<!-- Begin 1st level tab --> 
			<ul class="first_level_tab"> 
			
				<li> 
					<a href="<?php echo $admin_path;?>tequizes/index.php"  class="active"> 
						Manage Quiz
					</a> 
				</li> 
				<li> 
					<a href="<?php echo $admin_path;?>tequizes/course_add.php"> 
						Add Quiz
					</a> 
				</li> 
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/>  <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
		
			
				
				<div class="content nomargin"  > 
		  <?php include "edit1q.php";?>
				    <?php //include '../pageNation.php';?>	
				<br class="clear"/>
				</div> 
				</div></div>
			
			<!-- End one column box --> 
			<br class="clear"/>
			
			<!-- Begin one column box -->
<!-- End one column box --> 
</div> 
</div> 
<!-- End content --> 
<br class="clear"/> 
	
	<?php include '../footer.php';?>
</body>
</html>
