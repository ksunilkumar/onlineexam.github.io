// JavaScript Document
var xmlhttp;
var errmsg = '';
var chklnmsg = '';


	function sub_form(val)
	{		
		document.getElementById('subject_id').value = val;
		document.mng_ques.submit();
	}
	function load_school(str)
	{		
		xmlhttp=GetXmlHttpObject();
		if (xmlhttp==null)
		  {
			  alert ("Browser does not support HTTP Request");
			  return;
		  }
		var url="get_grade.php";
		url=url+"?school="+str;
		xmlhttp.onreadystatechange=stateChan;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
	}
	function stateChan()
	{
		if (xmlhttp.readyState==4)
		{			
			document.getElementById("grade_div").innerHTML=xmlhttp.responseText;
			errmsg = xmlhttp.responseText;
		}
	}
	function load_grade(str)
	{		
		xmlhttp=GetXmlHttpObject();
		if (xmlhttp==null)
		  {
			  alert ("Browser does not support HTTP Request");
			  return;
		  }
		document.getElementById('grade_id').value = str;
		school=document.getElementById('school').value
		var url="get_cur.php";
		url=url+"?un="+str+"&school="+school;
		//alert(url);
		xmlhttp.onreadystatechange=stateChanged;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
	}
	function stateChanged()
	{
		if (xmlhttp.readyState==4)
		{			
			document.getElementById("curr_div").innerHTML=xmlhttp.responseText;
			errmsg = xmlhttp.responseText;
		}
	}
	function GetXmlHttpObject()
	{
		if (window.XMLHttpRequest)
		{
		  return new XMLHttpRequest();
		}
		if (window.ActiveXObject)
		{
		  return new ActiveXObject("Microsoft.XMLHTTP");
	    }
		return null;
	}
	
	
	
	function load_sub(str)
	{		
		document.getElementById('cur_id').value = str;
		var un=document.getElementById('grade').value;
		
		//alert(un);
		xmlhttp=GetXmlHttpObject();
		if (xmlhttp==null)
		  {
			  alert ("Browser does not support HTTP Request");
			  return;
		  }
		var url="get_sub.php";
		url=url+"?un="+un;
		cu = document.getElementById('sel_curr').value;
		url=url+"&cu="+cu;
		xmlhttp.onreadystatechange=stateChang;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
	}
	function stateChang()
	{
		if (xmlhttp.readyState==4)
		{			
			document.getElementById("sbjt_div").innerHTML=xmlhttp.responseText;
			//alert(xmlhttp.responseText);
		}
	}
	