// JavaScript Document
// JavaScript Document
function call(x)
{
	var xml=createrequest();
yb=document.getElementById("cur").value;
if(x==10)
{
	y=document.getElementById("cur").value;
xml.open('GET','../sub.php?na='+y,'true');
}
else if(x==1)
{
	y=document.getElementById("sub").value;
	xml.open('GET','../cr_sub.php?na='+y+'& cur='+yb,'true');
	//xml.open('GET','cr_sub.php?na='+y,'true');
}
else if(x==2)
{
y=document.getElementById("grade").value;
xml.open('GET','../cr_grade.php?na='+y,'true');
}
else if(x==3)
{
y=document.getElementById("chapterno").value;
xml.open('GET','../cr_chap.php?na='+y,'true');
}
else if(x==4)
{

y=document.getElementById("chno").value;

xml.open('GET','../cr_chap.php?na='+y,'true');
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
			if(x==2)
				document.getElementById('chap').innerHTML=res;
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