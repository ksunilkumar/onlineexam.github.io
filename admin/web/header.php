<?php 
$url=$_SERVER['PHP_SELF'];
$url=explode('/',$url);
//echo count($url);
$name= $url[count($url)-2];
//print_r($url);?>	
	<!-- Begin control panel wrapper --> 
	<div id="wrapper"> 
	
		<!-- Begin top bar --> 
		<div id="top_bar"> 
			
			
			<!-- Begin logo --> 
			<div class="logo"> 
				<img src="../../images/site_logo.jpg" alt=""/> 
			</div> 
			<!-- End logo --> 
			
			<!-- Begin account menu --> 
			<div class="account"> 
				<div class="detail"> 
					Hello <a href=""><strong>Admin</strong></a> 
				</div> 
				<ul class="icon"> 
				<!--	<li> 
						<a href="" title="Message"> 
							<img src="../images/icon_message.png" alt="" class="middle"/> 
						</a> 
					</li> 
					<li> 
						<a href="" title="Setting"> 
							<img src="../images/icon_setting.png" alt="" class="middle"/> 
						</a> 
					</li> -->
					<li> 
						<a href="../logout.php" title="Logout"> 
							<img src="../images/icon_logout.png" alt="" class="middle"/> 
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
				<li> 
					<a href="../home.php" <?php if($name=='web') {?>class="active" <?php } ?>> 
						Home
					</a> 
				</li> 
				<li> 
					<a href="../professors/index.php" <?php if($name=='professors') {?>class="active" <?php } ?>> 
						Professors
					</a> 
					<div class="popup"> 
						<div class="top"></div> 
						<div class="content"> 
							<ul class="submenu"> 
								<li> 
									<a href="../professors/user_new.php"> 
										Add Professors
									</a> 
								</li> 
								<li> 
									<a href="../professors/index.php"> 
										Manage Professors
									</a> 
								</li> 
								<li> 
									<a href="../professors/index.php"> 
										Delete Professors
									</a> 
								</li> 
							</ul> 
							<br class="clear"/> 
						</div> 
						<div class="footer"></div> 
					</div> 
				</li> 
				<li> 
					<a href="../scientists/index.php"  <?php if($name=='scientists') {?>class="active" <?php } ?>> 
						Scientists
					</a> 
					<div class="popup"> 
						<div class="top"></div> 
						<div class="content"> 
							<ul class="submenu"> 
								<li> 
									<a href="../scientists/scientist_new.php"> 
										Add Scientist
									</a> 
								</li> 
								<li> 
									<a href="../scientists/index.php"> 
										Manage Scientists
									</a> 
								</li> 
								<li> 
									<a href="../scientists/index.php"> 
										Delete Scientists
									</a> 
								</li> 
							</ul> 
							<br class="clear"/> 
						</div> 
						<div class="footer"></div> 
					</div> 
				</li> 
				<!--<li> 
					<a href="../softwares/index.php" <?php if($name=='softwares') {?>class="active" <?php } ?>> 
						Software tools
					</a> 
					<div class="popup"> 
						<div class="top"></div> 
						<div class="content"> 
							<ul class="submenu"> 
								<li> 
									<a href="../softwares/sw_add.php"> 
										Add Software tool
									</a> 
								</li> 
								<li> 
									<a href="../softwares/index.php"> 
										Manage Software tools
									</a> 
								</li> 
								<li> 
									<a href="../softwares/index.php"> 
										Delete Software tools
									</a> 
								</li> 
							</ul> 
							<br class="clear"/> 
						</div> 
						<div class="footer"></div> 
					</div> 
				</li> 
				<li> 
					<a href="../projects/index.php" <?php if($name=='projects') {?>class="active" <?php } ?>> 
						Projects
					</a> 
					<div class="popup"> 
						<div class="top"></div> 
						<div class="content"> 
							<ul class="submenu"> 
								<li> 
									<a href="../projects/proj_add.php"> 
										Add Project
									</a> 
								</li> 
								<li> 
									<a href="../projects/index.php"> 
										Manage Projects
									</a> 
								</li> 
								<li> 
									<a href="../projects/index.php"> 
										Delete Projects
									</a> 
								</li> 
							</ul> 
							<br class="clear"/> 
						</div> 
						<div class="footer"></div> 
					</div> 
				</li> 
                <li> 
					<a href="../categories/index.php" <?php if($name=='categories') {?>class="active" <?php } ?>> 
						Reserach Domains
					</a> 
					<div class="popup"> 
						<div class="top"></div> 
						<div class="content"> 
							<ul class="submenu"> 
								<li> 
									<a href="../categories/category_add.php"> 
										Add Reserach Domain
									</a> 
								</li> 
								<li> 
									<a href="../categories/index.php"> 
										Manage Reserach Domains
									</a> 
								</li> 
								<li> 
									<a href="../categories/index.php"> 
										Delete Reserach Domains
									</a> 
								</li> 
							</ul> 
							<br class="clear"/> 
						</div> 
						<div class="footer"></div> 
					</div> 
				</li>
                    <li> 
					<a href="../forums/index.php" <?php if($name=='forums') {?>class="active" <?php } ?>> 
						Forums
					</a> 
					<div class="popup"> 
						<div class="top"></div> 
						<div class="content"> 
							<ul class="submenu"> 
								<li> 
									<a href="../forums/forums_new.php"> 
										Add Forums
									</a> 
								</li> 
								<li> 
									<a href="../forums/index.php"> 
										Manage Forums
									</a> 
								</li> 
								<li> 
									<a href="../forums/index.php"> 
										Delete Forums
									</a> 
								</li> 
							</ul> 
							<br class="clear"/> 
						</div> 
						<div class="footer"></div> 
					</div> 
				</li>
                      <li> 
					<a href="../blog/index.php" <?php if($name=='blog') {?>class="active" <?php } ?>> 
						Blogs
					</a> 
					<div class="popup"> 
						<div class="top"></div> 
						<div class="content"> 
							<ul class="submenu"> 
								<li> 
									<a href="../blog/blog_add.php"> 
										Add Blogs
									</a> 
								</li> 
								<li> 
									<a href="../blog/index.php"> 
										Manage Blogs
									</a> 
								</li> 
								<li> 
									<a href="../blog/index.php"> 
										Delete Blogs
									</a> 
								</li> 
							</ul> 
							<br class="clear"/> 
						</div> 
						<div class="footer"></div> 
					</div> 
				</li>
                      <li> 
					<a href="../news/index.php" <?php if($name=='news') {?>class="active" <?php } ?>> 
						News
					</a> 
					<div class="popup"> 
						<div class="top"></div> 
						<div class="content"> 
							<ul class="submenu"> 
								<li> 
									<a href="../news/news_new.php"> 
										Add News
									</a> 
								</li> 
								<li> 
									<a href="../news/index.php"> 
										Manage News
									</a> 
								</li> 
								<li> 
									<a href="../news/index.php"> 
										Delete News
									</a> 
								</li> 
							</ul> 
							<br class="clear"/> 
						</div> 
						<div class="footer"></div> 
					</div> 
				</li>
                       <li> 
					<a href="../photo_gallery/index.php" <?php if($name=='photo_gallery') {?>class="active" <?php } ?>> 
						Photo Gallery
					</a> 
					<div class="popup"> 
						<div class="top"></div> 
						<div class="content"> 
							<ul class="submenu"> 
								<li> 
									<a href="../photo_gallery/sw_add.php"> 
										Add Photo Gallery
									</a> 
								</li> 
								<li> 
									<a href="../photo_gallery/index.php"> 
										Manage Photo Gallery
									</a> 
								</li> 
								<li> 
									<a href="../photo_gallery/index.php"> 
										Delete Photo Gallery
									</a> 
								</li> 
							</ul> 
							<br class="clear"/> 
						</div> 
						<div class="footer"></div> 
					</div> 
				</li>
                        <li> 
					<a href="../videos/index.php" <?php if($name=='videos') {?>class="active" <?php } ?>> 
						Videos
					</a> 
					<div class="popup"> 
						<div class="top"></div> 
						<div class="content"> 
							<ul class="submenu"> 
								<li> 
									<a href="../videos/sw_add.php"> 
										Add Videos
									</a> 
								</li> 
								<li> 
									<a href="../videos/index.php"> 
										Manage Videos
									</a> 
								</li> 
								<li> 
									<a href="../videos/index.php"> 
										Delete Videos
									</a> 
								</li> 
							</ul> 
							<br class="clear"/> 
						</div> 
						<div class="footer"></div> 
					</div> 
				</li>-->
			</ul> 
		<!--	
			<div id="search"> 
				<form action="index.html" id="search_form" name="search_form" method="get"> 
					<p><input type="text" id="q" name="q" title="Search" class="search noshadow"/></p> 
				</form> 
			</div> -->
			
		</div> 