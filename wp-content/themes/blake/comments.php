<?php
/**
 * @package WordPress
 * @subpackage Blake
 */

if ( ! function_exists( 'blake_handcraftedwp_comment' ) ) :

function blake_handcraftedwp_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php esc_attr(comment_ID()); ?>">
		<article id="comment-<?php esc_attr(comment_ID()); ?>" class="comment" role="article">

			<div class="comment-author vcard">
		    	<?php echo get_avatar( $comment, 70 ); ?>
		    	<?php printf( esc_html__( '%s','blake'), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		    </div><!-- .comment-author .vcard -->
				
			<div class="comment-block">
				<div class="comment-body"><?php wp_kses_post(comment_text()); ?></div>
				
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php esc_html_e( 'Your comment is awaiting moderation.', 'blake' ); ?></em>
					<br />
				<?php endif; ?>
				
				<div class="metas-comments">
					<p class="blog-date"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
					
					printf( esc_html__( '%1$s at %2$s', 'blake' ), get_comment_date(),  get_comment_time() ); ?>
					</time></a></p>
				
					<p><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></p>
				</div>
			</div>	


			
		</article><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php esc_html_e( 'Pingback:', 'blake' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__('(Edit)', 'blake'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif; // ends check for blake_handcraftedwp_comment()

?>

	<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<div class="nopassword"><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'blake' ); ?></div>
	</div><!-- .comments -->
	<?php return;
		endif;
	?>

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h3 id="comments-title">
			<?php
			    printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'blake' ),
			        number_format_i18n( get_comments_number() ), '<em>' . wp_kses_post(get_the_title()) . '</em>' );
			?>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" role="article">
			<h1 class="section-heading"><?php esc_html_e( 'Comment navigation', 'blake' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'blake' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'blake' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'blake_handcraftedwp_comment' ) ); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" role="article">
			<h1 class="section-heading"><?php esc_html_e( 'Comment navigation', 'blake' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'blake' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'blake' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

	<?php else : // this is displayed if there are no comments so far ?>

		<?php if ( comments_open() ) : // If comments are open, but there are no comments ?>

		<?php else : // or, if we don't have comments:

			/* If there are no comments and comments are closed,
			 * let's leave a little note, shall we?
			 * But only on posts! We don't really need the note on pages.
			 */
			if ( ! comments_open() && ! is_page() ) :
			?>
			<p class="nocomments"><?php esc_html_e( 'Comments are closed.', 'blake' ); ?></p>
			<?php endif; // end ! comments_open() && ! is_page() ?>


		<?php endif; ?>

	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments -->