<?php session_start();
include "../../../lib/db.php";
include_once'../../../lib/class_exam_modelpapers.php';
include "../../../lib/class_exam_grades.php";
include "../../../lib/class_exam_curriculum.php";
include "../../../lib/class_exam_subject.php";
$queries = new Queries();
$objSql = new SqlClass();
$exams_modelpapers = new exams_modelpapers();
$exams_grades = new exams_grades(); 


										$exams_curriculum = new exams_curriculum();
										$exams_subject = new exams_subject();
									
										$opt_que = $exams_modelpapers->modelpapers_select_one();
										$rowcount=0;
										//print_r($opt_que);
										$rowcount=0;
										if(is_array($opt_que)){
										$filename ="modelpapers_report".time().".doc";
										$title = "";
										$contents="<table align='center' border=1 width='100%' bordercolor='black' style='font-family:verdana; font-size:11px;'>
										<tr bgcolor='#72ACF3'><td colspan='2' height='30' align='center' style='font-size:14px;'><b>".Site_Title."</b></td></tr>
										<tr  bgcolor='#72ACF3'>
										<td>Search Criteria: Model Papers</td> 
										<td>Total Records: ".count($users)."</td></tr>
										<tr><td colspan='2' align='center' style='color:#336699; font-size:16px;'><strong>Model Papers</strong></td></tr>";
										for($i=0;$i<=count($opt_que)-3;$i++)
										//while($row=$objSql->fetchRow($opt_que))
										{ 
										$rowcount++;
										$curname = $exams_curriculum->curriculum_name_select(cur_id,$opt_que[$i]['cur_num']);
										$cname =$objSql->fetchRow($curname);
										$sub = $exams_subject->subject_all_select($opt_que[$i]['subject_num']);
										$sname=$objSql->fetchRow($sub);
										$grename= $exams_grades->grades_all_select($opt_que[$i]['grade_num']);
										$gname = $objSql->fetchRow($grename);
										if($i%2==0)
											$bgcolor=' background-color:#FFFFFF;';
										else
											$bgcolor=' background-color:#F4FCFF;';
										
										$contents.= "<tr><td colspan='2'>
										<table border=0 width='100%' style='font-family:verdana; font-size:11px; ".$bgcolor." '>
										<tr><td style=''><strong>curriculum:&nbsp;&nbsp;</strong>".ucfirst($cname["cur_name"])." </td></tr>
										<tr><td style=''><strong>Subject:&nbsp;&nbsp;</strong>".ucfirst($sname["sub_name"])." </td></tr>
										<tr><td style=''><strong>Grade:&nbsp;&nbsp;</strong>".ucfirst($gname["grade_name"])." </td></tr>
										<tr><td style=''><strong>Section A:&nbsp;&nbsp;</strong>".ucfirst($opt_que[$i]['section_a'])." </td></tr>
										<tr><td style=''><strong>Marks for Section A:&nbsp;&nbsp;</strong>".ucfirst($opt_que[$i]['amarks'])." </td></tr>
										<tr><td style=''><strong>Section B:&nbsp;&nbsp;</strong>".ucfirst($opt_que[$i]['section_b'])." </td></tr>
										<tr><td style=''><strong>Marks for Section B:&nbsp;&nbsp;</strong>".ucfirst($opt_que[$i]['bmarks'])." </td></tr>
										<tr><td style=''><strong>Section C:&nbsp;&nbsp;</strong>".ucfirst($opt_que[$i]['section_c'])." </td></tr>
										<tr><td style=''><strong>Marks for Section C:&nbsp;&nbsp;</strong>".ucfirst($opt_que[$i]['cmarks'])." </td></tr>
										<tr><td style=''><strong>Section D:&nbsp;&nbsp;</strong>".ucfirst($opt_que[$i]['section_d'])." </td></tr>
										<tr><td style=''><strong>Marks for Section D:&nbsp;&nbsp;</strong>".ucfirst($opt_que[$i]['dmarks'])." </td></tr>";
										
									
										
							
										$contents.="<tr><td>&nbsp;</td></tr>";
										
										$contents.="</table>
										</td></tr>";
										
										}
											$contents.="</table>";

				$fp  =  fopen("../exports/".$filename,  'w+'); 
				$str  =  $contents; 
				fwrite($fp,  $str); 
				fclose($fp);

			print '<form action="manage_opt_modelpaper.php" method="post" name="download_form">
			  <input type="text" name="filename" id="filename" value="'.$filename.'" style="border:none; color:white;" />
			</form>';
			print("<script>");
			print("document.download_form.submit();");
			print("</script>");
										}
										else
		{
			print("<script>");
			print("alert('No Records Found');");
			print("self.location='manage_opt_modelpaper.php'");
			print("</script>");
		}

?>