<?php
 @session_start();


include_once'../../../lib/db.php';
	include "../../../lib/functions_admin.php";
	include "../../../lib/functions.php";
include_once'../../../lib/class_exam_course.php';
include_once'../../../lib/class_exam_chapters.php';
include_once'../../../lib/class_exam_subject.php';
include_once'../../../lib/class_exam_test.php';
include_once'../../../lib/class_exam_grades.php';

$queries = new Queries();
$objSql = new SqlClass();
$objSql1 = new SqlClass();

$exams_test = new exams_test();
$exams_subject = new exams_subject();
$exams_course = new exams_course();
$exams_chapters = new exams_chapters();
$exams_grades = new exams_grades();

$chapid=$_REQUEST['cid'];

/*
if($chapid!="" && $couid!=""){
$s = $exams_test->test_to_select($couid,$chapid,$_SESSION['school_id']);
$courseall = $exams_course->course_select("course_id",$couid);
$chapters = $exams_chapters->chapters_sel("chap_id",$chapid,$_SESSION['school_id']);

}
else{
$s = $exams_test->test_select(1,1,$_SESSION['school_id']);


}*/



	if(isset($_REQUEST['exprt']) && !empty($_REQUEST['exprt']))
	{
		//$users='';
		$val = explode(',', $_REQUEST['exprt']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			if($chapid!="undefined")
			$sql = "SELECT * FROM test_test WHERE school_id='".$_SESSION['school_id']."' and chapter_id='".$chapid."' and test_id=".$val[$i]."'";
			else
			$sql = "SELECT * FROM test_test WHERE school_id='".$_SESSION['school_id']."' and test_id='".$val[$i]."'";
			$users=$objSql1->executeSql($sql);
		}
		
	}
    else
	{
		if($chapid!="undefined")
		$sql = "SELECT * FROM test_test WHERE school_id='".$_SESSION['school_id']."' and chapter_id='".$chapid."'";
		else
			$sql = "SELECT * FROM test_test WHERE school_id='".$_SESSION['school_id']."'";
		$users=$objSql->executeSql($sql);
	}	
	
	if(is_array($users))
		{
		
				$filename ="blog_report".time().".doc";
				$title = "";
				$contents="<table align='center' border=1 width='100%' bordercolor='black' style='font-family:verdana; font-size:11px;'>
				<tr bgcolor='#72ACF3'><td colspan='4' height='30' align='center' style='font-size:14px;'><b>".Site_Title."</b></td></tr>
				<tr  bgcolor='#72ACF3'>
				<td>Search Criteria: Tests</td> 
				<td>Total Records: ".count($users)."</td></tr>
				<tr><td colspan='4' align='center' style='color:#336699; font-size:16px;'><strong>Tests</strong></td></tr>
				<tr bgcolor='#CCCCCC'><td>Grade </td><td>Chapter </td> <td>Quiz</td><td>Test Time</td></tr>";
				for($i=0;$i<count($users);$i++)
				{
					if($i%2==0)
						$bgcolor=' background-color:#FFFFFF;';
					else
						$bgcolor=' background-color:#F4FCFF;';
						
					$s1 = $exams_course->course_selectall("course_id",$users[$i]['course_id']);
					$chap = $exams_chapters->chapters_selectall("chap_id",$users[$i]['chapter_id']);
					$g = $exams_grades->grades_selectall("grade_id",$s1['grade_id']);
					
					$cour1=$exams_course->course_selectall("course_id",$users[$i]['course_id']);
																
					$grade1 = $exams_grades->grades_selectall("grade_id",$cour1["grade_id"]);
					$contents.= "<tr><td>".ucfirst($g['grade_name'])." </td><td>". $chap['chap_name']."</td><td>".$users[$i]['test_name']." </td>
					<td>".$users[$i]['time']." </td>
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