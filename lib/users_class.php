<?php

class Users
{
		function get_user_details($id)
		{
			$sql = "SELECT * FROM ise_users WHERE user_id = ".$id;
			$objSql = new SqlClass();
			$recore = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($recore);
			return $row;
		}
		function user_name($id)
		{
			$sql = "SELECT user_fname,user_lname FROM ise_users WHERE user_id = ".$id;
			$objSql = new SqlClass();
			$recore = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($recore);
			return $row['user_fname'].' '.$row['user_lname'];
		}
		function get_age($dob,$separator,$format)
		{
			if($dob!='')
			{
				$date=explode($separator,$dob);
				
				switch($format)
				{
					case 'yyyymmdd':
					$year_diff  = date("Y") - $date[0];
					$month_diff = date("m") - $date[1];
					$day_diff   = date("d") - $date[2];
					break;
					case 'yyyyddmm':
					$year_diff  = date("Y") - $date[0];
					$month_diff = date("m") - $date[2];
					$day_diff   = date("d") - $date[1];
					break;
					case 'mmddyyyy':
					$year_diff  = date("Y") - $date[2];
					$month_diff = date("m") - $date[0];
					$day_diff   = date("d") - $date[1];
					break;
					case 'ddmmyyyy':
					$year_diff  = date("Y") - $date[2];
					$month_diff = date("m") - $date[1];
					$day_diff   = date("d") - $date[0];
					break;
				}
				
				if ($day_diff < 0 || $month_diff < 0)
			    $year_diff--;
				
				return $year_diff;
			}
			else
			return 0;
		}
		function user_values($val)
		{
			$sql = "SELECT * FROM ise_users WHERE user_id = ".$val;
			$objSql = new SqlClass();
			$recore = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($recore);
			return $row;
		}

		function generateCode($characters)
		{
			$possible = '23456789bcdfghjklmnpqrstvwxyz';
			$code = '';
			$i = 0;
				while ($i < $characters)
				{ 
					$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
					$i++;
				}
			return $code;
		}
			function user_name_one($id)
		{
			$sql_u = "SELECT user_fname from ise_users where user_id='".$id."'";
			$objSql_1 = new SqlClass();
			$record_u = $objSql_1->executeSql($sql_u);
			$row_1 = $objSql_1->fetchRow($record_u);
			return $row_1['user_fname'];
		}
		
}

?>