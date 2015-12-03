<div id="menu-toggle"><a><span class= "icon ion-android-menu"></span></a></div>
<div id="menu-overlay">
	<div id= "slide-menu" class= "slide-menu-section">
		<?php wp_nav_menu(array('container' => 'nav', 'container_id' => 'slide-nav', 'container_class' => 'horizontal', 'sort_column' => 'menu_order','theme_location' => 'sllea-slide-menu', 'fallback_cb' => false)); ?>
	</div>
</div>