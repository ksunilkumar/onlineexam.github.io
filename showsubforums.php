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
	unset($_SESSION['fid']);
	$_SESSION['fid']=$_GET['fid'];
	$rec=$forum->get_active_subforums($_GET['fid'],$_SESSION['school_id']);
	
?>


<div id="showsubforums">
           <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr class="blue1px">
                <td width="247" height="32" align="center" valign="middle" background="images/blue1px.gif" bgcolor="#4FC5F3" class="paratext_body" ><strong class="para1">Sub Forum</strong></td>
                <td width="73" align="center" valign="middle" background="images/blue1px.gif" bgcolor="#4FC5F3" class="paratext" id="bdr_table"><strong>Topics</strong></td>
                <td width="73" align="center" valign="middle" background="images/blue1px.gif" bgcolor="#4FC5F3" class="paratext" id="bdr_table"><strong>Posts</strong></td>
                <td width="247" valign="middle" background="images/blue1px.gif" bgcolor="#4FC5F3" id="bdr_table"><strong class="para1">Posted On&nbsp;/&nbsp;By</strong></td>
              </tr>
              <?php  if(is_array($rec)){
           $limit=3;
				 $count=count($rec);
								$pages = (($count % $limit) == 0) ? $count / $limit : floor($count / $limit) + 1;
								if($_GET['page']!='')
								$page=$_GET['page'];
								else
								$page=1;
								$currentpage=$page;
								$start=(($page-1)*$limit);
								$end=($start+$limit);
								if($end>$count){
									$end=$count;
								}
							for($start;$start<$end;$start++){
							
							?> 
              <tr bgcolor="#F6F6F6">
                <td height="87" class="para1" id="bdr_table1"><a href="forums_inner_one.php?fid=<?=$rec[$start]['forum_id']?>" class="sidetextblue"><?=$rec[$start]['forum_name']?></a><br />
                   <?php echo substr($rec[$start]['forum_description'],0,200);?></td>
                <td align="center" valign="middle" class="paratext" id="bdr_table"><strong><?php echo $noofsubforums = $forum->totalNoOf_active_Subforums($rec[$start]['forum_id']);?></strong></td>
                <td align="center" valign="middle" class="paratext" id="bdr_table"><strong><?php echo $total=$forum->totalNoOf_active_Comments($rec[$start]['forum_id']);?></strong></td>
                <td bgcolor="#F6F6F6" class="para1" id="bdr_table_1"><strong class="sidetextblue"><?php $date=strtotime($rec[$start]['create_date']);echo date("d-m-y",$date)?> &nbsp;/&nbsp;</strong>
                    <strong><?php if($rec[$start]['createdby']==0){echo "Admin";} else{ $username=$user->user_name($rec[$start]['createdby']); print_r($username);}?></strong></td>
              </tr>
              <?php }}else{?>
          <tr>
            <td align="center"><div class="profile_info_text" align="center">No Forums Found</div></td>
          </tr>
          <?php }?>
            <tr>
        <td><div class="pagination"><?php echo ajax_pagination($pages,$page ,'showsubforums.php?fid='.$_GET['fid'],'showsubforums');?></div></td>
        </tr>   
            </table>
           
           
           
           </div>