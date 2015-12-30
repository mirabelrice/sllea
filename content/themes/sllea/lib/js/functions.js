$(document).ready(function(){
	$(".menu-item a").each(function(){
		if(this.href == window.location.href){ $(this).addClass('current-page'); }
	});

	
});

