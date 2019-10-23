// JavaScript Document
function call(x)
{
	
	var xml=createrequest();

if(x==10)
{
	y=document.getElementById("cur").value;
xml.open('GET','sub.php?na='+y,'true');
}
else if(x==1)
{
	var jk=document.getElementById("cur").value;
var gh=document.getElementById("sub").value;
y=jk+'~'+gh;
	
	xml.open('GET','cr.php?na='+y,'true');
}
else if(x==2)
{
y=document.getElementById("grade").value;
xml.open('GET','cr5.php?na='+y,'true');
}
else if(x==3)
{
y=document.getElementById("chapterno").value;
xml.open('GET','off1.php?na='+y,'true');
}
else if(x==4)
{

y=document.getElementById("chno").value;
xml.open('GET','off1.php?na='+y,'true');
}

        //xml.open('GET','cr.php?na='+y,'true');
		xml.send(null);
		
        xml.onreadystatechange=function()
        {
           	if(xml.readyState==4)
       	    {
                
				var res=xml.responseText;
				if(x==10)
				document.getElementById('subject').innerHTML=res;
				if(x==1)
					document.getElementById('grade12').innerHTML=res;
			if(x==2){
				
				document.getElementById('chap').innerHTML=res;
			}
				if(x==4)
				document.getElementById('quizi').innerHTML=res;
				
			}
		}
	   

}
function createrequest()
{
	var http=false;
	try
	{
		http=new XMLHttpRequest;
		return http;		
	}
	catch(e)
	{
		try
		{
			http=new ActiveXObject("Microsoft.XMLHTTP");
			return http; 
		}
		catch(e1)
		{
			try
			{
				http=new ActiveXObject("MSXML2.XMLHTTP");
				return http;
			}
			catch(e2)
			{
				alert("HAI");
			
			}
		}

	}
	
}