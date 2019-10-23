<?php include_once '../../../lib/db.php';
include_once '../../../lib/functions_admin.php';
	$state=new state();
echo $state->get_state1($_GET['id']);
?>