<?php

	add_action( 'genesis_before', 'slide_menu' );

	function slide_menu() { ?> 
		<div id="menu-toggle"><a><span class= "icon ion-android-menu"></span></a></div>
		<div id="menu-overlay">	
			<div id= "slide-menu" class= "slide-menu-section"><?php create_slide_menu(); ?></div>
		</div>
<?php }


	function create_slide_menu() {
		//* Do nothing if menu not supported
		if ( ! genesis_nav_menu_supported( 'sllea-slide-menu' ) )
			return;

		//* If menu is assigned to theme location, output
		if ( has_nav_menu( 'sllea-slide-menu' ) ) {

			$class = 'menu genesis-nav-menu';
			if ( genesis_superfish_enabled() )
				$class .= ' js-superfish';

			$args = array(
				'theme_location' => 'sllea-slide-menu',
				'container' => '',
				'menu_class'     => $class,
				'echo'           => 0,
			);

			$slide_menu = wp_nav_menu( $args );

			//* Do nothing if there is nothing to show
			if ( ! $slide_menu )
				return;

			$slide_menu_markup_open = genesis_markup( array(
				'html5'   => '<nav %s>',
				'xhtml'   => '<div id="slide-menu">',
				'context' => 'slide-nav',
				'echo'    => false,
			) );
			
			//$responsive_menu_markup_open .= genesis_structural_wrap( 'slide-menu', 'open', 0 );
			//$responsive_menu_markup_close  = genesis_structural_wrap( 'slide-menu', 'close', 0 );
			$slide_menu_markup_close = genesis_html5() ? '</nav>' : '</div>';
			$slide_menu_output = $slide_menu_markup_open . $slide_menu . $slide_menu_markup_close;

			echo apply_filters( 'create_sllea_menu', $slide_menu_output, $slide_menu, $args );

		}
	}
