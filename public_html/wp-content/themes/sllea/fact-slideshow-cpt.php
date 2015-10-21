<?php
	/*
	*Register as custom post type
	*/
	add_action('init', 'fact_slider_register_cpt');
	function fact_slider_register_cpt() {
			
		$labels = array(
			'name'                 => __( 'Fact Slideshows', 'fact-slideshow' ),
			'singular_name'        => __( 'Fact Slideshow', 'fact-slideshow' ),
			'add_new'              => __( 'Add New Slideshow', 'fact-slideshow' ),
			'add_new_item'         => __( 'Add New Slideshow', 'fact-slideshow' ),
			'edit_item'            => __( 'Edit Slideshow', 'fact-slideshow' ),
			'new_item'             => __( 'New Slideshow', 'fact-slideshow' ),
			'view_item'            => __( 'View Slideshow', 'fact-slideshow' ),
            'search_items'		   => __( 'Search Slideshow' ),
            'not_found'            => __( 'No Slideshow found' ),
            'not_found_in_trash'   => __( 'No Slideshow found in trash' )
		);
		
		$args = array(
			'labels'               => $labels,
			'public'               => true,
			'show_ui'              => true,
			'query_var'			   => true,
			'supports'             => array( 'title')
		);
		register_post_type( 'fact-slideshow', $args );
		flush_rewrite_rules();
	}
	
	add_action('init', 'fact_slideshow_enqueue_scripts');
	function fact_slideshow_enqueue_scripts() {
		wp_enqueue_media();
		wp_enqueue_style('fact_slideshow_style', CHILD_URL . '/fact-slideshow-style.css' );
	}