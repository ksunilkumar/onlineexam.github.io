<?php session_start();include "../../../lib/db.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
</head>
<body>
<script>
function confirmation()
{
if(confirm("DoYou Want To delete the Record"))
return true;
else 
return false;

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
					<a href="<?php echo $admin_path;?>test_options/manage_tests.php" class="active"> 
						Manage Tests
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
  include_once'../../../lib/class_exam_users.php';
  include_once'../../../lib/class_exam_bag.php';
   include_once'../../../lib/class_exam_course.php';
   include_once'../../../lib/class_exam_test.php';
   include_once'../../../lib/class_exam_chapters.php';
    include_once'../../../lib/class_exam_grades.php';
	include_once '../../../lib/users_class.php';
 $queries = new Queries();
 $objSql = new SqlClass();
 $exams_bag = new exams_bag();
 $exams_course = new exams_course();
 $exams_test = new exams_test();
 $exams_chapters = new exams_chapters();
 $exams_grades = new exams_grades();
?>
<table width="100%"  cellpadding="0" cellspacing="0" class="global" ><tr><td  valign="top"><table width="90%" align="center" border="0" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td><table width="100%" align="left" border="0" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                      <td align="left"><table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
                          <tbody><tr>
                            <td align="center"> <table summary="Buttons" width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                <tbody>
                                 
                                 <!-- <tr>
                                    <td colspan="2" class="h2" height="30"><span class="ph"><strong>Manage Test</strong></span></td>
                                  </tr>-->
                                                          <tr>
                                    <td colspan="2" align="center" height="25"><?php if($_SESSION['op']==1)
									{
									echo "<h3><blink><span class='ph'>Mail Was Sent</span></blink></h3>";
									$_SESSION['op']=0;
									}?></td>
                                  </tr>
                                </tbody>
                              </table>
                              <table width="60%" border="1" cellpadding="0" cellspacing="0" align="center">
                                <tbody>
                                  <tr valign="top">
                                    <td width="99%">
									<form name="ff" action="del.php" method="post" enctype="multipart/form-data">
									<table class="borderlistings" summary="List of threads" width="100%" cellpadding="0" cellspacing="0" border="1">
                                        <thead>
                                          <tr>
										    <th class="listingheadings" width="20%" align="center" height="35">User</td>
                                            <th class="listingheadings" width="19%" align="center">Grade</td>
                                            <th class="listingheadings" width="21%" align="center"><strong> Chapter</strong></td>
                                            <th class="listingheadings" width="21%" align="center">Test</td> 
                                           <!-- <td class="listingheadings" width="15%" align="center" nowrap="nowrap">Options</td>-->
                                          </tr>
                                        </thead><tbody>
                                      
                                          <?php
									
									$tests=$exams_test->get_test_page($_SESSION['school_id']);
									
									for($j=0;$j<=count($tests)-3;$j++){
										
									if($tests[$j]->quizid!=0)
										{
										
										$course = $exams_course->course_selectall(course_id,$tests[$j]->courseid);
										
									$ckurid =$course['cur_id'];
										if($ckurid!="")
										{
										if($ckurid==$course['cur_id'])
										{
										//echo $row->quizid;
										
										
										$test = $exams_test->test_select(test_id,$tests[$j]->quizid,$_SESSION['school_id']);
										
										$chapters = $exams_chapters->chapters_selectall(chap_id,$tests[$j]->chapterid);
									//print_r($chapters);
										list($y,$m,$d)=explode("-",$tests[$j]->time);
										$cdate=date('d-m-y');
										$dat=$d."-".$m."-".$y;
										if($dat>$cdate)
										$i=0;
										else 
										$i=1;
										$grades = $exams_grades->grades_inner_query($tests[$j]->courseid);
									/*echo '<pre>';
										print_r($grades);
										exit;	*/
							//print_r($grades);
								
																?>
								<tr align="left"><td><b>
								<?php  $users=new Users(); //echo $tests[$j]->user;
								echo $users->user_name_one($tests[$j]->user);?></b></td><td><b><?php 
								
								 echo $grades['grade_name'];	// echo $quiz['qfullname']; 
								 ?>
								 </b></td>
                                 <td align="left"><b><?php if($tests[$j]->status==2) echo "Completed"; else if($tests[$j]->status==2) echo "Pending";else if($tests[$j]->status==0){?><span style="cursor:pointer"><img src='../../images/takequiz.png' onClick="javascript:disp('<?php echo "fr".$nop;?>','<?php echo $tests[$j]->Bagid;?>','<?php echo $tests[$j]->quizid;?>','<?php echo $tests[$j]->chapterid;?>','<?php echo $tests[$j]->courseid;?>')"></span></a><!--<input type="image" src="images/arrow_norm.gif">--><?php }?>
								</b></td>
                                <td><?php if($tests[$j]->nstatus==1){?><a href="delete_test.php?id=<?php echo $tests[$j]->Bagid;?>&page=<?php echo $_REQUEST['pageNumber'];?>&<?php if(!empty($_REQUEST['al'])){echo "al=".$_REQUEST['al']."";} ?>" style="text-decoration:none "><img src="../../images/delete.gif" alt="Delete" border="0" title="Delete"></a><?php }else{if($tests[$j]->nstatus==1){echo "<img src='../../images/ne.gif' align='absmiddle'>";} }?></td></form>
								</tr>
								
								<?php 
								}
								}
								else
								{
								
								$testre = $exams_test->test_select(test_id,$tests[$j]->quizid,$_SESSION['school_id']);
								$q = $objSql->fetchRow($testre);
								
								$chap= $exams_chapters->chapters_selectall(chap_id,$tests[$j]->chapterid);
								
								list($y,$m,$d)=explode("-",$tests[$j]->time);
								$cdate=date('d-m-y');
								
								$dat=$d."-".$m."-".$y;
								
								if($dat>$cdate)
								$i=0;
								else 
								$i=1;
								//$gra = $exams_grades->grades_inner_query($tests[$j]->courseid);
								$grades = $exams_grades->grades_inner_query($tests[$j]->courseid);
									/*echo '<pre>';
										print_r($grades);
										exit;*/								?>
								<tr align="left"><td><b><?php $users=new Users(); //echo $tests[$j]->user;
								echo $users->user_name_one($tests[$j]->user);?></b></td><td><b>
								<?php 
								echo $grades['grade_name']; 
								 ?>
								 </b></td><td> <?php echo $chap['chap_name'];?></td><td><b><?php echo $q['test_name'];?></b><span style="cursor:pointer">
                                <img src="../../images/active.gif"  onclick="location.href='activa.php?bid=<?php echo $tests[$j]->Bagid;?>';"/></span></td>
                                </tr>
								
								<?php
																						
								}
								}
								}if(count($tests)==0){
								?><tr><td colspan="7" align="center"><h1><blink>No USERS is waiting</blink></h1></td></tr><?php }?>
                                        </tbody>
                                      </table>
									</form>
                                     <table width="100%" border="0" cellpadding="3" cellspacing="0">
                                            <tbody>
                                            <tr valign="middle">
                                              <td colspan="5" class="pagesnum" align="left" height="26">
                                              <tr><td colspan="12" align="right"> </td></tr></td>
                                            </tr>
                                          </tbody>
                                      </table>
                                    
                                    
                                    
                                      <table width="100%" border="0" cellpadding="3" cellspacing="0">
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
                  </tbody></table></td></tr></table></tr></table>
                   <div class="pagination">
        <?php  echo $tests['total_rec'];	?> &nbsp;&nbsp;&nbsp;<?php echo $tests['dis_page']; ?>
        </div> <br class="clear"/>
				</div> 
				</div></div>
			
			<!-- End one column box --> 
			<br class="clear"/>
			

<br class="clear"/> 
	
	<?php include '../footer.php';?>
</body>
</html>

          
