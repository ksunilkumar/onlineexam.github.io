<?php 

	session_start();
	include_once '../../../lib/db.php';
	include_once"../../../lib/admin_check.php";
	include_once"../../../lib/functions_admin.php";
	include_once"../../../lib/functions.php";
	admin_login_check('0','Others');
	include_once '../../../lib/class_ise_users.php';
	include_once '../../../lib/class_ise_faqs.php';
	$objSql1 = new SqlClass();
	$ise_users = new ise_users();
	$careers= new ise_faqs();
	
	
	$al=" ";
	if(!empty($_REQUEST['al']))
	{
		$al = $_REQUEST['al'];
	}

	
$totalEntries=$careers->totalNoOfFaqs($al);
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
	
	$rec = $careers->display_faqs($page,$al,$order);

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
	function addNews()
	{
		if(!confirm('Are you sure you want to add the Faqs?\n- to Add the Faqs, hit OK\n- otherwise, hit Cancel'))
		return false;
	
	javascript:location.href=('faq_new.php');
	}

	function CheckAll(chk)
	{
	   //alert("hi");
	   var num=document.newsSelectForm.elements.length;
	   for(i=0;i<num;i++)
	   {
			tmp=document.newsSelectForm.elements[i];
			//alert(document.packages.elements[i].name);
			if(tmp.type=="checkbox" && !(tmp.name=="allChk"))
			{
				tmp.checked=chk.checked;
			}
		}
	}
	function doselect1()
	{
		dml1=document.newsSelectForm;
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
		document.newsSelectForm.delet.value=val12;
		document.newsSelectForm.submit();
		return true;
	}

function export1()
	{
		dml1=document.newsSelectForm;
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
		//alert('export_faqs.php?exprt='+val12+'&pageNumber=<?php echo $page;?>');
		location.href='export_faqs.php?exprt='+val12+'&pageNumber=<?php echo $page;?>';
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
					<a href="<?php echo $admin_path;?>faqs/index.php"  class="active"> 
						Manage Faq's
					</a> 
				</li> 
				<li> 
					<a href="<?php echo $admin_path;?>faqs/faq_add.php" onclick="return addNews()"> 
						Add Faq
					</a> 
				</li> 
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/> <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
			
			
				
				<div class="content nomargin"  > 
			<form name="newsSelectForm" method="post" action="faqs_action.php?al=<? echo $_REQUEST['al'];?>&page=<? echo $page; ?>">
									<table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="global">
										<tbody>
											<!--<tr>
												<td align="center" colspan="5"><h2>News</h2></td>
											</tr>-->
											<tr><td width="100%" colspan="5"><?php echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td></tr>
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
													<!--<input type="button" name="sub1" value="Add Faq" class="button_light" onclick="return addNews()" />-->
									                <input type="submit" name="sub3" value="Delete Faq(s)" class="button_light" onclick="doselect1(); return false;" style="cursor:pointer" />
									                <input type="button" name="sub2" value="Export" class="button_light" onclick="export1(); return false;" style="cursor:pointer"/>																				                   
                                                  
</td><!--<td align="right"><?php breadcrum();?></td>-->
											</tr>
											

											<tr>
												<td colspan="5">
													<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tborder">
                                                                                                                                           

                  										<tr class="row_1"><?php $_GET['or']?>
										                    <th width="7%" align="left" ><input type="checkbox" name="allChk" value="ON" onclick="CheckAll(this);"  class="input2" /></th>
										                    <th width="27%" align="left" ><a href="index.php?al=<?php echo $al;?>&order=<?php if($_GET['order']=='4'){?>1<?php }elseif($_GET['order'] == '1'){?>4<?php }elseif($_GET['order'] == ''){?>1<?php }?>" class="tablehead"><span class="vote">Question</span></a>&nbsp;<?php if($_GET["order"]=='1') {?><img src="../images/up.GIF" width="13" height="13" /><?php }else if($_GET["order"] == '4'){?><img src="../images/down1.GIF" width="13" height="13" /><?php }?></th>
                                                           <!-- <th width="17%"><a class="tablehead">User Name</a></th>-->
                                                          <th width="10%" align="left" ><a class="tablehead">Date</a></th>
									                      <th width="18%" align="left" ><a href="index.php?al=<?php echo $al;?>&order=<?php if($_GET['order']=='2'){?>3<?php }else{?>2<?php }?>" class="tablehead">Status</a>&nbsp;<?php if($_GET["order"] == '2') {?><img src="../images/up1.GIF" width="13" height="13" /><?php }else if($_GET["order"] == '3'){?><img src="../images/down1.GIF" width="13" height="13" /><?php }?></th>
                                                          <th width="21%" align="left" ><a class="tablehead">Options</a></th>
										              </tr>
													  <?php 
														if($rec !='1')
														{
													  ?>
									                  <?php 
															$val=0;
															while($row = $objSql1->fetchRow($rec))
															{
																
																/*if($val == '0')
																{
																	$val = 1;*/
													  ?>
													  <tr class="<?php if($val%2==0) echo 'row_white'; else echo 'row_color';?>">
										                  <td height="24" align="left" ><input  type="checkbox" name="Mid[]" id="<?php echo $row['faq_id'];?>" value="642" class="input2" /></td>
														  <td align="left"><a href="faqs_modify.php?id=<?php echo $row['faq_id'];?> &pageNumber=<?php echo $_REQUEST['pageNumber'];?>&al=<?php echo $_REQUEST['al'];?>"><?php echo ucfirst(substr($row['faq_question'],0,100));?></a><a href="careers_modify.php?id=<?php echo $row['faq_id'];?>"></a></td>
                                                       <!-- <td><?php if($row['user_id']!='0'){$val = $ise_users->ise_users_select('username','studentid',$row['user_id']);echo $val;}else{echo 'Admin';}?></td>-->
                                                          <td align="left"><?php echo $row['create_date'];?></td>
										                  <td align="left">
                                                          <a href="faqs_action.php?<?php if(!empty($_REQUEST['al'])){echo "al=".$_REQUEST['al']."&";} ?>id=<?php echo $row['faq_id']?>&state=<?php echo $row['status'];?>&page=<?php echo $page; ?>&order=<?php echo $order;?>">
														  <?php echo  $row['status'];?></a>                                                        </td> 
                                                          <td  height="24" align="left" ><a href="view_faqs.php?id=<?=$row['faq_id'] ?>&pageNumber=<?=$_REQUEST['pageNumber']?>&<?php if(!empty($_REQUEST['al'])){echo "al=".$_REQUEST['al']."";} ?>">
                                                          <img src="../../images/view_icon.png" height="20" width="20" border="0" title="View Faqs"/></a></td>
									                  </tr>
													  <?php /*}
													  		else if($val == '1')
															{
																$val = 0;
													  ?>
													  <tr class="row_color">
										                  <td height="24" align="left" ><input  type="checkbox" name="Mid[]" id="<?php echo $row['faq_id'];?>" value="642" class="input2" /></td>
														  <td align="left">
                                                          <a href="faqs_modify.php?id=<?php echo $row['faq_id'];?>">
														  <?php echo ucfirst($row['faq_question']);?>                                                          </a>                                                          </td>
                                                           <td>
														   <?php if($row['user_id']!='0'){$val = $ise_users->ise_users_select('username','user_id',$row['user_id']);echo $val;}else{echo 'Admin';}?></td>
                                                          <td align="left"><?php echo $row['create_date'];?></td>
										                  <td align="left"><a href="faqs_action.php?<?php if(!empty($_REQUEST['al'])){echo "al=".$_REQUEST['al']."&";} ?>id=<?php echo $row['faq_id']?>&state=<?php echo $row['status'];?>&page=<?php echo $page; ?>&order=<?php echo $order;?>"><?php echo  $row['status'];?></a></td> 
                                                          <td  height="24" align="left" ><a href="view_careers.php?id=<?=$row['faq_id'] ?>&page=<?=$_GET['page']?>">
                                                          <img src="../../images/view_icon.png" height="20" width="20" border="0" title="View SubForums"/>
                                                          </a></td>
									                  </tr>
													 <?php } */
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
															display_pag("index.php");
															?>
                                                            </td>
											</tr>
										</tbody>
									</table><input type="hidden" name="send" /><input type="hidden" name="delet"><input type="hidden" name="send_status" />
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
