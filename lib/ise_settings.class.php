<?php
class ise_Settings
{
	function country_onchange_select($val)
	{
			$sql1 = "SELECT country_id, country_name FROM ise_country WHERE status = 'active' ORDER BY  country_name ";
			$objSql1 = new SqlClass();
			$record1 = $objSql1->executeSql($sql1);
			$out = "<select name='selcountry' onChange='state_onchange(this.value)'>";
			$out.= "<option value=''>Select Country from List</option>";
			while($row1 = $objSql1->fetchRow($record1))
			{
				if($row1['country_id'] == $val)
				$out.= "<option value='".$row1['country_id']."' selected>".$row1['country_name']."</option>";
				else
				$out.= "<option value='".$row1['country_id']."'>".$row1['country_name']."</option>";
			}
			$out.= "</select>";
			return $out;
	}
	function country_onchange()
	{
			$sql1 = "SELECT country_id, country_name FROM ise_country WHERE status = 'active' ";
			$objSql1 = new SqlClass();
			$record1 = $objSql1->executeSql($sql1);
			$out = "<select name='selcountry' onChange='state_onchange(this.value)'>";
			$out.= "<option value=''>Select Country from List</option>";
			while($row1 = $objSql1->fetchRow($record1))
			{
				$out.= "<option value='".$row1['country_id']."'>".$row1['country_name']."</option>";
			}
			$out.= "</select>";
			return $out;
	}

	function state_onchange_select($cid,$sid)
	{
		$sql2 = "SELECT stat_id, stat_name FROM ise_state WHERE status = 'active' AND country_id = '".$cid."' ";
			$objSql2 = new SqlClass();
			$record2 = $objSql2->executeSql($sql2);
			$out = "<select name='selstate'>";
			$out.= "<option value=''>Select State from List</option>";
			while($row2 = $objSql2->fetchRow($record2))
			{
				if($row2['stat_id']==$sid)
					$out.= "<option value='".$row2['stat_id']."' selected>".$row2['stat_name']."</option>";
				else
					$out.= "<option value='".$row2['stat_id']."'>".$row2['stat_name']."</option>";
				
			}
			$out.= "</select>";
			echo $out;
	}
	function get_country_name($cid)
	{
			$sql = "SELECT country_name FROM ise_country WHERE country_id = ".$cid;
			$objSql = new SqlClass();
			$recore = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($recore);
			return $row['country_name'];
	}
	function get_state_name($sid)
	{
			$sql = "SELECT stat_name FROM ise_state WHERE stat_id = ".$sid;
			$objSql = new SqlClass();
			$recore = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($recore);
			return $row['stat_name'];
	}
	function get_schools()
	{
			$sql2 = "SELECT school_id, school_name FROM ise_schools WHERE status = 'active'";
			$objSql2 = new SqlClass();
			$record2 = $objSql2->executeSql($sql2);
			$out = "<select name='selschool'>";
			$out.= "<option value=''>Select School from List</option>";
			while($row2 = $objSql2->fetchRow($record2))
			{
				if($row2['school_id']==$sid)
					$out.= "<option value='".$row2['school_id']."' selected>".$row2['school_name']."</option>";
				else
					$out.= "<option value='".$row2['school_id']."'>".$row2['school_name']."</option>";
				
			}
			$out.= "</select>";
			echo $out;
	}
	function get_admin_schools()
	{
			$sql2 = "SELECT school_id, school_name FROM ise_schools WHERE status = 'active'";
			$objSql2 = new SqlClass();
			$record2 = $objSql2->executeSql($sql2);
			$out = "<select name='selschool' id='selschool' onchange='javascript:change_school(this.value);'>";
			$out.= "<option value=''>Select School from List</option>";
			while($row2 = $objSql2->fetchRow($record2))
			{
				if($row2['school_id']==$sid)
					$out.= "<option value='".$row2['school_id']."' selected>".$row2['school_name']."</option>";
				else
					$out.= "<option value='".$row2['school_id']."'>".$row2['school_name']."</option>";
				
			}
			$out.= "</select>";
			echo $out;
	}

	function get_admin_sel_schools($sid)
	{
			$sql2 = "SELECT school_id, school_name FROM ise_schools WHERE status = 'active'";
			$objSql2 = new SqlClass();
			$record2 = $objSql2->executeSql($sql2);
			$out = "<select name='selschool' id='selschool' onchange='javascript:change_school(this.value);'>";
			$out.= "<option value=''>Select School from List</option>";
			while($row2 = $objSql2->fetchRow($record2))
			{
				if($row2['school_id']==$sid)
					$out.= "<option value='".$row2['school_id']."' selected>".$row2['school_name']."</option>";
				else
					$out.= "<option value='".$row2['school_id']."'>".$row2['school_name']."</option>";
				
			}
			$out.= "</select>";
			echo $out;
	}
	function get_sel_schools($sid)
	{
			$sql2 = "SELECT school_id, school_name FROM ise_schools WHERE status = 'active'";
			$objSql2 = new SqlClass();
			$record2 = $objSql2->executeSql($sql2);
			$out = "<select name='selschool'>";
			$out.= "<option value=''>Select School from List</option>";
			while($row2 = $objSql2->fetchRow($record2))
			{
				if($row2['school_id']==$sid)
					$out.= "<option value='".$row2['school_id']."' selected>".$row2['school_name']."</option>";
				else
					$out.= "<option value='".$row2['school_id']."'>".$row2['school_name']."</option>";
				
			}
			$out.= "</select>";
			echo $out;
	}
	function get_school_name($sid)
	{
			$sql = "SELECT school_name FROM ise_schools WHERE school_id=".$sid;
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record[0][0];
			
	}
	
	function get_all_categories()
	{
		$sql = "SELECT * FROM category WHERE school_id=".$_SESSION['school_id']." and status='active' order by cat_id asc";
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		return $record;
	}

	function get_cat_name($cat_id)
	{
		$sql = "SELECT cat_name FROM category WHERE cat_id=".$cat_id;
		$objSql = new SqlClass();
		$record = $objSql->executeSql($sql);
		return $record[0][0];
	}
	
	
	function get_groups_dropdown()
	{
			$sql2 = "SELECT group_id, group_name FROM ise_groups WHERE status = 'active'";
			$objSql2 = new SqlClass();
			$record2 = $objSql2->executeSql($sql2);
			$out = "<select name='selgroup'>";
			$out.= "<option value=''>Select Category from List</option>";
			while($row2 = $objSql2->fetchRow($record2))
			{
				if($row2['group_id']==$sid)
					$out.= "<option value='".$row2['group_id']."' selected>".$row2['group_name']."</option>";
				else
					$out.= "<option value='".$row2['group_id']."'>".$row2['group_name']."</option>";
				
			}
			$out.= "</select>";
			echo $out;
	}
	
	function get_admin_sel_group($sid)
	{
			$sql2 = "SELECT group_id, group_name FROM ise_groups WHERE status = 'active'";
			//echo $sql2;exit;
			$objSql2 = new SqlClass();
			$record2 = $objSql2->executeSql($sql2);
			$out = "<select name='selgroup' id='selgroup' onchange='javascript:change_group(this.value);'>";
			$out.= "<option value=''>Select Category from List</option>";
			while($row2 = $objSql2->fetchRow($record2))
			{
				if($row2['group_id']==$sid)
					$out.= "<option value='".$row2['group_id']."' selected>".$row2['group_name']."</option>";
				else
					$out.= "<option value='".$row2['group_id']."'>".$row2['group_name']."</option>";
				
			}
			$out.= "</select>";
			echo $out;
	}
	
	function get_group_school($id)
		{
			$sql="select school_id from ise_groups where group_id=".$id;
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			//echo $row['school_id'];exit;
			return $row['school_id'];
		}
	
	
	
	
	function get_groupcategory_dropdown($sid)
	{
			$sql2 = "SELECT group_id, group_name FROM ise_groups WHERE status = 'active'";
			$objSql2 = new SqlClass();
			$record2 = $objSql2->executeSql($sql2);
			$out = "<select name='selgroup'>";
			$out.= "<option value=''>Select Category from List</option>";
			while($row2 = $objSql2->fetchRow($record2))
			{
				if($row2['group_id']==$sid)
				
					$out.= "<option value='".$row2['group_id']."' selected>".$row2['group_name']."</option>";
				else{
				//$out.= "<option value='0'>All</option>";
					$out.= "<option value='".$row2['group_id']."'>".$row2['group_name']."</option>";
					}
				
			}
			$out.= "</select>";
			echo $out;
	}
	
	function get_sel_group($sid)
	{
			$sql2 = "SELECT group_id, group_name FROM ise_groups WHERE status = 'active'";
			//echo $sql2;exit;
			$objSql2 = new SqlClass();
			$record2 = $objSql2->executeSql($sql2);
			$out = "<select name='selgroup' id='selgroup' onchange='javascript:change_group(this.value);'>";
			$out.= "<option value=''>All</option>";
			while($row2 = $objSql2->fetchRow($record2))
			{
				
				if($row2['group_id']==$sid)
					$out.= "<option value='".$row2['group_id']."' selected>".$row2['group_name']."</option>";
				else
					$out.= "<option value='".$row2['group_id']."'>".$row2['group_name']."</option>";
				
			}
			$out.= "</select>";
			echo $out;
	}
	

	
	function get_group_name($sid)
	{
			$sql = "SELECT group_name FROM ise_groups WHERE group_id=".$sid;
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record[0][0];
			
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function get_school_all_names()
	{
			$sql2 = "SELECT school_id, school_name FROM ise_schools WHERE status = 'active'";
			$objSql2 = new SqlClass();
			$record2 = $objSql2->executeSql($sql2);
			return $record2;
	}
	function get_school_name1($id='')
	{
			$sql2 = "SELECT school_id, school_name FROM ise_schools WHERE status = 'active'";
			$objSql2 = new SqlClass();
			$record2 = $objSql2->executeSql($sql2);
			$out = "<select name='selschool' onchange='get_school_courses(this.value)'>";
			$out.= "<option value=''>Select School from List</option>";
			while($row2 = $objSql2->fetchRow($record2))
			{
				if($row2['school_id']==$id)
					$out.= "<option value='".$row2['school_id']."' selected>".$row2['school_name']."</option>";
				else
					$out.= "<option value='".$row2['school_id']."'>".$row2['school_name']."</option>";
				
			}
			$out.= "</select>";
			echo $out;
	}
	function get_school_names($id)
	{
			$sql2 = "SELECT school_name FROM ise_schools WHERE status = 'active' and school_id=".$id;
			$objSql2 = new SqlClass();
			$record2 = $objSql2->executeSql($sql2);
			$row=$objSql2->fetchRow($record2);
			return $row['school_name'];
	}	
	function site_search($id, $field1, $field2, $table, $keyword, $school_id)
	{
			$sql2 = "SELECT $id as id, $field1 as name FROM $table WHERE ($field1 LIKE '%$keyword%' ||  $field2 LIKE '%$keyword%') AND status='active' AND school_id=$school_id";
			$objSql2 = new SqlClass();
			$record2 = $objSql2->executeSql($sql2);
			return $record2;
	}
	
	function display_adds($page){
	
	$sql2 = "SELECT id,url,status FROM ise_ads order by createdate desc ";
	$sql2.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			$objSql2 = new SqlClass();
			$record2 = $objSql2->executeSql($sql2);
			return $record2;
	
	}
	function totalNoOfadds()
		{
			$sql = "SELECT id,url,status FROM ise_ads ";
           
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}
	
	 function __construct()
	{
	  $this->table='ise_ads';
      $this->query=new Queries();
	}
	
	function ise_add_insert($array){

			return $this->query->makeinsertquery($this->table,$array);
	}
	function ise_adds_delete($field,$value){
		return $this->query->makedeletequery($this->table,$field,$value);
	}
	function ise_adds_set_function($array,$where){
	   return $this->query->makeupdatequery($this->table,$array,$where);	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
?>