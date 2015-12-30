<?php 
	if(is_front_page()) :
		get_template_part('templates/home-page');
	else:
		$classes = "content " . $post->post_name; ?>
			<main class="<?php echo $classes; ?>">
				<?php
					global $post;

					while(have_posts()) : the_post();
						get_template_part( 'templates/content', $post->post_name);
					endwhile;
				?>
			</main>
<?php endif; ?>