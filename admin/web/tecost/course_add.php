<?php 
@session_start();
ob_start();

?>
<?php 
include_once'../../../lib/db.php';
include_once'../../../lib/class_exam_course.php';
include_once'../../../lib/class_exam_chapters.php';
include_once'../../../lib/class_exam_curriculum.php';
include_once"../../../lib/class_exam_grades.php";
include_once"../../../lib/class_exam_cost.php";
include_once"../../../lib/ise_Settings.class.php";
$queries = new Queries();
$objSql = new SqlClass();
$exams_course = new exams_course();
$exams_chapters = new exams_chapters();
$exams_curriculum = new exams_curriculum();
$settings = new ise_Settings();

if(!empty($_POST)){

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
$testid=$_REQUEST['quiz'];
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

$array = array("course_id =".$couid."","chapter_id=".$chapid."","test_id=".$testid."","cost=".$cost."","general_discount=".$gdis."","coupon=".$coupon."","discount=".$dis."","school_id=".$_REQUEST['school']."");
}else{

$array = array("course_id =".$couid."","chapter_id=".$chapid."","test_id=".$testid."","cost=".$cost."","general_discount=".$gdis."","discount=".$dis."","school_id=".$_REQUEST['school']."");
}
//echo $sql;
if($testid!=0)
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
}
 $cinsert = $exams_cost->cost_insert($array);
 if(is_array($where))
 $_SESSION['msg']='<font color="red" size="2">Cost Updated Sucessfully</font>';
 else
 $_SESSION['msg']='<font color="red" size="2">Cost Added Sucessfully</font>';
 $page=$_POST['page'];
print "<script>";
print " self.location='index.php';";
print "</script>";
exit;
}


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
 <?php if($opt=='quiz' || $opt=='')
{
echo "<script language='javascript' src='../../../js/costchap.js'></script>";
}
else if($opt=='chap')
echo "<script language='javascript' src='../../../js/costchap.js'></script>";
else
echo "<script language='javascript' src='../../../js/costchap.js'></script>";

?>
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
	function check(){
	
		getForm("cost_form");
		var school=document.getElementById('school').value;
		var c=document.getElementById('cur').value;
		var s=document.getElementById('sub').value;
		var g=document.getElementById('grade').value;
		var q=document.getElementById('topic').value;
		if(school=="all")
		{
		alert("Select School");
		document.getElementById('school').focus();
		return false;
		}
		
		if(c=="all")
		{
		alert("Select curricullum");
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
		if(!IsNumber("chno","Select chapter"))return false;
		if(q=="all")
		{
		alert("Select Quiz");
		document.getElementById('topic').focus();
		return false;
		}

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

</script>
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
/*	function check(){
		/*if(!confirm('Are you sure you want to add the blog?\n- to Add the Blog, hit OK\n- otherwise, hit Cancel'))
		return false;
		getForm("new_blog");
		if(!IsEmpty("blog_title","Please Enter Blog Title"))return false;

		
	}*/
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
					<a href="<?php echo $admin_path;?>tecost/index.php"  > 
						Manage Costs
					</a> 
				</li> 
				<li> 
					<a href="<?php echo $admin_path;?>tecost/course_add.php" class="active"> 
						Add Costs
					</a> 
				</li> 
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/> <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
			
			
				
				<div class="content nomargin"> 
                <form name="cost_form" action="" method="post" enctype="multipart/form-data" onsubmit="return check()">
               <table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="global">
										<tbody>
											
											<tr><td colspan="3"><?php // echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td></tr>
											
                                            <tr>
												<td align="center" colspan="6"><h2>Add Cost</h2></td>
											</tr>
                                            

											<tr>
												<td colspan="6">
<?php 
							   $cur = $exams_curriculum->curriculum_allname_select($_SESSION['school_id']);
										
										?>
                                        <table width="100%" border="1" cellpadding="10" cellspacing="0" >
                                <tbody><tr valign="middle">
                                <tr valign="middle">
                                          <td class="tr2" align="right" height="26" width="40%"><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>School</label></td>
                                          <td colspan="2" class="tr2" align="left" height="26">
                                          <select name='school' onchange="javascript:call('11')" id='school'>
                                          <option value="all">--Select--</option>
										  <?php 
										  $schools=$settings->get_school_all_names();
										  while($school_row = $objSql->fetchRow($schools))
										  {
										   ?>
                                           <option value='<?php echo $school_row['school_id'];?>'><?php echo $school_row['school_name'];?></option>
                                           <?php
										   }
										  ?>
                                          </select>
                                          </td>
                                </tr> 
                                <tr valign="middle">
                                          <td class="tr2" align="right" height="26" width="40%"><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Curriculum</label></td>
                                          <td colspan="2" class="tr2" align="left" height="26"><div id='cur1'><select name='cur' onchange="javascript:call('15')" id='cur'><option value="all">--Select--</option>
										  </select></div></td>
                                        </tr> 
<tr><td align="right"><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Subject</label></td><td><div id="subject"><select name='sub'  id='sub'><option value="">--Select--</option>
										  </select></div></td></tr>
<tr><td align="right"><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Grade</label></td><td><input type="hidden"  name="cid1" id='cid1'/><div id='grade12'>
<select name='grade' id='grade'><option value="all">--Select--</option></select></div></td></tr>
<tr><td align="right"><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Chapter</label></td><td><div id="chap">
<select id="chno" name="chno"><option value='all'>--select--</option></select></div></td></tr>
<tr>
                                       
                                         <?php if($opt!='cou')
                                        {   
                                              ?>                          
<!--<tr valign="middle">
                                         <td  align="right" height="26"><font size="4" color="#ff0000"><b>
                                                          *</b></font>Chapter</td><td colspan="2"  align="left" height="26"><div id="chap">
                                          <select id="chno" name="chno"><option value=''>--select--</option></select></div></td>
                                        </tr>-->
                                        <?php if($opt!='chap')
										{?>
                                        
                                                                                                                
<tr valign="middle">
                                          <td  align="right" height="26"><font size="4" color="#ff0000"><b>
                                                          *</b></font>Quiz</td><td colspan="2" align="left" height="26"><div id="quiz">
                                          <select id="topic" name="topic">
                                          <option value=''>--select--</option></select></div></td>
                                        </tr>
<?php }}?>

                                        <tr valign="middle">
                                          <td align="right" height="26"><font size="4" color="#ff0000"><b>
                                                          *</b></font>Cost</td><td colspan="2"  align="left" height="26"><?php if($opt=='quiz' || $opt==""){?><input type="text" name='cost' id='cost'><?php } else
										  {?><input type="text"  name='cost2' id='cost2' />
										  <input type='hidden' name='cost1' id='cost1' /><?php }?></td>
                                        </tr>
                                         <?php if($opt!='quiz' || $opt!="")
										{
										?>
                                           <tr valign="middle">
                                          <td  align="right" height="26">Discount</td><td colspan="2" align="left" height="26"><input type='text' name="gdis" id='gdis'? />&nbsp;&nbsp;%</td>
                                        </tr>
                                        <?php }?>
                                        <tr valign="middle"><td colspan="3"><a href="javascript:void()" onclick="javascript:document.getElementById('scup').value='1';document.getElementById('coupon').style.display='block';">Generate Coupon</a>
                                          <div id="coupon" style="display:none">
                                          <table width="100%" cellpadding="5">
                                          <tr><td width="50%">Coupon Number</td><td><?php $d=time();$d=md5($d);$e=substr($d,1,6);echo $e;?><input type="hidden" name='couponval' value='<?php echo $e;?>' />
                                          <input type="hidden" name='scup' value='0' id="scup"/></td></tr>
                                          <tr><td>Discount allowed on coupon</td><td><input type='text' name='dis'  value='0'/>&nbsp;&nbsp;%</td></tr></table></div></td>
                                          
                                        </tr>
                                        <input type="hidden" value="<?php echo $qid;?>" name="cid" />
                                        <input type="hidden" value="<?php echo $opt;?>" name="opt" />
                                   <tr valign="top">
                                    <td width="99%" colspan="4">
								
									
									
                                      <table width="100%" border="0" cellpadding="3" cellspacing="0">

                    
<tr valign="middle">
                                          <td colspan="5" class="pagesnum" align="center" height="26"><input type="submit" name='sub' value='Submit'></td>
                                        </tr>                  </table>
                                        
                                        
                                        
                                        </td>
                                  </tr>
                                
                              </table>
			</td></tr></table></form>
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
