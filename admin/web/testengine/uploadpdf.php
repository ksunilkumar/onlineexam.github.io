<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 
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
<style type="text/css">
<!--

-->
</style>
<link href="admin.css" rel="stylesheet" type="text/css" />
<link href="style_002.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../../../script/check.js"></script>
<script language="javascript" src=""></script>
<script language="javascript">
	function check()
	{
		getForm("ff");
		if(!IsEmpty("pathe","Plese Upload Pdf File"))return false;
		
		
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
					<a href="<?php echo $admin_path;?>testengine/manage_quiz_bulkaieee.php" class="active"> 
						Manage Questions
					</a> 
				</li>
				<!--<li> 
					<a href="<?php echo $admin_path;?>clients/new.php"> 
						 Add Clients
					</a> 
				</li> -->
				
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/> 
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
			
			
				
				<div class="content nomargin"  > 
                   
<form name="ff" action="uppdf.php" method="post" enctype="multipart/form-data" onsubmit="return check();">
<table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="global">
                    <tbody><tr>
                      <td align="left"><table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
                          <tbody><tr>
                            <td><table summary="Buttons" width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tbody>
                                
                                  <tr>
                                    <td colspan="2" class="h2" height="30"><span class="ph"><strong>Manage Solutions </strong></span></td>
                                  </tr>
                                  
                                </tbody>
                              </table>
							  <?php 
							  include_once "../../../lib/db.php";
        					 	$sqlobj=new sqlClass();
							  $chid=$_REQUEST['sid'];
							  $qid=$_REQUEST['num'];
							  $sec=$_REQUEST['sec'];
							  ?>
							  <?php
							 // $section=strtolower(substr($sect,-1));
							 
							$s="select * from test_pdf where chapterid=$chid and section='$sec' and queid='$qid'";
							$re=$sqlobj->executeSql($s);
							 $res=$sqlobj->fetchRow($re);
							 ?>
                             <input type="hidden" name='chid' value="<?php echo $chid;?>" />
							  <input type="hidden" name='qid' value="<?php echo $qid;?>" />
							  <input type="hidden" name='sec' value="<?php echo $sec;?>" />
                              <table width="100%" border="1" cellpadding="10" cellspacing="0">
                                  <tr valign="middle">
                                          <td class="tr2" align="center" height="26" colspan="3"><?php if($res['path']!=""){?>
                                          <a href="<?php echo $res['path'];?>" target="_blank"><b><?php echo $res['path'];?></b></a><?php }else echo "<h3>Please Upload ";?></td></h3></td> 
                                        </tr>                                                   
                                                             

                                                                           
<tr valign="middle">
                                          <td class="tr2" align="right" width="40%"><label>Upload Pdf</label></td><td colspan="2" class="tr2" align="left" height="26"><input type="file" name='pathe'></td>
                                        </tr>
                                        
                                       
                                  <tr valign="top">
                                    <td width="99%" colspan="4">
								
									
									
                                      <table width="100%" border="0" cellpadding="3" cellspacing="0">

                    
<tr valign="middle">
                                          <td colspan="5" class="pagesnum" align="center" height="26"><input type="submit" name='sub' value='Submit' class="button_light"></td>
                                        </tr>                  </table></td>
                                  </tr>
                                
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                 </table></form>
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
