<?php

		?>
			<form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url( '/' )); ?>">
			    <div><label class="screen-reader-texts" for="s"><?php esc_html_e('Search for:', 'blake') ?></label>
			        <input type="text" value="" placeholder="<?php echo sprintf(esc_attr__("%s", "blake"), get_option("blake_search_box_text")); ?>" onfocus="if (jQuery(this).val() === '<?php echo sprintf(esc_attr__("%s", "blake"), get_option("blake_search_box_text")); ?>') jQuery(this).val('');" onblur="if (jQuery(this).val() === '') jQuery(this).val('<?php echo sprintf(esc_attr__("%s", "blake"), get_option("blake_search_box_text")); ?>');" name="s" id="s" />
			        <input type="submit" id="searchsubmit" value="Search" />
			    </div>
			</form>
		<?php

?>