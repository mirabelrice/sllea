$(window).on("load", function() {
	$('#load-wrapper').fadeOut(1000);
});

$(document).ready(function(){
 	var win = $(window),
 		doc = $(document),
 		menuToggle = $("#menu-toggle"),
	 	slideMenu = $("#slide-menu"),
	 	header = $('.site-header'),
	 	headerInner = header.find('.content-inner'),
	 	headerNav = $('#header-primary-nav'),
	 	headerLogoText = $("#header-logo .text"),
	 	headerOffset = 150,
	 	footer = $(".site-footer"),
	 	pageContentWrap = $(".content"),
	 	menuOpen = false,
	 	atTop = true,
	 	isLanding = ($('#homepage-mark').length > 0),
	 	windowHeight = $(window).height(),
	 	scrollTimer,
	 	resizeTimer;

	init();

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

	/* Smooth scroll */
    $('a[href*=#]:not([href=#])').click(function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	      if (target.length) {
	        $('html,body').animate({
	          scrollTop: target.offset().top - 50
	        }, 1000);
	        return false;
	      }
	    }
 	});

    /* HELPER FUNCTIONS
	*******************************************/
	//initialize and bind functions
	function init() {
		if(isLanding){
			win.bind("scroll", headerScrollListener);
		}
	}

	function updateScreenDim() {
		if((win.width() > 960) && menuOpen) {
	       closeSlideMenu();
	    }
	}

	function openSlideMenu() {
		slideMenu.add(headerInner).add(footer).add(pageContentWrap).addClass('menu-open');
		menuToggle.find('span').toggleClass('ion-android-close ion-android-menu');
		menuOpen = true;
	}

	function closeSlideMenu() {
		slideMenu.add(headerInner).add(footer).add(pageContentWrap).removeClass('menu-open');
		menuToggle.find('span').toggleClass('ion-android-close ion-android-menu');
		menuOpen = false;
	}

	function headerScrollListener() {
		if( atTop && (doc.scrollTop() >= headerOffset)){
            headerNav.removeClass('hide');
            header.removeClass('landing');
            headerLogoText.removeClass('landing');
            menuToggle.removeClass('landing');
	    }else{
	   		clearTimeout(scrollTimer);
        	scrollTimer = setTimeout(function(){
        		if(doc.scrollTop() === 0) {
        			header.addClass('landing');
        			headerNav.addClass('hide');
        			headerLogoText.addClass('landing');
        			menuToggle.addClass('landing');
                    atTop = true;
        		}
        	}, 100);
	    }
	}
});

