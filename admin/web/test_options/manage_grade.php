<?php session_start();
include_once '../../../lib/db.php';


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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

</style>
<link href="admin.css" rel="stylesheet" type="text/css" />
<link href="style_002.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script>
 function export1()
	{
		location.href='export_grade.php';
		return true;
		
	}
		function hidediv(){
		document.getElementById('span_div').style.display='none';
		return true;
	}
	function showPage(pageNumber)
	{
		document.getElementById("pageNumber").value=pageNumber;
		document.getElementById("pageSelectionForm").submit();
		return true;
	}
</script>
</head>

<body>
<form name="pageSelectionForm" id="pageSelectionForm" method="post" action="../test_options/manage_grade.php">
		<input type="hidden" id="pageNumber" name="pageNumber" value=""/>
        <input type="hidden" id="al" name="al" value="<?php echo $al;?>"/>
		<input type="hidden" id="order" name="order" value="<?php echo $order;?>"/>
	</form>
     <?php include"../header_one.php";?>
    <?php  include '../left.php'; ?>
   
		<div id="content_wrapper" style="margin-right:30px;"> 
		
			<!-- Begin one column box --> 
		
			
			<!-- Begin 1st level tab --> 
			<ul class="first_level_tab"> 
			<li> 
					<a href="<?php echo $admin_path;?>test_options/manage_grade.php" class="active"> 
						Manage Grades
					</a> 
				</li> 
				<li> 
					<a href="<?php echo $admin_path;?>test_options/addgrade.php"> 
						Add Grade
					</a> 
				</li>
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/> <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
			
			
				
				<div class="content nomargin"  > 
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="global">
                  <tr>
                    <td >
                    <?php echo $_SESSION['msg'];unset($_SESSION['msg']);?>
                    </td>
                    </tr>
                    <tr><td>
                  <?php
include_once "../../../lib/db.php";
include "../../../lib/class_exam_grades.php";
$queries = new Queries();
$objSql = new SqlClass();
$exams_grades = new exams_grades();

?><table width="100%"><tr><td valign="top" ><table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td><table width="100%" align="left" border="0" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                      <td align="left"><table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
                          <tbody><tr>
                            <td><table summary="Buttons" width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tbody>
                                 <tr>
												<td colspan="4" align="right">
                                                <?php
													if(isset($_REQUEST['filename']))
													{
												?>
                                                	 <span style="padding-left:20px; color:#0000FF; font-weight:bold; padding-bottom:10px;" id="span_div">Your Export Completed Successfully, click here <a href="../exports/<?php echo $_REQUEST['filename']; ?>"><img src="../../images/download.gif" alt="" width="30" height="24" border="0" align="absmiddle" onclick="return hidediv();"/></a> to Download</span>
                                                <?php
													}
												?>     
                                                    		<input type="button" name="sub" value="Export" class="button_light"  onclick="export1(); return false;" />
                                                                                                   
                                                </td><!--<td  align="right"></td>-->
											</tr>
                                 <!-- <tr>
                                    <td colspan="2" class="h2" height="30"><span class="ph"><strong>Manage Grades</strong></span></td>
                                  </tr>-->
                                 <!-- <tr>
                                    <td colspan="2" align="right" height="25"><table width="100%"><tr><td>&nbsp;</td>
                                    <td align="right"><a href="addgrade.php">Add Grade</a> </td>
                                    </tr></table></td>
                                  </tr>-->
                                </tbody>
                              </table>
                              <table width="100%" border="1" cellpadding="0" cellspacing="0">
                                <tbody>
                                  <tr valign="top">
                                    <td width="60%" align="center">
									<form name="ff" action="del.php" method="post" enctype="multipart/form-data">
									<table class="borderlistings" summary="List of threads" width="60%" cellpadding="0" cellspacing="0" border="1" align="center">
                                        <thead>
                                          <tr>
										    <th class="listingheadings" width="20%" align="center" height="35">Grade</th>
                                            <th class="listingheadings" width="20%" align="center" height="35">Image</th>
                                            
                                            
                                            <th class="listingheadings" width="16%" align="center" nowrap="nowrap">Options</th>
                                           
                                          </tr>
                                        </thead><tbody>
									    <?php $al='.';
										if(!empty($_REQUEST['al']))
											{
												$al = $_REQUEST['al'];
											}
											if(empty($_REQUEST['pageNumber'])){
											$page=1;
											}else{
											$page=$_REQUEST['pageNumber'];
											}
										$totalEntries = $exams_grades->totalNoOfGrades($al);
										$maxPages=ceil($totalEntries/perPage());
										$grade = $exams_grades->grades_select($page,$al);
										for($i=0;$i<count($grade);$i++)
										{		
										
										?>
                                          <tr>
										    <td class="tr2" align="left" height="30"><?php  echo $grade[$i]['grade_name'];?></td>
                                            <td class="tr2" align="left" height="30">
                                            <img src="../../../gradeimages/<?php echo $grade[$i]['grade_image'];?>" width="50" height="50" /></td>
                                            <td class="tr2" align="left" nowrap="nowrap">
                                            <a href="editgrade.php?gid=<?php echo $grade[$i]['grade_id'];?>&page=<?php echo $_GET['page'];?>&<?php if(!empty($_REQUEST['al'])){echo "al=".$_REQUEST['al']."";} ?>">
                                            <img src="../../images/edit.gif" border="0" alt="Edit Grade" title="Edit Subject"></a>
                                              <a href="deletegrade.php?gid=<?php echo $grade[$i]['grade_id']; ?>&page=<?php echo $_GET['page'];?>&<?php if(!empty($_REQUEST['al'])){echo "al=".$_REQUEST['al']."";} ?>">
                                              <img src="../../images/delete.gif" border="0" alt="Delete Subject" title="Delete Subject"></a></td>
                                              
                                          </tr>
										  <?php
										  }?>
                                          <tr><td colspan="3" align="right"> </td></tr>
                                          <?php 
										  if(count($grade)==0)
										  {
										  ?>
                                           <tr>
										    <td class="tr2" align="center" height="30" colspan="3"><strong>No Grades Available</strong></td></tr>
                                          <?php }?>
                                           <tr>
														<td colspan="6"  class="row_white" align="right">
														<?php
														 include_once"../paging.php";
															display_pag("manage_grade.php");
															
															?></td>
										  </tr>
                                        </tbody>
                                      </table>
									</form>
                                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tbody><tr valign="middle">
                                          <td colspan="5" class="pagesnum" align="left" height="26">&nbsp;</td>
                                        </tr>
                                      </tbody></table></td>
                                  </tr>
                                </tbody>
                              </table></td>
                          </tr>
                        </tbody></table></td>
                    </tr>
                  </tbody></table></td>
              </tr>
            </tbody></table></td></tr></table>
             </td>
  </tr>
</table>
<?php	include '../pageNation.php'; 
							?>
<!--<div class="pagination">
 <?php  echo $grade['total_rec'];	?> &nbsp;&nbsp;&nbsp;<?php echo $grade['dis_page']; ?>
 </div>-->
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

