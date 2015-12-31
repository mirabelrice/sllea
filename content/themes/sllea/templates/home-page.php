<?php
/*
 * Template for sllea home page
*/
$image_url = get_stylesheet_directory_uri() .'/images/boys_porch_bw.jpg';
?>
<span id="homepage-mark" style="display: none"></span>
<main id= "home" class="content">
	<?php get_template_part('templates/includes/landing') ?>
	<div id= "mission-statement" class= "content-block">
		<div class="content-wrap large">
			<div class="content-inner">
				<?php
					$mission_statement = get_field("mission_statement");
					if($mission_statement) {
						echo $mission_statement;
					}
				?>
			</div>
		</div>
	</div>
	<div class= "scrollover-image first">
		<div class= "content-wrap medium">
			<div class= "overlay"></div>
			<div class= "overlay-background"></div>
		</div>
	</div>
	<div id="initiative-block" class= "content-block">
		<div class= "content-wrap large">
			<div class="content-inner">
				<div class="inner-row">
					<div class= "initiative-column left">
						<div class= "initiative-image">
							<img src= "<?php
								$imagePath = get_template_directory_uri() . '/images/briefcase-nb.png';
								echo htmlspecialchars($imagePath);
							?>"/>
						</div>
						<div class= "initiative-text">
							<h2>Employment</h2>
							<?php
								$employment_statement = get_field("employment_initiative");
								if($employment_statement ) {
									$text = trim_text($employment_statement, 200);
									echo $text;
								}
							?>
						</div>
					</div>
					<div class="initiative-column center">
						<div class= "initiative-image">
							<img src= "<?php
								$imagePath = get_template_directory_uri(). '/images/house2-nb.png';
								echo htmlspecialchars($imagePath);
							?>"/>
						</div>
						<div class= "initiative-text">
							<h2>Independent Living</h2>
							<?php
								$living_statement = get_field("living_initiative");
								if($living_statement) {
									$text = trim_text($living_statement, 200);
									echo $text;
								}
							?>
						</div>
					</div>
					<div class= "initiative-column right">
						<div class= "initiative-image">
							<img src= "<?php
								$imagePath = get_template_directory_uri().'/images/grad-cap-nb.png';
								echo htmlspecialchars($imagePath);
							?>"/>
						</div>
						<div class= "initiative-text">
							<h2>Education</h2>
							<?php
								$education_statement = get_field("education_initiative");
								if($education_statement) {
									$text = trim_text($education_statement, 200);
									echo $text;
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class= "scrollover-image second">
		<div class= "content-wrap medium">
			<div class= "overlay"></div>
			<div class= "overlay-background"></div>
		</div>
	</div>
	<div id="fact-slideshow-area" class="content-block">
		<div class="content-wrap medium">
			<span id= "slide-forward" class= "direction-control forward"><i class= "icon ion-chevron-right"></i></span>
			<?php
				display_fact_slideshow();
			?>
			<span id= "slide-back" class= "direction-control back"><i class= "icon ion-chevron-left"></i></span>
		</div>
	</div>
	<div id="donate-block" class= "content-block">
		<div class="content-wrap small">
			<div class="donate-link large content-inner">
				<a href= "'. WP_SITEURL . '/donate">DONATE NOW</a>
			</div>
		</div>
	</div>
</main>