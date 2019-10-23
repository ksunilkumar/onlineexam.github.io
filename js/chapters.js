// JavaScript Document
function call(x)
{
	var xml=createrequest();
//alert(x);
if(x==1)
{
	y=document.getElementById("cur").value;
xml.open('GET','ajxgrade.php?na='+y,'true');
}
else if(x==2)
{
y=document.ff.grade.value;
//document.getElementById("cid1").value=y;
//alert(y);
xml.open('GET','ajxchap.php?na='+y,'true');
}
else if(x==3)
{
	
y=document.getElementById("chapterno").value;

xml.open('GET','ajxcur.php?na='+y,'true');
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