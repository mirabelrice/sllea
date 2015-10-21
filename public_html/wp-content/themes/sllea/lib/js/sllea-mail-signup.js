jQuery(document).ready(function($){
	$("#mail-signup-link").on("click", function(){
		$('#mail-signup-form').slideToggle();
		$("#mail-signup-action").toggleClass('fa-chevron-down fa-times');
		$('html,body').animate({
        	scrollTop: $("#mail-signup-action").offset().top},'slow');
	});

	$("#sllea-mail-list input[type=submit]").on('click', function(event){
		event.preventDefault();
	});
});