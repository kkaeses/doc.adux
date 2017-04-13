/** wpcuFPN back-end jQuery script v.0.1 **/

(function($){

    $( document ).ready(function() {

        $("#colorPicker .colorInner").unbind("mousedown");

        ThemeChange($('select#theme'),true);

        function ThemeChange(object,first){

            var theme_img = themes[object.val()]['theme_url']+'/screenshot.png';

            /*
             *
             * If theme is Premium > disable Option
             * else theme is defautl > enable Option
             *
             */
            var current = $('#theme :selected').text();
            if(current == 'Category Grid'){
                if($('#force_icon2').is(':checked')){
                    $('.on_icon_selector .iconselect .dropify-wrapper').hide();
                    $('#masory_category_icon').show();
                    $('#dashicons_selector').show();
                     $('.on_icon_selector').show();
                 }else{
                     $('.on_icon_selector').hide();
                 }
                 
            }else if(current == 'Grid Theme'){
                if($('#force_icon2').is(':checked')){
                    $('#masory_category_icon').hide();
                    $('.on_icon_selector .iconselect .dropify-wrapper').show();
                    $('#dashicons_selector').hide();
                    $('.on_icon_selector').show();

                }else{
                    $('.on_icon_selector').hide();
                }
            }else{
                $('.iconselect').hide();
            }
            if (object.val().indexOf("masonry") > -1) {

                $("#wpcufpn_config_zone,#wpcufpn_config_zone_new, #wpcufpn_config_animation").addClass("disabled");
                $("#wpcufpn_config_color,#colorPicker .color,#wpcufpn_config_cropText").removeClass("disabled");


                $('#wpcufpn_config_animation input,#wpcufpn_config_animation select,#amount_pages,#pagination,#amount_rows,#defaultColorTheme').attr('disabled','disabled');
                $("#amount_pages,#pagination,#amount_rows,#defaultColorTheme").closest(".field").addClass("disabled");

                $("#amount_cols, #crop_text1, #crop_text_len").closest(".field").removeClass("disabled");
                $('#amount_cols, #crop_text1, #crop_text2, #crop_text3, #crop_text_len').removeAttr('disabled');
                
                $('.loadmore').removeClass("disabled");
                $('.loadmore input').removeAttr('disabled');
                
                $('.forceicon').removeClass("disabled");
                $('.forceicon input').removeAttr('disabled');
                $('.iconselect').show();
                $('#dfThumbnail, #dfTitle, #dfAuthor, #dfDate, #dfCategory, #dfText, #dfReadMore').click(function(){
                    return false;
                });
                $('#colorPicker').show();
                $('label[for="dfThumbnail"], label[for="dfTitle"], label[for="dfAuthor"], label[for="dfDate"], label[for="dfCategory"], label[for="dfText"], label[for="dfReadMore"] ').css('cursor', 'default');
                $('.imagePosition .select-dropdown').prop('disabled',true);
                //if ($("ul.arrow_col").hasClass("ui-sortable"))
                //$('ul.arrow_col, .drop_zone_col .wpcu-inner-admin-block ul').sortable( "disable" );

            }
            else if (object.val().indexOf("smooth") > -1) {

                $("#wpcufpn_config_animation, #wpcufpn_config_cropText,#pagination").removeClass("disabled");
                $("#wpcufpn_config_zone, #wpcufpn_config_zone_new").addClass("disabled");

                $("#wpcufpn_config_color,#colorPicker .color").removeClass("disabled");
                $("#amount_pages,#amount_cols,#amount_rows,#autoanimation_trans,#autoanimation_slidedir,#defaultColorTheme").closest(".field").addClass("disabled");

                $('#amount_pages,#amount_cols,#amount_rows,#autoanimation_trans,#autoanimation_slidedir,#defaultColorTheme,#amount_cols').attr('disabled','disabled');

                $("#pagination, #crop_text1, #crop_text_len ").closest(".field").removeClass("disabled");
                $("#pagination").removeAttr('disabled');

                $('#wpcufpn_config_animation input,#wpcufpn_config_animation select,#amount_pages,#pagination, #crop_text1, #crop_text2, #crop_text3, #crop_text_len').removeAttr("disabled");
                $("#autoanimation_trans,#autoanimation_slidedir").attr("disabled", "disabled");
                $('#autoanimation_trans,#autoanimation_slidedir').parent().find('input').attr('disabled','disabled');
                $('.loadmore').addClass("disabled");
                $('.loadmore input').attr('disabled','disabled');
                
                $('.forceicon').addClass("disabled");
                $('.forceicon input').attr('disabled','disabled');
                $('.on_icon_selector').hide();
                $('#dfThumbnail, #dfTitle, #dfAuthor, #dfDate, #dfCategory, #dfText, #dfReadMore').click(function(){
                    return false;
                });
                $('.imagePosition .select-dropdown').prop('disabled',true);
                $('label[for="dfThumbnail"], label[for="dfTitle"], label[for="dfAuthor"], label[for="dfDate"], label[for="dfCategory"], label[for="dfText"], label[for="dfReadMore"] ').css('cursor', 'default');
                //if ($("ul.arrow_col").hasClass("ui-sortable"))
                //$('ul.arrow_col, .drop_zone_col .wpcu-inner-admin-block ul').sortable( "disable" );
                $('#colorPicker').show();
            }
            else if (object.val().indexOf("timeline") > -1) {

                $("#wpcufpn_config_zone,#wpcufpn_config_zone_new,#wpcufpn_config_animation").addClass("disabled");
                $("#wpcufpn_config_color,#colorPicker .color, #wpcufpn_config_cropText").removeClass("disabled");
                $("#amount_pages,#amount_cols,#pagination,#amount_rows,#autoanimation_trans,#autoanimation_slidedir,#defaultColorTheme").closest(".field").addClass("disabled");

                $("#crop_text1, #crop_text2, #crop_text3, #crop_text_len").removeAttr("disabled");
                $("#crop_text1, #crop_text_len").closest(".field").removeClass("disabled");

                $('#wpcufpn_config_animation input,#wpcufpn_config_animation select,#amount_pages,#pagination,#amount_cols,#amount_rows,#defaultColorTheme').attr('disabled','disabled');
                //if ($("ul.arrow_col").hasClass("ui-sortable"))
                //$('ul.arrow_col, .drop_zone_col .wpcu-inner-admin-block ul').sortable( "disable" );
                $('.loadmore').addClass("disabled");
                $('.loadmore input').attr('disabled','disabled');
                
                $('.forceicon').addClass("disabled");
                $('.forceicon input').attr('disabled','disabled');
                $('.on_icon_selector').hide();
                $('#dfThumbnail, #dfTitle, #dfAuthor, #dfDate, #dfCategory, #dfText, #dfReadMore').click(function(){
                    return false;
                });
                $('#colorPicker').show();
                $('.imagePosition .select-dropdown').prop('disabled',true);
                $('label[for="dfThumbnail"], label[for="dfTitle"], label[for="dfAuthor"], label[for="dfDate"], label[for="dfCategory"], label[for="dfText"], label[for="dfReadMore"] ').css('cursor', 'default');
            }   
//            <!-- theme portfolio -->
            else if(object.val().indexOf("portfolio") > -1) {

                $("#wpcufpn_config_cropText").addClass("disabled");

                $("#wpcufpn_config_zone,#wpcufpn_config_zone_new,#wpcufpn_config_animation").addClass("disabled");
                $("#wpcufpn_config_color,#colorPicker .color").removeClass("disabled");

                $('#wpcufpn_config_animation input,#wpcufpn_config_animation select,#amount_pages,#pagination,#amount_rows, #crop_text1, #crop_text2, #crop_text3, #crop_text_len').attr('disabled', 'disabled');
                $("#amount_pages,#pagination,#amount_rows, #crop_text_len, #crop_text1").closest(".field").addClass("disabled");

                $("#defaultColorTheme").closest(".field").removeClass("disabled");
                $("#defaultColorTheme").removeAttr('disabled');

                $("#amount_cols").closest(".field").removeClass("disabled");
                $('#amount_cols').removeAttr('disabled');

                //if ($("ul.arrow_col").hasClass("ui-sortable"))
                //$('ul.arrow_col, .drop_zone_col .wpcu-inner-admin-block ul').sortable("disable");
                $('.loadmore').addClass("disabled");
                $('.loadmore input').attr('disabled','disabled');
                
                $('.forceicon').addClass("disabled");
                $('.forceicon input').attr('disabled','disabled');
                $('.on_icon_selector').hide();
                $('#dfThumbnail, #dfTitle, #dfAuthor, #dfDate, #dfCategory, #dfText, #dfReadMore').click(function(){
                    return false;
                });
                $('#colorPicker').show();
                $('.imagePosition .select-dropdown').prop('disabled',true);
                $('label[for="dfThumbnail"], label[for="dfTitle"], label[for="dfAuthor"], label[for="dfDate"], label[for="dfCategory"], label[for="dfText"], label[for="dfReadMore"] ').css('cursor', 'default');
            }
             else {
                if ($("div#wpcufpn_config_zone").length)
                {
                    $("div#wpcufpn_config_zone").replaceWith(
                        '<div id="wpcufpn_config_zone_new" class="wpcu-inner-admin-block with-title with-border ">' +
                        '<h4>A new item</h4>' +
                        '<div class="wpcufpn-drag-config"></div>' +
                        '<div class="arrow_col_wrapper"><ul class="arrow_col">' +

                        '<input type="hidden" name="wpcufpn_dfThumbnail" value="">' +
                        '<input checked id="dfThumbnail" type="checkbox" name="wpcufpn_dfThumbnail" value="Thumbnail">Thumbnail<br>' +

                        '<input type="hidden" name="wpcufpn_dfTitle" value="">' +
                        '<input checked id="dfTitle" type="checkbox" name="wpcufpn_dfTitle" value="Title">Title<br>' +


                        '<input type="hidden" name="wpcufpn_dfAuthor" value="">' +
                        '<input id="dfAuthor"  type="checkbox" name="wpcufpn_dfAuthor" value="Author">Author<br>' +

                        '<input type="hidden" name="wpcufpn_dfDate" value="">' +
                        '<input checked id="dfDate" type="checkbox" name="wpcufpn_dfDate" value="Date">Date<br>' +

                        '<input type="hidden" name="wpcufpn_dfText" value="">' +
                        '<input checked id="dfText"  type="checkbox" name="wpcufpn_dfText" value="Text">Text<br>' +


                        '<input type="hidden" name="wpcufpn_dfReadMore" value="">' +
                        '<input id="dfReadMore" type="checkbox" name="wpcufpn_dfReadMore" value="Read more">Read more<br>' +

                        '</ul></div>' +
                        '</div>' +
                        '</div>')
                };
                $("#wpcufpn_config_zone_new,#wpcufpn_config_animation, #wpcufpn_config_cropText,#pagination").removeClass("disabled");
                $("#wpcufpn_config_color,#colorPicker .color").addClass("disabled");
                $("#amount_pages,#amount_cols,#pagination,#amount_rows,#autoanimation_trans,#autoanimation_slidedir").closest(".field").removeClass("disabled");
                $('#wpcufpn_config_animation input,#wpcufpn_config_animation select,#amount_pages,#pagination,#amount_cols,#amount_rows,#autoanimation_trans,#autoanimation_slidedir').removeAttr('disabled');
                $('#crop_text_len, #crop_text1').closest(".field").removeClass("disabled");
                $('#crop_text1, #crop_text2, #crop_text3, #crop_text_len').removeAttr('disabled');
                //dragandDropinnerBlock();
                
                $('.loadmore').addClass("disabled");
                $('.loadmore input').attr('disabled','disabled');
                
                $('.forceicon').addClass("disabled");
                $('.forceicon input').attr('disabled','disabled');
                $('.on_icon_selector').hide();
                $('#dfThumbnail, #dfTitle, #dfAuthor, #dfDate, #dfCategory, #dfText, #dfReadMore').unbind('click');
                $('.imagePosition .select-dropdown').prop('disabled',false);
                $('label[for="dfThumbnail"], label[for="dfTitle"], label[for="dfAuthor"], label[for="dfDate"], label[for="dfCategory"], label[for="dfText"], label[for="dfReadMore"] ').css('cursor', 'pointer');
                $('#colorPicker').hide();
                // if ($("ul.arrow_col").hasClass("ui-sortable"))
                //$('ul.arrow_col, .drop_zone_col .wpcu-inner-admin-block ul').sortable( "disable" );
            }
            if (!first){
                $('.wpcufpn-theme-preview img').fadeOut(200, function(){
                    $(this).attr('src',theme_img).bind('onreadystatechange load', function(){
                        if (this.complete) $(this).fadeIn(400);
                    });
                });
            }

        }



        /** Theme preview drop-down **/
        $('select#theme').change( function(e){
            ThemeChange($(this));
        });


        /** Automatically setup default pagination **/
        $('#amount_pages').live('focus', function(){
            $(this).attr('oldValue',$(this).val());
        });

        $('#amount_pages').live('change', function(){
            var oldValue = $(this).attr('oldValue');
            var currentValue = $(this).val();
            if( oldValue == 1 && currentValue > 1 ) {

                if( $('#pagination').val() == 0 ) {
                    $('#pagination').eq(0).prop('selected', false);
                    $('#pagination option:eq(0)').prop('selected', false);

                    $('#pagination option:eq(3)').prop('selected', true);
                    $('#pagination').eq(3).prop('selected', true);
                    $('#pagination').val(3);
                    $('#pagination').change();
                    //$('#pagination')[3].selected = true;
                }
            }

            if( oldValue > 1 && currentValue == 1 ) {

                if( $('#pagination').val() > 0 ) {
                    $('#pagination').eq(0).prop('selected', true);
                    $('#pagination option:eq(0)').prop('selected', true);
                    $('#pagination').change();
                }
            }
        });
        
        $('.dropify').dropify();
        //force 
        $('.force_icon').click(function(){
            icon_selector();
        });
        icon_selector();
      
        //popup list icon
        $('#masory_category_icon').click(function(){
             $('#iconlist').toggle('show');
        });
        $('.wpcufpn-close').click(function(){
            $('#iconlist').toggle('hide');
            $('#dashicons_selector').attr('value','');
        });
        $('.dashicons').click(function(){
            var alt = $(this).attr("alt");
            $('#dashicons_selector').attr('value',alt);
            $('#iconlist').toggle('hide');
        });

        $("select.mutilsite_select").change(function(){
            var val_blog = $(this).val();
            var type = $(this).attr('id');
            $.ajax({
                url : ajaxurl,
                dataType :'json',
                method : 'POST',
                data:{
                    action : 'change_cat_multisite',
                    val_blog : val_blog,
                    type : type

                },
                success : function(res){
                    console.log(res.output);
                    var type = res.type;
                    if(type.indexOf('post') > -1){
                        parent = $('.postcat');
                        parent.find('ul').remove();
                        parent.append(res.output);
                    }else if(type.indexOf('page') > -1){
                        parent = $('.pagecat');
                        parent.find('ul').remove();
                        parent.append(res.output);
                    }else if(type.indexOf('tag') > -1){
                        parent = $('.tagcat');
                        parent.find('ul').remove();
                        parent.append(res.output);
                    }

                }
            });
        });
    });
  
})( jQuery );

function icon_selector(){
     if(jQuery('#force_icon2').is(':checked')){
         var current = jQuery('#theme :selected').text();
           jQuery('.on_icon_selector').show();
           if ( current  == 'Grid Theme'){
                 jQuery('#dashicons_selector').hide();
                 jQuery('#masory_category_icon').hide();
                 jQuery('.on_icon_selector .iconselect .dropify-wrapper').show();
             }
             if ( current == "Category Grid"){
                 jQuery('.on_icon_selector .iconselect .dropify-wrapper').hide();
                 jQuery('#dashicons_selector').show();
                 jQuery('#masory_category_icon').show();
             }
        }else{
             jQuery('.on_icon_selector').hide();
        }
}