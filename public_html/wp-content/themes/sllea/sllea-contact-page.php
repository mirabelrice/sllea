<?php
/*
 * Template Name: Contact Page
*/
	remove_action( 'genesis_loop', 'genesis_do_loop' );
	add_action( 'genesis_loop', 'create_contact_page' );
	
	
	function create_contact_page(){ 
		if( is_page(105) ){ ?>
			<main>
				<div class = "wrap">
					<div class= "contact main-content">
					<h1>Our Team</h1>
					<div id= "board-bios" class= "bio-section">
						<h2>Board</h2>
						<?php
							genesis_widget_area( 'board-bios', array( 'before' => '<div class= "team-bios widget-area">', 'after' => '</div>', ) );
						?>
					</div>
					<div id="creative-bios" class= "bio-section">
						<h2>Creative Department</h2>
						<?php
							genesis_widget_area( 'creative-bios', array( 'before' => '<div class= "team-bios widget-area">', 'after' => '</div>', ) );
						?>
					</div>
				</div>
			</main>
<?php 
}
}