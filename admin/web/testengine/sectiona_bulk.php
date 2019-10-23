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
                    
                    <?php 
//include "secure.php";
	include_once "../../../lib/db.php";
	include "../../../lib/class_exam_questions.php";

	$queries = new Queries();
	$exams_questions = new exams_questions();

?>
<script language="javascript">
function load(x)
{
var xml=createrequest();
xml.open('GET','corg.php?na='+x,'true');
xml.send(null);
		
        xml.onreadystatechange=function()
        {
           	if(xml.readyState==4)
       	    {               
				var res=xml.responseText;
				document.getElementById('course').innerHTML=res;
							
			}
		}

}
function loadit()
{
//var curid=document.getElementById('curid').value;
var couid=document.getElementById('couid').value;
//alert(curid);
if(couid=="all")
location.href="manage_quiz_bulk.php";
else
location.href="manage_quiz_bulk.php?couid="+couid; 
}
function createrequest()
{
	var http=false;
	try
	{
		http=new XMLHttpRequest;
		return http;		
	}
	catch(e)
	{
		try
		{
			http=new ActiveXObject("Microsoft.XMLHTTP");
			return http; 
		}
		catch(e1)
		{
			try
			{
				http=new ActiveXObject("MSXML2.XMLHTTP");
				return http;
			}
			catch(e2)
			{
				alert("HAI");
			
			}
		}

	}
	
}
</script><table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="global">
              <tbody><tr>
                <td><table width="100%" align="left" border="0" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                      <td align="left"><table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
                          <tbody><tr>
                            <td><table summary="Buttons" width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tbody>
                                  
                                  <tr>
                                    <td colspan="2" class="smalltext" height="30">
									<?php 
									 $id=$_GET['id'];
									 $sc = $_GET['sec'];
									 
									$qes = $exams_questions->get_questions($id,$sc);
									
									$opt = $exams_questions->get_options($id,$sc);
									
									$ans = $exams_questions->get_answers($id,$sc);
									$count = max(sizeof($qes),sizeof($opt),sizeof($ans));
									
									?> <br />
									<b>Section -A Questions Portal</b>
									
									
									</td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" align="right" height="25"><!--<a href="addques.php?id=<?php echo $_GET['id'];?>&sec=<?php echo $_GET['sec'];?>">Add question</a>&nbsp;&nbsp;| &nbsp;--><a href="javascript:history.go(-1)">Back</a> </td>
                                  </tr>
								  <?php if($_REQUEST['op']==1)
								  {?><tr>
                                    <td colspan="2" align="left" height="25"><b><font color="#3366CC">Uploaded Sucessfully</font></b></td>
                                  </tr><?php } else if($_REQUEST['op']==2){?>
                                  <tr>
                                    <td colspan="2" align="left" height="25"><b><font color="#FF0000">Uploaded Pdf File Only</font></b></td>
                                  </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                              <table width="100%" border="1" cellpadding="0" cellspacing="0">
                                <tbody>
                                  <tr valign="top">
                                    <td width="99%">
									<form name="ff" action="del.php" method="post" enctype="multipart/form-data">
									<table class="borderlistings" summary="List of threads" width="100%" cellpadding="3" cellspacing="0" border="1">
                                        <thead>
                                          <tr><th class="listingheadings" width='5%'>S.No</th>
										    <th class="listingheadings" width="20%" align="center" height="35">Question</th>
                                            <th class="listingheadings" width="19%" align="center">Question options </th>
                                            <th class="listingheadings" width="21%" align="center"><strong>Correct option </strong></th>
                                            <th class="listingheadings" width="15%" align="center" nowrap="nowrap">other</th>
                                          </tr>
                                        </thead><tbody>
									    <?php
										if($count>1 && $qes[0][0]!="")
										{
										
										for($c=0;$c<$count;$c++) {
										 ?>                                    
                                          <tr><td class="tr2" align="left" height="30"><?php echo $c+1; ;?></td>
										    <td class="tr2" align="left" height="30">
											<?php 
											$que=str_replace('../papers/','',$qes[$c]['question']);
											$que=str_replace("src='","src='../papers/",$que);
											$que=str_replace('src="','src="../papers/',$que);
											echo $que;
											?>
                                            </td>
                                            <td class="tr2" align="left">
											<?php  $options=str_replace('#$',',',$opt[$c]['options']);
											$options=str_replace('../papers/','',$options);
											$options=str_replace("src='","src='../papers/",$options);
											$options=str_replace('src="','src="../papers/',$options);
											echo $options;
											?></td>
                                            <td class="tr2" align="left">
											<?php  
											$answer=str_replace('../papers/','',$ans[$c]['answer']);
											$answer=str_replace("src='","src='../papers/",$answer);
											$answer=str_replace('src="','src="../papers/',$answer);
											list($op,$copt)=explode("#$",$answer); echo $copt; ?></td>
                                            <td class="tr2" align="center" nowrap="nowrap"><a href="editques_bulk.php?sid=<?php echo $qes[$c]['chapter_id'];?>&qid=<?php echo $qes[$c]['que_id'];?>&qid1=<?php echo $opt[$c]['opt_id'];?>&qid2=<?php echo $ans[$c]['ans_id'];?>&sec=<?php echo $sc;?>"><img src="../../images/edit.gif" border="0"></a>
                                            <a href="uploadpdf.php?sid=<?php echo $qes[$c]['chapter_id'];?>&qid=<?php echo $qes[$c]['que_id'];?>&qid1=<?php echo $opt[$c]['opt_id'];?>&qid2=<?php echo $ans[$c]['ans_id'];?>&sec=<?php echo $sc?>&num=<?php echo $qes[$c]['que_number'];?>"><img src="../../images/active.gif" border="0"></a><a href="deletequestion.php?id=<?php echo $qes[$c]['que_id'];?>&sec=<?php echo $sc;?>&quizid=<?php echo $id;?>"><img src="../../images/delete.gif"  title="Delete Question"  alt="Delete Question" border="0"/></a><a href="deleteoption.php?id=<?php echo $opt[$c]['opt_id'];?>&sec=<?php echo $sc;?>&quizid=<?php echo $id;?>"><img src="../../images/delete.gif" alt="Delete Option" title="Delete Option" border="0"/></a><a href="deleteanswer.php?id=<?php echo $ans[$c]['ans_id'];?>&sec=<?php echo $sc;?>&quizid=<?php echo $id;?>"><img src="../../images/delete.gif" alt="Delete Answer" title="Delete answer" border="0"/></a>
                                            <a href="deleteall.php?qid=<?php echo $qes[$c]['que_id'];?>&oid=<?php echo $opt[$c]['opt_id'];?>&aid=<?php echo $ans[$c]['ans_id'];?>&sec=<?php echo $sc;?>&quizid=<?php echo $id;?>">
                                            
                                            <img src="../../images/delete.gif" alt="Delete All" title="Delete All" border="0"/>                                            </a></td>
                                          </tr>
										  <?php
										  $dno++;
										  }
										  
										  }
										  else
										  {
										  ?>
                                          <tr><td colspan="5" style="color:#FFFFFF"><b> No Records Found</b></td></tr>
                                          <?
										  }
										  ?>
                                        </tbody>
                                      </table>
									</form>
                                      <table width="100%" border="0" cellpadding="3" cellspacing="0">
                                        <tbody><tr valign="middle">
                                          <td colspan="5" class="pagesnum" align="left" height="26">&nbsp;</td>
                                        </tr>
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