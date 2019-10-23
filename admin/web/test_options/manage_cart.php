<?php session_start(); include "../../../lib/db.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
<style type="text/css">

</style>
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
<link href="admin.css" rel="stylesheet" type="text/css" />
<link href="style_002.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<script>
function confirmation()
{
if(confirm("DoYou Want To delete the Record"))
return true;
else 
return false;

}

</script>
<style type="text/css">

</style>
<link href="admin.css" rel="stylesheet" type="text/css" />
<link href="style_002.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="cart.js">
</script>
</head>
<body>
 <?php include"../header_one.php";?>
    <?php  include '../left.php'; ?>
    <div id="content_wrapper" style="margin-right:30px;"> 
		
			<!-- Begin one column box --> 
		
			
			<!-- Begin 1st level tab --> 
			<ul class="first_level_tab"> 
			<li> 
					<a href="<?php echo $admin_path;?>test_options/manage_cart.php" class="active"> 
						Manage Cart
					</a> 
				</li> 
				
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/> <div style="text-align:right"><?php breadcrum();?>&nbsp;&nbsp;</div>
			
			<!-- Begin one column box --> 
            
			<div style="border:1px solid #ccc;"  > 
				
							
				<div class="content nomargin"  > 
                   <?php
				 include_once'../../../lib/db.php';
				 include_once'../../../lib/class_exam_users.php';
				 include_once'../../../lib/class_exam_curriculum.php';
				 $queries = new Queries();
				 $objSql = new SqlClass();
				 $exams_users = new exams_users();
				 $exams_curriculum = new exams_curriculum();
				 $users = $exams_users->users_allnames_select($_SESSION['school_id']);
				/*echo"<pre>";
				print_r($users);*/
				$userid1=$_GET['userid'];
				
				?>


<table width="100%" cellpadding="0" cellspacing="0" class="global"><tr><td  valign="top" ><table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td><table width="100%" align="left" border="0" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                      <td align="left"><table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
                          <tbody><tr>
                            <td><table summary="Buttons" width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tbody>
                                 
                                 <tr>
                                    <td colspan="2" class="h2" height="30"><span class="ph"><strong>Manage Cart</strong></span></td>
                                  </tr>
                               
                               
                                  <tr><td colspan="4" align="center">
                                  <div id="divmsg">
								  <?php if($_REQUEST['msg']!='') echo "<h2><blink>".$_REQUEST['msg']."</blink></h2>";
								  
								  ?>
                                  </div></td></tr>
                                </tbody>
                              </table>
                              <table width="100%" border="1" cellpadding="10" cellspacing="0">
                                <tbody>
                                <?php if($_REQUEST['opt']==1)
								{
								echo "<tr valign='middle'><td colspan='3' align='center'><h2>Uploaded sucessfully</h2></td></tr>";
								}
								else if($_REQUEST['opt']==2)
								{
								echo "<tr valign='middle'><td colspan='3' align='center'><h2>File Not Uploaded</h2></td></tr>";
								}
								else if($_REQUEST['opt']=='al')
								{
								echo "<tr valign='middle'><td colspan='3' align='center'><h2>THIS QUIZ WAS ALREADY UPDATED</h2></td></tr>";
								}?>
                                
                                 <tr valign="middle">
                                    <td class="tr2" align="right"><label>Student</label></td><td colspan="2" class="tr2" align="left" height="26">
                                    <select name="student" onchange="show(this.value,'')" id="student"><option value="">Select</option>
                                       <?php
                                            while($row_id = $objSql->fetchRow($users)){
                                            $user_id = $row_id['user_id'];
											$user_fname = $row_id['user_fname'];
											if($userid1==$user_id)
												echo "<option value='".$user_id."' selected='selected'>".$user_fname."</option>";
											else
                                                echo "<option value='".$user_id."'>".$user_fname."</option>";
                                            }
                                        ?>
                                        </select>
			</td></tr>
            <tr><td colspan="3" class="tr2">
            <?php if($userid1!='')
			{
			echo "<script language='javascript'>show('$userid1','adsad');</script>";
			 }
			 ?>
            <div name='dispaly' id="display">
            
            
            
            
            
            </div></td></tr>                                     
                                      
                                        <input type="hidden" value="<?php echo $cid;?>" name="cid" />
                             
                                
                              </table>
									</form>
                                    
                                    
                                    
                                      </td>
                                  </tr>
                                </tbody>
                              </table></td>
                          </tr>
                        </tbody></table></td>
                    </tr>
                  </tbody></table></td></tr></table></tr></table>
                  
				</div> 
				</div></div>
			
			<!-- End one column box --> 
			<br class="clear"/>
			

<br class="clear"/> 
	
	<?php include '../footer.php';?>
</body>
</html>

