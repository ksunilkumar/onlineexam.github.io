<?php session_start();
		include_once'../../../lib/db.php';
		include_once'../../../lib/class_exam_course.php';
		include_once'../../../lib/class_exam_subject.php';
		include_once'../../../lib/class_exam_offers.php';
		include_once'../../../lib/class_exam_bag.php';
		include_once'../../../lib/class_exam_test.php';

		$queries = new Queries();
		$objSql = new SqlClass();
		$exams_offers = new exams_offers();
		$exams_bag = new exams_bag();
		$exams_test = new exams_test();
		$exams_subject = new exams_subject();
		$exams_course = new exams_course();
	
		$curid=$_REQUEST['cur'];
	 	$sid=$_REQUEST['sub'];
		$grade=$_REQUEST['grade'];
		$chno=$_REQUEST['chno'];
	 	$quizid=$_REQUEST['quiz'];
	 	$user1=$_REQUEST['student'];
		$res='';
if($user1=="" || $curid=="all")
{
				print "<script>";
				print " self.location='give_offer.php?opt=not&msg=Please Select Proper Details';";
				print "</script>"; 
}
else
{//if all fields are selected 1
		if($curid!="" && $sid!="" && $grade!="" &&$chno!="" && $quizid!="" && $quizid!="all")
		{   
			$offertab = array("user =".$user1."", "curid=".$curid."", "courseid=".$grade."","chapterid=".$chno."","quizid=".$quizid."","status=0","school_id=".$_REQUEST['school']."");
			$offer = $exams_offers->offers_insert($offertab);
			
			$bagtab = array("user =".$user1."", "courseid=".$grade."", "chapterid=".$chno."","quizid=".$quizid."","nstatus=" . 1 ."","tid=offer","school_id=".$_REQUEST['school']."");
			$res=$exams_bag->bag_insert($bagtab);
				
		}
		//if quiz id is all 2
		else if($curid!="" && $sid!="" && $grade!="" &&$chno!="" && $quizid=="all")
		{

		 $selquiz = $exams_test->test_to_select($grade,$chno);
		
			while($quz=$objSql->fetchRow($selquiz))
			{
				$quztab = array("user =".$user1."", "curid=".$curid."", "courseid=".$grade."","chapterid=".$chno."","quizid=".$quz['qid']."","status=0","school_id=".$_REQUEST['school']."");
				$quiz = $exams_offers->offers_insert($quztab);
				
				$quztab1 =  array("user =".$user1."", "courseid=".$grade."", "chapterid=".$chno."","quizid=".$quz['qid']."","nstatus=" . 1 ."","tid=offer","school_id=".$_REQUEST['school']."");
				$res=$exams_bag->bag_insert($quztab1);
			
			}
		}
		//if qiz is not selected  and chapters are selected all 3
		else if($curid!="" && $sid!=""&& $grade!="" &&$chno=="all")
		{

		$squiz = $exams_test->test_select(course_id,$grade);
		while($quz1=$objSql->fetchRow($squiz))
			{
				$qtab = array("user =".$user1."", "curid=".$curid."", "courseid=".$grade."","chapterid=".$quz1['chapterid']."","quizid=".$quz1['qid']."","status=0","school_id=".$_REQUEST['school']."");
				$quiz = $exams_offers->offers_insert($qtab);
				
				$qtab1 =  array("user =".$user1."", "courseid=".$grade."", "chapterid=".$quz1['chapterid']."","quizid=".$quz1['qid']."","nstatus=" . 1 ."","tid=offer","school_id=".$_REQUEST['school']."");
				$res=$exams_bag->bag_insert($qtab1);
			
			}
		}
		//if igrade is all and chapers and quiz are not selected 4
		else if($curid!="" && $sid!=""&& $grade=="all" )
		{ 

		$course = $exams_course->course_to_select($sid,$curid);
		
			while($c1=$objSql->fetchRow($course))
			{
				$s = $exams_test->test_select(course_id,$c1['course_id']);
			
			while($c2=$objSql->fetchRow($s))
			{
			
				$ctab = array("user =".$user1."", "curid=".$curid."", "courseid=".$c2['course_id']."","chapterid=".$c2['chapter_id']."","quizid=".$c2['test_id']."","status=0","school_id=".$_REQUEST['school']."");
				$quiz = $exams_offers->offers_insert($ctab);

				$ctab1 =  array("user =".$user1."", "courseid=".$c2['course_id']."", "chapterid=".$c2['chapter_id']."","quizid=".$c2['test_id']."","nstatus=" . 1 ."","tid=offer","school_id=".$_REQUEST['school']."");
				$res=$exams_bag->bag_insert($ctab1);
			
				}
			
			
			
			}
			
		}
		// if subject is all 5
		else if($curid!="" && $sid=="all")
		{

		$c1 = $exams_course->course_select(cur_id,$curid);
		
			while($cor=$objSql->fetchRow($c1))
			{
			$s = $exams_test->test_select(course_id,$cor['course_id']);

				while($cor1=$objSql->fetchRow($s))
			{
				$ctab = array("user =".$user1."", "curid=".$curid."", "courseid=".$cor1['course_id']."","chapterid=".$cor1['chapter_id']."","quizid=".$cor1['test_id']."","status=0","school_id=".$_REQUEST['school']."");
				$quiz = $exams_offers->offers_insert($ctab);
				$ctab1 =  array("user =".$user1."", "courseid=".$cor1['course_id']."", "chapterid=".$cor1['chapter_id']."","quizid=".$cor1['test_id']."","nstatus=" . 1 ."","tid=offer","school_id=".$_REQUEST['school']."");
				$res=$exams_bag->bag_insert($ctab1);
				
			
				}
			
			
			
			}
			
		}
		
		
		print "<script>";
		print " self.location='give_offer.php?opt=yes&msg=Offer Added&bagid=".$res."';";
		print "</script>"; 
				
		//header("location:add_offers.php?opt=yes");
}
?>
