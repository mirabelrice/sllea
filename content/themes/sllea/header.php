<?php
	/**
	 * Creates the header
	*/
	$donate_url = get_bloginfo('url'). '/donate';
	$is_landing = is_front_page();
	$header_classes = $is_landing ? "site-header landing" : "site-header";
	$header_row_right_classes = $is_landing? "header-row right hide" : "header-row right";
?>
<!DOCTYPE html>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php sllea_page_title(); ?></title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
	<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.gsap.js"></script>

	<?php if (is_search() || is_attachment()) : ?>
		<meta name="robots" content="noindex, nofollow" />
	<?php endif; ?>

	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php include('sllea-slide-menu.php'); ?>
	<header class= "<?php echo $header_classes; ?>">
		<div class= "wrap">
			<div class= "header-row left">
				<div class= "social-icons-list">
					<ul>
			  			<li><a href= ""><span class="icon ion-social-facebook"></span></a></li>
			  			<li><a href= ""><span class="icon ion-social-twitter"></span></a></li>
			  			<li><a href= ""><span class="icon ion-social-instagram-outline"></span></a></li>
			  			<li><a href= ""><span class="icon ion-social-linkedin"></span></a></li>
		  			</ul>
				</div>
			</div>
			<div class= "<?php echo $header_row_right_classes; ?>">
				<div class="row-wrap">
					<div id="header-primary-nav">
						<?php wp_nav_menu(array('container' => 'nav', 'container_id' => 'navigation_menu', 'container_class' => 'horizontal', 'sort_column' => 'menu_order','theme_location' => 'primary', 'fallback_cb' => false)); ?>
					</div>
					<div id="header-donate" class= "donate-link small">
						<a title="donate-page" href= "<?php echo $donate_url; ?>">Donate</a>
					</div>
				</div>
			</div>
		</div>
	</header>








