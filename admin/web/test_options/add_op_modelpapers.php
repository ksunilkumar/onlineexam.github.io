<?php session_start(); include "../../../lib/db.php";//include "secure.php";?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<style type="text/css">

</style>
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
<style type="text/css">
<!--

-->
</style>
<link href="admin.css" rel="stylesheet" type="text/css" />
<link href="style_002.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../../../js/opt_que.js">
</script>
<script language="javascript" src="../script/check.js"></script>
<script src="../script/check.js"></script>

</head>

<body>
<body>
 <?php include"../header_one.php";?>
    <?php  include '../left.php'; ?>
    <div id="content_wrapper" style="margin-right:30px;"> 
		
			<!-- Begin one column box --> 
		
			
			<!-- Begin 1st level tab --> 
			<ul class="first_level_tab"> 
			<li> 
					<a href="<?php echo $admin_path;?>test_options/manage_opt_modelpaper.php" > 
						Manage Optional ModelPapers
					</a> 
				</li> 
				<li> 
					<a href="<?php echo $admin_path;?>test_options/add_op_modelpapers.php" class="active"> 
						Add Optional ModelPapers
					</a> 
				</li>
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/> <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 
            
			<div style="border:1px solid #ccc;"  > 
				
							
				<div class="content nomargin"  > 
             <?php 
 include_once'../../../lib/db.php';
 include_once'../../../lib/class_exam_curriculum.php';
 include_once'../../../lib/class_exam_course.php';
 include_once'../../../lib/class_exam_chapters.php';
 include_once'../../../lib/class_exam_curriculum.php';
 include_once'../../../lib/ise_Settings.class.php';
 $queries = new Queries();
 $objSql = new SqlClass();
 $exams_curriculum = new exams_curriculum();
 $exams_course = new exams_course();
 $exams_chapters = new exams_chapters();
 $settings = new ise_Settings();
if(!empty($_POST))
{
 include_once'../../../lib/db.php';
 include_once'../../../lib/class_exam_modelpapers.php';
 $curid=$_REQUEST['cur'];
 $sub=$_REQUEST['sub'];
 $grade1=$_REQUEST['grade'];
 $seca=$_REQUEST['seca'];
 $secb=$_REQUEST['secb'];
 $secc=$_REQUEST['secc'];
 $secd=$_REQUEST['secd'];
  $amarks=$_REQUEST['amarks'];
 $bmarks=$_REQUEST['bmarks'];
 $cmarks=$_REQUEST['cmarks'];
  $dmarks=$_REQUEST['dmarks'];
$exams_modelpapers = new exams_modelpapers();

$tab = array("cur_num =". $curid."", "subject_num =".$sub."", "grade_num =".$grade1."","section_a =".$seca."","amarks =".$amarks."","section_b =".$secb."","bmarks =".$bmarks."","section_c =".$secc."","cmarks =".$cmarks."","section_d =".$secd."","dmarks =".$dmarks."","school_id=".$_REQUEST['school']."");
//print_r($tab);
$exams_modelpapers->modelpapers_insert($tab);
$_SESSION['msg'] = "<font size='2' color='#FF0000'>Optional Model Paper  is added successfully</font>";
print " <script>  self.location='manage_opt_modelpaper.php?opt=1';</script>";
	
	}

?>
<?php 
$opt=$_REQUEST['opt'];
?><head>
<script language="javascript">
	function check(){
		getForm("modelpapers_form");
		
		//if(!IsEmpty_id("cur","Please sellect curricullum"))return false;
		var c=document.getElementById('cur').value;
		var s=document.getElementById('sub').value;
		var g=document.getElementById('grade').value;

		if(c=="all")
		{
		alert("Select curricullum");
		return false;
		}

		if(s=="all")
		{
		alert("Select Subject");
		return false;
		}
		if(g=="all")
		{
		alert("Select Grade");
		return false;
		}
		
		
		if(!IsEmpty("seca","Enter sectionA  name"))return false;
		if(!IsNumber("amarks","Enter sectionA  marks"))return false;
		
		if(!IsEmpty("secb","Enter sectionB  name"))return false;
		if(!IsNumber("bmarks","Enter sectionB  marks"))return false;
		
		if(!IsEmpty("secc","Enter sectionC  name"))return false;
		if(!IsNumber("cmarks","Enter sectionC  marks"))return false;
		
		if(!IsEmpty("secd","Enter sectionD  name"))return false;
		if(!IsNumber("dmarks","Enter sectionD  marks"))return false;
		

	}
</script>
</head>



<form name="modelpapers_form"  method="post" enctype="multipart/form-data" onsubmit="return check()">
<table width="100%" cellpadding="0" cellspacing="0" class="global"><tr><td  valign="top" height="400"><table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td><table width="100%" align="left" border="0" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                      <td align="left"><table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
                          <tbody><tr>
                            <td><table summary="Buttons" width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tbody>
                                 
                                  <tr>
                                    <td colspan="2" class="h2" height="30"><span class="ph"><strong>Manage Modelpapers</strong></span></td>
                                  </tr>
                                  
                                </tbody>
                              </table>
                              <?php 
							  $cid=$_REQUEST['cid'];
						
							  if($cid!="")
							  {
							   
							   
							   $cour = $exams_course->course_selectall(course_id,$cid);
							
							   $chap = $exams_chapters->chapters_selectall(course_id,$cid);
							  
								$size = sizeof($chap);
								$rows = $exams_curriculum->curriculum_selectall(cur_id,$cour['curriculum']);
							
							  if($size!=$cour['no_chapters'])
							  {
							   ?>
                              <?php
							  }
										
										}
										else
										{
										$allcurri = $exams_curriculum->curriculum_allname_select($_SESSION['school_id']);
										
										?>
                                
                              <table width="100%" border="1" cellpadding="10" cellspacing="0">
                                <tbody>
                                 <?php if($_REQUEST['opt']==1)
								{
								echo "<tr valign='middle'><td colspan='3' align='center'><h2>Uploaded sucessfully</h2></td></tr>";
								}
								else if($_REQUEST['opt']==2)
								{
								echo "<tr valign='middle'><td colspan='3' align='center'><h2>File Not Uploaded</h2></td></tr>";
								}
								else if($_REQUEST['opt']=='al')
								{
								echo "<tr valign='middle'><td colspan='3' align='center'><h2>THIS  WAS ALREADY UPDATED</h2></td></tr>";
								}?>
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
                                                                        
<tr valign="middle">   
                                                                    
								<tr valign="middle"> <td class="tr2" align="right" ><label>Section A</label></td>
                                          <td colspan="2" class="tr2" align="left" height="26"><input type="text" name="seca" value ="" >Please enter values 0 or above 2 .for more than 2 opts use ',' separator </td>
                                        </tr>
                                         <tr valign="middle">
                                          <td class="tr2" align="right"><label> Marks for Section A  </label></td>
                                          <td colspan="2" class="tr2" align="left" height="26"><input type="text" name="amarks" value ="" >
                                     
                                        </td>
                                        </tr>
                                      <tr valign="middle">
                                          <td class="tr2" align="right" ><label>Section B </label></td>
                                          <td colspan="2" class="tr2" align="left" height="26"><input type="text" name="secb" value ="" >
                                               Please enter values 0 or above 2 .for more than 2 opts use ',' separator 
                                        </td>
                                        </tr>
                                         <tr valign="middle">
                                          <td class="tr2" align="right"><label>Marks for Section B</label> </td>
                                          <td colspan="2" class="tr2" align="left" height="26"><input type="text" name="bmarks" value ="" >
                                          
                                        </td>
                                        </tr>
                                        <tr valign="middle">
                                          <td class="tr2" align="right"><label>Section C</label> </td>
                                          <td colspan="2" class="tr2" align="left" height="26"><input type="text" name="secc" value ="" >
                                               Please enter values 0 or above 2 .for more than 2 opts use ',' separator 
                                        </td>
                                        </tr>
                                         <tr valign="middle">
                                          <td class="tr2" align="right"><label>Marks for Section C</label> </td>
                                          <td colspan="2" class="tr2" align="left" height="26"><input type="text" name="cmarks" value ="" >
                                        </td>
                                        </tr>
                                        <tr valign="middle">
                                          <td class="tr2" align="right"><label>Section D </label></td>
                                          <td colspan="2" class="tr2" align="left" height="26"><input type="text" name="secd" value ="" >
                                               Please enter values 0 or above 2 .for more than 2 opts use ',' separator 
                                        </td>
                                        </tr>
                                         <tr valign="middle">
                                          <td class="tr2" align="right"><label>Marks for Section D </label></td>
                                          <td colspan="2" class="tr2" align="left" height="26"><input type="text" name="dmarks" value ="" >
                                        </td>
                                        </tr>
                                    
                                        <input type="hidden" value="<?php echo $cid;?>" name="cid" />
                                  <tr valign="top">
                                    <td width="99%" colspan="4">
								
						
									
                                      <table width="100%" border="0" cellpadding="0" cellspacing="0">

                    
<tr valign="middle">
                                          <td colspan="5" class="pagesnum" align="center" height="26"><input type="submit" name='submit' value='Submit' class="button_light"></td>
                                        </tr>                  </table>
                                        
                                        
                                        
                                        </td>
                                  </tr>
                                
                              </table>
                              <?php }
							?></td>
                          </tr>
                        </tbody></table></td>
                    </tr>
                  </tbody></table></td>
              </tr>
            </tbody></table></td></tr></table></form>
                    
     	</div> 
				</div></div>
			
			<!-- End one column box --> 
			<br class="clear"/>
			

<br class="clear"/> 
	
	<?php include '../footer.php';?>
</body>
</html>
    
