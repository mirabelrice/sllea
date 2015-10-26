/*
window.onload = function() {
	var textSections = document.querySelectorAll("p.text.expandable");
	var numSections = textSection.length;
	for(i = 0; i < numSections.length; i++) {
		var textHeight = textSections[i].clientHeight;
		var containerHeight = teamMembers[i].getElementsByClassName("team-member-wrap")[0].clientHeight;
		if(textHeight > containerHeight) {
			teamMembers[i].getElementsByClassName("overflow-link")[0].style.visibility = "visible";
		}
	}
}
*/
jQuery(document).ready(function($) {
	var sectionHeight = $(window).height() - 50 * .90,
		container = $(".content-row");
	if(sectionHeight > 450) {
		sectionHeight = 450;
	}
	container.css('height', sectionHeight);

	var scrollMagicController = new ScrollMagic.Controller({
		 globalSceneOptions: {
            reverse: false
        }
	});
	container.find(".model-section.text").each(function (index) {
		var headline = $(this).children('h2');
		var text = $(this).children('.text-wrap');
		var tween = new TimelineMax();
		tween.from(headline, 2, {y: '20px',opacity: 0, ease:Power4.easeOut});
		tween.from(text, 3, {opacity: 0, ease:Power4.easeOut}, .8);

		var parallax = new ScrollMagic.Scene({triggerElement: container[index], reverse: true})
			.setTween(tween)
			.addTo(scrollMagicController);
	});
});

