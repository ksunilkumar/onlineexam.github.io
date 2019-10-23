function call(x)
{
	var xml=createrequest();
//alert(x);
	
school=document.getElementById("school").value;
if(x==11)
{
	xml.open('GET','../cur.php?school='+school,'true');
	//alert('../cur.php?school='+school);
}
if(x==1)
{
	var yb=document.getElementById("cur").value;
	y=document.getElementById("sub").value;
	
//	alert(y);
	xml.open('GET','../cr_sub.php?na='+y+'&cur='+yb+'&school='+school,'true');
//xml.open('GET','cr_sub.php?na='+y,'true');
}
else if(x==10)
{
y=document.getElementById("cur").value;

xml.open('GET','../sub.php?na='+y+'&school='+school,'true');
}

//alert('hi');
        //xml.open('GET','cr.php?na='+y,'true');
		xml.send(null);
		
        xml.onreadystatechange=function()
        {
           	if(xml.readyState==4)
       	    {
                
				var res=xml.responseText;
				
							if(x==1)
				document.getElementById('grade12').innerHTML=res;
			
				if(x==10)
				document.getElementById('subject').innerHTML=res;
				if(x==11)
				document.getElementById('cur1').innerHTML=res;
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