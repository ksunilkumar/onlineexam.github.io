<?php
 session_start();
include_once'../../../lib/db.php';
include_once'../../../lib/class_exam_optque.php';
$exams_optque = new exams_optque();
 $id=$_GET['id'];
$position = $exams_optque->optque_delete("num",$id);
$_SESSION['msg'] = "<font size='2' color='#FF0000'>Optional question is deleted successfully</font>";
$page=$_GET['page'];

print " <script>  self.location='index.php?page=".$page."';</script>";
?>