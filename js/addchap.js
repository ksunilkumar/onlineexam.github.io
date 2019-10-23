// JavaScript Document
// JavaScript Document
function call(x)
{
	var xml=createrequest();
	//alert(x);
	yb=document.getElementById("cur").value;
//alert(yb);
	school=document.getElementById("school").value;

	if(x==11)
	{
		xml.open('GET','../cur.php?school='+school,'true');
	}
	
	if(x==10)
	{
		y=document.getElementById("cur").value;
		
		xml.open('GET','../sub.php?na='+y+'&school='+school,'true');
	}
	else if(x==1)
	{
		y=document.getElementById("sub").value;
		
		xml.open('GET','../cr_sub.php?na='+y+'&cur='+yb+'&school='+school,'true');
	}
	else if(x==2)
	{
		y=document.getElementById("grade").value;
		xml.open('GET','../grade_curri.php?na='+y,'true');
	}
	else if(x==4)
	{
		y=document.getElementById("chno").value;
		xml.open('GET','../penchapters.php?na='+y+'&cur='+yb,'true');
	}
	

        //xml.open('GET','cr.php?na='+y,'true');
		xml.send(null);
		
        xml.onreadystatechange=function()
        {
           	if(xml.readyState==4)
       	    {
                
				var res=xml.responseText;
				if(x==11)
				document.getElementById('cur1').innerHTML=res;
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