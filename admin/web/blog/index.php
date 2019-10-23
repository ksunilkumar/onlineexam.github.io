<?php 
	@session_start();
	
	//include_once '../../../lib/functions.php';
	//include_once '../../../lib/functions_admin.php';
	include_once '../../../lib/db.php';
	include_once '../../../lib/class_ise_blogs.php';
	include_once '../../../lib/ise_settings.class.php';
	$objSql1 = new SqlClass();
	$ise_settings=new ise_Settings();
	//admin_login_check();
	$blog = new Blogs();
	$blog1 = new Blogs();
	$al=".";
	if(!empty($_REQUEST['al']))
	{
		$al = $_REQUEST['al'];
	}
	if($_REQUEST['school']!='')
	echo $sid=$_REQUEST['school'];
	
	 $totalEntries=$blog->totalNoOfBlogs($al,$sid);
	
	
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

	$rec = $blog->display_blog($page,$al,$order,$sid);
	
	
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
			
		document.BlogSelectionForm.delet.value=val12;
		
		document.BlogSelectionForm.submit();
		return true;
	}
	
 function export1()
	{
	//alert("asaedsd");
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
		//alert(val12);return false;
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
		
		location.href='export_blogs.php?exprt='+val12;
		return true;
		// document.getElementById('info_msg').innerHTML='Download Completed Successfully';
	}
function addBlog()
	{
		if(!confirm('Are you sure you want to add the Blog?\n- to Add the  Blog, hit OK\n- otherwise, hit Cancel'))
		return false;
		javascript:location.href=('blog_add.php');
	}
		function hidediv(){
		document.getElementById('span_div').style.display='none';
		return true;
	}
</script>
</head>
<body>
	<form name="pageSelectionForm" id="pageSelectionForm" method="get" action="index.php">
		<input type="hidden" id="pageNumber" name="pageNumber" value=""/>
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
					<a href="<?php echo $admin_path;?>blog/index.php"  class="active"> 
						Manage Blogs
					</a> 
				</li> 
				<li> 
					<a href="<?php echo $admin_path;?>blog/blog_add.php" onclick="return addBlog();"> 
						Add Blog
					</a> 
				</li> 
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/> <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
			
			
				
				<div class="content nomargin"  > 
				<form name="BlogSelectionForm" method="post" action="blog_action.php?al=<? echo $_REQUEST['al'];?>&pageNumber=<? echo $page; ?>">
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
                                                <label><font>SEARCH BY SCHOOL:</font></label><?php if(!empty($_REQUEST)){echo $ise_settings->get_admin_sel_schools($_REQUEST['school']);}else{echo $ise_settings->get_admin_schools();}?>  
                                               <!-- <input type="button" name="sub1" value="Add Blog" class="button_light"    />-->
									                <input type="submit" name="sub3" value="Delete Blog" class="button_light" onclick="doselect1(); return false;" style="cursor:pointer;" />
								                    <input type="button" name="sub" value="Export" class="button_light"  onclick="export1(); return false;" style="cursor:pointer;"/>
							                      
                                               </td><!--<td align="right">
                                                
                                                </td>-->
											</tr>
											
											<tr>
												<td colspan="5">
													<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tborder">
                                                                                            

                  										<tr class="row_1"><?php $_GET['or']?>
										                    <th width="4%" align="center" ><input type="checkbox" name="allChk" value="ON" onclick="CheckAll(this);"  class="input2" /></th>
									                      <th width="20%" align="left" ><a href="index.php?order=<?php if(empty($_GET['order'])){?>1<?php }elseif($_GET['order'] == '1'){?>0<?php }?>&school=<?php echo $_REQUEST['school'];?>&al=<?php echo $_GET['al'];?>" class="tablehead"><b>Blog Title</b><?php if($_GET["order"] == '1') {?><img src="../images/up.GIF" width="13" height="13" /><?php }else if($_GET["order"] == '0'){?><img src="../images/down1.GIF" width="13" height="13" /><?php }?></a>&nbsp;</th>
                                                           <th width="12%" align="left" >Category </th>
                                                            <th width="12%" align="left" >No Of comments </th>
                                                          <th width="15%" align="left" >Create Date </th>
                                                           
                                                            
									                      <th width="13%" align="left" ><a href="index.php?order=<?php if($_GET['order']=='2'){?>3<?php }else{?>2<?php }?>&school=<?php echo $_REQUEST['school'];?>&al=<?php echo $_GET['al'];?>" class="tablehead"><b>Status</b></a>&nbsp;<?php if($_GET["order"] == '2') {?><img src="../images/up.GIF" width="13" height="13" /><?php }else if($_GET["order"] == '3'){?><img src="../images/down1.GIF" width="13" height="13" /><?php }?></th>
                                                        

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
																$val+1;	
													  ?>
													  <tr class="row_white">
                                                      <?php }else{?>
                                                       <tr class="row_color">
                                                       <?php }?>
										                  <td height="24" align="center" >
                                                          
                                                          <input  type="checkbox" name="Mid[]" id="<?php echo $row['blog_id'];?>" value="642" class="input2" />
                                                          </td>
														  <td align="left"><a href="blog_modify.php?id=<?php echo $row['blog_id'];?>&pageNumber=<?php echo $_REQUEST['pageNumber'];?>&al=<?php echo $_REQUEST['al'];?>"><?php echo ucfirst($row['blog_title']);?></a></td>
                                                           <td align="left">
                                                           <?
														  $group=$blog1->get_group_name($row['cat_id']);if($group=='')echo "Not Available";else echo $group;
														   ?>
                                                           </td>
                                                           <td align="left">
														   
														   <?
														  
														    echo $totalEntries=$blog->totalNoOfBlogcomms($row['blog_id'],'.');
														  	?>&nbsp;&nbsp;
                                                             <a href="view_comments.php?id=<?=$row['blog_id']?>">
                                                           <img src="../../images/view_icon.png" height="20" width="20" border="0" title="View Commentss"/></a>
                                                            </td>
                                                           <td align="left"><?=$row['create_date'] ?></td>
                                                           
                                                           
										                  <td align="left"><a href="blog_action.php?<?php if(!empty($_REQUEST['al'])){echo "al=".$_REQUEST['al']."&";} ?>id=<?php echo $row['blog_id']?>&state=<?php echo $row['status'];?>&pageNumber=<?php echo $page; ?>&order=<?php echo $order;?>"><?php echo  $row['status'];?></a></td> 
                                                         
									                  </tr>
									                  
													
													 <?php
													}}else{?>
													 <tr class="row_white"><td align="center" colspan="7" style="color:#FF0000;">No records Found.</td></tr>
													 <?php } ?>
													</table>												</td>
											</tr>
                                                <tr>
														<td colspan="6"  class="row_white" align="right"><?php include_once"paging.php";
															display_pag("index.php");
															?><br /></td>
										  </tr>
										</tbody>
									</table>
									<input type="hidden" name="send" /><input type="hidden" name="delet"><input type="hidden" name="send_status" />
									</form>
                                    <form action="" method="post" name="schoolform" id="schoolform">
                 <input type="hidden" name="school" id="school" /></form><br class="clear"/>
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

