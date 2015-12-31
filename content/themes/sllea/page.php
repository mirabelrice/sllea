<?php
	echo '<div class="body-wrap">';
 	get_header();

		if(is_front_page()) :
			get_template_part('templates/home-page');
		else:
			global $post;
			while(have_posts()) : the_post();
				get_template_part( 'templates/content', $post->post_name);
			endwhile;
		endif;
	get_footer();
	echo '</div>';
?>