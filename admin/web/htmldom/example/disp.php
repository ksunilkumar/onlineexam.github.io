<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php 
mysql_connect("localhost","root","")or die("not Connected");
mysql_select_db("questiondb") or die("not selected");
$s="select * from qntab";
$q=mysql_query($s);
while($res=mysql_fetch_object($q))
{
$oo="src='";
$nn="src='media/";
$q2=str_replace($oo,$nn,$res->question);
echo $q2."<br>";
}
?>
</body>
</html>
