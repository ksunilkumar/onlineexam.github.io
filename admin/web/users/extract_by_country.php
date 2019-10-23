<?php
session_start();
include_once '../../lib/functions.php';
include_once '../../lib/db.php';
$objSql1 = new SqlClass();
admin_login_check();
$sql="select enm_user.user_fname,enm_user.user_lname,enm_user.user_email,enm_user.user_gender,enm_user.mobile_no,enm_country.country_name from enm_user,enm_country where enm_country.country_id =".$_REQUEST['country']." and enm_user.country=enm_country.country_id and enm_user.status='active'";
//echo $sql;
$users=$objSql1->executeSql($sql);

if(is_array($users))
{

$filename ="users_report_byCountry".time().".doc";
$title = "";
$contents="<table align='center' border=1 width='100%' bordercolor='black' style='font-family:verdana; font-size:11px;'>
<tr bgcolor='#72ACF3'><td colspan='5' height='30' align='center' style='font-size:14px;'><b>Robotutor</b></td></tr>
<tr bgcolor='#72ACF3'><td>Search Criteria: Users</td> <td colspan='4'>Total Records: ".count($users)."</td></tr>
<tr bgcolor='#CCCCCC'><td>Name </td><td> Email</td><td> Gender </td><td> Mobile </td><td>Country </td></tr>";
for($i=0;$i<count($users);$i++)
{
	$contents.= "<tr><td>".ucfirst($users[$i]['user_fname'])." ".ucfirst($users[$i]['user_lname'])." </td><td>".$users[$i]['user_email']." </td><td>".ucfirst($users[$i]['user_gender'])." </td><td>".$users[$i]['mobile_no']." </td><td>".ucfirst($users[$i]['country_name'])."</td></tr>";
}
$contents.="</table>";
header('Content-type: application/vnd.ms-word');

header('Content-Disposition: attachment; filename='.$filename);
echo $title;
echo $contents;

/*print("<script>");
print("alert('No Records Found');");
print("self.location='export_users.php'");
print("</script>");*/
}
else
{
	print("<script>");
	print("alert('No Records Found');");
	print("self.location='export_users.php'");
	print("</script>");
}

?>
