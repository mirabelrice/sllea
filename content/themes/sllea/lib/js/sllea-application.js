jQuery(document).ready(function($) {
	var browser = $(window),
        dialogOpen = false,
	    windowWidth = browser.width() - 100,
		resizeTimer,
	 	applyLink = $('#apply-link'),
		closeWindow = $(".close-window"),
		dialogBox = $("#coming-soon-window").dialog({
				'dialogClass'   : 'wp-dialog',           
        		'modal'         : true,
        		'draggable'     : false,
        		'resizable'     : false,
       			'autoOpen'      : false, 
        		'closeOnEscape' : true,  
        		'width'         : windowWidth
		});


    applyLink.click(function() {
    	dialogBox.dialog("open");
        dialogOpen = true;
    });

    closeWindow.on("click", function(){
   		dialogBox.dialog("close");
        dialogOpen = false;
    });

    browser.resize(function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(resizeWindow, 250);
    });

    function resizeWindow() {
    	var newWidth = browser.width() - 100;
    	dialogBox.dialog("option", "width", newWidth);
        if(dialogOpen) {
            $(closeWindow).trigger( "click" );
        }
    }


});