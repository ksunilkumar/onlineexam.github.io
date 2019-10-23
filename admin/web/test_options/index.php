<?php
 session_start();
include "../../../lib/db.php";
include_once'../../../lib/class_exam_optque.php';
include "../../../lib/class_exam_grades.php";
include "../../../lib/class_exam_curriculum.php";
include "../../../lib/class_exam_subject.php";
$queries = new Queries();
$objSql = new SqlClass();
$exams_optque = new exams_optque();
$exams_grades = new exams_grades();

?>
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
<link href="../../../images/style.css" rel="stylesheet" type="text/css">
<link href="admin.css" rel="stylesheet" type="text/css" />
<link href="style_002.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<script>
function confirmation()
{
if(confirm("DoYou Want To delete the Record"))
return true;
else 
return false;

}
function export1()
	{
	
		location.href='export_question.php';
		return true;
		
	}
		function hidediv(){
		document.getElementById('span_div').style.display='none';
		return true;
	}
</script>
<body>
 <?php include"../header_one.php";?>
    <?php  include '../left.php'; ?>
    <div id="content_wrapper" style="margin-right:30px;"> 
		
			<!-- Begin one column box --> 
		
			
			<!-- Begin 1st level tab --> 
			<ul class="first_level_tab"> 
			<li> 
					<a href="<?php echo $admin_path;?>test_options/index.php" class="active"> 
						Manage Optional Questions
					</a> 
				</li> 
				<li> 
					<a href="<?php echo $admin_path;?>test_options/add_op_questions.php"> 
						Add Optional Questions
					</a> 
				</li>
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/>  <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 
            
			<div style="border:1px solid #ccc;"  > 
				
							
				<div class="content nomargin"  > 
       
                    
                 
                              <table width="100%"  cellpadding="0" cellspacing="0" class="global">
                                <tbody>
                                
                                 <!-- <tr>
                                    <td  ><span class="ph"><strong>Manage Optional Questions</strong></span></td>
                                  </tr>-->
                                  <tr>
                                  	<td >
                  							 <b><?php echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></b>
                                      </td>
                                  </tr>
                                  <tr>
												<td colspan="4" align="right">
                                                <?php
													if(isset($_REQUEST['filename']))
													{
												?>
                                                	 <span style="padding-left:20px; color:#0000FF; font-weight:bold; padding-bottom:10px;"  id="span_div">Your Export Completed Successfully, click here <a href="../exports/<?php echo $_REQUEST['filename']; ?>"><img src="../../images/download.gif" alt="" width="30" height="24" border="0" align="absmiddle" onclick="return hidediv();"/></a> to Download</span>
                                                <?php
													}
												?>        
                                                   <input type="button" name="sub" value="Export" class="button_light"  onclick="export1(); return false;" />
								                                                         </td>
											</tr>
                                  <tr valign="top">
                                    <td width="100%">
									<form name="ff" action="../del.php" method="post" enctype="multipart/form-data">
									<table class="borderlistings" summary="List of threads" width="100%" cellpadding="0" cellspacing="0">
                                        <thead>
                                          <tr>
										    <th class="listingheadings" width="8%" align="center" height="35">curriculum</td>
                                               <th class="listingheadings" width="8%" align="center" height="35">Subject</td>
                                             <th class="listingheadings" width="8%" align="center" nowrap="nowrap">Grade</td>
                                             <th class="listingheadings" width="8%" align="center" height="35">Section A</td>
                                            <th class="listingheadings" width="8%" align="center" height="35">Marks for Section A</td> 
                                            <th class="listingheadings" width="10%" align="center" height="35">Section B</td>
                                             <th class="listingheadings" width="10%" align="center" height="35">Marks for Section B</td>
                                            <th class="listingheadings" width="10%" align="center" nowrap="nowrap">Section C</td>
                                             <th class="listingheadings" width="10%" align="center" height="35">Marks for Section C</td>
                                           <th class="listingheadings" width="10%" align="center" nowrap="nowrap">Section D</td>
                                             <th class="listingheadings" width="16%" align="center" height="35">Marks for Section D</td>
                                            <th class="listingheadings" width="10%" align="center" nowrap="nowrap">Options</td>
                                          </tr>
                                        </thead><tbody>
									    <?php
										$exams_curriculum = new exams_curriculum();
										$exams_subject = new exams_subject();
									
										$opt_que = $exams_optque->optque_select();
										//print_r($opt_que);
										$rowcount=0;
										for($i=0;$i<=count($opt_que)-3;$i++)
										//while($row=$objSql->fetchRow($opt_que))
										{ 
										$rowcount++;
										$curname = $exams_curriculum->curriculum_name_select(cur_id,$opt_que[$i]->cur_num);
										$cname =$objSql->fetchRow($curname);
										//echo '<pre>';
										//print_r($cname);
										$sub = $exams_subject->subject_all_select($opt_que[$i]->subject_num);
										$sname=$objSql->fetchRow($sub);
										$grename= $exams_grades->grades_all_select($opt_que[$i]->grade_num);
										$gname = $objSql->fetchRow($grename);
										?>                                    
                                          <tr>
										    <td class="tr2" align="left" height="30"><?=$cname["cur_name"]?></td>
                                               <td class="tr2" align="left" height="30"><?=$sname["sub_name"]?> </td>
                                                <td class="tr2" align="left" height="30"><?=$gname["grade_name"]?> </td>
                                                   <td class="tr2" align="left" height="30"><?=$opt_que[$i]->section_a;?> </td>
                                                   <td class="tr2" align="left" height="30"><?=$opt_que[$i]->amarks;?> </td>
                                                   <td class="tr2" align="left" height="30"><?=$opt_que[$i]->section_b?> </td>
                                                   <td class="tr2" align="left" height="30"><?=$opt_que[$i]->bmarks;?> </td>
                                                   <td class="tr2" align="left" height="30"><?=$opt_que[$i]->section_c;?> </td>
                                                   <td class="tr2" align="left" height="30"><?=$opt_que[$i]->cmarks;?> </td>
                                                    <td class="tr2" align="left" height="30"><?=$opt_que[$i]->section_d;?> </td>
                                                   <td class="tr2" align="left" height="30"><?=$opt_que[$i]->dmarks?> </td>
                                                  <td class="tr2" align="left" nowrap="nowrap">
                                                  <a href="edit_opt_questions.php?id=<?php echo $opt_que[$i]->num;?>&page=<?php echo $_GET['page'];?>">
                                                  <img src="../../images/edit.gif" border="0" alt="Edit" title="Edit position"></a>
                                                   <a href="delete_opt_position.php?id=<?php echo $opt_que[$i]->num;?>&page=<?php echo $_GET['page'];?>"><img src="../../images/delete.gif" border="0" alt="Delete " title="Delete" onclick="return confirmation();"></a></td>
                                          </tr>
										  <?php
										  } ?>
                                         
                                          <?php 
										  if($rowcount==0){
										  ?>
                                           <tr>
										    <td class="tr2"  align="center" height="30" colspan="12" align="center"><strong>No Records Found</strong></td></tr>
                                          <?php }?>
                                        </tbody>
                                      </table>
									</form>
                                   
                 </table>
                 <div class="pagination">
     			 <?php  echo $opt_que['total_rec'];	?> &nbsp;&nbsp;&nbsp;<?php echo $opt_que['dis_page']; ?> 
                 </div>
                 <br class="clear"/>
				</div> 
				</div></div>
			
			<!-- End one column box --> 
			<br class="clear"/>
			

<br class="clear"/> 
	
	<?php include '../footer.php';?>
</body>
</html>

