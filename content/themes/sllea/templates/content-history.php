<?php get_header(); ?>
	<div class= "wrap">
		<h1>History</h1>
		<div class= "text-image-fields">
			<?php if( have_rows('text_image_block') ){
				while ( have_rows('text_image_block') ) : the_row();
					$images = get_sub_field('images');
					$text = get_sub_field('text_area');

					echo '<div class= "text-image-block">';
						if($images) {
					 		$num_images = count($images);

							if($num_images == 1){
								?>
									<div class= "image-field single"><img src=  "<?php echo $images[0]['url']; ?>"/></div>
								<?php
							}elseif($num_images == 2){
								echo '<div class="double-image-container">';
								foreach($images as $sub_image) { ?>
									<div class="image-field double"><img src= "<?php echo $sub_image['url']; ?>" /></div>
								<?php }
								echo '</div>';	
							}else {
								return;
							}
						}

						if($text) { ?>
							<div class= "fluid-container">
								<div class= "text-field">
									<?php echo $text ?>
								</div>
							</div>
						<?php }
					echo '</div>';
				endwhile;
			} ?>
		</div>
	</div>
<?php get_footer(); ?>