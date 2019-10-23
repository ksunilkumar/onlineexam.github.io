<?php session_start();

include_once'../../../lib/db.php';

include_once'../../../lib/ise_settings.class.php';
$settings=new ise_Settings();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 
<!-- Meta data for SEO --> 
<meta name="description" content=""/> 
<meta name="keywords" content=""/> 
 
<!-- Template stylesheet --> 
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
<style type="text/css">
<!--

-->
</style>
<link href="admin.css" rel="stylesheet" type="text/css" />
<link href="style_002.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../../../script/check.js"></script>
<script language="javascript" src=""></script>
<script language="javascript">
	function check()
	{
		getForm("ff");
		if(!IsEmpty("cur","Plese Select Curriculum"))return false;
		if(!IsEmpty("sub","Plese Select Subject"))return false;
		if(!IsEmpty("uple","Plese Upload html file"))return false;
		
	}
</script>
</head>

<body>
<?php include"../header_one.php";?>
    <?php  include '../left.php'; ?>
    
		<br class="clear"/> 
		
		<!-- Begin content --> 
		<div id="content_wrapper" style="margin-right:30px;"> 
		
			<!-- Begin one column box --> 
		
			
			<!-- Begin 1st level tab --> 
			<ul class="first_level_tab"> 
				<li> 
					<a href="<?php echo $admin_path;?>testengine/manage_uploads.php" class="active"> 
						Manage Bulk Uploads
					</a> 
				</li>
				<!--<li> 
					<a href="<?php echo $admin_path;?>clients/new.php"> 
						 Add Clients
					</a> 
				</li> -->
				
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
					 $queries = new Queries();
					 $objSql = new SqlClass();
					 $exams_curriculum = new exams_curriculum();
					 $exams_course = new exams_course();
					 $exams_chapters = new exams_chapters();
					
					
					?>

<script language="javascript" src="../../../js/costchap.js">
</script><form name="ff" action="info.php" method="post" enctype="multipart/form-data" onsubmit="return check();">
<table width="100%" cellpadding="0" cellspacing="0" class="global"><tr><td  valign="top" ><table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td><table width="100%" align="left" border="0" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                      <td align="left"><table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
                          <tbody><tr>
                            <td><table summary="Buttons" width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tbody>
                                  
                                  <tr>
                                    <td colspan="2" class="h2" height="30"><span class="ph"><strong>Manage uploads</strong></span></td>
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
										else
										{
										echo "<center><table><tr><td><h1>All The Chapters Are Added</h1></td></tr></table></center>";
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
								echo "<tr valign='middle'><td colspan='3' align='center'><h2>THIS QUIZ WAS ALREADY UPDATED</h2></td></tr>";
								}
								else if($_REQUEST['opt']=='5')
								{
								echo "<tr valign='middle'><td colspan='3' align='center'><h2>Upload Html Files Only</h2></td></tr>";
								}
								?><tr valign="middle">
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
                                        </tr>
                                      <!--  <tr valign="middle">
                                          <td class="tr2" align="left" height="26">Quiz</td><td colspan="2" class="tr2" align="left" height="26"><div id="quizi"><select><option value='all'>--select--</option></select></div></td>
                                        </tr>--> <tr valign="middle">
                                          <td class="tr2" align="right"><label>File Type</label></td>
                                          <td colspan="2" class="tr2" align="left" height="26"><select name="ftype"><option>Questions</option><option>Options</option><option>Answers</option><option>Solutions</option></select>
                                        </td>
                                        </tr>
                                         <tr valign="middle">
                                          <td class="tr2" align="right"><label>Upload Type </label></td>
                                          <td colspan="2" class="tr2" align="left" height="26"><select name="utype"><option value="new">New Upload</option><option value="update">Update</option></select>
                                        </td>
                                        </tr>
                                        <tr valign="middle">
                                          <td class="tr2" align="right"><label>Document Type </label></td>
                                          <td colspan="2" class="tr2" align="left" height="26"><select name="doctype"><option value="def">Default</option><option value="gen">General</option></select>
                                        </td>
                                        </tr>
                                        <tr valign="middle">
                                          <td class="tr2" align="right"><label>Section</label></td>
                                          <td colspan="2" class="tr2" align="left" height="26">
                                          <select name="section"><option value="SECTION A">SECTION A</option><option value="SECTION B">SECTION B</option><option value="SECTION C">SECTION C</option><option value="SECTION D">SECTION D</option></select>
                                        </td>
                                        </tr>
                                        
                                        <tr valign="middle">
                                          <td class="tr2" align="right"><label>File</label></td><td colspan="2" class="tr2" align="left" height="26"><input type="file" name='uple'></td>
                                        </tr>
                                        <!--<tr valign="middle">
                                          <td class="tr2" align="left" height="26">SubTopics</td><td colspan="2" class="tr2" align="left" height="26"><input type="text" name='subtopics'></td>
                                        </tr>-->
                                      
                                        <input type="hidden" value="<?php echo $cid;?>" name="cid" />
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
                                          <td colspan="5" class="pagesnum" align="center" height="26"><input type="submit" name='sub' value='Submit' class="button_light"></td>
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