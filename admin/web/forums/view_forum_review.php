<?php 
	session_start();
	
	//include_once '../../../lib/calss_ise_news.php';
	include_once '../../../lib/db.php';

	include_once '../../../lib/class_ise_users.php';
	
	
	
	$ise_users = new ise_users();
	$queries = new Queries();
	include_once '../../../lib/class_ise_forums.php';
	$queries = new Queries();
	$ise_forum_comms = new Forums();
 	$row = $ise_forum_comms->display_forum_comms($_GET['id']);
	/*echo"<pre>";
	print_r($row);*/
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
		if(!confirm('Are you sure you want to add the news?\n- to Add the news, hit OK\n- otherwise, hit Cancel'))
		return false;
	
	javascript:location.href=('news_new.php');
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
		location.href='export_news.php?exprt='+val12;
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
			<!--<ul class="first_level_tab"> 
			
				<li> 
					<a href="<?php echo $admin_path;?>forums/index.php"  class="active"> 
						Manage Forums
					</a> 
				</li> 
				<li> 
					<a href="<?php echo $admin_path;?>forums/forums_new.php"> 
						Add Forum
					</a> 
				</li> 
			</ul>	-->
			<!-- End 1st level tab --> 
			
			<br class="clear"/> 
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
			
			
				
				<div class="content nomargin"  > 
			<form name="newsSelectForm" method="post" action="delete_news.php?al=<? echo $_REQUEST['al'];?>&page=<? echo $page; ?>">
									<table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="global">
										<tbody>
										
											<tr><td width="100%" colspan="5"><?php echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td></tr>
											<!--<tr>
												<td colspan="4">&nbsp;</td>
											  <td align="right"><?php breadcrum();?></td>
											</tr>-->
                                            <tr>
                                            	<td colspan="5" align="right"><a href="display_forum_comments.php?id=<?php echo $_REQUEST['id1']?>&pageNumber=<?php echo $_REQUEST['page']?>&al=<?php echo $_REQUEST['al'];?>">Back</a></td>
											<tr>
												<td align="left" colspan="5"><h3>View Forum Comments</h3></td>
											</tr>

											<tr>
												<td colspan="5">
													<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tborder">
                                                                                                                                           

													  <tr class="row_white">
										                  
										                  <td width="18%" align="left"><span class="sideheading"><b>User Name</b></span></td>
                                                        <td width="7%" align="left">:</td>
									                    <td width="45%" align="left"><?php $user=$ise_users->get_user_details($row['user_id']); if($user['user_fname'] !='') $name=$user['user_fname'];else $name="Not Available";  echo $name;?></td> 
									                  </tr>
													  
													  <tr class="row_color">
										                
										                  <td align="left"><span class="sideheading"><b>Forum Comments</b></span></td>
                                                          <td align="left">:</td>
									                    
                                                      <td  height="24" align="left" ><?=ucfirst($row['f_c_desc'])?></td>
									                  </tr>
													</table>
											  </td>
											</tr>
                                            
										</tbody>
									</table><input type="hidden" name="send" /><input type="hidden" name="delet"><input type="hidden" name="send_status" />
									</form>
									
				    	
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
