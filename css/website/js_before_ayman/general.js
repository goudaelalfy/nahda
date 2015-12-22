// JavaScript Document
$(document).ready(function () {
    jQuery("*:first-child").addClass("first");
    jQuery("*:last-child").addClass("last");
    jQuery(".bodyComponent.articlesList > div.last > div > ul > li:nth-child(even), .featuredNewsContainer > ul.first > li:nth-child(even)").addClass("zebra");
    /************************************************************/
    jQuery("ul.headerTabs").minimalTabs({
        startWith: 1,
        animate: true,
        duration: 250
    });
    /************************************************************/
    jQuery("ul.featuredNewsList").minimalTabs({
        startWith: 1,
        animate: true,
        duration: 250
    });
    /************************************************************/
    jQuery("ul.homeGalleryTabs").minimalTabs({
        startWith: 1,
        animate: true,
        duration: 250
    });
    /************************************************************/
    //// home slider rotator
    var activIndex;
    var nxtActiv;
    var liLenght = $('ul.featuredNewsList li').size();
    setInterval(function () {
        activIndex = $('ul.featuredNewsList li.selected').index();
        nxtActiv = activIndex + 1;
        $('ul.featuredNewsList li').removeClass('selected');
        if (activIndex < liLenght - 1) {
            $('ul.featuredNewsList li').eq(nxtActiv).addClass('selected');

        }
        else {
            activIndex = 0;
            nxtActiv = activIndex + 1;
            $('ul.featuredNewsList li').eq(activIndex).addClass('selected');
        }
        //debugger;
        var selectedLi = $('ul.featuredNewsList li.selected').index();
        $('.featuredNewsContainer ul.last li').hide();
        $('.featuredNewsContainer ul.last li').eq(selectedLi).show();
    }, 2000);
    /************************************************************/
    // selected photos

    var count = 0;
    var n = $("#slideshow  li, .slideshow  li").length;
    var m = 1;
    $("span#allSlides, span.allSlides").text(n);
    $("span#currentSlide, span.currentSlide").text(m);
    $("#nxt, .nxt").click(function () {
        if (count == (n - 1)) {
            count = 0;
        }
        else {
            count++;
        }
        $('#slideshow li, .slideshow li').removeClass('current');
        $('#slideshow li, .slideshow li').eq(count).addClass('current');
        m = ($("#slideshow li.current, .slideshow li.current").index() + 1);
        $("span#currentSlide, span.currentSlide").text(m);
    });
    $("#prev, .prev").click(function () {
        if (count == 0) {
            count = (n - 1);
        }
        else {
            count--;
        }

        $('#slideshow li, .slideshow li').removeClass('current');
        $('#slideshow li, .slideshow li').eq(count).addClass('current');
        m = ($("#slideshow li.current, .slideshow li.current").index() + 1);
        $("span#currentSlide, span.currentSlide").text(m);
    });


    /******************************* login fancy box******************************************/
    $(".fancyLogin").fancybox({
        'autoScale': false,
        'transitionIn': 'elastic',
        'transitionOut': 'elastic',
        'type': 'iframe'
    });

});