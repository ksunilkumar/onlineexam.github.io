<?php 
	
	session_start();
	include_once 'lib/db.php';
	$objSql1 = new SqlClass();
	$objSql = new SqlClass();
	if(!empty($_POST))
	{
		$sq = "SELECT user_email FROM ise_users WHERE user_email = '".$_POST['txtuser_email']."'";
		$recor = $objSql->executeSql($sq);
		$row13 = $objSql->fetchRow($recor);
		if(empty($row13['user_email']))
		{
			if( $_SESSION['security_code'] == $_POST['security_code'] )
			{
				 
				$error = '0';$image_name="";
				if($_FILES['pic']['name'] != '')
				{
					$image=$_FILES['pic']['name'];
					$filename = stripslashes($_FILES['pic']['name']);
					$extension = getExtension($filename);
					$extension = strtolower($extension);
					$size=filesize($_FILES['pic']['tmp_name']);
					if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
					{
						$_SESSION['msg'] = "<div class='wrong'>Unknown Course Image extension ( ".$extension." )! Please Upload png or jpg or jpeg or gif Image</div>";
						$error = '1';
					}
					
					if($error == '0')
					{
						$image_name=time().".".$extension;
						$newname="user_images/".$image_name;
						$copied = copy($_FILES['pic']['tmp_name'], $newname);
						
					}
				}
				if($error == '0')
				{
					
					$code = generateCode(12);
					echo $sql1 = "INSERT INTO ise_users(user_fname, user_lname, user_email, password, user_pic_add, user_gender, dob,
							 mobile_no, city, state, country, contact_method, 
							 biography, interest, create_date, status, secure_code, school)
							VALUES ( '".$_POST['fname']."', '".$_POST['lname']."', '".$_POST['email']."', 
							'".md5($_POST['password'])."', '".$image_name."', '".$_POST['gender']."', '".$_POST['txtdob']."', 
							'".$_POST['mobno']."', '".$_POST['city']."', '".$_POST['selstate']."', '".$_POST['selcountry']."', 
							 '".$_POST['con_method']."', '".addslashes($_POST['biography'])."', 
							'".addslashes($_POST['interest'])."', NOW(), 'inactive', '".$code."', '".$_POST['selschool']."')";
					$objSql1->executeSql($sql1);
					/*Send Mail to user*/
					$fromname = 'ismartexams.com';$fromaddress = 'admin@ismartexams.com' ;$toname = $_POST['txtfname']." ".$_POST['txtlname'];
					$toaddress = $_POST['email'];$subject = 'Your Login Details mailed-by Ismartexams.com';
					$message = "Dear ".$_POST['fname']." ".$_POST['lname']."<br><br>Thank you for registering with Ismartexams<br>
						Please find your account information below. The account information will allow you to complete your registration process and access the Ismartexams website.<br><br>
						Click on the link below to activate your account.<br><br>".Site_Name."active.php?id=".$_POST['email']."&code=".$code."<br><br>
						Account Information: <br>Username =".$_POST['email']."<br>Password:".$_POST['password']."<br><br>
						If you have any questions or concerns please contact us. We can be reached via the support chat, email, or call our direct support line.<br><br>Ismartexams Team<br>
						info@ismartexams.in";
					sendMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);
				
					$_SESSION['msg'] = "<div class='success'>User Registration Successfully</div>";
					print "<script>";
					print " self.location='verify_email.php?id=".$_POST['email']."';";
					print "</script>"; 
					exit;
				}
			}else
			{
				$_SESSION['msg'] = "<div class='wrong'>You entered the wrong Security Code.</div>";
				print "<script>";
				print " self.location='register.php';";
				print "</script>"; 
				exit;
			}
			
		}else
		{
			$_SESSION['msg'] = "<div class='wrong'>Email already exists</div>";
			print "<script>";
			print " self.location='register.php';";
			print "</script>"; 
			exit;
		}
	}
?>