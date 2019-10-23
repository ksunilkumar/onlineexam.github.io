<title>Ismartexams Admin Panel</title>
<style type="text/css" >
.wrong
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#FF0000;
	text-align:left;
	font-weight:bold;
	padding:5px 5px 5px 25px;
	border:#FF0000 thin solid;
	background:#FFECEC url(../../../images/wrong.png) left center no-repeat;
}
.success
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#008800;
	text-align:left;
	font-weight:bold;
	padding:5px 5px 5px 25px;
	border:#008000 thin solid;
	background:#EAFFEA url(../../../images/tick.png) left center no-repeat;
}
</style>
<?php 
$admin_path="http://online-test.students3k.com/admin/web/";
$admin_pat="http://online-test.students3k.com/admin/web/";
$url=$_SERVER['PHP_SELF'];
$url=explode('/',$url);
//echo count($url);
$name= $url[count($url)-2];
//print_r($url);
if($name=='blog' || $name=='forums' || $name=='news' || $name=='polls' || $name=='careers' || $name=='faqs'|| $name=='adds'){
$content='active';
}
else if($name=='tecourses' || $name=='echapters' || $name=='tequizes' || $name=='tecost' || $name=='testengine'){
$testengine='active';
}
else if($name=='tecurricullum' || $name=='tesubjects' || $name=='test_options'|| $name=='feedbacks'){
$test_options='active';
}
else if($name=='settings'|| $name=='liveteaching'){
$settings1='active';
}
else if($name=='groups'){
$groups='active';
}
else if($name=='clients' || $name=='scroll_images' || $name=='scroll_text'  || $name=='feedback' ||  $name=='videos' || $name=='skoolinfo' || $name=='schools'  || $name=='otherotions'){
$other='active';
}
?>

	<!-- Begin control panel wrapper --> 
	<div id="wrapper"> 
	
		<!-- Begin top bar --> 
		<div id="top_bar"> 
			
			
			<!-- Begin logo --> 
			<div class="logo"> 
				<img src="<?php echo $admin_path;?>images/site_logo.jpg" alt="" height="30"/> 
			</div> 
			<!-- End logo --> 
			
			<!-- Begin account menu --> 
			<div class="account"> 
				<div class="detail"> 
					Hello <a href=""><strong>Admin</strong></a> 
				</div> 
				<ul class="icon"> 
					<!--<li> 
						<a href="" title="Message"> 
							<img src="images/icon_message.png" alt="" class="middle"/> 
						</a> 
					</li> -->
					<li> 
						<a href="<?php echo $admin_path;?>change_password.php" title="Setting"> 
							Change Password
						</a> 
					</li> 
					<li> 
						<a href="<?php echo $admin_path;?>logout.php" title="Logout"> 
							<img src="<?php echo $admin_path;?>images/icon_logout.png" alt="" class="middle"/> 
						</a> 
					</li> 
				</ul> 
			</div> 
			<!-- End account menu --> 
			
			
		</div> 
		<!--End top bar --> 
		
		<!-- Begin main menu --> 
		<div id="menu_wrapper"> 
		
			<ul class="nav"> 
				<!--<li> 
					<a href="home.php" class="active"> 
						Home
					</a> 
				</li> -->
		
				<li> 
					<a href="<?php echo $admin_path;?>users/index.php" <?php if($name=='users'){ echo 'class="active"'; }?>> 
						Users
					</a> 
					<!--<div class="popup"> 
						<div class="top"></div> 
						<div class="content"> 
							<ul class="submenu"> 
								<li> 
									<a href="<?php echo $admin_path;?>users/index.php"> 
										Manage users
									</a> 
								</li>
                              
							</ul> 
						
						</div> 
						<div class="footer"></div> 
					</div> -->
				</li>
               <!-- <li> 
					<a href="<?php echo $admin_path;?>tutors/index.php" <?php if($name=='tutors'){ echo 'class="active"'; }?>> 
						Tutors
					</a> 
                </li>-->
				<li> 
					<a href="" class="<?php echo $content;?>"> 
						 Content
					</a> 
					<div class="popup"> 
						<div class="top"></div> 
						<div class="content"> 
							<ul class="submenu"> 
								<li> 
									<a href="<?php echo $admin_path;?>blog/index.php"> 
										Blogs
									</a> 
								</li> 
                                <li> 
									<a href="<?php echo $admin_path;?>forums/index.php"> 
										Forums
									</a> 
								</li> 
                                <li> 
									<a href="<?php echo $admin_path;?>news/index.php"> 
										News
									</a> 
								</li> 
                               <!-- <li> 
									<a  href="<?php echo $admin_path;?>polls/index.php"> 
										Polls
									</a> 
								</li>--> 
                              <!--  <li> 
									<a href="<?php echo $admin_path;?>careers/index.php"> 
										Careers
									</a> 
								</li> -->
                                 <li> 
									<a href="<?php echo $admin_path;?>faqs/index.php"> 
										Faq's
									</a> 
								</li> 
                                <li> 
									<a href="<?php echo $admin_path;?>adds/index.php"> 
										Manage Ads
									</a> 
								</li> 
								
								
							</ul> 
							<br class="clear"/> 
						</div> 
						<div class="footer"></div> 
					</div> 
				</li> 
				<li> 
					<a href=""  class="<?php echo $testengine;?>"> 
						Test Engine
					</a> 
					<div class="popup"> 
						<div class="top"></div> 
						<div class="content"> 
							<ul class="submenu"> 
								<li> 
									<a href="<?php echo $admin_path;?>tecourses/index.php"> 
										Courses
									</a> 
								</li> 
                                <li> 
									<a href="<?php echo $admin_path;?>techapters/index.php"> 
										Chapters
									</a> 
								</li> 
                                 <li> 
									<a href="<?php echo $admin_path;?>tequizes/index.php"> 
										Quiz
									</a> 
								</li> 
                                 <li> 
									<a href="<?php echo $admin_path;?>tecost/index.php"> 
										Cost
									</a> 
								</li> 
                               <li> 
									<a href="<?php echo $admin_path;?>testengine/manage_quiz_bulkaieee.php"> 
										Questions
									</a> 
								</li> 
                                   <li> 
									<a href="<?php echo $admin_path;?>testengine/manage_uploads.php"> 
										Bulk Uploads
									</a> 
								</li> 
                                 
                                
								
								<!--<li> 
									<a href="home.php?opt=me"> 
										Delete Exams
									</a> 
								</li> -->
							</ul> 
							<br class="clear"/> 
						</div> 
						<div class="footer"></div> 
					</div> 
				</li> 
                <li> 
					<a href=""  class="<?php echo $test_options;?>"> 
						Test Engine Options
					</a> 
					<div class="popup"> 
						<div class="top"></div> 
						<div class="content"> 
							<ul class="submenu"> 
								<li> 
									<a  href="<?php echo $admin_path;?>tecurricullum/index.php"> 
										Curriculums
									</a> 
								</li> 
                                	<li> 
									<a  href="<?php echo $admin_path;?>tesubjects/index.php"> 
										Subjects
									</a> 
								</li> 
                                 <li> 
									<a href="<?php echo $admin_path;?>test_options/manage_grade.php"> 
										Grades
									</a> 
								</li> 
                                <li> 
									<a href="<?php echo $admin_path;?>test_options/index.php"> 
										Optional Questions
									</a> 
								</li> 
                                 <li> 
									<a href="<?php echo $admin_path;?>test_options/manage_opt_modelpaper.php"> 
										Optional Model Papers
									</a> 
								</li> 
                                 <li> 
									<a href="<?php echo $admin_path;?>test_options/manage_tests.php"> 
										Tests
									</a> 
								</li> 
                                 <li> 
									<a href="<?php echo $admin_path;?>test_options/manage_cart.php"> 
										Cart
									</a> 
								</li> 
                                 <li> 
									<a href="<?php echo $admin_path;?>test_options/give_offer.php"> 
										Offers
									</a> 
								</li> 
                                <!--<li> 
									<a href="<?php echo $admin_path;?>test_options/feedbacks/index.php"> 
										Feedbacks
									</a> 
								</li>-->
								
								<!--<li> 
									<a href="home.php?opt=me"> 
										Delete Exams
									</a> 
								</li> -->
							</ul> 
							<br class="clear"/> 
						</div> 
						<div class="footer"></div> 
					</div> 
				</li>
					<!--<li> 
					<a href=""  class="<?php echo $settings1;?>"> 
						 Settings
					</a> 
					<div class="popup"> 
						<div class="top"></div> 
						<div class="content"> 
							<ul class="submenu"> 
								<li> 
									<a href="<?php echo $admin_path;?>settings/index.php"> 
										Category
									</a> 
								</li> 
								<li> 
									<a href="<?php echo $admin_path;?>change_password.php"> 
										Change Password
									</a> 
								</li> 
                                 <li> 
									<a href="<?php echo $admin_path;?>liveteaching/index.php"> 
										 Live Teachting
									</a> 
								</li>
							</ul> 
							<br class="clear"/> 
						</div> 
						<div class="footer"></div> 
					</div> 
				</li> -->
               <li> 
					<a href="<?php echo $admin_path;?>groups/index.php" class="<?php echo $groups;?>"> 
						Groups
					</a> 
					<!--<div class="popup"> 
						<div class="top"></div> 
						<div class="content"> 
							<ul class="submenu"> 
								
								<li> 
									<a href="<?php echo $admin_path;?>groups/index.php"> 
										Manage Groups
									</a> 
								</li> 
								
							</ul> 
							<br class="clear"/> 
						</div> 
						<div class="footer"></div> 
					</div> -->
				</li>
               
                   <li> 
					<a href=""  class="<?php echo $other;?>"> 
						Manage Other Options
					</a> 
					<div class="popup"> 
						<div class="top"></div> 
						<div class="content"> 
							<ul class="submenu"> 
								<!--<li> 
									<a href="<?php echo $admin_path;?>clients/index.php"> 
										 Clients
								  </a> 
								</li> 
								 
								
                                <li> 
									<a href="<?php echo $admin_path;?>scroll_images/index.php"> 
										Scroll Images
					    </a> 
								</li>  
                                <li> 
									<a href="<?php echo $admin_path;?>scroll_text/index.php"> 
										Scroll Text
									</a> 
								</li>-->
                               
                                 
                                 <li> 
									<a href="<?php echo $admin_path;?>contact/index.php"> 
										 Contact us

					    </a> 
								<!--</li>
                                  <li> 
									<a href="<?php echo $admin_path;?>videos/index.php"> 
										 Videos

									</a> 
								</li>
                                   <li> 
									<a href="<?php echo $admin_path;?>skoolinfo/index.php"> 
										 Skool Info

									</a> 
								</li>-->
                                 <li> 
									<a href="<?php echo $admin_path;?>schools/index.php"> 
										Schools

									</a> 
								</li>
                                    <li> 
									<a href="<?php echo $admin_path;?>otherotions/index.php"> 
										Country

									</a> 
								</li>
                                 <li> 
									<a href="<?php echo $admin_path;?>otherotions/state_index.php"> 
										State

									</a> 
								</li>
                                <li> 
									<a href="<?php echo $admin_path;?>otherotions/city_index.php"> 
										City

									</a> 
								</li>
                                   <li> 
									<a href="<?php echo $admin_path;?>otherotions/site_access.php"> 
										Site Access

									</a> 
								</li>
                                 <li> 
									<a href="<?php echo $admin_path;?>newsletter/index.php"> 
										Newsletter

									</a> 
								</li>
                                
						  </ul> 
							<br class="clear"/> 
						</div> 
						<div class="footer"></div> 
					</div> 
				</li>
                     
</ul> 
		<!--	
			<div id="search"> 
				<form action="index.html" id="search_form" name="search_form" method="get"> 
					<p><input type="text" id="q" name="q" title="Search" class="search noshadow"/></p> 
				</form> 
			</div> -->
			
		</div> 