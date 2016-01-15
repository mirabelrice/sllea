jQuery(document).ready( function($) {
	var slideShow = $('#fact-slideshow-area'),
		controlNav = slideShow.find('#slide-controls .controls.left li'),
		directionalNav = slideShow.find(".direction-control"),
		scroller = slideShow.find('.scroller'),
		slideContainer = slideShow.find('.slides'),
		slides = slideContainer.children('.slide'),
		numSlides = slides.length - 1, //first and last slides are dummy slides
		slideWidth = scroller.width(), //used to calculate margin for slide changes
		currentSlide = 0,
		destinationSlide,
		animationSpeed = 500, //speed of the slide change animation
		transitionSpeed = 4000, //how long between slide changes
		isPlaying = false,
		isPaused = false,
		isAnimating = false,
		isAtEnd = false,
		isDirectionalNav = false,
		direction,
		resizeTimer,
		slideShowInterval;

	/* Initialize Slideshow */
	slideContainer.css('margin-left', (slideWidth * -1));
	controlNav.eq(0).addClass("selected");
	slideShowLoop();


	/*SLIDSHOW CONTROL METHODS
	********************************************************/
	/* main loop for slide show*/
	function slideShowLoop() {
		isPlaying = true;

		//loop through the slides
		slideShowInterval = setInterval(function() {
			animateSlides(getTarget("forward"));
		}, transitionSpeed);
	}

	/* Starts or stops slideshow */
	function pause() {
		isPaused = !isPaused;
		if(isPlaying) {
			clearInterval(slideShowInterval);
			isPlaying = false;
		} else {
			slideShowLoop();
		}
	}

	/* Controls slide transition from current slide to target */
	function animateSlides(target, override) {
		isAnimating = true;
		destinationSlide = target;
		var changeMargin;
		isAtEnd = (destinationSlide === 0) || (destinationSlide === (numSlides - 1));

		if(override) {
			if(isDirectionalNav) {
				changeMargin = (direction === "forward")? slideWidth: slideWidth * -1;
			}else {
				changeMargin = (target - currentSlide) * slideWidth;
			}
		} else {
			changeMargin = slideWidth;
		}

		transitionSlides(changeMargin).done(function(){
			if(isAtEnd){ resetSlides(); }
			currentSlide = destinationSlide;
			isAnimating = false;
			if(isPaused) { pause(); }
		});
	}

	/* Returns promise when all slideshow animation is complate */
	function transitionSlides(changeMargin) {
		var defs = [];//holds deferred object variables for animations
		defs.push(slideContainer.animate({'margin-left':'-='+ changeMargin}, animationSpeed).promise());
		defs.push(controlNav.eq(currentSlide).removeClass("selected").promise());
		defs.push(controlNav.eq(destinationSlide).addClass("selected").promise());
		return $.when.apply(null, defs);
	}

	/* resets slideshow margin if at beginning or end of loop */
	function resetSlides() {
		if(destinationSlide === numSlides - 1){//going backwards from first to last slide, reset margin to end.
			var resetMargin = slideWidth * -1 * (numSlides);
			slideContainer.css('margin-left', resetMargin);
		}else{//going forwards from last to first slide, reset margin to beginning.
			slideContainer.css('margin-left', (slideWidth  * -1));
		}
		isAtEnd = false;
	}


	/* EVENTS
	***********************************************************/
	/* slide control Nav click event */
	controlNav.on("click", function(event) {
		var target = $(this).index();

		//if not animating and valid target, stop slideshow interval and change to targeted slide.
		if(!isAnimating && target != currentSlide) {
			pause();
			animateSlides(target, true);
		}
	});

	directionalNav.on("click", function(event) {
		var navDir = $(this).hasClass('forward')? "forward" : "back",
		target = getTarget(navDir);
		isDirectionalNav = true;

		if(!isAnimating && target != currentSlide) {
			pause();
			direction = navDir;
			animateSlides(target, true);
			isDirectionalNav = false;
		}
	});

	/*reset scroll width when window size changes*/
	$(window).resize(function() {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(function(){
			if(!isAnimating) {
				pause();
				getNewWidth();
				pause();
			}
    	}, 500);
    });


	/* HELPER METHODS
	****************************************************/
	/* Returns slide index of target slide */
	function getTarget(dir) {
		if (dir === "forward") {
			return (currentSlide === numSlides - 1)? 0 : currentSlide + 1;//check if target slide is at end
		} else {
			return (currentSlide === 0)? numSlides - 1 : currentSlide - 1;//check if target slide is at beginning
		}
	}

	/* recalculates slideshow width when window size changes */
    function getNewWidth() {
    	var newWidth = scroller.width();
		if(newWidth != slideWidth) {
			var newMargin = newWidth * -1;
			if(currentSlide !== 0){ newMargin *= (currentSlide + 1); }
    		slideContainer.css('margin-left', newMargin);
    		slideWidth = newWidth;
		}
    }

});