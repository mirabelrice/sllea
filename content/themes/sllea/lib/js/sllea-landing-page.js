jQuery(document).ready(function($) {
	var loadWrapper = $("#load-wrapper"),
		windowHeight = $(window).height();
		loadWrapper.css("height",windowHeight);

	$(window).on("load", function() {
		loadWrapper.fadeOut(1000);
		var landingTween = new TimelineMax();
		landingTween.from(".landing-animated", 1, {opacity:0, delay: 1});
		landingTween.from("#continue-to-site", .3, {y: 15, opacity:0, ease:Linear.easeOut});
		//tween.fromTo(('#landing-content .logo'), .2, {top: 100, opacity: 0}, {top: 0, opacity: 1});
	});

	var browser = $(window),
		header = $(".site-header"),
		//headerNav = $("#header-primary-nav"),
		//headerDonate = $("#header-donate"),
		headerRow = $(".site-header .header-row.right"),
        atTop = true,
        headerOffset = 150,
        scrollTimer,
        mouseMoveTimeout,
		videoLink = $('#video-link'),
		videoContainer = $('#video-container'),
		iframe = videoContainer.find('iframe'),
		closeWindow = $("#close-window"),
		player = $f(iframe[0]),
		offset = $('body').scrollTop(),
		windowWidth = browser.width(),
		landingPage = $("#site-landing"),
		logo = $('#landing-content .logo'),
		initiativeBlocks = $("#initiative-block").children(".initiative-column"),
		scrollMagicController = new ScrollMagic.Controller(),
		closeWindowVisible = false;

	videoLink.show().css("display", "block");
	var	playerWindow = $("#trailer-window").dialog({
				'dialogClass'   : 'wp-dialog',           
        		'modal'         : true,
        		'draggable'     : false,
        		'resizable'     : false,
       			'autoOpen'      : false, 
        		'closeOnEscape' : true,  
        		'width'         : windowWidth,
        		'height'        : windowHeight,
        		close        	: function(event, ui) {

        			player.api("pause");
        		 }
	});
	updateDim();

	//search for key words in mission statement and bold/color them
	$("#mission-statement").html(function(index, html){
		return html.replace(/(SLLEA)/g,'<span class= "emphasized-word">$1</span>')
					.replace(/( Autism Spectrum Disorder)/,'<span class= "emphasized-word">$1</span>')
					.replace(/(specialized)/g,'<span class= "emphasized-word">$1</span>')
					.replace(/(support)/g,'<span class= "emphasized-word">$1</span>')
					.replace(/(global)/g,'<span class= "emphasized-word">$1</span>');
	});
	
	/* SCROLL MAGIC SCENES */
	//mission statement text
	/*
	var textTween = new TimelineMax();
		textTween.from(".emphasized-word", .3, {opacity: "0", delay:0, ease:Linear.easeOut});
		//textTween.from("#mission-statement p", .5, {opacity: "0", delay:.5, ease:Linear.easeOut});	
	var missionScene = new ScrollMagic.Scene({triggerElement:'#mission-statement', reverse: false})
		.setTween(textTween)
		.addTo(scrollMagicController);
*/
	var textTween = TweenMax.staggerFrom(".emphasized-word", .8, {opacity: "0", ease:Linear.easeOut}, .2);
	var missionScene = new ScrollMagic.Scene({triggerElement:'#mission-statement', reverse: false})
		.setTween(textTween)
		.addTo(scrollMagicController);
	//remove header when reached footer
	var donateScene = new ScrollMagic.Scene({triggerElement:'#fact-slideshow-area', duration: .1})
		.setTween(".site-header", {opacity: "0"})
		.addTo(scrollMagicController);

	//move initiative columns up
	
	var initiativeTween = new TimelineMax();
	initiativeTween.staggerFrom(".initiative-column", .5, {opacity: "0", ease:Linear.easeOut}, 0.2);
	var initiativeScene = new ScrollMagic.Scene({triggerElement: '#impact', reverse: false})
		.setTween(initiativeTween) 
		.addTo(scrollMagicController);

	//move slide controls out
	var slideControlTween = new TimelineMax();
		slideControlTween.from("#slide-forward", 1, {x: "-90px", opacity: "0", delay:0, ease: Power2.easeOut}, 1);
		slideControlTween.from("#slide-back", 1, {x: "90px", opacity: "0", delay:0, ease: Power2.easeOut}, 1);
	var slideshowScene = new ScrollMagic.Scene({triggerElement: '#initiative-block', triggerHook: 'onLeave', reverse: false})
		.setTween(slideControlTween)
		.addTo(scrollMagicController);

	function updateDim() {
		if(windowHeight >= 768) {
			landingPage.css('height', windowHeight);
		}
		playerWindow.height(windowHeight);
		playerWindow.width(windowWidth);
	}

    browser.scroll(function() {
        if($(this).width() > 960) {
    	    if( atTop && $(document).scrollTop() >= headerOffset){
                header.removeClass('landing');
                headerRow.removeClass('hide');
               // headerNav.removeClass('hide');
               // headerDonate.removeClass('hide');
    	   }else{
    	   		clearTimeout(scrollTimer);
            	scrollTimer = setTimeout(function(){  		
            		if($(document).scrollTop() === 0) {
            			header.addClass('landing');
            			headerRow.addClass('hide');
            			//headerNav.addClass('hide');
                		//headerDonate.addClass('hide');
                        atTop = true;
            		}
            	}, 200);
    	    }
        }
	});

	/*reset scroll width when window size changes*/
	$(window).resize(function() {
		var resizeTimer = setTimeout(function(){
			var newHeight = $(this).height();
			var newWidth = $(this).width();
    		if(newHeight != windowHeight) {
    			windowHeight = newHeight;
    			windowWidth = newWidth;
    			updateDim();
    		}
    	}, 1000); 	
    });


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

 	/*VIDEO PLAYER*/
 	player.addEvent('ready', readyFunction);
 	function readyFunction() {
		player.addEvent('finish', onFinish);
	}

	videoLink.on('click', function(){
		playerWindow.dialog("open");
		player.api("play");
		closeWindowVisible = true;
	});

	closeWindow.on("click", onFinish);

	function onFinish() {
		playerWindow.dialog("close");
		player.api("pause");
		//$(document).off("mousemove");
	}
	//$(document).on("mousemove", mouseActive);

});