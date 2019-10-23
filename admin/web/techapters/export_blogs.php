<?php
 @session_start();
	include "../../../lib/db.php";
	include "../../../lib/functions_admin.php";
	include "../../../lib/functions.php";
	//include "../../../lib/calss_settings.php";
	include "../../../lib/class_exam_course.php";
	include "../../../lib/class_exam_chapters.php";
	include "../../../lib/class_exam_curriculum.php";
	include "../../../lib/class_exam_grades.php";
	include "../../../lib/class_exam_subject.php";
	$queries = new Queries();
	
	$settings = new settings();
	$exams_course = new exams_course();
	$exams_chapters = new exams_chapters();
	$exams_curriculum = new exams_curriculum();
	$exams_grades = new exams_grades();
	$exams_subject = new exams_subject();
    $cid=$_REQUEST['couid'];
    $rowcount=0;
	$objSql = new SqlClass();
	$objSql1= new SqlClass();


	if(isset($_REQUEST['exprt']) && !empty($_REQUEST['exprt']))
	{
		//$users='';
		$val = explode(',', $_REQUEST['exprt']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			$sql = "SELECT * FROM test_chapters WHERE chap_id='".$val[$i]."'";
			$users=$objSql1->executeSql($sql);
		}
	}
    else
	{
		$sql = "SELECT * FROM test_chapters";
		$users=$objSql1->executeSql($sql);
	}	

	if(is_array($users))
		{
		

				
				$filename ="chapters_report".time().".doc";
				
				$title = "";
				$contents="<table align='center' border=1 width='100%' bordercolor='black' style='font-family:verdana; font-size:11px;'>
				<tr bgcolor='#72ACF3'><td colspan='5' height='30' align='center' style='font-size:14px;'><b>".Site_Title."</b></td></tr>
				<tr  bgcolor='#72ACF3'>
				<td>Search Criteria: Chapters</td> 
				<td>Total Records: ".count($users)."</td></tr>
				<tr><td colspan='5' align='center' style='color:#336699; font-size:16px;'><strong>Chapters</strong></td></tr>
				<tr bgcolor='#CCCCCC'><td>Grade </td><td>Chapter No</td> <td>Title</td><td>Sub Topics</td><td>Description</td></tr>";
				for($i=0;$i<count($users);$i++)
				{
					if($i%2==0)
						$bgcolor=' background-color:#FFFFFF;';
					else
						$bgcolor=' background-color:#F4FCFF;';
						
					$cour1=$exams_course->course_selectall("course_id",$users[$i]['course_id']);
					$grade1 = $exams_grades->grades_selectall("grade_id",$cour1["grade_id"]);
				   
				   
					$contents.= "<tr><td>".ucfirst($grade1['grade_name'])." </td><td>". $users[$i]['chapter_no']."</td><td>".$users[$i]['chap_name']." </td>
					<td>".$users[$i]['subtopics']." </td><td>".$users[$i]['chap_description']." </td></tr>";
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

