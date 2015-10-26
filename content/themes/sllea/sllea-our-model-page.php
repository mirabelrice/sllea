<?php
/*
 * Template Name: Our Model Page
*/	
	remove_action( 'genesis_loop', 'genesis_do_loop' );
	add_action( 'genesis_loop', 'create_model_page' );

	function create_model_page(){ ?>
		<div class = "wrap">
			<div class= "model main-content">
				<div class= "content-column">
					<?php if( have_rows('our_model_image_text_block') ){
							$row_num = 0;
							while ( have_rows('our_model_image_text_block') ) : the_row();
								$row_type = 'content-row'; 
								$headline = get_sub_field('headline');
								$text = get_sub_field('text_area');
								//$image_id = get_sub_field('image');
								//$image = wp_get_attachment_image_src($image_id);
								$image = get_sub_field('image');
								if($row_num % 2 != 0) {
									$row_type .= ' reversed';
									if($row_num === 1){
										$row_type .= ' gray';
									}else if($row_num === 3){
										$row_type .= ' blue';
									}
								} ?>
								<div class= "<?php echo $row_type; ?>">
									<div class= "model-section text">
										<h2><?php echo $headline; ?></h2>
										<div class= "text-wrap">
											<?php echo $text; ?>
										</div>
									</div>
									<div class= "model-section image">
										<img src=  "<?php echo $image['url']; ?>"/>
									</div>
								</div>
						<?php $row_num += 1;
					 endwhile;
					} ?>
				</div>
			</div>
		</div>
	<?php }
    genesis();