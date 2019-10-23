<?php session_start();
include_once'../../../lib/db.php';
include_once'../../../lib/class_exam_questions.php';
include_once'../../../lib/class_exam_answers.php';
include_once'../../../lib/class_exam_options.php';

$exams_questions = new exams_questions();
$exams_answers = new exams_answers();
$exams_options = new exams_options();

$chap_id=$_REQUEST['chno'];
$curid=$_REQUEST['cur'];
$sub=$_REQUEST['sub'];
$grade1=$_REQUEST['grade1'];
$file_type=$_REQUEST['ftype'];
$up_type=$_REQUEST['utype'];
$doc_type=$_REQUEST['doctype'];
$sect=$_REQUEST['section'];

//echo "q=".$chap_id."<br>cur=".$curid."<br>filetype=".$file_type."<br>upload=".$up_type."<br>doctype=".$doc_type."<br>se=".$sect;

	 $name=basename($_FILES['uple']['name']);
	
	 $ext=getExtension($name);
	$ext = strtolower($ext);
	
	if($ext!='html' && $ext!='htm'){
		print " <script>  self.location='manage_uploads.php?opt=5';</script>";
		exit;
	}
if($doc_type=='def')
{
	if($up_type=='new')
	{
		if($file_type=='Questions' and $up_type='new')
		{
			$resae = $exams_questions->questions_selectall(chapter_id,$chap_id);
			//print_r($resae);
		}
		else if($file_type=='Options' and $up_type='new')
		$resae = $exams_options->options_selectall(chapter_id,$chap_id);
		else if($file_type=='Answers' and $up_type='new')
		$resae= $exams_answers->answers_selectall(chapter_id,$chap_id);
		else if($file_type=='Solutions' and $up_type='new')
		$resae="cal";
		$size = sizeof($resae);
		if($size>0){
/*				print " <script>  self.location='manage_uploads.php?opt=al';</script>";
*/				 }
	}
	include_once '../htmldom/simple_html_dom.php';
	 
	$target="../papers/".basename($_FILES['uple']['name']);
	if(!move_uploaded_file($_FILES['uple']['tmp_name'],$target)){
/*	print " <script>  self.location='manage_uploads.php?opt=2';</script>";
*/	}

	$html = file_get_html('../papers/'.$name);
	$st=0;
	$i=1;
	$res=count($html->find('p'));
	while($st<$res)
	{
		$sec=$html->find('p',$st);
		if($st==0)
		{
			$aec=$sec->innertext;
			$section=str_replace('"',"'",$aec);
			$section=$sect;
		}
		else
		{
			if($st%2!=0)
			{
				$qno=$sec->innertext;
			}
		
			if($st%2==0)
			{
				$que=$sec->innertext;
				//$que=substr($que,1);
				
				
				if($file_type=='Questions' and $up_type=='new'){
				
				$tab = array("section ~!@".$section."", "chapter_id~!@".$chap_id."", "que_number~!@".$i."","question~!@".addslashes($que)."","school_id~!@".$_SESSION['school_id']."");
				
				$queans =$exams_questions->questions_insert($tab);
				
			}
			if($file_type=='Questions' and $up_type=='update')
			{
			
				$quedel = $exams_questions->questions_delete_from($chap_id,$i,$section);
				$tab1 = array("section ~!@".$section."", "chapter_id~!@".$chap_id."", "que_number~!@".$i."","question~!@".addslashes($que)."");
				
				$queans = $exams_questions->questions_insert($tab1);
				
			}
			else if($file_type=='Options' and $up_type=='new')
			{
				$tab1 = array("section ~!@".$section."", "chapter_id~!@".$chap_id."", "option_number~!@".$i."","options~!@".addslashes($que)."","school_id~!@".$_SESSION['school_id']."");
				$exams_options->options_insert($tab1);
				//$sql="insert into aieeeopntab values(null,".'"'."$section".'"'.",$quizid,".'"'."$i".'","'."$question".'"'.")";
			}
			else if($file_type=='Options' and $up_type=='update')
			{
				$exams_options->options_delete_from($chap_id,$i,$section);
				
				$tab1 = array("section ~!@".$section."", "chapter_id~!@".$chap_id."", "option_number~!@".$i."","options~!@".addslashes($que)."");
				$exams_options->options_insert($tab1);
			}
			else if($file_type=='Answers' and $up_type=='new')
			{
			
				$tab2 = array("section ~!@".$section."", "chapter_id~!@".$chap_id."", "ans_number~!@".$i."","answer~!@".addslashes($que)."","school_id~!@".$_SESSION['school_id']."");
				 $exams_answers->answers_insert($tab2);
			}
			else if($file_type=='Answers' and $up_type=='update')
			{
			$exams_answers->answers_delete_from($chap_id,$i,$section);
				$tab2 = array("section ~!@".$section."", "chapter_id~!@".$chap_id."", "ans_number~!@".$i."","answer~!@".addslashes($que)."");
				 $exams_answers->answers_insert($tab2);
									
			}
		
		
		$i++;
		}
		}
		$st++;
	}
}




print " <script>  self.location='manage_uploads.php?opt=1';</script>";

?>
