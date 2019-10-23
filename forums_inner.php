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
	
	if(isset($_POST['comments2']))
	{	
		if($_POST['comments2'] == '')
		{
		 	$_SESSION['errmsg'] = "<font size='3' class='wrong'>Please enter Comments....";
		}
		else
		{
			$tab1 = array("forum_id=".$_GET['fid']."","f_com_rating=".$_POST['rating']."","f_c_desc =".$_POST['comments2']."","user_id=".$_SESSION['user_id']."","status=inactive");
			$sub_val = $forum->forum_comms_insert($tab1);	
			if($sub_val) $_SESSION['errmsg'] = "<font size='3' class='success'>Comments posted successfully</font>";			
		}
	}
	elseif(isset($_POST['mainid']))
	{
		
		$sq = "SELECT forum_id FROM ise_forums WHERE forum_name = '".$_POST['txtcategory']."' AND forum_state='".$forum_info['forum_id']."'  AND forum_category='".$forum_info['forum_category']."' ";
		//echo $sq;exit;
		$recor = $objSql1->executeSql($sq);
		$row13 = $objSql1->fetchRow($recor);
		if(empty($row13['forum_id']))
		{
		//echo "hii";exit;
			$sql1 = "INSERT INTO ise_forums(forum_name,forum_category, forum_description, forum_state, school_id, createdby, status)
					VALUES ( '".addslashes($_POST['txtcategory'])."','".$forum_info['forum_category']."','".addslashes($_POST['forum_desc'])."','".$_POST['mainid']."','".$_SESSION['school_id']."','".$_SESSION['user_id']."',  'inactive')";
			//echo $sql1;exit;	
			$val = $objSql->executeSql($sql1);
			$_SESSION['errmsg'] = "<font class='success'>Sub Forum Added Successfully. Request has been sent to Admin</font>";
			
		}else
		{
			$_SESSION['errmsg'] = "<font class='wrong'>Sub Forum Name Already Exist</font>";	
		}
	}
	$row=$forum->forum_comments($_GET['fid']);

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
<script src="js/check.js"></script>
<script type="text/javascript">
function div_visible(){
//alert("hi");
		if(document.getElementById('addcomments').style.display=='none'){
		//
		document.getElementById('addcomments').style.display='block';
		document.getElementById('addsubforum').style.display='none';
		document.getElementById('printresult').style.display='none';
		}else{
		//alert("hi");
		document.getElementById('addcomments').style.display='none';
		}
}
function subforum_div_visible(){
//alert("hi");
		if(document.getElementById('addsubforum').style.display=='none'){
		//
		document.getElementById('addsubforum').style.display='block';
		document.getElementById('printresult').style.display='none';
		document.getElementById('addcomments').style.display='none';
		
		}else{
		//alert("hi");
		document.getElementById('addsubforum').style.display='none';
		}
}
function check()
{
			//alert("hii");
			getForm("CommentsForm");
			var flag=0;
			for(var i=0; i < document.CommentsForm.rating.length; i++){
			if(document.CommentsForm.rating[i].checked)
			flag=1;
			}
			if(flag==0){
			alert("Please select Rating");return false;
			}
			if(!IsEmpty("comments2","Please Enter Comments"))return false;
}
function checksubforums()
{
			//alert("hii");
			getForm("subForumForm");
			
			if(!IsEmpty("txtcategory","Please Enter SubForum Name"))return false;
			if(!IsEmpty("forum_desc","Please Enter Description"))return false;
}


/*function paging(id,div,url)
	{
		//alert(div);
		xmlhttp=GetXmlHttpObject();
		 
		if (xmlhttp==null)
		  {
			  alert ("Browser does not support HTTP Request");
			  return;
		  }
 		var url=url+"?page="+id;
		//alert(url);  
		xmlhttp.onreadystatechange=function()
    	{
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				//alert(xmlhttp.responseText);
				document.getElementById(div).innerHTML=xmlhttp.responseText;
			}
		}
		 
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
		return false;
	}
	function GetXmlHttpObject()
    {
        if (window.XMLHttpRequest)
        {
          return new XMLHttpRequest();
        }
        if (window.ActiveXObject)
        {
          return new ActiveXObject("Microsoft.XMLHTTP");
        }
        return null;
    }
	
*/

</script> 
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
        <td width="185" style="padding-left:0px; padding-right:0px;" valign="top"><?php include_once 'tab_01_templete.php'; ?><?php include_once 'tab_03_templete.php'; ?></td>
        <!-- Center Coloumn Code -->
        <td width="*" style="padding-left:6px; padding-right:6px;" valign="top">
        
        <?php echo ucwords($_SESSION['msg']); if(!empty($_SESSION['msg']))unset($_SESSION['msg']);?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="0%" ><img src="images/sprite_05.jpg" width="6" height="27" /></td>
            <td width="100%" background="images/sprite_07.jpg" class="content_head" ><strong><?= $forum_info['forum_name']?></strong></td>
            <td width="0%" align="right" ><img src="images/sprite_06.jpg" width="6" height="27" /></td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top" class="sprite_padding_1 main_box_border">
           <strong><?= $forum_info['forum_description']?></strong><br /><br />
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
           
           
           <br />
           <img src="images/add_comments.png" onclick="return div_visible();" style="cursor:pointer">&nbsp;&nbsp;<img src="images/add_sub_forums.png" onclick="return subforum_div_visible();" style="cursor:pointer"/>
           
           <div id="addcomments" style="display:none; "> <br /></br />
           <form name="CommentsForm" method="post" action="" onsubmit="return check();">
        <table width="100%"  class="coments_border"  align="center" border="0" cellspacing="0" cellpadding="2" height="200">
        
          <tr class='blue1px'>
            <td bgcolor="#4FC5F3" width="1%" align="left" valign="top" background="images/blue1px.gif">&nbsp;</td>
            <td bgcolor="#4FC5F3" height="20" colspan="3" background="images/blue1px.gif"><span  class="font_4"><strong class="para1">Rate this form</strong></span></td>
            <td bgcolor="#4FC5F3" height="20" colspan="2" align="right" valign="top" background="images/blue1px.gif">&nbsp;</td>
            </tr>
          <tr height="50">
            <td rowspan="2">&nbsp;</td>
            <td width="21%" height="10">
              <input type="radio" name="rating" id="rating" value="Excellent" />
              <label for="radio">Excellent</label></td>
             <td width="17%" height="10">
              <input type="radio" name="rating" id="rating" value="Good" />
              Good</td>
             <td height="10" colspan="2">&nbsp;</td>
             <td width="56%" height="10" valign="middle"><span class="font_10_group">Comments</span></td>
              </tr>
          <tr height="50">
            <td align="left" valign="top"><input type="radio" name="rating" id="rating" value="Average" />
              Average</td>
            <td valign="top"><input type="radio" name="rating" id="rating" value="Poor" />
              Poor</td>
            <td colspan="2" valign="top">&nbsp;</td>
            <td align="left" valign="top"><textarea name="comments2" cols="40" rows="2" coloums="80"></textarea></td>
            </tr>
          <tr>
            <td height="10" align="left">&nbsp;</td>
            <td height="10" align="left">&nbsp;</td>
            <td height="10" align="left">&nbsp;</td>
            <td height="10" colspan="2" align="left">&nbsp;</td>
            <td height="10" align="left"><span class="font_10_group"><input type="image" src="images/submit.jpg"   /></span></td>
            </tr>
         
      
        </table></form></div>
          <div id="addsubforum" style="display:none; "> <br /></br />
           <form name="subForumForm" method="post" action="" onsubmit="return checksubforums();">
        <table width="100%"  class="coments_border"  align="center" border="0" cellspacing="0" cellpadding="2" height="200">
        
          <tr class='blue1px'>
            <td bgcolor="#4FC5F3" width="1%" align="left" valign="top"   height="20" background="images/blue1px.gif"><span  class="font_4"><strong class="para1">Add Sub Forum</strong></span></td>
            <td bgcolor="#4FC5F3" height="20"  background="images/blue1px.gif">&nbsp;</td>
            <td bgcolor="#4FC5F3" height="20"  align="right" valign="top" background="images/blue1px.gif">&nbsp;</td>
            </tr>
          <tr>
										                  <td width="42%" height="24" align="right"><label>Forum Name</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><input type="text" value="<?php echo $row['forum_name'];?>" name="txtcategory" id="text_input1" class="text_input1" size="35" maxlength="100"/>
                                                          <input type="hidden" value="<?php echo $_GET['fid'];?>" name="mainid" id="text_input1" class="text_input1" size="35" maxlength="100"/>
                                                          </td>
										              </tr>
                                                      <!-- <tr>
										                  <td width="42%" height="24" align="right" ><label>Forum Category</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><?php echo $settings->get_groups_dropdown($row['forum_category']);?></td>
										              </tr>-->
                                                      <tr>
										                  <td width="42%" height="24" align="right" ><label>Forum Description</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><textarea   rows="6" cols="30" name="forum_desc" ><?php if(!empty($_POST)) {echo $_POST['forum_desc'];}else{echo $row['forum_description'];}?></textarea></td>
										              </tr>
									                  
				<tr>								 
            <td height="10" align="left">&nbsp;</td>
            <td height="10" align="left">&nbsp;</td>
           
           
            <td height="10" align="left"><span class="font_10_group"><input type="image" src="images/submit.jpg"   /></span></td>
            </tr>
         
      
        </table></form></div>
        <br /><br />
        <div id="printresult" style="display:block"><?php if($_SESSION['errmsg']){echo $_SESSION['errmsg']; unset($_SESSION['errmsg']);}?></div>
           <!--Comments -->
           <br />  <br />
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
            <?php }?>
				<tr>
                <td bgcolor="#f1f2f2" colspan="2" align="left" valign="top"><div class="pagination"><?php echo ajax_pagination($pages,$page ,'showforum_comments.php?fid='.$_GET['fid'],'showcomments');?></div></td>
              </tr><?php }else{?>
              <tr>
                <td bgcolor="#f1f2f2" colspan="2" align="center" valign="top"><div class="profile_info_text" align="center">No Comments Found</div></td>
              </tr>
             
              <?php }?>
          
          
        </table>
           </div>
        </td>
        <!-- Right Coloumn Code -->
        
      </tr>
    </table>

  </td>
</tr>
</table>
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
