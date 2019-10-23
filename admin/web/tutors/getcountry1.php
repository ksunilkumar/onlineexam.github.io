<?php include_once '../../../lib/db.php';
include_once '../../../lib/functions.php';
	$settings=new settings();
echo $settings->get_state1($_GET['id']);
?>