<?php
	if(is_front_page()) :
		get_template_part('templates/home-page');
	else:

		global $post;
	echo '<div class="body-wrap">';
		while(have_posts()) : the_post();
			get_template_part( 'templates/content', $post->post_name);
		endwhile;
	endif;
	echo '</div>';
?>