<?php
session_start();

include 'lib/db.php';
include_once ("lib/test_gen_class.php");

$generator = new TestGenerator();

?>
<?php

$objsql = new SqlClass();

$qry="select * from test_tests where user_id=".$_SESSION['user_id'];

$searchKey='';
$sort='sort=dateDESC';
if(isset($_REQUEST['mode']))
{
  if($_REQUEST['searchKey']=='test_name' && $_REQUEST['nameKey']=='startsWith')
  {
  		$args[] = " test_name LIKE '".$_REQUEST['searchVal']."%' ";
		
		$searchKey='&mode=search&searchKey=test_name&nameKey=startsWith&searchVal='.$_REQUEST['searchVal'];
  }
  else if($_REQUEST['searchKey']=='test_name' && $_REQUEST['nameKey']=='contains')
  {
  		$args[] = " test_name LIKE '%".$_REQUEST['searchVal']."%' ";
		
		$searchKey='&mode=search&searchKey=test_name&nameKey=contains&searchVal='.$_REQUEST['searchVal'];
		
  }
  else if($_REQUEST['searchKey']=='datime')
  		{
 			$from=$_REQUEST['dateFrom'];
  			$to=$_REQUEST['dateTo'];
 			$args[] = " (created_date between '".date($from." 00:00:00")."' and '".date($to." 23:59:59")."') ";
			
			$searchKey='&mode=search&searchKey=datime&dateFrom='.$from.'&dateTo='.$to;
		}
}

if(count($args)>0)
{
	while(list($key,$val) = each($args))
	{
		$qry.=' and '.$val;
	}
}

if(isset($_REQUEST['sort']))
{
	if($_REQUEST['sort']=='nameASC')
		$qry.= " order by test_name ASC";
	else if($_REQUEST['sort']=='nameDESC')
		$qry.= " order by test_name DESC";
	else if($_REQUEST['sort']=='dateASC')
		$qry.= " order by created_date ASC";
	else if($_REQUEST['sort']=='dateDESC')
		$qry.= " order by created_date DESC";
		
  $sort='&sort='.$_REQUEST['sort'];
}
else
{
	$qry.= " order by created_date DESC";
}


	$pagination_key = new pagination_key;
	$pagination_key->createPaging($qry,5);
	$bagsize=$pagination_key->recordsize();
	$allpages=$pagination_key->pages;
	if(isset($_REQUEST['page']) && $_REQUEST['page']!='')
		$cpg=$_REQUEST['page'];
	else
		$cpg=1;

	$url='gen_test_account_inc_ajax.php?'.$sort;
?>

<div id="list">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:#dbdbdb solid 1px;">
                  <tr>
                    <td width="40" height="24" align="center" valign="middle" class="test_list_border web_font_9"><strong>No</strong></td>
                    <td width="1" height="24" align="center" valign="middle" class="test_list_border web_font_9"></td>
                    <td width="158" height="24" align="center" valign="middle" class="test_list_border web_font_9"><strong>Test Name<a href="javascript:void(0);"onclick="ahahscript.ahah('gen_test_account_inc_ajax.php?<?php echo $searchKey; ?>&sort=nameASC&page=<?php echo $cpg; ?>&gen_test=', 'list', '', 'GET', '', this);" style="text-decoration: none;"><img src="images/a1.png" border="0" /></a><a href="javascript:void(0);" onclick="ahahscript.ahah('gen_test_account_inc_ajax.php?<?php echo $searchKey; ?>&sort=nameDESC&page=<?php echo $cpg; ?>&gen_test=', 'list', '', 'GET', '', this);" style="text-decoration: none;"><img src="images/a2.png" alt="arrow" width="16" height="12" border="0" /></a></strong></td>
                    <td width="1" height="24" align="center" valign="middle" class="test_list_border web_font_9"></td>
                    <td width="92" height="24" align="center" valign="middle" class="test_list_border web_font_9"><strong>Date <a href="javascript:void(0);" onclick="ahahscript.ahah('gen_test_account_inc_ajax.php?<?php echo $searchKey; ?>&page=<?php echo $cpg; ?>&sort=dateASC&gen_test=', 'list', '', 'GET', '', this);" style="text-decoration: none;"><img src="images/a1.png" border="0" /></a><a href="javascript:void(0);" onclick="ahahscript.ahah('gen_test_account_inc_ajax.php?<?php echo $searchKey; ?>&sort=dateDESC&page=<?php echo $cpg; ?>&gen_test=', 'list', '', 'GET', '', this);" style="text-decoration: none;"><img src="images/a2.png" alt="arrow" width="16" height="12" border="0" /></a></strong></td>
                    <td width="1" height="24" align="center" valign="middle" class="test_list_border web_font_9"></td>
                    <td width="117" height="24" align="center" valign="middle" class="test_list_border web_font_9"><strong>Questions</strong></td>
                    <td width="1" height="24" align="center" valign="middle" class="test_list_border web_font_9"></td>
                    <td width="95" height="24" align="center" valign="middle" class="test_list_border web_font_9"><strong>Time (min)</strong></td>
                    <td width="1" height="24" align="center" valign="middle" class="test_list_border web_font_9"></td>
                    <td height="24" align="center" valign="middle" class="test_list_border web_font_9"><strong>Actions</strong></td>
                    </tr>
                  <?php


$i=1;
while($row=mysql_fetch_object($pagination_key->resultpage))
{
/*	echo '<pre>';
	print_r($row);
	echo '</pre>';
*/
	if($i%2==0)
		$bg='blue_bg_admin';
	else
		$bg='grey_bg_admin';
	
?>
                  <tr>
                    <td height="30" align="center" valign="middle" class="web_font_9 test_list_border"><?php echo $i; ?></td>
                    <td align="center" valign="middle" class="web_font_9 test_list_border"></td>
                    <td align="center" valign="middle" class="web_font_9 test_list_border"><div id="<?php echo $row->test_id; ?>" onmouseover="ShowEditIcon(this.id,1)" onmouseout="ShowEditIcon(this.id,0)" style="cursor: default; position: relative; margin-left:3px;">
                          <div id="divName<?php echo $row->test_id; ?>" style="float: left;" title="<?php echo $row->test_name; ?>"><?php echo $row->test_name; ?></div>
                        <div id="divIcon<?php echo $row->test_id; ?>" style="display: none; float: left;"><a onclick='javascript:ShowTestNameDiv(&quot;<?php echo $row->test_id; ?>&quot;,&quot;<?php echo $row->test_name; ?>&quot;);' style="cursor: pointer; text-decoration:none;">&nbsp;&nbsp;<img src="images/edit.gif" border="0" /></a></div>
                    </div></td>
                    <td align="left" valign="middle" class="web_font_9 test_list_border"></td>
                    <td align="center" valign="middle" class="web_font_9 test_list_border"><?php echo date("M d, Y",strtotime($row->created_date)); ?></td>
                    <td align="center" valign="middle" class="web_font_9 test_list_border"></td>
                    <td align="center" valign="middle" class="web_font_9 test_list_border"><?php echo $row->numques; ?></td>
                    <td align="center" valign="middle" class="web_font_9 test_list_border"></td>
                    <td align="center" valign="middle" class="web_font_9 test_list_border"><?php echo $row->testtime; ?></td>
                    <td align="center" valign="middle" class="web_font_9 test_list_border"></td>
                    <td width="112" align="center" valign="middle" class="web_font_9 test_list_border"><div style="padding-top: 2px; text-align:center" id="1t"><img src="images/aa33.png" align="absmiddle" />&nbsp;
                      <?php if($row->status==0) { ?>
                      <a href="Generate.php?testids=<?php echo $row->test_id; ?>gen&amp;section=0&amp;paidTest=0&amp;qno=<?php echo $row->numques; ?>&amp;type=new" title="Take Test" class="web_font_9"><strong>Take Test</strong></a>
                      <?php } else { ?>
                      <a href="Generate.php?testids=<?php echo $row->test_id; ?>gen&amp;section=0&amp;paidTest=1&amp;qno=<?php echo $row->numques; ?>&amp;type=view" title="View Test" class="web_font_9"><strong>View Result</strong></a>
                      <?php } ?>
                    </div></td>
                    </tr>
                  <?php 
	$i++;
}
 ?>
                  <tr >
                    <td valign="middle" align="right" colspan="11" height="32"><?php echo ajax_pagination($allpages,$cpg,$url,'list'); ?></td>
                  </tr>
                </table>
                </div>

