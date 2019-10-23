<?php
$quizid=$_REQUEST['quiz'];
$name=$_REQUEST['fname'];
include '../simple_html_dom.php';
$html = file_get_html($name);
mysql_connect("localhost","root","")or die("not Connected");
mysql_select_db("questiondb") or die("not selected");
$st=0;
$i=1;
$res=count($html->find('p'));
while($st<$res)
{
$sec=$html->find('p',$st);
if($st==0)
{
$aec=$sec->innertext;
$section=str_replace('"',"'",$aec);
}
else
{
if($st%2!=0)
{
$qno=$sec->innertext;
}
if($st%2==0)
{
$que=$sec->innertext;
$question=str_replace('"',"'",$que);
$sql="insert into qntab values(".'"'."$section".'"'.",".'"'."$quizid".'","'."$i".'","'."$question".'"'.")";
$q=mysql_query($sql) or die(mysql_error());
$i++;
}
}
$st++;
}
header("location:form.php?opt=1");
?>
