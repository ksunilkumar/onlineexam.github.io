<?php session_start();?>
<?php 
		include_once '../../../lib/db.php';
		include_once"../../../lib/admin_check.php";
	//admin_login_check('0','admin');
	super_admin_login_check('0','superadmin');
	include_once '../../../lib/functions_admin.php';
	include_once '../../../lib/functions.php';
	$objSql = new SqlClass();
	$country=new country();
	
	$objSql = new SqlClass();
	$objSql = new SqlClass();
	$pagination_qatar = new pagination_key();
	
	$query = "SELECT * FROM ise_ip_details ";
    $pagination_qatar->createPaging($query,20);
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
 
<!-- Website Title --> 
<title>Ismartexams Admin</title> 
 
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
	function getdata(x)
	{
		
		if(x!="")
		location.href='index.php?id='+x;
		else
		location.href="index.php";
	}
	function get_map(lat,lng)
	{
		myRef = window.open('get_map.php?lat='+lat+'&lng='+lng,'mywin','left=500,top=120,width=300,height=300,toolbar=0,resizable=0,status=1,location=0,menubar=1');
		if (window.focus)
		 {
		 	myRef.focus()
		 }
		return false;
	}
</script>	
</head>
<body>
	
	<?php include"../header_one.php";?>
    <?php  include '../left.php'; ?>
    
		<br class="clear"/> 
		
		<!-- Begin content --> 
		<div id="content_wrapper" style="margin-right:30px;"> 
		
			<!-- Begin one column box --> 
		
			
			<!-- Begin 1st level tab --> 
			<ul class="first_level_tab"> 
				<li> 
					<a href="<?php echo $admin_path;?>otherotions/site_access.php" class="active"> 
						Manage Site Access
					</a> 
				</li>
				
				
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/> <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
			
			
				
				<div class="content nomargin"  > 
					
					<!-- Begin example table data --> 
                  <form name="client" method="post" action="action.php?al=<? echo $_REQUEST['al'];?>&page=<? echo $page; ?>">
					<table class="global" width="100%"  cellpadding="0" cellspacing="0"> 
						<thead>
                 
						 <tr><td width="100%" colspan="5"><b><font color="#ff0000"><?php echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></font></b></td></tr>
											
                                           
											<tr>
												<td colspan="5" align="center">
													<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tborder">
												
                  									  <tr class="row_1">
										                    <th width="10%" align="left" >IP Address </th>
										                    <th width="10%" align="left" >Access Time</th>
									                        <th width="10%" align="left" >Access Date</th>
                                                            <th width="10%" align="left" >Country</th>
                                                            <th width="10%" align="left" >Region</th>
                                                             <th width="10%" align="left" >City</th>
                                                              <th width="10%" align="left" >Local Date &amp; Time</th>


										              </tr>
													
									                  <?php 														
															$objSql1 = new SqlClass();
															while($row = mysql_fetch_object($pagination_qatar->resultpage))
															{
														
													  ?>
													  <tr class="row_white">
										                  <td height="24" align="left" ><?php echo $row->ip_addrs;?></td>
														  <td align="left"> <?php echo $row->access_time;?> </td>
										                  <td align="left"><?php echo $row->access_date; ?></td> 
                                                           <td align="left"><?php echo $row->country;?>&nbsp;<?php if(!empty($row->country)) { ?><img src='../Flags/<?php echo $row->country_code; ?>.gif' width='24' height='24' align="absmiddle" onclick="javascript:get_map(<?php echo $row->lat; ?>,<?php echo $row->lng; ?>);" style="cursor:pointer;" /><?php } ?></td> 
                                                            <td align="left"><?php echo $row->region; ?></td> 
                                                             <td align="left"><?php echo $row->city; ?></td> 
                                                              <td align="left"><?php echo $row->local_tmsp; ?></td> 
									                  </tr>
													 
													 <?php
													} ?>
													 
											  </table>											  </td>
											</tr>
                         
                                                     
                                                        
						</tbody> 
					</table> 
					<input type="hidden" name="send" /><input type="hidden" name="delet"><input type="hidden" name="send_status" />
				  </form>
                  <div class="pagination">
				    <?php echo $pagination_qatar->totalrecords(); ?>&nbsp;&nbsp;&nbsp;<?php echo $pagination_qatar->displayPaging();?>	
                    </div>
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