<?php
	session_start();
	if(!empty($_POST))
	{	
		
		include "../../../lib/db.php";
		include "../../../lib/class_exam_grades.php";
		include "../../../lib/class_exam_chapters.php";
		include "../../../lib/class_exam_cost.php";
		$queries = new Queries();
		$objSql = new SqlClass();
		$exams_grades = new exams_grades();
		$exams_cost = new exams_cost();
		
		$couid=$_REQUEST['grade'];
		$chapid=$_REQUEST['chno'];
		if($chapid=='all')
		{
		$chapid=0;
		}
		$testid=$_REQUEST['quizid'];
		if($testid=="")
		$testid=0;
		$cost=$_REQUEST['cost'];
		$coupon=$_REQUEST['couponval'];
		$dis=$_REQUEST['dis'];
		$scup=$_REQUEST['scup'];
		$opt=$_REQUEST['opt'];
		$gdis=$_REQUEST['gdis'];
		$cost1=$_REQUEST['cost1'];
		$cost2=$_REQUEST['cost2'];
		if($opt=='cou' || $opt=='chap')
		{
		//$cost=$cost1;
		$cost=$cost2;
		}
		if($gdis=="")
		$gdis=0;
		if($chapid=="")
		$chapid=0;
		$od=($cost*$gdis)/100;
		$cs=$cost-$od;
		if($scup==1){
		
		$array = array("cost=".$cost."","general_discount=".$gdis."","coupon=".$coupon."","discount=".$dis."");
		}else{
		
		$array = array("cost=".$cost."","general_discount=".$gdis."","discount=".$dis."");
		}
		
		//echo $sql;
		/*if($testid!=0)
		{
		$costs = $exams_cost->cost_test5($couid,$chapid,0);
		
		if($costs){
		$costcount = $exams_cost->cost_num_of_records($couid,$chapid,0);
		
		if($costcount>0){
		$cost12 = $exams_cost->cost_test5($couid,0,0);
		
		$c2 = $exams_cost->cost_test5($couid,$chapid,0);
		$cost2=$objSql->fetchRow($c2);
		
		while($r1=$objSql->fetchRow($cost12))
		{
		
		$inc=$cs-(($cs*$cost2['general_discount'])/100);
		$ci=$r1['cost']+$inc;
		$tab = array("cost=".$ci."");
		$where = array("course_id =".$couid."","chapter_id=0","test_id=0");
		 $cupdate2 = $exams_cost->cost_update($tab,$where);
		
		
		}
		$c3 = $exams_cost->cost_test5($couid,$chapid,0);
		
		$q1=mysql_query($s1);
		while($cost3=$objSql->fetchRow($c3))
		{
		
		$ci=$cost3['cost']+$cs;
		$tab = array("cost=".$ci."");
		$where =  array("course_id =".$couid."","chapter_id=".$chapid."","test_id=0");
		 $cupdate = $exams_cost->cost_update($tab,$where);
		
		}
		}
		}
		}
		else if($chapid!=0)
		{
		$c4= $exams_cost->cost_test5($couid,0,0);
		
		if($c4){
		$costcount1 = $exams_cost->cost_num_of_records($couid,0,0);
		if($costcount1>0){
		$cost4 = $exams_cost->cost_test5($couid,0,0);
		
		while($c1=$objSql->fetchRow($cost4))
		{
		
		$ci=$c1['cost']+$cs;
		$tab = array("cost=".$ci."");
		$where = array("course_id =".$couid."","chapter_id=0","test_id=0");
		 $cupdate1 = $exams_cost->cost_update($tab,$where);
		
		}
		}
		}
		}*/
		$where=array("cost_id=".$_REQUEST['cid'],"school_id=".$_SESSION['school_id']);

		 
					 $cinsert = $exams_cost->cost_update($array,$where);
		 if(is_array($where))
		 $_SESSION['msg']='<font color="red" size="2">Cost Updated Sucessfully</font>';
		 else
		 $_SESSION['msg']='<font color="red" size="2">Cost Added Sucessfully</font>';
		
		print "<script>";
		print " self.location='index.php?opt=$opt&pageNumber=".$_REQUEST['pageNumber']."&id=".$_REQUEST['iiiid']."&cid=".$_REQUEST['cccid']."';";
		print "</script>";
		exit;
	
	
	
	
	}
include_once "../../../lib/db.php";
include "../../../lib/class_exam_grades.php";
include "../../../lib/class_exam_chapters.php";
include "../../../lib/class_exam_cost.php";
include "../../../lib/class_exam_test.php";
include "../../../lib/class_exam_course.php";
include "../../../lib/class_exam_curriculum.php";
$queries = new Queries();
$objSql = new SqlClass();
$exams_grades = new exams_grades();
$exams_cost = new exams_cost();
$exams_test = new exams_test();
$exams_course = new exams_course();
$exams_curriculum =new exams_curriculum();
$exams_chapters = new exams_chapters();
$opt=$_REQUEST['opt'];
 $costid=$_REQUEST['id'];
$cost = $exams_cost->cost_select("cost_id",$costid);
$cost1 =$objSql->fetchRow($cost);

$course = $exams_course->course_select("course_id",$cost1['course_id']);
$course1 = $objSql->fetchRow($course);

$grade = $exams_grades->grades_all_select($course1['grade_id']);
$grade1 = $objSql->fetchRow($grade);

$cur = $exams_curriculum->curriculum_name_select(cur_id,$course1['cur_id']);
$cur1 =$objSql->fetchRow($cur);

$chap = $exams_chapters->chapters_sel(chap_id,$cost1['chapter_id'],$_SESSION['school_id']);
$chap1 = $objSql->fetchRow($chap);

$test = $exams_test->test_select_name(test_id,$cost1['test_id'],$_SESSION['school_id']);
$test1 = $objSql->fetchRow($test);

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
<script language="javascript">
	function check(){
		getForm("cost_form");
		

		if(!IsNumber("cost","Enter Cost"))return false;
		if(!IsNumber("gdis","Enter Discount"))return false;
		var dis=document.getElementById('gdis').value;
		if(dis>100)
		{
		alert("Enter Valid Discount");
		return false;
		}
		
	}
</script>
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
		if(!confirm('Are you sure you want to modify the Cost details?\n- to Modify the Cost, hit OK\n- otherwise, hit Cancel'))
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
					<a href="<?php echo $admin_path;?>tecost/index.php"  class="active"> 
						Manage Costs
					</a> 
				</li> 
				<li> 
					<a href="<?php echo $admin_path;?>tecost/course_add.php"> 
						Add Costs
					</a> 
				</li> 
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/> <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
		
			
				
				<div class="content nomargin"  > 
		  <table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="global">
										<tbody>
											
											<tr><td colspan="3"><?php // echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td></tr>
											
                                            <tr>
												<td align="center" colspan="6"><h2>Edit Cost</h2></td>
											</tr>
											<tr>
												<td colspan="6">
 <form name="cost_form" action="" method="post" enctype="multipart/form-data" onsubmit="return check()">
	
    <input type="hidden" name="pageNumber" id="pageNumber" value="<?php echo $_REQUEST['pageNumber'];?>" />
<input type="hidden" name="al" id="al" value="<?php echo $_REQUEST['al'];?>" />
   <?php 	  $id1122=$_GET['chapid']; $cid1122=$_GET['cid'];?>
                                            <input type="hidden" value='<?php echo $id1122;?>' name="iiiid" />
                                          <input type="hidden" value='<?php echo $cid1122;?>' name="cccid" />
	
 
 <table width="100%"><tr><td style="padding-left: 16px;" valign="top" height="400"><table width="90%" align="center" border="0" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td><table width="100%" align="left" border="0" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                      <td align="left"><table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
                          <tbody><tr>
                            <td>
                                        <table width="100%" border="1" cellpadding="10" cellspacing="0">
                                <tbody><tr valign="middle">
                                <tr valign="middle">
                                          <td class="tr2" height="26" align="right" width="50%"><label>Curriculum</label></td><td colspan="2" class="tr2" align="left" height="26"><?php echo $cur1['cur_name'];?></div></td>				
                                        
                                        </tr>  
                                          <td class="tr2" height="26" align="right"><label>Grade Name</label></td><td colspan="2" class="tr2" align="left" height="26"><?php echo $grade1['grade_name'];?><input type="hidden" value='<?php echo $cost1['course_id'];?>' name="couid" />
                                          <input type="hidden" value='<?php echo $cost1['chapter_id'];?>' name="chapid" />
                                          <input type="hidden" value='<?php echo $cost1['test_id'];?>' name="quizid" />
										  </td>
                                        </tr> 
                                       
                                        <?php if($opt!='cou')
                                        {   
                                              ?>                          
<tr valign="middle">
                                          <td class="tr2" align="right" height="26"><label>Chapter</label></td><td colspan="2" class="tr2" align="left" height="26"><?php echo $chap1['chap_name'];?></td>
                                        </tr>
                                                                             
                                                <?php 
												if($opt!='chap') {?>
<tr valign="middle">
                                          <td class="tr2" align="right" height="26"><label>Quiz</label></td><td colspan="2" class="tr2" align="left" height="26"><?php echo $test1['test_name'];?></td>
                                        </tr>
<?php }}?>

                                        <tr valign="middle">
                                          <td class="tr2" align="right" height="26"><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Cost</label></td><td colspan="2" class="tr2" align="left" height="26"><?php if($opt=='quiz'){?><input type="text" value="<?php echo$cost1['cost'];?>" name="cost" /><?php } else {?>
                                          <?php echo $cost1['cost'];?><input type="hidden" value="<?php echo $cost1['cost'];?>" name="cost" /><?php }?>
                                           <tr valign="middle">
                                          <td class="tr2" align="right" height="26"><label>Discount</label></td><td colspan="2" class="tr2" align="left" height="26"><input type='text' name="gdis" id='gdis'?  value="<?php echo $cost1['general_discount'];?>">&nbsp;&nbsp;%</td>
                                        </tr>
                                        
                                        <tr valign="middle"><td colspan="3" class="tr2">
                                        
                                        <!--<a href="javascript:void()" onclick="javascript:document.getElementById('scup').value='1';document.getElementById('coupon').style.display='block';">Generate Coupon</a>-->
                                        
                                          <div id="coupon" style="display:block">
                                          <table width="100%" cellpadding="5">
                                          <tr><td width="50%" align="right"><label>Coupon Number</label></td><td>
										  <?php $d=time();$d=md5($d);$e=substr($d,1,6);?>
                                          <input type="text" name='couponval' value='<?php echo $cost1['coupon'];?>' />
                                          <input type="hidden" name='scup' value='1' id="scup"/></td></tr>
                                          <tr><td align="right"><label>Discount allowed on coupon</label></td><td><input type='text' name='dis'  value='<?php echo $cost1['discount'];?>'/>&nbsp;&nbsp;%</td></tr></table></div></td>
                                          
                                        </tr>
                                        <input type="hidden" value="<?php echo $costid;?>" name="cid" />
                                        <input type="hidden" value="<?php echo $opt;?>" name="opt" />
                                   <tr valign="top">
                                    <td width="99%" colspan="4">
								
									<!--<table class="borderlistings" summary="List of threads" width="100%" cellpadding="3" cellspacing="0" border="1">
                                        <thead>
                                          <tr>
										    <td class="listingheadings" width="20%" align="center" height="35">PackageName<a href="#" title="Ascending"><img src="images/up.gif" alt="Ascending" title="Ascending" border="0"></a></td>
                                            <td class="listingheadings" width="19%" align="center">Package Cost<a href="#" title="Ascending"> <img src="images/up.gif" alt="Ascending" title="Ascending" border="0"></a></td>
                                            <td class="listingheadings" width="21%" align="center"><strong>QIDS<a href="#" title="Ascending"><img src="images/up.gif" alt="Ascending" title="Ascending" border="0"></a></strong></td>
                                            
                                          </tr>
                                        </thead><tbody>
                                        
									   
                                        </tbody>
                                      </table>-->
									
                                      <table width="100%" border="0" cellpadding="3" cellspacing="0">

                    
<tr valign="middle">
                                          <td colspan="5" class="pagesnum" align="center" height="26"><input type="submit" name='sub' value='Submit'></td>
                                        </tr>                  </table>
                                        
                                        
                                        
                                        </td>
                                  </tr>
                                
                              </table>
										
										<?php
										?></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td></tr></table></form></td></tr></table>
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
