<?php
class Settings
{
		
		function category_dropdown_select($val)
		{
			$sql1 = "SELECT category_id, category_name FROM ise_category WHERE status = 'active' ";
			$objSql1 = new SqlClass();
			$record1 = $objSql1->executeSql($sql1);
			$out = "<select name='selcategory'>";
			$out.= "<option value=''>Select Category from List</option>";
			while($row1 = $objSql1->fetchRow($record1))
			{
			
				if($row1['category_id'] == $val)
				{
			
				$out.= "<option value='".$row1['category_id']."' selected>".$row1['category_name']."</option>";
				}
				else
				$out.= "<option value='".$row1['category_id']."'>".$row1['category_name']."</option>";
			}
			$out.= "</select>";
				return $out;
		
		}
		
}

 
?>