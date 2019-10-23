<?php
session_start();
include 'lib/db.php';

if(isset($_SESSION['ids']))
unset($_SESSION['ids']);

include_once ("lib/test_gen_class.php");
$generator = new TestGenerator();
?>
<html><head>
<link rel="stylesheet" href="css/site_styles.css">
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1"><script>
	width = 690;
	height = 500;
	parent.window.document.getElementById("dwindow").style.width=initialwidth=width+"px"
	parent.window.document.getElementById("dwindow").style.height=initialheight=height+"px"
	parent.window.document.getElementById("cframe").style.width=initialwidth=width-10+"px"
	parent.window.document.getElementById("cframe").style.height=initialheight=height-10+"px"
	
	siteUrl = "<?php echo Site_Name; ?>";
 	function checkSelection(f){	
		var z = 0;
		var flag = false;		
		for(z=0; z<f.length;z++){
			if(f[z].type == 'checkbox')
				if(f[z].checked==true){
					flag = true;
					return true;
				}
		}
		if(flag==false){
			alert("Please select atleast one category");
			return false;
		}
	}

	var openImg = new Image();
	openImg.src = "images/plus.gif";
	var closedImg = new Image();
	closedImg.src = "images/minus.gif";

	var myselectedcateg=new Array();	
	var myselectedcategname=new Array();
	var multilevelArr =new Array();
	function showBranch(category){
		var objBranch = document.getElementById(category).style;
		if(objBranch.display=="block"){
			//document.getElementById("I"+category).src = "plus.gif";
			objBranch.display="none";
		}else{
			objBranch.display="block";
			//document.getElementById("I"+category).src = "minus.gif";	
		}	
		swapFolder('I' + category);
	}
	function swapFolder(img){
		img  = img.replace("b","");
		objImg = document.getElementById(img);
		if(objImg.src.indexOf('minus.gif')>-1) objImg.src = openImg.src;
		else objImg.src = closedImg.src;
	}
	function hideBranch(category,catId,chk){
		category = unescape(category);
		if(document.getElementById(catId+"b") != "undefined" && document.getElementById(catId+"b") != null){
			var objBranch = document.getElementById(catId+"b").style;
			objBranch.display="none";
		}
		spanObj = document.getElementById(catId)
		spanObj.onclick = "";
		if(document.getElementById("chk_"+catId).checked){			
			var indxval=  (myselectedcateg.length);
			myselectedcateg[indxval] = catId;			
			myselectedcategname[indxval] = category;
			
			removeSubCat(catId);
			catlength =myselectedcategname.length;
			removeparentcatid(catlength,catId,category);
			  
			getcatdisplay(myselectedcateg,myselectedcategname);
			 
			document.getElementById('frmcat').style.display='block';
			document.menuForm.ids.value = document.menuForm.ids.value+catId+",";
			img = category.replace("b","");
			  
			if(document.getElementById("I"+catId) != "undefined" && document.getElementById("I"+catId) != null)
				document.getElementById("I"+catId).src = "red_icon.gif";	
		}else{
			catlength = myselectedcateg.length;
			removecatid(catlength,catId,category)
		}
	}
	function removeByElement(arrayName,arrayElement){
	    for(var i=0; i<arrayName.length;i++ ){
	        if(arrayName[i]==arrayElement)
    	        arrayName.splice(i,1); 
      	}
  	}
	function hideBranchNotRemove(category,catId,chk)
	{
		category = unescape(category);
		if(document.getElementById(catId+"b") != "undefined" && document.getElementById(catId+"b") != null)
		{
			var objBranch = document.getElementById(catId+"b").style;
			objBranch.display="none";
		}
		
		spanObj = document.getElementById(catId)
		if(spanObj === null)
		spanObj = catId;

		// alert(spanObj.id);

		spanObj.onclick = "";

		if(document.getElementById("chk_"+catId).checked)
		{
			var indxval=  (myselectedcateg.length);
			myselectedcateg[indxval] = catId;			
			myselectedcategname[indxval] = category;			
			//removeSubCat(catId);
			catlength =myselectedcategname.length;
			//removeparentcatid(catlength,catId,category);
			getcatdisplay(myselectedcateg,myselectedcategname);
			document.getElementById('frmcat').style.display='block';
			// document.menuForm.ids.value = document.menuForm.ids.value+catId+",";
			img  = category.replace("b","");
			if(document.getElementById("I"+catId) != "undefined" && document.getElementById("I"+catId) != null)
				document.getElementById("I"+catId).src = "red_icon.gif";	
		}
	}
function hideBranchCid(category,catId,chk){

category = unescape(category);

var objBranch = document.getElementById(catId+"b").style;
//objBranch.display="none";
spanObj = document.getElementById(catId)
spanObj.onclick = "";

		if(document.getElementById("chk_"+catId).checked){
			
			var indxval=  (myselectedcateg.length);
			myselectedcateg[indxval] =catId;
			
			myselectedcategname[indxval] =category;
			
			  removeSubCat(catId);
			  
			  getcatdisplay(myselectedcateg,myselectedcategname);
			 
			  document.getElementById('frmcat').style.display='block';
			  document.menuForm.ids.value = document.menuForm.ids.value+catId+",";
			  img  = category.replace("b","");
			  
			  document.getElementById("I"+catId).src = "red_icon.gif";	
			 
		}
		
	
}

function getElementByIdMXL(the_node,the_id) {
	//get all the tags in the doc
	node_tags = the_node.getElementsByTagName('*');
	for (i=0;i<node_tags.length;i++) {
	//is there an id attribute?
	
	//error here 
			//if (node_tags[i].hasAttribute('id')) {
			//if there is, test its value
			if (node_tags[i].getAttribute('id') == the_id) {
				//and return it if it matches
				tagName = node_tags[i].tagName;
				arrTmp = tagName.split("-");
				
				return arrTmp[1];
			}
		//}
	}
}

function removeparentcatid(catlength,remcatid,catname1){

arrCatLevel = Array();	
i = 0;
do{
remcatid = getElementByIdMXL(xmlDoc,remcatid);
removecatidParent(catlength,remcatid,catname1)
arrCatLevel[i] = remcatid;

i++;
}while(getElementByIdMXL(xmlDoc,remcatid))
		
				

}
function removeSubCat(catId1){

var indxval =  (multilevelArr.length);
multilevelStr =  multilevelArr.join();

if(multilevelStr.search(catId1) ==-1)
//multilevelArr[indxval] =  catId1;

tagName = "pid-"+catId1;

for(i=0;i<xmlDoc.getElementsByTagName(tagName).length;i++){

	catId = xmlDoc.getElementsByTagName(tagName)[i].getAttribute("id");
	
	var indxval =  (multilevelArr.length);
	multilevelStr =  multilevelArr.join();
	
	//if(multilevelStr.search(catId) ==-1)
	multilevelArr[indxval] =  catId;
	
}
for(i=0;i<multilevelArr.length;i++){
			
				tagName = "pid-"+multilevelArr[i];
				
				catId = multilevelArr[i];
				//catId = xmlDoc.getElementsByTagName(tagName)[i].getAttribute("id");
				
				//catName = xmlDoc.getElementsByTagName(tagName)[i].getAttribute("name");
				var str = document.menuForm.ids.value;
				var substr1 = ","+catId+",";
				
				if(str.indexOf(substr1)!=-1){
				document.menuForm.ids.value = str.replace(substr1,",");
				catlength =myselectedcategname.length;
				removecatid(catlength,catId,catName)
				}
				multilevelArr.splice(i,1);
				removeSubCat(catId);
				
		}		
		

}


function checkin(category,catId,chk){


//var objBranch = document.getElementById(category).style;

category = unescape(category);
	
		var indxval=  (myselectedcateg.length);
		
		if(document.getElementById("chk_"+catId).checked){
		myselectedcateg[indxval] =catId;
		
		myselectedcategname[indxval] =category;
		catlength =myselectedcategname.length;
		removeparentcatid(catlength,catId,category);
		 getcatdisplay(myselectedcateg,myselectedcategname);
		  document.getElementById('frmcat').style.display='block';
		  document.menuForm.ids.value = document.menuForm.ids.value+catId+",";
		  if(document.getElementById("I"+category)!=null)
		  document.getElementById("I"+category).src = "red_icon.gif";	
		  
		 }
		 else{
		 
				catlength =myselectedcategname.length;
				removecatid(catlength,catId,category)
		 } 
	
}

function getcatdisplay(catid,catname){

	var catlength=catid.length;
	var divdata=''; 
	for(var i=0;i<catid.length;i++){
		 divdata += '<div style="height:25px; border-bottom:1px solid #cccccc; clear:both"><div id="mba_remove_textleft">'+unescape(catname[i])+'</div><div id="mba_remove_textright" align="right"><a style="cursor:pointer" onclick=removecatid('+catlength+','+catid[i]+',"'+escape(catname[i])+'")><img src="'+siteUrl+'/images/remove.gif" /></a></div></div>'; 
		}
		
		document.getElementById('selectedcategname').innerHTML=divdata;
}

function removecatid(catlength,remcatid,catname1){
	//removeparentcatid(catlength,remcatid,catname1);
	
	if(typeof(remcatid) == 'object')
		remcatid=remcatid.id;
	
	catname1 = unescape(catname1);
	var updatedcatids=new Array();	
	var updatedcatnames=new Array();	
	var temp=0;
	catname =myselectedcategname;
	catid =myselectedcateg;
	catlength =myselectedcategname.length;
	var divdata=''; 
	
	hideBranchNotRemove(catname1,remcatid,true)
	
for(var i=0;i<catlength;i++){
		if(remcatid != catid[i]){
			 divdata += '<div style="height:25px; border-bottom:1px solid #cccccc; clear:both"><div id="mba_remove_textleft">'+unescape(catname[i])+'</div><div id="mba_remove_textright" align="right"><a style="cursor:pointer" onclick=removecatid('+catlength+','+catid[i]+',"'+escape(catname[i])+'")><img src="'+siteUrl+'/images/remove.gif" /></a></div></div>'; 
			 updatedcatids[temp] =catid[i];	
			 updatedcatnames[temp] =catname[i];	
			 temp++;
			 }
		}
		
		document.getElementById('selectedcategname').innerHTML=divdata;
		myselectedcateg = updatedcatids;
		//document.getElementById('selectedcateg').innerHTML=myselectedcateg;
    		myselectedcateg = updatedcatids;
		myselectedcategname = updatedcatnames;
       
		
		var str = document.menuForm.ids.value;
		var substr1 = ","+remcatid+",";
		
		document.menuForm.ids.value = str.replace(substr1,",");
		 remcat(remcatid, catname1);
		if(myselectedcategname.length >0){
		 document.getElementById('frmcat').style.display='block';
		}
		else
		 document.getElementById('frmcat').style.display='none';
}

function remcat(catId, catName){
	
	if(document.getElementById("chk_"+catId)!=null)
	document.getElementById("chk_"+catId).checked = false;
	if(document.getElementById("I"+catId)!=null){
	spanObj = document.getElementById(catId);
	if(document.getElementById("I"+catId)!=null)
	document.getElementById("I"+catId).src = "plus.gif";
	
	spanObj.onclick = BindArguments(appendBranch,catName,catId);
	
	}
}

function removecatidParent(catlength,remcatid,catname1){
	//removeparentcatid(catlength,remcatid,catname1);
	catname1 = unescape(catname1);
	var updatedcatids=new Array();	
	var updatedcatnames=new Array();	
	var temp=0;
	catname =myselectedcategname;
	catid =myselectedcateg;
	catlength =myselectedcategname.length;
	var divdata=''; 
for(var i=0;i<catlength;i++){
		if(remcatid != catid[i]){
			 divdata += '<div style="height:25px; border-bottom:1px solid #cccccc; clear:both"><div id="mba_remove_textleft">'+unescape(catname[i])+'</div><div id="mba_remove_textright" align="right"><a style="cursor:pointer" onclick=removecatid('+catlength+','+catid[i]+',"'+escape(catname[i])+'")><img src="'+siteUrl+'/images/remove.gif" /></a></div></div>'; 
			 updatedcatids[temp] =catid[i];	
			 updatedcatnames[temp] =catname[i];	
			 temp++;
			 }
		}
		
		document.getElementById('selectedcategname').innerHTML=divdata;
		myselectedcateg = updatedcatids;
		//document.getElementById('selectedcateg').innerHTML=myselectedcateg;
    		myselectedcateg = updatedcatids;
		myselectedcategname = updatedcatnames;
       
		
		var str = document.menuForm.ids.value;
		var substr1 = ","+remcatid+",";
		document.menuForm.ids.value = str.replace(substr1,",");
		 remcatParent(remcatid, catname1);
		if(myselectedcategname.length >0){
		 document.getElementById('frmcat').style.display='block';
		}
		else
		 document.getElementById('frmcat').style.display='none';
}

function remcatParent(catId, catName){
	
	if(document.getElementById("chk_"+catId)!=null)
	document.getElementById("chk_"+catId).checked = false;
	if(document.getElementById("I"+catId)!=null){
	spanObj = document.getElementById(catId);
	if(document.getElementById("I"+catId)!=null)
	document.getElementById("I"+catId).src = "minus.gif";	
	spanObj.onclick = BindArguments(appendBranch,catName,catId);
	}
}

</script>

<script>












str ='';

function BindArguments(fn)
{
  var args = [];
  for (var n = 1; n < arguments.length; n++)
    args.push(arguments[n]);
  return function () { return fn.apply(this, args); };
}
function appendBranch(catName1,catId1){

catName1 = unescape(catName1);
		
	if(document.getElementById(catId1+"b") == null){
			str = '';
			tagName = "pid-"+catId1;
			
			
				var spanTag = document.createElement("span");
				spanTag.id = catId1+"b";
				spanTag.className ="mba_Checkbox_div";
			
			str += " <input type='checkbox'  id='chk_"+catId1+"' value='"+catId1+"'";
			
			
			str +=  "onClick=hideBranch('"+escape(catName1)+"','"+catId1+"')";
			
			str += ">All "+unescape(catName1)+"<br>";	
			
			for(i=0;i<xmlDoc.getElementsByTagName(tagName).length;i++){
			
				catId = xmlDoc.getElementsByTagName(tagName)[i].getAttribute("id");
				catName = escape(xmlDoc.getElementsByTagName(tagName)[i].getAttribute("name"));
				
				
				if(xmlDoc.getElementsByTagName("pid-"+catId).length>0)	{
					//spanTag.onclick  = BindArguments(appendBranch,catName,catId);
					if(myselectedcategStr.indexOf(catId)==-1){
					str += "<img src='plus.gif' onClick=appendBranch('"+escape(catName)+"','"+catId+"') id='I"+catId+"'>";
					str +=" <a href='#' id='"+catId+"' onClick=appendBranch('"+escape(catName)+"','"+catId+"') class='mba_link' > "+unescape(catName)+"</a>";
					}else{
				    str += "<img src='red_icon.gif'  id='I"+catId+"'>";
					str +=" <a href='#' id='"+catId+"'  class='mba_link'> "+unescape(catName)+"</a>";

					
					}
					str += "<br>";
				}
				/*else
				str += " <input type='checkbox'  id='chk_"+catId+"' value='"+catId+"'  onClick=checkin('"+escape(catName)+"','"+catId+"','"+this.checked+"') ><a href='#' id='"+catId+"' class='mba_link'> "+unescape(catName)+"</a><br>";*/
				else if(myselectedcategStr.indexOf(catId)==-1)str += " <input type='checkbox'  id='chk_"+catId+"' value='"+catId+"'  onClick=checkin('"+escape(catName)+"','"+catId+"','"+this.checked+"') ><a  id='"+catId+"' class='mba_link'> "+unescape(catName)+"</a><br>";
				else 
				str += " <img src='red_icon.gif'  id='I"+catId+"'><a  id='"+catId+"' class='mba_link'> "+unescape(catName)+"</a><br>";
			}
			spanTag.innerHTML = str;
		
			var sp2 = document.getElementById(catId1);
			var parentSpan = sp2.parentNode;
			
			parentSpan.insertBefore(spanTag,sp2.nextSibling);
			
	}
		
	showBranch(catId1+"b");
}




function writeList(j){

tagName = "pid-0";
count = j+10;

if(count >xmlDoc.getElementsByTagName(tagName).length)
count = xmlDoc.getElementsByTagName(tagName).length;


catName = "GRE";


		for(i=j;i<count;i++){
		
		catId = xmlDoc.getElementsByTagName(tagName)[i].getAttribute("id");
		
		catName = xmlDoc.getElementsByTagName(tagName)[i].getAttribute("name");
		//errorr here 
		var arr2str = arrAllowedCateg.toString();
			//if(arrAllowedCateg.length !=0 || arrAllowedCateg.indexOf(catName) !=-1){
			if(arrAllowedCateg.length !=0 || arr2str.search(catName)){	
				str += '<span class="mba_div"  id="'+catId+'"';
				var substr1 = ""+catId+"";
				
				if(myselectedcategStr.indexOf(substr1)==-1){
				str +=  'onClick=appendBranch("'+escape(catName)+'","'+catId+'") ><img src="plus.gif" id="I'+catId+'"> ';
				}
				else
				str +=  '><img src="red_icon.gif" id="I'+catId+'"> ';
				str += catName+'<br></span>';
			}
		
		}

		
		return (str);


}
</script>
<style>
@import"menu_style.css";
</style>
<style>
#main_popup
{
	width:660px;
	margin:0px 0px 0px 0px;
	padding:2px;
	
}

#middle_popup
{
	width:100%;
	height:380px;
	background:#FFFFFF;
	margin:0px 0px 0px 0px;
	
}

#left_popup
{
	width:302px;
	float:left;
	padding-top:2px;
	margin-left:5px;
	
}
#header_popup
{
	width:252px;
	line-height:52px;
	background:url(images/hrader.png) no-repeat;
	font-family:Arial, Helvetica, sans-serif;
	font-size:15px;
	color:#FFFFFF;
	padding-left:50px;
	font-weight:bold;
}
* html #header_popup
{
	width:302px;
	line-height:52px;
	background:url(images/hrader.png) no-repeat;
	font-family:Arial, Helvetica, sans-serif;
	font-size:15px;
	color:#FFFFFF;
	padding-left:50px;
	font-weight:bold;
}
.overflow_main
{
	width:302px;
	background:url(images/middle.gif) repeat-y;
	padding-right:5px;
}
#LoadTransBackGrnd
{
width:97%;
height:300px;
overflow-y:scroll;
overflow-x:hidden;
}
#fotter_popup
{
	width:302px;
}

#mba_div 
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#636363;
	list-style-image:url(images/plus.gif);
	font-weight:bold;
	line-height:20px;
	padding-left:20px;
}
.mba_div 
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#636363;
	list-style-image:url(images/plus.gif);
	font-weight:bold;
	line-height:20px;
	padding-left:20px;
}
.mba_div a 
{
color:#636363;
text-decoration:none;
}
.mba_Checkbox_div 
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#676767;
	list-style-image:url(images/plus.gif);
	font-weight:normal;
	line-height:20px;
	padding-left:30px;
}
.mba_Checkbox_div a
{
color:#676767;
text-decoration:none;
}
.mba_link 
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#676767;
	list-style-image:url(images/plus.gif);
	font-weight:normal;
	line-height:20px;
}
#all_MBA
{
	
	width:100%;
}
#all_subPart
{
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#949494;
	line-height:20px;
}
#middle_arrow
{
	width:28px;
	height:150px;
	float:left;
	padding-top:200px;
}
#add_right_part
{
	width:265px;
	background:url(images/split.gif) repeat-x;
	float:left;
	margin-top:20px;
	height:370px;
	margin-right:0px;
}

#MBA_Header
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:15px;
	color:#E64A00;
	background:#fdfdfd;
	line-height:30px;
	float:left;
	width:100%;
	font-weight:bold;
	padding-left:0px;
	border-bottom:solid 1px #114EAB;
}

#mba_Remove
{
	
	height:29px;
	width:100%;
	border-bottom:solid 1px #cccccc;
	float:left;
}
#mba_Category_button
{

	width:270px;
	margin-top:8px;
	
}
#mba_remove_textleft
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#636363;
	float:left;
	padding-left:10px;
	line-height:25px;
}
.small_text {
	font-family: Verdana,Arial, Helvetica, sans-serif;
	font-size: 11px;
	text-decoration: none;
	color: #666666;
	float:right;
	line-height:20px;
}
.small_heading {
	font-family: Arial, Helvetica, sans-serif;
	font-size:15px;
	color:#5c5c5c;
	font-weight: bold;
	line-height:20px;
}
#mba_remove_textright
{
	float:right;
	padding:8px 0px 7px 0px;
}
#footer_popup
{
	width:590px;
	height:20px;
	float:left;
	margin-left:15px;
	margin-right:15px;
	margin-top:10px;
	padding-top:10px;
		
	border-top:solid 1px #cccccc;

}
#tabel_rightPart
{
	width:300px;
	float:left;
	margin-top:2px;
}

.border_boottam
{
	border-bottom:solid 1px #CCCCCC;
}

.next_but_l
{
background:url(images/test_icons_click_left.gif) no-repeat;
width:28px;
height:28px;
float:left;
}
.next_but_r
{
background:url(images/test_icons_click_right.gif) no-repeat;
width:14px;
height:28px;
float:left;
}
.next_but_m
{
background:url(images/test_icons_click_mid.gif) repeat-x;
width:auto;
line-height:28px;
float:left;
text-align:center;
font-family:Arial, Helvetica, sans-serif;
font-size:13px;
color:#ffffff;
padding-left:10px;
padding-right:10px;
font-weight:bold;
}
.next_but_m a
{
color:#ffffff;
text-decoration:none;
}
.div_test_name_submit
{
background-color:#D76B00;
border:1px solid #e1e1e1;
font-family:Arial, Helvetica, sans-serif;
font-size:11px;
color:#FFFFFF;
text-align:center;
font-weight:bold;
padding:3px;
width:125px;
}
* html .div_test_name_submit
{
padding:2px;
height:auto;
}
.div_test_name_anc
{
background-color:#114EAB;
border:1px solid #e1e1e1;
font-family:Arial, Helvetica, sans-serif;

font-size:13px;
color:#FFFFFF;
text-align:center;
font-weight:bold;
float:right;
width:120px;
line-height:25px;
}
.div_test_name_anc a
{
color:#FFFFFF;
text-decoration:none;
}


.dynmic_div
{
background:#f2f2f2;
padding-right:5px;
font-family:Arial, Helvetica, sans-serif;
font-size:12px;
color:#000000;
font-weight:900;
line-height:30px;
}
</style>


</head>
<body style="background:none;">
<div id="main_popup">

<div style="color:#F68122; font-size:12px; font-weight:bold;">Select any categories and sub-categories.</div>
<div class="small_text"><strong>For example</strong> :- You can choose 
as varied combinations as 'Type1' of Mathematics from VI Standard plus 'Type2' of Physics from VII Standard</div>
<div id="middle_popup">
<form id="menuForm" name="menuForm" method="post" action="decideNumber.php">
<input name="section" value="1" type="hidden">
<input name="newSection" value="yes" type="hidden">
<input name="showButton" value="" type="hidden">
  <input name="ids" value="," type="hidden">
    		<div id="left_popup">
        	<div id="header_popup">Choose Category / Subcategory</div> 
            	<div class="overflow_main">
                <div id="LoadTransBackGrnd">

<?php
		$cur_obj = new SqlClass();
		$grade_obj = new SqlClass();
		$sub_obj = new SqlClass();
		$course_obj = new SqlClass();
		$chapter_obj = new SqlClass();


// Creating Menu for Circulums
		$circulums=$generator->get_dist_circulums();
		
		while($cur=$cur_obj->fetchRow($circulums))
		{
			$curid='CR'.$cur['cur_id'];
			$curname=$cur['cur_name'];
			
			echo '<span class="mba_div" id="'.$curid.'" onclick=\'appendBranch("'.$curname.'","'.$curid.'")\' style="cursor:pointer;"><img src="images/plus.gif" id="I'.$curid.'"> '.$curname.'<br></span>';
			echo '<span style="display: none;" class="mba_Checkbox_div" id="'.$curid.'b">';
			// echo '<input id="chk_'.$curid.'" value="'.$curid.'" onClick="hideBranch(\''.$curname.'\',\''.$curid.'\')" type="checkbox">All '.$curname.'<br>';


// Creating Menu for Grades under Circulums
			$grades=$generator->get_dist_grades($cur['cur_id']);
			while($grade=$grade_obj->fetchRow($grades))
			{
				$gradeid=$curid.'GR'.$grade['grade_id'];
				$gradename=$grade['grade_name'];
				
				echo '<span class="mba_div" id="'.$gradeid.'" onclick=\'appendBranch("'.$gradename.'","'.$gradeid.'")\' style="cursor:pointer;"><img src="images/plus.gif" id="I'.$gradeid.'"> '.$gradename.'<br></span>';
				echo '<span style="display: none;" class="mba_Checkbox_div" id="'.$gradeid.'b">';
				// echo '<input id="chk_'.$gradeid.'" value="'.$gradeid.'" onClick="hideBranch(\''.$gradename.'\',\''.$gradeid.'\')" type="checkbox">All '.$gradename.'<br>';
				

// Creating Menu for Subjects under Grades
					$subjects=$generator->get_dist_subjects($cur['cur_id'],$grade['grade_id']);
					while($sub=$sub_obj->fetchRow($subjects))
					{
						$subid=$gradeid.'SB'.$sub['subject_id'];
						$subname=$sub['sub_name'];
						
						echo '<span class="mba_div" id="'.$subid.'" onclick=\'appendBranch("'.$subname.'","'.$subid.'")\' style="cursor:pointer;"><img src="images/plus.gif" id="I'.$subid.'"> '.$subname.'<br></span>';
						echo '<span style="display: none;" class="mba_Checkbox_div" id="'.$subid.'b">';
						// echo '<input id="chk_'.$subid.'" value="'.$subid.'" onClick="hideBranch(\''.$subname.'\',\''.$subid.'\')" type="checkbox">All '.$subname.'<br>';
						
						
						$delimiters = Array("GR","CR","SB");
						
						$ids = explode("-",str_replace($delimiters, "-", $subid));
						$course_id=$generator->get_course_id($ids[1],$ids[2],$ids[3]);
						
// Creating Menu for Subjects under Grades
							$chapters=$generator->get_chapters($course_id);
							while($chapter=$chapter_obj->fetchRow($chapters))
							{
								$chapid=$chapter['chap_id'];
								$chapname=$chapter['chap_name'];
								
								// echo '<span class="mba_div" id="'.$chapid.'" onclick=\'appendBranch("'.$chapname.'","'.$chapid.'")\' style="cursor:pointer;"><img src="images/plus.gif" id="I'.$chapid.'"> '.$chapname.'<br></span>';
								echo '<input id="chk_'.$chapid.'" value="'.$chapid.'" onClick="hideBranch(\''.$chapname.'\',\''.$chapid.'\')" type="checkbox"><a id="'.$chapid.'" class="mba_link">'.$chapname.'</a><br>';
							}
					
					echo '</span>';
					}

			echo '</span>';
			}

			echo '</span>';
		}
		
?>

<?php
/*		$objSql = new SqlClass();
		$sql = "select * from circulams";
		$rs = $objSql->executeSql($sql);
		while($row = $objSql->fetchRow($rs))
		{
			echo '<span class="mba_div" id="'.$row['cid'].'" onclick=\'appendBranch("'.$row['cname'].'","'.$row['cid'].'")\'><img src="images/plus.gif" id="I'.$row['cid'].'"> '.$row['cname'].'<br></span>';
		}
*/	
?>


</div>
                </div>
                	<div id="fotter_popup"><img src="images/footer.gif"></div>
        
        </div>
        <div id="middle_arrow" align="center"><img src="images/arrow_test.gif"></div>	
        
        <div id="tabel_rightPart">
       	  <div id="MBA_Header" style="clear: both;" align="left">Section 1</div>
   		  <div style="clear: both; padding: 5px; background-color: rgb(245, 245, 245);" align="center"><table align="center" border="0" cellpadding="0" cellspacing="0" width="98%">
               				  <tbody><tr>
                   				  <td class="small_heading">Instructions</td>
               				  </tr>
               				  <tr>
                   				  <td class="small_text">
                                  <ul style="list-style-image: url(&quot;images/arrow_sam.gif&quot;); padding: 0px 0px 0px 15px; margin: 0px;">
                                  	<li>Click on the topic to see  sub-topics</li>
                                  	<li>Click <img src="images/check.gif"> to add the category and its subcategory </li>
                                  </ul>
                                  </td>
                              </tr>
               			  </tbody></table>
   		  </div>    <br> 
          <div id="selectedcategname" class="dynmic_div"></div>
             
            <div style="float: right; margin-top: 10px; display: none;" id="frmcat">
                      <div>
                            <div style="float: right;">
                                <div><input type="image" src="images/customize_test.jpg" border="0" name="Submit" title="Customize Test" id="Submit"></div>
                            </div>
                        <div style="float: right; margin-right: 10px;">
                                 <div>
	<!-- <input type="Submit" value="Quick Generate" name="Submit" class="div_test_name_submit"></div> -->                              

 <!-- <div class="div_test_name_anc"><a href = "autogentest.php"  target="_parent">Quick Generate</a></div>-->
                            </div>
                            <br>
                             <div class="small_text"><!-- Click quick generate button to autogenerate 25 questions test from above selected categories -->	</div>
                
                
                        </div>

    		 </div>

    
    <input name="curqno" id="curqno" value="" type="hidden">
    
                        
      </div>
    </form></div>
    </div>
<script>
myselectedcateg1 = new Array();
myselectedcategname1 = new Array();
arrAllowedCateg = new Array();
stepsCourses = new Array();
		 //getcatdisplay(myselectedcateg1,myselectedcategname1);
if(myselectedcateg1.length>0)
document.getElementById("frmcat").style.display = "none";

myselectedcategStr =  myselectedcateg1.join();
		
myselectedcategnameStr =  myselectedcategname1.join();

function selectedCatDisplay(){
//selectedCatDisplay1();
}

function selectedCatDisplay1(){
}



function loadXML(xmlFile)
{
  xmlDoc.async="false";
  xmlDoc.onreadystatechange=verify;
  xmlDoc.load(xmlFile);
  xmlObj=xmlDoc.documentElement;
}


/*function traverse(tree) {
        if(tree.hasChildNodes()) {
                document.write('<ul><li>');
                document.write('<b>'+tree.tagName+' : </b>');
                var nodes=tree.childNodes.length;
                for(var i=0; i<tree.childNodes.length; i++)
                        traverse(tree.childNodes(i));
                document.write('</li></ul>');
        }
        else
                document.write(tree.text);
}
function initTraverse(file) {
        loadXML(file);
        var doc=xmlDoc.documentElement;
        traverse(doc);
}*/

//var xmlDoc = new ActiveXObject("Microsoft.XMLDOM");

var isIE = (navigator.appVersion.indexOf("MSIE") != -1) ? true : false;
var isWin = (navigator.userAgent.indexOf("Firefox") != -1) ? true : false;
var isOpera = (navigator.userAgent.indexOf("Opera") != -1) ? true : false;
var isChrome = (navigator.userAgent.indexOf("Chrome") != -1) ? true : false;
var isSafari = (navigator.userAgent.indexOf("Safari") != -1) ? true : false;
//alert(navigator.userAgent+"\nIE="+isIE+"\n"+"Mozilla="+isWin+"\n"+"Opera="+isOpera+"\nChrome="+isChrome);

if(isWin){
	if (document.implementation && document.implementation.createDocument)
	{
	
	xmlDoc = document.implementation.createDocument("", "", null);
	xmlDoc.load("ncategory1.xml");
	
	xmlDoc.onload=function(){
	
		tagName = "pid-0";
		
				for(j=0;j<xmlDoc.getElementsByTagName(tagName).length;j+=10){
					
					document.getElementById("LoadTransBackGrnd").innerHTML = writeList(j);
					}
					
					selectedCatDisplay();
			}
	
	}

}

//else if (window.ActiveXObject)
else if (isIE)
{
	xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
	loadXML('ncategory1.xml');
}
else if (isChrome || isOpera || isSafari)
{
	xmlsrc = "ncategory1.xml";
	var xmlhttp = new window.XMLHttpRequest();
	xmlhttp.open("GET",xmlsrc,false);
	xmlhttp.send(null);
	var xmlDoc = xmlhttp.responseXML.documentElement;
	tagName = "pid-0";
	
		for(j=0;j<xmlDoc.getElementsByTagName(tagName).length;j+=10){
			document.getElementById("LoadTransBackGrnd").innerHTML = writeList(j);
		}
			selectedCatDisplay();
}
else
{

	alert('Your browser can\'t load the XML file: ' + e.toString());

} //end else if


xmlLoaded = 0;
function verify()
{
  	 if (xmlDoc.readyState != 4)
	  {
		  return false;
	  }
 	 else{
  			tagName = "pid-0";
			for(j=0;j<xmlDoc.getElementsByTagName(tagName).length;j+=10){
	
					document.getElementById("LoadTransBackGrnd").innerHTML = writeList(j);
			}
			selectedCatDisplay();
			
		}
}

</script>
<!--<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script><script src="localhost/test_gen/js/ga.js" type="text/javascript"></script>
<script>
var pageTracker = _gat._getTracker("UA-3438803-1");
pageTracker._setSessionTimeout("10800");
pageTracker._setDomainName("none");
pageTracker._setAllowLinker(true);
pageTracker._initData();
pageTracker._trackPageview();
pageTracker._trackEvent('TestGen', 'Load Test Generator', 'Test Generator');
</script>-->
</body></html>