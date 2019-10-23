<?php 
	session_start();
	include_once '../../../lib/functions.php';
		include_once '../../../lib/functions_admin.php';
		include_once '../../../lib/calss_qatar_tutors.php';
	include_once '../../../lib/db.php';
	$users=new qatar_tutors();
	//admin_login_check();
	$settings = new Settings();
	$objSql1 = new SqlClass();
	$objSql = new SqlClass();
	if(!empty($_POST))
	{
			define ("MAX_SIZE","50"); 
		 	$image=$_FILES['file']['name']; 
			  function getExtension($str) 
				 {
					 $i = strrpos($str,".");
					 if (!$i) { return ""; }
					 $l = strlen($str) - $i;
					 $ext = substr($str,$i+1,$l);
					 return $ext;
				 }
		
		
				$tmpName = $_FILES['file']['tmp_name'];
				$extention=getExtension($image);
				if($extention=='csv'){
				$arr=file($tmpName);
					
				//$sess_id=generateCode(4);	
				if(is_array($arr)){
			$ij=0;$i=0;	
			foreach($arr as $rows){
			$i++;
			   $row=explode(',',$rows);
			   if($row[0]!='' && $row[1]!='' && $row[2]!='' && $row[3]!=''){
				if(count($row)!=4)
				{
				$_SESSION['msg'] = "<font size='2' color='#0099FF'>Invalid Csv File</font>";
			
					print "<script>";
					print " self.location='tutor_new_bulk.php';";
					print "</script>"; 
					exit;
				}
			
			$usr_name=$row[1];
			$user=$users->checkuser($usr_name);
			
			
			
			
			if($user=='Available'){
				$usr_name=$usr_name;
			}
			else {
				$gnh=0;
				while($gnh!=1)
				{
				
				$usr_name=$usr_name.'_'.generateCode(2);
				$user1=$users->checkuser($usr_name);
				if($user1!='Available'){
					//$usr_name=$usr_name.'_'.generateCode(2);
					$gnh=0;
				
				}
				else 
				$gnh=1;
				}
				
				}
			$userid=$users->new_user_id();
			$array=array("emp_id=".$userid."","firstname=".$row[0]."","	username=".$usr_name."","password=".md5($row[2])."","school_id=".$_SESSION['school_id']."","designation=Teacher","typeid=1");
			$array1=array("id=".$userid."","Email=".$row[3]."");
			$query = new Queries();
			$query->makeinsertquery('sis_employee',$array);
			$query->makeinsertquery('sis_address',$array1);
			}
			else{
				$ij++;
				$recs.=$i.',';
			}
		}
		if($ij==0){
		$_SESSION['msg'] = "<font size='2' color='#0099FF'>Tutors Added Successfully</font>";
				print "<script>";
				print " self.location='index.php';";
				print "</script>"; 
				exit;
		}
		else{
			$_SESSION['msg'] = "<font size='2' color='#0099FF'>Number Of Records failed $ij </font>";
				print "<script>";
				print " self.location='tutor_new_bulk.php?records=".$recs."';";
				print "</script>"; 
				exit;
		}
		} else{
		$_SESSION['msg']="Csv File Is Empty";	
		}}	
	}

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
<link href="../../images/style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../../../script/calendar.js"></script>
<script language="javascript">
	var cal = new CalendarPopup();
	cal.showYearNavigation();
</script>
<script language="javascript" src="../../../script/check.js"></script>
<script language="javascript">
	var xmlhttp;
	function state_onchange(str)
	{
		xmlhttp=GetXmlHttpObject();
		if (xmlhttp==null)
		  {
			  alert ("Browser does not support HTTP Request");
			  return;
		  }
		var url="state_change.php";
		url=url+"?cou="+str;
		xmlhttp.onreadystatechange=stateChanged;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
	}
	function stateChanged()
	{
		if (xmlhttp.readyState==4)
		{
			document.getElementById("txtstate").innerHTML=xmlhttp.responseText;
		}
	}
	function GetXmlHttpObject()
	{
		if (window.XMLHttpRequest)
		{
		  return new XMLHttpRequest();
		}
		if (window.ActiveXObject)
		{
		  return new ActiveXObject("Microsoft.XMLHTTP");
	    }
		return null;
	}
	function check(){
		getForm("new_user");
		//if(!IsEmpty("pname","Please Select Class"))return false;
		if(!IsEmpty("file","Please Upload CSV File"))return false;
		
	}



</script>
<script src="../../../script/check.js"></script>
<script type="text/javascript" src="../../../script/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" language="javascript">
tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	elements : "elm1",
    theme_advanced_toolbar_location : "top",
	theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,forecolorpicker,backcolorpicker,bullist,numlist,link,unlink,blockquote,code",
	theme_advanced_buttons2 : "fontselect,fontsizeselect,formatselect,removeformat,forecolor,cleanup,backcolor",
	theme_advanced_buttons3 : ""
});
</script>
</head>
<body>
	</form>
	<?php include"../header_one.php";?>
    <?php  include '../left.php'; ?>
    <br class="clear"/> 
		
		<!-- Begin content --> 
		<div id="content_wrapper" style="margin-right:30px;"> 
		
			<!-- Begin one column box --> 
		
			
			<!-- Begin 1st level tab --> 
			<ul class="first_level_tab"> 
			
				<!--<li> 
					<a href=""> 
						Graph
					</a> 
				</li> 
				<li> 
					<a href=""> 
						Form Elements
					</a> 
				</li> -->
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/> 
			
			<!-- Begin one column box --> 
			
				<div class="content nomargin"  > 
                   
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="global">
										<tbody>
											<!--<tr>
												<td align="center" colspan="6"><h2>Registered Professors</h2></td>
											</tr>-->
											<tr><td colspan="3"><b><?php echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></b></td></tr>
                                            <?php if($_REQUEST['records']!=''){ ?>
                                            <tr><td colspan="3"><font size='2' color='#0099FF'>Failed Record Number <?php echo substr($_REQUEST['records'],0,-1);?>
                                            </font>
                                            </td></tr>
                                            <?php } ?>
											<tr align="right">
												<td colspan="6"> <?php breadcrum();?></td>
											</tr>
											<tr>
												<td colspan="6">
													<form name="new_user" action="#" method="post" enctype="multipart/form-data" onsubmit="return check()">
													<table width="100%" border="0" style="line-height:30px;" cellpadding="3" cellspacing="1" class="tborder global">
                  										<tr class="row_1">
										                    <td colspan="4" align="center">
                                                            <input type="hidden" id="hiddate" name="hiddate" value="<? echo $date; ?>" />
                                                            <h3>Add Tutors</h3></td>
										              </tr>
                                                	  <!--<tr>	
                                                      	<td align="right"><label>Class:</label></td>
                                                        <td>
                                                        <?php 
														echo "<select name='pname' id='pname'><option value=''>Select Grade</option>";
													   require_once "../../includes/grades.class.php";
														$display_cur=New Grades;
														$res=$display_cur->display_select($_SESSION['school_id']);
														print_r($res);
														$cou=count($res);
														for($i=0;$i<$cou;$i++)
														{
													   echo "<option value=".$res[$i]['grade_id'].">".$res[$i]['grade_name']."</option>";
																			   
													   }
													   echo "</select>";
													   ?>
                                                        </td>
													  </tr>-->
                                                      <tr><td width="20%"> </td>
                                                      	<td align="right"><label>Upload CSV File:</label></td>
                                                        <td align=""><input type="file" name="file" /><a href="tutors.xlsx" style="text-decoration:none"><b>Example File</b></a></td>
                                                      </tr>
													  <tr>
													  	<td colspan="4" align="center">
											            	<input type="submit" name="add_new" value="Add Tutors" class="button_light" id="add_new">
												            <input type="button" name="back" value="Back" onClick="history.go(-1)" class="button_light" id="back">            </td>
													  </tr>
													</table>
													</form>
												</td>
											</tr>
										</tbody>
									</table>
								
									</form>
				    <?php //include '../pageNation.php';?>	
				<br class="clear"/>
				</div> 
				</div>
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
	