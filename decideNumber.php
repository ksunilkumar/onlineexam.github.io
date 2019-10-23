<?php
session_start();

include 'lib/db.php';
include_once ("lib/test_gen_class.php");
user_login_check();

$generator = new TestGenerator();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Robotutor.in - Online Test</title>
<script type="text/javascript">
</script>
<link rel="stylesheet" href="css/test_style.css" type="text/css">
<script src="js/mootools.js" type="text/javascript"></script>
<script src="js/common.js"></script>

</head>
<body>
<script language="javascript">
function countquestion(obj,rowID,f1,catid)
{
	// alert(catid);
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
	
	//	alert('welcome');
		// alert(countquestion(f[z],1,z,43));
		
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
								return false;
								break;
							}
							else if(cnt>100){
								 alert("Total number of questions cannot exceed 100.");
								 f[z].focus();
								 done="notok";
								 return false;
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

var DatePicker = new Class({
	/* set and create the date picker text box */
	initialize: function(dp){
		// Options defaults
		this.dayChars = 1; // number of characters in day names abbreviation
		this.dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
		this.daysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
		this.format = 'yyyy-mm-dd';
		this.monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		this.startDay = 7; // 1 = week starts on Monday, 7 = week starts on Sunday
		this.yearOrder = 'asc';
		this.yearRange = 10;
		this.yearStart = (new Date().getFullYear());
		// Finds the entered date, or uses the current date
		if(dp.value != '') {
			dp.then = new Date(dp.value);
			dp.today = new Date();
		} else {
			dp.then = dp.today = new Date();
		}
		// Set beginning time and today, remember the original
		dp.oldYear = dp.year = dp.then.getFullYear();
		dp.oldMonth = dp.month = dp.then.getMonth();
		dp.oldDay = dp.then.getDate();
		dp.nowYear = dp.today.getFullYear();
		dp.nowMonth = dp.today.getMonth();
		dp.nowDay = dp.today.getDate();
		// Pull the rest of the options from the alt attr
		if(dp.alt) {
			options = Json.evaluate(dp.alt);
		} else {
			options = [];
		}
		dp.options = {
			monthNames: (options.monthNames && options.monthNames.length == 12 ? options.monthNames : this.monthNames) || this.monthNames, 
			daysInMonth: (options.daysInMonth && options.daysInMonth.length == 12 ? options.daysInMonth : this.daysInMonth) || this.daysInMonth, 
			dayNames: (options.dayNames && options.dayNames.length == 7 ? options.dayNames : this.dayNames) || this.dayNames,
			startDay : options.startDay || this.startDay,
			dayChars : options.dayChars || this.dayChars, 
			format: options.format || this.format,
			yearStart: options.yearStart || this.yearStart,
			yearRange: options.yearRange || this.yearRange,
			yearOrder: options.yearOrder || this.yearOrder
		};
		dp.setProperties({'id':dp.getProperty('name'), 'readonly':true});
		dp.container = false;
		dp.calendar = false;
		dp.interval = null;
		dp.active = false;
		dp.onclick = dp.onfocus = this.create.pass(dp, this);
	},
	/* create the calendar */
	create: function(dp){
		if (dp.calendar) return false;

		// Hide select boxes while calendar is up
		if(window.ie6){
			$$('select').addClass('dp_hide');
		}
		
		/* create the outer container */
		dp.container = new Element('div', {'class':'dp_container'}).injectBefore(dp);
		
		/* create timers */
		dp.container.onmouseover = dp.onmouseover = function(){
			$clear(dp.interval);
		};
		dp.container.onmouseout = dp.onmouseout = function(){
			dp.interval = setInterval(function(){
				if (!dp.active) this.remove(dp);
			}.bind(this), 500);
		}.bind(this);
		
		/* create the calendar */
		dp.calendar = new Element('div', {'class':'dp_cal'}).injectInside(dp.container);
		
		/* create the date object */
		var date = new Date();
		
		/* create the date object */
		if (dp.month && dp.year) {
			date.setFullYear(dp.year, dp.month, 1);
		} else {
			dp.month = date.getMonth();
			dp.year = date.getFullYear();
			date.setDate(1);
		}
		dp.year % 4 == 0 ? dp.options.daysInMonth[1] = 29 : dp.options.daysInMonth[1] = 28;
		
		/* set the day to first of the month */
		var firstDay = (1-(7+date.getDay()-dp.options.startDay)%7);
		/* create the month select box */
		monthSel = new Element('select', {'id':dp.id + '_monthSelect'});
		for (var m = 0; m < dp.options.monthNames.length; m++){
			monthSel.options[m] = new Option(dp.options.monthNames[m], m);
			if (dp.month == m) monthSel.options[m].selected = true;
		}		
		/* create the year select box */
		yearSel = new Element('select', {'id':dp.id + '_yearSelect'});
		i = 0;
		dp.options.yearStart ? dp.options.yearStart : dp.options.yearStart = date.getFullYear();
		if (dp.options.yearOrder == 'desc'){
			for (var y = dp.options.yearStart; y > (dp.options.yearStart - dp.options.yearRange - 1); y--){
				yearSel.options[i] = new Option(y, y);
				if (dp.year == y) yearSel.options[i].selected = true;
				i++;
			}
		} else {
			for (var y = dp.options.yearStart; y < (dp.options.yearStart + dp.options.yearRange + 1); y++){
				yearSel.options[i] = new Option(y, y);
				if (dp.year == y) yearSel.options[i].selected = true;
				i++;
			}
		}
		/* start creating calendar */
		calTable = new Element('table');
		calTableThead = new Element('thead');
		calSelRow = new Element('tr');
		calSelCell = new Element('th', {'colspan':'7'});
		monthSel.injectInside(calSelCell);
		yearSel.injectInside(calSelCell);
		calSelCell.injectInside(calSelRow);
		calSelRow.injectInside(calTableThead);
		calTableTbody = new Element('tbody');
		
		/* create day names */
		calDayNameRow = new Element('tr');
		for (var i = 0; i < dp.options.dayNames.length; i++) {
			calDayNameCell = new Element('th');
			calDayNameCell.appendText(dp.options.dayNames[(dp.options.startDay+i)%7].substr(0, dp.options.dayChars)); 
			calDayNameCell.injectInside(calDayNameRow);
		}
		calDayNameRow.injectInside(calTableTbody);
		
		/* create the day cells */
		while (firstDay <= dp.options.daysInMonth[dp.month]){
			calDayRow = new Element('tr');
			for (i = 0; i < 7; i++){
				if ((firstDay <= dp.options.daysInMonth[dp.month]) && (firstDay > 0)){
					calDayCell = new Element('td', {'class':dp.id + '_calDay', 'axis':dp.year + '|' + (parseInt(dp.month) + 1) + '|' + firstDay}).appendText(firstDay).injectInside(calDayRow);
				} else {
					calDayCell = new Element('td', {'class':'dp_empty'}).appendText(' ').injectInside(calDayRow);
				}
				// Show the previous day
				if ( (firstDay == dp.oldDay) && (dp.month == dp.oldMonth ) && (dp.year == dp.oldYear) ) {
					calDayCell.addClass('dp_selected');
				}
				// Show today
				if ( (firstDay == dp.nowDay) && (dp.month == dp.nowMonth ) && (dp.year == dp.nowYear) ) {
					calDayCell.addClass('dp_today');
				}
				firstDay++;
			}
			calDayRow.injectInside(calTableTbody);
		}
		/* table into the calendar div */
		calTableThead.injectInside(calTable);
		calTableTbody.injectInside(calTable);
		calTable.injectInside(dp.calendar);
		
		/* set the onmouseover events for all calendar days */
		$$('td.' + dp.id + '_calDay').each(function(el){
			el.onmouseover = function(){
				el.addClass('dp_roll');
			}.bind(this);
		}.bind(this));
		
		/* set the onmouseout events for all calendar days */
		$$('td.' + dp.id + '_calDay').each(function(el){
			el.onmouseout = function(){
				el.removeClass('dp_roll');
			}.bind(this);
		}.bind(this));
		
		/* set the onclick events for all calendar days */
		$$('td.' + dp.id + '_calDay').each(function(el){
			el.onclick = function(){
				ds = el.axis.split('|');
				dp.value = this.formatValue(dp, ds[0], ds[1], ds[2]);
				this.remove(dp);
			}.bind(this);
		}.bind(this));
		
		/* set the onchange event for the month & year select boxes */
		monthSel.onfocus = function(){ dp.active = true; };
		monthSel.onchange = function(){
			dp.month = monthSel.value;
			dp.year = yearSel.value;
			this.remove(dp);
			this.create(dp);
		}.bind(this);
		
		yearSel.onfocus = function(){ dp.active = true; };
		yearSel.onchange = function(){
			dp.month = monthSel.value;
			dp.year = yearSel.value;
			this.remove(dp);
			this.create(dp);
		}.bind(this);
	},
	
	/* Format the returning date value according to the selected formation */
	formatValue: function(dp, year, month, day){
		/* setup the date string variable */
		var dateStr = '';
		
		/* check the length of day */
		if (day < 10) day = '0' + day;
		if (month < 10) month = '0' + month;
		
		/* check the format & replace parts // thanks O'Rey */
		dateStr = dp.options.format.replace( /dd/i, day ).replace( /mm/i, month ).replace( /yyyy/i, year );
		dp.month = dp.oldMonth = '' + (month - 1) + '';
		dp.year = dp.oldYear = year;
		dp.oldDay = day;
		
		/* return the date string value */
		return dateStr;
	},
	
	/* Remove the calendar from the page */
	remove: function(dp){
		$clear(dp.interval);
		dp.active = false;
		if (window.opera) dp.container.empty();
		else if (dp.container) dp.container.remove();
		dp.calendar = false;
		dp.container = false;
		$$('select.dp_hide').removeClass('dp_hide');
	}
});
</script>

<div id="showSelection">      
<script type="text/javascript" language="javascript">


document.onclick=check;

function check(e){
var target = (e && e.target) || (event && event.srcElement);

checkParent(target)?hide():null;

}
function checkParent(t){//alert(t+"="+document.getElementById('img1'));
while(t.parentNode){
if(t==document.getElementById('divName') || t=="" || t==document.getElementById('divTestName')){
return false
}
t=t.parentNode

}
return true
}

</script>

<script>
function validatefrmName(f){

	if(trim(f.txtTestName.value)==""){
		alert("Section name can't be left blank.");
		return false;
	}
	else{
		sendRequest(f,document.frmName.hiddTstId.value);
		hide();
		return false
	
	}
}
function checknumber(obj){
	tempval = obj.value;
	obj.value = tempval.replace(/[^\d]/g,"");
	if(obj.value==0)
	obj.value ="";
}
</script>


<table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="100%">

	<tbody><tr>
		<td>
        	<div style="position: relative;">
            	<div id="OverLayDiv"></div>
        	</div>    
        </td>
	</tr><tr>
    <td style="border-bottom: 1px solid rgb(17, 78, 171);" align="center">
    <div class="creaTest_main_left"></div>
    <div class="creaTest_main_mid">
    	<div style="float: left; padding-top: 11px;"><img src="images/test_head_icon.png" width="19" height="24"></div>
        <div class="creaTest_main_mid_text">Generate&nbsp;Test</div>
    </div>
    <div class="creaTest_main_right"></div>   
    
    <div style="float: right; padding-top: 15px;"></div>
     </td>
  </tr>
    <tr>
  		<td style="background: url(&quot;images/gray_back.gif&quot;) repeat-x scroll 0% 0% transparent;" valign="top">
        	<?php
				$ids=explode(',',$_REQUEST['ids']);
			?>
            <form id="form1" name="form1" method="post" action="sections.php" onsubmit="javascript:return checkempty('1','<?php echo count($ids); ?>'); ">
            <input name="mode" value="update" type="hidden">
      		<?php
			 //  print_r($_POST); 
			 
			 $_SESSION['ids']=$_REQUEST['ids'];
			 $_SESSION['section']=$_REQUEST['section'];
			?>
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
      			<tbody>
        		<tr>
       			  <td align="center" valign="top" width="100%">
					              			<table border="0" cellpadding="0" cellspacing="0" width="98%">
           			  <tbody><tr>
                				<td colspan="2" style="border-bottom: 1px solid rgb(225, 225, 225); border-top: 1px solid rgb(225, 225, 225); background: url(&quot;../images/section_head_back.gif&quot;) repeat-x scroll 0% 0% transparent; padding: 0px;" width="100%">
                    	<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color:#FF8409">
                       	  <tbody><tr>
                            <td align="center" valign="middle" width="4%"><img src="images/test_section_icon.png"></td>
                  <td class="creaTest_section_text" width="56%">
				<div id="divName1" style="float: left;" title="Section 1">Section 1</div>
           
            </td>
                  <td class="creaTest_section_text" width="40%">
                                    <div id="action1" style="float: right;">
                  
                  <table align="right" border="0" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                                        <td align="center" valign="middle" width="30">&nbsp;</td>
                  <td class="creaTest_section_text_delete" align="center" valign="middle" width="110">&nbsp;</td>
                    </tr>
                  </tbody></table>
                                    </div></td>
                 
                  </tr>
                        </tbody></table>                    </td>
                </tr>
                                <tr>
                  <td colspan="4" bgcolor="#ffffff" valign="top"><div id="section1">
                      <table id="tabular1" align="center" cellpadding="0" cellspacing="0" width="100%">
                                           <!-- <tr>
                        	<td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="4" class="creaTest_section_headUnder">Set number of questions &amp; difficulty levels in chosen categories</td>
                        </tr>
                        <tr>
                        	<td>&nbsp;</td>
                        </tr>-->
                                                                       <tbody><tr>
                       	<td align="center">
                        	<table bgcolor="#e9e9e9" border="0" cellpadding="1" cellspacing="1" width="100%">
 <tbody><tr>
                          <td class="creaTest_section_cate_headBack" width="36%"><div style="float: left; padding-top: 7px; padding-left: 7px;"><img src="images/category_iocn.png" width="14" height="14"></div><div class="creaTest_section_cate_head">Category</div></td>
                          <td class="creaTest_section_cate_headBack" width="22%"><div style="float: left; padding-top: 7px; padding-left: 7px;"><img src="images/difficulty_icon.png" width="16" height="15"></div>
                          <div class="creaTest_section_cate_head">Difficulty level</div></td>
                          <td class="creaTest_section_cate_headBack" width="28%"><div style="float: left; padding-top: 7px; padding-left: 7px;"><img src="images/choose_icon.gif" width="14" height="14"></div>
                          <div class="creaTest_section_cate_head">Choose no. of questions</div></td>
                          <td class="creaTest_section_cate_headBack" width="13%"><div style="float: left; padding-top: 7px; padding-left: 7px;"><img src="images/action_icon.png" width="14" height="15"></div>
                          <div class="creaTest_section_cate_head">Action</div></td>
                          <td style="background-color: rgb(247, 248, 249); display: none;" width="1%"></td>
                        </tr>
                        <?php
							if(count($ids)>1)
							{
								 $noq=0;
								 $qpc=0;
								 
								 if($_REQUEST['Submit'] == 'Quick Generate')
								 {
									$noq=25;
									$qpc=floor($noq/(count($ids)-2));
									$lcq=$qpc+(floor($noq%(count($ids)-2)));
								 }

								for($i=1;$i<count($ids)-1; $i++)
								{
									if($i==(count($ids)-2))
										$qpc = $lcq;
						?>
						<tr>
                          <td class="creaTest_section_cate_headText" width="36%"><?php echo $generator->get_chap_name($ids[$i]); ?></td>
                          <td class="creaTest_section_cate_headText" width="22%">
                              <select class="creaTest_section_cate_selected" name="dl[<?php echo $i; ?>]" id="dl[<?php echo $i; ?>]">
                                  <option value="0" selected="selected">Any</option>
                                  <option value="1">Easy</option>
                                  <option value="2">Medium</option>
                                  <option value="3">Difficult</option>
                              </select>
                          </td>
                          <td class="creaTest_section_cate_headText" width="28%">
                          <input id="choosenum[<?php echo $i; ?>]" name="choosenum[<?php echo $i; ?>]" size="5" value="<?php echo $qpc; ?>" onchange="countquestion(this,<?php echo $i; ?>,this.form,'<?php echo $ids[$i]; ?>');" onfocus="if(this.value=='0')this.value='';" onblur="javascript: checknumber(this);" class="creaTest_section_cate_selected" style="text-align: center;" type="text">
                          <input name="tempID[<?php echo $i; ?>]" id="tempID[<?php echo $i; ?>]" value="<?php echo $i; ?>" type="hidden"></td>
                          <td class="creaTest_section_cate_headText" width="13%">
                                              
                           <a href="javascript:sendRequest('selected_categ_section.php?ccc=1&amp;act=terminate&amp;tempID=<?php echo $i; ?>','section1')" onclick="javascript:if(!confirm('Are you sure to remove this category?')) return false;">
                          <img src="images/delete_catlog.png" border="0"></a>                          </td>
                          <td style=" display: none;" width="1%"><div id="avail10"></div></td>
                       
  </tr>
   <tr><td colspan="5" style="background-color:#FFFFFF;"><div id="divEmpty<?php echo $i; ?>"></div></td></tr>
                          <?php
						  		}
							}
						?>

</tbody></table>                        </td>
                       </tr>
                                              <!--  <tr height="25px" valign="top">
                          <td colspan="5" style=" white-space:nowrap" align="center">
                          <div style="position:relative;  text-align:center; height:auto; margin:auto; width:auto; padding:0px 0px 0px 310px;">
                              <div style="float:left; width:auto; position:relative;">  </div>
                            <div style="width:; float:left; padding:0px 5px 0px 5px;">
                                </div>
                            </div>
                            <div style="width:auto; float:left; position:relative;"></div>
                          </div></td>
                        </tr>-->
                      </tbody></table>
                  </div></td>
                </tr>
              </tbody></table>                  </td>
        </tr>
                
              <tr>
          <td height="50" align="center" valign="middle"><div id="buttons" align="right"><a style="cursor: pointer;" onclick="javascript: checkempty('1','<?php echo count($ids); ?>'); "><img src="images/next_butn.png" border="0" /></a></div></td>
        </tr>
        <tr>
	<td>&nbsp;</td>
</tr> 
      </tbody></table>
        
        <?php if($noq!=0) { echo '<script>document.form1.submit();</script>'; } ?>
        </form>
    </td>
  </tr>
  
</tbody></table>
    
</div>
		
<script>
/*FB_RequireFeatures(["XFBML"], function() {
    FB.Facebook.init( "4a6b217e1fa0cd1c679672a085dfb80c", "/facebook/xd_receiver.htm" );
    FB.Connect.requireSession(function(){
        FB.Connect.ifUserConnected( function( uid ){
                   alert( uid+" is connected" );
        }, function() {
                    alert( "User not connected" );
        });
    });
});*/
</script>
</body>
</html>
