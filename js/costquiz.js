// JavaScript Document
// JavaScript Document
// JavaScript Document
function call(x)
{
	var xml=createrequest();
	//alert(x);
	var yb=document.getElementById("cur").value;
if(x==1)
{
	y=document.getElementById("sub").value;
	xml.open('GET','../cr_sub.php?na='+y+'&cur='+yb,'true');
//xml.open('GET','cr_sub.php?na='+y,'true');
}
else if(x==15)
{

	y=document.getElementById("cur").value;

xml.open('GET','../sub.php?na='+y,'true');
}
else if(x==2)
{
y=document.getElementById("grade").value;
xml.open('GET','../cr_grade.php?na='+y,'true');
}
else if(x==3)
{
y=document.getElementById("chapterno").value;
xml.open('GET','../ajxcur.php?na='+y,'true');
}
else if(x==4)
{
y=document.getElementById("chno").value;
alert(y);
xml.open('GET','../off1.php?na='+y,'true');
}

        //xml.open('GET','cr.php?na='+y,'true');
		xml.send(null);
		
        xml.onreadystatechange=function()
        {
           	if(xml.readyState==4)
       	    {
                
				var res=xml.responseText;
							if(x==1)
				document.getElementById('grade12').innerHTML=res;
			if(x==2)
				document.getElementById('chap').innerHTML=res;
				if(x==4)
				{
				document.getElementById('quiz').innerHTML=res;
				}
				if(x==15)
				document.getElementById('sub1').innerHTML=res;
				
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