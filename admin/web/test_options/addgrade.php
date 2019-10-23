<?php session_start();
ob_start();


include "../../../lib/db.php";
include "../../../lib/class_exam_grades.php";
$queries = new Queries();
$objSql = new SqlClass();
$exams_grades = new exams_grades();
if(isset($_REQUEST['sub']))
{
		$count = $queries->makeselectquery('test_grades',"count(*) as count","grade_name", $_REQUEST['pname']);
		if($count == '0')
		{
				$image=$_FILES['image']['name']; 
				$error = '0';$upload='';$extension='';
				define ("MAX_SIZE","50"); 
				$filename = stripslashes($_FILES['image']['name']);
				$extension = getExtension($filename);
				$extension = strtolower($extension);
				// Image Size
				$size=filesize($_FILES['image']['tmp_name']);
				if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
				{
					$_SESSION['msg'] = "<font size='2' color='#FF0000'>Upload Unknown File extension! Please Upload Onely png,gif,jpg,jpeg File</font>";
					$error='1';
				}
				else
				{
					$image1="../../../gradeimages/";
					echo $image123=time().".".$extension;				
					$copied = copy($_FILES['image']['tmp_name'], $image1.$image123);
				}
			    
				$tab = array("grade_name =".$_REQUEST['pname']."","grade_image =".$image123."");
				$exams_grades->grades_insert($tab);
				$_SESSION['msg'] = "<font size='2' color='#0099FF'>Grade Added Successfully</font>";
				print "<script>";
				print "self.location='manage_grade.php';";
				print "</script>"; 
				exit;
				
		}
		else
		{
			$_SESSION['msg'] = "<font size='2' color='red'>Grade Title Already Existed</font>";
		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<script src="../../../script/check.js"></script>
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
					<a href="<?php echo $admin_path;?>test_options/manage_grade.php" > 
						Manage Grades
					</a> 
				</li> 
				<li> 
					<a href="<?php echo $admin_path;?>test_options/addgrade.php" class="active"> 
						Add Grade
					</a> 
				</li>
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/> <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 
			<div style="border:1px solid #ccc;"  > 
				
			
			
				
				<div class="content nomargin"  > 
                    
               <head>
<script language="javascript">
function chkform()
{
		getForm("grade_form");
		if(!IsEmpty("pname","Please Enter Grade Name "))return false;
		if(!IsEmpty("image","Please Upload image"))return false;

}

</script>
</head>
<form name="grade_form" action="addgrade.php" method="post" enctype="multipart/form-data"  onsubmit="return chkform()">
<table width="100%" cellpadding="0" cellspacing="0" class="global"><tr><td  valign="top" ><table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td><table width="100%" align="left" border="0" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                      <td align="left"><table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
                          <tbody><tr>
                            <td><table summary="Buttons" width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tbody>
                                  <tr><td colspan="2"><?php  echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td></tr>
                                  <tr>
										<td align="center" colspan="2"><h2>Add Grade</h2></td>
									</tr>
                                  <tr>
                                    <td colspan="2" class="h2" height="30"><span class="ph"><strong></strong></span></td>
                                  </tr>
                                  
                                </tbody>
                              </table>
                              <table width="100%" border="1" cellpadding="0" cellspacing="0">
                                <tbody><tr valign="middle">
                                          <td class="tr2" align="right" width="40%"><label>Grade</label></td><td colspan="2" class="tr2" align="left" height="26"><input type="text" name='pname'></td>
                                        </tr>      
 <tr valign="middle">
                                          <td class="tr2" align="right"><label>Image</label></td><td colspan="2" class="tr2" align="left" height="26">
                                          <input type="file" name='image'></td>
                                        </tr>
                                       
                                  <tr valign="top">
                                    <td width="99%" colspan="4">
								
									<!--<table class="borderlistings" summary="List of threads" width="100%" cellpadding="3" cellspacing="0" border="1">
                                        <thead>
                                          <tr>
										    <td class="listingheadings" width="20%" align="center" height="35">PackageName<a href="#" title="Ascending"><img src="images/up.gif" alt="Ascending" title="Ascending" border="0"></a></td>
                                            <td class="listingheadings" width="19%" align="center">Package Cost<a href="#" title="Ascending"> <img src="images/up.gif" alt="Ascending" title="Ascending" border="0"></a></td>
                                            <td class="listingheadings" width="21%" align="center"><strong>QIDS<a href="#" title="Ascending"><img src="images/up.gif" alt="Ascending" title="Ascending" border="0"></a></strong></td>
                                            
                                          </tr>
                                        </thead><tbody>
                                        
									    <?php
										/*include 'config.php';
										$sql="select * from packages";
										$res=mysql_query($sql) or die("query not processed");
										while($obj=mysql_fetch_object($res)){
										$d=($obj->cost*$obj->discount)/100;
										//echo $d;
										$c=$obj->cost-$d;										?>                                    
                                          <tr>
										    <td class="tr2" align="left" height="30"><input type='checkbox' name='sel[]' value='<?php echo $obj->pid;?>'><?php echo $obj->packagename;?></td>
                                            <td class="tr2" align="center"><?php echo $c?></td>
                                            <td class="tr2" align="center"><?php echo $obj->qids;?></td>
                                            
                                          </tr>
										  <?php
										  }*/
										  ?>
                                        </tbody>
                                      </table>-->
									
                                      <table width="100%" border="0" cellpadding="3" cellspacing="0">

                    
<tr valign="middle">
                                          <td  class="pagesnum" align="center" height="26"><input type="submit" name='sub' value='Submit' class="button_light"></td>
                                        </tr>                  </table></td>
                                  </tr>
                                </tbody>
                              </table></td>
                          </tr>
                        </tbody></table></td>
                    </tr>
                  </tbody></table></td>
              </tr>
            </tbody></table></td></tr></table></form>
 
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
