<?php 
	session_start();
	
	
	include_once '../../../lib/class_ise_forums.php';
	include_once '../../../lib/db.php';
	$objSql1 = new SqlClass();
	
	//$blog = new Blog();
		$forums = new Forums();
	$al=".";
	if(!empty($_REQUEST['al']))
	{
		$al = $_REQUEST['al'];
	}
	if($_GET['id']!=''){
		$_SESSION['sub_forum_id']=$_GET['id'];
	}
	else {
		$_SESSION['sub_forum_id']=$_SESSION['sub_forum_id'];
	}
	 $totalEntries=$forums->totalNoOfforumcomms($_SESSION['sub_forum_id'],$al);
	
	
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
	$rec = $forums->display_subforum_comms($page,$al,$order,$_SESSION['sub_forum_id']);
/*	echo"<pre>";
	print_r($rec);*/
	
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
	
 function export1()
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
		location.href='export_blogs.php?exprt='+val12;
		return true;
		// document.getElementById('info_msg').innerHTML='Download Completed Successfully';
	}

</script>
</head>
<body>

	<form name="pageSelectionForm" id="pageSelectionForm" method="get" action="display_forum_comments.php">
		<input type="hidden" id="pageNumber" name="pageNumber" value=""/>
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
					<a href=""  class="active"> 
						Manage Comments
					</a> 
				</li> 
               <li> 
					<a href="<?php echo $admin_path;?>forums/subforums.php?id=<?php echo $_REQUEST['sid'];?>" class="active1"> 
						Back to subforums
					</a> 
				</li> 
				
			</ul>	
			<!-- End 1st level tab --> 
			<br class="clear"/> <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			<br class="clear"/> 
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
			
			
				
				<div class="content nomargin"  > 
				<form name="BlogSelectionForm" method="post" action="comments_action.php?al=<? echo $_REQUEST['al'];?>&pageNumber=<? echo $page; ?>&id=<?=$_SESSION['sub_forum_id']?>">
									<table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="global">
										<tbody>
										<tr>
												<td align="center" colspan="5"><h4><?php $forumtitle=$forums->get_forum($_SESSION['sub_forum_id']); echo ucfirst(substr($forumtitle['forum_name'],0,50));?> &nbsp;Commnets</h4></td>
											</tr>
											<tr><td width="100%" colspan="5" id="info_msg" ><?php echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td></tr>
											<tr>
												<td colspan="4" align="right"><input type="submit" name="sub3" value="Delete Review(s)" class="button_light" onclick="doselect1(); return false;" />
								                   <!-- <input type="button" name="sub" value="Export" class="button_light"  onclick="export1(); return false;" />-->
							                      <?php
													if(isset($_REQUEST['filename']))
													{
												?>
                                                	 <span style="padding-left:20px; color:#0000FF; font-weight:bold; padding-bottom:10px;">Your Export Completed Successfully, click here <a href="../exports/<?php echo $_REQUEST['filename']; ?>"><img src="../../images/download.gif" alt="" width="30" height="24" border="0" align="absmiddle" /></a> to Download</span>
                                                <?php
													}
												?>      
                                               </td><!--<td align="right">
                                                <?php breadcrum();?>
                                                </td>-->
											</tr>
											
											<tr>
												<td colspan="5">
													<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tborder">
                                                                                            

                  										<tr class="row_1"><?php $_GET['or']?>
										                    <th width="4%" align="center" ><input type="checkbox" name="allChk" value="ON" onclick="CheckAll(this);"  class="input2" /></th>
									                      <th width="24%" align="left" ><a href="index.php?order=<?php if(empty($_GET['order'])){?>1<?php }elseif($_GET['order'] == '1'){?>0<?php }?>" class="tablehead">Forum Comments</a>&nbsp;<?php if($_GET["order"]=='0') {?><img src="../images/up1.GIF" width="13" height="13" /><?php }else if($_GET["order"] == '1'){?><img src="../images/down1.GIF" width="13" height="13" /><?php }?></th>
                                                          <th width="23%" align="left" >Create Date </th>
                                                           
                                                            
									                      <th width="19%" align="left" ><a href="index.php?order=<?php if($_GET['order']=='2'){?>3<?php }else{?>2<?php }?>" class="tablehead"><b>Status</b></a>&nbsp;<?php if($_GET["order"] == '2') {?><img src="../images/up1.GIF" width="13" height="13" /><?php }else if($_GET["order"] == '3'){?><img src="../images/down1.GIF" width="13" height="13" /><?php }?></th>
                                                        <th width="30%" align="left" >Options </th>
										              </tr>
													  <?php 
														if($rec !='1')
														{
													  ?>
									                  <?php 
															$val=0;
															while($row = $objSql1->fetchRow($rec))
															{
																if($val == '0')
																{
																	$val = 1;
													  ?>
													  <tr class="row_white">
										                  <td height="24" align="center" ><input  type="checkbox" name="Mid[]" id="<?php echo $row['f_c_id'];?>" value="642" class="input2" /></td>
														  <td align="left">
                                          <?php echo ucfirst($row['f_c_desc']);?></td>
                                                           <td align="left"><?=$row['create_date'] ?></td>
                                                           
                                                           
										                  <td align="left">
                                                        <a href="comments_action.php?id_1=<?=$row['f_c_id']?>&state=<?=$row['status']?>&page=<?=$_REQUEST['pageNumber']?>&id=<?=$_SESSION['sub_forum_id']?>&<?php if(!empty($_REQUEST['al'])){echo "al=".$_REQUEST['al']."";} ?>">
														  
														  
														  <?php echo  $row['status'];?></a></td> 
                                                          <td>
                                                            <a href="view_forum_review.php?id=<?=$row['f_c_id']?>&page=<?=$_REQUEST['pageNumber']?>&<?php if(!empty($_REQUEST['al'])){echo "al=".$_REQUEST['al']."";} ?>&id1=<?php echo  $_SESSION['sub_forum_id']?>">
                                                            <img src="../../images/view_icon.png" height="20" width="20" border="0" title="View Commentss"/></a>                                                          </td>
									                  </tr>
									                  
													  <?php }
													  		else if($val == '1')
															{
																$val = 0;
													  ?>
													  <tr class="row_color">
										                  <td height="24" align="center" ><input  type="checkbox" name="Mid[]" id="<?php echo $row['f_c_id'];?>" value="642" class="input2" /></td>
														  <td align="left"><?php echo ucfirst($row['f_c_desc']);?></td>
                                                           <td align="left"><?=$row['create_date'] ?></td>

										                  <td align="left">
                                                          <a href="comments_action.php?id_1=<?=$row['f_c_id']?>&state=<?=$row['status']?>&page=<?=$_REQUEST['pageNumber']?>&id=<?=$_SESSION['sub_forum_id']?>&<?php if(!empty($_REQUEST['al'])){echo "al=".$_REQUEST['al']."";} ?>">
														  
														  <?php echo  $row['status'];?></a></td> 
                                                            <td>
                                                        <a href="view_forum_review.php?id=<?=$row['f_c_id']?>&page=<?=$_REQUEST['pageNumber']?>">
                                                        <img src="../../images/view_icon.png" height="20" width="20" border="0" title="View Commentss"/></a>                                                          </td>
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
														<td colspan="6"  class="row_white" align="right"><?php include_once"../paging.php";
															display_pag("display_forum_comments.php");
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

