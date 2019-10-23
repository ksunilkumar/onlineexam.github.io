<?php
// example of how to modify HTML contents
include('../simple_html_dom.php');

// get DOM from URL or file
$html = file_get_html('fd.htm');

// remove all image
foreach($html->find('p.MsoNormal') as $e)
    $e->outertext = '';



// dump contents
echo $html;
?>