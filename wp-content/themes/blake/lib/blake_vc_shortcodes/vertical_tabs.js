Array.prototype.diff = function(a) {
    return this.filter(function(i) {return a.indexOf(i) < 0;});
};

(function ($) {
	
    var Shortcodes = vc.shortcodes;

	window.VcVerticalTabsView = vc.shortcode_view.extend({
		fixed : true,
	    new_tab_adding:false,
	    events:{
	        'click .add_tab':'addTab',
	        'click > .vc_controls .vc_control-btn-delete':'deleteShortcode',
	        'click > .vc_controls .vc_control-btn-edit':'editElement',
	        'click > .vc_controls .vc_control-btn-clone':'clone'
	    },
	    initialize:function (params) {
	        window.VcVerticalTabsView.__super__.initialize.call(this, params);
	        _.bindAll(this, 'stopSorting');
			var el = this;
				el.$style = params.model.attributes.params.style;
			setTimeout(function(){ el.$el.addClass(params.model.attributes.params.style); },500);
			if (typeof vt_checker === 'undefined') vt_checker = [];
			vt_checker.push(setInterval(function(){
				//aumentou se o tempo do timeout p aliviar a carga de execuções. intervals num array p evitar redeclarações.
				//console.log('vt_checker checking... : '+el.cid);
				if (el.$style != params.model.attributes.params.style){
					el.$el.removeClass(el.$style);
					el.$style = params.model.attributes.params.style;
					el.$el.addClass(params.model.attributes.params.style);
				}
			},5000));			
	    },
	    render:function () {
		    
	        window.VcVerticalTabsView.__super__.render.call(this);
	        this.$tabs = this.$el.find('.wpb_tabs_holder');
	        
	        this.createAddTabButton();
	        
	        if ( !Shortcodes.where( { parent_id: this.model.id } ).length && this.model.view.model.get('cloned') === false) {
		        this.new_tab_adding = false;
		        var tab_title = window.i18nLocale.tab,
		            tabs_count = this.$tabs.find('[data-element_type=verticaltab]').length,
		            tab_id = (+new Date() + '-' + tabs_count + '-' + Math.floor(Math.random() * 11)),
					row_id = (+new Date() + '-' + tabs_count + '-' + Math.floor(Math.random() * 7)),
					el = this;		    
	
				var modelid = this.model.id;
	
		        vt = vc.shortcodes.create({shortcode:'verticaltab', params:{title:tab_title, tab_id:tab_id}, parent_id:modelid});
				row = vc.shortcodes.create({shortcode: 'vc_row_inner', parent_id: vt.id});
				vc.shortcodes.create({shortcode:'vc_column_inner', parent_id:row.id, params:{width:'1/1'}});
	        }
	        return this;
	    },
	    ready:function (e) {
	        window.VcVerticalTabsView.__super__.ready.call(this, e);
			var el = this;

			jQuery(el.$el).find('.wpb_verticaltab > .controls_column').not('.bottom-controls').find('a.column_edit').click(function(){ 
				setTimeout(function(){
					switch(el.$style){
						case 'icon':
							jQuery('.wpb-textinput.title').closest('.wpb_el_type_textfield').css('display','none');
							break;
						case 'text':
							jQuery('.wpb_el_type_blake_fa').css('display','none');
							break;
					}
				}, 1000);
			});
	    },
	    createAddTabButton:function () {
	        var new_tab_button_id = (+new Date() + '-' + Math.floor(Math.random() * 11));
	        this.$tabs.siblings('.tabs_controls').append('<div id="new-tab-' + new_tab_button_id + '" class="new_element_button"></div>');
	        this.$add_button = jQuery('<li class="add_tab_block"><a href="#new-tab-' + new_tab_button_id + '" class="add_tab" title="' + window.i18nLocale.add_tab + '">+</a></li>').appendTo(this.$tabs.find(".tabs_controls"));
	    },
	    addTab:function (e) {

	        if (e) e.preventDefault();
	        this.new_tab_adding = true;
	        var tab_title = window.i18nLocale.tab,
	            tabs_count = this.$tabs.find('[data-element_type=verticaltab]').length,
	            tab_id = (+new Date() + '-' + tabs_count + '-' + Math.floor(Math.random() * 11)),
				row_id = (+new Date() + '-' + tabs_count + '-' + Math.floor(Math.random() * 7)),
				el = this;		    

	        vt = vc.shortcodes.create({shortcode:'verticaltab', params:{title:tab_title, tab_id:tab_id}, parent_id:this.model.id});
			row = vc.shortcodes.create({shortcode: 'vc_row_inner', parent_id: vt.id});
			vc.shortcodes.create({shortcode:'vc_column_inner', parent_id:row.id, params:{width:'1/1'}});

			jQuery(el.$el).find('.wpb_verticaltab > .controls_column').not('.bottom-controls').find('a.column_edit').click(function(){ 
				setTimeout(function(){
					switch(el.$style){
						case 'icon':
							jQuery('.wpb-textinput.title').closest('.wpb_el_type_textfield').css('display','none');
							break;
						case 'text':
							jQuery('.wpb_el_type_blake_fa').css('display','none');
							break;
					}
				}, 1000);
			});
	        return false;
	    },
	    stopSorting:function (event, ui) {
	        var shortcode;
	        this.$tabs.find('ul.tabs_controls li:not(.add_tab_block)').each(function (index) {
	            var href = jQuery(this).find('a').attr('href').replace("#", "");
	            shortcode = vc.shortcodes.get(jQuery('[id=' + jQuery(this).attr('aria-controls') + ']').data('model-id'));
	            vc.storage.lock();
	            shortcode.save({'order':jQuery(this).index()}); // Optimize
	        });
	        shortcode.save();
	    },
	    changedContent:function (view) {
		    
	        var params = view.model.get('params');
	        if (!this.$tabs.hasClass('ui-tabs')) {
	            this.$tabs.tabs({
	                select:function (event, ui) {
	                    if (jQuery(ui.tab).hasClass('add_tab')) {
	                        return false;
	                    }
	                    return true;
	                }
	            });
				
	            this.$tabs.find(".ui-tabs-nav").prependTo(this.$tabs);
	            this.$tabs.find(".ui-tabs-nav").sortable({
	                axis:(this.$tabs.closest('[data-element_type]').data('element_type') == 'verticaltabs' ? 'y' : 'x'),
	                update:this.stopSorting,
	                items:"> li:not(.add_tab_block)"
	            });
	        } 
	        if (view.model.get('cloned') === true) {
	            var cloned_from = view.model.get('cloned_from'),
	                $after_tab = jQuery('[href="#tab-' + cloned_from.params.tab_id + '"]', this.$content).parent(),
	                icon = (params.icon) ? params.icon : "fa-adjust",
	                title = (params.title) ? params.title : "Tab",
	                $new_tab = jQuery("<li><a href='#tab-" + params.tab_id + "'><i class='fa "+icon+"'></i><span class='title'>" + title + "</span></a></li>").insertAfter($after_tab);
	            this.$tabs.tabs('refresh');
	            this.$tabs.tabs("option", 'active', $new_tab.index());
	        } else {
		        var icon = (params.icon) ? params.icon : "fa-adjust",
		        	title = (params.title) ? params.title : "Tab";
	            jQuery("<li><a href='#tab-" + params.tab_id + "'><i class='fa "+icon+"'></i><span class='title'>" + title + "</span></a></li>")
	                .insertBefore(this.$add_button);
	            this.$tabs.tabs('refresh');
	            this.$tabs.tabs("option", "active", this.new_tab_adding ? jQuery('.ui-tabs-nav li', this.$content).length - 2 : 0);

	        }
	        this.new_tab_adding = false;
	    },
	    
	    clone: function(ev){
		    
		    ev.preventDefault();
		    ev.stopPropagation();
		    
		    var $elem = this;
		    
		    if (this.$content.find('.wpb_vc_media_grid').length){
				
				//tem uma media grid. activate panic mode
			    var verticaltabs_before_clone = vc.shortcodes.where({ shortcode: 'verticaltabs' });
			    
			    //do the normal cloning.
			    window.VcVerticalTabsView.__super__.clone.call(this);

				//do our awesome tricks			    
			    var new_verticaltabs = vc.shortcodes.where({ shortcode: 'verticaltabs' }).diff(verticaltabs_before_clone);	    
			    var $vtabs = jQuery('.wpb_verticaltabs[data-model-id="'+new_verticaltabs[0].id+'"]');

				//until for the html to complete
				var ulchecker = setInterval(function(){
					if (jQuery($vtabs).find('.wpb_tabs_holder').children('.attachment-thumbnails').length){
						clearInterval(ulchecker);
						
						$vtabs.find('div[data-element_type="vc_media_grid"] .wpb_element_wrapper h4').after($vtabs.find('.wpb_tabs_holder').children('.attachment-thumbnails').removeClass('ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all ui-sortable').removeAttr('role').html( $elem.$content.find('.wpb_vc_media_grid').first().find('ul.attachment-thumbnails').html() ));
						$vtabs.find('.wpb_tabs_holder .attachment-thumbnails').each(function(){
							if (jQuery(this).siblings('.attachment-thumbnails').length) jQuery(this).siblings('.attachment-thumbnails').remove();
							if (jQuery(this)[0].hasChildNodes()){
								jQuery(this).removeClass('image-exists');
								jQuery(this).siblings('.column_edit_trigger').addClass('image-exists');
							} else {
								jQuery(this).addClass('image-exists');
								jQuery(this).siblings('.column_edit_trigger').removeClass('image-exists');
							}
						});
						$vtabs.find('.wpb_tabs_holder').prepend( $vtabs.find('.tabs_controls').addClass('ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all ui-sortable') );
						
						if (typeof $vtabs.find('.wpb_tabs_holder').data('uiTabs') != "undefined"){
							$vtabs.find('.wpb_tabs_holder').tabs('destroy');
						}
						$vtabs.find('.wpb_tabs_holder').tabs();
					}
				}, 200);
				
		    } else {
			    //ta tudo ok, siga.
			    window.VcVerticalTabsView.__super__.clone.call(this);
		    }
		    
	    },
	    
	    cloneModel:function (model, parent_id, save_order) {
	        var shortcodes_to_resort = [],
	            new_order = _.isBoolean(save_order) && save_order === true ? model.get('order') : parseFloat(model.get('order')) + vc.clone_index,
	            model_clone,
	            new_params = _.extend({}, model.get('params'));
	            
	        if (model.get('shortcode') === 'verticaltab') _.extend(new_params, {tab_id:+new Date() + '-' + this.$tabs.find('[data-element-type=verticaltab]').length + '-' + Math.floor(Math.random() * 11)});
	        
	        var new_id = vc_guid();
	        if (model.get('shortcode') == 'vc_media_grid'){
		        new_params = _.extend(new_params, {grid_id:"vc_gid:"+(Date.now()+"-"+new_id+"-"+Math.floor(11*Math.random()))});
	        }
	        
	        model_clone = Shortcodes.create({shortcode:model.get('shortcode'), id:new_id, parent_id:parent_id, order:new_order, cloned:(model.get('shortcode') === 'verticaltab' ? false : true), cloned_from:model.toJSON(), params:new_params});

	        _.each(Shortcodes.where({parent_id:model.id}), function (shortcode) {
				this.cloneModel(shortcode, model_clone.get('id'), true);
	        }, this);
	        
	        return model_clone;
	    },
	});
	
	
	/* column view from vc [needed] */
	window.VcColumnView = vc.shortcode_view.extend( {
		events: {
			'click > .vc_controls [data-vc-control="delete"]': 'deleteShortcode',
			'click > .vc_controls [data-vc-control="add"]': 'addElement',
			'click > .vc_controls [data-vc-control="edit"]': 'editElement',
			'click > .vc_controls [data-vc-control="clone"]': 'clone',
			'click > .wpb_element_wrapper > .vc_empty-container': 'addToEmpty'
		},
		current_column_width: false,
		initialize: function ( options ) {
			window.VcColumnView.__super__.initialize.call( this, options );
			_.bindAll( this, 'setDropable', 'dropButton' );
		},
		ready: function ( e ) {
			window.VcColumnView.__super__.ready.call( this, e );
			this.setDropable();
			return this;
		},
		render: function () {
			window.VcColumnView.__super__.render.call( this );
			this.current_column_width = this.model.get( 'params' ).width || '1/1';
			this.$el.attr( 'data-width', this.current_column_width );
			this.setEmpty();
			return this;
		},
		changeShortcodeParams: function ( model ) {
			window.VcColumnView.__super__.changeShortcodeParams.call( this, model );
			this.setColumnClasses();
			this.buildDesignHelpers();
		},
		designHelpersSelector: '> .vc_controls .column_add',
		buildDesignHelpers: function () {
			var css = this.model.getParam( 'css' ),
				$column_toggle = this.$el.find( this.designHelpersSelector ).get( 0 ),
				image, color, $image, $color;
			this.$el.find( '> .vc_controls .vc_column_color' ).remove();
			this.$el.find( '> .vc_controls .vc_column_image' ).remove();
			var matches = css.match( /background\-image:\s*url\(([^\)]+)\)/ )
			if ( matches && ! _.isUndefined( matches[ 1 ] ) ) {
				image = matches[ 1 ];
			}
			var matches = css.match( /background\-color:\s*([^\s\;]+)\b/ )
			if ( matches && ! _.isUndefined( matches[ 1 ] ) ) {
				color = matches[ 1 ];
			}
			var matches = css.match( /background:\s*([^\s]+)\b\s*url\(([^\)]+)\)/ )
			if ( matches && ! _.isUndefined( matches[ 1 ] ) ) {
				color = matches[ 1 ];
				image = matches[ 2 ];
			}
			if ( image ) {
				$( '<span class="vc_column_image" style="background-image: url(' + image + ');" title="' + i18nLocale.column_background_image + '"></span>' )
					.insertBefore( $column_toggle );
			}
			if ( color ) {
				$( '<span class="vc_column_color" style="background-color: ' + color + '" title="' + i18nLocale.column_background_color + '"></span>' )
					.insertBefore( $column_toggle );
			}
		},
		setColumnClasses: function () {
			var offset = this.model.getParam( 'offset' ) || '',
				width = this.model.getParam( 'width' ) || '1/1',
				css_class_width = this.convertSize( width ), current_css_class_width;
			this.current_offset_class && this.$el.removeClass( this.current_offset_class );
			if ( this.current_column_width !== width ) {
				current_css_class_width = this.convertSize( this.current_column_width );
				this.$el
					.attr( 'data-width', width )
					.removeClass( current_css_class_width )
					.addClass( css_class_width );
				this.current_column_width = width;
			}
			if ( offset.match( /vc_col\-sm\-\d+/ ) ) {
				this.$el.removeClass( css_class_width );
			}
			if ( ! _.isEmpty( offset ) ) {
				this.$el.addClass( offset );
			}
			this.current_offset_class = offset;
		},
		addToEmpty: function ( e ) {
			e.preventDefault();
			if ( $( e.target ).hasClass( 'vc_empty-container' ) ) {
				this.addElement( e );
			}
		},
		setDropable: function () {
			this.$content.droppable( {
				greedy: true,
				accept: (this.model.get( 'shortcode' ) == 'vc_column_inner' ? '.dropable_el' : ".dropable_el,.dropable_row"),
				hoverClass: "wpb_ui-state-active",
				drop: this.dropButton
			} );
			return this;
		},
		dropButton: function ( event, ui ) {
			if ( ui.draggable.is( '#wpb-add-new-element' ) ) {
				new vc.element_block_view( { model: { position_to_add: 'end' } } ).show( this );
			} else if ( ui.draggable.is( '#wpb-add-new-row' ) ) {
				this.createRow();
			}
		},
		setEmpty: function () {
			this.$el.addClass( 'vc_empty-column' );
			this.$content.addClass( 'vc_empty-container' );
		},
		unsetEmpty: function () {
			this.$el.removeClass( 'vc_empty-column' );
			this.$content.removeClass( 'vc_empty-container' );
		},
		checkIsEmpty: function () {
			if (this.model.id){
				if ( Shortcodes.where( { parent_id: this.model.id } ).length ) {
					this.unsetEmpty();
				} else {
					this.setEmpty();
				}				
			} 
			window.VcColumnView.__super__.checkIsEmpty.call( this );
		},
		/**
		 * Create row
		 */
		createRow: function () {
			var row = Shortcodes.create( { shortcode: 'vc_row_inner', parent_id: this.model.id } );
			Shortcodes.create( { shortcode: 'vc_column_inner', params: { width: '1/1' }, parent_id: row.id } );
			return row;
		},
		convertSize: function ( width ) {
			var prefix = 'vc_col-sm-',
				numbers = width ? width.split( '/' ) : [
					1,
					1
				],
				range = _.range( 1, 13 ),
				num = ! _.isUndefined( numbers[ 0 ] ) && _.indexOf( range,
					parseInt( numbers[ 0 ], 10 ) ) >= 0 ? parseInt( numbers[ 0 ], 10 ) : false,
				dev = ! _.isUndefined( numbers[ 1 ] ) && _.indexOf( range,
					parseInt( numbers[ 1 ], 10 ) ) >= 0 ? parseInt( numbers[ 1 ], 10 ) : false;
			if ( num !== false && dev !== false ) {
				return prefix + (12 * num / dev);
			}
			return prefix + '12';
		}
	} );
	/* end of column view */ 	

	window.VcVerticalTabView = window.VcColumnView.extend({
	    render:function () {
	        var params = this.model.get('params');
	        window.VcVerticalTabView.__super__.render.call(this);
	        if(!params.tab_id) {
	          params.tab_id = (+new Date() + '-' + Math.floor(Math.random() * 11));
	          this.model.save('params', params);
	        }
	        this.id = 'tab-' + params.tab_id;
	        this.$el.attr('id', this.id);
	        
	        return this;
	    },
	    ready:function (e) {
		    
		    window.VcVerticalTabView.__super__.ready.call(this, e);
		    
		    var vtid = this.model.id;
		    if (!window.removethiscontent || window.removethiscontent.length < 1) window.removethiscontent = [];
		    var numbrows = 0;
			_.each(Shortcodes.where({parent_id:vtid}), function (shortcode) {
				if (!numbrows) {
					numbrows = 1;
				} else {
					window.removethiscontent.push(vc.shortcodes._byId[shortcode.id]);
				}
			})
			
	        this.$tabs = this.$el.closest('.wpb_tabs_holder');
			jQuery(this.$tabs).find('.wpb_verticaltab').addClass('wpb_vc_tab');
	        var params = this.model.get('params');
	        if(params)
	        return this;
	    },
	    changeShortcodeParams:function (model) {
	        var params = model.get('params'),
				icon = (params.icon) ? params.icon : "fa-adjust";
	        window.VcVerticalTabView.__super__.changeShortcodeParams.call(this, model);
	        if (_.isObject(params) && _.isString(params.title) && _.isString(params.tab_id)) {
	        	var title = (params.title) ? params.title : "Tab";
				var htmlaux = '<i class="fa '+icon+'"></i><span class="title">' + title +'</span>';
				jQuery('.ui-tabs-nav [href="#tab-' + params.tab_id + '"]').html(htmlaux);
	        }
	    },
	    deleteShortcode:function (e) {
	        if (_.isObject(e)) e.preventDefault();
	        var answer = confirm(window.i18nLocale.press_ok_to_delete_section);
	        if (answer !== true) return false;
	        this.model.destroy();
	        var params = this.model.get('params'),
	            current_tab_index = jQuery('[href="#tab-' + params.tab_id + '"]', this.$tabs).parent().index();
	        jQuery('[href="#tab-' + params.tab_id + '"]').parent().remove();
	        this.$tabs.tabs('refresh');
	        var tab_length = this.$tabs.find('.ui-tabs-nav li:not(.add_tab_block)').length;
	        if (current_tab_index < tab_length) {
	            this.$tabs.tabs("option", "active", current_tab_index);
	        } else if(tab_length>0) {
	            this.$tabs.tabs("option", "active", tab_length-1);
	        }
	    },
	    cloneModel:function (model, parent_id, save_order) {
	        var shortcodes_to_resort = [],
	            new_order = _.isBoolean(save_order) && save_order === true ? model.get('order') : parseFloat(model.get('order')) + vc.clone_index,
	            new_params = _.extend({}, model.get('params'));
	        if (model.get('shortcode') === 'verticaltab') _.extend(new_params, {tab_id:+new Date() + '-' + this.$tabs.find('[data-element_type=verticaltab]').length + '-' + Math.floor(Math.random() * 11)});
	        var model_clone = Shortcodes.create({shortcode:model.get('shortcode'), parent_id:parent_id, order:new_order, cloned:true, cloned_from:model.toJSON(), params:new_params});
	        _.each(Shortcodes.where({parent_id:model.id}), function (shortcode) {
	            this.cloneModel(shortcode, model_clone.id, true);
	        }, this);
	        return model_clone;
	    }
	});
})(window.jQuery);


jQuery(window).load(function(){
	if (window.removethiscontent && window.removethiscontent.length){
		for (var i = 0; i<window.removethiscontent.length; i++){
			window.removethiscontent[i].destroy();
		}
	}
	
});