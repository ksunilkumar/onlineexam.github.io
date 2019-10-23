<?php
session_start();

include 'lib/db.php';
include_once ("lib/test_gen_class.php");

$generator = new TestGenerator();


$mode=$_REQUEST['mode'];

$objsql = new SqlClass();
$objsql2 = new SqlClass();

if($mode=='upTestName')
{
	$test_id=$_REQUEST['hiddTstId'];
	$test_name=$_REQUEST['txtTestName'];

	$qry='update test_tests set test_name="'.$test_name.'" where test_id="'.$test_id.'"';
	$objsql->executeSql($qry);
	
	$qry2='update test_test_results set test_name="'.$test_name.'" where test_id="'.$test_id.'"';
	$objsql2->executeSql($qry2);
	
	echo '<div id="'.$test_id.'" onmouseover="ShowEditIcon(this.id,1)" onmouseout="ShowEditIcon(this.id,0)" style="cursor: pointer; position: relative;">
                            <div id="divName'.$test_id.'" style="float: left;" title="'.$test_name.'">'.$test_name.'</div>
                            <div id="divIcon'.$test_id.'" style="display: none; float: left;"><a onclick=\'javascript:ShowTestNameDiv("'.$test_id.'","'.$test_name.'");\' style="cursor: pointer;">&nbsp;&nbsp;<img src="images/edit.gif"></a></div>
                        </div>';	
}
else if($mode=='chkEmptyCat')
{
	$chapter_id=$_REQUEST['catid'];
	$selqs=$_REQUEST['totnumb'];
	$row_id=$_REQUEST['rowId'];
	//echo '<pre>';
	//print_r($_REQUEST);
	//echo '</pre>';

	$qry='select count(que_id) as noqus from test_questions where chapter_id="'.$chapter_id.'"';
	$rs=$objsql->executeSql($qry);
	$rec=$objsql->fetchRow($rs);
	
	if($selqs>$rec['noqus'])
	{
		echo '<script>document.getElementById("choosenum['.$row_id.']").value='.$rec['noqus'].';</script>';
	}
	
	echo '<span align="right" style="padding-right: 10px; float: right;" id="searchMsg">You can select maximum of '.$rec['noqus'].' question(s) for this category.</span>';
}
?>