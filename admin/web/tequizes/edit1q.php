<head>
<script language="javascript">
	function chkform()
	{
		getForm("mform1");
		if(!IsEmpty("testname","Enter test name"))return false;
		if(!IsEmpty("testheading","Please Enter test heading"))return false;
		if(!IsNumber("time","Please Enter test time"))return false;
	}
</script>

</head>

    <form action="" method="post" accept-charset="utf-8" id="mform1" name="mform1" class="mform" onSubmit="return chkform();">
  <input type="hidden" name="pageNumber" value="<?php echo $_REQUEST['pageNumber']; ?>" />
<input type="hidden" name="al" id="al" value="<?php echo $_REQUEST['al'];?>" />
	<input type='hidden' name="qid" value='<?php echo $_REQUEST['id'];?>'>
    <input type='hidden' name="cid" value='<?php echo $_REQUEST['cid'];?>'>
    <input type='hidden' name="id" value='<?php echo $_REQUEST['chapid'];?>'>
    <table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="global">
										<tbody>
											
											<tr><td colspan="3"><?php // echo $_SESSION['msg']; if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?></td></tr>
											
                                            <tr>
												<td align="center" colspan="6"><h2>Edit Cost</h2></td>
											</tr>
											<tr>
												<td colspan="6">  
 <table cellpadding="0" cellspacing="0" class="tborder" width="100%">
 <tr><td width="45%" align="right"><label>Grade</label>
 </td>
 <td width="55%"><?php 

											$s="select * from test_grades where grade_id=".$course['grade_id']."";
											
											$q=$objSql->executeSql($s);
											$qa=$objSql->fetchRow($q);
											
											echo $qa['grade_name'];?></td>
 </tr>
<tr><td align="right"><label>Curriculum</label></td><td><?php echo $curri["cur_name"];?></td></tr>
<tr><td align="right"><label>Chapter</label></td><td><?php echo $chapter['chap_name'];?></td></tr>
<tr><td align="right"><label><font size="4" color="#ff0000"><b>
                                                          *</b></font> Test name</label></td><td><input maxlength="200" size="40" name="testname" value="<?php echo $test['test_name'];?>" type="text"></td></tr>
<tr><td align="right"> <label><font size="4" color="#ff0000"><b>
                                                          *</b></font>Test Heading</label></td><td><input maxlength="100" size="20" name="testheading" value="<?php echo $test['test_heading'];?>"  type="text"></td></tr>
<tr><td align="right"><label> <font size="4" color="#ff0000"><b>
                                                          *</b></font>Test Time</label></td><td><input maxlength="100" size="20" name="time" id="time" value="<?php echo $test['time'];?>"  type="text">&nbsp;&nbsp;(In Minutes)</td></tr>


<tr><td colspan="2" align="center"><input name="submitbutton" value="Save changes" type="submit"></td></tr>

                                            </table></td></tr></tbody></table>
<!--<fieldset class="clearfix" >
		<legend class="ftoggler">General Quiz Settings </legend>
		<div class="advancedbutton"></div>
		<div class="fcontainer clearfix">
		</div>

<div class="fitem">
<div class="fitemtitle">Grade

<img src=" edit.php_files/help.gif"  /></div><div class="felement fselect">
<?php 

											$s="select * from test_grades where grade_id=".$course['grade_id']."";
											
											$q=$objSql->executeSql($s);
											$qa=$objSql->fetchRow($q);
											
											echo $qa['grade_name'];?>
        
          </div></div>

<div class="fitem"><div class="fitemtitle">Curriculum 

<img src=" edit.php_files/help.gif"  /></div><div class="felement fselect"><?php echo $curri["cur_name"];?></div></div>
<div class="fitem"><div class="fitemtitle">Chapter 

<img src=" edit.php_files/help.gif"  /></div><div class="felement fselect"><?php echo $chapter['chap_name'];?></div></div>
<div class="fitem required">
<div class="fitemtitle">
		  Test name<img  src=" edit.php_files/req.gif">
		 <img src=" edit.php_files/help.gif"  />	</div>
<div class="felement ftext"><input maxlength="200" size="40" name="testname" value="<?php echo $test['test_name'];?>" type="text"></div></div>
		<div class="fitem required">
		  <div class="fitemtitle">
		
		 Test Heading <img  src=" edit.php_files/req.gif"><img src=" edit.php_files/help.gif"  />
		</div>
		  <div class="felement ftext"><input maxlength="100" size="20" name="testheading" value="<?php echo $test['test_heading'];?>"  type="text"></div></div>
  
<div class="fitem"></div>
		</div>
        <div class="fitem required">
		  <div class="fitemtitle">
		
		 Test Time <img  src=" edit.php_files/req.gif"><img src=" edit.php_files/help.gif"  />
		</div>
		  <div class="felement ftext"><input maxlength="100" size="20" name="time" id="time" value="<?php echo $test['time'];?>"  type="text">&nbsp;&nbsp;(In Minutes)</div></div>
  
<div class="fitem"></div>
		</div>
<div class="fitem"></div>
</div></label></fieldset>

</select>
<fieldset class="hidden"><div>
<div class="fitem"><div class="fitemtitle"><div class="fgrouplabel">
<input name="submitbutton" value="Save changes" type="submit"> </fieldset></div>
<div class="fdescription required">There are required fields in this form marked.</div>
		</div></fieldset>

</div>
-->
</form>






		




