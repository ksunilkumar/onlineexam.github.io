// JavaScript Document

var message="Due to security reason, Right Click is not allowed";
function clickIE4(){

			 if (event.button==2){

			 alert(message);

			 return false;

			 }

}

function clickNS4(e){

			 if (document.layers||document.getElementById&&!document.all){

							if (e.which==2||e.which==3){

										  alert(message);

										  return false;

							}

			 }

}

if (document.layers){

			 document.captureEvents(Event.MOUSEDOWN);

			 document.onmousedown=clickNS4;

}

else if (document.all&&!document.getElementById){

			 document.onmousedown=clickIE4;

}

document.oncontextmenu=new Function("alert(message);return false;")

function ajaxCode(url, divName)
{
	// alert(url);
	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4)
		{
			myValue = xmlhttp.responseText;

		//	alert(myValue);

			if(myValue!='' && document.getElementById(divName))
				document.getElementById(divName).innerHTML = myValue;
			if(document.getElementById('comingDiv'))
				document.getElementById('comingDiv').style.display = 'none';				
			ajaxLoadStatus = 0;
		}
		else
		{
			if(document.getElementById('comingDiv'))
				document.getElementById('comingDiv').style.display = 'block';
		}
	}	
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);
}
