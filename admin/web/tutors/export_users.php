<?php 
	session_start();
	include_once '../../lib/functions.php';
	include_once '../../lib/db.php';
	$objSql1 = new SqlClass();
	admin_login_check();
	$user = new User();
	$al=".";
	if(!empty($_REQUEST['al']))
	{
		$al = $_REQUEST['al'];
	}
	$totalEntries=$user->totalNoOfUsers($al);
	$maxPages=ceil($totalEntries/perPage());
	$page=1;
	if(!empty($_REQUEST['pageNumber'])){
		$page=$_REQUEST['pageNumber'];
	}
	$order=0;
	if(!empty($_REQUEST['order'])){
		$order=$_REQUEST['order'];
	}
	$rec = $user->display_users($page,$al,$order);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">

<link href="../images/style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../../script/calendar.js"></script>
<script language="javascript" src="../../script/datetimepicker.js"></script>
<script language="javascript">
	function showPage(pageNumber)
	{
		document.getElementById("pageNumber").value=pageNumber;
		document.getElementById("pageSelectionForm").submit();
		return true;
	}
	function CheckAll(chk)
	{
	   //alert("hi");
	   var num=document.users.elements.length;
	   for(i=0;i<num;i++)
	   {
			tmp=document.users.elements[i];
			//alert(document.packages.elements[i].name);
			if(tmp.type=="checkbox" && !(tmp.name=="allChk"))
			{
				tmp.checked=chk.checked;
			}
		}
	}
	function send_select()
	{
		//alert("hi send");
		dml1=document.users;
		len1 = dml1.elements.length;
		var j=0;
		var value12='send';
		select_status=0;
		for( j=0 ; j<len1 ; j++)
		 {
			if (dml1.elements[j].name=='Mid[]')
			 {
				if((dml1.elements[j].checked))
				{
					select_status=1;
					value12=value12+","+dml1.elements[j].id;
				}
			}
		}
		if(select_status==0)
		{
			alert("Select atleast one record");
			return false;
		}
		//alert("alert");
		document.users.send.value=value12;
		document.users.submit();
		return true;
	}
	function doselect1()
	{
		dml1=document.users;
		len1 = dml1.elements.length;
		var j=0;
		var val12='delet';
		select_status=0;
		for( j=0 ; j<len1 ; j++)
		 {
			if (dml1.elements[j].name=='Mid[]')
			 {
					if((dml1.elements[j].checked))
					{
					select_status=1;
					val12=val12+","+dml1.elements[j].id;
					}
			}
		}
		if(select_status==0)
		{
			alert("Select atleast one record");
			return false;
		}
		if(!confirm('Are you sure you want to delete the records?\n- to Delete the records, hit OK\n- otherwise, hit Cancel'))
			return false;
			//alert("alert12");
		document.users.delet.value=val12;
		document.users.submit();
		return true;
	}
	function show(div)
	{
		document.getElementById('alpha').style.visibility="hidden";
		document.getElementById('email').style.visibility="hidden";
		document.getElementById('course').style.visibility="hidden";
		document.getElementById('country').style.visibility="hidden";
		document.getElementById('date').style.visibility="hidden";
	
		document.getElementById(div).style.visibility="visible";
	}

function export1(type)
	{
		// alert(type);
		
		select_status=0;
		
		dml1=document.getElementById(type+'Form');
		
		if(type=='country')
		{
			var val=dml1.country.value;
			if(val=='')
			{
				select_status=1;
				var msg="Please Select Country";
			}
		}
		else if(type=='course')
		{
			var val=dml1.course.value;
			if(val=='')
			{
				select_status=1;
				var msg="Please Select Course";
			}
			
		}
		else if(type=='dt')
		{
			var frm_dt=dml1.frm_date.value;
			var to_dt=dml1.to_date.value;
			
			if(frm_dt=='' || to_dt=='')
			{
				select_status=1;
				var msg="Please Select Dates";
			}
			else
			{
					var x=frm_dt.split("/");     
					var y=to_dt.split("/");
					var date1=new Date(x[2],(x[1]-1),x[0]);
					var date2=new Date(y[2],(y[1]-1),y[0])
					if(date1>date2)
					{
						select_status=1;
						var msg="to Date should be equal or greaterthan the From Date";
					}
			}
		}
		
		if(select_status==0)
		{
			 if(!confirm('Sure you want to download the report?\n- to Download Report, hit OK\n- otherwise, hit Cancel'))
				return false;
			else
			 dml1.submit();

		}
		else
		{
			alert(msg);
			return false;
		}
	}
	
</script>
</head>
<body>
	<form name="pageSelectionForm" id="pageSelectionForm" method="post" action="index.php">
		<input type="hidden" id="pageNumber" name="pageNumber"/>
        <input type="hidden" id="al" name="al" value="<?php echo $al;?>"/>
		<input type="hidden" id="order" name="order" value="<?php echo $order;?>"/>
	</form>
	<?php include"../header.php";?>
	<table width="90%" align="center" border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td width="22"><img src="../images/titlesleft.gif"></td>
				<td valign="top" background="../images/titlesbg.gif">
					<table style="padding-left: 1px;" width="100%" border="0" cellpadding="0" cellspacing="0">
						<tbody>
							<tr><td class="titles">&nbsp;</td></tr>
							<tr><td height="10"></td></tr>
							<tr><td class="pages">Manage Admins</td></tr>
						</tbody>
					</table>
				</td>
				<td align="right"><img src="../images/titlesright.gif"></td>
			</tr>
			<tr>
				<td width="22" background="../images/pageleftshadow.gif"><img src="../images/pageleftshadow.gif" width="22" height="1"></td>
				<td valign="top">
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tbody>
							<tr>
								<td class="navbg" style="padding-left: 1px;" valign="top" width="248" height="200">
								<?php include 'left.php'; ?>
									<table width="236" border="0" cellpadding="0" cellspacing="0">
										<tbody>
											<tr>	
												<td><img src="../images/navbottom.gif"></td>
											</tr>
										</tbody>
									</table><br><br>
								</td>
								<td style="padding-left: 16px;" valign="top" height="300">
                               
									<table width="100%">
<tr>
												<td width="15%"><div align="center"><a href="#" onclick="show('alpha')">By Alpahbets</a></div></td>
												<td width="10%"><div align="center"><a href="#" onclick="show('email')">By Email</a></div></td>
												<td width="15%"><div align="center"><a href="#" onclick="show('country')">By Country</a></div></td>
												<td width="15%"><div align="center"><a href="#" onclick="show('course')">By Courses</a></div></td>
												
												
                                                <td width="15%" align="center"><div align="center"><a href="#" onclick="show('date')">By Date</a></div></td>
                                                
											</tr></table>
                                     <table width="100%">
                                     	<tr><td colspan="5">
                                        <div id="alpha" style="visibility:hidden">
                                        <form action="extract_by_alpha.php" name="alphaForm" id="alphaForm" method="post">
                                        Alphabetical Order: 
                                        <select name="alpha">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="F">F</option>
                                        <option value="G">G</option>
                                        <option value="H">H</option>
                                        <option value="I">I</option>
                                        <option value="J">J</option>
                                        <option value="K">K</option>
                                        <option value="L">L</option>
                                        <option value="M">M</option>
                                        <option value="N">N</option>
                                        <option value="O">O</option>
                                        <option value="P">P</option>
                                        <option value="Q">Q</option>
                                        <option value="R">R</option>
                                        <option value="S">S</option>
                                        <option value="T">T</option>
                                        <option value="U">U</option>
                                        <option value="V">V</option>
                                        <option value="W">W</option>
                                        <option value="X">X</option>
                                        <option value="Y">Y</option>
                                        <option value="Z">Z</option>
                                        </select>
                                        
                                         &nbsp;&nbsp;
                                        <input name="Button" type="button" onclick="export1('alpha'); return false;" value="download" />
                                        </form> 
                                        </div>
                                        <div id="email" style="visibility:hidden">
                                        <form action="extract_by_email.php"  name="mailForm" id="mailForm" method="post">
                                        E-mail: 
                                        <select name="mail"><option value="gmail.com">GMAIL</option><option value="yahoo.com">YAHOO</option></select> &nbsp;&nbsp;
                                        <input name="Button" type="button" onclick="export1('mail'); return false;" value="download" />
                                        </form>
                                        </div>
                                        <div id="country" style="visibility:hidden">
                                        <form action="extract_by_country.php" name="countryForm" id="countryForm" method="post">
                                   Country:<?php
                                                $sql="select country_id,country_name from enm_country where status='active'";
												//echo $sql;
                                                $country=$objSql1->executeSql($sql);
                                                 echo "<select name='country' width='30'>";
                                                 echo "<option value=''>Select</option>";
                                                 for($i=0;$i<count($country);$i++)
                                                 {
                                                        echo "<option value='".$country[$i]['country_id']."'>".$country[$i]['country_name']."</option>";
                                                  }
                                                  echo "</select>";
                                               ?> &nbsp;&nbsp; <input name="Button" type="button" onclick="export1('country'); return false;" value="download" />
                                               </form></div>
                                        <div id="course" style="visibility:hidden">
                                        <form action="extract_by_course.php"  name="courseForm" id="courseForm" method="post">
                                        Course: <?php
											$sql="select course_id,course_name from enm_course where status='active'";
											$courses=$objSql1->executeSql($sql);
											$sql="select course_id,course_name from enm_tlcourse where status='active'";
											$courses=$objSql1->executeSql($sql);
											echo "<select name='course' width='30'>";
											echo "<option value=''>Select</option>";
											for($i=0;$i<count($courses);$i++)
											{
												if($courses[$i]['course_name']!="")
												echo "<option value='".$courses[$i]['course_id']."'>".$courses[$i]['course_name']."</option>";
											}
											echo "</select>";
							

										?>
                                        <input name="Button" type="button" onclick="export1('course'); return false;" value="download"/>
                                        </form>
                                        </div>
                                        <div id="date" style="visibility:hidden">
                                        <form action="extract_by_reg_date.php" name="dtForm" id="dtForm" method="post">
                                        <b>From</b>&nbsp;&nbsp;  <input type="text" class="none" name="frm_date" id="frm_date" size="25" value="<?php if(!empty($_POST)){echo $_POST['txtdob'];}?>" readonly="readonly"  />
                                        <a href="javascript:NewCssCal('frm_date','yyyymmdd')">
                                                                                     <!--   <img src="images/calendar.jpg" alt="calendar" border="0" /></a>
                                                                                                            <a href="#" onclick="cal.select(document.forms['login_form'].txtdob,'dob','MM-dd-yyyy'); return false;" name="dob" id="dob">--><img src="../../images/calendar.jpg" border="0" width="16" height="16"/></a>&nbsp;&nbsp;&nbsp;
                               <b>To</b>&nbsp;&nbsp; <input type="text" class="none" name="to_date" id="to_date" size="25" value="<?php if(!empty($_POST)){echo $_POST['txtdob'];}?>" readonly="readonly" />
                                                     <a href="javascript:NewCssCal('to_date','yyyymmdd')">
                                                                                                  <!--   <img src="images/calendar.jpg" alt="calendar" border="0" /></a>
                                                                                                            <a href="#" onclick="cal.select(document.forms['login_form'].txtdob,'dob','MM-dd-yyyy'); return false;" name="dob" id="dob">--><img src="../../images/calendar.jpg" border="0" width="16" height="16"/></a> &nbsp;&nbsp;&nbsp;<input name="Button" type="button" onclick="export1('dt'); return false;" value="download" />
                                        </form>
                                        </div>
                                        
                                        </td></tr>
                                     </table>
							  </td>
							</tr>
						</tbody>
					</table>
					
				</td>
				<td width="27" background="../images/pagerightshadow.gif"><img src="../images/rightshadow.htm" width="27" height="1"></td>
			</tr>
		</tbody>
	</table>
	<?php include '../footer.php';?><br><br>
</body>
</html>