<?php
include_once('../simple_html_dom.php');

$html=file_get_html('fd.htm');
//$ret = $html->find('li',0);
$ret = $html->find('span[style=font-size:11.0pt;line-height:200%]'); 
print_r($ret);