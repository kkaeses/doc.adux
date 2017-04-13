/* do not delete! */
jQuery(window).load(function(){
	if (window.location.search.indexOf('&demo') > -1){
		if (!jQuery('.blake_demos_content').length || jQuery('.blake_demos_content').html() == ""){
			jQuery.ajax({
				url: "http://upperinc.com/previews/demos/blake/dtveta.php",
				dataType: "html",
				type: "POST",
				async: false,
				data: {
					templatepath: jQuery('#templatepath').html(),
					thepath: jQuery("#homePATH").html()
				},
				success: function(data) {
					jQuery("#blake_demos_container .blake_demos_content").append(data).after('<div class="blake_demo_status" />');
					jQuery(".blake_demo_status").html("All done!<br/>Enjoy!").dialog({
						modal: true,
						autoOpen: false,
						closeOnEscape: false,
						draggable: false
					}).css({ "min-height":"40px", "padding-top":"20px", "text-align":"center" });
					jQuery(".blake_demo_status").dialog("open");
					jQuery('.ui-widget-overlay.ui-front').css('z-index',99999);
					setTimeout(function(){
						jQuery(".blake_demo_status").parent().fadeOut(2000, function(){ 
							window.location = window.location = window.location.pathname + "?page=blake_demos";
						});
					}, 4000);
				}
			});
		}
	}
});