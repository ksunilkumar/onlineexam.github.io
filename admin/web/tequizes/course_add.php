<?php 
@session_start();
ob_start();
if(!empty($_POST))
{

		include_once'../../../lib/db.php';
		include_once'../../../lib/class_exam_test.php';
		$exams_test = new exams_test();
		 $couid = $_REQUEST['cid'];
		 $grade = $_REQUEST['grade'];
		 $chap = $_REQUEST['chno'];
		 $chapid = $_REQUEST['id'];
		 $name = $_POST['testname'];
		 $time=$_REQUEST['time'];
		 $heading = $_POST['testheading'];
		
		
		if($grade!="" && $chap!="")
		{
		$couid=$grade;
		$chapid=$chap;
		}
		
		
		//echo "hi";
		$tab = array("course_id =".$couid."","chapter_id=".$chapid."","test_name=".$name."","test_heading=".$heading."","time=".$time."","school_id=".$_REQUEST['school']."");
		//print_r($tab);
		//exit;
		$v = $exams_test->test_insert($tab);
		$sql="insert into quiz values(null,$couid,$chapid,'$qfname','$qsname','$qid','$cost','$mpno','$topic')";
		echo $sql;
		print "<script>";
		if($grade!="")
		{
		print " self.location='index.php';";
		}
		else
		{
		$_SESSION['msg'] = "<font size='2' color='#0099FF'>Quiz Added  Successfully</font>";

		print " self.location='index.php?id=$chapid&cid=$couid';";
		}
		print "</script>"; 
		
		
}

?>
<?php 
include_once'../../../lib/db.php';
include_once'../../../lib/class_exam_course.php';
include_once'../../../lib/class_exam_chapters.php';
include_once'../../../lib/class_exam_curriculum.php';
$queries = new Queries();
$objSql = new SqlClass();
$exams_course = new exams_course();
$exams_chapters = new exams_chapters();
$exams_curriculum = new exams_curriculum();


$couid=$_REQUEST['cid'];
$chapid=$_REQUEST['id'];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
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
<script language="javascript" src="../../../js/check.js"></script>



<script language="javascript">
function chkform()
{

getForm("mform1");
		/*if(!IsEmpty_id("school","Please Select School"))return false;
		if(!IsEmpty_id("cur","Please Select Curriculum"))return false;*/
		var school=document.getElementById('school').value;
		var cur=document.getElementById('cur').value;
		var s=document.getElementById('sub').value;
		var g=document.getElementById('grade').value;
		var ch=document.getElementById('chno').value;
		if(school=="all")
		{
		alert("Select School");
		document.getElementById('school').focus();
		return false;
		}
		if(cur=="all")
		{
		alert("Select Curricullum");
		document.getElementById('cur').focus();
		return false;
		}
		if(s=="all")
		{
		alert("Select Subject");
		document.getElementById('sub').focus();
		return false;
		}
		if(g=="all")
		{
		alert("Select Grade");
		document.getElementById('grade').focus();
		return false;
		}
		
		if(ch=="all")
		{
		alert("Select Chapter");
		document.getElementById('chno').focus();
		return false;
		}
		/*if(!IsEmpty_id("sub","Please Select Curriculum"))return false;
		if(!IsEmpty_id("grade","Please Select Curriculum"))return false;
		if(!IsEmpty_id("chno","Please Select Curriculum"))return false;*/
		if(!IsEmpty("testname","Please Enter Test Name "))return false;
		if(!IsEmpty("testheading","Please Enter Test Heading"))return false;
		if(!IsNumber("time","Please Enter Test Time"))return false;
	
}

</script>

<!--<script language="javascript" src="../../../scripts/addchap.js">
</script>-->
<!--<script language="JavaScript" src="../../../scripts/costchap.js" type="text/javascript"></script>-->
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
					<a href="<?php echo $admin_path;?>tequizes/index.php"  > 
						Manage Quiz
					</a> 
				</li> 
				<li> 
					<a href="<?php echo $admin_path;?>tequizes/course_add.php" class="active"> 
						Add Quiz
					</a> 
				</li> 
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/>  <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
			
			
				
				<div class="content nomargin"> 
				<?php 
                if($couid!="" && $chapid!="")
                {include 'editq.php';
                }
                else
                include 'editqq.php';
                ?>
			
				    <?php //include_once '../pageNation.php';?>	
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
	
	<?php include_once '../footer.php';?>
</body>
</html>
