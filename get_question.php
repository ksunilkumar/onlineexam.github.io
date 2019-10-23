<?php
session_start();

include 'lib/db.php';
// include 'lib/functions.php';
include_once ("lib/test_gen_class.php");

$generator = new TestGenerator();


$objSql = new SqlClass();
$objSql3 = new SqlClass();
?>
<?php
$qid=$_REQUEST['qid'];
$test_id=$_REQUEST['test_id'];
$result_id=$_REQUEST['ttaken'];
?>

<?php

	$sql="select * from test_test_results where test_id=".$test_id." and result_id=".$result_id;
	$res=$objSql->executeSql($sql);
	$row=$objSql->fetchRow($res);

$test_name=$row['test_name'];
$test_time=$row['test_time'];
$taken_time=$row['taken_time'];
$ques=unserialize($row['result']);
$totques=$row['tot_ques'];
$attempt=$row['attempt'];
$not_attempt=$row['not_attempt'];
$correct=$row['correct'];
$incorrect=$row['incorrect'];

$mrkpq=$row['mrkpq'];
$negmrk=$row['negmrk'];
$totmrks=$row['tot_mrks'];
$mrksget=$row['mrkget'];

?>


<?php
/*$qry='select * from questions where que_id='.$ques[$qid]['qno'];
$rs=$objSql3->executeSql($qry);
$row=$objSql3->fetchRow($rs);
*/
$row=$generator->get_ques_full_details($ques[$qid]['qno']);
?>
<table width="99%" cellspacing="0" cellpadding="0" border="0" align="left" style="border: 1px solid rgb(219, 219, 219);">
<tbody>
    <tr bgcolor="#f2eee2">
      <td height="22" align="left" class="profile_info_text">Question <?php echo $qid+1; ?> of <?php echo $totques; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if($totques>($qid+1)) { echo '<input type="button" onClick="javascript:showQuesSec('.($qid+1).');" value="Next" class="test_next_but" />'; } ?> &nbsp;&nbsp;&nbsp;&nbsp;<?php if($qid>0) { echo '<input type="button" onClick="javascript:showQuesSec('.($qid-1).');" value="Prev" class="test_next_but" />'; } ?></td>
    </tr>
    <tr><td height="200" width="5%" valign="top" align="left" style="padding: 4px; line-height: 17px; color: rgb(0, 0, 0);" >

<p align="justify" style="font-family: Arial; font-size: 13px;"><font size="2" face="Arial"><b><u>Directions:</u></b> <?php echo $row['qdir']; ?></font></p>
<p><font size="2" face="Arial"><b><?php echo stripcslashes($row['question']); ?></b></font></p>
<div class="QBYQ_incorrect">Result : <?php echo $ques[$qid]['status']; ?></div><br /><br />
<?php
// $options=explode(',',$row['options']);
$options=$row['options'];

			for($i=0;$i<count($options);$i++)
			{
				echo '<br/>';
				if($row['answer']==$i)
					echo '<img src="images/tic_qByq.gif" />';
				else if($ques[$qid]['ans']==$i && $ques[$qid]['ans']!='')
					echo '<img src="images/q-by-q_cross.gif" />';
				else
					echo '<img src="images/qbyq_round.gif" />';
?>
<span align="left" class="exam_head_instruction" style=""><strong><?php echo stripcslashes($options[$i]); ?></strong></span>

<?php		
			}
?>
            </td></tr>
		</tbody>
        </table>