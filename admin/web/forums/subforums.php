<?php 
	session_start();
	//include_once '../../../lib/functions.php';
	//include_once '../../../lib/forums_class.php';
	include_once '../../../lib/db.php';
	include_once '../../../lib/class_ise_forums.php';
	include_once '../../../lib/ise_settings.class.php';
	include_once '../../../lib/users_class.php';
	$objSql1 = new SqlClass();
	//admin_login_check();
	$forums = new Forums();
	$settings = new ise_Settings();
$user=new Users();
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
$id=$_REQUEST['id'];
	
	
	     $sq123 = "SELECT forum_name,school_id FROM ise_forums WHERE forum_id = '".$_GET['id']."'";
		 //echo $sq123;
		 $recor123 = $objSql1->executeSql($sq123);
		$row123 = $objSql1->fetchRow($recor123);
		$sid=$row123['school_id'];
		//echo $sid;exit;
		
		
		$totalEntries=$forums->totalNoOfforums($al,$id,$sid);
	$maxPages=ceil($totalEntries/perPage());
	$row = $forums->display_subforums($id,$page,$order,$al);
		//echo $row123['forum_name'];
		//exit;
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
	if(!confirm('Are you sure you want to add the Sub Forum?\n- to Add the Forum, hit OK\n- otherwise, hit Cancel'))
	return false;
	
	javascript:location.href=('subforums_new.php?id=<?=$id?>');
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
			//alert(val12);return false;
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
		location.href='export_subforums.php?exprt='+val12+'&forumid=<?php echo $_GET['id']?>';
		return true;
	}
	function hidediv(){
		document.getElementById('span_div').style.display='none';
		return true;
	}
</script>
</head>
<body>
	<form name="pageSelectionForm" id="pageSelectionForm" method="post" action="subforums.php?id=<?php echo $_REQUEST['id'];?>&al=<?php echo $_REQUEST['al'];?>">
		<input type="hidden" id="pageNumber" name="pageNumber" value=""/>
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
					<a href="<?php echo $admin_path;?>forums/subforums.php?id=<?php echo $id;?>"  class="active"> 
						Manage Sub Forums
					</a> 
				</li> 
				<li> 
					<a href="<?php echo $admin_path;?>forums/addsubforum.php?id=<?php echo $id;?>" onclick="return addForum()"> 
						Add Sub Forum
					</a> 
				</li> 
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/>  <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
			
			
				
				<div class="content nomargin"  > 
				<form name="ForumSelectionForm" method="get" action="delete_subforums.php">
                <input type="hidden" name="page" id="page" value="<?php echo $page;?>" />
						<table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="global">
										<tbody>
											<tr>
												<td align="center" colspan="5"><h2><?= $row123['forum_name']?>&nbsp;&nbsp;Sub Forums</h2></td>
											</tr>
                                   <!--   <tr align="right">
												<td colspan="6"><?php
/*if (isset($HTTP_REFERER)) {
echo "<a href='$HTTP_REFERER'>Back to list</a>";
} else {
echo "<a href='javascript:history.back()'>Back to list</a>";
}*/ 
?></td>
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
									               <!-- <input type="button" name="sub1" value="Add SubForums" class="button_light"  />-->
									                <input type="submit" name="sub3" value="Delete" class="button_light" onclick="doselect1(); return false;" style="cursor:pointer;"/>
							                   <input type="button" name="sub2" value="Export" class="button_light" onclick="export1(); return false;" style="cursor:pointer;"/>																				                    </td>
											</tr>
                                            
										

											<tr>
												<td colspan="5">
													<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tborder">
                                                                                             

                  										<tr class="row_1"><?php $_GET['or']?>
										                    <th width="4%" align="center" ><input type="checkbox" name="allChk" value="ON" onclick="CheckAll(this);"  class="input2" /></th>
									                      <th width="23%" align="left" ><a href="subforums.php?id=<?php echo $_GET['id'];?>&al=<?php echo $al;?>&order=<?php if(empty($_GET['order'])){?>1<?php }elseif($_GET['order'] == '1'){?>3<?php }?>" class="tablehead"><b>Sub Forum Title</b></a>&nbsp;<?php if($_GET["order"]=='0') {?><img src="../images/up.GIF" width="13" height="13" /><?php }else if($_GET["order"] == '1'){?><img src="../images/down1.GIF" width="13" height="13" /><?php }?></th>
                                                          <th width="21%" align="left" ><a href="subforums.php?id=<?php $_GET['id'];?>&al=<?php echo $al;?>&order=<?php if(empty($_GET['order'])){?>1<?php }elseif($_GET['order'] == '1'){?>0<?php }?>" class="tablehead"><b>Forum Desc</b></a>&nbsp;<?php if($_GET["order"]=='0') {?><img src="../images/up1.GIF" width="13" height="13" /><?php }else if($_GET["order"] == '1'){?><img src="../images/down1.GIF" width="13" height="13" /><?php }?></th>
														<th width="19%" align="left" ><a>Created By </a></th>
						                
										                    <th width="16%" align="left" ><a href="subforums.php?id=<?php echo $_GET['id'];?>&al=<?php echo $al;?>&order=<?php if($_GET['order']=='6'){?>7<?php }else{?>6<?php }?>" class="tablehead"><b>Status</b></a>&nbsp;<?php if($_GET["order"] == '6') {?><img src="../images/up1.GIF" width="13" height="13" /><?php }else if($_GET["order"] == '7'){?><img src="../images/down1.GIF" width="13" height="13" /><?php }?></th>
                                                             <th width="19%" align="left" ><a>Options </a></th>
										              </tr>
													  <?php 
														if(is_array($row))
														{	/*echo "<pre>";
														print_r($row);exit;*/
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
														  <td align="left"><a href="subforums_modify.php?id=<?php echo $row[$i]['forum_id'];?>&pid=<?=$_GET['id']?>&<?php if(!empty($_REQUEST['al'])){echo "al=".$_REQUEST['al']."";} ?>"><?php echo substr($row[$i]['forum_name'],0,100);?></a></td>
                                                          <td align="left"><?php echo substr($row[$i]['forum_description'],0,200);?></td>
														 
														  <td align="left"><?php if($row[$i]['createdby']==0){echo "Admin";} else{ $username=$user->user_name($row[$i]['createdby']); echo "<pre>";print_r($username);}?></td>
										                  <td align="left">
                               <a href="delete_subforums.php?<?php if(!empty($_REQUEST['al'])){echo "al=".$_REQUEST['al']."&";} ?>id=<?php echo $row[$i]['forum_id']?>&state=<?php echo $row[$i]['status'];?>&page=<?php echo $page; ?>&order=<?php echo $order;?>">
														  <?php echo  $row[$i]['status'];?></a></td> 
                                                           <td><a href="display_subforum_comments.php?sid=<?php echo $_GET['id'];?>&id=<?php echo $row[$i]['forum_id']?>&page=<?=$_GET['page']?>"><?php echo $totalEntries=$forums->totalNoOfforumcomments($row[$i]['forum_id']);?>&nbsp;<img src="../../images/view_icon.png" height="20" width="20" border="0" title="View Commentss"/></a></td>
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
                                                      	<?php include_once "../paging1.php";
															display_pag('subforums.php?id='.$_REQUEST['id']);
														
															?>                                                            </td>
											</tr>
										</tbody>
									</table>
<input type="hidden" name="send" /><input type="hidden" name="delet"><input type="hidden" name="send_status" />
									</form>
									
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
	
	