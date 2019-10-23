<?php
session_start();
 include_once 'lib/db.php';
 
 user_login_check();
?>
<?php
include_once ("lib/test_gen_class.php");
$generator = new TestGenerator();
$objSql = new SqlClass();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo Site_Title; ?></title>
<link rel="shortcut icon" href="favicon.png" type="image/x-icon" />

<!--CSS/Style Sheet Part Starting-->
<link rel="stylesheet" href="css/site_styles.css" />
<!--CSS/Style Sheet Part Ending-->

<!-- Javascript Part Starting-->
<!-- #################### -->
<script language="javascript" src="js/test_scripts.js"></script>
<script language="javascript" src="js/datetimepicker.js"></script>

<script language="javascript" type="text/ecmascript">
var timeout	= 500;
var closetimer	= 0;
var ddmenuitem	= 0;
var defId = 0;
// open hidden layer
function mopen(id){	
	mcancelclosetime();
	if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';
	ddmenuitem = document.getElementById(id);
	ddmenuitem.style.visibility = 'visible';
	if(document.getElementById('divLi'+defId))
		document.getElementById('divLi'+defId).className = "arrow_down";	
	if(document.getElementById('divLi'+id))
		document.getElementById('divLi'+id).className = "arrow_up";
	defId = id;
}
// close showed layer
function mclose(){
	if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';
	if(document.getElementById('divLi'+defId))
		document.getElementById('divLi'+defId).className = "arrow_down";
}
// go close timer
function mclosetime(){
	closetimer = window.setTimeout(mclose, timeout);
}
// cancel close timer
function mcancelclosetime(){
	if(closetimer){
		window.clearTimeout(closetimer);
		closetimer = null;
	}
}
// close layer when click-out
document.onclick = mclose;	
</script>
<script language="javascript">
function countquestion(obj,rowID,f1,catid){
	if(document.getElementById("dl["+rowID+"]") == "undefined" || document.getElementById("dl["+rowID+"]") ==null)
	dl =0;
	else
	dl = document.getElementById("dl["+rowID+"]").value;
	tempval = parseInt(obj.value);
	//cnter = tempval.replace(/[^\d]/g,"");
	 var limit=parseInt(100);
	if(tempval>limit){
		alert("No. of questions chosen cannot exceed1 "+limit+"!")
		obj.value="100";
	}
	ahahscript.ahah('ajaxUpdates.php?mode=chkEmptyCat&catid='+catid+'&totnumb='+tempval+'&dl='+dl+'&rowId='+rowID, 'divEmpty'+rowID, '', 'GET', '', this);
}
function add_time(sec, val,obj){
	val = val.replace(/[^\d]/g,"");
	obj.value = val;
	document.getElementById("OverLayDiv").style.display="block";
	ahahscript.ahah("quesnum.php?ccc="+sec+"&act=addtime&tt="+val, "tt"+sec+"1", "", "GET", "", this);
}
function checkempty(ccc, count){
	var cnt=0;
	f = document.form1;
	for(z=0; z<f.length;z++){
		if(f[z].type == 'text'){
			var done="ok";
			var str = f[z].name;
			var patt1=/choosenum/;
			var patt2=/tt/;
				if(patt1.test(str)){
							cnt = cnt + parseInt(f[z].value);
							if(f[z].value==0){
								alert("Number of question must be more than 0.");
								f[z].value=0;
								f[z].focus();
								done="notok";
								break;
							}
							else if(cnt>100){
								 alert("Total number of questions cannot exceed 100.");
								 f[z].focus();
								 done="notok";
								}
				}
				else if(patt2.test(str)){
						if(f[z].value==0){
								alert("Please enter the time for this section.");
								f[z].value=0;
								f[z].focus();
								done="notok";
								break;
							}
				}
		}
		if(f[z].type == 'hidden' && f[z].name == "section[]"){
				alert("Please select category for section "+f[z].value);
				done="notok";
				break;
		}
	}
		if(done=="ok"){
			document.form1.submit();	
			 //window.location="sections.php?mode=update&ccc="+ccc;
		}
	}
function showActionDiv(section){
	document.getElementById("action"+section).style.display = "block";
	sectionDiv = "#section"+section;
	 $(sectionDiv).slideDown("slow");
	//document.getElementById().style.display = "block";
	document.getElementById("edit"+section).style.display = "none";
	}
function clickte(cid, ccc){
	if(document.getElementById('catid'+cid+ccc).style.display=='none'){
		document.getElementById("loadingImg").style.display="block";
		ahahscript.ahah('categ_left.php?cid='+cid+'&ccc='+ccc, 'catid'+cid+ccc, '', 'GET', '', this);
		document.getElementById('catid'+cid+ccc).style.display='block';
		document.getElementById('minus'+cid+ccc).style.display='block';
		document.getElementById('pid'+cid+ccc).style.background='#0769B2';
		document.getElementById('pid'+cid+ccc).style.color='#FFFFFF';
		document.getElementById('add'+cid+ccc).style.display='none';
	} else {
		document.getElementById('catid'+cid+ccc).style.display='none';
		document.getElementById('minus'+cid+ccc).style.display='none';
		document.getElementById('add'+cid+ccc).style.display='block';
		document.getElementById('pid'+cid+ccc).style.background='#FFFFFF';
		document.getElementById('pid'+cid+ccc).style.color='#7B9BBD';
	}
}
function tabular(idname){
	if(document.getElementById(idname)){
		 if(document.getElementById(idname).style.display=='none')
			  document.getElementById(idname).style.display='block';
		 else
			  document.getElementById(idname).style.display='none';
	}	
}
function addsec(nxtsec, cnt, secquestion, sectiontime, add){
	document.getElementById("instructions").style.display='none';
	document.getElementById("loadingImg").style.display="block";
	  var sec = (nxtsec-1);
	  var proceed, idy;
		 for(var k=0; k<cnt; k++){
		  if(document.getElementById("choosenum"+sec+k).value=='0'){
			 proceed = 'no';
			 idy = "choosenum"+sec+k;
			 break;
			}else{
			 proceed = 'yes';
			}
		 }
	if(parseInt(secquestion)>100){
	 proceed='nes';
	}	 
	if(parseInt(sectiontime)==0){
	 proceed='notime';
	}
  if(add=='true') value=1; else value=0;
	if(proceed=='no'){
		alert("Select number of questions.");
		document.getElementById(idy).focus();
		document.getElementById("loadingImg").style.display="none";
	}else if(proceed=='notime'){
		alert("Sectional time cannot be left empty.");
		document.getElementById("instructions").style.display="block";
		document.getElementById("instructions").innerHTML="Sectional time here you'll enter will be in minutes and it cannot be left zero.";
		document.getElementById("loadingImg").style.display="none";
	}else if(proceed=='nes'){
		alert("Total questions in a section cannot exceed 100.");
		document.getElementById("instructions").style.display="block";
		document.getElementById("instructions").innerHTML="Number of questions in evry section cannot exceed a limit of 100.";
		document.getElementById("loadingImg").style.display="none";
	}else{
		ahahscript.ahah('home.php?ccc='+nxtsec+'&nextSection=yes&value='+value+'&secquestion='+secquestion, 'MainIndex', '', 'GET', '', this);
	}     
}
function remsec(nxtsec){
  document.getElementById("loadingImg").style.display="block";
  ahahscript.ahah('home.php?ccc='+nxtsec+'&remSection=yes', 'MainIndex', '', 'GET', '', this);
}
function remcat(cid, sec){
	document.getElementById("DivWithLink"+cid).style.display="block";
	document.getElementById("DivWithoutLink"+cid).style.display="none";
	document.getElementById("loadingImg").style.display="block";
	ahahscript.ahah('selected_categ.php?cid='+cid+'&ccc='+sec+'&act=terminate', 'collect', '', 'GET', '', this);
}
function testDetails(cnt){
   document.getElementById("loadingImg").style.display="block";
   var total = 0;
   	 for(var k=1; k<=cnt; k++){
	 total = total + parseInt(document.getElementById("secquestion"+k).innerHTML);
		if(parseInt(document.getElementById("secquestion"+k).innerHTML)==0){
		 var proceed = 'no';
		 break;
		}else if(parseInt(document.getElementById("tt"+k).value)==0){
		 ttdiv = "tt"+k;
		 var proceed = 'notime';
		 break;
		}else{
		 var proceed = 'yes';
		}
	 }
	 	if(total>100){
		 var proceed = 'nes';
		}
		
	if(proceed=='no'){
		alert("Select number of questions.");
		document.getElementById("loadingImg").style.display="none";
	}else if(proceed=='notime'){
		alert("Select sectional time.");
		document.getElementById(ttdiv).focus();
		document.getElementById("loadingImg").style.display="none";
	}else if(proceed=='nes'){
		alert("Total number of questions cannot exceed 100.");
		document.getElementById("loadingImg").style.display="none";
	}else{
		ahahscript.ahah('home.php?nextSection=yes&finish=1&ccc=-1', 'MainIndex', '', 'GET', '', this);
	}
}
function add_time(sec, val){
	document.getElementById("loadingImg").style.display="block";
	ahahscript.ahah("quesnum.php?ccc="+sec+"&act=addtime&tt="+val, "tt"+sec, "", "GET", "", this);
}

</script>
<script type="text/javascript" language="javascript">
document.onclick=check;
function check(e){
	var target = (e && e.target) || (event && event.srcElement);
	checkParent(target)?hide():null;
}
function checkParent(t){
	while(t.parentNode){
		if(t==document.getElementById('divName') || t=="" || t==document.getElementById('divTestName')){
			return false;
		}
		t=t.parentNode
	}
	return true
}
function bindEndDate(f1){	
	startDate =  f1.startDate.value;
	$('#searchVal').datepick('option',{minDate: startDate});	
}	
function checkEmpty(f1){
	if(f1.searchKey.value == 'datime'){
		if(f1.dateFrom.value=='' || f1.dateFrom.value == 'from'){
			document.getElementById("searchMsg").innerHTML = "Select a search criteria and enter value";
			return false;
		}
		if(f1.dateTo.value=='' || f1.dateTo.value == 'to'){
			document.getElementById("searchMsg").innerHTML = "Select a search criteria and enter value";
			return false;
		}		
	}else if(f1.searchKey.value == 'test_name' && (f1.searchKey.value=="" || f1.searchVal.value=="")){
		if(f1.nameKey.value != 'All'){
			document.getElementById("searchMsg").innerHTML = "Select a search criteria and enter value";
			f1.searchVal.value = "";
			return false;
		}
	}
	document.getElementById("searchMsg").innerHTML = '&nbsp;';
	sendRequest(f1,'list');
}
function checkDate(f1){
	switch(f1.searchKey.value){
		case "test_name":
			if(document.getElementById('nameKey').value == 'All') document.getElementById('searchVal').style.display = "none";
			else document.getElementById('searchVal').style.display = "block";
			document.getElementById('nameDiv').style.display = "block";
			document.getElementById('startDateDiv').style.display = "none";
			document.getElementById('srch_but').style.display = "block";			
		break;
		case "questionNo":
			document.getElementById('searchVal').style.display = "block";
			document.getElementById('nameDiv').style.display = "none";
			document.getElementById('startDateDiv').style.display = "none";
			document.getElementById('srch_but').style.display = "block";
		break;
		case "datime":
			document.getElementById('searchVal').style.display = "none";
			document.getElementById('nameDiv').style.display = "none";
			document.getElementById('startDateDiv').style.display = "block";
			document.getElementById('srch_but').style.display = "block";
		break;
		case "0":
			document.getElementById('nameKey').value = 'All';
			document.getElementById('searchVal').style.display = "none";
			document.getElementById('nameDiv').style.display = "none";
			document.getElementById('startDateDiv').style.display = "none";
			document.getElementById('srch_but').style.display = "none";
		break;
			
	}
	if(f1.searchKey.value == "datime"){
		dateFrom =	document.getElementById('dateFrom');
		dateToF = document.getElementById('dateTo');

		dateFrom.value = "from";
		dateToF.value = "to";		
		dateFrom.className = "DatePicker";
		dateToF.className = "DatePicker";		
		$$('input.DatePicker').each( function(el){
			new DatePicker(el);
		});
	}else{
		document.getElementById('searchVal').value = '';
		document.getElementById("searchMsg").innerHTML = '&nbsp;';
		searchVal_id =	document.getElementById('searchVal');
		document.getElementById('searchVal').readOnly=false;
		searchVal_id.className = "textfield";
	}
}
function BindArguments(fn){
  var args = [];
  for (var n = 1; n < arguments.length; n++)
    args.push(arguments[n]);
  return function () { return fn.apply(this, args); };
}  
function validatefrmName(f) {
	if(trim(f.txtTestName.value)==""){
		alert("Test name can't be left blank.");
		return false;
	} else {
		sendRequest(f,document.frmName.hiddTstId.value);
		hide();
		return false;
	}
}
</script>

<!-- Javascript Part Ending-->
</head>

<body>
<?php include 'includes/light_box.php'; ?>
<div id="divTestName" style="visibility: hidden; z-index: 2; position: absolute;">
	<form name="frmName" action="ajaxUpdates.php?mode=upTestName" onsubmit="return validatefrmName(this)" style="margin: 0px; padding: 0px;">
    	<input name="hiddTstId" id="hiddTstId" size="20" type="hidden">
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tbody><tr>
                <td><input name="txtTestName" id="txtTestName" class="div_test_name_Text" type="text"></td>
                <td><input value="Update" class="div_test_name_submit" id="Update" type="submit"></td>

            </tr>
        </tbody></table>
	</form>
</div>
<div id="icon"></div>

<!-- Main Table with 3 columns -->
<table width="947" border="0" align="center" cellpadding="0" cellspacing="0">
<!-- Header Row Content -->
<?php
include_once 'includes/header.php';
?>
<!-- Header Row Content -->

<!-- Breadcrum() -->
<tr><td colspan="3" align="left" style="padding:5px; background-image:url(images/sprite_01.jpg); background-repeat:repeat-x;">&nbsp;<?php breadcrum(); ?></td></tr>
<!-- Breadcrum()-->

<!-- Middle Row Content -->
<tr>
   <td colspan="3" bgcolor="#FFFFFF" class="sprite_padding_1">
   <table width="100%" border="0" cellspacing="0" cellpadding="0" height="200">
      <tr>
        <!-- Left Coloumn Code -->
        <td width="185" style="padding-left:0px; padding-right:0px;" valign="top"><?php include_once 'tab_02_templete.php'; ?><?php include_once 'tab_01_templete.php'; ?><?php include_once 'tab_03_templete.php'; ?></td>
        <!-- Center Coloumn Code -->
        <td width="*" style="padding-left:6px; padding-right:6px;" valign="top">
        <?php echo ucwords($_SESSION['msg']); if(!empty($_SESSION['msg']))unset($_SESSION['msg']); ?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
          <tr bgcolor="#F68122">
            <td width="6" style="background:url(images/sprite_05.jpg) left no-repeat;" height="27">&nbsp;</td>
            <td background="images/sprite_07.jpg" class="content_head" ><strong>My Generated Tests</strong>
              <div style="float: right; padding-left: 25px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; color: rgb(17, 78, 171); font-weight: bold;" id="listDivWait"></div></td>
            <td width="6" style="background:url(images/sprite_06.jpg) right no-repeat;" height="27">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top" class="sprite_padding_1 main_box_border">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="40" align="right" ><a href="javascript:void();"><img src="images/gtest_btn.png" alt="genarate_text" border="0" onclick="loadwindow('categ_left_xml.php?ccc=1&amp;newSection=yes&amp;addNew=yes&amp;showButton=yes','690','500')" /></a></td>
              </tr>
              <tr>
                <td height="32" align="center" bgcolor="#F7F4ED"  style="border:#d9d9d9 solid 1px;">
<form id="searchForm" name="searchForm" method="post" action="gen_test_account_inc_ajax.php" onsubmit="return false;">
      <input name="mode" value="search" type="hidden" />
      <table width="98%" border="0" cellpadding="0" cellspacing="0"  background="images/blue_rnd_admin_center.png" height="40px;" >
        <tbody>
          <tr>
            <td class="search_by" align="left" valign="middle" width="12%"><span class="web_font_9"><strong>Search By</strong></span></td>
            <td align="left" valign="middle" width="23%"><select name="searchKey" class="textfield" id="searchKey" onchange="checkDate(this.form)">
                <option value="0"> -Select- </option>
                <option selected="selected" value="test_name">Name</option>
                <option value="datime">Date</option>
              </select>            </td>
            <td width="65%" align="left" valign="middle"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                  <tr>
                    <td align="left" width="330px"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                          <tr>
                            <td align="left"><div id="nameDiv" style="clear: both; width: 325px;">
                                <div style="float: left;">
									<select name="nameKey" id="nameKey" class="textfield" onchange="if(this.value == 'All'){ document.getElementById('searchVal').style.display='none' }else{ document.getElementById('searchVal').style.display='block' }">
                                      <option value="All" selected="selected">All</option>
                                      <option value="startsWith">starts with</option>
                                      <option value="contains">contains</option>
                                    </select>
                                </div>
                              <div style="float: right;">
                                  <input style="display: none;" name="searchVal" class="textfield" id="searchVal" type="text" />
                                </div>
                            </div></td>
                            <td align="left"><div id="startDateDiv" style=" display: none; width: 325px;">
                                                      <div style="float:left;">
                                                        <input name="dateFrom" class="textfield" value="from" id="dateFrom" type="text" readonly="readonly" style="width:110px;" />
                                                       </div>
                                                       <div style="float:left;">
                                                      <a href="javascript:NewCssCal('dateFrom','yyyymmdd')"><img src="images/Calendarsmall.png" border="0" width="16" height="16" /></a>
                                                      </div>
                                                      <div style="float:left">&nbsp;&nbsp;</div>
                                                      <div style="float:left;">
                                                        <input name="dateTo" class="textfield" value="to" id="dateTo" type="text" readonly="readonly" style="width:110px;"  />
                                                       </div>
                                                       <div style="float:left;">
                                                      <a href="javascript:NewCssCal('dateTo','yyyymmdd')"><img src="images/Calendarsmall.png" border="0" width="16" height="16" /></a>
                                                      </div>
                                                  </div></td>
                          </tr>
                        </tbody>
                    </table></td>
                    <td align="left"><input type="image" name="srch_but" id="srch_but" src="images/search_btn.png" onclick="checkEmpty(this.form)" /></td>
                  </tr>
                </tbody>
            </table></td>
          </tr>
        </tbody>
      </table>
      <div id="searchMsg" align="center">&nbsp;</div>
      </form>                
                </td>
              </tr>
              <tr>
                <td height="8"></td>
              </tr>
              <tr>
                <td>
                <div id="list">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:#dbdbdb solid 1px;">
                  <tr>
                    <td width="40" height="24" align="center" valign="middle" class="test_list_border web_font_9"><strong>No</strong></td>
                    <td width="1" height="24" align="center" valign="middle" class="test_list_border web_font_9"></td>
                    <td width="158" height="24" align="center" valign="middle" class="test_list_border web_font_9"><strong>Test Name<a href="javascript:void(0);" onclick="ahahscript.ahah('gen_test_account_inc_ajax.php?sort=nameASC&amp;pNo=1&amp;gen_test=', 'list', '', 'GET', '', this);" style="text-decoration: none;"><img src="images/a1.png" border="0" /></a><a href="javascript:void(0);" onclick="ahahscript.ahah('gen_test_account_inc_ajax.php?sort=dateASC&amp;pNo=1&amp;gen_test=', 'list', '', 'GET', '', this);" style="text-decoration: none;"><img src="images/a2.png" alt="arrow" width="16" height="12" border="0" /></a></strong></td>
                    <td width="1" height="24" align="center" valign="middle" class="test_list_border web_font_9"></td>
                    <td width="92" height="24" align="center" valign="middle" class="test_list_border web_font_9"><strong>Date <a href="javascript:void(0);" onclick="ahahscript.ahah('gen_test_account_inc_ajax.php?sort=dateASC&amp;pNo=1&amp;gen_test=', 'list', '', 'GET', '', this);" style="text-decoration: none;"><img src="images/a1.png" border="0" /></a><a href="javascript:void(0);" onclick="ahahscript.ahah('gen_test_account_inc_ajax.php?sort=dateDESC&amp;pNo=1&amp;gen_test=', 'list', '', 'GET', '', this);" style="text-decoration: none;"><img src="images/a2.png" alt="arrow" width="16" height="12" border="0" /></a></strong></td>
                    <td width="1" height="24" align="center" valign="middle" class="test_list_border web_font_9"></td>
                    <td width="117" height="24" align="center" valign="middle" class="test_list_border web_font_9"><strong>Questions</strong></td>
                    <td width="1" height="24" align="center" valign="middle" class="test_list_border web_font_9"></td>
                    <td width="95" height="24" align="center" valign="middle" class="test_list_border web_font_9"><strong>Time (min)</strong></td>
                    <td width="1" height="24" align="center" valign="middle" class="test_list_border web_font_9"></td>
                    <td height="24" align="center" valign="middle" class="test_list_border web_font_9"><strong>Actions</strong></td>
                    </tr>
                  <?php

$objsql = new SqlClass();
$sort='sort=dateDESC';
$qry="select * from test_tests where user_id=".$_SESSION['user_id']." order by created_date DESC";
// $rs=$objsql->executeSql($qry);

$pagination_key = new pagination_key;
$pagination_key->createPaging($qry,5);
$bagsize=$pagination_key->recordsize();
$allpages=$pagination_key->pages;

	if(isset($_REQUEST['page']) && $_REQUEST['page']!='')
		$cpg=$_REQUEST['page'];
	else
		$cpg=1;

$url='gen_test_account_inc_ajax.php?'.$sort;

$i=1;
while($row=mysql_fetch_object($pagination_key->resultpage))
{
/*	echo '<pre>';
	print_r($row);
	echo '</pre>';
*/
	if($i%2==0)
		$bg='blue_bg_admin';
	else
		$bg='grey_bg_admin';
	
?>
                  <tr>
                    <td height="30" align="center" valign="middle" class="web_font_9 test_list_border"><?php echo $i; ?></td>
                    <td align="center" valign="middle" class="web_font_9 test_list_border"></td>
                    <td align="center" valign="middle" class="web_font_9 test_list_border"><div id="<?php echo $row->test_id; ?>" onmouseover="ShowEditIcon(this.id,1)" onmouseout="ShowEditIcon(this.id,0)" style="cursor: default; position: relative; margin-left:3px;">
                          <div id="divName<?php echo $row->test_id; ?>" style="float: left;" title="<?php echo $row->test_name; ?>"><?php echo $row->test_name; ?></div>
                        <div id="divIcon<?php echo $row->test_id; ?>" style="display: none; float: left;"><a onclick='javascript:ShowTestNameDiv(&quot;<?php echo $row->test_id; ?>&quot;,&quot;<?php echo $row->test_name; ?>&quot;);' style="cursor: pointer; text-decoration:none;">&nbsp;&nbsp;<img src="images/edit.gif" border="0" /></a></div>
                    </div></td>
                    <td align="left" valign="middle" class="web_font_9 test_list_border"></td>
                    <td align="center" valign="middle" class="web_font_9 test_list_border"><?php echo date("M d, Y",strtotime($row->created_date)); ?></td>
                    <td align="center" valign="middle" class="web_font_9 test_list_border"></td>
                    <td align="center" valign="middle" class="web_font_9 test_list_border"><?php echo $row->numques; ?></td>
                    <td align="center" valign="middle" class="web_font_9 test_list_border"></td>
                    <td align="center" valign="middle" class="web_font_9 test_list_border"><?php echo $row->testtime; ?></td>
                    <td align="center" valign="middle" class="web_font_9 test_list_border"></td>
                    <td width="112" align="center" valign="middle" class="web_font_9 test_list_border"><div style="padding-top: 2px; text-align:center" id="1t"><img src="images/aa33.png" align="absmiddle" />&nbsp;
                      <?php if($row->status==0) { ?>
                      <a href="Generate.php?testids=<?php echo $row->test_id; ?>gen&amp;section=0&amp;paidTest=0&amp;qno=<?php echo $row->numques; ?>&amp;type=new" title="Take Test" class="web_font_9"><strong>Take Test</strong></a>
                      <?php } else { ?>
                      <a href="Generate.php?testids=<?php echo $row->test_id; ?>gen&amp;section=0&amp;paidTest=1&amp;qno=<?php echo $row->numques; ?>&amp;type=view" title="View Test" class="web_font_9"><strong>View Result</strong></a>
                      <?php } ?>
                    </div></td>
                    </tr>
                  <?php 
	$i++;
}
 ?>
                  <tr >
                    <td valign="middle" align="right" colspan="11" height="32"><?php echo ajax_pagination($allpages,$cpg,$url,'list'); ?></td>
                  </tr>
                </table>
                </div>
                </td>
              </tr>
            </table></td>
          </tr>
        </table>
        </td>
        <!-- Right Coloumn Code -->
        <td width="0" style="padding-left:0px; padding-right:0px;" valign="top"></td>
      </tr>
    </table>

  </td>
</tr>
<!-- Middle Row Content -->

<!-- Footer Row Content -->
<?php
include_once 'includes/footer.php';
?>
<!-- Footer Row Content -->

</table>
<!-- Main Table Ending -->
</body>
</html>
