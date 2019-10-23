<?php
session_start();
include_once'../../../lib/db.php';
include_once'../../../lib/class_exam_modelpapers.php';
$exams_modelpapers = new exams_modelpapers();
 $id=$_GET['id'];
$position = $exams_modelpapers->modelpapers_delete("num",$id);
$_SESSION['msg'] = "<font size='2' color='#FF0000'>Optional Model Paper  is deleted successfully</font>";
$page=$_GET['page'];
print "<script>";
print " self.location='manage_opt_modelpaper.php?page=".$page."';";
print "</script>"; 
?>