/*
 *  minimalTabs - simple tabs jQuery plugin
 *  http://labs.smasty.net/jquery/minimalTabs/
 *
 *  Copyright (c) 2010 Martin Srank (http://smasty.net)
 *  Licensed under the MIT license (http://www.opensource.org/licenses/mit-license.php).
 *
 *  Built for jQuery library
 *  http://jquery.com
 *
 */
(function($) {
	$.fn.extend ({
		minimalTabs : function(options){
			var
			defaults = {
				animate: false, 
				duration: 300, 
				startWith: 1, 
				eventType: 'click'
				},
			settings = $.extend(defaults, options);
  
    return this.each(function() {
      $(this).children('li').find('a.first').each(function(){

        $($(this).attr('href')).hide();

        $(this).bind(settings.eventType, function(e){
          e.preventDefault();
          
          var parentLi = $(this).parent('li');
		  
		  $(parentLi).addClass('selected');
		  $(parentLi).next().addClass('selectedNext');
	  	  $(parentLi).prev().addClass('selectedPrev');
          /************************************************************/
		  /************************************************************/
          //settings.animate ? $($(this).attr('href')).fadeIn(settings.duration) : $($(this).attr('href')).show();
		  if (settings.animate) {
			  $($(this).attr('href')).fadeIn(settings.duration);
			  } else {
			  $($(this).attr('href')).show();
			}
		  /************************************************************/
		  /************************************************************/
          
          $($(parentLi).siblings().find('a')).each(function(){
            $(this).parent('li').removeClass('selected');
			$(this).parent('li').next().removeClass('selectedNext');
	  		$(this).parent('li').prev().removeClass('selectedPrev');
            $($(this).attr('href')).hide();
          });
        });
      });
	  
      var first = $(this).closest("ul").find('li:nth-child(' + settings.startWith + ')');
      $(first).addClass('selected');
	  $(first).next().addClass('selectedNext');
	  $(first).prev().addClass('selectedPrev');
      $($(first).find('a').attr('href')).show();
    });
  }
});
})(jQuery);
