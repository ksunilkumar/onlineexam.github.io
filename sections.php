<?php
session_start();

include_once 'lib/db.php';
include_once 'lib/test_gen_class.php';
user_login_check();

$generator = new TestGenerator();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Create Your Own Test by Test Generator | Generate Test | Make Test</title>
<meta name="description" content="Test Generator personal guide to you in your preparation. Generate your own tests for any exam using vast question bank. Make test by choosing any topic, sub-topic, number of sections, number of questions and set your own time for test">
<meta property="fb:admins" content="100001421135247" />
<meta property="og:title" content="Test Generator"/>
<meta property="og:site_name" content="Robotutor"/>
<meta property="og:image" content="http://robotutor.in/CreatTest/images/testGenerator_75by75.png"/>
<meta name="keywords" content="test generator, make test, generate test, generate your own test, generate question paper">
<link rel="SHORTCUT ICON" href="images/favicon.gif"/>
<link rel="stylesheet" href="css/site_styles.css" type="text/css" />
<link rel="stylesheet" href="css/test_style.css" type="text/css" />
<script src="common.js"></script>
</head>
<body style="background:none;">
	    <div id="comingDiv" style="display:none;">
        <div align="center" style="margin-top:15em;"><img src="../india/images/loadingSuggestion.gif"></div>
    </div>
    <div style="position:relative; z-index:3">
        <div id="dwindow" style="position:absolute;background-color:#FFFFFF;cursor:hand; left:0px; top:0px;display:none;" onSelectStart="return false">
            <center>
                <div align="right" ><img src="http://www.robotutor.in//india/images/closelabel.gif" onClick="closeit()" style="cursor:pointer;"></div>
                <div id="dwindowcontent" style="height:auto;background-color:#FFFFFF; clear:both">
                    <iframe id="cframe" src=""  frameborder="0" style="background-color:#FFFFFF;"></iframe>
                </div>
            </center>
        </div>
    </div>
    <div id="backgroundPopup"></div>
        <table border="0" cellpadding="0" cellspacing="0" width="600" align="center" summary="Test Generator">
        <tr><th></th></tr>
        <tr valign="top" height="300px" bgcolor="#ffffff">
            <td valign="top">


<script language="javascript">
function trim(s)
{var i;var returnString="";for(i=0;i<s.length;i++)
{var c=s.charAt(i);if(c!=" ")returnString+=c;}
return returnString;}
function validate()
{
	var noq=document.getElementById('totalnumques').value;
	var avg_time = parseInt(noq/10);
	
	if(trim(document.getElementById("testname").value)==""){
	 alert("Test name cannot be left blank")
	 document.getElementById("testname").focus();
	 return false;
	}
	if(document.getElementById("testtime").disabled == false && (trim(document.getElementById("testtime").value)=="" || document.getElementById("testtime").value <=0)){
	 alert("Test time cannot be left blank")
	 document.getElementById("testtime").focus();
	 return false;
	}

	if(document.getElementById("testtime").value<avg_time)
		{
			alert("Section time should be greaterthan "+(avg_time-1)+" Mins.");
			document.getElementById("testtime").focus();
			return false;
		}

	if(document.getElementById("time") != null && document.getElementById("time")!= "undefined" && document.getElementById("time").checked == true){
	
			f = document.sectionsFrom;
			str = new RegExp("tt");
			for(z=0; z<f.length;z++)
					{ 
						if((f[z].type == 'text' &&  str.test(f[z].name)) && (trim(f[z].value)=="" || f[z].value<=0))
						{
							alert("Section time cannot be left blank");
							f[z].focus();
							 return false;
						}
					}
	}
	return true;
}
function toggleSections(f,element) 
	{
				var z = 0;
				
				for(z=0; z<f.length;z++)
					{
					if(f[z].type == 'checkbox' && f[z].name == "sections[]")
						f[z].checked = element.checked;
	   	}
	}
function enableTime(f,element){

	if(element.checked == true){
	
			for(z=0; z<f.length;z++)
					{
					if(f[z].type == 'text' )
						f[z].disabled = false;
						document.getElementById("testtime").disabled = true;
						sendRequest("quesnum.php?act=sectionTime&enable=1");
	   		}
	}
	else{
			for(z=0; z<f.length;z++)
					{
					if(f[z].type == 'text' )
						f[z].disabled = true;
						document.getElementById("testtime").disabled = false;
						sendRequest("quesnum.php?act=sectionTime&enable=0");
	   		}
	
	}


}
	function checkSelection(f){
	
		var z = 0;
		var flag = false;		
				for(z=0; z<f.length;z++)
					{
					if(f[z].type == 'checkbox')
						if(f[z].checked==true){
						flag = true;
						return true;
						}
	  			 	}
					
					if(flag==false){
					alert("Please select any section to edit");
					return false;
					}
	
	}
</script>
<script>
function add_time(sec, val,obj){

	val = val.replace(/[^\d]/g,"");
	
	obj.value = val;
	 
	//document.getElementById("OverLayDiv").style.display="block";
	sendRequest("quesnum.php?ccc="+sec+"&act=addtime&tt="+val);
	
}

function checknumber(obj){
	tempval = obj.value;
	obj.value = tempval.replace(/[^\d]/g,"");
}
</script><center>
<table width="600" border="0" cellspacing="0" cellpadding="0">

  


  

  <tr>
    <td align="center" style="background:url(images/gray_back.gif) repeat-x; border-top:1px solid #114eab;">
    <table border="0" cellspacing="0" cellpadding="0" width="100%">
    <tr>
    	<td>
<?php 

	
/*	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
*/

	$cats = $_POST['choosenum'];
	$ids = explode(',',$_SESSION['ids']);
	$chpwsq = '';
	for($i=1;$i<(count($ids)-1);$i++)
	{
		$chpwsq[$ids[$i]] = $cats[$i];
	}

/*	echo '<pre>';
	print_r($chpwsq);
	echo '</pre>';
*/	

	$_SESSION['catwqs']=$chpwsq;
	$tot_cats=count($chpwsq);
	foreach($chpwsq as $qus)
		$qs+=$qus;
 ?>
 	</td>
    </tr>  
    <tr class="main_heading">
    <td>Congrats! Your test has been finalised</td>
  </tr>
    <tr>
      <td align="center" style="border-bottom: 1px dashed rgb(204, 204, 204);" height="15"></td>
    </tr>
    <tr><td align="center">
    <table width="600" border="0" cellspacing="0" cellpadding="0">
		
		<tr>
               	  <td colspan="2" style="border-bottom:1px solid #e1e1e1; background:url(images/section_head_back.gif) repeat-x;">
                   	  <table cellpadding="0" cellspacing="0" border="0" width="100%">
                       	  <tr>
                            <td width="4%" align="center" valign="middle"><img src="images/arrow1.jpg" /></td>
                  <td  class="creaTest_section_text">Test Summary</td>
                  <td width="4%" align="center">&nbsp;</td>
                  </tr>
                  </table>                    </td>
                </tr>
      	<tr>
       		<td><div id="sections">
       		  <form id="sectionsFrom" name="sectionsFrom" method="post" action="test_gen.php?ccc=1&mode=edit" onsubmit="return checkSelection(this)">
       		    <table width="100%" cellspacing="1" cellpadding="1" align="center" border="0" id="tabular1" bgcolor="#e9e9e9">
                  <tr>
                    <td align="center" class="creaTest_section_cate_headsec">Sections</td>
                    <td align="center" class="creaTest_section_cate_headsec">Categories</td>
                    <td align="center" class="creaTest_section_cate_headsec">Questions</td>
                                      </tr>
                                    <tr>
                  
                    <td width="19%" align="center" class="creaTest_section_cate_headsec2"><strong>Section 1</strong></td>
                    <td width="25%" align="center" class="creaTest_section_cate_headsec2"><strong><?php echo $tot_cats; ?></strong></td>
                    <td width="23%" align="center" class="creaTest_section_cate_headsec2"><strong><?php echo $qs; ?></strong></td>
                                </tr>
                 
                   

<tr>
                    <td colspan="2" align="center" class="creaTest_section_cate_headText"><!--<input type="submit" value="  Edit Section" name="gentest2"  class="test_generte_button" />--></td>
                    <td class="creaTest_section_cate_headText">&nbsp;</td>
                   <!-- <td colspan="3" class="creaTest_section_cate_headText">&nbsp;</td>-->
                    </tr>
                </table>
                      </form>
       		  </div></td>
      </tr>
    </table></td>
  </tr>
 

  <tr>
  <td>&nbsp;</td>
  </tr>
  <tr>
        <td><form action="genset.php" method="post" name="generate" target="_parent">
          <table width="600" border="0" align="center" cellpadding="1" cellspacing="1" style="border-left:1px solid #e1e1e1">
			<tr>
            	<td colspan="2" style="border-bottom:1px solid #e1e1e1; border-top:1px solid #e1e1e1; border-right:1px solid #e1e1e1;">
                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="4%" align="center" valign="middle"><img src="images/arrow1.jpg" /></td>
                  <td width="96%" class="creaTest_section_text">Give name & marking scheme</td>
  </tr>
</table>                </td>
            </tr>
            <tr height="25px" valign="top">
              <td width="187" class="test_list_border creaTest_section_cate_headsec2">Test name</td>
              <td width="606" align="left" valign="middle" class="test_list_border"><input name="testname" type="text" id="testname" /></td>
            </tr>
            <tr>
              <td class="test_list_border" style="padding-left:10px;"> Marks per ques.</td>
              <td align="left" class="test_list_border" valign="middle"><select name="mrkpq">
                  <option value="1" selected="selected">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>              </td>
            </tr>
            <tr valign="top">
              <td class="test_list_border creaTest_section_cate_headsec2">Negative marking</td>
              <td align="left" class="test_list_border" valign="middle"><select name="negmrk">
                  <option value="0" selected="selected">0%</option>
                  <option value=".25">25%</option>
                  <option value=".3">33%</option>
                  <option value=".5">50%</option>
                  <option value="1">100%</option>
                  <option value="2">200%</option>
                </select>              </td>
            </tr>
            <tr>
              <td class="test_list_border" style="padding-left:10px;">Number of questions</td>
              <td align="left" class="test_list_border" valign="middle" height="25"><span class=""><?php echo $qs; ?></span>
                <input name="numques" type="hidden" id="totalnumques" value="<?php echo $qs; ?>" /></td>
            </tr>
            <tr>
              <td class="test_list_border creaTest_section_cate_headsec2">Test time</td>
              <td align="left" class="test_list_border" valign="middle">
                <input name="testtime" type="text" id="testtime" class="tast_detail" value="" onblur="if(this.value=='0')this.value='';" onchange="javascript: checknumber(this)"/> Min
        <input name="ccc" type="hidden" id="ccc" value="1" /></td>
            </tr>
           <script>
//enableTime(document.sectionsFrom,document.getElementById('time'));
</script> 
            <tr>
              <td height="40" class="test_list_border">&nbsp;</td>
              <td class="test_list_border" align="left" valign="middle"><input type="image" name="gentest" id="gentest" src="images/gtest1_btn.png" onclick="return validate();" /></td>
            </tr>
          </table>
                </form>        </td>
      </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
    </table></td>
  </tr>
</table>
</center></td> 
        </tr>
        <tr valign="bottom">
            <td align="center">
</td>
        </tr>
    </table>
</body>
</html>

