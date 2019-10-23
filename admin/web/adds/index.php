<?php 
	session_start();
	include_once '../../../lib/db.php';
	//include_once"../../../lib/admin_check.php";
	//admin_login_check('0','admin');
	
	include_once '../../../lib/ise_settings.class.php';
	
	$objSql = new SqlClass();
	$ise_settings=new ise_Settings();
	

	

$al=".";
	if(!empty($_REQUEST['al']))
	{
		$al = $_REQUEST['al'];
	}
	
	
	$order=0;
	if(!empty($_REQUEST['order'])){
		$order=$_REQUEST['order'];
	}
	//echo $sid;
	$totalEntries=$ise_settings->totalNoOfadds();
	$maxPages=ceil($totalEntries/perPage());
	//echo $maxPages;exit;
	$page=1;
	if(!empty($_REQUEST['pageNumber'])){
		$page=$_REQUEST['pageNumber'];
	}
	$rec = $ise_settings->display_adds($page);	

	
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
 
<title>IsmartExams :: Admin</title></head> 
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
	   var num=document.group.elements.length;
	   for(i=0;i<num;i++)
	   {
			tmp=document.group.elements[i];
			//alert(document.packages.elements[i].name);
			if(tmp.type=="checkbox" && !(tmp.name=="allChk"))
			{
				tmp.checked=chk.checked;
			}
		}
	}
	/*
	function send_select()
	{
		//alert("hi send");
		dml1=document.group;
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
		document.group.send.value=value12;
		document.group.submit();
		return true;
	}*/
	
	function doselect1()
	{
		dml1=document.group;
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
			
		document.group.delet.value=val12;
		document.group.submit();
		return true;
	}
	function addgroup()
	{
		
		if(!confirm('Are you sure you want to add the Image?\n- to Add the  Image, hit OK\n- otherwise, hit Cancel'))
		return false;
		//javascript:location.href=('new.php');
	}
		
		
</script>
</head>
<body>
	<form name="pageSelectionForm" id="pageSelectionForm" method="post" action="index.php">
		<input type="hidden" id="pageNumber" name="pageNumber"/>
       
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
					<a href="<?php echo $admin_path;?>adds/index.php" class="active"> 
						Manage Adds
					</a> 
				</li>
				<!--<li> 
					<a href="<?php echo $admin_path;?>adds/new.php" class="active1"  onclick="return addgroup()"> 
						 Add NewADD
					</a> 
				</li> -->
				
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/> <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
			
			
				
				<div class="content nomargin"  > 
					
					<!-- Begin example table data --> 
                  <form name="group" method="post" action="action.php?al=<? echo $_REQUEST['al'];?>&page=<? echo $page; ?>">
					<table class="global" width="100%"  cellpadding="0" cellspacing="0"> 
						<thead>
                 
						 <tr><td width="100%" colspan="5"><b><?php echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></b></td></tr>
											<tr>
												<td colspan="5" align="right">
                                                
                                               
                                                
									               <input type="submit" name="sub3" value="Delete Add(s)" class="button_light" onclick="doselect1(); return false;" style="cursor:pointer" />
								              		
                                                                                                    
                                                </td><!--<td  align="right"><?php breadcrum();?></td>-->
											</tr>
                                           
											<tr>
												<td colspan="5">
													<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tborder">
												
                  									  <tr class="row_1">
										                    <th width="5%" align="left" >
                                                            <input type="checkbox" name="allChk" value="ON" onclick="CheckAll(this);"  class="input2" /></th>
										                    <th width="15%" align="left" ><span class="vote">Image</span>&nbsp;</th>
									                    
									                   <!-- <th width="15%" align="left" ><a href="index.php?al=<?php echo $al;?>&order=<?php if($order==6){?>7<?php }else{?>6<?php }?>&school=<?php if($sid!='') echo $sid; else echo '.';?>" class="tablehead">Status</a>&nbsp;<?php if($order == '6') {?><img src="../images/up.GIF" width="13" height="13" /><?php }else if($order == '7'){?><img src="../images/down1.GIF" width="13" height="13" /><?php }?></th>-->
                                                       
										              </tr>
													  <?php 
														if($rec !='1')
														{
													  ?>
									                  <?php 
															$val=1;
															$objSql1 = new SqlClass();
															while($row = $objSql1->fetchRow($rec))
															{
																
																															
																if($val%2=='0'){ ?>
                                                                <tr class="row_white">
																<?php }else{ ?>
                                                                <tr class="row_color">
																<?php 
																}
																
																if($row['url']!='' && file_exists("../../../uploads/adds/".$row['url']))
																$image=$row['url'];
																else
																$image='ads.jpg';
																	
													  ?>
													 
										                  <td height="24" align="left" ><input  type="checkbox" name="Mid[]" id="<?php echo $row['id'];?>" value="642" class="input2" /></td>
														  <td align="left">
														   <a href="edit.php?id=<?php echo $row['id'];?>"><img src="../../../uploads/adds/<?=$image;?>" height="120" width="150" border="0"/></a> 
														  </td>
                                                          
                                                        
														
										               
										                 <!-- <td align="left">
                                                         
                                                          <a href="action.php?<?php if(!empty($_REQUEST['al'])){echo "al=".$_REQUEST['al']."&";}if(!empty($_REQUEST['or'])){echo "or=".$_REQUEST['or']."&";}?>&id=<?=$row['id']?>&state=<?php echo $row['status'];?>&page=<?php echo $page; ?>&order=<?php echo $order;?>">
														  <?=$row['status'];?></a>
                                                          <a href="action.php?<?php if(!empty($_REQUEST['al'])){echo "al=".$_REQUEST['al']."&";}if(!empty($_REQUEST['or'])){echo "or=".$_REQUEST['or']."&";}?>id=<?php echo $row['id']?>&state=<?php echo $row['status'];?>&page=<?php echo $page; ?>&order=<?php echo $order;?>"></a></td>-->
                                                          
                                                          
                                                            
                                                            
                                                             
                                                               
									                  </tr>
													  <?php 
													$val++;  		
													 }
													 ?>
													 <?php
													}else{?>
													 <tr class="row_white"><td align="center" colspan="9" style="color:#FF0000;">No Adds Found.</td></tr>
													 <?php } ?>
											  </table>											  </td>
											</tr>
                                            	
                                                     
                                                        
						</tbody> 
					</table> 
					<input type="hidden" name="send" /><input type="hidden" name="delet"><input type="hidden" name="send_status" />
				  </form>
				    <?php include '../pageNation.php';?>	
				
                
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