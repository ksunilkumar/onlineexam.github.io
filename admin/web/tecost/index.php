 <?php
 @session_start();

include_once "../../../lib/db.php";
include_once "../../../lib/functions.php";
include_once "../../../lib/functions_admin.php";
include "../../../lib/class_exam_grades.php";
include "../../../lib/class_exam_chapters.php";
include "../../../lib/class_exam_cost.php";
include "../../../lib/class_exam_test.php";
include "../../../lib/class_exam_course.php";
//include "../lib/class_exam_chapters.php";
$queries = new Queries();
$objSql = new SqlClass();
$exams_grades = new exams_grades();
$exams_cost = new exams_cost();
$exams_test = new exams_test();
$exams_course = new exams_course();
$exams_chapters = new exams_chapters();
$id=$_REQUEST['id'];
$cid=$_REQUEST['cid'];


if(isset($_REQUEST["Submit"]))
{
$_SESSION['user']='admin';
}
else
{}
$opt=$_REQUEST['opt'];
	
    $al=".";
	if(!empty($_REQUEST['al']))
	{
		$al = $_REQUEST['al'];
	}
	 $totalEntries=$exams_cost->totalNoOfcosts($id,$cid);
	
	
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

	 $rec = $exams_cost->display_costs($page,$al,$order, $id,$cid);
	
										
														
 ?>  

<script language="javascript">
function chk(x)
{
var cid=x.split("~");
location.href="manage_cost.php?id="+cid[0]+"&cid="+cid[1];
}
</script>
<script language="javascript" src="js5.js">


</script>            

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
	
 function export1(id,cid)
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
		location.href='export_blogs.php?exprt='+val12+'&id='+id+'&cid='+cid;
		return true;
		// document.getElementById('info_msg').innerHTML='Download Completed Successfully';
	}
function addBlog()
	{
		if(!confirm('Are you sure you want to add the Cost?\n- to Add the  Cost, hit OK\n- otherwise, hit Cancel'))
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
                                                	 <span style="padding-left:20px; color:#0000FF; font-weight:bold; padding-bottom:10px;" id="span_div">Your Export Completed Successfully, click here <a href="../exports/<?php echo $_REQUEST['filename']; ?>"><img src="../../images/download.gif" alt="" width="30" height="24" border="0" align="absmiddle" onClick="return hidediv();"/></a> to Download</span>
                                                <?php
													}
												?>      
                                                <input type="button" name="sub1" value="Add Cost" class="button_light"   onclick="return addBlog()" />
									                <input type="submit" name="sub3" value="Delete Cost(s)" class="button_light" onClick="doselect1(); return false;" />
								                    <input type="button" name="sub" value="Export" class="button_light"  onclick="export1('<? echo $_REQUEST['id']; ?>','<? echo $_REQUEST['cid']; ?>'); return false;" />
							                     
                                               </td><!--<td align="right">
                                               
                                                </td>-->
											</tr>
											<tr>
                                            <td colspan="5">
                                            <table width="100%"><tr>
                                                <td width="47%" class="h2"><span class="ph"><strong>Manage Costs</strong></span></td>
                                                <td width="45%" align="right">Select Chapter&nbsp;&nbsp;
                                                <!--<select name="curid" onchange="javascript:load(this.value)" id='curid'>
                                                </select>-->									</td>
                                                <td width="8%">
                                                
                                               <div id="course">
                                               <?php
									
										if($opt=='quiz' || $opt=="")
										{
									?>
									<select  name='chapterid' onchange="javscript:chk(this.value)">
									<?php 
									$exams_chapters = new exams_chapters();
									if($id!="")
									{
									$chap = $exams_chapters->chapters_sel("chap_id",$id,$_SESSION['school_id']);
									//echo " hi<pre>";
									//print_r($chap);
									$row = $objSql->fetchRow($chap);
									//print_r($row);
									//$s3="select * from chapters where chapid=$id";
									//$re=mysql_fetch_object(mysql_query($s3));
									echo "<option value='$id~$cid'>".$row['chap_name']."</option>";
									
									echo "<option value='~'>Select All</option>";
									}
									else{
									echo "<option value='~'>Select Chapter</option>";
									}
									$s = $exams_chapters->chapters_all_select("chap_id",$_SESSION['school_id']);
									//$s="select * from chapters order by chapid";
									$ggg=0;
									//$w=mysql_query($s);
									while($ch=$objSql->fetchRow($s))
									{
									
									if($ch['chap_id']!=$id)
									echo "<option value='".$ch['chap_id']."~".$ch['course_id']."'>".$ch['chap_name']."</option>";
									}echo "</select>";
									}?></div>
                                                </td>
                                                </tr>
                                              </table>
                                            
                                            </td>
                                            </tr>
											<tr>
												<td colspan="5">
													<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tborder">
                                                    
                                                                                            

<tr class="row_1"><?php $_GET['or']?>
										                    <th width="5%" align="center" ><input type="checkbox" name="allChk" value="ON" onClick="CheckAll(this);"  class="input2" /></th>
                      <th width="10%" align="left" ><span >Grade</span><span class="style1"> </span></th>
                                            <th width="21%" align="left" ><span>Quiz </span></th>
                                            <th width="17%" align="left" ><strong>Cost</strong></th>
                      <th width="11%" align="left" ><strong>Discount</strong></th>
                       <th width="21%" align="left" ><strong>Coupon</strong></th>
                   
                      <th width="15%" align="left" ><span >Options</span></th>
                      <th width="15%" align="left" ><span >Status</span></th>
										              </tr>
                                                     <?php
                                      	if($opt=='quiz' || $opt=="")
										{
										
										if($rec==1)
										{ ?>
                                          <tr><td colspan="7" style="color:red" align="center">No Records Found</td></tr>
                                          <? }
										
										else
										{
										for($i=0;$i<=count($rec)-1;$i++){
										
											$test1 = $exams_test->test_select_two("test_id",$rec[$i]['test_id'],$_SESSION['school_id']);
											$test = $objSql->fetchRow($test1);
											$course1 = $exams_course->course_select('course_id',$rec[$i]['course_id']);
											$course = $objSql->fetchRow($course1);
											$grade1 = $exams_grades->grades_all_select($course['grade_id']);
											$grade=$objSql->fetchRow($grade1);
										?>    
                                                                           
                                          <tr>
                                             <td height="24" align="left" ><input  type="checkbox" name="Mid[]" id="<?php echo $rec[$i]['cost_id'];?>" value="642" class="input2" /></td>
                                          <td  align="left"><?php echo $grade['grade_name'];?></td>
										    <td   align="left" height="30"><?php echo $test['test_name'];?></td>
                                            <td  align="left"><?php echo $rec[$i]['cost'];?></td>
                                            <td  align="left"><?php echo $rec[$i]['general_discount'];?>
											</td>
                                            
                                            <td  align="left">
											<?php 
											//echo $s;
											//$q=mysql_fetch_object(mysql_query($s));
											if($rec[$i]['coupon']=="") echo "No Coupon"; else echo $rec[$i]['coupon'];?></td>
                                             <td align="left" >
                                             <?php if(!empty($_GET['id']) && !empty($_GET['cid'])){
											 $id=$_GET['id']; $cid=$_GET['cid']; ?>
                                                 <a href="course_modify.php?id=<?php echo $rec[$i]['cost_id'];?>&opt=quiz&chapid=<?php echo $id;?>&cid=<?php echo $cid?>&pageNumber=<?php echo $_REQUEST['pageNumber']; ?>"><img src="../images/edit.gif" border="0" alt="Edit Cost" title="Edit Cost"></a><!-- <a href="manage_course_chapters.php?cid=<?php echo $costobj['cost_id'];?>"><img src="images/active.gif" border="0" title="Manage Chapters" alt="Manage Chapters"></a>-->
                                                 
                                             <?php } else {?>
                                             <a href="course_modify.php?id=<?php echo $rec[$i]['cost_id'];?>&opt=quiz&pageNumber=<?php echo $_REQUEST['pageNumber']; ?>">
                                             <img src="../images/edit.gif" border="0" alt="Edit Cost" title="Edit Cost"></a>
                                            
                                             <?php } ?>
                                             </td>
                                             <td> <a href="action.php?cost_id=<?php echo $rec[$i]['cost_id'];?>&pageNumber=<?php echo $_REQUEST['pageNumber'];?>&status=<?php echo $rec[$i]['status'];?>"><?php echo $rec[$i]['status'];?></a>
                                             </td>
                                          </tr>
										  <?php
										  }
										  }
										  }?>
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

