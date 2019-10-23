<?php
include 'config.php';
$couid=$_REQUEST['cid'];
$grade=$_REQUEST['grade'];
$chap=$_REQUEST['chno'];
$chapid=$_REQUEST['id'];
$qfname=$_POST['qname'];
$qsname=$_POST['qsname'];
$qid=$_POST['idnum'];
$qsub=$_POST['qsub'];
$mpno=$_REQUEST['mqpno'];
$class=$_REQUEST['class'];
$topic=$_REQUEST['topic'];
$cost=$_REQUEST['cost'];
$desc=$_REQUEST['desc'];
$author=$_REQUEST['author'];
$cate=$_REQUEST['sub'];
$date=date("d-m-Y");

if($grade!="" && $chap!="")
{
$couid=$grade;
$chapid=$chap;
}
$sql="insert into quiz values(null,$couid,$chapid,'$qfname','$qsname','$qid','$cost','$mpno','$topic','$desc','$author','$cate','$date',' ',' ',' ','$qfname')";
mysql_query($sql) or mysql_error();

if($grade!="")
header("location:manage_quiz.php");
else
header("location:manage_quiz.php?id=$chapid&cid=$couid");

?>