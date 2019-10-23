<?php
session_start();
include_once '../../../lib/functions.php';
include_once '../../../lib/db.php';
include_once'../../../lib/class_exam_course.php';
include_once'../../../lib/class_exam_chapters.php';
include_once'../../../lib/class_exam_curriculum.php';
include_once'../../../lib/class_exam_grades.php';
include_once'../../../lib/class_exam_subject.php';
$queries = new Queries();
$objSql = new SqlClass();
$objSql1= new SqlClass();




$exams_course = new exams_course();
$exams_chapters = new exams_chapters();
$exams_curriculum = new exams_curriculum();
$exams_grades = new exams_grades();
$exams_subject = new exams_subject();

$objSql1 = new SqlClass();
//admin_login_check();

//echo $sql;

	if(isset($_REQUEST['exprt']) && !empty($_REQUEST['exprt']))
	{
		//$users='';
		$val = explode(',', $_REQUEST['exprt']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			$sql = "SELECT * FROM test_course WHERE course_id='".$val[$i]."'";
			if($_GET['school_id']!=0)
			$sql.=" and school_id=".$_GET['school_id'];
			$users=$objSql1->executeSql($sql);
		}
	}
    else
	{
		$sql = "SELECT * FROM test_course";
		if($_GET['school_id']!=0)
			$sql.=" where school_id=".$_GET['school_id'];
		$users=$objSql1->executeSql($sql);
	}	

	if(is_array($users))
		{
		

				
				$filename ="course_report".time().".doc";
				
				$title = "";
				$contents="<table align='center' border=1 width='100%' bordercolor='black' style='font-family:verdana; font-size:11px;'>
				<tr bgcolor='#72ACF3'><td colspan='5' height='30' align='center' style='font-size:14px;'><b>".Site_Title."</b></td></tr>
				<tr  bgcolor='#72ACF3'>
				<td>Search Criteria: Course</td> 
				<td>Total Records: ".count($users)."</td></tr>
				<tr><td colspan='5' align='center' style='color:#336699; font-size:16px;'><strong>Courses</strong></td></tr>
				<tr bgcolor='#CCCCCC'><td>Grade </td><td>Curriculum</td> <td>No. Of Chapters</td><td>Subject</td><td>References</td></tr>";
				for($i=0;$i<count($users);$i++)
				{
					if($i%2==0)
						$bgcolor=' background-color:#FFFFFF;';
					else
						$bgcolor=' background-color:#F4FCFF;';
						
					$grade = $exams_grades->grades_selectall("grade_id",$users[$i]['grade_id']);
					$cur =$exams_curriculum->curriculum_selectall("cur_id",$users[$i]['cur_id']);
                   $sub = $exams_subject->subject_selectall("sub_id",$users[$i]['subject_id']);
				   
				   
					$contents.= "<tr><td>".ucfirst($grade['grade_name'])." </td><td>". $cur['cur_name']."</td><td>".$users[$i]['num_of_chapters']." </td>
					<td>".$sub['sub_name']." </td><td>".$users[$i]['reference_text']." </td></tr>";
				}
				$contents.="</table>";

				$fp  =  fopen("../exports/".$filename,  'w+'); 
				$str  =  $contents; 
				fwrite($fp,  $str); 
				fclose($fp);

			print '<form action="index.php" method="post" name="download_form">
			  <input type="text" name="filename" id="filename" value="'.$filename.'" style="border:none; color:white;" />
			  <input type="text" name="school_id" id="filename" value="'.$_GET['school_id'].'" style="border:none; color:white;" />
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
			print("self.location='index.php?school_id=".$_REQUEST['school_id']."'");
			print("</script>");
		}
?>

