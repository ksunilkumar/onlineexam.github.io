<?php
class exams_bag{
    function __construct(){
      $this->query=new Queries();
	 $this->table = 'test_bag';
	}
	function bag_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function bag_update($array,$where)
	{
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function bag_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function bag_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function bag_all_select($value){
		$sql = "select * from test_bag where user='$value' and tid='offer'"; 
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function bag_select($value){
		 $sql = "select * from test_bag where user='$value' and tid='offer' and status!=2"; 
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function bag_offer(){
		$sql="select * from test_bag where tid!='offer' and nstatus!='pending' and nstatus!='process' and status=2";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function bag_tests($value1,$value2){
		$sql="select * from test_bag where $value1 ='$value2'  AND  status = 0 order by bagid desc";
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function bag_ranks($value1,$value2,$value3){
		$sql="select * from test_bag where courseid ='$value1' and chapterid ='$value2'and quizid='$value3' and marks>0 order by marks desc";
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function bag_users($value1,$value2,$value3){
		$sql="select DISTINCT user from test_bag where courseid ='$value1' and chapterid ='$value2'and quizid='$value3' ";
		//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function get_user_bag($userid){
	$sql="select  test_bag.Bagid,test_bag.tid,test_bag.pwd,test_bag.quizid,test_chapters.chap_id,test_chapters.chap_name,test_chapters.chap_image,test_chapters.chap_description, test_course.course_id,test_subject.sub_id,test_subject.sub_image, test_subject.sub_name from test_bag , test_chapters,test_course,test_subject where test_bag.user='$userid' and nstatus=1 and test_bag.chapterid=test_chapters.chap_id and test_bag.courseid=test_course.course_id  and test_course.subject_id=test_subject.sub_id order by Bagid desc ";
	$limit=4;
 //$sql="select  test_bag.Bagid,test_bag.tid,test_bag.pwd,test_chapters.chap_id,test_chapters.chap_name,test_chapters.chap_description, test_course.course_id,test_subject.sub_id, test_subject.sub_name,test_subject.sub_image from test_bag left join test_chapters on test_bag.user='$userid' and test_bag.chapterid=test_chapters.chap_id left join test_course on test_bag.courseid=test_course.course_id  left join  test_subject on test_course.subject_id=test_subject.sub_id ";
		$pagination_qatar = new pagination_qatar();
	$pagination_qatar->createPaging($sql,$limit);
	while($row=mysql_fetch_object($pagination_qatar->resultpage)){
	$rowdc[]=$row;
	}
	  $rowdc['total_rec']=$pagination_qatar->totalrecords();
	  $rowdc['dis_page']=$pagination_qatar->displayPaging();
	 
	return $rowdc;
	}
	function  get_bagid_detils($bagid){
	 	$sql="select * from test_bag where Bagid=$bagid";
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		return $record;
	 }  
}
?>
