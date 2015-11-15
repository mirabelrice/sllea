<?php
	/**
	 * Genesis Framework child theme
	 * @author  Mirabel Rice
	 * this file contains methods used to customize header
	*/

	remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
	remove_action( 'genesis_header', 'genesis_do_header' );
	remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );
	add_action('genesis_header', 'sllea_header');
	add_filter('wp_nav_menu_items', 'customize_secondary_nav', 10, 2);

	function customize_secondary_nav($menu, $args) {
		if( !(is_page(20)) ){
			$args = (array)$args;
			if ( 'secondary' !== $args['theme_location'] )
				return $menu;
			$nav_link = '<li id="header-donate_link" class= "menu-item donate-link small"><a title="donate-page" href= "'. WP_SITEURL .'/donate/">Donate</a></li>';
			return $menu . $nav_link;
		}
	}

	function sllea_header() { 
		if( !(is_page(20)) ) :
			$is_landing = is_front_page();
			$header_classes = $is_landing ? "site-header landing" : "site-header";
			$header_row_right_classes = $is_landing? "header-row right hide" : "header-row right";
			?>
			<header class= "<?php echo $header_classes; ?>">
				<div class= "wrap">
					<div class= "header-row left">
						<div class= "social-icons-list">
							<ul>
					  			<li><a href= ""><span class="icon ion-social-facebook"></span></a></li>
					  			<li><a href= ""><span class="icon ion-social-twitter"></span></a></li>
					  			<li><a href= ""><span class="icon ion-social-instagram-outline"></span></a></li>
					  			<li><a href= ""><span class=" icon ion-social-linkedin"></span></a></li>
				  			</ul>
						</div>
					</div>
					<div class= "<?php echo $header_row_right_classes; ?>">
						<div class="row-wrap">
							<div id="header-primary-nav">
								<?php
									remove_action( 'genesis_after_header', 'genesis_do_nav' );
									genesis_do_nav();
								?>
							</div>
							<div id="header-donate" class= "donate-link small">
								<a title="donate-page" href= "<?php WP_SITEURL . '/donate' ?>">Donate</a>
							</div>
						</div>
					</div>
				</div>
			</header>
		<?php endif;
	}








