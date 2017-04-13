<?php
	
	function blake_print_slider($id, $prlx = null){
		$daslider = get_post_meta($id, 'homepageDefaultSlider_value', true);
		if (substr($daslider, 0, 10) === "revSlider_"){
			if (!function_exists('putRevSlider')){
				echo 'Please install the missing plugin - Revolution Slider.';
			} else {
				if ($prlx){ ?>
				<section id="home" class="homepage_parallax parallax">
					<div id="parallax-home" class="parallax" data-stellar-ratio="0.5">
				<?php 
				} ?>
				<section id="home" class="revslider">
					<?php putRevSlider(substr($daslider, 10)); ?>
				</section>
				<?php 
				if ($prlx){ ?>
					</div>
				</section>
				<?php 
				}
			}
		}
}

?>