$(document).ready(function(){
 	var win = $(window),
 		menuToggle = $("#menu-toggle"),
	 	slideMenu = $("#slide-menu"),
	 	header = $(".site-header .content-inner"),
	 	footer = $(".site-footer"),
	 	pageContentWrap = $(".content"),
	 	menuOpen = false,
	 	resizeTimer;
	updateScreenDim();

	/* EVENT LISTENERS
	*******************************************/
	/* Highlight nav menu item of current page */
	$(".menu-item a").each(function(){
		if(this.href == window.location.href){ $(this).addClass('current-page'); }
	});

	/* Slide Menu toggle */
	menuToggle.on("click", function() {
		menuOpen? closeSlideMenu() : openSlideMenu();
	});

	/* Window resize */
     win.resize(function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(updateScreenDim, 1000);
    });

    /* HELPER FUNCTIONS
	*******************************************/
	function updateScreenDim() {
		if((win.width() > 960) && menuOpen) {
	       closeSlideMenu();
	    }
	}

	function openSlideMenu() {
		slideMenu.add(header).add(footer).add(pageContentWrap).addClass('menu-open');
		menuToggle.find('span').toggleClass('ion-android-close ion-android-menu');
		menuOpen = true;
	}

	function closeSlideMenu() {
		slideMenu.add(header).add(footer).add(pageContentWrap).removeClass('menu-open');
		menuToggle.find('span').toggleClass('ion-android-close ion-android-menu');
		menuOpen = false;
	}

});

