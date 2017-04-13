var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    },
    allExceptIpad: function(){
	    return (isMobile.Android() || isMobile.BlackBerry() || navigator.userAgent.match(/iPhone|iPod/i) || isMobile.Opera() || isMobile.Windows());
    }
};

$ = (jQuery);

(function($) {

jQuery.fn.getHiddenDimensions = function(includeMargin) {
    var $item = this,
        props = { position: 'absolute', visibility: 'hidden', display: 'block' },
        dim = { width:0, height:0, innerWidth: 0, innerHeight: 0,outerWidth: 0,outerHeight: 0 },
        $hiddenParents = $item.parents().andSelf().not(':visible'),
        includeMargin = (includeMargin == null)? false : includeMargin;

    var oldProps = [];
    $hiddenParents.each(function() {
        var old = {};

        for ( var name in props ) {
            old[ name ] = this.style[ name ];
            this.style[ name ] = props[ name ];
        }

        oldProps.push(old);
    });

    dim.width = $item.width();
    dim.outerWidth = $item.outerWidth(includeMargin);
    dim.innerWidth = $item.innerWidth();
    dim.height = $item.height();
    dim.innerHeight = $item.innerHeight();
    dim.outerHeight = $item.outerHeight(includeMargin);

/*
    $hiddenParents.each(function(i) {
        var old = oldProps[i];
        for ( var name in props ) {
            //this.style[ name ] = old[ name ];
        }
    });
*/

    return dim;
}
}(jQuery));

function correct_blake_mega_menu(){
	jQuery('header:not(.headerclone) .navbar-collapse li.blake_mega_menu > ul.menu-depth-1').each(function(){
		if (!window.BrowserDetect.isModernIE){
			if (window.BrowserDetect.browser == "Safari" || window.BrowserDetect.isEdge){
				if (jQuery(window).width() < jQuery(this).parent().offset().left + jQuery(this).width()){
					jQuery(this).css({ left : -jQuery(this).parent().position().left });
				}
			} else {
				if (jQuery(window).width() < 1080){
					jQuery(this).offset({left: 0});
				} else if (jQuery(window).width() > 1170){
					jQuery(this).offset({left: (jQuery(window).width()-1170)/2});
				} else {
					jQuery(this).offset({left: 0});
				}
			}
		}
	});

	if (jQuery('#dl-menu').is(':visible')){
		jQuery('.dl-menu, .dl-menu ul').css('max-height', window.screen.availHeight-jQuery('body header').first().height()-50 );
	}
}

// Blog Isotope
function blogMasonry() {

	var $blogcontainer = jQuery('.blog-default.wideblog .container');

	if ($blogcontainer.length > 0){
		$blogcontainer.imagesLoaded( function() {
			setTimeout(function(){
				$blogcontainer.animate({'opacity' : 1}, 200);
		    }, 100);
	    });
    }
}

blogMasonry();


jQuery(function(){

	jQuery('.widget').each(function(){
		if (!jQuery(this).children('h2').eq(0).children('span.widget_title_span').length) jQuery(this).children('h2').eq(0).wrapInner('<span class="widget_title_span" />');
	});

	jQuery('.metas').each(function(){
		if (jQuery(this).find('.tags').html() == ""){
			jQuery(this).find('.tags').parent().remove();
		}
	});

	/* dl-menu [mobile] */
	jQuery('#dl-menu ul.dl-menu > li li:not(.dl-back)').removeAttr('class');
	jQuery('#dl-menu ul.dl-menu ul').removeClass('sub-menu').addClass('dl-submenu-smart');
	jQuery( '#dl-menu' ).dlmenu({
		animationClasses : { classin : 'dl-animate-in-2', classout : 'dl-animate-out-2' }
	});
	jQuery('.dl-menu a').each(function(){
		if (jQuery(this).siblings('ul').length){
			jQuery(this).after('<span class="gosubmenu fa fa-angle-right" />');
		}
		jQuery(this).click(function(e){
			if (jQuery(this).attr('href').indexOf('http') > -1){
				e.preventDefault(); e.stopPropagation(); window.location = jQuery(this).attr('href');
			} else {
				if ((jQuery(this).attr('href').indexOf('#section') > -1 && jQuery(this).attr('href') != '#section_page-0') || jQuery(this).attr('href')==="#home"){
					e.preventDefault(); e.stopPropagation();
					jQuery('html, body').animate({
						scrollTop : jQuery(jQuery(this).attr('href')).offset().top - jQuery('body header').first().height()
					},{
						duration: 1200,
						easing: 'easeInOutExpo',
						complete: function(){
							jQuery('.dl-trigger').trigger('click');
						}
					});
				}
			}
		});
	});

	/* MAIN MENU */
	jQuery('.navbar-nav li').not('.menu-item-depth-1').removeClass('blake_mega_hide_title').removeClass('blake_mega_hide_link');
	jQuery('.navbar-nav li.blake_mega_hide_link > a').attr('href','#');
	jQuery('.navbar-nav:not(#main_menu_outside) a:not(.outsider)').add(jQuery('.navbar-nav:not(#main_menu_outside) a.mainhomepage')).each(function(){
		jQuery(this).click(function(e){
			var target = jQuery(jQuery(this).attr('href'));
			if (jQuery(this).attr('href').indexOf('://') < 0){
				var whereTo = jQuery(jQuery(this).attr('href')).offset().top - jQuery('header.headerclone').height() + 10;
				if (window.BrowserDetect.browser === "Firefox") whereTo = jQuery(jQuery(this).attr('href')).offset().top - 10;
				if (jQuery(this).children('.sub-arrow').length){
					if (!jQuery(this).children('.sub-arrow').is(':hover')){
						jQuery('html, body').animate({
							scrollTop : whereTo
						},{
							duration: 1200,
							easing: 'easeInOutExpo',
							complete: function(){
										 if (jQuery('#blake_update_section_titles').html() == 'on' && target.data('sectionTitle')){
											 if (history && history.replaceState) history.replaceState({}, "", "#"+target.data('sectionTitle'));
											 else window.location.hash = target.data('sectionTitle');
										 }
										 if (jQuery('.navbar-toggle').is(':visible')) jQuery('.navbar-toggle').trigger('click');
									  }
						})
					    e.preventDefault();
					}
				} else {
					jQuery('html, body').animate({
						scrollTop : whereTo
					},{
						duration: 1200,
						easing: 'easeInOutExpo',
						complete: function(){
									 if (jQuery('#blake_update_section_titles').html() == 'on' && target.data('sectionTitle')){
										 if (history && history.replaceState) history.replaceState({}, "", "#"+target.data('sectionTitle'));
										 else window.location.hash = target.data('sectionTitle');
									 }
									 if (jQuery('.navbar-toggle').is(':visible')) jQuery('.navbar-toggle').trigger('click');
								  }
					})
				    e.preventDefault();
				}
			}

		});
	});

	if (jQuery("body header").first().hasClass('hide-on-start')){
		if (jQuery(document).scrollTop() > 200) jQuery("body header").first().addClass('nothidden');
		else jQuery("body header").first().removeClass('nothidden');
	}

	/* paddings das fws */
	if (!jQuery('body header').first().hasClass('header_not_fixed') && jQuery('#blake_content_to_the_top').html() == "off" && (jQuery('body').hasClass('page') || jQuery('body').hasClass('single') || jQuery('body').hasClass('archive') || jQuery('body').hasClass('search') || (jQuery('body').hasClass('home') && !jQuery('body').hasClass('page')) )){
		if (jQuery("body header").first().siblings('.fullwidth-container').length){
			jQuery('.fullwidth-container').css('padding-top',jQuery("body > header").height());
		} else {
			jQuery('body > header').last().next().css('padding-top',jQuery("body header").first().height());
			jQuery('body > .boxed_layout > header').last().next().css('padding-top',jQuery("body header").first().height());
		}
	}

	/* header related stuff */
	setTimeout(function(){
		var theheader = jQuery("body header").first();
	  	if (theheader.hasClass('style4')){
			var isstyle4 = true;
			var howmanyitems = theheader.find('.navbar-nav > li').length;
			if (howmanyitems > 1){
				var itemsleft = Math.ceil(howmanyitems / 2) - howmanyitems % 2;
				theheader.find('.new-menu-wrapper .new-menu-left .new-menu-bearer ul').append( theheader.find('.navbar-collapse .navbar-nav > li').eq(0).nextUntil(theheader.find('.navbar-collapse .navbar-nav > li').eq(itemsleft)).andSelf() );
				theheader.find('.new-menu-wrapper .new-menu-right .new-menu-bearer ul').append( theheader.find('.navbar-collapse .navbar-nav > li') );
				theheader.find('.new-menu-bearer').addClass('navbar-collapse');
				theheader.find('.navbar-brand').insertAfter( theheader.find('.new-menu-left') );
			}
		}

		/* hideonstart stuff */
		if (theheader.hasClass('hide-on-start')) {
			jQuery('#blake_header_after_scroll').html('yes');
			jQuery('#blake_header_shrink').html('no');
		}

		theheader.clone().addClass('headerclone').removeClass('header_after_scroll').insertAfter(theheader);

		var nav = jQuery(".nav-container");

		var topbar = theheader.find('.top-bar');
		var downbutton = theheader.find('.down-button');
		var logocontainer = theheader.find('.navbar-header');
		var top_spacing = 0;

		jQuery('header.headerclone').addClass('header_after_scroll');
		var waypoint_offset = -parseInt(jQuery('header.headerclone').outerHeight(true),10);
		if (window.BrowserDetect.browser === "Firefox") waypoint_offset = -20;
		jQuery('.headerclone').removeClass('header_after_scroll');
		var initialScroll = jQuery(document).scrollTop();

		if (jQuery('#blake_header_shrink').html() == 'yes' || jQuery('#blake_header_after_scroll').html() == 'yes'){

			jQuery('body').waypoint({
				handler: function(event, direction) {

					if (event == 'up' && jQuery(document).scrollTop() < 200){
						if (jQuery('.dl-menu.dl-menuopen').is(':visible')) jQuery('.dl-trigger').trigger('click');
						var navheight = jQuery('header.headerclone').height();
						/* hideonstart stuff */
						if (theheader.hasClass('hide-on-start')) theheader.removeClass('nothidden');
						else theheader.removeClass('header_after_scroll');
						if (jQuery(window).width() > 767) topbar.css('margin-top','');

						var margin = "5px";
						if (isstyle4) margin = (jQuery('header.headerclone .new-menu-wrapper').height() - jQuery('header.headerclone .new-menu-bearer').height())/2+"px";
						else margin = (jQuery('header.headerclone .nav-container').height() - jQuery('header.headerclone .navbar-nav > li > a').outerHeight())/2+"px";
						if (jQuery('#blake_menu_add_border').html() == "on") margin = parseInt(margin, 10)+5+"px";

					} else {

						theheader.addClass('header_after_scroll');

						/* hideonstart stuff */
						if (theheader.hasClass('hide-on-start')) theheader.addClass('nothidden');

						if (jQuery(window).width() > 767) topbar.css('margin-top', -topbar.height());
						if (jQuery(window).width() < 768 && downbutton.hasClass('current')) downbutton.click();

						var margin = "5px";
						if (isstyle4) margin = (jQuery('header.headerclone.header_after_scroll .new-menu-wrapper').height() - jQuery('header.headerclone.header_after_scroll .new-menu-bearer').height())/2+"px";
						else margin = (jQuery('header.headerclone.header_after_scroll .nav-container').height() - jQuery('header.headerclone.header_after_scroll .navbar-nav > li > a').outerHeight())/2+"px";
						if (jQuery('#blake_menu_add_border').html() == "on") margin = parseInt(margin, 10)+5+"px";
					}
					correct_blake_mega_menu();
				},
				offset: waypoint_offset
			});

			jQuery(document).scrollTop(0);
		  	theheader.addClass('header_after_scroll');
		  	if (jQuery(window).width() > 767) topbar.css('margin-top','');

			theheader.addClass('header_after_scroll');
			if (jQuery(window).width() > 767) topbar.css('margin-top', -topbar.height());
			if (jQuery(window).width() < 768 && downbutton.hasClass('current')) downbutton.click();
			var margin = "5px";
			if (isstyle4) margin = (jQuery('header.headerclone.header_after_scroll .new-menu-wrapper').height() - jQuery('header.headerclone.header_after_scroll .new-menu-bearer').height())/2+"px";
			else margin = (jQuery('header.headerclone.header_after_scroll .nav-container').height() - jQuery('header.headerclone.header_after_scroll .navbar-nav > li > a').outerHeight())/2+"px";

			jQuery('.hide-on-start').addClass('hidestartready');
			jQuery(document).scrollTop(initialScroll);
			if (initialScroll < 200 && !theheader.hasClass('hide-on-start')) theheader.removeClass('header_after_scroll');
			if (initialScroll < 200 && theheader.hasClass('hide-on-start')) theheader.removeClass('nothidden');
			if (initialScroll < 200 && jQuery(window).width() > 767 ) topbar.css('margin-top','');
		}

		if (!theheader.hasClass('header_not_fixed') && jQuery('#blake_content_to_the_top').html() == "off" && (jQuery('body').hasClass('page') || jQuery('body').hasClass('single') || jQuery('body').hasClass('archive') || jQuery('body').hasClass('search') || (jQuery('body').hasClass('home') && !jQuery('body').hasClass('page')) )){
			if (theheader.siblings('.fullwidth-container').length){
				jQuery('.fullwidth-container').css('padding-top',theheader.height());
			} else {
				jQuery('body > header').last().next().css('padding-top',theheader.height());
				jQuery('body > .boxed_layout > header').last().next().css('padding-top',theheader.height());
			}
		}
		correct_blake_mega_menu();
		if (isstyle4) jQuery('.navbar-brand').css('opacity',1);
	}, 1200);

	if (jQuery('section.page_content').length > 1){
		var sections = jQuery("body > section");
		var navigation_links = jQuery("a.menu-link");

		sections.waypoint({
			handler: function(event, direction) {
				if (!window.scrollHappened) window.scrollHappened = true;
				var active_section;
				active_section = jQuery(this);
				if (event === "up") active_section = active_section.prev();

				var active_link = jQuery('a.menu-link[href="#' + active_section.attr("id") + '"]');
				navigation_links.removeClass("selected").parent().removeClass('current-menu-item');
				active_link.addClass("selected");
				if (jQuery('#blake_update_section_titles').html() == 'on' && active_section.data('sectionTitle') && jQuery('body > section').length > 2){
					if (history && history.replaceState) history.replaceState({}, "", "#"+active_section.data('sectionTitle'));
					else window.location.hash = active_section.data('sectionTitle');
				}
			},
			offset: '25%'
		});
	}

	//ajax search
	var form = jQuery('header:not(.headerclone) .search_input');
	var search_ajaxing = null;
	jQuery('header:not(.headerclone) .search_trigger, header:not(.headerclone) .search_trigger_mobile').click(function(){
		jQuery('header:not(.headerclone) .search_input').addClass('open');
		jQuery('header .search_input input').focus();
	});
	jQuery('header:not(.headerclone) .search_close').click(function(){
		form.find('.ajax_search_results ul').html("");
		jQuery('header:not(.headerclone) .search_input').removeClass('open');
		jQuery('header .search_input input').blur().val('');
	});
	if (jQuery('#blake_enable_ajax_search').html() == "on"){
		jQuery('header .search_input input.search_input_value').keydown(function(e){
			switch (e.which){
				case 27:
					//esc key. close the results.
					if (form.find('.ajax_search_results ul').html() == "") form.find('.search_close').click();
					form.find('.ajax_search_results ul').html("");
					clearTimeout(jQuery.data(form, des_search_timer));
				break;
				case 38:
					//up key, navigate up on the results
					e.preventDefault(); e.stopPropagation();
					if (form.find('li.selected').prev().length){
						form.find('li.selected').removeClass('selected').prev().addClass('selected');
						// is out of the ul visual field? scroll the ul down
					}
					if (form.find('li.selected').position().top < 40){
						form.find('ul').stop().animate({
							"scrollTop": form.find('ul').scrollTop()-40
						}, 100);
					}
					clearTimeout(jQuery.data(form, des_search_timer));
				break;
				case 40:
					//down key, navigate up on the results
					e.preventDefault(); e.stopPropagation();
					if (form.find('li.selected').next().length){
						form.find('li.selected').removeClass('selected').next().addClass('selected');
						// is out of the ul visual field? scroll the ul down
					}
					if (form.find('li.selected').position().top+80 > form.find('ul').height()){
						form.find('ul').stop().animate({
							"scrollTop": form.find('ul').scrollTop()+40
						}, 100);
					}
					clearTimeout(jQuery.data(form, des_search_timer));
				break;
				case 13:
					//enter key. if some result is selected shows the one.
					if (form.find('li.selected').length){
						e.preventDefault(); e.stopPropagation();
						window.location = form.find('li.selected a').attr('href');
					}
					clearTimeout(jQuery.data(form, des_search_timer));
				break;
				case 37: case 39: case 27: case 29: case 17: case 18: case 9: case 16: case 20: case 91: case 93: case 36: case 35: case 33: case 34: case 144: case 145: case 19: case 112: case 113: case 114: case 115: case 116: case 117: case 118: case 119: case 120: case 121: case 122: case 123:
					//ignore keys like left and right arrows, ctrl, alt, shift, F[1-12], home, insert, etc etc etc
					clearTimeout(jQuery.data(form, des_search_timer));
				break;
				default:
					//do the search
					if (!isMobile.any()){
						form.find('.search_input_value').blur();
						form.find('.search_input_value').focus();
					}
					clearTimeout(jQuery.data(form, des_search_timer));
					var des_search_timer = setTimeout(function(){
						if (form.find('.search_input_value').val().length > 0){
							if (search_ajaxing != null){
								search_ajaxing.abort();
								search_ajaxing = null;
							}
							//console.log('ajaxing...');
							form.find('.search_close i').addClass('fa-spinner desrotating').hover(function(){ jQuery(this).removeClass('fa-spinner desrotating'); }, function(){ jQuery(this).addClass('fa-spinner desrotating'); });
							search_ajaxing = jQuery.ajax({
								type: 'post',
								url: jQuery('#templatepath').html()+"ajaxsearch.php",
								data: {
						            se: jQuery('#searcheverything').html(),
						            query: form.serialize().substr(2),
									thepath: jQuery('#homePATH').html()
						        },
								success: function(data){
									//console.log('ajax complete.');
									form.find('.search_close i').removeClass('fa-spinner desrotating').unbind('hover');
									form.find('.ajax_search_results ul').html(data);
									form.find('ul').stop().animate({
										"scrollTop": 0
									}, 100);
									if (form.find('li.selected').length){
										form.find('.ajax_search_results ul').css('overflow-y','scroll').children().each(function(){
											jQuery(this).mouseover(function(){
												jQuery(this).addClass('selected').siblings().removeClass('selected');
											});
										});
									}
								}
							});
						} else {
							clearTimeout(jQuery.data(form, des_search_timer));
							form.find('.search_close i').removeClass('fa-spinner desrotating').unbind('hover');
							if (search_ajaxing != null){
								search_ajaxing.abort();
								search_ajaxing = null;
							}
							form.find('.ajax_search_results ul').html("").css('overflow-y','visible');
						}
					}, 100);
				break;
			}
		});
	} else {
		jQuery('header .search_input input.search_input_value').keydown(function(e){
			if (e.which === 27){
				//esc key. close the results.
				form.find('.search_close').click();
			}
		});
	}
});

function randomXToY(minVal,maxVal,floatVal){
  var randVal = minVal+(Math.random()*(maxVal-minVal));
  return typeof floatVal=='undefined'?Math.round(randVal):randVal.toFixed(floatVal);
}

jQuery(window).resize(function(event){
	partnersInnerBorder();
	correct_blake_mega_menu();
	if (jQuery(window).width() > 767){
		if (jQuery(window).scrollTop() < 200) jQuery('header .top-bar').css('margin-top','');
		else jQuery('header .top-bar').css('margin-top', -jQuery('header .top-bar').height());
	} else {
		jQuery('header .top-bar').css('margin-top','');
	}
});

jQuery(window).load(function(){

	//jQuery('a.team-profile .tooltip-desc').css('display','block');

	jQuery('a.nav-to[href*="#"]').not('[href="#"]').add(jQuery('div.nav-to')).add(jQuery('button.nav-to')).each(function() {
		var $this = jQuery(this).is('a') ? jQuery(this) : jQuery(this).children('a');
		var isMenu = ($this.parents('.navbar').length) ? true : false;
		if ($this.children('.sub-arrow').length){
			$this.click(function(e){
				e.preventDefault();
				var target = jQuery(this.hash);
			    target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');

			    var whereTo = target.offset().top - parseInt(jQuery('header.headerclone').outerHeight(true));
			    if (target.length) {
					if (!$this.children('.sub-arrow').is(':hover')){
						jQuery('html,body').animate({
				          scrollTop: whereTo
				        }, {
					        duration: 1200,
					        easing: "easeOutQuad",
					        complete: function(){
						        if (jQuery('#blake_update_section_titles').html() == 'on' && target.data('sectionTitle')){
							        if (history && history.replaceState) history.replaceState({}, "", "#"+target.data('sectionTitle'));
									else window.location.hash = target.data('sectionTitle');
						        }
						        if (jQuery('.navbar-toggle').is(':visible') && isMenu){
							        jQuery('.navbar-toggle').trigger('click');
						        }
					        }
				        });
					}
				}
			});
		} else {
			$this.click(function(e){
				e.preventDefault();
				var target = jQuery(this.hash);
			    target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
			    var whereTo = target.offset().top - parseInt(jQuery('header.headerclone').outerHeight(true));
			    if (target.length) {
					jQuery('html,body').animate({
					  scrollTop: whereTo
					}, {
						duration: 1200,
						easing: "easeOutQuad",
						complete: function(){
							if (jQuery('#blake_update_section_titles').html() == 'on' && target.data('sectionTitle')){
								if (history && history.replaceState) history.replaceState({}, "", "#"+target.data('sectionTitle'));
								else window.location.hash = target.data('sectionTitle');
							}
							if (jQuery('.navbar-toggle').is(':visible') && isMenu){
								 jQuery('.navbar-toggle').trigger('click');
							}
						}
					});
			    }
			});
		}
    });

	if (window.location.hash && !window.scrollHappened) {
		var sectionid = window.location.hash;
		if (jQuery('section[data-section-title="'+sectionid.substr(1)+'"]').length) {
			sectionid = "#"+jQuery('section[data-section-title="'+sectionid.substr(1)+'"]').attr('id');
		}
		if (jQuery('a[href="'+sectionid+'"]').length) jQuery('a[href="'+sectionid+'"]').click();
		if (jQuery('#blake_update_section_titles').html() === "off" && window.location.hash != ""){
			if (history && history.replaceState) history.replaceState({}, "", "#");
			else window.location.hash = "";
		}
	} else {
		if (jQuery('#blake_update_section_titles').html() === "off" && window.location.hash != ""){
			if (history && history.replaceState) history.replaceState({}, "", "#");
			else window.location.hash = "";
		}
	}

	/* grayscale effect on images. */
	if (jQuery('#blake_grayscale_effect').html() == "on") {
		jQuery('img').each(function(){
			if (!jQuery(this).closest('.gm-style').length && !jQuery(this).parent().hasClass('navbar-brand') && !jQuery(this).closest('rev_slider').length && !jQuery(this).closest('#big_footer').length){
				jQuery(this).addClass('blake_grayscale');
			}
		});
		if (jQuery('a.cbp-l-loadMore-link:not(.cbp-l-loadMore-stop)').length){
			jQuery('a.cbp-l-loadMore-link').click(function(){
				if (!jQuery(this).hasClass('cbp-l-loadMore-stop')){
					var thisLoadMore = jQuery(this);
					var upperInitialCubeItems = jQuery(this).parent().parent().siblings('.cbp').find('img').length;
					var upperCheckForNewCubeItems = setInterval(function(){
						//console.log('checking');
						if (thisLoadMore.parent().parent().siblings('.cbp').find('img').length > upperInitialCubeItems){
							clearInterval(upperCheckForNewCubeItems);
							thisLoadMore.parent().parent().siblings('.cbp').find('img:not(.blake_grayscale)').addClass('blake_grayscale');
						}
					}, 200);
				}
			});
		}
	}

	correct_blake_mega_menu();

});

jQuery(document).ready(function(){
	if (window.BrowserDetect.browser === "Explorer" && window.BrowserDetect.version == 9){
		/* disable address update */
		jQuery('#blake_update_section_titles').html('off');
		/* merge inline css and js from vc rows and what not. IE 9 can only read 30 of these x) */
		if (jQuery('style').length){
			var inlineStyles = "";
			jQuery('style').each(function(){
				if (jQuery(this).html()){
					inlineStyles += jQuery(this).html()+"\n";
					jQuery(this).remove();
				}
			});
			jQuery('body').append('<style type="text/css" class="css-merged-for-ie">'+inlineStyles+'</style>' );
		}
	}

	jQuery('.widget select, select.orderby, .variations_form select, .wpcf7-select, .woocommerce select').not('#rating, #calc_shipping_country').simpleselect();

	if (isMobile.any()){

		jQuery('header:not(.headerclone)').unbind('click').on('click', '.navbar-collapse a', function(e){
			if (jQuery(this).parent().hasClass('menu-item-has-children') && jQuery(this).siblings('ul').css('opacity') < 1){
				e.preventDefault();
				e.stopPropagation();
			} else {
				if (jQuery(this).attr('href').indexOf('://') < 0){
					jQuery('html, body').animate({
						scrollTop : jQuery(jQuery(this).attr('href')).offset().top - jQuery(this).closest('header').height()
					},{
						duration: 1200,
						easing: 'easeInOutExpo',
						complete: function(){
									 if (jQuery('.navbar-toggle').is(':visible')) jQuery('.navbar-toggle').trigger('click');
								  }
					})
				    e.preventDefault();
				}
			}

		});
	}

	window.scrollHappened = false;
	if (jQuery('.navbar-brand img').length > 0) {
		window.logoIsImage = true
		window.logoReady = false;
	}

	if (jQuery('#blake_website_load').length > 0){
		jQuery('body').queryLoader2({
			barColor: "#000",
		        backgroundColor: "#fff",
		        percentage: true,
		        barHeight: 1,
		        completeAnimation: "fade",
		        deepSearch: true,
		        minimumTime: 500,
		        onComplete: function(){
			        jQuery('body > #blake_website_load').fadeOut(1000, function(){
	    		        jQuery(this).remove();
	    	        });
		        }
		});
	}

	/* inner borders trick */
	partnersInnerBorder();

	/* wrap the contents minding the fullwiths [NEW STUFF - check problems after with components fullwidth like for instance the projects]  */
	jQuery('.page_content').each(function(){
		if (jQuery(this).find('.fullwidth-section').length){

			if (jQuery('.fullwidth-section > .video-container video').length){
				jQuery('.fullwidth-section > .video-container video').add(jQuery('.fullwidth-section > .video-container .wp-video-shortcode')).attr('height','').attr('width','').removeAttr('height').removeAttr('width').css('width','100vw');
			}
		}
		jQuery(window).trigger('resize');
	});
	/* endof wrap the contents minding the fullwiths */

	jQuery('.wpcf7-submit').click(function(){
		jQuery(this).parents('.wpb_wrapper').find('input, textarea').mouseover(function(){ jQuery(this).siblings('.wpcf7-not-valid-tip').fadeOut("fast"); });
	});

	/* icon services new effect from blake */
	jQuery('.aio-icon-tooltip .aio-icon').each(function(){
		jQuery(this).hover(function(){
			jQuery(this).closest('.aio-icon-tooltip').siblings('.aio-icon-description').addClass('visible');
		}, function(){
			jQuery(this).closest('.aio-icon-tooltip').siblings('.aio-icon-description').stop().animate({
				opacity:1
			}, 100, function(){
				jQuery(this).removeClass('visible');
			});
		});
	});


	jQuery('.tooltip').css('visibility','hidden');
	jQuery('.socialiconsshortcode li a').trigger('mouseover').trigger('mouseout');
	setTimeout(function(){
		jQuery('.tooltip').css('visibility','visible');
	}, 500);


	if (jQuery('#lang_sel a.lang_sel_sel, #lang_sel_click a.lang_sel_sel').length){
		jQuery('#lang_sel a.lang_sel_sel, #lang_sel_click a.lang_sel_sel').append('<i class="icon-angle-down"></i>');
		jQuery('#lang_sel a.lang_sel_sel, #lang_sel_click a.lang_sel_sel').prepend('<i class="icon-globe" style="left:0px;"></i>');
	}

	/* remove brs from the new non-visual shortcodes */
	jQuery('.main_cols.container > br').remove();

	/*asshole IE*/
	if (window.BrowserDetect.browser === "Explorer"){
		jQuery('.info_above_menu .telephone i, .info_above_menu .email i, .info_above_menu .address i').css('vertical-align', 'middle');
	}

	if (jQuery('.menu_wpml_widget').length){
		var totalHeight = jQuery('#lang_sel ul ul > li, #lang_sel_click ul ul > li').outerHeight() * jQuery('#lang_sel ul ul > li, #lang_sel_click ul ul > li').length;
		var maxWidth = 0;
		jQuery('#lang_sel ul ul > li > a, #lang_sel_click ul ul > li > a').each(function(){
			if (jQuery(this).getHiddenDimensions(true).outerWidth > maxWidth) maxWidth = jQuery(this).getHiddenDimensions(true).outerWidth;
			jQuery(this).css('float','left');
		});
		jQuery('#lang_sel ul ul > li, #lang_sel_click ul ul > li').width(maxWidth);
		jQuery('#lang_sel ul ul, #lang_sel_click ul ul').css('width',jQuery('#lang_sel ul ul > li, #lang_sel_click ul ul > li').getHiddenDimensions(true).outerWidth+'px').css('left','-11px');
		jQuery('#lang_sel ul li, #lang_sel_click ul li').hover(function(){
			jQuery(this).children('ul').css('visibility','visible').stop().animate({'height':totalHeight+'px'}, 500);
		}, function(){
			jQuery(this).children('ul').stop().animate({'height':'0px'}, 500, function(){ jQuery(this).css('visibility','hidden'); });
		});

	}

	if (jQuery('#mc-embedded-subscribe').length){
		jQuery('#mc-embedded-subscribe').click(function(e){
			if (!blake_validate_email(jQuery('#mce-EMAIL').val())){
				e.stopPropagation();
				e.preventDefault();
				jQuery('#mce-EMAIL').css({'border':'1px solid #D07F7F', 'color':'#D07F7F'}).val('Please insert a valid email');
				jQuery('#mce-EMAIL').focus(function(){
					jQuery(this).val('');
					jQuery(this).css({
						'border':'none',
						'color': 'rgb(192, 191, 191)'
					});
				});
				return false;
			}
		});
	}

	if (window.BrowserDetect.browser == "iPhone")
		jQuery('.acc-substitute .pane p, #accordion .pane p').css({ 'font-size': '11px' });

	if (jQuery(".container .vendor").length) jQuery(".container .vendor").fitVids();

	/* search widget top */
	if (jQuery('.search_toggler')){
		jQuery('.search_toggler').each(function(){
			jQuery(this)
				.unbind('click')
				.bind('click', function(){
					if (jQuery(this).siblings('#s').hasClass('search_close')){
						jQuery(this).siblings('#s').toggleClass('search_close');
						jQuery(this).parents('#searchform').removeClass('ie_searcher_close').addClass('ie_searcher_open');
						jQuery(this).siblings('#s').trigger('focus');
					} else {
						if (jQuery(this).siblings('#s').val() == jQuery(this).siblings('.search_box_text').html()){
							jQuery(this).siblings('#s').toggleClass('search_close');
							jQuery(this).parents('#searchform').removeClass('ie_searcher_open').addClass('ie_searcher_close');
						} else {
							jQuery(this).siblings('#searchsubmit').trigger('click');
						}
					}
				});
		});
	}

	/*special tabs stuff*/
	upper_special_tabs();

	if (jQuery(".player").length) { jQuery(".player").each(function(){
		jQuery(this).mb_YTPlayer();
		jQuery(this).on('YTPStart', function(){
			if (jQuery(this).parent().is('.homepage_parallax')) jQuery('#parallax-home').after(jQuery('#parallax-home .mb_YTPBar').css({'position':'relative','bottom':'3px'}));
		});
	}); }

	if (!isMobile.any()){
		if ((window.BrowserDetect.browser == "Mozilla" && window.BrowserDetect.version == 11) || (window.BrowserDetect.browser == "Explorer" && window.BrowserDetect.version < 11)){
			//do nothing for now.
		} else jQuery.stellar({responsive: true,  scrollProperty: 'scroll', positionProperty: 'transform', hideDistantElements: false, horizontalScrolling:false});
	}

	var browserprefix = "";
	switch (window.BrowserDetect.browser){
		case "Chrome" : case "Safari" : browserprefix = "-webkit-"; break;
		case "Firefox" : browserprefix = "-moz-"; break;
	}
	jQuery('.slick-list.draggable .slick-slide').css({
		'cursor': browserprefix+'grab'
	}).mousedown(function(){
		jQuery(this).css({
			'cursor': browserprefix+'grabbing'
		});
	}).mouseup(function(){
		jQuery(this).css({
			'cursor': browserprefix+'grab'
		});
	});

	/* SCROLL TOP BUTTON */
	jQuery("#back-top").hide();

	jQuery(window).scroll(function () {
		if (jQuery(this).scrollTop() > 200) {
			jQuery('#back-top').fadeIn();
		} else {
			jQuery('#back-top').fadeOut();
		}
	});

	jQuery('#back-top a').click(function () {
		jQuery('body,html').animate({
			scrollTop: 0
		}, 600);
		return false;
	});

	/* cube filters helper */
	jQuery('.cbp-l-filters-list.des-align-center').children().wrapAll('<div class="filters_helper" style="float:left;" />');

	jQuery('#mce-EMAIL').attr('placeholder',jQuery('#blake_newsletter_input_text').html());

	jQuery('header:not(.headerclone) .nav-container').mouseenter(function(){ correct_blake_mega_menu(); });

	if (isMobile.any()){
		jQuery('.flip-box-wrap').each(function(){
			jQuery(this).hover(function(){
				jQuery(this).find('.ifb-flip-box').addClass('ifb-hover');
			}, function(){
				jQuery(this).find('.ifb-flip-box').removeClass('ifb-hover');
			});
		});
	}


	jQuery('header .navbar-nav > li:not(.blake_mega_menu) li, header .navbar-nav > li:not(.blake_mega_menu) li').each(function(){
		blake_check_menu_right_frontier(jQuery(this));
	});

	jQuery(window).resize(function(){
		jQuery('header .navbar-nav > li:not(.blake_mega_menu) li, header .navbar-nav > li:not(.blake_mega_menu) li').each(function(){
			blake_check_menu_right_frontier(jQuery(this));
		});
	});

	jQuery('.blake_dynamic_shopping_bag').siblings('.search_trigger').addClass('next-to-shopping-bag');
});

function upper_special_tabs(fromcube){

	fromcube = false;
	if (jQuery('.special_tabs:not(.special_tabs_ready)').length){

		jQuery('.special_tabs:not(.special_tabs_ready)').each(function(e){

			jQuery(this).addClass('st-'+e);
			var el = jQuery('.st-'+e);

			jQuery(el).children("p, br").remove();

			jQuery(el).find('.label').appendTo(jQuery(el).children('.tab-selector'));
			jQuery(el).find('.content').appendTo(jQuery(el).children('.tab-container'));

			jQuery(el).find('.tab-selector > .label').eq(0).addClass('current');

			if (jQuery(el).hasClass('horizontal')){
				if (fromcube){
					jQuery(el).find('.tab-container > .content').eq(0).addClass('current').css({
						'opacity':1,
						'transform':'translateX(0%)',
						'position':'relative'
					});
				} else {
					jQuery(el).find('.tab-container > .content').eq(0).addClass('current').css({
						'opacity':1,
						'left':'0%',
						'position':'absolute'
					});
				}
			} else {
				if (fromcube){
					jQuery(el).find('.tab-container > .content').eq(0).addClass('current').css({
						'opacity':1,
						'transform':'translateY(0%)'
					});
				} else {
					jQuery(el).find('.tab-container > .content').eq(0).addClass('current').css({
						'opacity':1,
						'top':'0%'
					});
				}
			}

			if (jQuery(el).find('.tab-container > .content').find('img.aligncenter').length){
		    	jQuery(el).find('.tab-container > .content').find('img.aligncenter').parents('p').css('text-align','center');
		    }

			if (!jQuery(el).hasClass('horizontal')) jQuery(el).find('.tab-container').css('min-height', jQuery(el).find('.tab-selector').height());
			else jQuery(el).find('.tab-container').css('min-height', jQuery(el).find('.tab-container .current').height()+10);

			if (jQuery(el).hasClass('horizontal')){
				for ( var i = 1; i < jQuery(el).find('.tab-container > .content').length; i++){
					if (fromcube){
						jQuery(el).find('.tab-container > .content').eq(i).css({
							'position':'relative',
							'transform':'translateX(100%)',
							opacity:0
						});
					} else {
						jQuery(el).find('.tab-container > .content').eq(i).css({
							'position':'absolute',
							'margin-left':'100%',
							opacity:0
						});
					}
				}
			} else {
				for ( var i = 1; i < jQuery(el).find('.tab-container > .content').length; i++){
					if (fromcube){
						jQuery(el).find('.tab-container > .content').eq(i).css({
							'position':'relative',
							'transform':'translateY(100%)',
							opacity:0
						});
					} else {
						jQuery(el).find('.tab-container > .content').eq(i).css({
							'position':'absolute',
							'margin-top':'100%',
							opacity:0
						});
					}
				}
			}

			var elm = jQuery(this).attr('class').split("st-");
			var elm = "st-"+elm[1];


			jQuery('.'+elm).find('.tab-selector > .label').each(function(){

				if (!jQuery(this).find('.blake_icon_special_tabs').length){
					jQuery(this).find('.tab_title').css('padding-left','10px');
				}

				jQuery(this).click(function(){

					if (!jQuery(this).hasClass('current')){
						var filterClass = jQuery(this).attr('class').toString();
						var randid = filterClass.replace("label ","");
						var nextEl = jQuery('.'+elm).find('.tab-container > .content.'+randid);
						if (jQuery(nextEl).height() > jQuery(this).parents('.tab-selector').height())
							jQuery(this).parents('.special_tabs').find('.tab-container').stop().animate({'height': jQuery(nextEl).height()+10}, 1000, 'easeInOutExpo');
						else
							jQuery(this).parents('.special_tabs').find('.tab-container').stop().animate({'height': jQuery(this).parents('.tab-selector').height()+10}, 1000, 'easeInOutExpo');

						if (jQuery(el).hasClass('horizontal')){
							if (fromcube) jQuery(nextEl).css({'transform':'translateX(100%)','left':'0%', 'display':'block'});
							else jQuery(nextEl).css({'margin-left':'100%','left':'0%', 'display':'block'});
						} else {
							if (fromcube)jQuery(nextEl).css({'transform':'translateY(100%)','top':'0%', 'display':'block'});
							else jQuery(nextEl).css({'margin-top':'100%','top':'0%', 'display':'block'});
						}


						var current = jQuery('.'+elm).find('.tab-container > .current');
						var id = jQuery(current).attr('class').split(" ");
							id = id[1];
						jQuery('.'+elm).find('.tab-selector > .label.'+id).css({'color':'#5c5c5c'});
						jQuery('.'+elm).find('.tab-selector > .label.'+id+'.current').css({'color':'#5c5c5c'});

						if (jQuery(el).hasClass('horizontal')){
							if (fromcube){
								jQuery(current).stop().css({'transform':'translateX(100%)', opacity:0}).css('display','none');
							} else {
								jQuery(current).stop().animate({'margin-left':'100%', opacity:0}, 1000, 'easeInOutExpo', function(){
									jQuery(this).css('display','none');
								});
							}
						} else {
							if (fromcube){
								jQuery(current).stop().css({'transform':'translateY(100%)', opacity:0}).css('display','none');
							} else {
								jQuery(current).stop().animate({'margin-top':'100%', opacity:0}, 1000, 'easeInOutExpo', function(){
									jQuery(this).css('display','none');
								});
							}
						}


						jQuery('.'+elm).find('.tab-selector > .label.'+id).removeClass('current');
						jQuery(current).removeClass('current');

						if (jQuery(el).hasClass('horizontal')){
							if (fromcube){
								jQuery(current).css({
									'transform': 'translateX(-100%)',
									opacity: 0
								});
								jQuery(this).css({'transform':'translateX(100%)'});
							} else {
								jQuery(current).animate({
									'margin-left': '-100%',
									opacity: 0
								}, 1000, 'easeInOutExpo', function(){
									jQuery(this).css({'margin-left':'100%'});
								});
							}
						} else {
							if (fromcube){
								jQuery(current).css({
									'transform': 'translateY(-100%)',
									opacity: 0
								});
								jQuery(this).css({'transform':'translateY(100%)'});
							} else {
								jQuery(current).animate({
									'margin-top': '-100%',
									opacity: 0
								}, 1000, 'easeInOutExpo', function(){
									jQuery(this).css({'margin-top':'100%'});
								});
							}
						}


						jQuery('.'+elm).find('.tab-selector > .label.'+randid).css({'color': jQuery('#styleColor').html() });
						jQuery('.'+elm).find('.tab-selector > .label.'+randid).addClass('current');
						jQuery('.'+elm).find('.tab-selector > .label.'+randid).css('color', jQuery('#styleColor').html());
						jQuery('.'+elm).find('.tab-container > .content.'+randid).css('display','block');

						if (jQuery(el).hasClass('horizontal')){
							if (fromcube){
								jQuery('.'+elm).find('.tab-container > .content.'+randid).addClass('current').stop().css({ 'transform': 'translateX(0%)', opacity:1 });
								jQuery('.'+elm).find('.tab-container > .content.'+randid).css('display','block');
								if (jQuery(this).find('.services-graph').length){
									var id = jQuery('.'+elm).find('.tab-container > .content.'+randid).find('.services-graph').attr('id');
									sliding_horizontal_graph(id,3000);
								}

								if (window.BrowserDetect.browser == "Explorer" && window.BrowserDetect.version == 8){
									if (jQuery('.'+elm).find('.tab-container > .content.'+randid).find('.recent_testimonials').length){
										jQuery('.'+elm).find('.tab-container > .content.'+randid).css('width','100%');
									}
								}

								if (jQuery('.'+elm).find('.tab-container > .content.'+randid).find('.indproj2').length){
									jQuery('.'+elm).find('.tab-container > .content.'+randid).find('.indproj2').each(function(){
										var newHeight = jQuery(this).width() * window.ration;
										jQuery(this).find('.da-thumbs li a').css('height',newHeight);
									});
								}
							} else {
								jQuery('.'+elm).find('.tab-container > .content.'+randid).addClass('current').stop().animate({ 'margin-left': '0%', opacity:1 },1000, 'easeInOutExpo', function(){
									jQuery(this).css('display','block');
									if (jQuery(this).find('.services-graph').length){
										var id = jQuery(this).find('.services-graph').attr('id');
										sliding_horizontal_graph(id,3000);
									}

									if (window.BrowserDetect.browser == "Explorer" && window.BrowserDetect.version == 8){
										if (jQuery(this).find('.recent_testimonials').length){
											jQuery(this).css('width','100%');
										}
									}

									if (jQuery(this).find('.indproj2').length){
										jQuery(this).find('.indproj2').each(function(){
											var newHeight = jQuery(this).width() * window.ration;
											jQuery(this).find('.da-thumbs li a').css('height',newHeight);
										});
									}

								});
							}
						} else {
							if (fromcube){
								jQuery('.'+elm).find('.tab-container > .content.'+randid).addClass('current').stop().css({ 'transform': 'translateY(0%)', opacity:1 });
								jQuery('.'+elm).find('.tab-container > .content.'+randid).css('display','block');
								if (jQuery('.'+elm).find('.tab-container > .content.'+randid).find('.services-graph').length){
									var id = jQuery('.'+elm).find('.tab-container > .content.'+randid).find('.services-graph').attr('id');
									sliding_horizontal_graph(id,3000);
								}

								if (window.BrowserDetect.browser == "Explorer" && window.BrowserDetect.version == 8){
									if (jQuery('.'+elm).find('.tab-container > .content.'+randid).find('.recent_testimonials').length){
										jQuery('.'+elm).find('.tab-container > .content.'+randid).css('width','100%');
									}
								}

								if (jQuery('.'+elm).find('.tab-container > .content.'+randid).find('.indproj2').length){
									jQuery('.'+elm).find('.tab-container > .content.'+randid).find('.indproj2').each(function(){
										var newHeight = jQuery(this).width() * window.ration;
										jQuery(this).find('.da-thumbs li a').css('height',newHeight);
									});
								}
							} else {
								jQuery('.'+elm).find('.tab-container > .content.'+randid).addClass('current').stop().animate({ 'margin-top': '0%', opacity:1 },1000, 'easeInOutExpo', function(){
									jQuery(this).css('display','block');
									if (jQuery(this).find('.services-graph').length){
										var id = jQuery(this).find('.services-graph').attr('id');
										sliding_horizontal_graph(id,3000);
									}

									if (window.BrowserDetect.browser == "Explorer" && window.BrowserDetect.version == 8){
										if (jQuery(this).find('.recent_testimonials').length){
											jQuery(this).css('width','100%');
										}
									}

									if (jQuery(this).find('.indproj2').length){
										jQuery(this).find('.indproj2').each(function(){
											var newHeight = jQuery(this).width() * window.ration;
											jQuery(this).find('.da-thumbs li a').css('height',newHeight);
										});
									}

								});
							}
						}

					}
				});

			});
			jQuery(this).addClass('special_tabs_ready');
		});
	}
}


function isScrolledIntoView(id){
    var elem = "#" + id;
    var docViewTop = jQuery(window).scrollTop();
    var docViewBottom = docViewTop + jQuery(window).height();

    if (jQuery(elem).length > 0){
        var elemTop = jQuery(elem).offset().top;
        var elemBottom = elemTop + jQuery(elem).height();
    }

    return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom)
      && (elemBottom <= docViewBottom) &&  (elemTop >= docViewTop) );
}

function sliding_horizontal_graph(id, speed){
    jQuery("#" + id + " li span").each(function(i){
        var cur_li = jQuery("#" + id + " li").eq(i).find("span");
        var w = cur_li.attr("title");
        cur_li.animate({width: w + "%"}, speed);
    })
}

function graph_init(id, speed){
    jQuery(window).scroll(function(){
    	if (jQuery('#'+id).hasClass('notinview')){
	    	if (isScrolledIntoView(id)){
	    		jQuery('#'+id).removeClass('notinview');
	            sliding_horizontal_graph(id, speed);
	        }
    	}
    });

    if (isScrolledIntoView(id)){
        sliding_horizontal_graph(id, speed);
    }
}

function incrementNumerical(id, percent, speed){
	setTimeout(function(){
		var newVal = parseInt(jQuery(id+' .value').html(),10)+speed;

		if (newVal > percent) newVal = percent;
		jQuery(id+' .value').html(newVal);
		if (newVal < percent){
			incrementNumerical(id, percent, speed);
		}
	}, 1);
}

function htmlDecode(a) {
    var b = jQuery("<div/>").html(a).text();
    return b
}

/* Convert HEX to RGB */
function hexToRgb(hex) {
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}

// Grayscale w canvas method
function grayscale(src){
	var canvas = document.createElement('canvas');
	var ctx = canvas.getContext('2d');
	var imgObj = new Image();
	imgObj.src = src;
	canvas.width = imgObj.width;
	canvas.height = imgObj.height;
	ctx.drawImage(imgObj, 0, 0);
	var imgPixels = ctx.getImageData(0, 0, canvas.width, canvas.height);
	for(var y = 0; y < imgPixels.height; y++){
		for (var x = 0; x < imgPixels.width; x++){
			var i = (y * 4) * imgPixels.width + x * 4;
			var avg = (imgPixels.data[i] + imgPixels.data[i + 1] + imgPixels.data[i + 2]) / 3;
			imgPixels.data[i] = avg;
			imgPixels.data[i + 1] = avg;
			imgPixels.data[i + 2] = avg;
		}
	}
	ctx.putImageData(imgPixels, 0, 0, 0, 0, imgPixels.width, imgPixels.height);
	return canvas.toDataURL();

}

function blake_validate_email(email) {
   var reg = /^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i;
   if(reg.test(email) == false) {
      return 0;
   } else {
   		return 1;
   }
}


/* contact.js */
function blake_sendemail($el, SendTo, Subject, NameErr, EmailErr, MessageErr, SuccessErr, UnsuccessErr){

	//Custom variables
	var sendTo = SendTo; //send the form elements to this email (company email)
	var subject = Subject; //subject of the email
	var nameErr = NameErr; //Error message when Name field is empty
	var emailErr = EmailErr; //Error message when Email field is empty or email is not valid
	var messageErr = MessageErr; //Error message when Message field is empty
	var successErr = SuccessErr; //Message when the email was sent successfully
	var unsuccessErr = UnsuccessErr; //Message when the email was not sent

	$el = $el.parents('.contact-form');

	if ($el.parents('.contact-widget-container').length){
		nameErr = $el.find('.yourname_error').html();
		emailErr = $el.find('.youremail_error').html();
		messageErr = $el.find('.yourmessage_error').html();
	}

	//Reset field errors/variables
	$el.find('.yourname').removeClass("with_error").removeClass("change_error");
	$el.find('.youremail').removeClass("with_error").removeClass("change_error");
	$el.find('.yourmessage').removeClass("with_error").removeClass("change_error");
	var templatepath = jQuery("#templatepath").html();
	var err = 0;

    // Check fields
    var name = $el.find('.yourname_val').html();
    var email = $el.find('.youremail_val').html();
    var emailVer = blake_validate_email(email);
    var message = $el.find('.yourmessage').val();

    if (!name || name.length == 0 || name == nameErr || name == "Name")
    {
    	$el.find('.yourname').addClass("with_error");
        $el.find('.yourname').val(nameErr);
        err = 1;
    }
    if (!email || email.length == 0 || emailVer == 0)
    {
    	$el.find('.youremail').addClass("with_error");
        $el.find('.youremail').val(emailErr);
        err = 1;
    }

    if ($el.parents('.contact-widget-container').length){
	 	if (!message || message.length == 0 || message == messageErr || message == "Message")
	    {
	    	$el.find('.yourmessage').addClass("with_error");
	        $el.find('.yourmessage').val(messageErr);
	        err = 1;
	    }
	} else {
	    if (!message || message.length == 0 || message == messageErr || message == "")
	    {
	    	$el.find('.yourmessage').addClass("with_error");
	        $el.find('.yourmessage').val(messageErr);
	        err = 1;
	    }
    }
   	//If there's no error submit form
	if(err == 0)
    {
        // Request
        var tp = encodeURIComponent(templatepath);
        var data = {
            name: name,
            email: email,
            sendTo: sendTo,
            subject: subject,
            message: message,
            success: successErr,
            unsuccess: unsuccessErr,
            templatepath: tp
        };

        // Send
        jQuery.ajax({
            url: ""+templatepath+"js/sendemail.php",
            dataType: 'json',
            type: 'POST',
            data: data,
            success: function(data, textStatus, XMLHttpRequest)
            {
                if (data.response.error)
                {
                    if(data.response.error == 1){
                    	$el.find('.message_success').css({'background':'#64943c', 'color':'#FFF'});
                    	$el.find('.message_success').css('display','block');
                        $el.find('.message_success').html(data.response.message);
                    }
                    else{
                    	$el.find('.message_success').css({'background':'#C35D5D','color':'#FFF'});
                    	$el.find('.message_success').css('display','block');
                        $el.find('.message_success').html(data.response.message);
                    }
                }
                else
                {
                    // Message
                   $el.find('.message_success').css({'background':'#C35D5D','color':'#FFF'});
                   $el.find('.message_success').css('display','block');
                   $el.find('.message_success').html("An unexpected error occured, please try again.");
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                // Message
                $el.find('.message_success').css({'background':'#C35D5D','color':'#FFF'});
                $el.find('.message_success').css('display','block');
                $el.find('.message_success').html("Error while contacting server, please try again.");
            }
        });

        // Message
        $el.find('.message_success').css({'background':'#64943c', 'color':'#FFF'});
        $el.find('.message_success').css('display','block');
        $el.find('.message_success').html("Sending...");
    }

}

function blake_checkerror(elem){
	if(jQuery(elem).hasClass('with_error')) {
		jQuery(elem).removeClass('with_error').addClass('change_error');
		jQuery(elem).val("");
	}
}

function blake_validate_email(email) {
   var reg = /^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i;
   if(reg.test(email) == false) {
      return 0;
   } else {
   		return 1;
   }
}

function partnersInnerBorder(){
	jQuery('.partners-container.noscroller.innerborder').each(function(){
		var bordercolor = jQuery(this).attr('class').split('innerbordercolor-');
		var totalItems = jQuery(this).find('.partner-item').length,
			totalRows = 0,
			yPos = 0
			elems = [[]];
		if (totalItems > 0){
			if (jQuery(this).children('.partners-row').length) jQuery(this).find('.partner-item').unwrap();
			elems[totalRows].push(jQuery(this).children('.partner-item').eq(0)[0]);
			yPos = jQuery(this).children('.partner-item').eq(0).offset().top;
			for (var i=1; i<jQuery(this).find('.partner-item').length; i++){
				if (jQuery(this).find('.partner-item').eq(i).offset().top != yPos){
					yPos = jQuery(this).find('.partner-item').eq(i).offset().top;
					totalRows++;
					elems[totalRows] = [];
				}
				elems[totalRows].push(jQuery(this).find('.partner-item').eq(i)[0]);
			}
			for (var j=0; j<elems.length; j++){
				jQuery(elems[j]).wrapAll('<div class="partners-row" />');
			}
			jQuery(this).find('.partner-item, .partners-row').css('border-color', bordercolor[1] );
		}
	});
}

function blake_check_menu_right_frontier(el){
	if (el.offset().left + el.width() + el.children('ul').width() > jQuery(window).width() || el.closest('menu-to-the-left').length > 0){
		el.find('ul').addClass('menu-to-the-left');
	} else {
		el.find('ul').removeClass('menu-to-the-left');
	}
}
