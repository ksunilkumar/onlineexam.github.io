<?

/*
function perPage(){
		return 5;
	}*/
	
	
	class NewsletterUsers
	{
	
	function display_newsletterusers($page,$order,$al,$school_id)
		{
			 $sql="SELECT * FROM qse_newsletter_users ";
			
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			//echo $sql; exit;	
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function totalNoOfNewsletterusers($al,$school_id)
		{
			 $sql="SELECT * FROM qse_newsletter_users ";
				//echo $sql;
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}	

	
	}
	
	class Newsletter
	{
	
	function display_newsletters($page,$order,$al,$school_id)
		{
			 $sql="SELECT * FROM qse_newsletters ";
			
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			//echo $sql; exit;	
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function totalNoOfNewsletters($al,$school_id)
		{
			 $sql="SELECT * FROM qse_newsletters ";
				//echo $sql;
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}	

	
	}
class Tefeedback
{

function display_tefeedback1($page,$order,$al,$school_id)
		{
			 $sql="SELECT * FROM school_feedback  where school_id=$school_id";
			if($al != '.')
				$sql.=" and feedback_name LIKE '".$al."%' ";
			
			/*if($order == '0')$sql.= "ORDER BY first_name";elseif($order == '1')$sql.= "ORDER BY first_name DESC";
			
			elseif($order == '4')$sql.= "ORDER BY create_date";elseif($order == '5')$sql.= "ORDER BY create_date DESC";
			elseif($order == '6')$sql.= "ORDER BY status";elseif($order == '7')$sql.= "ORDER BY status DESC";*/
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			//echo $sql; exit;	
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function totalNoOfTefeedback1($al,$school_id)
		{
			 $sql="SELECT * FROM school_feedback where school_id=$school_id";
			if($al != '.')
				$sql.=" and feedback_name LIKE '".$al."%' ";
				//echo $sql;
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}	


}





	
class Tutors{
function display_tutors($page,$al,$order)
{
$sql = "SELECT * FROM sis_employee where designation='Teacher' and school_id='".$_SESSION['school_id']."' ";
if($al != '.')
$sql.=" AND firstname LIKE '".$al."%' ";
//$sql.=" ORDER BY doj desc";
/*if($order == '0')$sql.= "ORDER BY first_name";elseif($order == '1')$sql.= "ORDER BY first_name DESC";

elseif($order == '4')$sql.= "ORDER BY create_date";elseif($order == '5')$sql.= "ORDER BY create_date DESC";
elseif($order == '6')$sql.= "ORDER BY status";elseif($order == '7')$sql.= "ORDER BY status DESC";*/
$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();

//echo $sql; //exit;

$objSql = new SqlClass();
$record = $objSql->executeSql($sql);
return $record;
}
function totalNoOfTutors($val)
{
$sql = "SELECT * FROM sis_employee where designation='Teacher' and school_id='".$_SESSION['school_id']."'";
if($val!=".")
$sql.= " and firstname LIKE '".$val."%'";
//echo $sql; exit;
$objSql = new SqlClass();
$arr=$objSql->executeSql($sql);
if(is_array($arr))
return count($arr);
else
return 0;
}

}

class ads
{
		function display_ads($page,$order,$al,$school_id)
		{
			 $sql= "SELECT * FROM ads  ";
			if($al != '.')
				$sql.=" where ad_link LIKE '".$al."%'";
			$sql.= "ORDER BY ad_id LIMIT ".($page-1)*perPage()." , ".perPage();
			//echo $sql; exit;	
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		
		function totalNoOfads($al,$school_id)
		{
			 $sql= "SELECT * FROM ads  ";
			if($al != '.')
				$sql.=" where ad_link LIKE '".$al."%' ORDER BY ad_id";
		
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}		
		
}
class image
{
function display_image($page,$order,$al,$school_id)
		{
			 $sql= "SELECT * FROM scroll_image ";
			if($al != '.')
				$sql.=" where link LIKE '".$al."%' ";
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			//echo $sql; exit;	
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function totalNoOfimages($al,$school_id)
		{
			 $sql= "SELECT * FROM scroll_image  ";
			if($al != '.')
				$sql.=" where link LIKE '".$al."%' ";
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}	
}	

class text
{
function display_text($page,$order,$al,$school_id)
		{
			 $sql="SELECT * FROM scroll_text";
			if($al != '.')
				$sql.=" where scroll_text LIKE '".$al."%' ";
			
			/*if($order == '0')$sql.= "ORDER BY first_name";elseif($order == '1')$sql.= "ORDER BY first_name DESC";
			
			elseif($order == '4')$sql.= "ORDER BY create_date";elseif($order == '5')$sql.= "ORDER BY create_date DESC";
			elseif($order == '6')$sql.= "ORDER BY status";elseif($order == '7')$sql.= "ORDER BY status DESC";*/
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			//echo $sql; exit;	
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function totalNoOftext($al,$school_id)
		{
			 $sql="SELECT * FROM scroll_text";
			if($al != '.')
				$sql.=" where scroll_text LIKE '".$al."%' ";
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}	
}
class teachers
{
function display_teacher($page,$order,$al,$school_id)
{
	
	 $sql= "SELECT * FROM qatar_online_class where school_id=$school_id";
	 if(($_GET['teach_id']=='0')||($_GET['teach_id']==''))
	 $sql.= " ";
	 else if($_GET['teach_id']!='')
	 $sql.= " and teacher_id ='".$_GET['teach_id']."' ";
			if($al != '.')
				$sql.=" and title LIKE '".$al."%' ";
			
			/*if($order == '0')$sql.= "ORDER BY first_name";elseif($order == '1')$sql.= "ORDER BY first_name DESC";
			
			elseif($order == '4')$sql.= "ORDER BY create_date";elseif($order == '5')$sql.= "ORDER BY create_date DESC";
			elseif($order == '6')$sql.= "ORDER BY status";elseif($order == '7')$sql.= "ORDER BY status DESC";*/
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			//echo $sql; //exit;	
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
			}
			
			function totalNoOfteacher($al,$school_id)
		{
			    $sql= "SELECT * FROM qatar_online_class where school_id=$school_id";
	               if(($_GET['teach_id']=='0')||($_GET['teach_id']==''))
	               $sql.= " ";
	               else if($_GET['teach_id']!='')
	             $sql.= " and teacher_id ='".$_GET['teach_id']."' ";
			if($al != '.')
				$sql.=" and title LIKE '".$al."%' ";
			//echo $sql; exit;
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}	
		}
class members
{
		function display_members($page,$order)
		{
			 $sql="SELECT * FROM qatar_class_members WHERE online_cid=".$_GET['c_id']." ORDER By create_date";
		
			/*if($order == '0')$sql.= "ORDER BY first_name";elseif($order == '1')$sql.= "ORDER BY first_name DESC";
			
			elseif($order == '4')$sql.= "ORDER BY create_date";elseif($order == '5')$sql.= "ORDER BY create_date DESC";
			elseif($order == '6')$sql.= "ORDER BY status";elseif($order == '7')$sql.= "ORDER BY status DESC";*/
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			//echo $sql; //exit;	
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function display_members_all($c_id)
		{
			 $sql="SELECT * FROM qatar_class_members WHERE online_cid=".$c_id." ORDER By create_date";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
			
			function totalNoOfmembers()
		{
			    $sql="SELECT * FROM qatar_class_members WHERE online_cid=".$_GET['c_id']." ORDER By create_date";
			
			
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}	
		}
class comments
{
		function display_comments($page,$order)
		{
			 $sql="SELECT * FROM qatar_class_comments WHERE online_cid =".$_GET['c_id']." ORDER By create_date";
		
			/*if($order == '0')$sql.= "ORDER BY first_name";elseif($order == '1')$sql.= "ORDER BY first_name DESC";
			
			elseif($order == '4')$sql.= "ORDER BY create_date";elseif($order == '5')$sql.= "ORDER BY create_date DESC";
			elseif($order == '6')$sql.= "ORDER BY status";elseif($order == '7')$sql.= "ORDER BY status DESC";*/
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			//echo $sql; //exit;	
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
			}
			function display_comments_all($id)
			{
				 $sql="SELECT * FROM qatar_class_comments WHERE online_cid =".$id." ORDER By create_date";
			
				$objSql = new SqlClass();
				$record = $objSql->executeSql($sql);
				return $record;
			}
			function totalNoOfcomments()
		{
			    $sql="SELECT * FROM qatar_class_comments WHERE online_cid =".$_GET['c_id']." ORDER By create_date";
			
			
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}
		}
		class feedback1
{
function display_feedback1($page,$order,$al,$school_id)
		{
			 $sql="SELECT * FROM feedback ";
			if($al != '.')
				$sql.=" where fb_message  LIKE '".$al."%' ";
			
			/*if($order == '0')$sql.= "ORDER BY first_name";elseif($order == '1')$sql.= "ORDER BY first_name DESC";
			
			elseif($order == '4')$sql.= "ORDER BY create_date";elseif($order == '5')$sql.= "ORDER BY create_date DESC";
			elseif($order == '6')$sql.= "ORDER BY status";elseif($order == '7')$sql.= "ORDER BY status DESC";*/
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			//echo $sql; exit;	
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function totalNoOffeedback1($al,$school_id)
		{
			 $sql="SELECT * FROM feedback ";
			if($al != '.')
				$sql.=" where fb_message  LIKE '".$al."%' ";
				
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}	
}	
class contact
{
function display_contact($page,$order,$al)
		{
			 $sql="SELECT * FROM contactus ";
			if($al != '.')
				$sql.=" where e_mail   LIKE '".$al."%' ";
			
			/*if($order == '0')$sql.= "ORDER BY first_name";elseif($order == '1')$sql.= "ORDER BY first_name DESC";
			
			elseif($order == '4')$sql.= "ORDER BY create_date";elseif($order == '5')$sql.= "ORDER BY create_date DESC";
			elseif($order == '6')$sql.= "ORDER BY status";elseif($order == '7')$sql.= "ORDER BY status DESC";*/
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			//echo $sql; exit;	
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function totalNoOfcontact($al)
		{
			 $sql="SELECT * FROM contactus ";
			if($al != '.')
				$sql.=" where fb_message  LIKE '".$al."%' ";
				
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}	
}	
class video
{
function display_video($page,$order,$al,$school_id='')
		{
			 $sql="SELECT * FROM videos ";
			if($al != '.')
				$sql.="  where video_title  LIKE '".$al."%' ";
			
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			//echo $sql; exit;	
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function totalNoOfvideo($al,$school_id='')
		{
			 $sql="SELECT * FROM videos  ";
			if($al != '.')
				$sql.=" where video_title  LIKE '".$al."%' ";
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}	
}	
class skoolinfo
{
function display_skoolinfo($page,$order,$al)
{
     $sql= "SELECT * FROM qse_school_info  "; 		
		if($al != '.')
				$sql.=" WHERE Title   LIKE '".$al."%' ";
		$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			//echo $sql; exit;	
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
}
function totalNoOfskoolinfo($al)
		{
			$sql= "SELECT * FROM qse_school_info  "; 
			if($al != '.')
				$sql.=" WHERE Title   LIKE '".$al."%' ";
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}
}
class school
{
function display_school($page,$order,$al)
{
 $sql= "SELECT * FROM ise_schools ";
 if($al != '.')
				$sql.=" WHERE school_name   LIKE '".$al."%' ";
 $sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			//echo $sql; //exit;	
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function  totalNoOfschool($al)
	{
	
	 $sql= "SELECT * FROM ise_schools ";
		if($al != '.')
				$sql.=" WHERE school_name   LIKE '".$al."%' ";	
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
	}
}
class keys
{
function display_keys($page,$order)
{
 $sql= "SELECT * FROM qse_keys ORDER BY keyId DESC";
 
 $sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			//echo $sql; //exit;	
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function  totalNoOfkeys()
	{
	
	$sql= "SELECT * FROM qse_keys ORDER BY keyId DESC";
			
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
	}
}
class group
{
function display_group($page,$order,$al)
{
 $sql= "SELECT * FROM groups where school_id=".$_SESSION['school_id']." ";
 if($al != '.')
				$sql.=" and group_name   LIKE '".$al."%' ";	
 $sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			//echo $sql; exit;	
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function  totalNoOfgroup($al='')
	{
	
	$sql= "SELECT * FROM groups where school_id=".$_SESSION['school_id']."  ";
		if($al != '.')
				$sql.=" and  group_name LIKE '".$al."%' ";		
								
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
	}
}
class grp_mem
{
function display_grp_mem($page,$order)
{
	 $sql= "SELECT * FROM group_members WHERE group_id =".$_REQUEST['id']." ORDER BY user_add_date  ";
 
 $sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			//echo $sql; //exit;	
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function  totalNoOfgrp_mem()
	{
	
	$sql= "SELECT * FROM group_members WHERE group_id =".$_REQUEST['id']." ORDER BY user_add_date  ";
			
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
	}
}
class grp_pic
{
function display_grp_pic($page,$order)
{
	 $sql= "SELECT * FROM group_photos WHERE group_id =".$_REQUEST['id']." ORDER BY uploaded_date";
	 
 $sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			//echo $sql; //exit;	
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function  totalNoOfgrp_pic()
	{
	
	 $sql= "SELECT * FROM group_photos WHERE group_id =".$_REQUEST['id']." ORDER BY uploaded_date";
			
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
	}
}
class grp_evnts
{
function display_grp_evnts($page,$order)
{
	 $sql="SELECT * FROM group_events WHERE group_id =".$_REQUEST['id']." ORDER BY event_date desc ";

	 
 $sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			//echo $sql; //exit;	
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function  totalNoOfgrp_evnts()
	{
	
	  $sql="SELECT * FROM group_events WHERE group_id =".$_REQUEST['id']." ORDER BY event_date desc ";
			
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
	}
}
class grp_posts
{
	function display_grp_posts($page,$order)
	{
	 $sql="SELECT * FROM group_posts WHERE group_id =".$_REQUEST['id']." ORDER BY posted_date";
		$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			//echo $sql; //exit;	
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function display_grp_posts_all($id)
	{
	 $sql="SELECT * FROM group_posts WHERE group_id =".$id." ORDER BY posted_date";
		//echo $sql;exit;	
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function  totalNoOfgrp_posts()
	{
	
	  $sql="SELECT * FROM group_posts WHERE group_id =".$_REQUEST['id']." ORDER BY posted_date";
			
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
	}
}
 	
	class category
{
	function display_categtory($page,$order,$al)
	{
	 $sql= "SELECT * FROM category where school_id=".$_SESSION['school_id']."  ";
	 if($al != '.')
				$sql.=" and cat_name   LIKE '".$al."%' ";	
	 $sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			//echo $sql; //exit;	
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
	}
	function  totalNoOfcategory($al)
	{
	
	 $sql= "SELECT * FROM category where school_id=".$_SESSION['school_id']."  ";
		if($al != '.')
				$sql.=" and cat_name   LIKE '".$al."%' ";		
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
	}
}
class Professor
{
		function get_user_stateid($userid){
			$sql="select state,country from ml_professors where user_id=$userid";
			$objSql = new SqlClass();
			$recore = $objSql->executeSql($sql);
			return $recore;
		}
		function display_users($page,$al,$order,$school_id='')
		{
			 $sql = "SELECT * FROM ise_users ";
			 if($school_id!='')
			 	$sql.=" where school='".$school_id."' ";
			 if($al != '.' && $school_id!='')
				$sql.=" AND user_fname LIKE '".$al."%' ";
			 if($al != '.' && $school_id=='')
			 	$sql.=" Where user_fname LIKE '".$al."%' ";
				
			/*if($order == '0')$sql.= "ORDER BY first_name";elseif($order == '1')$sql.= "ORDER BY first_name DESC";
			
			elseif($order == '4')$sql.= "ORDER BY create_date";elseif($order == '5')$sql.= "ORDER BY create_date DESC";
			elseif($order == '6')$sql.= "ORDER BY status";elseif($order == '7')$sql.= "ORDER BY status DESC";*/
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			//echo $sql; //exit;	
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function checktutor($user)
		{
		
		 $sql="select Email from enm_tutor_submitteddetails where Email='".$user."'";
		$objSql = new SqlClass();
		$res=$objSql->executeSql($sql);
		
		
			if(is_array($res))
			{
				return "EmailId already exists";
			} 
			else {
				return "Available";
			}
		}
		function user_values($val)
		{
			$sql = "SELECT * FROM ml_professors WHERE id = ".$val;
			$objSql = new SqlClass();
			$recore = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($recore);
			return $row;
		}
		function user_name($val)
		{
			$sql = "SELECT user_fname,user_lname FROM ml_professors WHERE user_id = ".$val;
			$objSql = new SqlClass();
			$recore = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($recore);
			return $row;
		}
		function search_user($val)
		{
			$sql = "SELECT * FROM ml_professors WHERE user_fname LIKE '%".$val."%' OR user_lname  LIKE '%".$val."%' OR user_email LIKE '%".$val."%'";
			$objSql = new SqlClass();
			$recore = $objSql->executeSql($sql);
			return $recore;
		}
	
		function totalNoOfUsers($val)
		{
			$sql = "SELECT id FROM sis_students where school_id='".$_SESSION['school_id']."'";
			if($val!=".")
			$sql.= " WHERE first_name LIKE '".$val."%'";
			
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}
		function totalNoOfusercount($val,$school_id)
		{
				$sql = "SELECT * FROM ise_users";
			if($school_id!='')
			 	$sql.=" where school='".$school_id."' ";
			 if($val != '.' && $school_id!='')
				$sql.=" AND user_fname LIKE '".$al."%' ";
			 if($val != '.' && $school_id=='')
			 	$sql.=" Where user_fname LIKE '".$al."%' ";
		
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}	
		function checkuser($user)
		{
		 $sql="select username from ml_professors where username='".$user."'";
		$objSql = new SqlClass();
		$res=$objSql->executeSql($sql);
		if(is_array($res))
		{
		return "Username already exists";
		} else {
		return "Available";
		}
		}
}
class Blog
	{
		function get_catname($id)
		{
			$sql = "SELECT cat_id,cat_name FROM category WHERE  cat_id = ".$id;
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			
			return $row['cat_name'];
		}
		function totalNoOfBlogcomms($id,$al)
		{
			$sql	= "SELECT * FROM blog_review WHERE blog_id='".$id."'";
			if($al != '.')
				$sql.=" and review_desc LIKE '".$al."%'";	 
				//echo $sql;
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}
		 
		function display_blog_comms($page,$al,$val,$id)
		{
			
			 $sql	= "SELECT * FROM blog_review WHERE blog_id='".$id."' ";
			
			if($al != '.')
				$sql.=" and review_desc LIKE '".$al."%'";
			
			
			/*if($val == '0')$sql.= "ORDER BY blog_title";elseif($val == '1')$sql.= "ORDER BY blog_title DESC";
			elseif($val == '2')$sql.= "ORDER BY status";elseif($val == '3')$sql.= "ORDER BY status DESC";
			else $sql.= "ORDER BY blog_title";*/
			$sql.=" LIMIT ".($page-1)*perPage()." , ".perPage();
		
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function totalblogs()
		{
			
			$sql	= "SELECT * FROM blogs  where school_id='".$_SESSION['school_id'] ."' ";

			$objSql = new SqlClass();
			$record1 = $objSql->executeSql($sql);
			return $record1; 
		}
		function get_blog_info($id){
			$sql="select * from ml_blogs where blog_id=$id";
			$objSql = new SqlClass();
			$record1 = $objSql->executeSql($sql);
			return $record1;
		}
		function get_blogs_active(){
			$sql="SELECT blog_id, blog_title FROM ml_blogs where status='active'";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			while($row1 = $objSql->fetchRow($record))
			{
			$row[] = $row1;
			}
			return $row;
		}
		function display_blog($page,$al,$val)
		{
			
			//$query	= "SELECT * FROM blogs  where school_id=".$_SESSION['school_id'] ." ORDER BY blog_title";
			$sql	= "SELECT * FROM blogs  where school_id='".$_SESSION['school_id'] ."' ";


			
			if($al != '.')
				$sql.=" and blog_title LIKE '".$al."%'";
			
			
			if($val == '0')$sql.= "ORDER BY blog_title";elseif($val == '1')$sql.= "ORDER BY blog_title DESC";
			elseif($val == '2')$sql.= "ORDER BY status";elseif($val == '3')$sql.= "ORDER BY status DESC";
			else $sql.= "ORDER BY blog_title";
			$sql.=" LIMIT ".($page-1)*perPage()." , ".perPage();
			//echo $sql;
			//exit;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function blog_values($val1,$val2)
		{
			$sql = "SELECT blog_id, blog_title, blod_description, user_id, status,create_date FROM ml_blogs where status='active'";
			if($val1!='')
			$sql.=" WHERE user_id = ".$val1;
			elseif($val2!='')
			$sql.=" WHERE blog_id = ".$val2;
			elseif(($val1!='')&&($val2!=''))
			$sql.=" WHERE user_id = ".$val1." AND blog_id = ".$val2;
			$sql.=" ORDER BY create_date DESC";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function blog_values_one($val1)
		{
			$sql = "SELECT blog_id, blog_title, blod_description, user_id, status,create_date FROM ml_blogs";
			if($val1!='')
			$sql.=" WHERE blog_id = ".$val1;
			else
			$sql.=" ORDER BY create_date LIMIT 1";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			//$row = $objSql->fetchRow($record);
			return $record;
		}
		function blog_comments($val1)
		{
			 $sql = "SELECT * FROM blog_review WHERE blog_id = ".$val1." ORDER BY create_date";
			
			$objSql11 = new SqlClass();
			$record = $objSql11->executeSql($sql);
			return $record;
		}
		function blog_limit()
		{
			$sql = "SELECT blog_id, blog_title, blod_description, user_id, status,create_date FROM ml_blogs ORDER BY create_date LIMIT 3";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			//$row = $objSql->fetchRow($record);
			return $record;
		}
		function comment_count($val)
		{
			$sql = "SELECT count(*) as count FROM ml_comment WHERE blog_id = ".$val;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			return $row;
		}
		function user_first_blog($val)
		{
			$sql = "SELECT create_date, blog_id  FROM ml_blogs WHERE user_id = ".$val." ORDER BY create_date LIMIT 1";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			return $row;
		}
		function user_final_blog($val)
		{
			$sql = "SELECT create_date, blog_id  FROM ml_blogs WHERE user_id = ".$val." ORDER BY create_date DESC LIMIT 1";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			return $row;
		}
		function resent_blog()
		{
			$sql = "SELECT create_date, blog_id  FROM ml_blogs ORDER BY create_date DESC LIMIT 1";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			return $row;
		}
		function totalNoOfBlogs($val)
		{
				$sql	= "SELECT * FROM blogs  where school_id='".$_SESSION['school_id'] ."' ";

			if($val!=".")
				$sql.= " and blog_title LIKE '".$val."%'";
				
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}
	}
	
	class Forums{
	function display_subforum_comms($page,$val,$al,$id)
		{
			$sql = "SELECT f_c_id,f_topic_id,f_c_desc,user_id,create_date,status FROM forum_comms where f_topic_id = ".$id;
			if($val!="." && $val!="#")
				$sql.= " AND f_c_desc LIKE '".$val."%'";
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			//echo $sql; 
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
	
	function totalNoOfforumcomms($id,$val)
		{
			$sql = "SELECT f_c_id,f_topic_id,f_c_desc,user_id,create_date,status FROM forum_comms where f_topic_id = ".$id;


			if($val!="." && $val!="#")
				$sql.= " AND f_c_desc LIKE '".$val."%'";
			//echo $sql;
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}
function display_forums($page,$al,$val)
		{
		  $sql= "SELECT * FROM forums WHERE forum_state='0' and school_id=".$_SESSION['school_id']." ";
		  /*
	      $pagination_qatar->createPaging($query,10);
			$sql = "SELECT forum_id,forum_title, forum_desc, cat_id, forum_state, status FROM ml_forums where forum_state=0 ";
			*/
				if($al!=" " && $al!="#")
				$sql.=" and forum_title LIKE '".$al."%' AND forum_state='0'";
		//	if($val == '0')$sql.= "ORDER BY forum_title";elseif($val == '1')$sql.= "ORDER BY forum_title DESC";
			/*elseif($val == '2')$sql.= "ORDER BY cat_id";elseif($val == '3')$sql.= "ORDER BY cat_id DESC";
			//elseif($val == '4')$sql.= "ORDER BY group_owner";elseif($val == '5')$sql.= "ORDER BY group_owner DESC";
			elseif($val == '6')$sql.= "ORDER BY status";elseif($val == '7')$sql.= "ORDER BY status DESC";*/
			//else $sql.= "ORDER BY forum_title";
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			//echo $sql;exit;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function display_subforums($id,$page,$val,$al)
		{
			$sql = "SELECT forum_id,forum_title, forum_desc, cat_id, forum_state, status FROM forums where forum_state=".$id." ";
			if($al != ' ' && $al != '#')
				$sql.=" and forum_title LIKE '".$al."%'";
			//echo $sql;
			if($val == '0')$sql.= "ORDER BY forum_title";elseif($val == '1')$sql.= "ORDER BY forum_title DESC";
			elseif($val == '2')$sql.= "ORDER BY cat_id";elseif($val == '3')$sql.= "ORDER BY cat_id DESC";
			//elseif($val == '4')$sql.= "ORDER BY group_owner";elseif($val == '5')$sql.= "ORDER BY group_owner DESC";
			elseif($val == '6')$sql.= "ORDER BY status";elseif($val == '7')$sql.= "ORDER BY status DESC";
			else $sql.= "ORDER BY forum_title";
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			//echo $sql; exit;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function totalNoOfforums($val,$id)
		{
			$sql = "SELECT * FROM forums WHERE forum_state=".$id." and school_id=".$_SESSION['school_id'];

			if($val!=" " && $val!="#")
				$sql.= " AND forum_title LIKE '".$val."%'";
			//echo $sql;
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}
		function totalNoOfComments($val,$id)
		{
			$sql = "SELECT * FROM forum_comms WHERE forum_id=".$id;

			if($val!=".")
				$sql.= " AND forum_title LIKE '".$val."%'";

			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}
		function forum_cat_disp($val)
		{
			$sql = "SELECT cat_id,cat_name FROM category WHERE  cat_id = ".$val;
			//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			//echo $row['category_name'];exit;
			return $row['cat_name'];
		}
		function forum_cat_disp_one($val)
		{
			$query="select cat_id from forums where forum_id=$val ";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($query);
			$row = $objSql->fetchRow($record);
			$sql = "SELECT cat_id,cat_name FROM category WHERE  cat_id = ".$row['cat_id'];
			//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			//echo $row['category_name'];exit;
			return $row['cat_name'];
		}
		function forum_comment_count($val)
		{
			$sql = "SELECT count(*) as count FROM ml_forum_comms WHERE forum_id = ".$val;
			//echo $sql;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			return $row;
		}
		
		function subforums($val){
		$sql = "SELECT forum_id,forum_title, forum_desc, cat_id, forum_state, status FROM ml_forums where forum_state=".$val." ";
		//echo $sql;
		$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		
		function forum_comments($val1)
		{
			$sql = "SELECT forum_id,f_c_desc, user_id, create_date and status FROM ml_forum_comms WHERE forum_id = ".$val1." and status='active' ORDER BY create_date desc";
			$objSql11 = new SqlClass();
			$record = $objSql11->executeSql($sql);
			return $record;
		}
		function forum_values_one($val1)
		{
			$sql = "SELECT forum_id, forum_title, forum_desc, status,create_date FROM ml_forums";
			if($val1!='')
			$sql.=" WHERE forum_id = ".$val1;
			else
			$sql.=" ORDER BY create_date LIMIT 1";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			//$row = $objSql->fetchRow($record);
			return $record;
		}
		
		function display_forum_comments($id,$page,$val,$al)
		{
			$sql = "SELECT f_c_id,f_topic_id,f_c_desc, user_id, create_date,status FROM ml_forum_comms WHERE f_topic_id = ".$id." ";
			if($al != '.')
				$sql.=" WHERE f_c_desc LIKE '".$al."%'";
			
			$sql.= "ORDER BY create_date desc";
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			//echo $sql; exit;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		
		function forum_comment_user($val)
		{
			$sql = "SELECT user_fname,user_lname FROM enm_users WHERE user_id = ".$val;
			//echo $sql;exit;
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($record);
			//echo $row['category_name'];exit;
			return $row['user_fname'].' '.$row['user_lname'];
		}
		
		
	}
	class News
	{
		function display_news($page,$al,$val)
		{
			//$sql = "SELECT news_id, news_title, status,create_date FROM ml_news ";
			
			
			
			
			 $sql= "SELECT * FROM news ";
			 
			if($al != ' ' && $al!='#')	
				$sql.=" where news_title LIKE '".$al."%'";
			
			if($val == '0')$sql.= "ORDER BY news_title";elseif($val == '1')$sql.= "ORDER BY news_title DESC";
			elseif($val == '2')$sql.= "ORDER BY status";elseif($val == '3')$sql.= "ORDER BY status DESC";
			else $sql.= "ORDER BY news_title";
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function news_values($val)
		{
			$sql = "SELECT * FROM ml_news WHERE news_id = ".$val;
			$objSql = new SqlClass();
			$recore = $objSql->executeSql($sql);
			$row = $objSql->fetchRow($recore);
			return $row;
		}
		function news_values_limit()
		{
			$sql = "SELECT * FROM ml_news ORDER BY create_date DESC LIMIT 5";
			$objSql = new SqlClass();
			$recore = $objSql->executeSql($sql);
			return $recore;
		}
		function news_display_all()
		{
			$sql = "SELECT * FROM ml_news ORDER BY create_date DESC";
			$objSql = new SqlClass();
			$recore = $objSql->executeSql($sql);
			return $recore;
		}
		function totalNoOfNews($val)
		{
			 $sql= "SELECT * FROM news ";
			
			if($val != ' ' && $val!='#')
				$sql.=" where news_title LIKE '".$val."%' ";

			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}
		
}
class Polls
{

		function display_polls($page,$al,$val)
		{
			 $sql= "SELECT * FROM polls where school_id= ".$_SESSION['school_id']." ";
			if($al != ' ' && $al!='#')
				$sql.=" and poll_title LIKE '".$al."%'";

			if($val == '0')$sql.= "ORDER BY poll_title";elseif($val == '1')$sql.= "ORDER BY poll_title DESC";
			elseif($val == '2')$sql.= "ORDER BY status";elseif($val == '3')$sql.= "ORDER BY status DESC";
			else $sql.= "ORDER BY poll_title";
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function totalNoOfPolls($val)
		{
			$sql= "SELECT * FROM polls where school_id= ".$_SESSION['school_id']." ";
				if($val != ' ' && $val!='#')
				$sql.=" and poll_title LIKE '".$val."%' ";

			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}

}
class Careers
{

		function display_careers($page,$al,$val)
		{
			
			$sql= "SELECT * FROM career ";
			if($al != ' ' && $al!='#')
				$sql.=" WHERE career_name LIKE '".$al."%'";
			
		/*	if($val == '0')$sql.= "ORDER BY career_name";elseif($val == '1')$sql.= "ORDER BY career_name DESC";
			elseif($val == '2')$sql.= "ORDER BY status";elseif($val == '3')$sql.= "ORDER BY status DESC";
			else $sql.= "ORDER BY career_name";*/
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function totalNoOfcareers($val)
		{
			 $sql = "SELECT * FROM career ";
			
				if($val != ' ' && $val!='#')
				$sql.=" WHERE career_name LIKE '".$val."%' ";

			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}

}
class Faqs
{

		function display_faqs($page,$al,$val)
		{
			
			$sql= "SELECT * FROM faqs ";

			
				if($al != ' ' && $al!='#')
				$sql.=" where faq_question LIKE '".$al."%'";
			
			/*if($val == '0')$sql.= "ORDER BY career_name";elseif($val == '1')$sql.= "ORDER BY career_name DESC";
			elseif($val == '2')$sql.= "ORDER BY status";elseif($val == '3')$sql.= "ORDER BY status DESC";
			else $sql.= "ORDER BY career_name";*/
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			//echo $sql;
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function totalNoOfFaqs($val)
		{
			$sql= "SELECT * FROM faqs ";
				if($val != ' ' && $val!='#')
				$sql.=" where faq_question LIKE '".$val."%' ";
			
			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}

}
class Tecourse
{
		function display_courses($page,$al,$val,$school_id)
		{
			
			
			$sql = "select * from test_course where school_id=$school_id "; 
			
			/*if($al != '.')
				$sql.=" and career_name LIKE '".$al."%'";
			
			if($val == '0')$sql.= "ORDER BY career_name";elseif($val == '1')$sql.= "ORDER BY career_name DESC";
			elseif($val == '2')$sql.= "ORDER BY status";elseif($val == '3')$sql.= "ORDER BY status DESC";
			else $sql.= "ORDER BY career_name";
			*/
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function totalNoOfcourses($school_id)
		{
			$sql = "select * from test_course where school_id=$school_id "; 
			
			/*if($val != '.')
				$sql.=" WHERE career_name LIKE '".$val."%' ";*/

			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}



}	
class Techapters
{
	function display_chapters($page,$al,$val,$school_id,$cid)
		{
			
			
			if($cid!="")
			$sql="select * from test_chapters where school_id=$school_id and course_id in(select course_id from test_course where grade_id =$cid) ORDER BY chap_id";
			else
			$sql="select * from test_chapters where school_id=$school_id ORDER BY chap_id";
									/*if($al != '.')
				$sql.=" and career_name LIKE '".$al."%'";
			
			if($val == '0')$sql.= "ORDER BY career_name";elseif($val == '1')$sql.= "ORDER BY career_name DESC";
			elseif($val == '2')$sql.= "ORDER BY status";elseif($val == '3')$sql.= "ORDER BY status DESC";
			else $sql.= "ORDER BY career_name";
			*/
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
function totalNoOfchapters($school_id,$cid)
		{
			//$sql="select * from test_chapters where course_id = ".$value." and school_id=$school_id";
			
			if($cid!="")
			$sql="select * from test_chapters where school_id=$school_id and course_id in(select course_id from test_course where grade_id =$cid) ORDER BY chap_id";
			else
			$sql="select * from test_chapters where school_id=$school_id ORDER BY chap_id";
			/*if($val != '.')
				$sql.=" WHERE career_name LIKE '".$val."%' ";*/

			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}

}
class Tecurriculum
{
	function display_curs($page,$val,$al)
		{
			
			
			
			$sql="select * from test_curriculum ";
			if($al!= '.')
				$sql.=" WHERE cur_name LIKE '".$al."%' ";
			/*if($val == '0')$sql.= "ORDER BY cur_name";elseif($val == '1')$sql.= "ORDER BY cur_name DESC";
			elseif($val == '2')$sql.= "ORDER BY status";elseif($val == '3')$sql.= "ORDER BY status DESC";
			else $sql.= "ORDER BY cur_name";*/
			
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
function totalNoOfcurs($al)
		{
			
			$sql="select * from test_curriculum ";
			if($al != '.')
				$sql.=" WHERE cur_name LIKE '".$al."%' ";

			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}

}
class Tesubjects
{
	function display_subjs($page,$al,$val)
		{
			
			
			
		
			$sql = "select * from test_subject "; 
			if($al != '.')
				$sql.=" where sub_name LIKE '".$al."%'";
						
			/*if($val == '0')$sql.= "ORDER BY cur_name";elseif($val == '1')$sql.= "ORDER BY cur_name DESC";
			elseif($val == '2')$sql.= "ORDER BY status";elseif($val == '3')$sql.= "ORDER BY status DESC";
			else $sql.= "ORDER BY cur_name";*/
			
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			//echo $sql; exit;
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
function totalNoOfsubjs($school_id,$al)
		{
			//$sql="select * from test_chapters where course_id = ".$value." and school_id=$school_id";
			
			$sql = "select * from test_subject "; 
			if($al != '.')
				$sql.=" where sub_name LIKE '".$al."%' ";

			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}

}
class country{
	function display_country($page,$al)
		{
			$sql = "select * from ise_country  "; 
			if($al != '.')
				$sql.=" where country_name LIKE '".$al."%'";
				
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			//echo $sql; exit;
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function totalNoOfcountry($al)
		{
			$sql = "select * from ise_country "; 
			if($al != '.')
				$sql.=" where  country_name LIKE '".$al."%' ";

			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}
		function country_insert($array){
			 $query=new Queries();
			return  $query->makeinsertquery('ise_country',$array);
		}
		function country_update_function($array,$where)
		{
			 $query=new Queries();
			return $query->makeupdatequery('ise_country',$array,$where);
		}
		function country_delete($field,$value)
		{
			$query=new Queries();
			return $query->makedeletequery('ise_country',$field,$value);

		}
		function country_select_one($id){
			$sql="select * from ise_country where country_id=$id";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		
		}
		 function get_country1($countryid='')
	{
	$dropdown='<select name="countryid1" id="countryid1" onchange="return getUserDetails1(\'getcountry1.php\',\'formnewuser\',\'statediv1\',this.value);">';
				$dropdown.='<option value="">--Select Country--</option>';
			 $sql="select country_id,country_name from ise_country ";
				$this->objSql1 = new SqlClass();
		
				$res=$this->objSql1->executesql($sql);
				if(is_array($res)){
				foreach($res as $result){
				if($countryid==$result['country_id']){ $select='selected';} else { $select=''; }
                $dropdown.='<option value="'.$result['country_id'].'"'.$select .'>'.$result['country_name'].'</option>';
				}}
				$dropdown.= "</select>";
				return $dropdown;
				
	}

}
class state{
	function display_state($page,$al)
		{
			$sql = "select * from ise_state  "; 
			if($al != '.')
				$sql.=" where stat_name LIKE '".$al."%'";
			
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			//echo $sql; exit;
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function totalNoOfstate($al)
		{
			$sql = "select * from ise_state "; 
			if($al != '.')
				$sql.=" where  stat_name LIKE '".$al."%' ";

			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}
		function state_insert($array){
			 $query=new Queries();
			return  $query->makeinsertquery('ise_state',$array);
		}
		function state_update_function($array,$where)
		{
			 $query=new Queries();
			return $query->makeupdatequery('ise_state',$array,$where);
		}
		function state_delete($field,$value)
		{
			$query=new Queries();
			return $query->makedeletequery('ise_state',$field,$value);

		}
		function state_select_one($id){
			$sql="select * from ise_state where stat_id=$id";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		
		}
		function get_state1($countryid,$stateid='')
	{
		$sql="select stat_id,stat_name from ise_state where country_id=".$countryid;
		$dropdown='<select name="stateid1" id="stateid1" onchange="return getUserDetails1(\'getcity1.php\',\'formnewuser\',\'citydiv1\',this.value);">';
				$dropdown.='<option value="">--Select State--</option>';
				 
				$this->objSql1 = new SqlClass();
		
				$res=$this->objSql1->executesql($sql);
				if(is_array($res)){
				foreach($res as $result){
				if($stateid==$result['stat_id']){ $select='selected';} else { $select=''; }
                $dropdown.='<option value="'.$result['stat_id'].'"'.$select .'>'.$result['stat_name'].'</option>';
				}}
				$dropdown.= "</select>";
				return $dropdown;
	}

}
class city{
	function display_city($page,$al)
		{
			$sql = "select * from ise_city  "; 
			if($al != '.')
				$sql.=" where city_name LIKE '".$al."%'";
				
			$sql.= " LIMIT ".($page-1)*perPage()." , ".perPage();
			//echo $sql; exit;
			
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		}
		function totalNoOfcity($al)
		{
			$sql = "select * from ise_city "; 
			if($al != '.')
				$sql.=" where  city_name LIKE '".$al."%' ";

			$objSql = new SqlClass();
			$arr=$objSql->executeSql($sql);
			if(is_array($arr))
			return count($arr);
			else
			return 0;
		}
		function city_insert($array){
			 $query=new Queries();
			return  $query->makeinsertquery('ise_city',$array);
		}
		function city_update_function($array,$where)
		{
			 $query=new Queries();
			return $query->makeupdatequery('ise_city',$array,$where);
		}
		function  city_delete($field,$value)
		{
			$query=new Queries();
			return $query->makedeletequery('ise_city',$field,$value);

		}
		function city_select_one($id){
			$sql="select * from ise_city where city_id=$id";
			$objSql = new SqlClass();
			$record = $objSql->executeSql($sql);
			return $record;
		
		}

}
?>