<?php
/*
 * Template Name: Home page
*/

	//add_filter( 'genesis_markup_content-sidebar-wrap_output', '__return_false' );
	//add_filter( 'genesis_markup_site-inner', '__return_null' );
	remove_action( 'genesis_loop', 'genesis_do_loop' );
	add_action( 'genesis_loop', 'sllea_home_content' );

	function sllea_home_content() { ?>
		<div id= "home-content">
		<?php get_template_part('template-parts/landing');?>
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
	<?php }
	genesis();