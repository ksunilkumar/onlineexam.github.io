
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
	include_once "../../../lib/db.php";
	include "../../../lib/class_exam_questions.php";
	include "../../../lib/class_exam_options.php";
	include "../../../lib/class_exam_course.php";
	include "../../../lib/class_exam_chapters.php";
	include "../../../lib/class_exam_answers.php";

	$queries = new Queries();
	//$pagination_key = new pagination_key();
	$exams_questions = new exams_questions();
	$exams_answers = new exams_answers();
	$exams_course = new exams_course();
	$exams_chapters = new exams_chapters();
	$exams_options = new exams_options();
	
	
	$chap_id = $_GET['sid'];
	$quse_id = $_GET['qid'];
	$opt_id = $_GET['qid1'];
	$ans_id = $_GET['qid2'];
	
	$ques_details = $exams_questions->questions_selectall('que_id',$quse_id);
	
	$opt_details = $exams_options->options_selectall('opt_id',$opt_id);
	
	$ans_details = $exams_answers->answers_selectall('ans_id',$ans_id);
	if(!empty($_POST))
	{
		$array = array("question~!@".addslashes($_POST['textarea1'])."");
		$where = "que_id =".$_POST['que_id']."";
		$q_up = $exams_questions->questions_update($array,$where);
		$array1 = array("options~!@".addslashes($_POST['txt4'])."");
		$where1 = "opt_id =".$_POST['opt_id']."";
		
		$o_up = $exams_options->options_update($array1,$where1);
		
		$array2 = array("answer~!@".addslashes($_POST['txt5'])."");
		$where2 = "ans_id =".$_POST['ans_id']."";
		
		$a_up = $exams_answers->answers_update($array2,$where2);
		
		if($q_up && $o_up && $a_up) 
		{ 			
			?> <script> location.href= 'sectiona_bulk.php?id=<?php echo $_POST['chap_id']; ?>&sec=<?php echo $_POST['sec']; ?>'; </script> <?php
		}	
	}


?>

 <script type="text/javascript" src="../../../script/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script><table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="global" >
                    <tbody><tr>
                      <td align="left"><table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td  valign="top"><table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                              <tbody>
                              
                                <tr>
                                  <td class="h2" height="30"><strong>Manage Questions </strong></td>
                                </tr>
                             
                                
                              </tbody>
                            </table>
                              
                              <form method="post" name="mange_teacher" id="formFamily"  action="" style="margin: 0px; padding: 0px;" enctype="multipart/form-data">
                                <table class="listingheadingsborders" align="center" border="0" cellpadding="0" cellspacing="0" width="90%" height="60%">
                                  <tbody><tr>
								  <td width="100%" align="center"><table width="100%" height="94" border="0">
								    <tr>
								      <td ><table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td valign="center">&nbsp;</td><td>&nbsp;</td></tr>

<tr><td align="right"><label>Question:</label></td>
  <td>  <textarea id="textarea1" name="textarea1"><?php echo $ques_details['question'];?></textarea></td></tr>
<tr><td align="right"><label>Options</label></td>
  <td><textarea name="txt4" /><?php echo $opt_details['options'];?></textarea></td></tr>
<tr><td align="right"><label>Correct Option</label></td><td>
<textarea name="txt5" /><?php echo $ans_details['answer'];?></textarea></td></tr>
</table></td>
</table></td>
								  <tr height="80%"><td height="2"></td>
									<td></td></tr>
									<tr>
									<td height="5" colspan="3"></td></tr>
                                  </tbody>
                                </table>
                                <br />
                                <table  align="center" border="0" cellpadding="0" cellspacing="5" width="90%">
                                  <tbody>
                                    <tr valign="middle">
                                      <td align="center" width="44%">&nbsp;</td>
                                      <td align="left" width="56%"><strong>
                                        <input name="edit" class="button_light" value="Update" type="submit" />
										<a href="sectiona_bulk.php?id=<?php echo $_REQUEST['sid']?>&sec=<?php echo $_REQUEST['sec'];?>"><input name="reset" class="button_light" value="Cancel" type="reset" /></a>
                                        </strong></td>
                                    </tr>
                                  </tbody>
                                </table>
                                <br /><input type="hidden" name="que_id" value="<?= $_GET['qid'] ?>"  /><input type="hidden" name="opt_id" value="<?= $_GET['qid1'] ?>"  /><input type="hidden" name="ans_id" value="<?= $_GET['qid2'] ?>"  /><input type="hidden" name="chap_id" value="<?= $_GET['sid'] ?>"  /><input type="hidden" name="sec" value="<?= $_GET['sec'] ?>"  />
                            </form></td>
                        </tr>
                          <tbody>
                        </tbody></table></td>
                    </tr>
                  </tbody></table></table>
                    
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
                    
  