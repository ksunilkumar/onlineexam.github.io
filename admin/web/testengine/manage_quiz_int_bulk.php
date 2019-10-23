<?php session_start();
include_once'../../../lib/db.php';
 ?>
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
<script language="javascript" src="scripts/get_cur.js"></script>
</head>

<body onload="<?php if(isset($_POST['grade'])) { ?> load_grade('<?php echo $_POST['grade']; ?>'); <?php ;} ?>">
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
			
			<br class="clear"/> <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
			
			
				
				<div class="content nomargin"  >   
                   <?php 
	include_once "../../../lib/db.php";
	include "../../../lib/class_exam_questions.php";
	 $qid=$_REQUEST['cid'];
									
	$queries = new Queries();
	$exams_questions = new exams_questions();
	$sec = $exams_questions->get_sections($qid);

?>

<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="global">
              <tbody><tr>
                <td><table width="100%" align="left" border="0" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                      <td align="left"><table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
                          <tbody><tr>
                            <td><table summary="Buttons" width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tbody>
                                 
                                  <tr>
                                    <td colspan="2" class="h2" height="30"><span class="ph"><strong>
									<?php 
									//include '../lib/db.php';
									//$sql="select * from quiz where qid=$id";
									//$rr=mysql_query($sql) or die("sorry qu not processed");
									//$res=mysql_fetch_object($rr);
									//echo strtoupper($res->qfullname);
									
									?> 
									
									</strong></span>
									
									</td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" align="right" height="25"> <p align="right" >
									<a href="javascript:history.go(-1)">Back</a></p> </td>
                                  </tr>
                                </tbody>
                              </table>
                              <table width="100%" border="1" cellpadding="0" cellspacing="0">
                                <tbody>
                                  <tr valign="top">
                                    <td width="99%">
                                   
									<form name="ff" action="" method="post" enctype="multipart/form-data">
									<table width="100%" height="75" border="1" cellpadding="3" cellspacing="0" class="borderlistings" summary="List of threads">
                                        <thead>
                                          <tr>
                                          <?php if(sizeof($sec) > 0 ) { foreach($sec as $s) { ?>
										    <td class="listingheadings" width="25%" align="center" height="35"><a href="sectiona_bulk.php?id=<?php echo $_GET['cid'];?>&sec=<?= $s['section']; ?>" title="Ascending"><?= $s['section']; ?></a></td><?php } }else { echo "<td>No questions found in this chapter...</td>"; } ?>
                                            
                                            </tr>
                                        </thead><tbody>
									   
                                        </tbody>
                                      </table>
									</form>
                                      <table width="100%" border="0" cellpadding="3" cellspacing="0">
                                        <tbody><tr valign="middle"></tr>
                                      </tbody></table></td>
                                  </tr>
                                </tbody>
                              </table></td>
                          </tr>
                        </tbody></table></td>
                    </tr>
                  </tbody></table></td>
              </tr>
            </tbody></table>
      
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