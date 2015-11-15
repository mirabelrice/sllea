jQuery(document).ready(function($){
    var resizeTimer,
        win = $(window),
  	 	scrollTimer,
        siteContainer = $(".site-container"),
        slideMenu = $("#menu-overlay"),
        header = $(".site-header"),
        menuToggle = $("#menu-toggle"),
        atTop = true,
        menuOpen = false;
        headerOffset = 300;
        windowHeight = 0;

    updateScreenDim();

    win.resize(function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(updateScreenDim, 1000);
    });

    menuToggle.on("click",function(event){
        menuOpen? slideMenu.removeClass('menu-open') : slideMenu.addClass('menu-open');
        $(this).toggleClass('menu-open').find('span').toggleClass('ion-android-close ion-android-menu');
        menuOpen = !menuOpen;
    });

    function updateScreenDim() {
        if((win.width() > 960) && menuOpen) {
            slideMenu.removeClass("menu-open");
            menuOpen = false;
        }
        if(windowHeight != win.height()){
            windowHeight = win.height();
            slideMenu.css("height", windowHeight);
        }
    };
});
