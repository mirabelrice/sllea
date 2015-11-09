<?php
/*
 * Template Name: Home page
*/

	//add_filter( 'genesis_markup_content-sidebar-wrap_output', '__return_false' );
	//add_filter( 'genesis_markup_site-inner', '__return_null' );
	remove_action( 'genesis_loop', 'genesis_do_loop' );
	add_action( 'genesis_loop', 'sllea_home_content' );

	function sllea_home_content() { ?>
			<div id= "load-wrapper"></div>
			<div id= "site-landing">
				<div class="overlay"></div>
				<div class="image"></div>
				<div class= "logo landing-animated">
					<img src= "<?php
						$imagePath = get_stylesheet_directory_uri() .'/images/logo1.png'; 
						echo htmlspecialchars($imagePath);
					?>"/>
				</div>
				<div id= "landing-content" class= "landing-animated">
					<h1>Smart Living, Learning,<br>& Earning with Autism</h1>
					<div id= "video-link" class= "landing-link">
						<span>WATCH THE VIDEO</span>
					</div>
				</div>
				<div id="continue-to-site"><a href="#mission-statement"><i class="icon ion-chevron-down"/></i></a></div>
				<div id= "trailer-window">
					<div id="video-container">
						<a id= "close-window"><i class= "icon ion-close"></i></a>
						<div class= "sllea-trailer">
							<?php 
								$sllea_trailer_url = get_field("sllea-trailer");
								echo $sllea_trailer_url;
							//echo '<iframe src="http://vimeo.com/133109508&amp;title=0&amp;byline=0&amp;portrait=0" width="1000" height="565" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
							?>
						</div>
					</div>
				</div>
			</div>
			<div id= "home-content">
				<div class="wrap">
					<div class="content-column">
						<div id= "mission-statement" class= "content-block">
							<?php
								$mission_statement = get_field("mission_statement");
								if($mission_statement) {
									echo $mission_statement;
								} 
							?>
						</div>
						<div id= "impact" class= "content-block">
							<div class= "overlay"></div>
							<div class= "overlay-background"></div>
						</div>
						<div id="initiative-block" class= "content-block">
							<div id= "initiative-wrap">
								<div class= "initiative-column left">
									<div class= "initiative-image">
										<img src= "<?php
											$imagePath = get_stylesheet_directory_uri() .'/images/briefcase-nb.png'; 
											echo htmlspecialchars($imagePath);
										?>"/>
									</div>
									<div class= "initiative-text">
										<h2>Employment</h2>
										<?php
											$employment_statement = get_field("employment_initiative");
											if($employment_statement ) {
												echo $employment_statement;
											} 
										?>
									</div>
								</div>
								<div class="initiative-column center">
									<div class= "initiative-image">
										<img src= "<?php
											$imagePath = get_stylesheet_directory_uri() .'/images/house2-nb.png'; 
											echo htmlspecialchars($imagePath);
										?>"/>
									</div>
									<div class= "initiative-text">
										<h2>Independent Living</h2>
										<?php
											$living_statement = get_field("living_initiative");
											if($living_statement ) {
												echo $living_statement;
											} 
										?>
									</div>
								</div>
								<div class= "initiative-column right">
									<div class= "initiative-image">
										<img src= "<?php
											$imagePath = get_stylesheet_directory_uri() .'/images/grad-cap-nb.png'; 
											echo htmlspecialchars($imagePath);
										?>"/>
									</div>
									<div class= "initiative-text">
										<h2>Education</h2>
										<?php
											$education_statement = get_field("education_initiative");
											if($education_statement ) {
												echo $education_statement;
											} 
										?>
									</div>
								</div>
							</div>
						</div>
						<div id="fact-slideshow-area" class="content-block">
							<span id= "slide-forward" class= "direction-control forward"><i class= "icon ion-chevron-right"></i></span>
							<?php
								display_fact_slideshow();
							?>
							<span id= "slide-back" class= "direction-control back"><i class= "icon ion-chevron-left"></i></span>
						</div>
						<div id="donate-block" class= "content-block">
							<div class="donate-link large">
								<a href= "'. WP_SITEURL . '/donate">DONATE NOW</a>
							</div>
						</div>
					</div>	
				</div>
			</div>
	<?php }
	genesis();