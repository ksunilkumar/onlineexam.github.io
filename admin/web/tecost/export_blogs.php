 <?php
 @session_start();

include_once "../../../lib/db.php";
include_once "../../../lib/functions.php";
include_once "../../../lib/functions_admin.php";
include "../../../lib/class_exam_grades.php";
include "../../../lib/class_exam_chapters.php";
include "../../../lib/class_exam_cost.php";
include "../../../lib/class_exam_test.php";
include "../../../lib/class_exam_course.php";
//include "../lib/class_exam_chapters.php";
$queries = new Queries();
$objSql = new SqlClass();
$objSql1 = new SqlClass();
$exams_grades = new exams_grades();
$exams_cost = new exams_cost();
$exams_test = new exams_test();
$exams_course = new exams_course();
$exams_chapters = new exams_chapters();


$id=$_REQUEST['id'];
$cid=$_REQUEST['cid'];

	if(isset($_REQUEST['exprt']) && !empty($_REQUEST['exprt']))
	{
		//$users='';
		$val = explode(',', $_REQUEST['exprt']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			
			$sql="select * from test_cost where cost_id='".$val[$i]."'";

			$users=$objSql1->executeSql($sql);
		}
		
	}
    else
	{
		if($id!="")
		$sql = "SELECT * FROM test_cost where chapter_id=".$id;
		else
		$sql = "SELECT * FROM test_cost";
	
		$users=$objSql1->executeSql($sql);
	}	

				
	if(is_array($users))
		{
		
				$filename ="cost_report".time().".doc";
				$title = "";
				$contents="<table align='center' border=1 width='100%' bordercolor='black' style='font-family:verdana; font-size:11px;'>
				<tr bgcolor='#72ACF3'><td colspan='4' height='30' align='center' style='font-size:14px;'><b>qatarsmarteducation</b></td></tr>
				<tr  bgcolor='#72ACF3'>
				<td>Search Criteria: Costs</td> 
				<td>Total Records: ".count($users)."</td></tr>
				<tr><td colspan='4' align='center' style='color:#336699; font-size:16px;'><strong>Costs</strong></td></tr>
				<tr bgcolor='#CCCCCC'><td>Grade </td><td>Quiz  </td> <td>Cost</td><td>Discount</td></tr>";
				for($i=0;$i<count($users);$i++)
				{
					if($i%2==0)
						$bgcolor=' background-color:#FFFFFF;';
					else
						$bgcolor=' background-color:#F4FCFF;';
						echo $users[$i]['test_id'];
					$test1 = $exams_test->test_select_two("test_id",$users[$i]['test_id'],$_SESSION['school_id']);
					$test = $objSql->fetchRow($test1);
					
					
					$course1 = $exams_course->course_select('course_id',$users[$i]['course_id']);
					$course = $objSql->fetchRow($course1);
					
					$grade1 = $exams_grades->grades_all_select($course['grade_id']);
					$grade=$objSql->fetchRow($grade1);
											
											
					$contents.= "<tr><td>".ucfirst($grade['grade_name'])." </td><td>". $test['test_name']."</td><td>".$users[$i]['cost']." </td>
					<td>".$users[$i]['general_discount']." </td>
					</tr>";
				}
				$contents.="</table>";

				$fp  =  fopen("../exports/".$filename,  'w+'); 
				$str  =  $contents; 
				fwrite($fp,  $str); 
				fclose($fp);

			print '<form action="index.php" method="post" name="download_form">
			  <input type="text" name="filename" id="filename" value="'.$filename.'" style="border:none; color:white;" />
			</form>';
			print("<script>");
			print("document.download_form.submit();");
			print("</script>");

/*header('Content-type: application/vnd.ms-word');

header('Content-Disposition: attachment; filename='.$filename);
echo $title;
echo $contents;

print("<script>");
print("self.location='index.php'");
print("</script>");
*/
		}
		else
		{
			print("<script>");
			print("alert('No Records Found');");
			print("self.location='index.php'");
			print("</script>");
		}
?>