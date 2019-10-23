<?php
class exams_curriculum{
    function __construct(){
      $this->query=new Queries();
	 $this->table = 'test_curriculum';
	}
	function curriculum_insert($array){
			return $this->query->makeinsertquery($this->table,$array);
	}
	function curriculum_update($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	function curriculum_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function curriculum_selectall($field,$value){
		return $this->query->makeselectallquery($this->table,$field,$value);
	}
	function select_curriculum($column,$field,$value){
		return $this->query->makeselectquery($this->table,$column,$field,$value);
	}
	function curriculum_allname_select(){
		 $sql = "SELECT * FROM ".$this->table." order by cur_id "; 
			$objSql = new SqlClass();
			$rows= $objSql->executeSql($sql);
			return $rows;
	}
	function curriculum_name_select($value){
		    $sql = "SELECT * FROM ".$this->table." WHERE cur_id='".$value."'"; 
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function curriculum_select($school_id){
		$limit=5;
		$sql = "SELECT * FROM ".$this->table ." where school_id='".$school_id."'";
		//echo $sql;
		$pagination_qatar = new pagination_qatar();
		$pagination_qatar->createPaging($sql,$limit);
		while($row=mysql_fetch_object($pagination_qatar->resultpage)){
		$rowdc[]=$row;
		}
		  $rowdc['total_rec']=$pagination_qatar->totalrecords();
		  $rowdc['dis_page']=$pagination_qatar->displayPaging();
		 
		return $rowdc;
	}
	function Addcur($name,$image,$image_tempname)
	{
		$target="curimages/".basename($image);
		move_uploaded_file($image_tempname,$target);
		$query= New Queries();
		$values=array("curriculum=".addslashes($name)."","image =".$target."");
		$query->makeinsertquery('test_curriculum',$values);
		
	}
	function editcur($name,$image,$image_tempname,$id)
	{
		
		$query= New Queries();
		if(basename($image!=""))
		{
			$target="curimages/".basename($image);
			move_uploaded_file($image_tempname,$target);
			$values=array("curriculum=".$name."","image =".$target."");
		}
		else
		{
			$values=array("curriculum=".$name."");
		}
		$where=array("cid=".$id."");
		$query->makeupdatequery('test_curriculum',$values,$where);		
	}
	function delete($id)
	{
		
		$query= New Queries();
		$sql=New SqlClass;
		$obj1=$query->makeselectallfields('course','test_curriculum',$id);
		$cou1=count($obj1);
		for($i=0;$i<$cou1;$i++)
		{
			$cid=$obj1[$i]['cid'];
			$chaps=$query->makeselectallfields('chapters','courseid',$cid);
			$cou=count($chaps);
			for($j=0;$j<$cou;$j++)
			{
				$query->makedeletequery('qntab','quizid',$chaps[$j]['chapid']);
				$query->makedeletequery('opntab','quizid',$chaps[$j]['chapid']);
				$query->makedeletequery('copttab','quizid',$chaps[$j]['chapid']);
				$query->makedeletequery('topics','chapterid',$chaps[$j]['chapid']);
				$query->makedeletequery('quiz','chapterid',$chaps[$j]['chapid']);
				$query->makedeletequery('cost','chapterid',$chaps[$j]['chapid']);
			}
			$query->makedeletequery('course','cid',$cid);
			$query->makedeletequery('chapters','courseid',$cid);
		}
		$query->makedeletequery('test_curriculum','cid',$id);
	}
	function display()
	{
		
		$query= New Queries();
		return $query->makeselectall('test_curriculum');
	}
	function display_select()
	{
		//include "includes/db.php";
		$query= New Queries();
		return $query->makeselectallvalues('test_curriculum');
	}
	function display_one($id)
	{
		
		$query= New Queries();
		return $query->makeselectallfields('test_curriculum','cid',$id);
	}
	function get_curriculum_count($name,$id){
		$sql="select count(*) as count from ".$this->table." where cur_name='$name' and cur_id <> $id";
		$objSql1 = new SqlClass();
		$rows= $objSql1->executeSql($sql);
		return $rows[0]['count'];
	}
}
?>
