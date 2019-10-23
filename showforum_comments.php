<?php
	session_start();
	ob_start();
	include_once 'lib/forums_class.php';
	include_once 'lib/users_class.php';
 	include_once 'lib/ise_settings.class.php';
	include_once 'lib/db.php';
	$forum = new Forums();
	$settings = new ise_Settings();
	$objSql = new SqlClass(); 
	$objSql1 = new SqlClass(); 
	$forum_info = $forum->get_fourm_info($_GET['fid'],$_SESSION['school_id']);
	
	$user=new Users();
	user_login_check();	  
	
	
	$row=$forum->forum_comments($_GET['fid']);

?>




<div id="showcomments">
           <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr class="blue1px">
                <td width="247" height="32" align="center" valign="middle" background="images/blue1px.gif" bgcolor="#4FC5F3" class="paratext_body" colspan="2" ><strong class="para1">Comments</strong></td>
               
              </tr>
               <?php 
			$limit1=5;
			
			if(is_array($row)){
			$count1=count($row);
				 
								$pages1= (($count1 % $limit1) == 0) ? $count1/ $limit1 : floor($count1 / $limit1) + 1;
								
								if($_GET['page']!='')
								$page1=$_GET['page'];
								else
								$page1=1;
								$currentpage1=$page1;
								$start1=(($page1-1)*$limit1);
								$end1=($start1+$limit1);
								if($end1>$count1){
									$end1=$count1;
								}
							for($start1;$start1<$end1;$start1++){
							 $users=$user->user_values($row[$start1]['user_id']);
							 
						if(!empty($users['user_pic_add']) && file_exists("user_images/".$users['user_pic_add'])){
						$image=$users['user_pic_add']; }
						else {
						$image='no_image.png';
						}
						$name=$users['user_fname']; 
							
									
									?>
									
                            <tr class="blue1px">
             <td width="15%" align="center" valign="top" style="padding:5px;"><img src="user_images/<?=$image?>" width="65" height="65" /></td>
                <td width="85%"><strong>Comented by</strong> <strong class="font_10_group"><?=$name;?></strong><br />
                 <?php echo $row[$start1]['f_c_desc'];?><br />
                  <strong class="font_10_group"><?php echo $row[$start1]['create_date'];?></strong><br /></td>
            </tr>
            <tr>
                <td colspan="2" align="left" valign="top"><span class="table_padding_02" >-----------------------------------------------------------------------------------------------------------------------------------</span></td>
                </tr>
            <?php } }else{?>
              <tr>
                <td bgcolor="#f1f2f2" colspan="2" align="center" valign="top"><div class="profile_info_text" align="center">No Comments Found</div></td>
              </tr>
             
              <?php }?>
          <tr>
                <td bgcolor="#f1f2f2" colspan="2" align="left" valign="top"><div class="pagination"><?php echo ajax_pagination($pages1,$page1 ,'showforum_comments.php?fid='.$_GET['fid'],'showcomments');?></div></td>
              </tr>
          
        </table>
           </div>