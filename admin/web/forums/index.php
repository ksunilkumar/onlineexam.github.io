<?php 
 
	session_start();
	include_once '../../../lib/db.php';
	//include_once"../../../lib/admin_check.php";
	//include_once '../../../lib/functions_admin.php';
	//admin_login_check('0','Others');
	include_once '../../../lib/class_ise_forums.php';
	include_once '../../../lib/class_ise_users.php';
	include_once '../../../lib/ise_settings.class.php';
	
	$ise_settings=new ise_Settings();
	//include_once '../../../lib/functions.php';
	$objSql = new SqlClass();
 	$pagination_ise = new pagination_ise();
	//$ise_forums = new Forums();
	$ise_users = new ise_users();
	


		$al=".";
	if(!empty($_REQUEST['al']))
	{
		$al = $_REQUEST['al'];
	}

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
	if($_REQUEST['school']!='')
	$sid=$_REQUEST['school'];
	//echo $sid;exit;
	$forums=new Forums();
	$totalEntries=$forums->totalNoOfforums($al,0,$sid);
	$maxPages=ceil($totalEntries/perPage());
	$row = $forums->display_forums($page,$al,$order,$sid);		 
		 
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

function change_school(sid)
{
//alert(sid);
	document.schoolform.school.value=sid;
	document.schoolform.submit();
}



	function showPage(pageNumber)
	{
		document.getElementById("pageNumber").value=pageNumber;
		document.getElementById("pageSelectionForm").submit();
		return true;
	}
	function CheckAll(chk)
	{
	   //alert("hi");
	   var num=document.ForumSelectionForm.elements.length;
	   for(i=0;i<num;i++)
	   {
			tmp=document.ForumSelectionForm.elements[i];
			//alert(document.packages.elements[i].name);
			if(tmp.type=="checkbox" && !(tmp.name=="allChk"))
			{
				tmp.checked=chk.checked;
			}
		}
	}
	function addForum()
	{
	if(!confirm('Are you sure you want to add the Forum?\n- to Add the Forum, hit OK\n- otherwise, hit Cancel'))
	return false;
	
	javascript:location.href=('forums_new.php');
	}

	function send_select()
	{
		//alert("hi send");
		dml1=document.ForumSelectionForm;
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
		document.ForumSelectionForm.send.value=value12;
		document.ForumSelectionForm.submit();
		return true;
	}
	function doselect1()
	{
		dml1=document.ForumSelectionForm;
		
		len1 = dml1.elements.length;
		//alert(len1);
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
			//alert(val12);
		document.ForumSelectionForm.delet.value=val12;
		document.ForumSelectionForm.submit();
		return true;
	}
	
	function export1()
	{
		dml1=document.ForumSelectionForm;
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
			 if(!confirm('You are not selected any record, you want to export the all records?\n- to Export All Records, hit OK\n- otherwise, hit Cancel'))
				return false;

		}
		else
		{
		    if(!confirm('Are you sure you want to Export the Selected Records?\n- to Export the Records, hit OK\n- otherwise, hit Cancel'))
			 return false;
		}
		location.href='export_forums.php?exprt='+val12+'&school=<?php echo $sid;?>';
		return true;
	}
function hidediv(){
		document.getElementById('span_div').style.display='none';
		return true;
	}
</script>
</head>
<body>
	<form name="pageSelectionForm" id="pageSelectionForm" method="post" action="index.php">
		<input type="hidden" id="pageNumber" name="pageNumber"/>
		<input type="hidden" id="al" name="al" value="<?php echo $al;?>"/>
		<input type="hidden" id="order" name="order" value="<?php echo $order;?>"/>
        <input type="hidden" id="school" name="school" value="<?php echo $sid;?>"/>
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
					<a href="<?php echo $admin_path;?>forums/index.php"  class="active"> 
						Manage Forums
					</a> 
				</li> 
				<li> 
					<a href="<?php echo $admin_path;?>forums/forums_new.php" onclick="return addForum()" class="active1"> 
						Add Forum
					</a> 
				</li> 
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/> <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
			
			
				
				<div class="content nomargin"  > 
				<form name="ForumSelectionForm" method="post" action="delete_forums.php">
                <input type="hidden" id="pageNumber" name="pageNumber" value="<?php echo $page?>"/>
		<input type="hidden" id="al" name="al" value="<?php echo $al;?>"/>
				<table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="global">
										<tbody>
									  <!--	<tr>
												<td align="center" colspan="5"><h2>Forums</h2></td>
											</tr>-->
											<tr><td width="100%" colspan="5"><?php echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td></tr>
											
										
											<tr>
												<td colspan="5" align="right">
                                                 <?php
													if(isset($_REQUEST['filename']))
													{
												?>
                                                	 <span style="padding-left:20px; color:#0000FF; font-weight:bold; padding-bottom:10px;" id="span_div">Your Export Completed Successfully, click here <a href="../exports/<?php echo $_REQUEST['filename']; ?>"><img src="../../images/download.gif" alt="" width="30" height="24" border="0" align="absmiddle" onclick="return hidediv();" /></a> to Download</span>
                                                <?php
													}
												?>     
                                                <label><font>SEARCH BY SCHOOL:</font></label><?php if(!empty($_REQUEST)){echo $ise_settings->get_admin_sel_schools($_REQUEST['school']);}else{echo $ise_settings->get_admin_schools();}?>   
									                <!--<input type="button" name="sub1" value="Add Forum(s)" class="button_light"  />-->
													<input type="submit" name="sub3" value="Delete Forum(s)" class="button_light" onclick="doselect1(); return false;" style="cursor:pointer;"/>
													<input type="button" name="sub2" value="Export" class="button_light" onclick="export1(); return false;" style="cursor:pointer;"/>																				                     
</td><!--<td align="right"><?php breadcrum();?></td>-->
											</tr>
                                          <tr>
												<td colspan="5">
													<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tborder">
                                                                                 

                  										<tr class="row_1"><?php $_GET['or']?>
										                    <th width="5%" align="center" ><input type="checkbox" name="allChk" value="ON" onclick="CheckAll(this);"  class="input2" /></th>
										                    <th width="30%" align="left" ><a href="index.php?al=<?php echo $al;?>&order=<?php if(empty($_GET['order'])){?>1<?php }elseif($_GET['order'] == '1'){?>0<?php }?>" class="tablehead"><b>Forum Title</b></a>&nbsp;<?php if($_GET["order"]=='0') {?><img src="../images/up.GIF" width="13" height="13" /><?php }else if($_GET["order"] == '1'){?><img src="../images/down1.GIF" width="13" height="13" /><?php }?></th>
                                                            <th width="35%" align="left" ><b>Forum Desc</b></th>
															
                                                            <th width="10%" align="left" ><b>No of Comments</b></th>
                                                             <th width="10%" align="left" ><b>No of SubForums</b></th>
														
										                    <th width="5%" align="left" ><a href="index.php?al=<?php echo $al;?>&order=<?php if($_GET['order']=='6'){?>7<?php }else{?>6<?php }?>" class="tablehead"><b>Status</b></a>&nbsp;<?php if($_GET["order"] == '6') {?><img src="../images/up.GIF" width="13" height="13" /><?php }else if($_GET["order"] == '7'){?><img src="../images/down1.GIF" width="13" height="13" /><?php }?></th>
										              </tr>
													  <?php 
														if(is_array($row))
														{	
													  ?>
									                  <?php 
															for($i=0;$i<count($row);$i++){
															
															{
																if($i%2!= '0')
																{ ?>
                                                                <tr class="row_white">
                                                                <? }else{?>
                                                                <tr class="row_color">
																	
													 <? }?>
													 
										                  <td height="24" align="center" ><input  type="checkbox" name="Mid[]" id="<?php echo $row[$i]['forum_id'];?>" value="642" class="input2" /></td>
														  <td align="left"><a href="forums_modify.php?id=<?php echo $row[$i]['forum_id'];?>&pageNumber=<?php echo $_REQUEST['pageNumber'];?>&al=<?php echo $_REQUEST['al'];?>"><?php echo substr($row[$i]['forum_name'],0,90);?></a></td>
                                                          <td align="left"><?php if($row[$i]['forum_description']!='')echo substr($row[$i]['forum_description'],0,200);else echo "NO Description"?></td>
														 <td align="left"> <?php echo $totalEntries1=$forums->totalNoOfforumcomments($row[$i]['forum_id']);?>&nbsp;  <a href="display_forum_comments.php?id=<?php echo $row[$i]['forum_id']?>&page=<?=$_GET['page']?>">
                                         
                                         
                                         <img src="../../images/view_icon.png" height="20" width="20" border="0" title="View Comments"/></a></td>
										 <td align="left"><?php echo $totalEntries=$forums->totalNoOfforums_export($row[$i]['forum_id']);?>&nbsp;<a href="subforums.php?id=<?=$row[$i]['forum_id']?>"><img src="../../images/view_icon.png" height="20" width="20" border="0" title="View SubForums"/></a>
                                         
                                         
                                       </td>
										                  <td align="left"><a href="delete_forums.php?<?php if(!empty($_REQUEST['al'])){echo "al=".$_REQUEST['al']."&";} ?>id=<?php echo $row[$i]['forum_id']?>&state=<?php echo $row[$i]['status'];?>&page=<?php echo $page; ?>&order=<?php echo $order;?>"><?php echo  $row[$i]['status'];?></a></td> 

									                  </tr>
													  
													  
													 <?php } 
													 }
													 ?>
													 <?php
													}else{?>
													 <tr class="row_white"><td align="center" colspan="7" style="color:#FF0000;">No records Found.</td></tr>
													 <?php } ?>
													</table>
												</td>
											</tr>
                                                           <tr>
														<td colspan="6"  class="row_white" align="right">
															<?php include_once"paging.php";
															display_pag('index.php');
															/*if(!empty($_GET['al']) || isset($_GET['al'])){
														 $pos = strpos($_SERVER['REQUEST_URI'],'&al');
														if($pos==''){
														 $pos = strpos($_SERVER['REQUEST_URI'],'al');
														}
														  $url=substr($_SERVER['REQUEST_URI'],0,$pos);
														display_pag($url);
														//echo $_SERVER['REQUEST_URI'];
														} else 
															display_pag($_SERVER['REQUEST_URI']);*/
															?>
                                                            </td>
											</tr>
										</tbody>
									</table>
								<input type="hidden" name="send" /><input type="hidden" name="delet"><input type="hidden" name="send_status" />
									</form>
                                     <form action="" method="post" name="schoolform" id="schoolform">
                 <input type="hidden" name="school" id="school" /></form><br class="clear"/>
									
				    <?php include '../pageNation.php';?>	
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
