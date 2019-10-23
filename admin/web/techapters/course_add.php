<?php 
@session_start();
ob_start();
include_once "../../../lib/db.php";
/*include_once "../../includes/course.class.php";
$course=New Course;*/
//include_once "../../../lib/calss_settings.php";
	include_once "../../../lib/class_exam_course.php";
	include_once "../../../lib/class_exam_chapters.php";
	include_once "../../../lib/class_exam_curriculum.php";
	include_once "../../../lib/class_exam_grades.php";
	include_once "../../../lib/class_exam_subject.php";
	include_once "../../../lib/ise_settings.class.php";
	$queries = new Queries();
	$objSql = new SqlClass();
	$settings = new ise_Settings();
	$exams_course = new exams_course();
	$exams_chapters = new exams_chapters();
	$exams_curriculum = new exams_curriculum();
	$exams_grades1 = new exams_grades();
	$exams_subject = new exams_subject();
	$exams_chapters = new exams_chapters();
	if(!empty($_POST))
	{
		$cid=$_REQUEST['cid'];
		$grade=$_REQUEST['grade'];
		
		$array=$exams_chapters->get_chapter_name_exist($grade,$_POST['title']);
		if(!is_array($array)){
		$na=basename($_FILES['cimage']['name']);
		if($na!=""){
		$image=$_FILES['cimage']['name']; $error = '0';$upload='';$extension='';
				define ("MAX_SIZE","50"); 
				
				$filename = stripslashes($_FILES['cimage']['name']);
				$extension = getExtension($filename);
				$extension = strtolower($extension);
				// Image Size
				$size=filesize($_FILES['cimage']['tmp_name']);
				if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
				{
					$_SESSION['valid_err'] = "<font size='2' color='#FF0000'>Upload Unknown File extension! Please Upload Onely png,gif,jpg,jpeg File</font>";
					$error='1';
				}else
				{
					$upload=time().".".$extension;
					$newname="../../../cimages/".$upload;
					$copied = copy($_FILES['cimage']['tmp_name'], $newname);
				}	
				
				}
				if($grade!="")
				$cid=$grade;
				 $tab = array("course_id =".$cid."","chapter_no =".$_POST['chno']."","chap_name =".$_POST['title']."", "subtopics=".$_POST['subtopics']."","chap_description=".$_POST['desc']."","chap_image=".$upload."","school_id=".$_SESSION['school_id']."");
				
				$insert = $exams_chapters->chapters_insert($tab);
				$_SESSION['msg']='<font color="#0099FF" size="2"><b>Chapter added Successfully</b></font>';
				print "<script>";
				print " self.location='index.php?cid=".$_POST['couid']."';";
				print "</script>"; 
				} else{
		$msg='Chapter name already exist';
		
}				
				}
	
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
<script language="javascript" src="../../../script/check.js"></script>
<script language="javascript">
function loadit()
{
//var curid=document.getElementById('curid').value;
var couid=document.getElementById('couid').value;
//alert(curid);
if(couid=="all")
location.href="manage_course_chapters.php";
else
location.href="manage_course_chapters.php?couid="+couid; 
}
		function check(){
	
		getForm("chapter_form");
		var school=document.getElementById('school').value;
		var c=document.getElementById('cur').value;
	
		var s=document.getElementById('sub').value;
		var g=document.getElementById('grade').value;
		var ch=document.getElementById('chno').value;
		if(school=="all")
		{
		alert("Select School");
		return false;
		}
		if(c=="all")
		{
		alert("Select Curriculum");
		return false;
		}
		
		if(s=="all" || s=="")
		{
		alert("Select Subject");
		return false;
		}
		if(g=="all")
		{
		alert("Select Grade");
		return false;
		}
		
		if(ch=="all")
		{
		alert("Select Chapter");
		return false;
		}
		
		
		if(!IsEmpty("chno","Please enter chapter"))return false;
		if(!IsEmpty("title","Please enter title"))return false;
		if(!IsEmpty("cimage","Upload Image"))return false;
		if(!IsNumber("subtopics","Please Enter no of subtopics"))return false;
		
	
	}

</script>
<script language="javascript" src="../../../js/addchap.js">
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
					<a href="<?php echo $admin_path;?>techapters/index.php"  class="active"> 
						Manage Chapters
					</a> 
				</li> 
				<li> 
					<a href="<?php echo $admin_path;?>techapters/course_add.php"> 
						Add Chapter
					</a> 
				</li> 
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/> <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
			
			
				
				<div class="content nomargin"> 
                <form name="chapter_form" action="" method="post" enctype="multipart/form-data" onsubmit="return check()">
			<table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="global">
										<tbody>
											
																					
                                            <tr>
												<td align="center" colspan="6"><h2>Add Chapter</h2></td>
											</tr>
											<tr>
												<td colspan="6">
													<form name="new_blog" action="" method="post" enctype="multipart/form-data" onsubmit="return check()">
													 <?php 
							
							  $cid=$_REQUEST['cid'];
							
							  if($cid!="")
							  {
							  $course = $exams_course->course_selectall("course_id",$cid);
							 /* echo '<pre>';
							  print_r($course);*/
								$chap = $exams_chapters->chapters_selectall("course_id",$cid);
							
							 $chapcount = $exams_chapters->chapters_count("course_id",$cid);
							  $cur = $exams_curriculum->curriculum_selectall("cur_id",$course["cur_id"]);
						
							  if($chapcount!=$course["num_of_chapters"])
							  {
							  ?>
                              <table  align="center" width="100%" border="1" cellpadding="0" cellspacing="0" class="tborder">
                                <tbody><tr valign="middle">
                                          <td width="51%" height="26" align="right" class="tr2"><font size="4" color="#ff0000"><b>
                                                          *</b></font>Grade Name</td>
                            <td width="49%" height="26" colspan="2" align="left" class="tr2">
										  <?php 
										  $grade = $exams_grades1->grades_selectall("grade_id",$course["grade_id"]);
											//echo '<pre>';
											//print_r($grade);
											echo $grade['grade_name'];
										   ?> <?php 
											//$s="select * from grades where gid=$res->grade;";
											//echo $s;
											//$q=mysql_fetch_object(mysql_query($s));
											//echo $q->grade;?><?php //echo $res->grade;?></td>
                                        </tr>      
                                        <tr valign="middle">
                                          <td class="tr2" align="right"><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Curriculum</label></td><td colspan="2" class="tr2" align="left" height="26">
                                           <?php echo $cur["cur_name"];?></td>
                                        </tr>  
                                        <tr valign="middle">
                                        <?php 
									$subject = $exams_subject->subject_select1($course['subject_id']);
									?>
                                          <td class="tr2" align="right"><label>Subject</label></td><td colspan="2" class="tr2" align="left" height="26">
                                          <select name="subno">
                                          <?php foreach($subject as $sub){?>
										  <option value="<?php echo $sub['sub_id']; ?>" <?php if($_REQUEST['subno']==$sub['sub_id']){ echo 'selected'; }?>><?php echo $sub['sub_name']; ?></option>
                                          <?php } ?>
                                          </select></td>
                                        </tr>                                  
<tr valign="middle">
                                          <td class="tr2" align="right"><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Chapter No</label></td><td colspan="2" class="tr2" align="left" height="26"><select name="chno">
                                           <?php 
										  $i=1;
										  while($i<=$course["num_of_chapters"])
										  {
												  $chap2 = $exams_chapters->chapters_selectl($cid,$i);
												  echo '<option value="'.$chap2[0]['chap_id '].'" ';
												  if($_REQUEST['chno']==$chap2[0]['chap_id ']){ echo 'selected'; }
												  echo '>'.$chap2[0]['chap_name'].'</option>';
										  		  $i++;
										  }
										  ?></select></td>
                                        </tr>
                                        <tr valign="middle">
                                          <td class="tr2" align="right" height="26"><font size="4" color="#ff0000"><b>
                                                          *</b></font>Title</td><td colspan="2" class="tr2" align="left" height="26"><input type="text" name='title'
                                          value="<?php if(!empty($_POST)){ echo $_REQUEST['title'];}?>"></td>
                                        </tr> <tr valign="middle">
                                          <td class="tr2" align="right" height="26"><font size="4" color="#ff0000"><b>
                                                          *</b></font>Image</td><td colspan="2" class="tr2" align="left" height="26"><input type="file" name='cimage'></td>
                                        </tr>
                                        <tr valign="middle">
                                          <td class="tr2" align="right" height="26"><font size="4" color="#ff0000"><b>
                                                          *</b></font>No of SubTopics</td><td colspan="2" class="tr2" align="left" height="26"><input type="text" name='subtopics' value="<?php if(!empty($_POST)){ echo $_REQUEST['subtopics'];}?>"></td>
                                        </tr>
                                        <tr valign="middle">
                                          <td class="tr2" align="right" height="26">Description</td><td colspan="2" class="tr2" align="left" height="26"><textarea name="desc">
                                          <?php if(!empty($_POST)){ echo $_REQUEST['desc'];}?>
                                          </textarea><!--<input type="text" name='desc'>--></td>
                                        </tr>
                                        <input type="hidden" value="<?php echo $cid;?>" name="cid" id='cid'/>
                                  <tr valign="top">
                                    <td colspan="4">
								
									
									
                                      <table width="100%" border="0" cellpadding="3" cellspacing="0">

                    
<tr valign="middle">
                                          <td colspan="5" class="pagesnum" align="center" height="26"><input type="submit" name='sub' value='Submit'></td>
                                        </tr>                  </table>
                                        
                                        
                                        
                                        </td>
                                </tr>
                                
                              </table><?php }
										else
										{
										echo "<center><table><tr><td><h1>All The Chapters Are Added</h1></td></tr></table></center>";}}
										else
										{
										
										$cur_1 = $exams_curriculum->curriculum_allname_select($_SESSION['school_id']);
										
										?>
                                        <table  align="center" width="100%" border="1" cellpadding="10" cellspacing="0" class="tborder">
                                <tbody>
                               
                                <tr><td colspan="3"><?php echo $msg; unset($msg); $msg='';?></td></tr>
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
                                          <td colspan="2" class="tr2" align="left" height="26"><div id='cur1'><select name='cur' onchange="javascript:call('10')" id='cur'><option value="all">--Select--</option>
										  </select></div></td>
                                        </tr> 
                                  <tr>
                                          <td class="tr2" align="right" height="26"><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Subject</label></td><td colspan="2" class="tr2" align="left" height="26"><input type="hidden"  name="subje" id='subje'/><div id="subject">
                                          <?php if($_REQUEST['sub']!=''){ ?>
                                          		<?php 
												$cid=$_REQUEST['cur'];
												 //echo "dasf".$cid;
												
												 $queries = new Queries();
												 $exams_course = new exams_course();
												 $exams_subject = new exams_subject();
												 $subs = $exams_course->course_distinctname_select($cid);
												 echo "<input type='hidden' id='cur' value=$cid>";
													//print_r($subs);
											echo "<select name='sub' onchange=".'"'."call('1')".'"'."id='sub'><option value='all'>--Select--</option>";
											if($cid!="")
											{
												foreach($subs as $s){
												$allsub = $exams_subject->subject_all_select($s[0]);
												foreach($allsub as $sa){
											
												echo "<option value='".$sa[sub_id]."' ";
												if($_REQUEST['sub']==$sa[sub_id]){
												echo ' selected';
												}
												echo ">$sa[sub_name]</option>";
											 }
											 }
											
											}
											echo "</select>";
											?>
                                          <?php } else{ ?>
                                          <select name='sub' id='sub'><option value="all">--Select--</option></select>
                                          <?php } ?>
                                          </div>
										  </td>
                                        </tr>  
                                        <tr>
                                          <td class="tr2" align="right" height="26"><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Grade Name</label></td><td colspan="2" class="tr2" align="left" height="26"><input type="hidden"  name="grad" id='grad'/> <div id='grade12'>
                                          <?php if($_REQUEST['grade']!=''){ 
										   $sid=$_REQUEST['sub'];
										 $cur= $_REQUEST['cur'];
										 $queries = new Queries();
										 $objSql = new SqlClass();
										 $exams_course = new exams_course();
										 $exams_grades = new exams_grades();
										 $subs = $exams_course->course_all_select1($sid,$cur);
										echo "<select name='grade' onchange=".'"'."call('2')".'"'."id='grade'><option value='all'>--Select--</option>";
									
										if($sid!="")
										{
											
											foreach($subs as $s){
											$a = $s['grade_id'];
											$c = $s['course_id'];
											$allgra = $exams_grades->grades_all_select($a);
											while($grade= $objSql->fetchRow($allgra)){
											
											echo "<option value='".$c."'";
											if($_REQUEST['grade']==$c){
												echo ' selected';
												}
											echo ">".$grade['grade_name']."</option>";
											//print_r($s['cid']);
										 }
										 }
										
										}
									
									echo "</select>";
										  ?>
                                          
                                          
                                          <?php } else{ ?>
                                          <select name='grade' id='grade'><option value="all">--Select--</option></select>
                                          <?php } ?>
                                          </div>
										  </td>
                                        </tr>      
                                                                        
<tr valign="middle">
                                          <td class="tr2" align="right" height="26"><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Chapter No</label></td><td colspan="2" class="tr2" align="left" height="26"><div id="chap">
                                          <?php if($_REQUEST['chno']!=''){?>
                                          <?php 
                                          	$courseid=$_REQUEST['grade'];

											 $queries = new Queries();
											 $objSql = new SqlClass();
											 $exams_chapters = new exams_chapters();
											 $exams_course = new exams_course();
											 $no_of_chap = $exams_course->course_select_by_column(num_of_chapters,course_id,$courseid);
											 $chapname = $exams_chapters->chapters_select_by_column(chapter_no,course_id,$courseid);
											 $count = $objSql->fetchRow($no_of_chap);
												$chap_count =$count["num_of_chapters"];
											
												//create an array
											$chp_array = range(1,$chap_count);
											if(is_array($chapname)){
											foreach($chapname as $c_number){
											//print_r($c_number);
											$chaps[] = $c_number[0];
											}
											}
													 if(is_array($chp_array)){
												 foreach($chp_array as $key =>$y){
												 if(is_array($chaps)){
												foreach($chaps as $key1 =>$k){
												if($y==$k)
												unset($chp_array[$key]);
												}
												}
												}
												}
											echo "<select name='chno' id='chno'><option value='all'>--Select--</option>";
											$i1='0';
											if($courseid!="")
											{
												foreach($chp_array as $name){
												$i1=$i1+1;
												
												echo "<option value='$name'";
												if($_REQUEST['chno']==$name){
												echo ' selected';
												}
												echo "> $name</option>";
												 }
												 if($i1=='0')
												 {
													echo "<option value=''>-Select Chapter Name-</option>";
												 }
											 
											}
										echo "</select>";
										  ?>
                                          <?php } else{?>
                                          <select name="chno" id="chno"><option value=''>--select--</option></select>
                                          <?php } ?>
                                          </div></td>
                                        </tr>
                                        <tr valign="middle">
                                          <td class="tr2" align="right" height="26"><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Title</label></td><td colspan="2" class="tr2" align="left" height="26"><input type="text" name='title' value="<?php echo $_REQUEST['title'];?>"></td>
                                        </tr>
                                        <tr valign="middle">
                                          <td class="tr2" align="right" height="26"><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Image</label></td><td colspan="2" class="tr2" align="left" height="26"><input type="file" name='cimage'></td>
                                        </tr>
                                        <tr valign="middle">
                                          <td class="tr2" align="right" height="26"><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>No of SubTopics</label></td>
                                          <td colspan="2" class="tr2" align="left" height="26"><input type="text" name='subtopics' value="<?php echo $_REQUEST['title'];?>"></td>
                                        </tr>
                                        <tr valign="middle">
                                          <td class="tr2" align="right" height="26"><label>Description</label></td><td colspan="2" class="tr2" align="left" height="26"><textarea name="desc"><?php echo $_REQUEST['desc'];?></textarea><!--<input type="text" name='desc'>--></td>
                                        </tr>
                                        <input type="hidden" value="<?php echo $cid;?>" name="cid" />
                                  <tr valign="top">
                                    <td width="99%" colspan="4">
								
									
									
                                      <table width="100%" border="0" cellpadding="3" cellspacing="0">

                    
<tr valign="middle">
                                          <td colspan="5" class="pagesnum" align="center" height="26"><input type="submit" name='sub12' value='Submit' class="button_light"></td>
                                        </tr>                  </table>
                                        
                                        
                                        
                                        </td>
                                  </tr>
                                
                              </table>
										
										<?php }
										?>
													</form>
												</td>
											</tr>
										</tbody>
									</table>
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
