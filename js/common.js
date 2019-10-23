var ieB = (document.all) ? 1 : 0;
if(ieB == 1){
	myHeight = document.documentElement.clientHeight; 
	myWidth = document.documentElement.clientWidth; 
}else{ 
	myHeight = window.innerHeight;
	myWidth = window.innerWidth;
}

// function to show test name div in gen_test_account_inc.php page

function ShowTestNameDiv(id,tstName){	
	hoveritem = document.getElementById(id);	
	document.getElementById('hiddTstId').value=hoveritem.id;	
	while(tstName.indexOf('+')>-1){tstName=tstName.replace('+',' ');}
	document.getElementById('txtTestName').value=unescape(tstName);
	hp=document.getElementById("divTestName");	
	hp.style.top=hoveritem.offsetTop+-5+"px";	
	//hp.style.left=hoveritem.offsetLeft-hoveritem.offsetLeft+20+"px";
	hp.style.left=hoveritem.offsetLeft-8+"px";
	hp.style.visibility="visible";	
}
function hide(){
	document.getElementById('divTestName').style.visibility='hidden';
}
function ShowEditIcon(id,show) {
if(!document.getElementById("divIcon"+id)){
	return false;
}
	if(show) {
		document.getElementById("divIcon"+id).style.display = "block";
	} else {
		document.getElementById("divIcon"+id).style.display = "none";
	}
	
}

/*function ObjectPosition(obj) {
    var curleft = 0;
      var curtop = 0;
      if (obj.offsetParent) {
            do {
                  curleft += obj.offsetLeft;
                  curtop += obj.offsetTop;
            } while (obj = obj.offsetParent);
      }
      return [curleft,curtop];
}*/

function trim(s)
{var i;var returnString="";for(i=0;i<s.length;i++)
{var c=s.charAt(i);if(c!=" ")returnString+=c;}
return returnString;}

if(window.location.hostname!="localhost")
siteUrl="http://robotutor.in";
else
siteUrl="http://localhost";
var oXHR=null;
function sendRequest(f,div,locate){
	var oForm = f;
	if(locate===undefined){locate='';}
	if(typeof(f)=="object"){var sBody=getRequestBody(f);var script=oForm.action;}
	else var script=f;
	
		// alert(script);

	if(!oXHR){var oXHR=createXHR();}
	var patt1 = /section/;
	if(locate==''&&document.getElementById(div)!="undefined"&&document.getElementById(div)!=null){
		if(document.getElementById(div+'DivWait')){
			document.getElementById(div+'DivWait').innerHTML = 'Please Wait...'
			document.getElementById('comingDiv').style.display = 'block';
		}else
			document.getElementById(div).innerHTML='<div align="center" style="height:80px"><img src="'+siteUrl+'/images/loading.gif"></div>';
	}else if(locate!='')
		parent.document.getElementById(div).innerHTML='<div align="center"><img src="'+siteUrl+'/images/loading.gif"></div>';
	oXHR.open("post",script,true);
	oXHR.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	oXHR.onreadystatechange=function(){
		if(oXHR.readyState==4){
			if(oXHR.status==200){
				if(locate==''&&document.getElementById(div)!="undefined"&&document.getElementById(div)!=null){
					document.getElementById(div).innerHTML=oXHR.responseText;
					var j=document.createElement("div");
					j.innerHTML="_"+oXHR.responseText+"_";execJS(j);
				}else if(locate!=''){
					parent.document.getElementById(div).innerHTML=oXHR.responseText;
					var j=document.createElement("div");
					j.innerHTML="_"+oXHR.responseText+"_";execJS(j);
				}
				if(document.getElementById(div+'DivWait')){
					document.getElementById(div+'DivWait').innerHTML = ''
					document.getElementById('comingDiv').style.display = 'none';
				}				
			}else{
				if(locate==''&&document.getElementById(div)!="undefined"&&document.getElementById(div)!=null)
					document.getElementById(div).innerHTML="";
				else if(locate!='')
					parent.document.getElementById(div).innerHTML=" ";
			}
		}
	};
	oXHR.send(sBody);
}
function encodeNameAndValue(sName,sValue){var sParam=encodeURIComponent(sName);sParam+="=";sParam+=encodeURIComponent(sValue);return sParam;}
function createXHR(){if(typeof XMLHttpRequest!="undefined"){return new XMLHttpRequest();}
else if(window.ActiveXObject){var aVersions=["MSXML2.XMLHttp.6.0","MSXML2.XMLHttp.3.0"];for(var i=0;i<aVersions.length;i++){try{var oXHR=new ActiveXObject(aVersions[i]);return oXHR;}catch(oError){}}}}
function getRequestBody(f){var aParams=new Array();var oForm=f;for(var i=0;i<oForm.elements.length;i++){var oField=oForm.elements[i];switch(oField.type){case"button":case"submit":case"reset":break;case"checkbox":case"radio":if(!oField.checked){break;}
case"text":case"select-one":case"select-multiple":case"textarea":case"hidden":case"password":aParams.push(encodeNameAndValue(oField.name,oField.value));break;default:}}
return aParams.join("&");}
function execJS(node)
{var st=node.getElementsByTagName('SCRIPT');var strExec;var bSaf=(navigator.userAgent.indexOf('Safari')!=-1);var bOpera=(navigator.userAgent.indexOf('Opera')!=-1);var bMoz=(navigator.appName=='Netscape');for(var i=0;i<st.length;i++)
{if(bSaf)
{strExec=st[i].innerHTML;}
else if(bOpera)
{strExec=st[i].text;}
else if(bMoz)
{strExec=st[i].textContent;}
else
{strExec=st[i].text;}
try
{eval(strExec);}
catch(e)
{alert(e);}}}
var ahahscript={loading:'loading...',ahah:function(url,target,delay,method,parameters){ if(document.getElementById(target)!="undefined"&&document.getElementById(target)!=null){
		if(document.getElementById(target+'DivWait')){
			document.getElementById(target+'DivWait').innerHTML='Please Wait...';
			document.getElementById('comingDiv').style.display = 'block';
		}
	}
if((method==undefined)||(method=="GET")||(method=="get")){if(window.XMLHttpRequest){req=new XMLHttpRequest();}
else if(window.ActiveXObject){req=new ActiveXObject("Microsoft.XMLHTTP");}
if(req){req.onreadystatechange=function(){ahahscript.ahahDone(url,target,delay,method,parameters);};req.open(method,url,true);req.send("");}}
if((method=="POST")||(method=="post")){if(window.XMLHttpRequest){req=new XMLHttpRequest();}
else if(window.ActiveXObject){req=new ActiveXObject("Microsoft.XMLHTTP");}
if(req){req.onreadystatechange=function(){ahahscript.ahahDone(url,target,delay,method,parameters);};req.open(method,url,true);req.setRequestHeader("Content-type","application/x-www-form-urlencoded");req.send(parameters);}}},ahah1:function(url,target,delay,method,parameters){if((method==undefined)||(method=="GET")||(method=="get")){if(window.XMLHttpRequest){req1=new XMLHttpRequest();}
else if(window.ActiveXObject){req1=new ActiveXObject("Microsoft.XMLHTTP");}
if(req1){req1.onreadystatechange=function(){ahahscript.ahahDone1(url,target,delay,method,parameters);};req1.open(method,url,true);req1.send("");}}
if((method=="POST")||(method=="post")){if(window.XMLHttpRequest){req=new XMLHttpRequest();}
else if(window.ActiveXObject){req=new ActiveXObject("Microsoft.XMLHTTP");}
if(req){req.onreadystatechange=function(){ahahscript.ahahDone(url,target,delay,method,parameters);};req.open(method,url,true);req.setRequestHeader("Content-type","application/x-www-form-urlencoded");req.send(parameters);}}},creaDIV:function(target,html){if(document.body.innerHTML){document.getElementById(target).innerHTML=html;}
else if(document.getElementById){var element=document.getElementById(target);var range=document.createRange();range.selectNodeContents(element);range.deleteContents();element.appendChild(range.createContextualFragment(html));}},execJS:function(node){var st=node.getElementsByTagName('SCRIPT');var strExec;var bSaf=(navigator.userAgent.indexOf('Safari')!=-1);var bOpera=(navigator.userAgent.indexOf('Opera')!=-1);var bMoz=(navigator.appName=='Netscape');for(var i=0;i<st.length;i++){if(bSaf){strExec=st[i].innerHTML;}
else if(bOpera){strExec=st[i].text;}
else if(bMoz){strExec=st[i].textContent;}
else{strExec=st[i].text;}
try{eval(strExec);}catch(e){/*alert(e);*/}}},ahahDone:function(url,target,delay,method,parameters){if(req.readyState==4){element=document.getElementById(target);if(req.status=='200'){this.creaDIV(target,req.responseText);output=req.responseText;document.getElementById(target).innerHTML=output;
if(document.getElementById(target+'DivWait')){
	document.getElementById(target+'DivWait').innerHTML='';
	document.getElementById('comingDiv').style.display = 'none';
}

var j=document.createElement("div");j.innerHTML="_"+output+"_";this.execJS(j);}
else{this.creaDIV(target,""+req.statusText);}}},ahahDone1:function(url,target,delay,method,parameters){if(req1.readyState==4){element=document.getElementById(target);if(req1.status=='200'){this.creaDIV(target,req1.responseText);output=req1.responseText;document.getElementById(target).innerHTML=output;var j=document.createElement("div");j.innerHTML="_"+output+"_";this.execJS(j);}
else{this.creaDIV(target,""+req1.statusText);}}},likeSubmit:function(file,method,formName,target){var the_form=document.getElementById(formName);var num=the_form.elements.length;var url="";var radio_buttons=new Array();var nome_buttons=new Array();var check_buttons=new Array();var nome_buttons=new Array();var j=0;var a=0;for(var i=0;i<the_form.length;i++){var temp=the_form.elements[i].type;if((temp=="radio")&&(the_form.elements[i].checked)){nome_buttons[a]=the_form.elements[i].name;radio_buttons[j]=the_form.elements[i].value;j++;a++;}}
for(var k=0;k<radio_buttons.length;k++){url+=nome_buttons[k]+"="+radio_buttons[k]+"&";}
var j=0;var a=0;for(var i=0;i<the_form.length;i++){var temp=the_form.elements[i].type;if((temp=="checkbox")&&(the_form.elements[i].checked)){nome_buttons[a]=the_form.elements[i].name;check_buttons[j]=the_form.elements[i].value;j++;a++;}}
for(var k=0;k<check_buttons.length;k++){url+=nome_buttons[k]+"="+check_buttons[k]+"&";}
for(var i=0;i<num;i++){var chiave=the_form.elements[i].name;var valore=the_form.elements[i].value;var tipo=the_form.elements[i].type;if((tipo=="submit")||(tipo=="radio")||(tipo=="checkbox")){}
else{url+=chiave+"="+valore+"&";}}
var parameters=url;url=file+"?"+url;if(method==undefined){method="GET";}
if(method=="GET"){this.ahah(url,target,'',method,'');}
else{this.ahah(file,target,'',method,parameters);}}};
function addListener(element,type,expression,bubbling){
	bubbling=bubbling||false;
	if(window.addEventListener && element.addEventListener){
		element.addEventListener(type,expression,bubbling);
		return true;
	}else if(window.attachEvent && element.attachEvent){
		element.attachEvent('on'+type,expression);
		return true;
	}else return false;
}
var ImageLoader=function(url){this.url=url;this.image=null;this.loadEvent=null;};ImageLoader.prototype={load:function(){this.image=document.createElement('img');var url=this.url;var image=this.image;var loadEvent=this.loadEvent;addListener(this.image,'load',function(e){if(loadEvent!=null){loadEvent(url,image);}},false);this.image.src=this.url;},getImage:function(){return this.image;}};function loadImage(url,id){var loader=new ImageLoader(url);loader.loadEvent=function(url,image){putImage(image,id);}
loader.load();}
function putImage(image,id){var h=document.getElementById(id);while(h.firstChild){h.removeChild(h.firstChild);}
h.appendChild(image);}

// Begin Pop up Script
siteUrl="http://learnnow.com";var dragapproved=false
var minrestore=0
var initialwidth,initialheight
var ie5=document.all&&document.getElementById
var ns6=document.getElementById&&!document.all
function iecompattest(){return(!window.opera&&document.compatMode&&document.compatMode!="BackCompat")?document.documentElement:document.body}
function drag_drop(e){if(ie5&&dragapproved&&event.button==1){document.getElementById("dwindow").style.left=tempx+event.clientX-offsetx+"px"
document.getElementById("dwindow").style.top=tempy+event.clientY-offsety+"px"}
else if(ns6&&dragapproved){document.getElementById("dwindow").style.left=tempx+e.clientX-offsetx+"px"
document.getElementById("dwindow").style.top=tempy+e.clientY-offsety+"px"}}
function initializedrag(e){offsetx=ie5?event.clientX:e.clientX
offsety=ie5?event.clientY:e.clientY
document.getElementById("dwindowcontent").style.display="none"
tempx=parseInt(document.getElementById("dwindow").style.left)
tempy=parseInt(document.getElementById("dwindow").style.top)
dragapproved=true
document.getElementById("dwindow").onmousemove=drag_drop}
function loadwindow(url,width,height){
var frame = document.getElementById("cframe");
frame.contentWindow.document.body.innerHTML= '<div style="font-family:Arial, Helvetica, sans-serif; font-size:13px;color:#114eab;font-weight: bold;line-height:20px;vertical-align:middle;" ><center>Please Wait.....</center> </div>';
loadPopup();if(!ie5&&!ns6)
window.open(url,"","width=width,height=height,scrollbars=1")
else{document.getElementById("dwindow").style.display=''
//document.getElementById("dwindow").style.left="15%"

// First, determine how much the visitor has scrolled

/*var scrolledX, scrolledY;
if( self.pageYoffset ) {
scrolledX = self.pageXoffset;
scrolledY = self.pageYoffset;
} else if( document.documentElement && document.documentElement.scrollTop ) {
scrolledX = document.documentElement.scrollLeft;
scrolledY = document.documentElement.scrollTop;
} else if( document.body ) {
scrolledX = document.body.scrollLeft;
scrolledY = document.body.scrollTop;
} 

var centerX, centerY;
if( self.innerHeight ) {
centerX = self.innerWidth;
centerY = self.innerHeight;
} else if( document.documentElement && document.documentElement.clientHeight ) {
centerX = document.documentElement.clientWidth;
centerY = document.documentElement.clientHeight;
} else if( document.body ) {
centerX = document.body.clientWidth;
centerY = document.body.clientHeight;
} 
// Xwidth is the width of the div, Yheight is the height of the
// div passed as arguments to the function:
var leftoffset = scrolledX + (centerX - Xwidth) / 2;
var topoffset = scrolledY + (centerY - Yheight) / 2;
// The initial width and height of the div can be set in the
// style sheet with display:none; divid is passed as an argument to // the function
var o=document.getElementById("dwindow");
var r=o.style;
r.position='absolute';
r.top = topoffset + 'px';
r.left = leftoffset + 'px';*/



document.getElementById("dwindow").style.left=ns6? window.pageXOffset*1+80+"px" : iecompattest().scrollLeft*1+80+"px"

document.getElementById("dwindow").align='center'
document.getElementById("dwindow").style.top=ns6?window.pageYOffset*1-80+"px":iecompattest().scrollTop*1-80+"px"
document.getElementById("dwindow").style.width=initialwidth=width+"px"
document.getElementById("dwindow").style.height=initialheight=height+"px"

document.getElementById("cframe").style.display=''
document.getElementById("cframe").style.width=initialwidth=width-10+"px"

document.getElementById("cframe").style.height=initialheight=height-10+"px"
document.getElementById("cframe").style.left="30px"
document.getElementById("cframe").style.top=ns6?window.pageYOffset*1+30+"px":iecompattest().scrollTop*1+30+"px"
document.getElementById("cframe").src=url
}

centerAlignDiv("dwindow",width,height);
}
function maximize(){if(minrestore==0){minrestore=1
document.getElementById("maxname").setAttribute("src","/OpenInviter/images/restore.gif")
document.getElementById("dwindow").style.width=ns6?window.innerWidth-20+"px":iecompattest().clientWidth+"px"
document.getElementById("dwindow").style.height=ns6?window.innerHeight-20+"px":iecompattest().clientHeight+"px"}
else{minrestore=0
document.getElementById("maxname").setAttribute("src","/OpenInviter/images/max.gif")
document.getElementById("dwindow").style.width=initialwidth
document.getElementById("dwindow").style.height=initialheight}
document.getElementById("dwindow").style.left=ns6?window.pageXOffset+"px":iecompattest().scrollLeft+"px"
document.getElementById("dwindow").style.top=ns6?window.pageYOffset+"px":iecompattest().scrollTop+"px"

}
function closeit(){if(popupStatus==1){/*jQuery("#backgroundPopup").fadeOut("slow");jQuery("#dwindow").fadeOut("slow");popupStatus=0;*/document.getElementById("backgroundPopup").style.display='none';document.getElementById("dwindow").style.display='none';popupStatus=0;}}
function stopdrag(){dragapproved=false;document.getElementById("dwindow").onmousemove=null;document.getElementById("dwindowcontent").style.display=""}
/*jQuery(document).readydocument.onLoad=(function(){jQuery(document).keypress(function(e){if(e.keyCode==27&&popupStatus==1){closeit();}});});*/function centerPopup(){if(document.documentElement&&(document.documentElement.clientWidth||document.documentElement.clientHeight)){var windowWidth=document.documentElement.clientWidth;var windowHeight=document.documentElement.clientHeight;}else if(document.body&&(document.body.clientWidth||document.body.clientHeight)){var windowWidth=document.body.clientWidth;var windowHeight=document.body.clientHeight;}
/*var popupHeight=jQuery("#dwindow").height();*/var popupHeight=document.getElementById("dwindow").style.height;/*var popupWidth=jQuery("#dwindow").width();*/var popupWidth=document.getElementById("dwindow").style.width;/*jQuery("#dwindow").css({"position":"absolute","top":200,"left":400});jQuery("#backgroundPopup").css({"height":windowHeight});*/document.getElementById("dwindow").style.position="absolute";document.getElementById("dwindow").style.top="200";document.getElementById("dwindow").style.left="400";document.getElementById("backgroundPopup").style.height=windowHeight;}
var popupStatus=0;function loadPopup(){if(popupStatus==0){

windowHeight= (typeof window.innerHeight != 'undefined' ? window.innerHeight : document.body.clientHeight);
windowWidth= (typeof window.innerWidth != 'undefined' ? window.innerWidth : document.body.clientWidth);

document.getElementById("backgroundPopup").style.width = windowWidth-5+"px";

document.getElementById("backgroundPopup").style.height = windowHeight-5+"px";	/*jQuery("#backgroundPopup").css({"opacity":"0.7"});jQuery("#backgroundPopup").fadeIn("slow");jQuery("#dwindow").fadeIn("slow");popupStatus=1;*/document.getElementById("backgroundPopup").style.opacity="0.7";document.getElementById("backgroundPopup").style.display="block";document.getElementById("dwindow").style.display="block";popupStatus=1;}}
// End popup script

function checkOther(id,val){
	if(val == "Other")
	document.getElementById(id).style.display = "block";
	else{
	document.getElementById(id).style.display = "none";
	document.getElementById(id).value = "";
	}
}
// Validate Form // JavaScript Document
function FormField(name, description, type, id){	
	this.name = name;
	this.description = description;
	this.type = type;	
	this.id = id; // multi-use
	this.isValid = function(f){
			
				switch(this.type){
					case "text" :
					return (trim(f.elements[this.name].value) != "");
					break;
					
					case "number" :
					var number_regex = /^[0-9]+$/;
					return ( number_regex.test(f.elements[this.name].value) && f.elements[this.name].value!=parseInt("0"));
					break;
					
					case "select" :
				return (f.elements[this.name].options[f.elements[this.name].selectedIndex].value != "");
				break;
					
					case "character" :
					var number_regex = /^[A-Za-z]+$/;
					return ( number_regex.test(f.elements[this.name].value));
					break;
					
					case "radio" :
					return ((document.form1.sellingType[0].checked == true ) || (document.form1.sellingType[1].checked == true));
					break;
					
				case "confirm" :
 				return ( (f.elements[this.name].value != "") && (f.elements[this.additional_params].value == f.elements[this.name].value) );
				break;
				
				case "checkbox" :
				return (f.elements[this.name].checked == true);
				break;
					
					case "email" :
					var email_regex = /^([a-z0-9_-]+\.)*[a-z0-9_-]+@([a-z0-9_-]+\.)+[a-z]{2,3}$/i;
					return (email_regex.test(f.elements[this.name].value));
					break;		
					default : return false;
				};
		};
}

function validateForm(f){	
		var fields_with_errors = new Array();
		var checks_with_errors = new Array();
		for (var i in required_fields){
				if(!required_fields[i].isValid(f)){
					
					fields_with_errors[fields_with_errors.length] = required_fields[i].description;
				}
		}
		if(typeof(check_fields)!="undefined"){
		for (var i in check_fields){
				if(!check_fields[i].isValid1(f)){
					
					checks_with_errors[checks_with_errors.length] = check_fields[i].description;
				}
		}
		}
		if(fields_with_errors.length > 0){
			alert("Make sure following fields are complete and correct:\n\n-" + fields_with_errors.join("\n -"));
			return false;
		}else if(typeof(check_fields!="undefined") && checks_with_errors.length > 0){
			alert("Make sure following fields are complete and correct:\n\n-" + checks_with_errors.join("\n -"));
			return false;
		}
		else	
		return true;
		

	
		return false;
}
function validateFormError(f){
	
		var fields_with_errors = new Array();
		var checks_with_errors = new Array();
		for (var i in required_fields){
				if(!required_fields[i].isValid(f)){
					
			fields_with_errors[fields_with_errors.length] = required_fields[i].description;
					fieldName = required_fields[i].name;
					document.getElementById("err"+fieldName).style.display = "block";
				}
				else{fieldName = required_fields[i].name;
				document.getElementById("err"+fieldName).style.display = "none";
				}
		}
	
		if(fields_with_errors.length > 0){
			//alert("Make sure following fields are complete and correct:\n\n-" + fields_with_errors.join("\n -"));
			return false;
		}
		else	
		return true;
		

	
		return false;
}


// Toggle all checkboxes in list
function toggleAlltcy(f,element) {
	var z = 0;
	for(z=0; z<f.length;z++){
		if(f[z].type == 'checkbox')
			f[z].checked = element.checked;
   	}
}

function BindArguments(fn)
{
  var args = [];
  for (var n = 1; n < arguments.length; n++)
    args.push(arguments[n]);
  return function () { return fn.apply(this, args); };
}

	// FLOAT DIV TO WINDOW MIDDLE 
	var ns = (navigator.appName.indexOf("Netscape") != -1);
	var d = document;
	function FloatDiv(id, sx, sy){
		var el=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
		var px = document.layers ? "" : "px";
		window[id + "_obj"] = el;
		if(d.layers)el.style=el;
		el.cx = el.sx = sx;el.cy = el.sy = sy;
		el.sP=function(x,y){this.style.left=x+px;this.style.top=y+px;};
	
		el.floatIt=function(){
			var pX, pY;
			pX = (this.sx >= 0) ? 0 : ns ? innerWidth : 
			document.documentElement && document.documentElement.clientWidth ? 
			document.documentElement.clientWidth : document.body.clientWidth;
			pY = ns ? pageYOffset : document.documentElement && document.documentElement.scrollTop ? 
			document.documentElement.scrollTop : document.body.scrollTop;
			if(this.sy<0) 
			pY += ns ? innerHeight : document.documentElement && document.documentElement.clientHeight ? 
			document.documentElement.clientHeight : document.body.clientHeight;
			this.cx += (pX + this.sx - this.cx)/8;this.cy += (pY + this.sy - this.cy)/8;
			this.sP(this.cx, this.cy);
			setTimeout(this.id + "_obj.floatIt()", 30);
		}
		return el;
	}	
	// FLOAT DIV TO WINDOW MIDDLE
	
function centerAlignDiv(divId,wObj,HObj) {
		meOnTop = (myHeight-HObj)/2
		meOnLeft = (myWidth-wObj)/2	
		FloatDiv(divId, meOnLeft,meOnTop).floatIt();
}
function newGeneratedtest(){
	if(ieB == 1){
		document.getElementById('backgroundPopup').style.opacity = 3;
		document.getElementById('backgroundPopup').style.filter = 'alpha(opacity=' + 30 + ')';
	}else{
		document.getElementById('backgroundPopup').style.opacity='0.7';
	}
	document.getElementById('backgroundPopup').style.display = 'block';
	document.getElementById('newGenTestDiv').style.display = 'block'
	var divH = parseInt(document.getElementById('newGenTestDiv').style.height);
	var divW = parseInt(document.getElementById('newGenTestDiv').style.width);
	meOnTop = (myHeight-divH)/2
	meOnLeft = (myWidth-divW)/2			
	FloatDiv('newGenTestDiv', meOnLeft, meOnTop).floatIt();
}