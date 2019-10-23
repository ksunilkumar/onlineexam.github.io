$con=mysql_connect("localhost","root","");
if(!$con)
{
	die('could not connect'.mysql_error());
}
mysql_select_db("questiondb",$con);
//mysql_select_db("my_db", $con);
$sql = "CREATE TABLE qntab(secmark varchar(3),qno varchar(5),question text,options text";
mysql_query($sql,$con);
if(mysql_query("INSERT INTO qntab VALUES('$ret1','$j','$ret3','$ret4')"))
{
	mysql_close($con);
}
