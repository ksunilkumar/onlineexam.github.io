<?php

class TestGenerator
{
	function get_all_circulums()
	{
		$objSql = new SqlClass();
		$qry = "select * from test_curriculum";
		$rec = $objSql->executeSql($qry);
		return $rec;
	}

	function get_dist_circulums()
	{
		$objSql = new SqlClass();
		$qry = "SELECT distinct(test_course.cur_id),test_curriculum.cur_name FROM test_course,test_curriculum where test_course.cur_id=test_curriculum.cur_id";
		$rec = $objSql->executeSql($qry);
		return $rec;
	}

	
	function get_all_grades()
	{
		$objSql = new SqlClass();
		$qry = "select * from test_grades";
		$rec = $objSql->executeSql($qry);
		return $rec;
	}

	function get_dist_grades($cur_id)
	{
		$objSql = new SqlClass();
		$qry = "SELECT distinct(test_course.grade_id),test_grades.grade_name FROM test_course,test_grades where test_course.grade_id=test_grades.grade_id and test_course.cur_id='".$cur_id."'";
		$rec = $objSql->executeSql($qry);
		return $rec;
	}

	function get_all_subjects()
	{
		$objSql = new SqlClass();
		$qry = "select * from test_subject";
		$rec = $objSql->executeSql($qry);
		return $rec;
	}

	function get_dist_subjects($cur_id,$grade)
	{
		$objSql = new SqlClass();
		$qry = "SELECT distinct(test_course.subject_id),test_subject.sub_name FROM test_course,test_subject where test_course.subject_id=test_subject.sub_id and test_course.cur_id='".$cur_id."' and test_course.grade_id='".$grade."'";
		$rec = $objSql->executeSql($qry);
		return $rec;
	}

	
	function get_all_courses()
	{
		$objSql = new SqlClass();
		$qry = "select * from test_course";
		$rec = $objSql->executeSql($qry);
		return $rec;
	}
	
	function get_course_id($curid,$gradeid,$subid)
	{
		$objSql = new SqlClass();
		$qry = "select course_id from test_course where cur_id='".$curid."' and grade_id='".$gradeid."' and subject_id='".$subid."'";
		$rec = $objSql->executeSql($qry);
		$row = $objSql->fetchRow($rec);
		return $row['course_id'];
	}
	
	function get_chapters($courseid)
	{
		$objSql = new SqlClass();
		$qry = "select * from test_chapters where course_id=".$courseid." order by chapter_no asc";
		$rec = $objSql->executeSql($qry);
		return $rec;
	}
	
	function get_dist_chapters()
	{
		$objSql = new SqlClass();
		$qry = "select DISTINCT(course_id) from test_chapters";
		$rec = $objSql->executeSql($qry);
		return $rec;
	}

	function get_course_chapters_list()
	{
		$objSql = new SqlClass();
		$qry = "select DISTINCT(course_id) from test_chapters";
		$rec = $objSql->executeSql($qry);
		$list='';
		
		while($row = $objSql->fetchRow($rec))
		{
			if($list!='')
				$list.=','.$row['course_id'];
			else
				$list.=$row['course_id'];
		}
		
		return $list;
	}
	
	function get_chap_name($cid)
	{
		$objSql = new SqlClass();
		$qry = "select chap_name from test_chapters where chap_id=".$cid;
		$rec = $objSql->executeSql($qry);
		$row = $objSql->fetchRow($rec);
		return $row['chap_name'];
	}
	
	function get_ques_full_details($qus_id)
	{
		$objSql = new SqlClass();
		$qry = "select * from test_questions where que_id=".$qus_id;
		$rec = $objSql->executeSql($qry);
		$row = $objSql->fetchRow($rec);
		
		$ques['qus_id'] = $qus_id;
		$ques['section'] = $row['section'];
		$ques['chapter_id'] = $row['chapter_id'];
		$ques['que_number'] = $row['que_number'];
		
		$html_question=strip_tags($row['question'],'<img><object><sub><sup>');
		$que=str_replace('src="','src="admin/papers/',$html_question);
		$que1=str_replace("src='","src='admin/papers/",$que);
		
		$ques['question'] = $que1;
		$objSql2 = new SqlClass();
		$qry2 = "select * from test_options where section='".$ques['section']."' and chapter_id=".$ques['chapter_id']." and option_number=".$ques['que_number'];
		$rec2 = $objSql2->executeSql($qry2);
		$row2 = $objSql2->fetchRow($rec2);
		
		$optins = strip_tags($row2['options'],'<img><object><sub><sup>');
		$opt=str_replace('src="','src="admin/papers/',$optins);
		$opt1=str_replace("src='","src='admin/papers/",$opt);

		$ques['options'] = explode("#$",$opt1);
		

		$objSql3 = new SqlClass();
		$qry3 = "select * from test_answers where section='".$ques['section']."' and chapter_id=".$ques['chapter_id']." and ans_number=".$ques['que_number'];
		$rec3 = $objSql3->executeSql($qry3);
		$row3 = $objSql3->fetchRow($rec3);
		
		$ans = explode("#$",strip_tags($row3['answer']));
		$ques['answer'] =  $ans[0]-1;

		return $ques;
	}

}

?>