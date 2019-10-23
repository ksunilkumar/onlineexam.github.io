<?

    function insertKeys($noOfCoupons){

			$objSql = new SqlClass();
			$sql = "INSERT INTO `enm_coupons_generator` (`noOfCoupons`) VALUES ($noOfCoupons)";
			$objSql->executeSql($sql);
			unset($objSql);
			$objSql = new SqlClass();
			$sq= "SELECT * FROM enm_coupons_generator ORDER BY generatorId DESC LIMIT 0,1";
			$result=$objSql->executeSql($sq);
			$row=$objSql->fetchRow($result);
			$generatorId=$row['generatorId'];
			$i=0;
			while($i<$noOfCoupons)
			{
				//echo "i=".$i."<br>";
				//echo "noOfCoupons=".$noOfCoupons."<br>";
					$couponNumber1=rand(10000000,99999999);
					$couponNumber2=rand(10000000,99999999);			
					$couponNumber=$couponNumber1.$couponNumber2;
					$sql = "INSERT INTO qse_keys(`keyId`, `keyNumber`, `generatorId`, `status`, `school_id`) VALUES
					 (NULL, $couponNumber, '$generatorId', 'To Be Used', '')";
					
					unset($objSql);
					$objSql = new SqlClass();
					$objSql->executeSql($sql);
				
				
				$i++;
			}
			unset($objsql);
			return  $couponNumber;
		}
		
		
			function qatar_keys_delete($field,$value)
			{
			$query=new Queries();
		return $query->makedeletequery('qse_keys',$field,$value);
	}
		
?>