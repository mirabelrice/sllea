<main id="our-model" class="content">
	<?php if( have_rows('our_model_image_text_block') ){ ?>
		<?php $row_num = 0;
			while ( have_rows('our_model_image_text_block') ) : the_row();
				$section_type = 'model-section content-wrap large';
				$headline = get_sub_field('headline');
				$text = get_sub_field('text_area');
				$image = get_sub_field('image');
				if($row_num % 2 != 0) {
					$section_type .= ' reversed';

					if($row_num === 1){
						$section_type .= ' gray';
					}else if($row_num === 3){
						$section_type .= ' blue';
					}
				}
				?>
				<div class="<?php echo $section_type; ?>">
					<div class="content-column image">
						<div class="image-wrap" style="background-image:url(http://sllea.local:8888/wp-content/uploads/2015/06/DSC_1795.jpg);"></div>
					</div>
					<div class="content-column text">
						<div class="text-wrap">
							<h2><?php echo $headline; ?></h2>
							<?php echo $text; ?>
						</div>
					</div>
				</div>
				<

		<?php $row_num += 1;
			endwhile;
		} ?>
</main>
