<?php ob_start();
session_start();
	//include_once '../../../lib/functions.php';
	include_once '../../../lib/forums_class.php';
	include_once '../../../lib/settings_class.php';
	include_once '../../../lib/users_class.php';
	include_once '../../../lib/db.php';
include "../includes/header1.php";
include "../includes/shortcut_menu1.php";
$objSql1 = new SqlClass();
	//admin_login_check();
	$forum = new Forums();
	$user=new Users();
$settings = new Settings();
$objSql = new SqlClass(); 		

$al=".";
	if(!empty($_REQUEST['al']))
	{
		$al = $_REQUEST['al'];
	}

	if(empty($_REQUEST['page'])){
		$page=1;
	}else{
		$page=$_REQUEST['page'];
	}
	if(empty($_REQUEST['order'])){
		$order=0;
	}else{
		$order=$_REQUEST['order'];
	}	
	

	
	
	$rec = $forum->display_forum_comments($_GET['id'],$page,$al,$order);
	$totalEntries=$forum->totalNoOfComments($al,$_GET['id']);
	//echo $totalEntries;exit;
	$maxPages=ceil($totalEntries/perPage());
?>
<script>
function change_content(div)
 {

 	if(div=="first_inner1")
	{
	document.getElementById('first_inner1').style.display="block";
	document.getElementById('first_inner2').style.display="none";

	document.getElementById("first_link1").setAttribute("class", "active");
	document.getElementById("first_link2").setAttribute("class", "active1");
	
	}
	else if(div=="first_inner2")
	{
	document.getElementById('first_inner1').style.display="none";
	document.getElementById('first_inner2').style.display="block";

	document.getElementById("first_link1").setAttribute("class", "active1");
	document.getElementById("first_link2").setAttribute("class", "active");
	
	}

 
 }
 
 
 
 function check(){
		/*if(!confirm('Are you sure you want to add the group?\n- to Add the Group, hit OK\n- otherwise, hit Cancel'))
		return false;*/
	
		getForm("forumadd");
		if(!IsEmpty("txtcategory","Provide a valid Forum Name"))return false;
		if(!IsEmpty("selcategory","Please  Select a Category"))return false;
		//if(!IsEmpty("group_desc","Please Enter Description"))return false;
		
	}
	function showPage(pageNumber)
	{
		document.getElementById("pageNumber").value=pageNumber;
		document.getElementById("pageSelectionForm").submit();
		return true;
	}
	function CheckAll(chk)
	{
	   //alert("hi");
	   var num=document.forumselectionForm.elements.length;
	   for(i=0;i<num;i++)
	   {
			tmp=document.forumselectionForm.elements[i];
			//alert(document.packages.elements[i].name);
			if(tmp.type=="checkbox" && !(tmp.name=="allChk"))
			{
				tmp.checked=chk.checked;
			}
		}
	}
	
	function doselect1()
	{
		dml1=document.forumselectionForm;
		len1 = dml1.elements.length;
		//alert(len1);
		var j=0;
		var val12='';
		select_status=0;
		for( j=0 ; j<len1 ; j++)
		 {
			if (dml1.elements[j].name=='Mid[]')
			 {
					if((dml1.elements[j].checked))
					{
						if(select_status!=0)
							val12=val12+",";
						select_status=1;
						val12=val12+dml1.elements[j].id;
					}
			}
		}
		if(select_status==0)
		{
			alert("Select atleast one record");
			return false;
		}
		if(!confirm('Are you sure you want to delete the records?\n- to Delete the records, hit OK\n- otherwise, hit Cancel'))
			return false;
			//alert("alert12");
		document.forumselectionForm.delet.value=val12;
		//alert(val12);
		document.forumselectionForm.submit();
		return true;
	}
	
	function confirmation(){
	//alert("hi");
	if(!confirm('Are you sure you want to delete the record?\n- to Delete the records, hit OK\n- otherwise, hit Cancel'))
			return false;
	}
	
	function export1()
	{
		dml1=document.forumselectionForm;
		len1 = dml1.elements.length;
		//alert(len1);
		var j=0;
		var val12='';
		select_status=0;
		for( j=0 ; j<len1 ; j++)
		 {
			if (dml1.elements[j].name=='Mid[]')
			 {
					if((dml1.elements[j].checked))
					{
						if(select_status!=0)
							val12=val12+",";
						select_status=1;
						val12=val12+dml1.elements[j].id;
						//alert(val12);
					}
			}
		}
		if(select_status==0)
		{
			 if(!confirm('You are not selected any record, you want to export the all records?\n- to Export All Records, hit OK\n- otherwise, hit Cancel'))
				return false;

		}
		else
		{
		    if(!confirm('Are you sure you want to Export the Selected Records?\n- to Export the Records, hit OK\n- otherwise, hit Cancel'))
			 return false;
		}
		//alfa = document.groupselectionForm.al.value;
		//alert(alfa);
		//alert(val12);
		location.href='export_comments.php?exprt='+val12;
		return true;
	}

	
 </script>

<div id="content_wrapper"> 
		
			<!-- Begin one column box --> 
			<ul class="first_level_tab"> 
				<li> 
					<a onClick="change_content('first_inner1')" class="active" id="first_link1"> 
						Manage Comments
					</a> 
				</li> 
				
                <li> 
					<a onClick="history.go(-1)" id="first_link2" class="active1"> 
						Back to Forums
					</a> 
				</li> 
				
			</ul>	
			<!-- End 1st level tab --> 
			
			<br class="clear"/> 
			
			<!-- Begin one column box --> 
            
			<div class="onecolumn" id="first_inner1" style="display:block;"> 
				<form name="forumselectionForm" method="post" action="delete_forum_comments.php"> 
		         <div class="header"> 
					<div class="description"> 
						<!--Page data description goes here... sectetur adipiscing onsectetur adipiscing-->
                        <?php include_once"paging1.php"; display_pag("../forums/forums_comments.php?id=".$_GET['id']."");?>
					</div> 
					
					<!-- Begin 2nd level tab --> 
                   
					<ul class="second_level_tab"> 
						<li> 
							<input type="submit" name="sub3" value="Delete" class="button_light" onClick="doselect1(); return false;" />
						</li> 
						<!--<li> 
							<input type="button" name="sub2" value="Export" class="button_light" onClick="export1(); return false;" />
						</li> -->
                       
					</ul> 
                        
					
					
				</div> 
				
				<div class="content nomargin" > 
					
					<!-- Begin example table data --> 
					<table width="100%" cellpadding="0" cellspacing="0" class="global"> 
                   
		  <thead> 
          
          <tr>                  <th style="width:10px"> </th>
                                <th style="width:30%"></th> 
						    	<th  colspan="4" align="center"> 
						    	
             <?php if($_SESSION['msg']){?> <?php echo $_SESSION['msg']; unset($_SESSION['msg']);?><?php }?>
				<?php if(isset($_REQUEST['filename'])){?>
                                                	 <span class="alert_success">Your Export Completed Successfully, click here <a href="../exports/<?php echo $_REQUEST['filename']; ?>"><img src="../images/download.gif" alt="" width="30" height="24" border="0" align="absmiddle" /></a> to Download </span>
                                                <?php }?> 
               
						    	</th> 
						    	
						    </tr> 
                            
                             <tr>                 
						    	<td  colspan="6" align="center"> 
						    	<b><?php $forumname = $forum->forum_values_one($_GET['id']); echo $forumname['0']['forum_name'];?> &nbsp;&nbsp Comments</b>
                                      
               
						    	</td> 
						    	
						    </tr> 
          
						    <tr> 
						    	<th style="width:10px"> 
						    		<input type="checkbox" id="check_all" name="check_all" value="ON" onClick="CheckAll(this);"/> 
						    	</th> 
						    	<th style="width:30%">Comment</th> 
                                <th style="width:10%">Rating</th> 
						    	<th style="width:25%">Commented By</th> 
                               
						    	<th style="width:10%">Status</th> 
						    	<th style="width:20%">Optitons</th> 
						    </tr> 
						</thead> 
                        <tbody> 
						<? if (is_array($rec)) {
						
						
															$val=0;
															while($row = $objSql1->fetchRow($rec))
															{
																
													  ?>
													  <tr class="row_white">
										                  <td style="width:10px"><input  type="checkbox" name="Mid[]" id="<?php echo $row['f_c_id'];?>" value="642" class="input2" /></td>
														  <td align="left"><?php echo $row['f_c_desc'];?></td>
                                                          <td align="left"><?php echo $row['f_com_rating'];?></td>
														  <td align="left"><?php $username=$user->user_name($row['user_id']); echo $username['user_fname'].' '.$username['user_lname']?></td>
														 
										                  <td align="left"><a href="delete_forum_comments.php?<?php if(!empty($_REQUEST['al'])){echo "al=".$_REQUEST['al']."&";} ?>fid=<?php echo $row['f_c_id']?>&state=<?php echo $row['status'];?>&page=<?php echo $page; ?>&order=<?php echo $order;?>"><?php echo  $row['status'];?></a></td> 
                                                          <td> 
						    		<a href="comment_view.php?fid=<?php echo $row['f_c_id'];?>&page=<?php echo $page; ?>&order=<?php echo $order;?>&mainid=<?php echo $_GET['id'];?>" ><img src="../images/icon_edit.png" alt="edit" class="help" title="Edit"/></a> 
						    		<a href="delete_forum_comments.php?delete_one=<?php echo $row['f_c_id']?>&page=<?php echo $page; ?>" onClick="return confirmation()"><img src="../images/icon_delete.png" alt="delete" class="help" title="Delete"/></a> 
						    	</td> 
									                  </tr>
													  <?php 
													 }
													 ?>
                        <?php }else{?>
                        <tr> 
						    	<td colspan="5" align="center"> No Forums found</td> 
						    		
						    </tr> 
                            <?php }?>
                            </tbody>
                            <input type="hidden" name="send" /><input type="hidden" name="delet"><input type="hidden" name="send_status" />
                           
					 </table> 
		      <!-- End example table data --> 
					
					
					<!-- Begin pagination --> 
				
						<?php include 'PageNation.php';?>
					
					<!-- End pagination --> 
					
					<br class="clear"/> 
                    
				
				</div>
                
                
                
   </form>
				
			</div>
            
            
            
            
            <div class="onecolumn" id="first_inner2" style="display:none;"> 
				
				<div class="header"> 
					<div class="description"> 
						<?php if($_SESSION['already_exist']){?> 
                      <table width="1200">
                        <tr>
                          <td align="center"> 
						 <?php echo $_SESSION['already_exist']; unset($_SESSION['already_exist']);?>
                         </td>
                         </tr>
                       </table>
                       <?php }?>
					</div> 
					
					<!-- Begin 2nd level tab --> 
					
					<!-- End 2nd level tab --> 
					
				</div> 
				 
            
            <div class="content nomargin" > 
					
					<table width="100%" border="0" cellpadding="3" cellspacing="1" align="center">
                  	<form name="forumadd" method="post" action="" onSubmit="return check();">									
									                  <tr>
										                  <td width="42%" height="24" align="right" ><label>Forum Name</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><input type="text" value="<?php if(!empty($_POST)){echo $_POST['txtcategory'];}?>" name="txtcategory" id="text_input1" class="text_input1" size="35" maxlength="100"/>
                                                          <input type="hidden" value="<?=$_GET['id']?>" name="id" id="text_input1" class="text_input1" size="35" maxlength="100"/>
                                                          </td>
										              </tr>
                                                       <tr>
										                  <td width="42%" height="24" align="right" ><label>Forum Category</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><?php echo $settings->category_dropdown();?></td>
										              </tr>
                                                      <tr>
										                  <td width="42%" height="24" align="right" ><label>Forum Description</label></td>
														  <td width="2%">:</td>
														  <td width="56%"><textarea   rows="6" cols="30" name="blog_desc" ><?php if(!empty($_POST)) {echo $_POST['blog_desc'];}else{echo $row['forum_desc'];}?></textarea></td>
										              </tr>
									                  <tr>
									                    <td height="24" align="right" ><label>Status</label></td>
									                    <td>:</td>
									                    <td>
															<select name="status" id="status">
																<option <?php if((!empty($_POST))&&($_POST['status'] == 'active')){echo 'selected';}?> value="active">Active</option>
																<option <?php if((!empty($_POST))&&($_POST['status'] == 'inactive')){echo 'selected';}?> value="inactive">Inactive</option>
												            </select>
														</td>
								                      </tr>
													  <tr>
													  	<td colspan="3" align="center">
											            	<input type="submit" name="add_new" value="Add Forum"  class="button_light" >
												            <input type="button" name="back" value="Back" onClick="change_content('first_inner1')" id="back" class="button_light"></td>
													  </tr>
                                                      </form>
													</table>
                                                    
					<!-- End example table data --> 
					
					
					<!-- Begin pagination --> 
					
					<!-- End pagination --> 
					
					<br class="clear"/> 
                    
				
				</div>
                </div>
			
            
     </div>
        <?php include "../includes/footer.php";?>