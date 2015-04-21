window.jQuery = window.$ = jQuery; /*SherkSkillsJS type class*/
 	
var SherkSkillsJS = function() {
	
	//widget
	$(document).ready(function(){
		$('.bxslider').bxSlider({
			auto: true,
			autoControls: true,
			captions: true,
			adaptiveHeight:true,
			slideWidth: 200,
			minSlides: 2,
			maxSlides: 3,
			moveSlides: 3,
			slideMargin: 10
		});
	});
	
};

new SherkSkillsJS();