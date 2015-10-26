jQuery(document).ready( function($) {
	var slideShow = $('#fact-slideshow-area'),
		slideShowTop = slideShow.offset().top,
		scroller = slideShow.find('.scroller'),
		slideContainer = slideShow.find('.slides'),
		slides = slideContainer.children('.slide'),
		controlNav = slideShow.find('#slide-controls .controls.left li'),
		directionalNav = slideShow.find('.direction-control'),
		numSlides = slides.length - 1, //first and last slides are dummy slides
		slideWidth = scroller.width(),
		animationSpeed = 500,
		transitionSpeed = 4000,
		destinationSlide,
		currentSlide = 0,
		anticipatedEvent = '',
		direction,
		isVisible = false,
		pauseOnAction = true,
		slideShowStarted = false,
		atEnd = false,
		override = false,
		animating = false,
		isDirectionalNav = false,
		anticipatedEventTimer,
		scrollTimer,
		resizeTimer,
		slideShowInterval,
		eventType = "click",
		globalProm = $.Deferred;

	slideContainer.css('margin-left', (slideWidth * -1));
	controlNav.eq(0).addClass("selected");

	/* main loop for slide show*/
	function slideShowLoop() {
		slideShowStarted = isVisible = true;
		slideShowInterval = setInterval(function() {
			globalProm = animateSlides(getTarget("next"));
		}, transitionSpeed);	
	}
	function getTarget(dir) {
		if (dir === "next") {
			return (currentSlide === numSlides - 1)? 0 : currentSlide + 1;//check if target slide is at end
		} else {
			return (currentSlide === 0)? numSlides - 1 : currentSlide - 1;//check if target slide is at beginning
		}
	}
	function animateSlides(target, override) {
		animating = true;
		var changeMargin;
		var animatePromise = new $.Deferred;

		if(target === currentSlide) {
			console.log("same slide");
			animatePromise.resolve();
			return animatePromise.promise();
		}
		
		destinationSlide = target;

		atEnd = (target === 0) || (target === (numSlides - 1));
	
		if(override) {
			changeMargin = (target - currentSlide) * slideWidth;
			if(isDirectionalNav && atEnd) {
				changeMargin = (direction === "next")? slideWidth: slideWidth * -1;
			}
		}else{
			changeMargin = slideWidth;
		}

		transitionSlides(changeMargin).done(function(){
			console.log("doneAnimating");
			if(atEnd) {
				jumpEnd();
			}
			animating = false;
			currentSlide = destinationSlide;
			animatePromise.resolve();
		});	
		return animatePromise.promise();
	}

	function transitionSlides(changeMargin) {
		console.log("animating");
		var defs = [];//holds deferred object variables for animations
		defs.push(slideContainer.animate({'margin-left':'-='+ changeMargin}, animationSpeed).promise());
		defs.push(controlNav.eq(currentSlide).removeClass("selected").promise());
		defs.push(controlNav.eq(destinationSlide).addClass("selected").promise());
		return $.when.apply(null, defs);
	}

	function jumpEnd() {
		if(destinationSlide === numSlides - 1){//going backwards from first to last slide, reset margin to end.
			var resetMargin = slideWidth * -1 * (numSlides);
			slideContainer.css('margin-left', resetMargin);
		}else{//going forwards from last to first slide, reset margin to beginning.
			slideContainer.css('margin-left', (slideWidth  * -1));
		}
		atEnd = false;
	}	

	/* slide control pagers*/
	controlNav.on(eventType, controlNavClick);
	function controlNavClick(){
		console.log("nav control pressed");
		override = true;
		var def = $.Deferred;
		controlNav.off('click', controlNavClick);

		var $this = $(this),
			target = $this.index();

		if(target != currentSlide) {
			direction = (target > currentSlide) ? "next" : "prev";
			if(animating){
				globalProm.done(function(){	
					clearInterval(slideShowInterval);
					def = animateSlides(target, true);
				});
			}else{
				clearInterval(slideShowInterval);
				def = animateSlides(target, true);

			}
			def.done(function() {
				console.log("transition done");
				override = false;
				//clearAnticipatedEvent();
				anticipatedEvent = "";
				controlNav.on("click", controlNavClick);
				slideShowLoop();
			});
		}
	}

	/* Direction Controlls*/
	directionalNav.on("click", directionalNavClick);

	function directionalNavClick(){
		directionalNav.off("click", directionalNavClick);
		override = isDirectionalNav = true;
		var navDir = $(this).hasClass('forward')? "next" : "prev",
		target = getTarget(navDir);
		globalProm.done(function(){	
			clearInterval(slideShowInterval);
			direction = navDir;
			animateSlides(target, true).done(function(){
				console.log("now ready to transition");
				override = isDirectionalNav = false;
				slideShowLoop();
				directionalNav.on("click", directionalNavClick);
			});	
		});
	}

	/*reset scroll width when window size changes*/
	$(window).resize(function() {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(function(){
			if(!animating) {
				clearInterval(slideShowInterval);
				getNewWidth();
			}else{
				if(!override) {
					globalProm.done(function() {
						clearInterval(slideShowInterval);
						console.log("not animating resize");
						getNewWidth();					
					});
				}		
			}
			if(isVisible && !override){slideShowLoop();}
    	}, 500); 	
    });

    function getNewWidth() {
    	var newWidth = scroller.width();
		if(newWidth != slideWidth) {
			var newMargin = newWidth * -1;
			if(currentSlide != 0){newMargin *= (currentSlide + 1)}; 
    		slideContainer.css('margin-left', newMargin);
    		slideWidth = newWidth;	
		}
    }

    $(window).scroll(function() {
    	console.log("scrolling");
    	clearTimeout(scrollTimer);
    	scrollTimer = setTimeout(function(){
    		console.log("timeout fired");
	    	isVisible = isSlideShowInView();
	    	if(isVisible) {
	    		console.log("scrolled to visible");
	    		if(!slideShowStarted && !override && !animating){
	    			slideShowLoop();
	    			/*
	    			globalProm.done(function(){
	    				clearInterval(slideShowInterval);
	    				console.log("waiting until finished...");
	    				slideShowLoop();
	    			});
*/
    			}	
	    	}else{
	    		console.log("scrolled out of view");
	    		if(slideShowStarted){
	    			clearInterval(slideShowInterval);
	    		}
	    	}
    	}, 500);
    });

    function isSlideShowInView() {
    	var docViewTop = $(window).scrollTop(),
        	docViewBottom = docViewTop + $(window).height(),
         	inView = (docViewBottom >= slideShowTop);
        return inView;
    }
});