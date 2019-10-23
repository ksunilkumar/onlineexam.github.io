<?php
session_start();
include_once '../../../lib/functions.php';
include_once '../../../lib/db.php';
include_once '../../../lib/functions_admin.php';

$objSql1 = new SqlClass();
$blog=new Blog();

//echo $sql;

	if(isset($_REQUEST['exprt']) && !empty($_REQUEST['exprt']))
	{
		//$users='';
		$val = explode(',', $_REQUEST['exprt']);
		$count = count($val);
		for($i=0;$i<$count;$i++)
		{
			$sql = "SELECT * FROM blogs WHERE blog_id='".$val[$i]."' and school_id=".$_SESSION['school_id']."";
			$users=$objSql1->executeSql($sql);
		}
	}
    else
	{
		$sql = "SELECT * FROM blogs where school_id=".$_SESSION['school_id']."";
		$users=$objSql1->executeSql($sql);
	}	
	/*echo "<pre>";
				print_r($users);
				exit;*/

	if(is_array($users))
		{
		
				$filename ="blog_report".time().".doc";
				$title = "";
				$contents="<table align='center' border=1 width='100%' bordercolor='black' style='font-family:verdana; font-size:11px;border:thick'>
				<tr bgcolor='#72ACF3'><td colspan='2' height='30' align='center' style='font-size:14px;'><b>Robotutor</b></td></tr>
				<tr  bgcolor='#72ACF3'>
				<td>Search Criteria: Blogs</td> 
				<td>Total Records: ".count($users)."</td></tr>
				<tr><td colspan='2' align='center' style='color:#336699; font-size:16px;'><strong>Blogs</strong></td></tr>";
				
				for($i=0;$i<count($users);$i++)
				{
					if($i%2==0)
						$bgcolor=' background-color:#FFFFFF;';
					else
						$bgcolor=' background-color:#F4FCFF;';
					$contents.= "<tr><td colspan='2'>
					<table border=0 width='100%' style='font-family:verdana; font-size:11px; ".$bgcolor." '>
					<tr><td style='font-size:14px; color:#009966; font-weight:bold;'>".ucfirst($users[$i]['blog_title'])." </td></tr>
					<tr><td><strong>Status : ".$users[$i]['status']."</strong> </td></tr>
					<tr><td style='padding-left:5px;'>".nl2br(ucfirst($users[$i]['blog_desc']))." </td></tr>
					<tr><td>&nbsp;</td></tr>
					<tr><td style='color:#006699'><strong>Comments :</strong></td></tr>";
					
				$record_comm = $blog->blog_comments($users[$i]['blog_id']);
				/*echo '<pre>';
				print_r($record_comm);exit;*/
						while($row_comm = $objSql1->fetchRow($record_comm))
						 {
							 // $row_name = $user->user_name($row_comm['user_id']);
							 $row_name='';
							 $contents.="<tr><td>".$row_comm['review_desc']."<br /><b>Posted By ".$row_name." on ".date("F j, Y",strtotime($row_comm['create_date']))."
							  </td></tr>";
							 $contents.="<tr><td>&nbsp;</td></tr>";
						 }
					$contents.="<tr><td>&nbsp;</td></tr>";
					
					$contents.="</table>
					</td></tr>";
				}
				$contents.="</table>";

				$fp  =  fopen("../exports/".$filename,  'w+'); 
				$str  =  $contents; 
				fwrite($fp,  $str); 
				fclose($fp);

			

/*header('Content-type: application/vnd.ms-word');

header('Content-Disposition: attachment; filename='.$filename);
echo $title;
echo $contents;

print("<script>");
print("self.location='index.php'");
print("</script>");
*/
$filename1 ="test".time().".pdf";
require_once( 'fpdf.php' );
$fpdf=new FPDF();

$pdf=new FPDF('P','mm','A4');
$pdf->AddPage($filename1);
$fill = true;
$pdf->SetTextColor( 255, 255, 255 );
$pdf->SetFillColor( 113, 172, 243 );
$pdf->SetFont('Arial','B',16);
$pdf->Cell( 0, 9, 'Robotutor', 1, 1, 'C', true );
$fill=false;
$pdf->SetFont('Arial','B',12);
$pdf->Cell( 0, 9, 'Search Criteria: Blogs', 'LTR', 0, 'L',true );
$pdf->Cell( 0, 9, 'Total Records: '.count($users).'','LR', 1, 'R',true );

$fill=false;
//$pdf->Output();
//$fpdf->WriteHTML($contents);
for($i=0;$i<count($users);$i++)
{
  $pdf->SetTextColor( 99, 42, 57 );
  $pdf->SetFont( 'Arial', 'B', 12 );
  $pdf->SetFillColor( 255, 255, 255 );
  if(($i%2)==0)
  {
  	$pdf->SetFillColor( 244, 252, 255 );
  }
  else
  {
  	
  }
  $pdf->Cell( 0, 9, ucfirst($users[$i]['blog_title']) , 'LTR', 1, 'L',true );
  $pdf->SetFont( 'Arial', '', 9 );
  $pdf->Cell( 0, 6, 'Status: '.$users[$i]['status'] , 'LR', 1, 'L',true );
  $pdf->MultiCell( 0, 9, strip_tags(nl2br(ucfirst($users[$i]['blog_desc']))) , 'LR', 1, 'L',true );
  $pdf->SetFont( 'Arial', 'B', 9 );
  $pdf->Cell( 0, 6, "Comments:" , 'LR', 1, 'L',true );
  // Create the data cells
  $record_comm = $blog->blog_comments($users[$i]['blog_id']);
  while($row_comm = $objSql1->fetchRow($record_comm))
  {
	$row_name='';
	$pdf->SetFont( 'Arial', '', 9 );
	$pdf->Cell( 0, 6, $row_comm['review_desc'],'LR',1, 1, 'L', true );
	$pdf->SetFont( 'Arial', 'B', 9 );
	$pdf->Cell( 0, 6, 'Posted By '.$row_name.' on '.date("F j, Y",strtotime($row_comm['create_date'])),'LR',1, 1, 'L', true);
  }
  
  $fill=!$fill;
  
}
 $pdf->Cell( 0, 0, '','LRB',1, 1, 'L');
 //$pdf->Output($filename);
$pdf->Output($filename1);
header('Content-type: application/pdf');
header('Content-Disposition: attachment; filename="example1.pdf"');
//echo "PDF file is generated successfully!";
/*print '<form action="index.php" method="post" name="download_form">
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
			print("self.location='index.php'");
			print("</script>");
		}*/
?>