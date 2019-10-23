<?php 
	session_start();
	include_once '../../../lib/forums_class.php';
	include_once '../../../lib/settings_class.php';
	include_once '../../../lib/users_class.php';
	include_once '../../../lib/db.php';
	//admin_login_check();
	$settings = new Settings();
	$user=new Users();
	//$course = new Course();
	$objSql1 = new SqlClass();
	$objSql = new SqlClass();
	$forum = new Forums();
	$sql = "SELECT * FROM ttn_forum_comms WHERE f_c_id = '".$_GET['fid']."' ";
	$objSql = new SqlClass();
	$recore = $objSql->executeSql($sql);
	$row = $objSql->fetchRow($recore);
	
	
			
			
			
			
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Robotutor Admin Panel</title>
<link href="../images/style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../../script/calendar.js"></script>
<script language="javascript">
	var cal = new CalendarPopup();
	cal.showYearNavigation();
</script>
<script language="javascript" src="../../script/check.js"></script>

<script type="text/javascript" src="../../script/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" language="javascript">
function check(){
		/*if(!confirm('Are you sure you want to add the group?\n- to Add the Group, hit OK\n- otherwise, hit Cancel'))
		return false;*/
		//alert("hii");
		getForm("forumadd");
		if(!IsEmpty("txtcategory","Provide a valied Forum Name"))return false;
		if(!IsEmpty("selcategory","Please  Select a Category"))return false;
		//if(!IsEmpty("group_desc","Please Enter Description"))return false;
		
	}



</script>
</head>
<body>
	<?php include "../includes/header1.php";
include "../includes/shortcut_menu1.php";?>

<div id="content_wrapper"> 
		
			<ul class="first_level_tab"> 
				<li> 
					<a onclick="change_content('first_inner1')" class="active" id="first_link1"> 
						Forum Comments
					</a> 
				</li> 
			
				
			</ul>	
			<br class="clear"/> 
			

			
				
				 <div class="onecolumn" > 
				
				<div class="header"> 
					<div class="description"> 
						 
					</div> 
					
					<!-- Begin 2nd level tab --> 
					
					<!-- End 2nd level tab --> 
					
				</div> 
				 
            
            <div class="content nomargin" > 
					
					<table width="100%" border="0" cellpadding="3" cellspacing="1" align="center">
                  									
									                  <tr>
										                  <td width="42%" height="24" align="right" ><label>Comment</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><?= $row['f_c_desc']?></td>
										              </tr>
                                                       <tr>
										                  <td width="42%" height="24" align="right" ><label>Rating</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><?= $row['f_com_rating']?></td>
										              </tr>
                                                      <tr>
										                  <td width="42%" height="24" align="right" ><label>Commented By</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><?php $username=$user->user_name($row['user_id']); echo $username['user_fname'].' '.$username['user_lname']?></td>
										              </tr>
									                  <tr>
									                    <td height="24" align="right" ><label>Status</label></td>
									                    <td>:</td>
									                    <td><?= $row['status']?>
															
														</td>
								                      </tr>
													  <tr>
													  	<td colspan="3" align="center">
											            	
												            <input type="button" name="back" value="Back" onClick="history.go(-1)" id="back" class="button_light"></td>
													  </tr>
													</table>
                                                    
					<!-- End example table data --> 
					
					
					<!-- Begin pagination --> 
					
					<!-- End pagination --> 
					
					<br class="clear"/> 
                    
				
				</div>
                </div>
			
            
            
            
            
            
            
		</div>
        <?php include "../includes/footer.php";?>