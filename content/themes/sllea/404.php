<div class="body-wrap">
	<?php get_header();
		$logo_url = get_stylesheet_directory_uri() .'/images/LogoSLLEA.png';
	?>
		<main id="not-found" class="content">
			<div class="error-msg">
				<div class="error-column logo">
					<img src="<?php  echo $logo_url ?>" />
				</div>
				<div class="error-column text">
					<h1>Page Not Found</h1>
					<p>Sorry, the requested page is not available.</p>
				</div>
			</div>
		</main>
	<?php get_footer(); ?>
</div>
