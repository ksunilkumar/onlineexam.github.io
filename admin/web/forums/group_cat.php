<?php 
	session_start();
	include_once '../../lib/functions.php';
	include_once '../../lib/db.php';
	$objSql1 = new SqlClass();
	admin_login_check();
	$group_cat = new Group();

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

	$totalEntries=$group_cat->totalNoOfGroupCategories($al);
	$maxPages=ceil($totalEntries/perPage());
	$rec = $group_cat->display_group_cat($al,$page,$order);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.orderg/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.orderg/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">

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
	   var num=document.users.elements.length;
	   for(i=0;i<num;i++)
	   {
			tmp=document.users.elements[i];
			//alert(document.packages.elements[i].name);
			if(tmp.type=="checkbox" && !(tmp.name=="allChk"))
			{
				tmp.checked=chk.checked;
			}
		}
	}
	function send_select()
	{
		alert("hi send");
		dml1=document.users;
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
			alert("Select atleast one recorderd");
			return false;
		}
		//alert("alert");
		document.users.send.value=value12;
		document.users.submit();
		return true;
	}
	function doselect1()
	{
		dml1=document.users;
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
			alert("Select atleast one recorderd");
			return false;
		}
		
		if(!confirm('Are you sure you want to delete the recorderds?\n- to Delete the recorderds, hit OK\n- otherwise, hit Cancel'))
			return false;
			
		document.users.delet.value=val12;
		
		document.users.submit();
		return true;
	}
	function addCategory()
	{
	if(!confirm('Are you sure you want to add the category?\n- to Add the category, hit OK\n- otherwise, hit Cancel'))
	return false;
	
	javascript:location.href=('group_cat_new.php');
	}

</script>
</head>
<body>
	<form name="pageSelectionForm" id="pageSelectionForm" method="post" action="group_cat.php">
		<input type="hidden" id="pageNumber" name="pageNumber" value=""/>
        <input type="hidden" id="al" name="al" value="<?php echo $al;?>"/>
		<input type="hidden" id="order" name="order" value="<?php echo $order;?>"/>
	</form>
	<?php include"header.php";?>
	<table width="90%" align="center" border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td width="22"><img src="../images/titlesleft.gif"></td>
				<td valign="top" background="../images/titlesbg.gif">
					<table style="padding-left: 1px;" width="100%" borderder="0" cellpadding="0" cellspacing="0">
						<tbody>
							<tr><td class="titles">&nbsp;</td></tr>
							<tr><td height="10"></td></tr>
							<tr><td class="pages">Manage Admins</td>
                             <td align="right">
                            <a href="../home.php" style="text-decoration:none">Admin</a>
                             <span class="org_arrow"><b>&raquo;</b></span>
                            <a href="index.php" style="text-decoration:none">
                             Groups Management</a>  <span class="org_arrow"><b>&raquo;</b></span> Category
                             </td>
						</tbody>
					</table>
				</td>
				<td align="right"><img src="../images/titlesright.gif"></td>
			</tr>
			<tr>
				<td width="22" background="../images/pageleftshadow.gif"><img src="../images/pageleftshadow.gif" width="22" height="1"></td>
				<td valign="top">
					<table width="100%" borderder="0" cellpadding="0" cellspacing="0">
						<tbody>
							<tr>
								<td class="navbg" style="padding-left: 1px;" valign="top" width="248" height="200">
								<?php include 'left.php'; ?>
									<table width="236" borderder="0" cellpadding="0" cellspacing="0">
										<tbody>
											<tr>	
												<td><img src="../images/navbottom.gif"></td>
											</tr>
										</tbody>
									</table><br><br>
								</td>
								<td style="padding-left: 16px;" valign="top" height="300">
									<form name="users" method="post" action="delete_group_cat.php">
									<table width="100%" align="left" borderder="0" cellpadding="0" cellspacing="0">
										<tbody>
											<tr>
												<td align="center" colspan="5"><h2>Category</h2></td>
											</tr>
											<tr><td width="100%" colspan="5"><?php echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td></tr>
											<tr>
												<td width="100%" colspan="5">
													<a href="index.php">Groups</a>
												</td>
											</tr>
											<tr><td colspan="5">&nbsp; </td></tr>
											<tr>
												<td colspan="5">
									                <input type="button" name="sub1" value="Add Category" class="button" onclick="return addCategory()" />
													<input type="submit" name="sub3" value="Delete Category(s)" class="button" onclick="doselect1(); return false;" />
													</td>
											</tr>
                                           
                                            <?php include '../pageNation.php';?>
											<tr>
												<td colspan="5">
                                                
													<table width="100%" borderder="0" cellpadding="3" cellspacing="1" class="tborder">
                                                                                                <tr>
														<td colspan="5"  class="row_white">
															<?php include_once"paging.php";
															display_pag("group_cat.php");
															?>
                                                            </td>
											</tr>
                                                    	<tr class="row_1"><?php $_GET['order']?>
										                    <td width="10%" align="center" ><input type="checkbox" name="allChk" value="ON" onclick="CheckAll(this);"  class="input2" /></td>
										                    <td width="80%" align="left" ><a href="group_cat.php?al=<?php echo $al;?>&order=<?php if(empty($_GET['order'])){?>1<?php }elseif($_GET['order'] == '1'){?>0<?php }?>" class="tablehead">Category Title</a>&nbsp;<?php if($_GET["order"]=='0') {?><img src="../images/up1.GIF" width="13" height="13" /><?php }else if($_GET["order"] == '1'){?><img src="../images/down1.GIF" width="13" height="13" /><?php }?></td>
										                    <td width="10%" align="left" ><a href="group_cat.php?al=<?php echo $al;?>&order=<?php if($_GET['order']=='2'){?>3<?php }else{?>2<?php }?>" class="tablehead">Status</a>&nbsp;<?php if($_GET["order"] == '6') {?><img src="../images/up1.GIF" width="13" height="13" /><?php }else if($_GET["order"] == '7'){?><img src="../images/down1.GIF" width="13" height="13" /><?php }?></td>
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
										                  <td height="24" align="center" ><input  type="checkbox" name="Mid[]" id="<?php echo $row['groupcat_id'];?>" value="642" class="input2" /></td>
														  <td align="left"><a href="group_cat_modify.php?id=<?php echo $row['groupcat_id'];?>"><?php echo $row['groupcat_name'];?></a></td>
										                  <td align="left"><a href="delete_group_cat.php?<?php if(!empty($_REQUEST['al'])){echo "al=".$_REQUEST['al']."&";} ?>id=<?php echo $row['groupcat_id']?>&state=<?php echo $row['status'];?>&page=<?php echo $page; ?>&order=<?php echo $order;?>"><?php echo  $row['status'];?></a></td> 
									                  </tr>
													  <?php }
													  		else if($val == '1')
															{
																$val = 0;
													  ?>
													  <tr class="row_color">
										                  <td height="24" align="center" ><input  type="checkbox" name="Mid[]" id="<?php echo $row['groupcat_id'];?>" value="642" class="input2" /></td>
														  <td align="left"><a href="group_cat_modify.php?id=<?php echo $row['groupcat_id'];?>"><?php echo $row['groupcat_name'];?></a></td>
														  <td align="left"><a href="delete_group_cat.php?<?php if(!empty($_REQUEST['al'])){echo "al=".$_REQUEST['al']."&";} ?>id=<?php echo $row['groupcat_id']?>&state=<?php echo $row['status'];?>&page=<?php echo $page; ?>&order=<?php echo $order;?>"><?php echo  $row['status'];?></a></td> 
									                  </tr>
													 <?php } 
													 }
													 ?>
													 <?php
													}else{?>
													 <tr class="row_white"><td align="center" colspan="7" style="colorder:#FF0000;">No recorderds Found.</td></tr>
													 <?php } ?>
													</table>
												</td>
											</tr>
										</tbody >
									</table><input type="hidden" name="send" /><input type="hidden" name="delet"><input type="hidden" name="send_status" />
									</form>
								</td>
							</tr>
						</tbody>
					</table>
					
				</td>
				<td width="27" background="../images/pagerightshadow.gif"><img src="../images/rightshadow.htm" width="27" height="1"></td>
			</tr>
		</tbody>
	</table>
	<?php include"footer.php";?><br><br>
</body>
</html>