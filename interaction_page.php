<?php
session_start();
 include_once 'lib/db.php';
 user_login_check();

 include_once 'lib/users_class.php';
 include_once 'lib/ise_settings.class.php';
 include_once 'lib/blogs_class.php';
 include_once 'lib/groups_class.php';
 
	$users = new Users();
	$blogs = new Blogs();
	$groups = new Groups();
	$settings = new ise_Settings();
	
	$aray_pagination = new aray_pagination;
	$myid=$_SESSION['user_id'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo Site_Title; ?></title>
<link rel="shortcut icon" href="favicon.png" type="image/x-icon" />

<!--CSS/Style Sheet Part Starting-->
<link rel="stylesheet" href="css/site_styles.css" />
<!--CSS/Style Sheet Part Ending-->

<!-- Javascript Part Starting-->

<!-- Javascript Part Ending-->
</head>

<body>
<?php include 'includes/light_box.php'; ?>

<!-- Main Table with 3 columns -->
<table width="947" border="0" align="center" cellpadding="0" cellspacing="0">
<!-- Header Row Content -->
<?php
include_once 'includes/header.php';
?>
<!-- Header Row Content -->

<!-- Breadcrum() -->
<tr><td colspan="3" align="left" style="padding:5px; background-image:url(images/sprite_01.jpg); background-repeat:repeat-x;">&nbsp;<?php breadcrum(); ?></td></tr>
<!-- Breadcrum()-->

<!-- Middle Row Content -->
<tr>
   <td colspan="3" bgcolor="#FFFFFF" class="sprite_padding_1">

    <table width="100%" border="0" cellspacing="0" cellpadding="0" height="200">
      <tr>
        <!-- Left Coloumn Code -->
        <td width="185" style="padding-left:0px; padding-right:0px;" valign="top"><?php include_once 'tab_02_templete.php'; ?><?php include_once 'tab_01_templete.php'; ?><?php include_once 'tab_03_templete.php'; ?></td>
        <!-- Center Coloumn Code -->
        <td width="*" style="padding-left:6px; padding-right:6px;" valign="top"><?php echo ucwords($_SESSION['msg']); if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
          <tr bgcolor="#F68122">
            <td width="6" style="background:url(images/sprite_05.jpg) left no-repeat;" height="27">&nbsp;</td>
            <td width="705" background="images/sprite_07.jpg" class="content_head" ><strong>Interaction Wall page</strong></td>
            <td width="6" style="background:url(images/sprite_06.jpg) right no-repeat;" height="27">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top" class="sprite_padding_1 main_box_border">
<!-- Wall Page Code -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="2%" height="17" valign="top"><img src="images/c.jpg" width="17" height="17" /></td>
														<td width="95%" height="17" background="images/c3.jpg" class="he"></td>
													  <td width="3%" valign="top"><img src="images/c4.jpg" width="17" height="17" /></td>
													</tr>
													<tr>
														<td background="images/c2.jpg">&nbsp;</td>
														<td height="300" valign="top" bgcolor="#FFFFFF">
<!-- Interaction wall page code starts here -->
<?php
	$i=0;
// Blogs
		$objSql = new SqlClass();
		$sql = "SELECT * FROM enm_comment WHERE blog_id in (".$blogs->get_user_blogs($myid).") and status='active'";
		$record = $objSql->executeSql($sql);
		while($row = $objSql->fetchRow($record))
		{

			$blog_obj = new SqlClass();
			$blog_info=$blog_obj->fetchRow($blog->get_blog_info($row['blog_id']));
			
			$j=$i++;
			$all_recds[$j]['id']=$j;
			$all_recds[$j]['type']='blog';
			$all_recds[$j]['type_id']=$row['blog_id'];
			$all_recds[$j]['name']=$blog_info['blog_title'];
			$all_recds[$j]['image']='';
			$all_recds[$j]['user_id']=$row['user_id'];
			$all_recds[$j]['comm_id']=$row['comment_id'];
			$all_recds[$j]['comm_desc']=$row['comment_des'];
			$all_recds[$j]['comm_date']=$row['create_date'];
		}


// Groups
		$objSql2 = new SqlClass();
		$sql2 = "SELECT * FROM enm_group_comms WHERE group_id in (".$group->get_user_groups($myid).") and status='active'";
		$record2 = $objSql2->executeSql($sql2);
		while($row2 = $objSql2->fetchRow($record2))
		{
			$group_obj = new SqlClass();
			$group_info=$group_obj->fetchRow($group->get_group_info($row2['group_id']));

			$j=$i++;
			$all_recds[$j]['id']=$j;
			$all_recds[$j]['type']='group';
			$all_recds[$j]['type_id']=$row2['group_id'];
			$all_recds[$j]['name']=$group_info['group_name'];
			$all_recds[$j]['image']=$group_info['group_image'];
			$all_recds[$j]['user_id']=$row2['userid'];
			$all_recds[$j]['comm_id']=$row2['id'];
			$all_recds[$j]['comm_desc']=$row2['comment'];
			$all_recds[$j]['comm_date']=$row2['created_date'];
		}

// Friends
	//	print_r(explode(',',$friend->get_my_frnd_list()));
		$objSql3 = new SqlClass();
		$sql3 = "SELECT * FROM enm_frnd_cmnts WHERE user_id in (".$friend->get_my_frnd_list().") or frnd_id in (".$friend->get_my_frnd_list().")";
		$record3 = $objSql3->executeSql($sql3);
		while($row3 = $objSql3->fetchRow($record3))
		{
			$user_obj = new SqlClass();
			$user_info=$user_obj->fetchRow($course->get_userdetails($row3['frnd_id']));

			$j=$i++;
			$all_recds[$j]['id']=$j;
			$all_recds[$j]['type']='friend';
			$all_recds[$j]['type_id']=$row3['user_id'];
			$all_recds[$j]['name']=$user_info['user_fname'].' '.$user_info['user_lname'];
			$all_recds[$j]['image']=$user_info['user_pic_add'];
			$all_recds[$j]['user_id']=$row3['user_id'];
			$all_recds[$j]['comm_id']=$row3['id'];
			$all_recds[$j]['comm_desc']=$row3['comment'];
			$all_recds[$j]['comm_date']=$row3['comnt_date'];
		}


// Questions

// First we need to get the details of classes which are i attended		
// getting list of courses or packages
		$objSql4 = new SqlClass();
		$curse_obj = new SqlClass();
		$sql4 = "SELECT  * FROM  enm_cart_schedule WHERE userid=".$myid." and status=1 order by date desc  ";
		$record4 = $objSql4->executeSql($sql4);
		
		$k=0;
		$pack_list=''; // list of packages
		$curse_lsit=''; // list of courses
		$ques_list=''; // lis of questions
		
		while($row4 = $objSql4->fetchRow($record4))
		{
			if($row4['package_id']!=0)
			{
				$course_package[$k]['id']=$row4['package_id'];
				$course_package[$k]['cart_id']=$row4['sessionid'];
				$course_package[$k]['name']=$course->display_package_name($row4['package_id']);
				$course_package[$k]['type']='package';
				$course_package[$k]['pic']='';

				if($pack_list=='')
					$pack_list.=$row4['package_id'];
				else
					$pack_list.=','.$row4['package_id'];
			}
			else
			{
				$curse = $all_coursers->course_all($row4['course_id']);
				$course_array= $curse_obj->fetchRow($curse);

				$course_package[$k]['id']=$row4['course_id'];
				$course_package[$k]['cart_id']=$row4['sessionid'];
				$course_package[$k]['name']=$course_array['course_name'];
				$course_package[$k]['type']='course';
				$course_package[$k]['pic']=$course_array['course_pic'];

				if($curse_list=='')
					$curse_list.=$row4['course_id'];
				else
					$curse_list.=','.$row4['course_id'];
			}
			$k++;
		}

// now getting list of question under that courses or packages which are i attended
		$objSql5 = new SqlClass();
		if($curse_list=='') $curse_list=0;
		if($pack_list=='') $pack_list=0;
		$sql5 = "SELECT  * FROM  enm_questions WHERE (course_type='course' and course_package_id in (".$curse_list.")) or (course_type='package' and course_package_id in (".$pack_list.")) order by added_on desc ";
		$record5 = $objSql5->executeSql($sql5);
		// echo 'No of Rows : '.$objSql5->getNumRecord();
		
		while($row5 = $objSql5->fetchRow($record5))
		{
			if($ques_list=='')
					$ques_list.=$row5['question_id'];
				else
					$ques_list.=','.$row5['question_id'];
					
			$ques_aray[$row5['question_id']]=$row5['question'];
			
			reset($course_package);
			for($c=0;$c<count($course_package);$c++)
			{
				if($course_package[$c]['type']==$row5['course_type'])
				{
					if($row5['course_package_id']==$course_package[$c]['id'])
					{
						$cp_name=$course_package[$c]['name'];
						$cart_id=$course_package[$c]['cart_id'];
						$cp_image=$course_package[$c]['pic'];
					}
				}
			}
			
			$user_obj = new SqlClass();
			$user_info=$user_obj->fetchRow($course->get_userdetails($row5['user_id']));

			$j=$i++;
			$all_recds[$j]['id']=$j;
			$all_recds[$j]['type']='question';
			$all_recds[$j]['type_id']=$row5['question_id'];
			$all_recds[$j]['name']=$cp_name;
			$all_recds[$j]['image']=$cp_image;
			$all_recds[$j]['user_id']=$row5['user_id'];
			$all_recds[$j]['comm_id']=$cart_id;
			$all_recds[$j]['comm_desc']=$row5['question'];
			$all_recds[$j]['comm_date']=$row5['added_on'];
		}


// Answers
		$objSql6 = new SqlClass();
		$sql6 = "SELECT * FROM enm_answers WHERE question_id in (".$ques_list.") ";
		$record6 = $objSql6->executeSql($sql6);
		while($row6 = $objSql6->fetchRow($record6))
		{
			$user_obj = new SqlClass();
			$user_info=$user_obj->fetchRow($course->get_userdetails($row6['answer_by']));

			$j=$i++;
			$all_recds[$j]['id']=$j;
			$all_recds[$j]['type']='answer';
			$all_recds[$j]['type_id']=$row6['question_id'];
			$all_recds[$j]['cart_id']=$row6['cart_id'];
			$all_recds[$j]['name']=$ques_aray[$row6['question_id']];
			$all_recds[$j]['image']='';
			$all_recds[$j]['user_id']=$row6['answer_by'];
			$all_recds[$j]['comm_id']=$row6['answer_id'];
			$all_recds[$j]['comm_desc']=$row6['answer'];
			$all_recds[$j]['comm_date']=$row6['added_on'];
		}


// function to sort the all records by using comment Date key
function subval_sort($a,$subkey) {
	foreach($a as $k=>$v) {
		$b[$k] = strtolower($v[$subkey]);
	}
	arsort($b);
	foreach($b as $key=>$val) {
		$c[] = $a[$key];
	}
	return $c;
}
$mail_recds = $all_recds;
if($all_recds!='')
$all_recds = subval_sort($all_recds,'comm_date');
else
echo 'No Comments Found.';
/*		echo '<pre>';
		print_r($all_recds);
		echo '</pre>';

*/
?>

<?php
        // $rec_limit=10;
		if (count($all_recds)) {
          // Parse through the pagination class
         $productPages = $aray_pagination->generate($all_recds, 5);
          // If we have items 
          if (count($productPages) != 0) {
            // Create the page numbers
            $pageNumbers = '<div >'.$aray_pagination->links().'</div>';
            // Loop through all the items in the array
            foreach ($productPages as $all_recs)
			{
					$uname=$user->user_name($all_recs['user_id']);
?>
               
								<?php
									if($all_recs['type']=='blog')
									{
										$title_url='blog_comment.php?blog_id='.$all_recs['type_id'];
										$reply='Post Comment';
										$avatar="images/blog.png";
									}
									else if($all_recs['type']=='group')
									{
										$title_url='pgps.php?gid='.$all_recs['type_id'];
										$reply='Post Comment';
										if($all_recs['image']!='' && file_exists("images/".$all_recs['image']))
											$avatar="images/".$all_recs['image'];
										else
											$avatar="images/group.png";

									}
									else if($all_recs['type']=='friend')
									{
										$title_url='fp.php?fid='.$all_recs['type_id'];
										$reply='Post Message';
										if($all_recs['image']!='' && file_exists("user_images/".$all_recs['image']))
											$avatar="user_images/".$all_recs['image'];
										else
											$avatar="images/friend.png";
									}
									else if($all_recs['type']=='question')
									{
										$title_url='view_question.php?cartid='.$all_recs['comm_id'];
										$reply='Post Answer';
										if($all_recs['image']!='' && file_exists("images/".$all_recs['image']))
											$avatar="images/".$all_recs['image'];
										else
											$avatar="images/question.png";
									}
									else if($all_recs['type']=='answer')
									{
										$title_url='view_answers.php?cartid='.$all_recs['cart_id'].'&qid='.$all_recs['type_id'];
										$reply='Give Reply';
										if($all_recs['image']!='' && file_exists("images/".$all_recs['image']))
											$avatar="images/".$all_recs['image'];
										else
											$avatar="images/answer.png";
									}
								?>
               
                <table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
                          <tr>
                            <td width="15%" rowspan="3" align="center" valign="top"><table width="100" border="0" cellspacing="0" cellpadding="0" style="float:left;">
                                <tr>
                                  <td width="3%" height="17" valign="top"><img src="images/c.jpg" width="17" height="17" /></td>
                                  <td width="94%" height="17" background="images/c3.jpg"></td>
                                  <td width="3%" valign="top"><img src="images/c4.jpg" width="17" height="17" /></td>
                                </tr>
                                <tr>
                                  <td background="images/c2.jpg">&nbsp;</td>
                                  <td height="60"  bgcolor="#FFFFFF" align="center" valign="middle"><img src="<?php echo $avatar; ?>" height="60" width="70" /></td>
                                  <td background="images/c5.jpg">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td valign="top"><img src="images/c1.jpg" width="17" height="19" /></td>
                                  <td height="19" background="images/c7.jpg"></td>
                                  <td><img src="images/c6.jpg" width="17" height="19" /></td>
                                </tr>
                              </table>                              <br /></td>
                          <td class="ftexts" style="padding-left:5px;" colspan="2"><strong>
								<?php echo '<a href="'.$title_url.'">'.$all_recs['name'].'</a>'; ?>
                            </strong></td>
                            <td class="texts" align="right">
                            <?php if(($all_recs['type']=='friend' || $all_recs['type']=='answer') && $all_recs['user_id']==$myid) {} else { ?><a href="javascript:revealModal123('modalPage2','<?php if($all_recs['type']=='friend') echo  $uname['user_fname'].' '.$uname['user_lname']; else echo $all_recs['name'];?>','<?php echo $all_recs['type'];?>','<?php echo $all_recs['type_id'];?>',<?php echo  $all_recs['id']; ?>)" class="ftexts"><?php echo $reply; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:send_this_mail(<?php echo $all_recs['id']; ?>);">Send to Mail</a><?php } ?></td>
                          </tr>
                          <tr>
                            <td colspan="3"  class="texts" style="padding-left:5px;"><div id="<?php echo $all_recs['type'].'_'.$all_recs['id'];?>"><?php echo nl2br($all_recs['comm_desc']); ?></div></td>
                            </tr>
                          <tr>
                            <td width="35%"  class="texts" style="padding-left:5px;"><strong>Posted On :</strong> <?php echo date("M jS, Y",strtotime($all_recs['comm_date']));?>&nbsp;&nbsp;&nbsp;</td>
                            <td class="texts"  width="20%"><strong>Posted In : </strong><?php echo ucfirst($all_recs['type']); ?></td>
                            <td width="30%"  class="texts" align="right">&nbsp;<strong>Posted By :</strong> <?php echo  $uname['user_fname'].' '.$uname['user_lname']; ?></td>
                          </tr>
                          <tr>
                            <td  colspan="4" background="images/d.jpg" style="background-repeat:repeat-x;" height="2">&nbsp;</td>
                          </tr>
                </table>

<?php			  // Show the information about the item
            }
            // print out the page numbers beneath the results
            echo $pageNumbers;
          }
        }
?>
<form action="" method="post" id="send_mail_form" name="send_mail_form">
<input name="aray_id" type="hidden" id="aray_id" value="" />
</form>

<?php
if(isset($_REQUEST['aray_id']) && $_REQUEST['aray_id']!='')
{
	$details=$mail_recds[$_REQUEST['aray_id']];
	$uname=$user->user_name($details['user_id']);
	if($$details['image']!='' && file_exists("images/".$details['image']))
		$img='<img src="images/'.$details['image'].'" width="60" height="40">'; 
	else if($details['type']=='blog')
		$img='<img src="images/blog.png" width="60" height="40">';
	else if($detailss['type']=='group')
		$img='<h2>Group</h2>'; 
	else if($details['type']=='friend')
		$img='<h2>Friend</h2>';
	else if($details['type']=='question')
		$img='<h2>Question</h2>';
	else if($details['type']=='answer')
		$img='<h2>Answer</h2>';
$message='<table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
                          <tr>
                            <td width="15%" rowspan="2" align="center" valign="top">'.$img.'</td>
                            <td class="texts"><strong>'.$details['name'].'</strong></td>
                            <td class="texts" align="right">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="2"  class="texts">'.nl2br($details['comm_desc']).'</td>
                            </tr>
                          <tr>
                            <td align="center"  class="texts"><strong>'.ucfirst($details['type']).'</strong></td>
                            <td width="38%"  class="texts">Posted On : '.$details['comm_date'].'</td>
                            <td width="47%"  class="texts">&nbsp;Posted By : '.$uname['user_fname'].' '.$uname['user_lname'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                          </tr>
                          <tr  background="images/d.jpg" style="background-repeat:repeat-x;">
                            <td align="center"  class="texts">&nbsp;</td>
                            <td  class="texts">&nbsp;</td>
                            <td  class="texts">&nbsp;</td>
                          </tr>
                </table>';
	
	if(sendMail('Admin', 'admin@robotutor.in', $uname['user_fname'], $_SESSION['user_email'], 'Interaction Page Details', addslashes($message)))
	{
		echo '<script>alert("Mail Sended Successfully"); location.href="'.$_SERVER['REQUEST_URI'].'"; </script>';
	}
	else
	{
		echo '<script>alert("'.$_SESSION['user_email'].'");  </script>';
		
	}

}

?>

</td>
														<td background="images/c5.jpg">&nbsp;</td>
													</tr>
													<tr>
														<td valign="top" background="images/c2.jpg">&nbsp;</td>
														<td height="19">&nbsp;&nbsp;&nbsp;</td>
													  <td background="images/c5.jpg">&nbsp;</td>
													</tr>
													<tr>
													  <td valign="top"><img src="images/c1.jpg" width="17" height="19" /></td>
													  <td height="19" background="images/c7.jpg"></td>
													  <td><img src="images/c6.jpg" width="17" height="19" /></td>
						  </tr>
					  </table>
<!-- Wall Page Code -->            
            </td>
          </tr>
        </table>
        </td>
        <!-- Right Coloumn Code -->
        <td width="0" style="padding-left:0px; padding-right:0px;" valign="top"></td>
      </tr>
    </table>

  </td>
</tr>
<!-- Middle Row Content -->

<!-- Footer Row Content -->
<?php
include_once 'includes/footer.php';
?>
<!-- Footer Row Content -->

</table>
<!-- Main Table Ending -->
</body>
</html>
