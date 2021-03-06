<?php
	$logo_url = get_stylesheet_directory_uri() .'/images/mirbz.png';
	$donate_url = get_bloginfo('url'). '/donate';
	$header_classes = "site-header";
	$nav_classes = "header-column";
	$logo_text_classes = "logo-column text";
	$menu_toggle_classes = '';

	if(is_front_page()) {
		$header_classes .= " landing";
		$nav_classes .= " hide";
		$menu_toggle_classes .= " landing";
		$logo_text_classes .= " landing";
	}
	if(is_page('donate')){
		require_once get_stylesheet_directory() .'/includes/process-donation-form.php';
	}
?>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php echo sllea_page_title(); ?></title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
	<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico" type="image/x-icon" />
	<script src="https://use.typekit.net/byu3tqy.js"></script>
	<script>try{Typekit.load({ async: true });}catch(e){}</script>
	<script type="text/javascript">
    	var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
	</script>
	<?php if (is_search() || is_attachment()) : ?>
		<meta name="robots" content="noindex, nofollow" />
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
 <!-- START BODY WRAP-->
	<div class="body-wrap">
	<?php include('sllea-slide-menu.php'); ?>
	<header class= "<?php echo $header_classes; ?>">
		<div class= "content-wrap">
			<div class="content-inner">
				<div class="inner-row">
					<div class=" header-column">
						<div id="header-logo">
							<a class="logo-link" href= "<?php bloginfo('url'); ?>">
								<img class="logo-column image" src="<?php echo $logo_url; ?>"/>
								<p class="<?php echo $logo_text_classes; ?>">SLLEA</p>
							</a>
						</div>
					</div>
					<div id="header-primary-nav" class = "<?php echo $nav_classes; ?>">
						<div class="column-wrap">
							<?php wp_nav_menu(array('container' => 'nav', 'container_id' => 'navigation_menu', 'container_class' => 'horizontal', 'sort_column' => 'menu_order','theme_location' => 'primary-menu', 'fallback_cb' => false)); ?>
						</div>
					</div>
					<div id="header-donate" class= "donate-link small header-column">
						<a title="donate-page" href= "<?php echo $donate_url; ?>">Donate</a>
					</div>
					<div id="menu-toggle" class="<?php echo $menu_toggle_classes ?>"><a><span class= "icon ion-android-menu"></span></a></div>
				</div>
			</div>
		</div>
	</header>