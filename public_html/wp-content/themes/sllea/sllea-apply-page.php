<?php
/*
 * Template Name: Apply Page
*/
	remove_action( 'genesis_loop', 'genesis_do_loop' );
	add_action( 'genesis_loop', 'create_apply_page' );
	
	
	function create_apply_page(){ ?>
	<div class= "apply main-content">
		<div class= "background" ></div>
			<div class = "wrap">
				<div id= "applicant-criteria">
					<img class= "thumbtack" src= "<?php
						$imagePath = get_stylesheet_directory_uri() .'/images/thumbtack.png'; 
						echo htmlspecialchars($imagePath);
					?>"/>
					<h1>Applicant Criteria</h1>
					<ol id= "criteria-list">
						<?php
							if( have_rows('applicant_criteria') ) :
								while ( have_rows('applicant_criteria') ) : the_row();
									$text = get_sub_field('qualification');
									echo '<li class= "qualification">'. $text .'</li>';
									$row_num += 1;
								endwhile;
							endif;
						?>
					</ol>
				</div>
			
				<div id="post-it">
					<img src= "<?php
						$imagePath = get_stylesheet_directory_uri() .'/images/sticky.png'; 
						echo htmlspecialchars($imagePath);
					?>"/>
				</div>
				<div id= "polaroid">
					<div class= "tape top"></div>
					<?php
						$imagePath = get_stylesheet_directory_uri() .'/images/porch-2.jpg';
						echo '<img src="'. $imagePath .'" />';
					?>
					<div class= "tape bottom"></div>
				</div>
			</div>
		</div>

<?php 
}
genesis();