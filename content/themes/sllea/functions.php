<?php

/**
*Functions
*
*@package sslea
*@author Mirabel Rice
*
*/

	/** Remove page/post/attachment titles */
	//* Start the engine
	include_once( get_template_directory() . '/lib/init.php' );

	//* Child theme (do not remove)f
	define( 'CHILD_THEME_NAME', 'sllea theme' );
	define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
	define( 'CHILD_THEME_VERSION', '2.1.2' );
	define( 'DISALLOW_FILE_EDIT', true );

	register_custom_scripts();
	add_action( 'wp_enqueue_scripts', 'sllea_google_fonts' );
	add_action( 'wp_enqueue_scripts', 'enqueue_custom_scripts' );

	//* Display a custom favicon
	add_filter( 'genesis_pre_load_favicon', 'sp_favicon_filter' );
	function sp_favicon_filter( $favicon_url ) {
		return CHILD_URL .'/images/logoSLLEA.png';
	}

	function register_custom_scripts() {
		if(!is_admin()) {
			wp_register_script('sllea-landing', get_stylesheet_directory_uri().'/lib/js/sllea-landing-page.js', array( 'jquery', 'froogaloop' ), '1.0.0', true );
			wp_register_script('sllea-header', get_stylesheet_directory_uri().'/lib/js/sllea-header-functions.js', array( 'jquery' ), '1.0.0', true );
			//wp_register_script('froogaloop',"https://f.vimeocdn.com/js/froogaloop2.min.js");
			wp_register_script( 'fact_slideshow_admin', get_stylesheet_directory_uri().'/lib/js/fact-slideshow.js', array('jquery', 'media-upload', 'media-views' ), true );
			wp_register_script('sllea-mail-signup',get_stylesheet_directory_uri().'/lib/js/sllea-mail-signup.js', array( 'jquery' ), '1.0.0', true );
			wp_register_script('donate-page',get_stylesheet_directory_uri().'/lib/js/donate-page.js', array( 'jquery' ), '1.0.0', true );
			wp_register_script('sllea-general',get_stylesheet_directory_uri().'/lib/js/general-functions.js', array( 'jquery' ), '1.0.0', true );
			wp_register_script('sllea-application',get_stylesheet_directory_uri().'/lib/js/sllea-application.js', array( 'jquery' ), '1.0.0', true );
			wp_register_script('sllea-our-model',get_stylesheet_directory_uri().'/lib/js/our-model-functions.js', array( 'jquery' ), '1.0.0', true );
		}
	}

	function enqueue_custom_scripts() {
		wp_enqueue_script('jquery-ui-dialog');
		wp_enqueue_style("wp-jquery-ui-dialog");
		wp_enqueue_script('sllea-header');
		//wp_deregister_script( 'ScrollMagic' );
		;
		//home page 
		if(is_front_page()) {
			wp_enqueue_script('froogaloop');
			wp_enqueue_script('sllea-landing');
			wp_enqueue_script( 'sllea-mail-signup');
			wp_enqueue_script('fact_slideshow_admin');
		}
		//donate page
		if( is_page(20) ){
			wp_enqueue_script('donate-page');
			wp_enqueue_style( 'custom-stylesheet', CHILD_URL . '/sllea-donate-page-style.css' );
		}

		//contact page
		if( is_page(105) ){	
			wp_enqueue_script('sllea-general');
			wp_dequeue_script('fact_slideshow_admin');
			//wp_dequeue_script('froogaloop');
			wp_enqueue_style( 'custom-stylesheet', CHILD_URL . '/sllea-our-team-page.css' );
		}

		//our model page
		if( is_page(113) ){
			wp_enqueue_style( 'custom-stylesheet', CHILD_URL . '/sllea-our-model-page-style.css' );
			wp_enqueue_script('sllea-our-model');
		}

		//history page
		if( is_page(120) ){
			wp_enqueue_style( 'custom-stylesheet', CHILD_URL . '/sllea-history-page-style.css' );
		}

		//impact page
		if( is_page(118) ){
			wp_enqueue_style( 'custom-stylesheet', CHILD_URL . '/sllea-impact-page-styles.css' );
		}
		//apply page
		if( is_page(124) ){
			wp_enqueue_script('sllea-application');
			wp_enqueue_style( 'custom-stylesheet', CHILD_URL . '/sllea-apply-page-style.css' );
		}
	}

	function sllea_google_fonts() {
		wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700', array(), CHILD_THEME_VERSION );
	}

	//* Add HTML5 markup structure
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	//* Add viewport meta tag for mobile browsers
	add_theme_support( 'genesis-responsive-viewport' );

	//* Add support for menus/nav bar
	add_theme_support('sllea-slide-menu' );
	add_theme_support( 'genesis-menus' , array ( 'primary' => 'Primary Navigation Menu' , 'sllea-slide-menu' => 'Slide Menu' ) );

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

	require get_stylesheet_directory() . '/sllea-slide-menu.php';
	require get_stylesheet_directory() . '/sllea-header.php';	
	require get_stylesheet_directory() .'/team-cpt.php';
	require get_stylesheet_directory() .'/fact-slideshow-template.php';
	require get_stylesheet_directory() .'/fact-slideshow-cpt.php';	
	require get_stylesheet_directory() . '/sllea-footer.php';
