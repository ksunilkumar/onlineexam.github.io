<?php
 @session_start();

include_once'../../../lib/db.php';
	include "../../../lib/functions_admin.php";
	include "../../../lib/functions.php";
include_once'../../../lib/class_exam_course.php';
include_once'../../../lib/class_exam_chapters.php';
include_once'../../../lib/class_exam_subject.php';
include_once'../../../lib/class_exam_test.php';
include_once'../../../lib/class_exam_grades.php';

$queries = new Queries();
$objSql = new SqlClass();
$exams_test = new exams_test();
$exams_subject = new exams_subject();
$exams_course = new exams_course();
$exams_chapters = new exams_chapters();
$exams_grades = new exams_grades();
$couid=$_REQUEST['cid'];
$chapid=$_REQUEST['id'];

if($chapid!="" && $couid!="")
{
$s = $exams_test->test_to_select($couid,$chapid,$_SESSION['school_id']);
$courseall = $exams_course->course_select("course_id",$couid);
$chapters = $exams_chapters->chapters_sel("chap_id",$chapid,$_SESSION['school_id']);

}
else{
$s = $exams_test->test_select(1,1);


}


    $rowcount=0;
	$objSql = new SqlClass();
$objSql1= new SqlClass();

	
    $al=".";
	if(!empty($_REQUEST['al']))
	{
		$al = $_REQUEST['al'];
	}
	 $totalEntries=$exams_test->totalNoOftests($chapid);
	
	
	$maxPages=ceil($totalEntries/perPage());
	if(empty($_REQUEST['pageNumber'])){
		$page=1;
	}else{
		$page=$_REQUEST['pageNumber'];
	}
	if(empty($_REQUEST['order'])){
		$order=0;
	}else{
		$order=$_REQUEST['order'];
	}
		//$rec = $user->display_users($page,$al,$order);

	 $rec = $exams_test->display_tests($page,$al,$order, $_SESSION['school_id'],$chapid);
										
														
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
<script language="javascript">
	function showPage(pageNumber)
	{
		document.getElementById("pageNumber").value=pageNumber;
		document.getElementById("pageSelectionForm").submit();
		return true;
	}
	function CheckAll(chk)
	{
	   //alert("hi");
	   var num=document.BlogSelectionForm.elements.length;
	   for(i=0;i<num;i++)
	   {
			tmp=document.BlogSelectionForm.elements[i];
			//alert(document.packages.elements[i].name);
			if(tmp.type=="checkbox" && !(tmp.name=="allChk"))
			{
				tmp.checked=chk.checked;
			}
		}
	}
	function send_select()
	{
		//alert("hi send");
		dml1=document.BlogSelectionForm;
		len1 = dml1.elements.length;
		var j=0;
		var value12='';
		select_status=0;
		for( j=0 ; j<len1 ; j++)
		 {
			if (dml1.elements[j].name=='Mid[]')
			 {
				if((dml1.elements[j].checked))
				{
					if(select_status!=0)
						val12=val12+",";
					select_status=1;
					val12=val12+dml1.elements[j].id;
				}
			}
		}
		if(select_status==0)
		{
			alert("Select atleast one record");
			return false;
		}
		//alert("alert");
		document.BlogSelectionForm.send.value=value12;
		document.BlogSelectionForm.submit();
		return true;
	}
	function doselect1()
	{
		dml1=document.BlogSelectionForm;
		len1 = dml1.elements.length;
		var j=0;
		var val12='';
		select_status=0;
		for( j=0 ; j<len1 ; j++)
		 {
			if (dml1.elements[j].name=='Mid[]')
			 {
					if((dml1.elements[j].checked))
					{
						if(select_status!=0)
							val12=val12+",";
						select_status=1;
						val12=val12+dml1.elements[j].id;
					}
			}
		}
		if(select_status==0)
		{
			alert("Select atleast one record");
			return false;
		}
		if(!confirm('Are you sure you want to delete the records?\n- to Delete the records, hit OK\n- otherwise, hit Cancel'))
			return false;
			//alert("alert12");
		document.BlogSelectionForm.delet.value=val12;
		document.BlogSelectionForm.submit();
		return true;
	}
	
 function export1(cid)
	{
	
		if(cid=='undefined')
		cid='';
	
		dml1=document.BlogSelectionForm;
		len1 = dml1.elements.length;
		var j=0;
		var val12='';
		select_status=0;
		for( j=0 ; j<len1 ; j++)
		 {
			if (dml1.elements[j].name=='Mid[]')
			 {
					if((dml1.elements[j].checked))
					{
						if(select_status!=0)
							val12=val12+",";
						select_status=1;
						val12=val12+dml1.elements[j].id;
					}
			}
		}
		if(select_status==0)
		{
			//alert("Select atleast one record");
			//return false;
			 if(!confirm('You are not selected any record, you want to export the all records?\n- to Export All Records, hit OK\n- otherwise, hit Cancel'))
				return false;

		}
		else
		{
		    if(!confirm('Are you sure you want to Export the Selected Records?\n- to Export the Records, hit OK\n- otherwise, hit Cancel'))
			 return false;
		}
			//alert("alert12");
//		document.BlogSelectionForm.exprt.value=val12;
		// document.BlogSelectionForm.submit();
		//alert(cid);
		location.href='export_blogs.php?exprt='+val12+'&cid='+cid;
		return true;
		// document.getElementById('info_msg').innerHTML='Download Completed Successfully';
	}
function addBlog()
	{
		if(!confirm('Are you sure you want to add the Test?\n- to Add the  Test, hit OK\n- otherwise, hit Cancel'))
		return false;
		cid=document.getElementById('cid').value;
		id=document.getElementById('id').value;
		location.href='course_add.php?id='+id+'&cid='+cid;
	}
</script>
<script language="javascript">
function chk(x)
{
var cid=x.split("~");
location.href="index.php?id="+cid[0]+"&cid="+cid[1];
}
</script>
<script language="javascript">
function loadit()
{

//var curid=document.getElementById('curid').value;
var couid=document.getElementById('couid1').value;
//alert(couid);
if(couid=="all")
location.href="index.php";
else
location.href="index.php?couid="+couid; 
}
function hidediv(){
		document.getElementById('span_div').style.display='none';
		return true;
	}
</script>
<style type="text/css">
<!--
-->
</style></head>
<body>
	<form name="pageSelectionForm" id="pageSelectionForm" method="get" action="index.php">
		<input type="hidden" id="pageNumber" name="pageNumber" value=""/>
       <input type="hidden" id="cid" name="cid" value="<?php echo $_REQUEST['cid'];?>" />
       <input type="hidden" id="id" name="id" value="<?php echo $_REQUEST['id'];?>" />
        <input type="hidden" id="al" name="al" value="<?php echo $al;?>"/>
		<input type="hidden" id="order" name="order" value="<?php echo $order;?>"/>
	</form>
        <?php include"../header_one.php";?>
    <?php  include '../left.php'; ?>
    <br class="clear"/> 
		
		<!-- Begin content --> 
		<div id="content_wrapper" style="margin-right:30px;"> 
		
			<!-- Begin one column box --> 
		
			
			<!-- Begin 1st level tab --> 
			<ul class="first_level_tab"> 
			
				<li> 
					<a href="<?php echo $admin_path;?>tequizes/index.php"  class="active"> 
						Manage Quiz
					</a> 
				</li> 
				<li> 
					<a href="<?php echo $admin_path;?>tequizes/course_add.php"> 
						Add Quiz
					</a> 
				</li> 
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/>  <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
			
			
				
				<div class="content nomargin"  > 
				<form name="BlogSelectionForm" method="POST" action="course_action.php?al=<? echo $_REQUEST['al'];?>&id=<?php echo $_REQUEST['id'];?>&cid=<?php echo $_REQUEST['cid'];?>&pageNumber=<? echo $_REQUEST['pageNumber']; ?>">
									<table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="global">
										<tbody>
									  <!--	<tr>
												<td align="center" colspan="5"><h2>Blog</h2></td>
											</tr>-->
											<tr><td width="100%" colspan="5" id="info_msg" ><?php echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td></tr>
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
                                                <input type="button" name="sub1" value="Add Test" class="button_light"   onclick="return addBlog()" />
									                <input type="submit" name="sub3" value="Delete Test(s)" class="button_light" onclick="doselect1(); return false;" />
								                    <input type="button" name="sub" value="Export" class="button_light"  
                                                    onclick="export1(<? if($_REQUEST['id']!=" ") echo $_REQUEST['id']; else echo "hi";?>); return false;" />
							                     
                                               </td><!--<td align="right">
                                              
                                                </td>-->
											</tr>
											<tr>
                                            <td colspan="5">
                                            <table width="100%"><tr>
                                                <td width="47%" class="h2"><span class="ph"><strong>Manage Tests</strong></span></td>
                                                <td width="45%" align="right">Select Chapter&nbsp;&nbsp;
                                                <!--<select name="curid" onchange="javascript:load(this.value)" id='curid'>
                                                </select>-->									</td>
                                                <td width="8%">
                                                
                                               <div id="course"> <select name='chapterid' onChange="javscript:chk(this.value)">
								<?php 
								
									if($chapid!="")
									{
									$chap = $exams_chapters->chapters_sel("chap_id",$chapid);
									while($re=$objSql->fetchRow($chap)){
									echo "<option value='$chapid~$couid'>".$re['chap_name']."</option>";
									}
									echo "<option value='~'>Select All</option>";
									}
									else{
									echo "<option value='~'>Select Chapter</option>";
									}
									$allchap = $exams_chapters->chapters_all_select(chap_name);
									$ggg=0;
									  while($row = $objSql->fetchRow($allchap))
									{
									
									if($ggg==0)
									{
									$ochid=$row['chap_id'];
									//echo $ochid;
									$ggg++;
									}
									if($row['chap_id']!=$chapid){
									echo "<option value='".$row['chap_id']."~".$row['course_id']."'>".$row['chap_name']."</option>";}
									}
									
									?>
                                 </select></div>
                                                </td>
                                                </tr>
                                              </table>
                                            
                                            </td>
                                            </tr>
											<tr>
												<td colspan="5">
													<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tborder">
                                                    
                                                                                            

<tr class="row_1"><?php $_GET['or']?>
										                    <th width="7%" align="center" ><input type="checkbox" name="allChk" value="ON" onclick="CheckAll(this);"  class="input2" /></th>
							                        <th width="14%" align="left" ><a href="../coures/index.php?order=<?php if(empty($_GET['order'])){?>1<?php }elseif($_GET['order'] == '1'){?>0<?php }?>" class="tablehead"><span class="listingheadings">Grade</span><span class="style1"> </span></a>&nbsp;<?php if($_GET["order"]=='0') {?><img src="../images/up1.GIF" width="13" height="13" /><?php }else if($_GET["order"] == '1'){?><img src="../images/down1.GIF" width="13" height="13" /><?php }?></th>
                                            <th width="26%" align="left" ><span class="listingheadings">Chapter </span></th>
                    <th width="21%" align="left" ><strong>Quiz</strong></th>
                    <th width="16%" align="left" ><strong>Test Time</strong></th>
                   
                    <th width="16%" align="left" ><span class="listingheadings">Options</span></th>
					<th width="16%" align="left" ><span class="listingheadings">Status</span></th>					              </tr>
                                                      
                                                      <?
                                                     
													$chjk=$_REQUEST['couid'];
													//print_r($grade1['grade_name']);
														
														
														?>
                                                      
                                                      
                                                   <?php 
												   
														if($rec !='1')
														{
													  ?>
									                  <?php 
															$val=0;
															while($row = $objSql1->fetchRow($rec))
															{
															
														
															$s1 = $exams_course->course_selectall("course_id",$row['course_id']);
															
															$chap = $exams_chapters->chapters_selectall("chap_id",$row['chapter_id']);
															$g = $exams_grades->grades_selectall("grade_id",$s1['grade_id']);
																$cour1=$exams_course->course_selectall("course_id",$row['course_id']);
																
																$grade1 = $exams_grades->grades_selectall("grade_id",$cour1["grade_id"]);
																$chjk=$_REQUEST['couid'];
																
 																if($val == '0')
																{
																	$val = 1;
																	
													  ?>
													  <tr class="row_white">
										                  <td height="24" align="left" ><input  type="checkbox" name="Mid[]" id="<?php echo $row['test_id'];?>" value="642" class="input2" /></td>
														  <td align="left">
														  <?php echo $g['grade_name'];?>                                                            </td>
                                                           <td align="left"><?php echo $chap['chap_name'];?></td>
                                                            <td align="left"><?php echo $row['test_name'];?></td>
                                                             <td align="left"><?php echo $row['time'];?></td>
                                                             
                                                   <td align="left">
                                                               <a href="course_modify.php?id=<?php echo $row['test_id'];?>&pageNumber=<?php echo $_REQUEST['pageNumber'];?>&cid=<?php echo $_REQUEST['cid'];?>&chapid=<?php echo $_REQUEST['id'];?>">
                                                               <img src="../images/b_edit.png" border="0" alt="Edit Course" title="Edit Course">                                                                </a></td><td>
                                                             <a href="action.php?test_id=<?php echo $row['test_id'];?>&pageNumber=<?php echo $_REQUEST['pageNumber'];?>&status=<?php echo $row['status'];?>"><?php echo $row['status'];?></a></td>
									                  </tr>
									                  
													  <?php }
													  		else if($val == '1')
															{
																$val = 0;
													  ?>
													  <tr class="row_color">
										                  <td height="24" align="left" ><input  type="checkbox" name="Mid[]" id="<?php echo $row['test_id'];?>" value="642" class="input2" /></td>
														  <td align="left"><?php echo $g['grade_name'];?></td>
                                                           <td align="left"><?php echo $chap['chap_name'];?></td>
                                                           <td align="left"><?php echo $row['test_name'];?></td>
                                                             <td align="left"><?php echo $row['time'];?></td>
                                                            
                                                              
                                                   <td align="left">
                                                               <a href="course_modify.php?id=<?php echo $row['test_id'];?>&pageNumber=<?php echo $_REQUEST['pageNumber'];?>&cid=<?php echo $_REQUEST['cid'];?>&chapid=<?php echo $_REQUEST['id'];?>">
                                                               <img src="../images/b_edit.png" border="0" alt="Edit Course" title="Edit Course">                                                                </a></td><td>
                                                              <a href="action.php?test_id=<?php echo $row['test_id'];?>&pageNumber=<?php echo $_REQUEST['pageNumber'];?>&status=<?php echo $row['status'];?>"><?php echo $row['status'];?></a></td>
									                  </tr>
													 <?php } 
													 }
													 ?>
													 <?php
													}else{?>
													 <tr class="row_white"><td align="center" colspan="7" style="color:#FF0000;">No records Found.</td></tr>
													 <?php } ?>
											  </table>												</td>
											</tr>
                                                <tr>
														<td colspan="6"  class="row_white" align="right">
														<?php
														/* include_once"paging.php";
															display_pag("index.php");
															*/
															?><br /></td>
										  </tr>
										</tbody>
									</table>
									<input type="hidden" name="send" /><input type="hidden" name="delet"><input type="hidden" name="send_status" />
									</form>
				    	<?php	include '../pageNation.php'; 
							?>
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

