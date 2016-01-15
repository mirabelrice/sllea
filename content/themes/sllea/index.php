<?php
/*
* The most generic tempalte file
*/
get_header();

if(is_front_page()) :
	get_template_part('templates/home-page');
endif;

get_footer();
?>