<?php 
session_start();
include_once '../../../lib/functions.php';
include_once '../../../lib/db.php';
include_once '../../../lib/functions_admin.php';
$objSql1 = new SqlClass();
$state=new state();
$country=new country();
$country=new country();
$objSql1 = new SqlClass();
//admin_login_check();
//$blog = new Blog();
//$user = new User();
//echo $sql;

	if(isset($_REQUEST['exprt']) && !empty($_REQUEST['exprt']))
	{
	
		$val = explode(',', $_REQUEST['exprt']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			$sql = "SELECT * FROM ise_state WHERE stat_id='".$val[$i]."' ";
			$users=$objSql1->executeSql($sql);
		}
	}
    else
	{
		$sql = "SELECT * FROM ise_state ";
		$users=$objSql1->executeSql($sql);
	}	

	if(is_array($users))
		{
		
				$filename ="state_report".time().".doc";
				$title = "";
				$contents="<table align='center' border=1 width='50%' bordercolor='black' style='font-family:verdana; font-size:11px;'>
				<tr bgcolor='#72ACF3'><td colspan='2' height='30' align='center' style='font-size:14px;'><b>".Site_Title."</b></td></tr>
				<tr  bgcolor='#72ACF3'>
				<td width=50%>Search Criteria: State</td> 
				<td width=50%> Total Records: ".count($users)."</td></tr>
				<tr><td align='center' style='color:#336699; font-size:16px;'><strong>State</strong></td><td align='center' style='color:#336699; font-size:16px;'><strong>Country</strong></td></tr>";
				
				for($i=0;$i<count($users);$i++)
				{
					if($i%2==0)
						$bgcolor=' background-color:#FFFFFF;';
					else
						$bgcolor=' background-color:#F4FCFF;';
						$y=$country->country_select_one($users[$i]['country_id']);
					$contents.= "
					
					<tr style='font-family:verdana; font-size:11px; ".$bgcolor." '><td >".ucfirst($users[$i]['stat_name'])." </td>
					<td align=left>".ucfirst($y[0]['country_name'])."</td>
					</tr>
					 ";
				}	
					$contents.= "
				
					<tr><td colspan='2'>&nbsp;</td></tr>";
				
				$contents.="</table>";

				$fp  =  fopen("../exports/".$filename,  'w+'); 
				$str  =  $contents; 
				fwrite($fp,  $str); 
				fclose($fp);

			print '<form action="state_index.php" method="post" name="download_form">
			  <input type="text" name="filename" id="filename" value="'.$filename.'" style="border:none; color:white;" />
			</form>';
			print("<script>");
			print("document.download_form.submit();");
			print("</script>");

		}
		
		else
		{
			print("<script>");
			print("alert('No Records Found');");
			print("self.location='state_index.php'");
			print("</script>");
		}
?>