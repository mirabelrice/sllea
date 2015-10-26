<?php
	function display_fact_slideshow() {
		$slides = get_field("fact_slides", 192);

		if($slides): 
			$background_image_id = get_field("background_image", 192);
			//$background_image = wp_get_attachment_image_src($background_image_id);
			$num_slides = count($slides);
			echo '<div class = "slide-viewport" style= "background-image:url('. $background_image_id['url'] .')">'; ?>
				<div class= "scroller">	
					<ul class= "slides">
						<li class= "slide">
						<?php if(!empty($slides[$num_slides - 1]['bold_text'])) {
									echo '<div class="text-wrap"><span class= "slide-text bold">'. $slides[$num_slides - 1]['bold_text'] .'</span>';
								}
								echo '<span class= "slide-text">'. $slides[$num_slides - 1]['normal_text'] .'</span></div>';
						?>
						</li>
						<?php
							foreach ($slides as $slide): 
								$bold_fact = $slide['bold_text'];
								$normal_fact = $slide['normal_text'];
								echo '<li class= "slide">';
										if(!empty($bold_fact)) {
											echo '<div class= "text-wrap"><span class= "slide-text bold">'. $bold_fact .'</span>';			
										}
										echo '<span class= "slide-text">'.$normal_fact.'</span></div></li>';	
						endforeach; 
						echo '<li>';
							if(!empty($slides[0]['bold_text'])) {
									echo '<div class= "text-wrap"><span class= "slide-text bold">'. $slides[0]['bold_text'] .'</span>';
								} 
						?>
								<span class= "slide-text"> <?php echo $slides[0]['normal_text']; ?></span></div>
						</li>
					</ul>
				</div>
			</div>
			<div id="slide-controls">
				<div class = "controls left">
					<ul>
						<?php
							for($i = 0; $i < $num_slides; $i++):
								echo '<li></li>';
							endfor;	
						?>
					</ul>
				</div>
			</div>
		<?php endif;
}

