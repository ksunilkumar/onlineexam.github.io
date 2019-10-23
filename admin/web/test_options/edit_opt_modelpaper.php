<?php session_start(); include "../../../lib/db.php";//include "secure.php";?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<style type="text/css">
<!--

-->
</style>
<link href="admin.css" rel="stylesheet" type="text/css" />
<link href="style_002.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="opt_que.js">
</script>
<script src="../script/check.js"></script>

</head>

<body>
<?php include"../header_one.php";?>
    <?php  include '../left.php'; ?>
    <div id="content_wrapper" style="margin-right:30px;"> 
		
			<!-- Begin one column box --> 
		
			
			<!-- Begin 1st level tab --> 
			<ul class="first_level_tab"> 
			<li> 
					<a href="<?php echo $admin_path;?>test_options/index.php" class="active"> 
						Manage Optional ModelPapers
					</a> 
				</li> 
				<li> 
					<a href="<?php echo $admin_path;?>test_options/add_op_questions.php"> 
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
 include_once'../../../lib/class_exam_modelpapers.php';
 include "../../../lib/class_exam_grades.php";
 include "../../../lib/class_exam_subject.php";
 $queries = new Queries();
 $objSql = new SqlClass();
 $exams_curriculum = new exams_curriculum();
 $exams_course = new exams_course();
 $exams_chapters = new exams_chapters();
 $exams_subject = new exams_subject();
 $exams_grades = new exams_grades();									
 $exams_modelpapers = new exams_modelpapers();
 $num = $_GET["id"];
	if(!empty($_POST))
	{
	 $seca=$_REQUEST['seca'];
	 $secb=$_REQUEST['secb'];
	 $secc=$_REQUEST['secc'];
	  $secd=$_REQUEST['secd'];
	 $amarks=$_REQUEST['amarks'];
	 $bmarks=$_REQUEST['bmarks'];
	 $cmarks=$_REQUEST['cmarks'];
	  $dmarks=$_REQUEST['dmarks'];
	 $exams_modelpapers = new exams_modelpapers();
	 $tab = array("section_a=".$seca."","amarks=".$amarks."","section_b=".$secb."","bmarks=".$bmarks."","section_c =".$secc."","cmarks=".$cmarks."","section_d =".$secd."","dmarks=".$dmarks."");
	//print_r($tab);
	 $where =array("num=".$num."");
	 $exams_modelpapers->modelpapers_update($tab,$where);
	 
	$page=$_REQUEST['page']; 
	 $_SESSION['msg'] = "<font size='2' color='#FF0000'>Optional Model Paper  is updated successfully</font>";
	 print " <script>  self.location='manage_opt_modelpaper.php?opt=1&page=".$page."';</script>";
	}
?>
<?php 
$opt=$_REQUEST['opt'];
?><head>
<script language="javascript">
	function check(){
		getForm("modelpapers_form");
		
		
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
<input type="hidden" name="page" value="<?php echo $_GET['page'];?>"  />
<table width="100%"  cellpadding="0" cellspacing="0" class="global">
<input type="hidden" name="id" value="<? echo $num; ?>"><tr><td  valign="top"><table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
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
							  //echo $cid=$_REQUEST['id'];
						
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
                                          <td class="tr2" align="right" ><label>Curriculum</label></td><td colspan="2" class="tr2" align="left" >
										  <?php
										
										$opt_que = $exams_modelpapers->modelpapers_select_rows(num,$num);
										
										while($row=$objSql->fetchRow($opt_que))
										{ 
										$curname = $exams_curriculum->curriculum_name_select(cur_id,$row["cur_num"]);
										$cname =$objSql->fetchRow($curname);
										$sub = $exams_subject->subject_all_select($row["subject_num"]);
										$sname=$objSql->fetchRow($sub);
										$grename= $exams_grades->grades_all_select($row["grade_num"]);
										$gname = $objSql->fetchRow($grename);
																		
										  ?><?=$cname["cur_name"]?>	</div></td>
                                        </tr>  
										<tr>
                                          <td class="tr2" align="right"><label>Subject</label></td>
                                          <td colspan="2" class="tr2" align="left" >	<?=$sname["sub_name"]?>  </td>
                                        </tr> 
                                           <tr>
                                          <td class="tr2" align="right"><label>Grade Name</label></td>
                                          <td colspan="2" class="tr2" align="left" height="26"><?=$gname["grade_name"]?> </td>
                                        </tr>      
                                          <tr valign="middle">
                                          <td class="tr2" align="right"><label>Section A</label></td>
                                          <td colspan="2" class="tr2" align="left"><input type="text" name ="seca" value="<?=$row["section_a"]?>"  /></td>
                                        </tr>
                                        <tr valign="middle">
                                          <td class="tr2" align="right"><label>Marks for Section A </label></td>
                                          <td colspan="2" class="tr2" align="left" ><input type="text" name="amarks" value ="<?=$row["amarks"]?>" >
                                        </td>
                                        </tr>
                                      <tr valign="middle">
                                          <td class="tr2" align="right"><label>Section B</label> </td>
                                          <td colspan="2" class="tr2" align="left" height="26"><input type="text" name ="secb" value="<?=$row["section_b"]?> " /></td>
                                        </tr>
                                        <tr valign="middle">
                                          <td class="tr2" align="right"><label>Marks for Section B </label></td>
                                          <td colspan="2" class="tr2" align="left"><input type="text" name="bmarks" value ="<?=$row["bmarks"]?>" >
                                        </td>
                                        </tr>
                                        <tr valign="middle">
                                          <td class="tr2" align="right"><label>Section C </label></td>
                                          <td colspan="2" class="tr2" align="left"><input type="text" name ="secc" value="<?=$row["section_c"]?> "/>   </td>
                                        </tr>
                                        <tr valign="middle">
                                          <td class="tr2" align="right"><label>Marks for Section C </label></td>
                                          <td colspan="2" class="tr2" align="left" height="26"><input type="text" name="cmarks" value ="<?=$row["cmarks"]?>" >
                                        </td>
                                        </tr>
                                        <tr valign="middle">
                                          <td class="tr2" align="right" ><label>Section D </label></td>
                                          <td colspan="2" class="tr2" align="left" height="26"><input type="text" name ="secd" value="<?=$row["section_d"]?> "/>   </td>
                                        </tr>
                                        <tr valign="middle">
                                          <td class="tr2" align="right" ><label>Marks for Section D</label> </td>
                                          <td colspan="2" class="tr2" align="left" height="26"><input type="text" name="dmarks" value ="<?=$row["dmarks"]?>" >
                                        </td>
                                        </tr>
                                      <tr valign="top">
                                    <td width="99%" colspan="4">
								
						<?php } ?>
									
                                      <table width="100%" border="0" cellpadding="3" cellspacing="0">

                    
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

