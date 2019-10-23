<?php
session_start();
 include_once 'lib/db.php';
?>
<?php

$testgen_id=$_REQUEST['tst'];

$tst_id=(int)substr($testgen_id,0,strripos($testgen_id,"gen"));

 $sqlobj = new SqlClass();
 $qry2="select user_id from test_tests where test_id=".$tst_id;
 $res2=$sqlobj->executeSql($qry2);
 $row2=$sqlobj->fetchRow($res2);

 if($row2['user_id']!=$_SESSION['user_id'])
 {
	// echo $row2['user_id'].' - '.$_SESSION['user_id'];
	echo '<script>';
	echo 'window.location.href="test_gen.php";';
	echo '</script>';
 }
 

	$sqlobj = new SqlClass();
	$qry='select result_id from test_test_results where test_id='.$tst_id;
	$res=$sqlobj->executeSql($qry);
	$row=$sqlobj->fetchRow($res);
	
	if($row!='')
	{
		echo '<script>';
		echo 'window.location.href="view_result.php?test_id='.$tst_id.'&ttaken='.$row['result_id'].'";';
		echo '</script>';
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo Site_Title; ?></title>
<link rel="shortcut icon" href="favicon.png" type="image/x-icon" />

<!--CSS/Style Sheet Part Starting-->
<link rel="stylesheet" href="css/site_styles.css" />
<STYLE type=text/css>
@font-face {
	font-family:Ankit;
	src:url(fonts/ANKIT0.eot);
}
@font-face {
	font-family: Ankit;
	src:url(fonts/ankit.TTF);
}
.marked1 { background-image:url(images/1_continue.jpg); background-repeat:no-repeat; background-position:center;	TEXT-ALIGN: center; PADDING-BOTTOM: 5px; LINE-HEIGHT: 25px; PADDING-LEFT: 10px; WIDTH: 100px; PADDING-RIGHT: 10px; FONT-FAMILY: Arial, Helvetica, sans-serif; FLOAT: right; FONT-SIZE: 12px;PADDING-TOP: 5px;
}
.marked1 A {
	COLOR: #000; TEXT-DECORATION: none;
}
</STYLE>

<DIV 
style="Z-INDEX: 110; BORDER-BOTTOM: #666666 2px solid; POSITION: absolute; TEXT-ALIGN: center; BORDER-LEFT: #666666 2px solid; PADDING-BOTTOM: 20px; MARGIN: auto; PADDING-LEFT: 20px; PADDING-RIGHT: 20px; DISPLAY: none; FONT-FAMILY: 'trebuchet MS'; BACKGROUND: #f2f2f2; COLOR: #000000; FONT-SIZE: 20px; BORDER-TOP: #666666 2px solid; TOP: 200px; BORDER-RIGHT: #666666 2px solid; PADDING-TOP: 20px; LEFT: 260px" id="SaveTest"></DIV>
<!--CSS/Style Sheet Part Ending-->

<!-- Javascript Part Starting-->
<SCRIPT language="javascript">
	var xmlHttp;
	var servername = "<?php echo Site_Name; ?>";
	
	function showHint()
	{
	var testid="<?php echo $_REQUEST['tst']; ?>";
	// alert(testid);


	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
	{
		alert ("Your browser does not support AJAX!");
		return;
	} 
	var url="incompletetest.php";
	url=url+"?testid="+testid;
	//alert(url);
	//xmlHttp.onreadystatechange=stateChanged;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
	} 
	
	function stateChanged() 
	{ 
		if (xmlHttp.readyState==4)
		{ 
		//document.getElementById("txtHint").innerHTML=xmlHttp.responseText;
		}
	}
    
	function GetXmlHttpObject()
    {
		var xmlHttp=null;
		try
		{
		// Firefox, Opera 8.0+, Safari
			xmlHttp=new XMLHttpRequest();
		}
		catch (e)
		{
		// Internet Explorer
			try
			{
				xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch (e)
			{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
		}
		return xmlHttp;
    }
</SCRIPT>
<SCRIPT language="javascript">
var qno=<?php echo $_REQUEST['qno']; ?>;
var proc="";
var s=new Array();
var attmpt=new Array();
var arr= new Array(0);
var totQues=0,totqCon=0,totminCon=0;
var totTime=0;
var ttakenid='';
var testid='<?php echo $_REQUEST['tst']; ?>';
var EsteemedUser="";
//var paidtest=1;
var paidtest=0;
//function traceststus(){
//showHint(testid,ttakenid);
//alert(testid);
//alert(ttakenid);
//}
</SCRIPT>

<SCRIPT language="javascript" src="tests/<?php echo $testgen_id; ?>.js"></SCRIPT>

<SCRIPT language="javascript" src="js/jExam_test.js"></SCRIPT>

<SCRIPT language="javascript">
function DivCloseOpen(divid)
{
	if(document.getElementById(divid).style.display=="none")
		document.getElementById(divid).style.display="block";
	else
		document.getElementById(divid).style.display="none";
		
	//	document.getElementById(divid).focus();
}
</SCRIPT>

<!-- Javascript Part Ending-->
</head>

<body>
<DIV style="POSITION:absolute" id="txterror"></DIV>
<DIV style="DISPLAY: block" id="headerNone"> </DIV>
<?php include 'includes/light_box.php'; ?>

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
        <?php echo ucwords($_SESSION['msg']); if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
          <tr bgcolor="#F68122">
            <td width="6" style="background:url(images/sprite_05.jpg) left no-repeat;" height="27">&nbsp;</td>
            <td width="705" background="images/sprite_07.jpg" class="content_head" ><strong>Examination Paper</strong></td>
            <td width="6" style="background:url(images/sprite_06.jpg) right no-repeat;" height="27">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top" class="sprite_padding_1 main_box_border">
<!-- -->
<DIV style="DISPLAY: none" id="headerSec">
      
      <TABLE border="0" cellSpacing="0" cellPadding="0" width="100%" align="center">
        <TBODY>
        <TR>
          <TD valign="bottom" width="235">
	          
    <DIV id="sectionalDiv">
<!-- Timer & Move To Table -->    
	<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="50%" bgcolor="#efefef" class="web_border_1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td bgcolor="#f8f8f8" class="web_padding_1"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td height="33" colspan="4" align="center" valign="middle" background="images/ismart_48.jpg" class="web_font_9" style="border-right:#dbdbdb dashed 1px;"><strong>Timer</strong></td>
                                    </tr>
                
<SCRIPT language="javascript">
	 var sectionDisplayData='', sectionvar, statusBarCode='',statusWidth="";
	 
	sectionvar ='';
	statusWidth = Math.floor(100/sectionArr.length);
	secCoun=1;
	totminCon=sectionArr[secCoun-1].secTime/60;
			document.write('<tr><td width="28%" height="33" align="center" class="web_font_9" style="border-right:#dbdbdb dashed 1px;border-bottom:#dbdbdb dashed 1px;"><strong>Section '+secCoun +'</strong></td>');

			sectionvar+='<div class=\"bid_middle_slet_under\" id=\"optSection'+secCoun+'\"><img src="images/loader.gif" border="0" /></div>';
			statusBarCode+='<div style=\"width:100%;\"><div style=\"width:'+statusWidth+'%; float:left; border:1px solid #E1E1E1; border-right:0px;\">Section '+secCoun+'</div></div>';
			
	document.write('<td width="19%" align="center" class="web_font_9" style="border-bottom:#dbdbdb dashed 1px;border-right:#dbdbdb dashed 1px"><div id=sAtt'+secCoun+'><span name=disp'+secCoun+' id=disp'+secCoun+'>0</span>/'+sectionArr[secCoun-1].secQues+'</div></td>');

	document.write('<td width="21%" align="center" class="web_font_9" style="border-bottom:#dbdbdb dashed 1px;border-right:#dbdbdb dashed 1px"><div><span id="sTime'+secCoun+'">00:00</span></div></td>'+
	'<td width="32%" rowspan="2" align="center" valign="top" bgcolor="#F2EEE2" class="web_font_11" ><strong><br />'+
	'Time Left<br /><br /><SPAN id=disp name="disp">00:00:00</SPAN></strong></td></tr>'+
	'<tr><td height="33" align="center" class="web_font_9" style="border-right:#dbdbdb dashed 1px;"><strong>Total</strong></td>'+
    '<td align="center" class="web_font_9" style="border-right:#dbdbdb dashed 1px"><span id="totattempt">0</span></td>'+
	'<td align="center" class="web_font_9" style="border-right:#dbdbdb dashed 1px"><div id=\"totmins\">00:00</div></td>'+
	'</tr>');
</SCRIPT>
                                </table></td>
                              </tr>
                          </table></td>
                          <td width="50%" bgcolor="#efefef" class="web_border_1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td bgcolor="#f8f8f8" class="web_padding_1"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td height="33" colspan="3" align="center" valign="middle" background="images/ismart_48.jpg" class="web_font_9" style="border-right:#dbdbdb dashed 1px;"><strong>Move To</strong></td>
                                    </tr>
                                    <tr>
                                      <td width="47%" rowspan="2" align="center" valign="middle" class="web_font_9" style="border-right:#dbdbdb dashed 1px;border-bottom:#dbdbdb dashed 1px;"><strong>Select Question</strong><strong> :</strong></td>
                                      <td width="2%" height="33" align="center" class="web_font_9" style="border-right:#dbdbdb dashed 1px">&nbsp;</td>
                                      <td width="51%" rowspan="2" align="center" valign="middle" bgcolor="#F2EEE2" class="web_font_11" > 
                                      <DIV id="questionid" class="bid_middle_left_text_box" onclick="DivCloseOpen('questionHid')" ></DIV>
                  <DIV style="POSITION: absolute; DISPLAY: none;" id="questionHid" class="bid_middle_slet_ques" >
                  <?php
				  	
						for($i=1;$i<=$_REQUEST['qno'];$i++)
						{
							echo '<DIV id="opt'.$i.'" class="bid_middle_slet_under" value="'.$i.'" onclick="DivCloseOpen(\'questionHid\')"><IMG border="0" src="images/loader.gif"></DIV>';
						}
				  ?>
				</DIV> </td>
                                    </tr>
                                    <tr>
                                      <td height="33" align="center" class="web_font_9" style="border-right:#dbdbdb dashed 1px">&nbsp;</td>
                                    </tr>
                                </table></td>
                              </tr>
                          </table></td>
                          </tr>
                    </table>
                  <span style="display:none;">
				  <SCRIPT language="javascript">
						if(sectionArr.length>=1)
						document.write(sectionvar);
				  </SCRIPT>
                  </span>

<!-- Timer & Move To Table Ends Here-->    

    </DIV>           </TD>
      </TR>
        <TR valign="top">          </TR></TBODY></TABLE></DIV>
<!-- -->    &nbsp;

 <!-- Exam Part-1 -->

<TABLE border="0" cellSpacing="0" cellPadding="0" height="*" bgcolor="#FFFFFF" width="100%">
  <TBODY>
  <TR height="2">
    <TD colspan="3"></TD></TR>
  <TR valign="top">
    <td width="7"></td>
    <TD valign="top">
      <SCRIPT language="javascript">
			for(var iframe =0; iframe<<?php echo $_REQUEST['qno']; ?>; iframe++){
			   if(questions[iframe].fid!='' && questions[iframe].fname!='')
				{
				// alert(iframe)				
				var src = questions[iframe].fname+'/'+questions[iframe].fid;
				document.write('<div id=\"passage'+iframe+'\" style=\"position:relative; z-index:0; width:100%; height:100% ;display:none;\"><iframe id=\"inderjit'+iframe+'\" width=\"450\" height=\"400\" src=\"'+src+'\" ></iframe></div>');
				}
			}
			</SCRIPT>
      <FORM id="WapForm" method="post" name="WapForm" 
      action="ProcessGenerate.php?process=2&amp;testid=<?php echo $testgen_id; ?>">
      <INPUT id="fullyloaded" type="hidden" name="fullyloaded" > <INPUT id="viewedQues" type="hidden" name="viewedQues">
      <!--<div id="dockcontent01" class="test_answer_main" style=" background-color:#EAEAEA; display:none; " ></div>-->
      <input type="hidden" name="test_id" id="test_id" value="<?php echo $testgen_id; ?>" />
      <DIV style="DISPLAY:block;" id="wq_user" align="left">
      <DIV style="Z-INDEX: 110; POSITION: absolute; DISPLAY: none; TOP: 70px; LEFT: 49px" id="feedback"></DIV>
      <?php
      	for($i=1; $i<=$_REQUEST['qno']; $i++) 
	  	{
		  echo '<DIV style="WIDTH: 100%; DISPLAY: none" id="question'.$i.'"></DIV>';
		}
	 ?>
      <DIV style="WIDTH: 100%; DISPLAY: block" id="instructions" align="center">
      <TABLE border="0" cellSpacing="0" cellPadding="3" align="center" width="100%" style="border: 1px solid rgb(219, 219, 219);">
        <TBODY>
        <TR>
          <TD class="test_list_border" height="18" colSpan="2" align="left"><img src="images/test_head_icon.png" alt="icon" width="20" height="20" align="absmiddle" /><span class="profile_info_text">Test Details</span></TD>
        </TR>
        <TR bgcolor="#f3efe4">
          <TD width="34%" height="30" align="right" class="test_list_border"><strong>Test Name :</strong></TD>
          <TD width="66%" align="left" class="web_font_19 test_list_border"><strong>Test</strong></TD>
        </TR>
        <TR>
          <TD height="30" align="right" class="test_list_border"><strong>No. of questions :</strong></TD>
          <TD align="left" class="test_list_border web_font_19">
            <DIV id="totques1"><strong>
            <SCRIPT language="javascript">
				document.write(questions.length);
            </SCRIPT>
            </strong></DIV></TD>
        </TR>
        <TR bgcolor="#f3efe4">
          <TD height="30" align="right" class="test_list_border"><strong>Time (minutes) : </strong></TD>
          <TD align="left" class="test_list_border web_font_19">
            <strong><DIV id="tottime1"></DIV></strong></TD></TR>
        <TR class="blue_bg_admin">
          <TD height="30" colSpan="2" align="center" class="test_list_border">
            <TABLE 
            style="BORDER-BOTTOM: #cccccc 1px solid; BORDER-LEFT: #cccccc 1px solid; BORDER-TOP: #cccccc 1px solid; BORDER-RIGHT: #cccccc 1px solid; display:none;" 
            border="0" cellSpacing="0" cellPadding="0" width="50%" align="center">
              <TBODY>
              <TR>
                <TD class="test_paragra_home" width="50%" 
                  align="middle"><B>Sections</B></TD>
                <TD class="test_paragra_home" align="middle"><B>No.of questions</B></TD></TR>
              <SCRIPT language="javascript">
			  document.write(sectionDisplayData);
              </SCRIPT>
              </TBODY></TABLE></TD></TR>
        <TR>
          <TD height="25" colSpan="2" class="test_list_border web_font_19" align="left">
          <!--Each right answer carries 4 marks & wrong answer carries -1 mark.-->
          1. Each right answer carries
            <SCRIPT language="javascript">
			document.write(sectionArr[0].secMarks+' mark(s) & ');
				 if(sectionArr[0].secNegMark=='0') 
				 {
				 document.write('no mark(s) will be deducted for any wrong answer.');
				 } 
				 else 
				 {
				 document.write('wrong answer carries - ' +sectionArr[0].secNegMark+' mark(s).')
				 }
				 </SCRIPT>             </TD>
        </TR>
        <TR>
          <TD height="25" colSpan="2" class="test_list_border web_font_19" align="left">
          2. You can mark/unmark the question for revision.</TD>
        </TR>
        <TR align="left">
          <TD height="25" colSpan="2" class="test_list_border web_font_19">
          3. No mark will be deducted for unanswered questions.</TD>
        </TR>
        <TR>
          <TD colSpan="2" align="middle" class="test_list_border">
            <DIV style="TEXT-ALIGN: center; WIDTH: 98%; FONT-FAMILY: Arial, Helvetica, sans-serif; COLOR: #5f5f5f; FONT-SIZE: 13px; OVERFLOW: hidden" align="center" class="creaTest_section_cate_headsec">
            <SPAN id="spanLoadingQs1"></SPAN></DIV></TD></TR>
        <TR class="blue_bg_admin">
          <TD colSpan="2" align="middle" class="test_list_border" style="FONT-FAMILY: Arial, Helvetica, sans-serif; FONT-SIZE: 12px">
            <DIV style="Z-INDEX: 10; BORDER-BOTTOM:#FF9900 1px solid; POSITION: relative; BORDER-LEFT: #FF9900 1px solid; WIDTH: 100%; FLOAT: left; CLEAR: both; BORDER-TOP: #FF9900 1px solid; BORDER-RIGHT: #FF9900 1px solid">
            <DIV style="TEXT-ALIGN: right; BACKGROUND: url(images/testLoader.gif) repeat-x 50% top; FLOAT: left; HEIGHT: 14px; COLOR: #333; font-weight:bold;" 
            id="statusBar"></DIV></DIV>
            <DIV style="Z-INDEX: 5; POSITION: relative; WIDTH: 100%; FLOAT: left; HEIGHT: 15px; COLOR: #5f5f5f; CLEAR: both; TOP: -15px">
            <?php
				$qn=$_REQUEST['qno'];
				if($qn>4)
				$nofdivs=floor($qn/5);
				else
				$nofdivs=1;
				
				if($qn%5==0)
					$nofdivs++;
				
				$width=100/$nofdivs;
				$qq=5;
				for($i=1;$i<$nofdivs;$i++)
				{
					echo '<DIV style="TEXT-ALIGN: right; WIDTH: '.$width.'%; FLOAT: left">'.$qq.'</DIV>';
					$qq+=5;
				}
			?>
            </DIV><BR><BR>
            <!--<div class="test_foot_pau" id = "startTest" style="display:none;"><a href="#" onClick="myshow(1,0);">Start Test</a></div>-->
            <DIV style="TEXT-ALIGN: left; LINE-HEIGHT: 2em; DISPLAY: none; FONT-FAMILY: Arial, Helvetica, sans-serif; WHITE-SPACE: nowrap; FLOAT: left; COLOR: #006699; FONT-SIZE: 1em; FONT-WEIGHT: bold" id="divNotLoading" align="left"></DIV>
            <DIV style="DISPLAY: none" id="startTest" class="marked1"><A href="javascript:void(0);" onclick="myshow(1,0);"><strong>Start Test</strong></A></DIV>      </TD>
      </TR>
      </TBODY></TABLE>
      </DIV></DIV>
      <SCRIPT language="javascript" type="text/javascript">				
				document.getElementById('tottime1').innerHTML=totminCon;
			 </SCRIPT>
      </FORM></TD>
      <td width="10"></td>
      </TR>
      </TBODY></TABLE> 

<DIV style="DISPLAY: none" id="footerorg">
<table width='100%' border='0' cellspacing='0' cellpadding='0' align="center">
  <tr>
   <td width="7"></td>
   <td>
<table width='100%' border='0' cellspacing='0' cellpadding='0' align="center" style="border: 1px solid rgb(219, 219, 219); border-top:none;">
<tr><td valign="middle" align="right" style='padding-right:10px;' height="30"><strong>Test Options :</strong>
      <SELECT id="selectOpt" onchange="changeMode(this.value)" name="selectOpt"> 
        <OPTION selected value="o">Show All</OPTION>
        <OPTION value="f">Show Marked Questions</OPTION>
        <OPTION value="a">Show Attempted Questions</OPTION> 
        <OPTION value="u">Show Unattempted Questions</OPTION>
        </SELECT>    </td>
    </tr></table>
   <td width="10"></td>
  </tr>
</table>
</DIV>

<DIV id="footerNone"></DIV>

<DIV style="Z-INDEX: 110; POSITION: absolute; DISPLAY: none; TOP: 70px; LEFT: 49px" id="pauseTest">
<DIV style="Z-INDEX: 1; BORDER-BOTTOM: #7b9bbd 2px double; POSITION: absolute; BORDER-LEFT: #7b9bbd 2px double; PADDING-BOTTOM: 2px; BACKGROUND-COLOR: #f5f5f5; PADDING-LEFT: 2px; WIDTH: 200px; BOTTOM: 10px; PADDING-RIGHT: 2px; DISPLAY: none; FONT-FAMILY: Arial, Helvetica, sans-serif; COLOR: #235fba; FONT-SIZE: 13px; BORDER-TOP: #7b9bbd 2px double; BORDER-RIGHT: #7b9bbd 2px double; PADDING-TOP: 2px; LEFT: 0px" id="ViewSection"></DIV>
<DIV id="mytarget"></DIV>
<SCRIPT>
var txt="";
if((typeof(window['questions']) == "undefined"))
{
	document.getElementById("divNotLoading").style.display="block"; 
}

function handleErr(msg,url,l)
{
	document.getElementById("divNotLoading").style.display="block"; 
	var browser=navigator.appName;
	var b_version=navigator.appVersion;
	//var version=parseFloat(b_version);
	var url="L29ubGluZXRlc3QvRXhhbS5waHA/cW5vPTUmdHN0PTI0MjIxMGdlbiZ0dGFrZW49MzM2MTE4MCZiYW5uZXI9JkVzdGVlbWVkVXNlcj0mbmV4dD1VSEp2WTJWemMwZGxibVZ5WVhSbExuQm9jRDl3Y205alpYTnpQVEltZEdWemRHbGtQVEkwTWpJeE1HZGxiaVowZEdGclpXNDlNek0yTVRFNE1DWkZjM1JsWlcxbFpGVnpaWEk5";
	//alert(url);
	
	var redirecturl="testerrormail2.php?msg="+msg+"&url="+url+"&l="+l+"&browser="+browser;
	/*var redirecturl="testerrormail.php?details="+txt;*/
	sendErrReport(redirecturl);
	return true;
}
onerror=handleErr;

document.getElementById('fullyloaded').value='';
document.getElementById('viewedQues').value='';
doTest(0);
</SCRIPT>
</DIV>      

            </td>
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
