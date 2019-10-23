<?php
$filename=$_REQUEST['filename'];

	header('Content-type: application/vnd.ms-word');
	header('Content-Disposition: attachment; filename='.$filename);
	
		echo $title;
		echo $contents;

?>