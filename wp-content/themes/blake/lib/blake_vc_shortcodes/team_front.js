(function($){
	"use strict";
	jQuery('.des-team-shortcode').each(function(){
		var who = jQuery(this),
			ajax_url_shortcodes = jQuery('#templatepath').html()+"/lib/blake_vc_shortcodes/shortcoder.php";
		if (who.hasClass('withscroller')){
			var owlopts = who.next('.des_shortcode_hidden').html().split('|');
			if (owlopts[0] == 'yes') owlopts[0] = parseInt(owlopts[1],10); else owlopts[0] = false;
			if (owlopts[6] == 'yes') {
				owlopts[6] = true;
				who.addClass('nav-'+owlopts[9]);
			} else owlopts[6] = false;
			if (owlopts[7] == 'yes') {
				owlopts[7] = true; 
				who.addClass('controlnav-'+owlopts[10]);
			} else owlopts[7] = false;
			if (owlopts[8] == 'yes') owlopts[8] = true; else owlopts[8] = false;
			who.slick({
				dots: owlopts[7], 
				autoplay: owlopts[0], 
				autoplaySpeed:5000, speed:600, infinite: true,
				arrows: owlopts[6],
				adaptiveHeight:true,
				nextArrow:'<button type="button" style="color:#333333; font-size:24px;" class="slick-next default"><i class="ultsl-arrow-right6"></i></button>',
				prevArrow:'<button type="button" style="color:#333333; font-size:24px;" class="slick-prev default"><i class="ultsl-arrow-left6"></i></button>',
				swipe:true,
				draggable:true,
				touchMove:true,
				slidesToScroll: parseInt(owlopts[2],10),
				slidesToShow: parseInt(owlopts[2],10),
				responsive:[{
					breakpoint: 1024,
					settings:{
						slidesToShow: parseInt(owlopts[3],10),
						slidesToScroll: parseInt(owlopts[3],10)
					}
				},{
					breakpoint: 768,
					settings:{
						slidesToShow: parseInt(owlopts[4],10),
						slidesToScroll: parseInt(owlopts[4],10)
					}
				},{
					breakpoint: 480,
					settings:{
						slidesToShow: parseInt(owlopts[5],10),
						slidesToScroll: parseInt(owlopts[5],10)
					}
				}],
				pauseOnHover:true,
				pauseOnDotsHover:true,
				customPaging:function(slider,i){
					return'<i type="button" style="class="ultsl-record" data-role="none"></i>';
				}
			});
		}
		who.removeClass('des-team-shortcode');
	});
	
})(window.jQuery);