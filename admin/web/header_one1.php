<?php $url=$_SERVER['PHP_SELF'];
$url=explode('/',$url);
//echo count($url);
$name= $url[count($url)-2];
//print_r($url);
?>
	<!-- Begin control panel wrapper --> 
	<div id="wrapper"> 
	
		<!-- Begin top bar --> 
		<div id="top_bar"> 
			
			
			<!-- Begin logo --> 
			<div class="logo"> 
				<img src="../images/logo.png" alt=""/> 
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
						<a href="home.php?opt=chp" title="Setting"> 
							Change Password
						</a> 
					</li> 
					<li> 
						<a href="logout.php" title="Logout"> 
							<img src="images/icon_logout.png" alt="" class="middle"/> 
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
					<a href=""> 
						Users
					</a> 
					<div class="popup"> 
						<div class="top"></div> 
						<div class="content"> 
							<ul class="submenu"> 
								<li> 
									<a href=""> 
										Manage users
									</a> 
								</li>
                                 <li> 
									<a href=""> 
										Add users
									</a> 
								</li> 
								
								<!--<li> 
									<a href="home.php?opt=mu"> 
										Delete users
									</a> 
								</li> -->
							</ul> 
							<br class="clear"/> 
						</div> 
						<div class="footer"></div> 
					</div> 
				</li>
				<li> 
					<a href=""> 
						 Content
					</a> 
					<div class="popup"> 
						<div class="top"></div> 
						<div class="content"> 
							<ul class="submenu"> 
								<li> 
									<a href=""> 
										Blogs
									</a> 
								</li> 
                                <li> 
									<a href=""> 
										Forums
									</a> 
								</li> 
                                <li> 
									<a href=""> 
										News
									</a> 
								</li> 
                                <li> 
									<a href=""> 
										Polls
									</a> 
								</li> 
                                <li> 
									<a href=""> 
										Careers
									</a> 
								</li> 
                                 <li> 
									<a href=""> 
										Faq's
									</a> 
								</li> 
								
								
							</ul> 
							<br class="clear"/> 
						</div> 
						<div class="footer"></div> 
					</div> 
				</li> 
				<li> 
					<a href=""> 
						Test Engine
					</a> 
					<div class="popup"> 
						<div class="top"></div> 
						<div class="content"> 
							<ul class="submenu"> 
								<li> 
									<a href=""> 
										Subjects
									</a> 
								</li> 
                                <li> 
									<a href=""> 
										Chapters
									</a> 
								</li> 
                                 <li> 
									<a href=""> 
										Quiz
									</a> 
								</li> 
                                 <li> 
									<a href=""> 
										Cost
									</a> 
								</li> 
                                 <li> 
									<a href=""> 
										Grades
									</a> 
								</li> 
                                 <li> 
									<a href=""> 
										Questions
									</a> 
								</li> 
                                   <li> 
									<a href=""> 
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
					<a href=""> 
						Test Engine Options
					</a> 
					<div class="popup"> 
						<div class="top"></div> 
						<div class="content"> 
							<ul class="submenu"> 
								<li> 
									<a href=""> 
										Curriculums
									</a> 
								</li> 
                                <li> 
									<a href=""> 
										Optional Questions
									</a> 
								</li> 
                                 <li> 
									<a href=""> 
										Optional Model Papers
									</a> 
								</li> 
                                 <li> 
									<a href=""> 
										Tests
									</a> 
								</li> 
                                 <li> 
									<a href=""> 
										Cart
									</a> 
								</li> 
                                 <li> 
									<a href=""> 
										Offers
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
					<a href=""> 
						 Settings
					</a> 
					<div class="popup"> 
						<div class="top"></div> 
						<div class="content"> 
							<ul class="submenu"> 
								<li> 
									<a href="../settings/index.php"> 
										Category
									</a> 
								</li> 
								<li> 
									<a href="../change_password.php"> 
										Change Password
									</a> 
								</li> 
							</ul> 
							<br class="clear"/> 
						</div> 
						<div class="footer"></div> 
					</div> 
				</li> 
               <li> 
					<a href=""> 
						Groups
					</a> 
					<div class="popup"> 
						<div class="top"></div> 
						<div class="content"> 
							<ul class="submenu"> 
								
								<li> 
									<a href="../groups/index.php"> 
										Manage Groups
									</a> 
								</li> 
								
							</ul> 
							<br class="clear"/> 
						</div> 
						<div class="footer"></div> 
					</div> 
				</li>
               
                   <li> 
					<a href=""> 
						Manage Other Options
					</a> 
					<div class="popup"> 
						<div class="top"></div> 
						<div class="content"> 
							<ul class="submenu"> 
								<li> 
									<a href="../clients/index.php"> 
										 Clients
								  </a> 
								</li> 
								 
								
                                <li> 
									<a href="../scroll_images/index.php"> 
										Scroll Images
					    </a> 
								</li>  
                                <li> 
									<a href="../scroll_text/index.php"> 
										Scroll Text
									</a> 
								</li>
                               
                                  <li> 
									<a href="../liveteaching/index.php"> 
										 Live Teachting
				</a> 
								</li>
                                 <li> 
									<a href="../feedback/index.php"> 
										 Feedbacks

					    </a> 
								</li>
                                  <li> 
									<a href="../videos/index.php"> 
										 Videos

									</a> 
								</li>
                                   <li> 
									<a href="../skoolinfo/index.php"> 
										 Skool Info

									</a> 
								</li>
                                 <li> 
									<a href="../schools/index.php"> 
										Schools

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