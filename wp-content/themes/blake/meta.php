<div class="metas">									    	
	<div class="metas-div">
		<?php
			if (comments_open()){
				?>
				<div class="divider-tags">
					<span class="blog-i comments"><?php comments_number(esc_html__("0 Comments", "blake"), esc_html__("1 Comment","blake"), esc_html__("% Comments", "blake")); ?></span>
				</div>
				<?php
			}
		?>
		
		<div class="divider-tags">
			<a class="the_author" href="?author=<?php esc_url(the_author_meta('ID')); ?>"><?php esc_html(the_author_meta('nickname')); ?></a>
		</div>
		<?php if (count(get_the_tags())>0) {
			?>
				<div class="divider-tags">
					<span class="tags"><?php the_tags( ''. '', ', ', ''); ?></span>
				</div>
			<?php
		} ?>
		<?php if (count(get_the_category())>0) {
			?>
				<div class="divider-tags">
					<span class="categories"><?php the_category( ''. '', ', ', ''); ?></span>
				</div>
			<?php
		} ?>
		<div class="divider-tags">
			<span class="date blog-date"><?php echo get_the_date(); ?></span>
		</div>
	</div>
</div>