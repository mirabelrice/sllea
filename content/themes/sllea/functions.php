<?php

/**
*Functions
*
*@package sslea
*@author Mirabel Rice
*
*/

	register_custom_scripts();
	add_action( 'wp_enqueue_scripts', 'sllea_google_fonts' );
	add_action( 'wp_enqueue_scripts', 'enqueue_custom_scripts' );

	function register_custom_scripts() {
		if(!is_admin()) {
			wp_register_style('main-stylesheet', get_stylesheet_uri(), false);
			wp_register_style( 'our-model-style', get_template_directory_uri(). '/css/sllea-our-model.css');
			wp_register_style( 'donate-style', get_template_directory_uri(). '/css/sllea-donate.css');
			wp_register_style( 'our-team-style', get_template_directory_uri(). '/css/sllea-our-team.css');
			wp_register_style( 'fact-slideshow-style', get_template_directory_uri(). '/css/fact-slideshow.css');
			wp_register_script( 'fact_slideshow_admin', get_template_directory_uri().'/lib/js/fact-slideshow.js', array('jquery', 'media-upload', 'media-views' ), true );
			wp_register_script('donate-page',get_template_directory_uri().'/lib/js/donate-page.js', array( 'jquery' ), '1.0.0', true );
			wp_register_script('sllea-functions',get_template_directory_uri().'/lib/js/functions.js', array( 'jquery' ), '1.0.0', true );
			wp_register_script('sllea-our-model',get_template_directory_uri().'/lib/js/our-model-functions.js', array( 'jquery' ), '1.0.0', true );
		}
	}

	function enqueue_custom_scripts() {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_style('main-stylesheet');
		wp_enqueue_script('sllea-functions');

		//home page
		if(is_front_page()) {
			wp_enqueue_script('fact_slideshow_admin');
			wp_enqueue_style( 'fact-slideshow-style');
		}
		//donate page
		if( is_page('donate') ){
			wp_enqueue_style('donate-style');
			wp_enqueue_script('donate-page');
		}

		//contact page
		if( is_page('contact') ){
			wp_enqueue_style('our-team-style');
			require_once get_stylesheet_directory() .'/templates/includes/sllea-contact-form.php';
		}

		//our model page
		if( is_page('our-model') ){
			wp_enqueue_style('our-model-style', get_template_directory_uri() . '/sllea-our-model-page.css' );
			wp_enqueue_script('sllea-our-model');
		}
	}

	function sllea_google_fonts() {
		wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700', array());
	}

	//* Add HTML5 markup structure
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	//register Menus
	add_action( 'after_setup_theme', 'register_menus' );
	function register_menus() {
	  register_nav_menu( 'sllea-slide-menu', __( 'Slide Menu', 'sllea' ) );
	  register_nav_menu( 'primary-menu', __( 'Primary Navigation Menu', 'sllea' ) );
	}

	//cleanup client backend
	if (!current_user_can('manage_options')) {
		add_action( 'admin_menu', 'remove_menus' );
		add_action( 'admin_menu', 'remove_page_metaboxes' );
		add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );
		add_action( 'admin_bar_menu', 'remove_wp_nodes', 999 );
		add_filter( 'contextual_help_list', 'wpse_25034_remove_dashboard_help_tab');
		add_filter( 'screen_options_show_screen', 'wpse_25034_remove_help_tab' );
		add_filter( 'screen_layout_columns', 'so_screen_layout_columns' );
		add_filter( 'get_user_option_screen_layout_dashboard', 'so_screen_layout_dashboard' );
	}	
	

	function remove_wp_nodes() 
	{
	    global $wp_admin_bar;   
	    $wp_admin_bar->remove_node( 'new-post' );
	    $wp_admin_bar->remove_node( 'new-page' );
	    $wp_admin_bar->remove_node( 'new-media' );
	}
	
	function remove_menus(){
		remove_menu_page( 'tools.php' );
		remove_menu_page( 'options-general.php' );
		remove_menu_page( 'edit.php' );
  		remove_menu_page( 'upload.php' );
		remove_menu_page( 'edit-comments.php' );
	}

	function remove_page_metaboxes() {
		remove_meta_box('postcustom', 'page', 'normal');
		remove_meta_box('pageparentdiv', 'page', 'side');
		remove_meta_box('postimagediv', 'page', 'normal');
		remove_meta_box('postexcerpt', 'page', 'normal');

	}

	function remove_dashboard_widgets() {
	 	global $wp_meta_boxes;
	 	$wp_meta_boxes['dashboard']['normal']['core'] = array();
    	$wp_meta_boxes['dashboard']['side']['core'] = array(); 
	}

	function so_screen_layout_columns( $columns ) {
		$columns['dashboard'] = 1;
		return $columns;
	}

	function so_screen_layout_dashboard() {
		return 1;
	}

	function wpse_25034_remove_dashboard_help_tab(){
	    global $current_screen;
	    $current_screen->remove_help_tabs();
	}

	function wpse_25034_remove_help_tab( $visible ){
	    global $current_screen;
	    if( 'dashboard' == $current_screen->base ){
	        return false;
	    }
	    return $visible;
	}

	function sllea_page_title() {
		if (is_front_page()) {
			echo 'Smart Living Learning & Earning with Autism';
		}
		elseif(is_404()) {
			echo 'Not Found -';
		}
		else{
			bloginfo('name');
		}
	}

	function trim_text($text, $max_length) {
		$trimmed_text = $text;
		$length_original = strlen($text);
		if( $length_original > $max_length) {
			$offset = ($max_length - 3) - $length_original;
			$trimmed_text = substr($text, 0, strrpos($text, ' ', $offset)) . '...';
		}
		return $trimmed_text;
	}
	require get_stylesheet_directory() .'/templates/includes/helpers.php';
	require get_stylesheet_directory() .'/includes/team-cpt.php';
	require get_stylesheet_directory() .'/fact-slideshow-template.php';
	require get_stylesheet_directory() .'/fact-slideshow-cpt.php';
