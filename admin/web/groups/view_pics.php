<?php 
	session_start();
	include_once '../../../lib/db.php';
	/*include_once"../../../lib/admin_check.php";
	admin_login_check('0','admin');*/
	include_once '../../../lib/calss_ise_groups.php';
	include_once '../../../lib/calss_ise_users.php';
	include_once '../../../lib/functions_admin.php';
	include_once '../../../lib/functions.php';
	$objSql = new SqlClass();
	$ise_groups = new ise_groups();
	$ise_users = new ise_users();
	
	
     $al=".";
	//if(!empty($_REQUEST['al']))
	//{
		//$al = $_REQUEST['al'];
	//}
	$grp_pic=new grp_pic();
	$totalEntries=$grp_pic->totalNoOfgrp_pic();
	$maxPages=ceil($totalEntries/perPage());
	$page=1;
	if(!empty($_REQUEST['pageNumber'])){
		$page=$_REQUEST['pageNumber'];
	}
	$order=0;
	if(!empty($_REQUEST['order'])){
		$order=$_REQUEST['order'];
	}
	$rec = $grp_pic->display_grp_pic($page,$order);	
	/*echo"<pre>";
	print_r($rec);*/
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
 
<!-- Website Title --> 
 
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
 
</head> 
<body>

<link href="../images/style.css" rel="stylesheet" type="text/css">
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
	   var num=document.grp_pic.elements.length;
	   for(i=0;i<num;i++)
	   {
			tmp=document.client.elements[i];
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
		dml1=document.grp_pic;
		len1 = dml1.elements.length;
		var j=0;
		var value12='send';
		select_status=0;
		for( j=0 ; j<len1 ; j++)
		 {
			if (dml1.elements[j].name=='Mid[]')
			 {
				if((dml1.elements[j].checked))
				{
					select_status=1;
					value12=value12+","+dml1.elements[j].id;
				}
			}
		}
		if(select_status==0)
		{
			alert("Select atleast one record");
			return false;
		}
		//alert("alert");
		document.grp_pic.send.value=value12;
		document.grp_pic.submit();
		return true;
	}
	function export1()
	{
	 self.location('export_group.php');
	}
	function doselect1()
	{
		dml1=document.grp_pic;
		len1 = dml1.elements.length;
		var j=0;
		var val12='delet';
		select_status=0;
		for( j=0 ; j<len1 ; j++)
		 {
			if (dml1.elements[j].name=='Mid[]')
			 {
					if((dml1.elements[j].checked))
					{
					select_status=1;
					val12=val12+","+dml1.elements[j].id;
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
			
		document.grp_pic.delet.value=val12;
		document.grp_pic.submit();
		return true;
	}
	
function popup(url)
	{
		newwindow=window.open(url,'News Image','height=300,width=400');
		if (window.focus) {newwindow.focus()}
	}

	
	
</script>
</head>
<body>
	<form name="pageSelectionForm" id="pageSelectionForm" method="post" action="view_pics.php">
		<input type="hidden" id="pageNumber" name="pageNumber"/>
        <input type="hidden" id="al" name="al" value="<?php echo $al;?>"/>
		<input type="hidden" id="order" name="order" value="<?php echo $order;?>"/>
        <input type="hidden" id="id" name="id" value="<?php echo $_REQUEST['id'];?>" />
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
					<a href="<?php echo $admin_path;?>groups/index.php" class="active"> 
						Manage Groups
					</a> 
				</li>
				<li> 
					<a href="<?php echo $admin_path;?>groups/new.php"> 
						 Add Groups
					</a> 
				</li> 
				
			</ul>		
			<!-- End 1st level tab --> 
			
			<br class="clear"/> 
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
			
			
				
				<div class="content nomargin"  > 
					
					<!-- Begin example table data --> 
                  <form name="grp_pic" method="post" action="action_pics.php?al=<? echo $_REQUEST['al'];?>&page=<? echo $page; ?>&group_id=<? echo $_REQUEST['id']; ?>">
					<table class="global" width="100%"  cellpadding="0" cellspacing="0"> 
						<thead>
                 
						 <tr><td width="100%" colspan="5"><?php echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td></tr>
											<tr>
												<td colspan="4" align="right">
                                                <!--<input type="button" name="sub1" value="Add group" class="button"   onclick="return addgroup()" />-->
									               <input type="submit" name="sub3" value="Delete pictures" class="button_light" onclick="doselect1(); return false;" />
								              <!--   <input type="button" name="sub" value="Export" class="button"  onclick="export1(); return false;" />-->
                                                                                                    
                                                </td><!--<td  align="right"><?php breadcrum();?></td>-->
											</tr>
                                           
											<tr>
											  <td colspan="5">
													<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tborder">
												
                  									  <tr class="row_1">
										                    <th width="10%" align="left" >
                                                            <input type="checkbox" name="allChk" value="ON" onclick="CheckAll(this);"  class="input2" /></th>
										                    <th width="30%" align="left" ><a href="view_pics.php?al=<?php echo $al;?>&order=<?php if($order==0){?>1<?php }else{?>0<?php }?>" class="tablehead"><span class="vote">User Name</span></a>&nbsp;<?php if($order==0) {?><img src="../images/up1.GIF" width="13" height="13" /><?php }else if($order == '1'){?><img src="../images/down1.GIF" width="13" height="13" /><?php }?></th>
									                    <th width="30%" align="left" ><a href="view_pics.php?al=<?php echo $al;?>&order=<?php if($order==0){?>1<?php }else{?>0<?php }?>" class="tablehead"><span class="vote">Photo</span></a>&nbsp;<?php if($order==0) {?><img src="../images/up1.GIF" width="13" height="13" /><?php }else if($order == '1'){?><img src="../images/down1.GIF" width="13" height="13" /><?php }?></th>
                                                        <th width="10%" align="left" ><a href="view_pics.php?al=<?php echo $al;?>&order=<?php if($order==6){?>7<?php }else{?>6<?php }?>" class="tablehead">Status</a>&nbsp;<?php if($order == '6') {?><img src="../images/up1.GIF" width="13" height="13" /><?php }else if($order == '7'){?><img src="../images/down1.GIF" width="13" height="13" /><?php }?></th>
										              </tr>
													  <?php 
														if($rec !='1')
														{
													  ?>
									                  <?php 
															$val=0;
															$objSql1 = new SqlClass();
															while($row = $objSql1->fetchRow($rec))
															{
															
													  ?>
													  <tr class="row_white">
										                  <td height="24" align="left" ><input  type="checkbox" name="Mid[]" id="<?php echo $row['pic_id'];?>" value="642" class="input2" /></td>
														  <td align="left">
														  <?php $val = $ise_users->ise_users_select('username','studentid',$row['user_id']);print_r($val);?>
													  
														</td>
                                                        <td align="left">
                                                      <?php if($row->upload_type == 'photo') { ?><a href="#" onclick="popup('../../../uploads/groups/grp_pics/<?=$row->gp_photo_path?>')"><img height="55" width="60" src="../../../uploads/groups/grp_pics/<?=$row->gp_photo_path?>" border="0"  /></a><?php } elseif($row->upload_type == 'docs') { ?><a href="../../uploads/groups/grp_docs/<?=$row->gp_photo_path?>" target="_blank" >View doc</a><?php } ?></td>
										                 
										                 
										                  <td align="left">
                                                         
                                                          <a href="action_pics.php?<?php if(!empty($_REQUEST['al'])){echo "al=".$_REQUEST['al']."&";}if(!empty($_REQUEST['or'])){echo "or=".$_REQUEST['or']."&";}?>id_1=<?=$row['pic_id']?>&id=<?=$row['pic_id']?>&group_id=<?php echo $row['group_id'];?>&state=<?php echo $row['status'];?>&page=<?php echo $page; ?>&order=<?php echo $order;?>">
														  <?=$row['status'];?></a>
                                                          <a href="action_pics.php?<?php if(!empty($_REQUEST['al'])){echo "al=".$_REQUEST['al']."&";}if(!empty($_REQUEST['or'])){echo "or=".$_REQUEST['or']."&";}?>id=<?php echo $row['pic_id']?>&group_id=<?php echo $row['group_id'];?>&state=<?php echo $row['status'];?>&page=<?php echo $page; ?>&order=<?php echo $order;?>"></a></td>
                                                          
                                                          									                  </tr>
													  
													 <?php 
													 }
													 ?>
													 <?php
													}else{?>
													 <tr class="row_white"><td align="center" colspan="4" style="color:#FF0000;">No records Found.</td></tr>
													 <?php } ?>
											  </table>											  </td>
											</tr>
                                            	<tr>
														<!--<td colspan="5"  class="row_white" align="right"><?php //include_once"paging.php";
															//display_pag("index.php");
															?></td>-->
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