// JavaScript Document
function show(user,msg)
{
	
	var xml=createrequest();
	var y=document.getElementById("student").value;
	
//document.getElementById("user").value=y;
	xml.open('GET','showcart.php?na='+y,'true');
		xml.send(null);
		xml.onreadystatechange=function()
        {
           	if(xml.readyState==4)
       	    {
                var res=xml.responseText;
		
			document.getElementById('display').innerHTML=res;
			if(msg=='')
			document.getElementById('divmsg').innerHTML='';
			
			}
		}
	   

}

function show1(urlq,id,val,user)
{
	
	var xml=createrequest();
	url=urlq+'?id='+id+'&val='+val+'&user='+user;
	//alert(url);
	xml.open('GET',url,'true');
		xml.send(null);
		xml.onreadystatechange=function()
        {
           	if(xml.readyState==4)
       	    {
                var res=xml.responseText;
		
			document.getElementById('display').innerHTML=res;
						
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