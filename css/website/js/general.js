// JavaScript Document
$(document).ready(function() {
	jQuery("*:first-child").addClass("first");
	jQuery("*:last-child").addClass("last");
	jQuery(".bodyComponent.articlesList > div.last > div > ul > li:nth-child(even), .featuredNewsContainer > ul.first > li:nth-child(even)").addClass("zebra");
/************************************************************/
	jQuery("ul.headerTabs").minimalTabs({
		startWith: 1,
		animate: true, 
		duration: 250});
/************************************************************/
	jQuery("ul.featuredNewsList").minimalTabs({
		startWith: 1,
		animate: true, 
		duration: 250});
/************************************************************/

//**************************By Gado**************************//
$.fn.extend ({
	HeaderTabe : function(options){
		var HeaderTabe = {
			'Time': 1000,
			'container': '',
			'item': '',
			'length': function(){
				return $(this['container']).find(this['item']).length
			},
			'current_index': 0,
			'min_index': 0,
			'max_index': function(){
				return this['length']() - 1;
			},
			'PlayVar': false,
			'RunHeaderTabs': function(){
				this['current_index'] = $(this['container']).find(this['item'] + '.selected').index();
				this['current_index']++;
				if(this['current_index'] > this['max_index']()){
					this['current_index'] = this['min_index'];
				}
				$(this['container']).find(this['item'] + ':eq(' + this['current_index'] + ') a').trigger('click');
			},
			'PlayHeaderTabs': function(){
				if(!this['PlayVar']){
					var sThis = this;
					this['PlayVar'] = setInterval(function(){
						sThis['RunHeaderTabs']();
						//console.log(sThis['current_index']);
					}, this['Time']);
				}
			},
			'StopHeaderTabs': function(){
				clearInterval(this['PlayVar']);
				this['PlayVar'] = false;
			},
			'Hover': function(){
				var sThis = this;
				$(sThis['container']).hover(
					function(){
						sThis['StopHeaderTabs']();
					},
					function(){
						sThis['PlayHeaderTabs']();
					}
				);
			},
			'Start': function(options){
				$.extend(this, options);
				this['PlayHeaderTabs']();
				this['Hover']();
			}
		};
		var Config = {
			'Time': 1000,
			'item': ''
		}
		$.extend(Config, options);
		var sThis = this;
		HeaderTabe['Start']({
			'Time': Config['Time'],
			'container': sThis,
			'item': Config['item']
		});
	}
});

if($('.wideHomePreview').length > 0){
	$('.wideHomePreview').HeaderTabe({
		//By Gouda.
		//'Time': 3000,
		'Time': 15000,
		'item': 'ul.headerTabs li'
	});
}
if($('.featuredNewsWrapper').length > 0){
	$('.featuredNewsWrapper').HeaderTabe({
		//By Gouda.
		//'Time': 3000,
		'Time': 15000,
		'item': 'ul.featuredNewsList li'
	});
}
//**************************/By Gado**************************//


});