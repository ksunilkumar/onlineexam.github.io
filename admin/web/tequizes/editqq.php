<?php
include_once'../../../lib/db.php';
include_once'../../../lib/class_exam_course.php';
include_once'../../../lib/class_exam_chapters.php';
include_once'../../../lib/class_exam_curriculum.php';
include_once'../../../lib/ise_settings.class.php';
$queries = new Queries();
$objSql = new SqlClass();
$exams_course = new exams_course();
$exams_chapters = new exams_chapters();
$exams_curriculum = new exams_curriculum();
$settings = new ise_Settings();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" dir="ltr" xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="edit.php_files/styles.css">
<script language="JavaScript" src="../../../js/costchap.js" type="text/javascript"></script>

   
   <form action="" method="post" accept-charset="utf-8" id="mform1"  name="mform1" class="mform" onsubmit="return chkform()">
	<input type="hidden" name="id" value="<?php echo $chapid;?>" />	<input type="hidden" name="cid" value="<?php echo $couid;?>" />

  <table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="global">
										<tbody>
											
											<tr><td colspan="3"><?php // echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td></tr>
											
                                            <tr>
												<td align="center" colspan="6"><h2>Add Test</h2></td>
											</tr>
											<tr>
												<td colspan="6">  
 <table cellpadding="0" cellspacing="0" class="tborder" width="100%">
<tr valign="middle">
                                          <td class="tr2" align="right" height="26" width="40%"><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>School</label></td>
                                          <td colspan="2" class="tr2" align="left" height="26">
                                          <select name='school' onchange="javascript:call('11')" id='school'>
                                          <option value="all">--Select--</option>
										  <?php 
										  $schools=$settings->get_school_all_names();
										  while($school_row = $objSql->fetchRow($schools))
										  {
										   ?>
                                           <option value='<?php echo $school_row['school_id'];?>'><?php echo $school_row['school_name'];?></option>
                                           <?php
										   }
										  ?>
                                          </select>
                                          </td>
                                </tr> 
                                <tr valign="middle">
                                          <td class="tr2" align="right" height="26" width="40%"><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Curriculum</label></td>
                                          <td colspan="2" class="tr2" align="left" height="26"><div id='cur1'><select name='cur' onchange="javascript:call('15')" id='cur'><option value="all">--Select--</option>
										  </select></div></td>
                                        </tr> 
<tr><td align="right"><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Subject</label></td><td><div id="subject"><select name='sub'  id='sub'><option value="">--Select--</option>
										  </select></div></td></tr>
<tr><td align="right"><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Grade</label></td><td><input type="hidden"  name="cid1" id='cid1'/><div id='grade12'>
<select name='grade' id='grade'><option value="all">--Select--</option></select></div></td></tr>
<tr><td align="right"><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Chapter</label></td><td><div id="chap">
<select id="chno" name="chno"><option value='all'>--select--</option></select></div></td></tr>
<tr><td align="right"><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Test name</label></td><td><input maxlength="254" size="50" name="testname" value="" type="text"></td></tr>
<tr><td align="right"><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Test Heading</label></td><td><input maxlength="100" size="20" name="testheading" value=""  type="text"></td></tr>
<tr><td align="right"><label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Test Time</label></td><td><input maxlength="100" size="20" name="time"  id="time" value=""  type="text">&nbsp;&nbsp;(In Minutes)</td></tr>
<tr><td align="center" colspan="2"><input name="submitbutton" value="Save changes" type="submit"> </fieldset></div>
</td></tr>
</table></td></tr></tbody></table>
 <!-- 
<fieldset class="clearfix" >
		<legend class="ftoggler">General Quiz Settings </legend>
		<div class="advancedbutton"></div>
		<div class="fcontainer clearfix">
		</div>

<div class="fitem">

<div class="fitemtitle">Curriculum 

<img src="edit.php_files/help.gif"  /></div><div class="felement fselect">

	<?php 
				
					$cur = $exams_curriculum->curriculum_allname_select($_SESSION['school_id']);
					//print_r($cur);
                    //$s="select * from curriculum";
				//	$q1=mysql_query($s);
					
					?>
				<select name='cur' onchange="javascript:call('15')" id='cur'><option value="">--Select--</option>
					<?php
							/*while($r1=mysql_fetch_object($q1))
							{}*/
							 while($row = $objSql->fetchRow($cur)){
							echo "<option value=".$row['cur_id'].">".$row['cur_name']."</option>";
							}
                        ?></select></div></div>
                                          <div class="fitem">
<div class="fitemtitle">Subject

<img src="edit.php_files/help.gif"  /></div><div class="felement fselect"><div id="sub1" ><select name='sub'  id='sub'><option value="">--Select--</option>
										  </select></div></div>
<div class="fitem">
<div class="fitemtitle">Grade

<img src="edit.php_files/help.gif"  /></div><div class="felement fselect"><input type="hidden"  name="cid1" id='cid1'/><div id='grade12'>
<select name='grade' id='grade'><option value="all">--Select--</option></select></div></div></div>


<div class="fitem"><div class="fitemtitle">Chapter 

<img src="edit.php_files/help.gif"  /></div><div class="felement fselect"><div id="chap">
<select id="chno" name="chno"><option value='all'>--select--</option></select></div></div></div>

<div class="fitemtitle">
		  Test name<img  src="edit.php_files/req.gif">
		 <img src="edit.php_files/help.gif"  />
	</div><div class="felement ftext"><input maxlength="254" size="50" name="testname" value="" type="text"></div></div>
		<div class="fitem required">
		<div class="fitemtitle">
		
		 Test Heading <img  src="edit.php_files/req.gif"><img src="edit.php_files/help.gif"  />
		</div><div class="felement ftext"><input maxlength="100" size="20" name="testheading" value=""  type="text"></div></div>
	
  </div>
  	<div class="fitemtitle">
		
		 Test Time <img  src="edit.php_files/req.gif"><img src="edit.php_files/help.gif"  />
		</div><div class="felement ftext"><input maxlength="100" size="20" name="time"  id="time" value=""  type="text">&nbsp;&nbsp;(In Minutes)</div></div>
		<div class="fitem"></div>
  </div>
  

</select>



<fieldset class="hidden"><div>
<div class="fitem"><div class="fitemtitle"><div class="fgrouplabel">
<input name="submitbutton" value="Save changes" type="submit"> </fieldset></div>
<div class="fdescription required">There are required fields in this form marked.</div>
		</div></fieldset>

</div>

</body></html>-->
</form>

