var formName;
function getForm(frm)
{
	formName = frm
}

function objDisabled(con, stat)
{
	eval("document."+formName+"."+con+".disabled=true;");
	return true;
}


function IsChecked(con, value,msg)
{
	val = (eval("document."+formName+"."+con+".checked"));
	//foc = (eval("document."+formName+"."+con+".focus()"));
	if(val==value)
	{
		return true;
	}
	else
	{
		alert(msg);
		//foc;
		return false;
	}
}


function IsSelect(con, msg)
{
	val = (eval("document."+formName+"."+con+".value"));
	foc = (eval("document."+formName+"."+con+".focus()"));
	if(val==0)
	{
		if ((msg.length)!=0)
		{
			alert(msg);
		}
		foc;
		return false;
	}
	if(val=='')
	{
		if ((msg.length)!=0)
		{
			alert(msg);
		}
		foc;
		return false;
	}
	if(val=='all')
	{
		if ((msg.length)!=0)
		{
			alert(msg);
		}
		foc;
		return false;
	}
	else
	{
		return true;
	}
}
function IsNumber_new(con, msg)
{
	val = (eval("document."+formName+"."+con+".value"));
	foc = (eval("document."+formName+"."+con+".focus()"));
	if(isNaN(val))
	{
		if ((msg.length)!=0)
		{
			alert(msg);
		}
		setval =(eval("document."+formName+"."+con+".value=''"));
		foc;
		return false;
	}
	else
	{
		return true;
	}
}
function IsNumber(con, msg)
{
	val = (eval("document."+formName+"."+con+".value"));
	foc = (eval("document."+formName+"."+con+".focus()"));
	if(!(IsEmpty(con, "")))
	{
		if ((msg.length)!=0)
		{
			alert(msg);
		}
		foc;
		setval =(eval("document."+formName+"."+con+".value=''"));
		return false;
	}
	if(isNaN(val))
	{
		if ((msg.length)!=0)
		{
			alert(msg);
		}
		setval =(eval("document."+formName+"."+con+".value=''"));
		foc;
		return false;
	}
	else
	{
		return true;
	}
}

function IsNumber1(con, msg)
{
	val = (eval("document."+formName+"."+con+".value"));
	foc = (eval("document."+formName+"."+con+".focus()"));
	if(!(IsEmpty1(con, "")))
	{
		if ((msg.length)!=0)
		{
			alert(msg);
		}
		foc;
		setval =(eval("document."+formName+"."+con+".value=''"));
		return false;
	}
	if(isNaN(val))
	{
		if ((msg.length)!=0)
		{
			alert(msg);
		}
		setval =(eval("document."+formName+"."+con+".value=''"));
		foc;
		return false;
	}
	else
	{
		return true;
	}
}

function ChkLength(con, conLen, msg)
{
	val = (eval("document."+formName+"."+con+".value"));
	foc = (eval("document."+formName+"."+con+".focus()"));
	if(val.length<conLen)
	{
		if ((msg.length)!=0)
		{
			alert(msg);
		}
		foc;
		return false;
	}
	return true;
}

function IsEmpty(con, msg)
{
	
	val = (eval("document."+formName+"."+con+".value"));

	foc = (eval("document."+formName+"."+con+".focus()"));
	if(val==0)
	{
		if ((msg.length)!=0)
		{
			alert(msg);
		}
		setval =(eval("document."+formName+"."+con+".value=''"));
		foc;
		return false;
	}
	return true;
}
function IsFurDate(con, msg)
{
	var val = eval("document."+formName+"."+con+".value");
	arr=new Array();
	arr=val.split("-");	
	
	var dt = arr[0]+'/'+arr[1]+'/'+arr[2];

//	alert(dt);

	var myDate= new Date(dt);
// alert(myDate);

var today = new Date();


	if (myDate>today)
	{
	 alert(msg);
	 return false;
	 }
	 else
	 return true;
}

function IsCheckDOB(con, age, msg)
{
	var val = eval("document."+formName+"."+con+".value");
	arr=new Array();
	arr=val.split("-");	
	
	var dt = arr[0]+'/'+arr[1]+'/'+arr[2];

//	alert(dt);

	var myDate= new Date(dt);
// alert(myDate);

var today = new Date();
		today.setFullYear(today.getFullYear()-age);

	if (myDate>today)
	{
	 alert(msg);
	 return false;
	 }
	 else
	 return true;
}

function IsEmpty_img(con1,con2,msg)
{
	
	val1 = (eval("document."+formName+"."+con1+".value"));
	val2 = (eval("document."+formName+"."+con2+".value"));
	
	foc = (eval("document."+formName+"."+con2+".focus()"));
	if((val1=='') && (val2==''))
	{ 
		if ((msg.length)!=0)
		{
			alert(msg);
		}
		setval =(eval("document."+formName+"."+con2+".value=''"));
		foc;
		return false;
	}
	return true;
}
function IsEmpty_n(con, msg, mes_n)
{
	
	val = (eval("document."+formName+"."+con+".value"));

	foc = (eval("document."+formName+"."+con+".focus()"));
	if(val==0)
	{
		setval =(eval("document."+formName+"."+con+".value=''"));
		foc;
		  document.getElementById(con).setAttribute('class', 'test_box');
		  document.getElementById(mes_n).setAttribute('class', 'view');
		return false;
	}
	return true;
}
function IsEmpty_n1(con, msg, mes_n)
{
	val = (eval("document."+formName+"."+con+".value"));
	foc = (eval("document."+formName+"."+con+".focus()"));
	if(val=='')
	{
		foc;
		
		  document.getElementById(mes_n).setAttribute('class', 'view');
		return false;
	}
	return true;
}
function IsEmail_n(con, msg,meg_n)
{
	val = (eval("document."+formName+"."+con+".value"));
	foc = (eval("document."+formName+"."+con+".focus()"));
	if(!(IsEmpty(con, "")))
	{
		foc;
		setval =(eval("document."+formName+"."+con+".value=''"));
		document.getElementById(con).setAttribute('class', 'test_box');
		document.getElementById(meg_n).setAttribute('class', 'view');
		return false;
	}
	var filter=/^.+@.+\..{2,3}$/
	if (filter.test(val))
		return true;
	else
	{
		foc;
		 document.getElementById(con).setAttribute('class', 'test_box');
		 document.getElementById(meg_n).setAttribute('class', 'view');
		return false;
	}
	return true;
}
function IsAlpha_n(con, msg, msg_n)
{
	s = (eval("document."+formName+"."+con+".value"));
	foc = (eval("document."+formName+"."+con+".focus()"));
	if(!(IsEmpty(con, "")))
	{
		foc;
		document.getElementById(con).setAttribute('class', 'test_box');
		document.getElementById(msg_n).setAttribute('class', 'view');
		return false;
	}
		
	var len = s.length;
	for(var i=0;i<len;i++)
	{
		if(((s.charCodeAt(i)>=65)&(s.charCodeAt(i)<=90))|((s.charCodeAt(i)>=97)&(s.charCodeAt(i)<=122))|(s.charCodeAt(i)==32))
		{
			continue;	
		}
		else
		{
		 document.getElementById(con).setAttribute('class', 'test_box');
		 document.getElementById(msg_n).setAttribute('class', 'view');
			return false;
		}
	}
	return true;
}
function ChkLength_n(con, conLen, msg,msg_n)
{
	val = (eval("document."+formName+"."+con+".value"));
	foc = (eval("document."+formName+"."+con+".focus()"));
	if(val.length<conLen)
	{
		foc;
		document.getElementById(con).setAttribute('class', 'test_box');
		document.getElementById(msg_n).setAttribute('class', 'view');
		return false;
	}
	return true;
}
function IsSame_n(con1,pass,con2,cpass,msg_n)
{
	val1 = (eval("document."+formName+"."+con1+".value"));
	foc1 = (eval("document."+formName+"."+con1+".focus()"));
	val2 = (eval("document."+formName+"."+con2+".value"));
	foc2 = (eval("document."+formName+"."+con2+".focus()"));
	if(val1!=val2)
	{
		(eval("document."+formName+"."+con1+".focus()"));
		
		document.getElementById(pass).setAttribute('class', 'hidden');
		document.getElementById(cpass).setAttribute('class', 'hidden');
		document.getElementById(con1).setAttribute('class', 'test_box');
		document.getElementById(con2).setAttribute('class', 'test_box');
		document.getElementById(msg_n).setAttribute('class', 'view');
		return false;
	}
	return true;
}
function IsNumber_n(con,msg,msg_n)
{

	val = (eval("document."+formName+"."+con+".value"));
	foc = (eval("document."+formName+"."+con+".focus()"));
	
	if(isNaN(val))
	{
		foc;
		document.getElementById(con).setAttribute('class', 'test_box');
		document.getElementById(msg_n).setAttribute('class', 'view');
		return false;
	}else
	{
		return true;
	}
	
}

function IsEmpty1(con, msg)
{
	
	val = (eval("document."+formName+"."+con+".value"));

	foc = (eval("document."+formName+"."+con+".focus()"));
	if(val=="")
	{
		if ((msg.length)!=0)
		{
			alert(msg);
		}
		setval =(eval("document."+formName+"."+con+".value=''"));
		foc;
		return false;
	}
	return true;
}

function IsSame(con1,con2, msg)
{
	val1 = (eval("document."+formName+"."+con1+".value"));
	foc1 = (eval("document."+formName+"."+con1+".focus()"));
	val2 = (eval("document."+formName+"."+con2+".value"));
	foc2 = (eval("document."+formName+"."+con2+".focus()"));
	if(!(IsEmpty(con1, "")))
	{
		if ((msg.length)!=0)
		{
			alert(msg);
		}
		foc;
		return false;
	}
	if(!IsEmpty(con2, ""))
	{
		if ((msg.length)!=0)
		{
			alert(msg);
		}
		foc;
		return false;
	}

	if(val1!=val2)
	{
		if ((msg.length)!=0)
		{
			alert(msg);
		}
		(eval("document."+formName+"."+con1+".focus()"));
		return false;
	}
	return true;
}

function IsEmail(con, msg)
{
	val = (eval("document."+formName+"."+con+".value"));
	foc = (eval("document."+formName+"."+con+".focus()"));
	if(!(IsEmpty(con, "")))
	{
		if ((msg.length)!=0)
		{
			alert(msg);
		}
		foc;
		setval =(eval("document."+formName+"."+con+".value=''"));
		return false;
	}
	var filter=/^.+@.+\..{2,3}$/
	if (filter.test(val))
		return true;
	else
	{
		if ((msg.length)!=0)
		{
			alert(msg);
		}
		return false;
	}
	return true;
}
function IsEmail_new(con)
{
	val = (eval("document."+formName+"."+con+".value"));
	var filter=/^.+@.+\..{2,3}$/
	if (filter.test(val))
		return true;
	else
	{
		foc = (eval("document."+formName+"."+con+".focus()"));
		color = (eval("document."+formName+"."+con+".class='test_box'"));
		alert(color);
		return false;
	}
	return true;
}

function IsAlpha(con, msg)
{
	s = (eval("document."+formName+"."+con+".value"));
	foc = (eval("document."+formName+"."+con+".focus()"));
	if(!(IsEmpty(con, "")))
	{
		if ((msg.length)!=0)
		{
			alert(msg);
		}
		foc;
		return false;
	}
		
	var len = s.length;
	for(var i=0;i<len;i++)
	{
		if(((s.charCodeAt(i)>=65)&(s.charCodeAt(i)<=90))|((s.charCodeAt(i)>=97)&(s.charCodeAt(i)<=122))|(s.charCodeAt(i)==32))
		{
			continue;	
		}
		else
		{
		if ((msg.length)!=0)
		{
			alert(msg);
		}
			return false;
		}
	}
	return true;
}

function IsPhone(con, msg)
{
	s = (eval("document."+formName+"."+con+".value"));
	foc = (eval("document."+formName+"."+con+".focus()"));
	var counth = 0;
	var counts = 0;
	var len = s.length;
	for(var i=0;i<len;i++)
	{
		if((s.charCodeAt(i)==45)|(s.charCodeAt(i)==32)|((s.charCodeAt(i)>=48)&(s.charCodeAt(i)<=57)))
		{
			continue;	
		}
		else
		{
		if ((msg.length)!=0)
			{
				alert(msg);
			}
			foc;
			return false;
		}
	}
	for(var i=0;i<len;i++)
	{
		if(s.charCodeAt(i)==45)
			counth = counth + 1;
		if(s.charCodeAt(i)==32)
			counth = counts + 1;
	}			
	if((counth>1)|(counts>1))
		return true;
	else
		{
		if ((msg.length)!=0)
			{
				alert(msg);
			foc;
			return false;
			}
		}
}


function NoSpaces(con, msg)
{
	s = (eval("document."+formName+"."+con+".value"));
	foc = (eval("document."+formName+"."+con+".focus()"));
	if(!(IsEmpty(con, "")))
	{
		if ((msg.length)!=0)
		{
			alert(msg);
		}
		foc;
		return false;
	}
		
	var len = s.length;
	for(var i=0;i<len;i++)
	{
		if(((s.charCodeAt(i)>=65)&(s.charCodeAt(i)<=90))|((s.charCodeAt(i)>=97)&(s.charCodeAt(i)<=122))|((s.charCodeAt(i)>=48)&(s.charCodeAt(i)<=57))|(s.charCodeAt(i)==95))
		{
			continue;	
		}
		else
		{
		if ((msg.length)!=0)
		{
			alert(msg);
		}
		foc;
		return false;
		}
	}
	return true;
}


function IsDate(con, msg)
{
	s = (eval("document."+formName+"."+con+".value"));
	foc = (eval("document."+formName+"."+con+".focus()"));
	if(!(IsEmpty(con, "")))
	{
		if ((msg.length)!=0)
		{
			alert(msg);
		}
		foc;
		setval =(eval("document."+formName+"."+con+".value=''"));
		return false;
	}
	var pos=s.indexOf('-');
	if (pos!=-1)
	{
		var jdate=s.substring(0, pos);
		s=s.substring(pos+1, s.length);
		pos=s.indexOf('-');
		if (pos!=-1)
		{
			var jmonth=s.substring(0,pos);
			if (jmonth>12)
			{
				if ((msg.length)!=0)
				{
					alert(msg);
				}
				foc;
				setval =(eval("document."+formName+"."+con+".value=''"));
				return false;
			}
			s=s.substring(pos+1, s.length);
			pos=s.indexOf('-');
			if (pos!=-1)
			{
				if ((msg.length)!=0)
				{
					alert(msg);
				}
				foc;
				setval =(eval("document."+formName+"."+con+".value=''"));
				return false;
			}
			jyear=s;
			if(jyear<1960)
			{
				if ((msg.length)!=0)
				{
					alert(msg);
				}
				foc;
				setval =(eval("document."+formName+"."+con+".value=''"));
				return false;
			}			
			switch(jmonth)
			{
				case '4':
				case '6':
				case '9':
				case '11':
					nodays=30;
					break;
				case '2':
					if(jyear%4==0)
						nodays=29;
				else
					nodays=28;
					break;
				default :
					nodays=31;
			}
			if(jdate>nodays)
			{
				if ((msg.length)!=0)
				{
					alert(msg);
				}
				foc;
				setval =(eval("document."+formName+"."+con+".value=''"));
				return false;
			}
		return true;
		}
	}
	if ((msg.length)!=0)
	{
		alert(msg);
	}
	foc;
	setval =(eval("document."+formName+"."+con+".value=''"));
	return false;
}


function FillCountry(cboCountry, cboState, sDefaultCountry)
{
	var sDefaultCountry, sDefault, sCountry
	var selectOption = -1;

	cboCountry.options.length=0
	for(i=0;i<sCountryString.split("|").length;i++)
	{
		sCountry = sCountryString.split("|")[i];

		if (sDefaultCountry == sCountry)
		{
			sDefault=true;
			if (navigator.appName=="Microsoft Internet Explorer"){cboState.focus();}
		}
		else
		{
			sDefault=false;
		}

		if (sDefault)
		{
			var oo = new Option(sCountry,sCountry,sDefault,sDefault);
			oo.setAttribute("selected", "true");
			cboCountry.options[i] = oo;
			selectOption = i;
		}
		else
		{
			cboCountry.options[i]=new Option(sCountryString.split("|")[i]);
		}
	}
	if (selectOption > -1)
	{
		cboCountry.selectedIndex = selectOption;
	}

}
if (navigator.appName=="Netscape")
{
    isNav=true
}


function FillState(cboCountry, cboState, sDefaultState)
{
	var sDefaultState, sState, sDefault
	var selectOption = -1;

	cboState.options.length=0
	for(i=0;i<sStateArray[cboCountry.selectedIndex].split("|").length;i++)
	{
		sState = sStateArray[cboCountry.selectedIndex].split("|")[i];

		if(sDefaultState == sState)
		{
			sDefault=true;
			selectOption = i;
			if (navigator.appName=="Microsoft Internet Explorer"){cboState.focus();}
		}
		else
		{
			sDefault=false;
		}

		if(sDefault)
		{
			var oo = new Option(sState,sState,sDefault,sDefault);
			oo.setAttribute("selected", "true");
			cboState.options[i] = oo;	
		}
		else {cboState.options[i]=new Option(sState,sState);}
	}
	if (selectOption > -1)
	{
		cboState.selectedIndex = selectOption;
	}
}
function IsPhone_new(con,conLen, msg){
val = (eval("document."+formName+"."+con+".value"));
foc = (eval("document."+formName+"."+con+".focus()"));
	
		if(isNaN(val))
		 { 
		
			if ((msg.length)!=0)
			{
				alert(msg);
			}
			setval =(eval("document."+formName+"."+con+".value=''"));
			foc;
			return false;
		}
		else
		{
				if(val.length<conLen)
				{ 
					if ((msg.length)!=0)
						{
							alert(msg);
						}
						//setval =(eval("document."+formName+"."+con+".value=''"));
						foc;
						
					return false;
				}
				else
				  return true;
		}
	

}