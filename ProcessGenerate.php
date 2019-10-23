<?php
session_start();
include_once "lib/db.php";
include_once "lib/test_gen_class.php";

user_login_check();

$generator = new TestGenerator();

$objSql = new SqlClass();

 if(!isset($_REQUEST['fullyloaded']) || !isset($_REQUEST['test_id']))
 {
	echo '<script>';
	echo 'window.location.href="test_gen.php";';
	echo '</script>';
 }

?>

<?php
$fullloaded=$_REQUEST['fullyloaded'];
$test_id=(int)substr($_REQUEST['test_id'],0,strripos($_REQUEST['test_id'],"gen"));

 $sql="select * from test_tests where user_id=".$_SESSION['user_id']." and test_id=".$test_id;
$res=$objSql->executeSql($sql);
	$row=$objSql->fetchRow($res);

$test_name=$row['test_name'];
$test_time=$row['testtime']*60;
$test_date=date('Y-m-d H:i:s');
$taken_time=0;
$ques='';
$totques=count($_REQUEST['hid']);
$attempt=0;
$not_attempt=0;
$correct=0;
$incorrect=0;

$mrkpq=$row['mrkpq'];
$negmrk=$mrkpq*$row['negmrk'];
$totmrks=$totques * $mrkpq;

for($i=0;$i<$totques; $i++)
{
	$ques[$i]['sno']=$i;
	$ques[$i]['qno']=$_REQUEST['hid'][$i];
	$ques[$i]['ans']=$_REQUEST['Question'.$i];

	if($_REQUEST['Question'.$i]!='')
	{
		$rec=$generator->get_ques_full_details($_REQUEST['hid'][$i]);
		
/*		$qry="select * from questions where que_id=".$_REQUEST['hid'][$i];
		$objSql2 = new SqlClass();
		$rs=$objSql2->executeSql($qry);
		$rec=$objSql2->fetchRow($rs);
*/		
		$attempt++;
		
//		echo '<br/> Qno : '.$rec['qid'].'  Ans : '.$rec['ans'].'  My Ans : '.$_REQUEST['Question'.$i].'<br/>';

		if($rec['answer']==$_REQUEST['Question'.$i])
		{
			$status='Correct';
			$correct++;
		}
		else
		{
			$status='Incorrect';
			$incorrect++;
		}
	}
	else
	{
		$status='Not Attempt';
		$not_attempt++;
	}
	$ques[$i]['status']=$status;		
	$ques[$i]['btime']=$_REQUEST['btime'.$i];	
	$ques[$i]['difficult']=$_REQUEST['difficu'.$i];
	
	$taken_time+=$_REQUEST['btime'.$i];
}

$mrksget=($correct*$mrkpq)-($incorrect*$negmrk);

/*echo '<br/>Total Ques : '.$totques;
echo '<br/>Attempt Ques : '.$attempt;
echo '<br/>Not Attempt Ques : '.$not_attempt;
echo '<br/>Correct Ques : '.$correct;
echo '<br/>Incorrect Ques : '.$incorrect;
echo '<br/>Total Marks : '.$totmrks;
echo '<br/>Marks per ques : '.$mrkpq;
echo '<br/>Negative Mark : '.$negmrk;
echo '<br/>Marks Get : '.$mrksget;
*/

$xml_data='<?xml version="1.0"?>';
$xml_data.='<Test>';
$xml_data.='<Summary>';
$xml_data.='<Name>'.$test_name.'</Name>';
$xml_data.='<Date>'.date("Y-m-d").'</Date>';
$xml_data.='<Total_Qus>'.$totques.'</Total_Qus>';
$xml_data.='<Attempt_Qus>'.$attempt.'</Attempt_Qus>';
$xml_data.='<NotAttempt_Qus>'.$not_attempt.'</NotAttempt_Qus>';
$xml_data.='<Correct_Qus>'.$correct.'</Correct_Qus>';
$xml_data.='<InCorrect_Qus>'.$incorrect.'</InCorrect_Qus>';
$xml_data.='<MarkPerQus>'.$mrkpq.'</MarkPerQus>';
$xml_data.='<NegMark>'.$negmrk.'</NegMark>';
$xml_data.='<Total_Marks>'.$totmrks.'</Total_Marks>';
$xml_data.='<Marks_Get>'.$mrksget.'</Marks_Get>';
$xml_data.='<Test_Time>'.$test_time.'</Test_Time>';
$xml_data.='<Taken_Time>'.$taken_time.'</Taken_Time>';
$xml_data.='</Summary>';
$xml_data.='<Questions>';

$not_attempt_ques='<Not_Attempted>';
$correct_ans_ques='<Correct>';
$incorrect_ans_ques='<InCorrect>';

for($i=0;$i<count($ques);$i++)
{
	$temp_data='';
	$j=$i+1;
	$temp_data.='<Question>';
			$temp_data.='<Question_No>'.$j.'</Question_No>';
			$temp_data.='<Question_ID>'.$ques[$i]['qno'].'</Question_ID>';
			$temp_data.='<Question_Status>'.$ques[$i]['status'].'</Question_Status>';
			$temp_data.='<Question_Time>'.$ques[$i]['btime'].'</Question_Time>';
	$temp_data.='</Question>';

	if($ques[$i]['status']=='Not Attempt')
		$not_attempt_ques.=$temp_data;
	else if($ques[$i]['status']=='Correct')
		$correct_ans_ques.=$temp_data;
	else if($ques[$i]['status']=='Incorrect')
		$incorrect_ans_ques.=$temp_data;
}

$not_attempt_ques.='</Not_Attempted>';
$correct_ans_ques.='</Correct>';
$incorrect_ans_ques.='</InCorrect>';

$xml_data.=$not_attempt_ques.$correct_ans_ques.$incorrect_ans_ques;
$xml_data.='</Questions>';
$xml_data.='</Test>';

	$fp  =  fopen("xml/".$test_id."xml.xml",  'w+');
	fwrite($fp, $xml_data); 
	fclose($fp);




$objSql3 = new SqlClass();
$objSql4 = new SqlClass();

$sql3="select * from test_test_results where test_id=".$test_id;
$rs3=$objSql3->executeSql($sql3);
$rec3=$objSql3->fetchRow($rs3);

if(!is_array($rs3))
{
	$sql4="insert into test_test_results (test_id,test_name,test_gen_id,tot_ques,attempt,not_attempt,correct,incorrect,mrkpq,negmrk,tot_mrks,mrkget,test_time,taken_time,result) values ('".$test_id."','".$test_name."','".$_REQUEST['test_id']."','".$totques."','".$attempt."','".$not_attempt."','".$correct."','".$incorrect."','".$mrkpq."','".$negmrk."','".$totmrks."','".$mrksget."','".$test_time."','".$taken_time."','".serialize($ques)."');";
	$objSql4->executeSql($sql4);
	$sql4="update test_tests set status=1 where test_id=".$test_id;
	$objSql4->executeSql($sql4);
}

?>

<?php
	echo '<script>';
	echo 'window.location.href="Generate.php?testids='.$test_id.'gen&amp;section=0&paidTest=1&qno='.$totques.'&type=view"';
	echo '</script>';
?>

