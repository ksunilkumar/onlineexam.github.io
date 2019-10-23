<?php
// to get quiz name

include_once'../../../lib/db.php';
include_once'../../../lib/class_exam_test.php';
include_once'../../../lib/class_exam_cost.php';

 $chid=$_REQUEST['na'];

$queries = new Queries();
$objSql = new SqlClass();
$exams_test =new exams_test();
 $exams_cost = new  exams_cost();
$test1 = $exams_test->test_all_select($chid);
	
echo "<select name='quiz' onchange=".'"'."call('6')".'"'."id='topic'><option value='all'>--Select--</option>";

for($i=0;$i<count($test1);$i++)
{


 /* $c= $exams_cost->cost_select(test_id,$test1['test_id']);
  
 $c1=$objSql->fetchRow($c);
  if($c1[test_id]==$test1[test_id]){ }else{
*/
$i1='0';
	if($chid!="")
	{
	$i1=$i1+1;?>
	<option value="<?php echo $test1[$i]['test_id'];?>"><?php echo $test1[$i]['test_name'];?></option>
	<?php 
	}
}
if($i1=='0')
{
echo "<option value=''>-Select Chapter Name-</option>";
}
echo "</select>";
?>
