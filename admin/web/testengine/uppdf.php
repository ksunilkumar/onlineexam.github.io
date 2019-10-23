<?php session_start();
include_once '../../../lib/db.php';
$sqlobj=new sqlClass();
 $chid=$_REQUEST['chid'];
$qid=$_REQUEST['qid'];
$sec=$_REQUEST['sec'];
function getExtension($str) 
				 {
					 $i = strrpos($str,".");
					 if (!$i) { return ""; }
					 $l = strlen($str) - $i;
					 $ext = substr($str,$i+1,$l);
					 return $ext;
				 }
	 $name=basename($_FILES['pathe']['name']);
	
	 $ext=getExtension($name);
	$ext = strtolower($ext);
	
	if($ext!='pdf'){
		$re="sectiona_bulk.php?id=$chid&sec=$sec&op=2";
				print "<script>";
				print " self.location='$re';";
				print "</script>";
		exit;
	}
$target="../pdf/$chid$qid$sec".basename($_FILES['pathe']['name']);
move_uploaded_file($_FILES['pathe']['tmp_name'],$target);
$sq="select * from test_pdf where chapterid=$chid and queid=$qid and section='$sec'";
$re=$sqlobj->executeSql($sq);
$no=$sqlobj->getNumRecord();
$res=$sqlobj->fetchRow($re);
//$no=mysql_num_rows($q);
//$re=mysql_fetch_object($q);
if($no>0)
{
$sql="update test_pdf set path='".$target."' where pid=".$res['pid'];
}
else
{
  $sql="insert into test_pdf values(null,$chid,$qid,'$sec','$target',".$_SESSION['school_id'].")";
 
}
$objsql1=new sqlClass();
$sqlobj->executeSql($sql);
$re="sectiona_bulk.php?id=$chid&sec=$sec&op=1";
print "<script>";
				print " self.location='$re ';";
				print "</script>";
?>