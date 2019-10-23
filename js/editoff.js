// JavaScript Document
function show()
{
	var xml=createrequest();
	var y=document.getElementById("student").value;

	xml.open('GET','show.php?na='+y,'true');
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