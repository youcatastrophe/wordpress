<?php
/**
 * The template used for displaying blog post full content.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'spacious_before_post_content' ); ?>
	<header class="entry-header">
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
		</h1><!-- .entry-title -->
	</header>

	<div class="entry-content clearfix">
		<?php
			the_content();
			wp_link_pages( array(
			'before'            => '<div style="clear: both;"></div><div class="pagination clearfix">'.__( 'Pages:', 'spacious' ),
			'after'             => '</div>',
			'link_before'       => '<span>',
			'link_after'        => '</span>'
      ) );
		?>
	</div>

	<footer class="entry-meta-bar clearfix">
		<div class="entry-meta clearfix">
			<span class="by-author author vcard"><a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span>
			<?php spacious_updated_class(); ?>
			<?php if( has_category() ) { ?>
       		<span class="category"><?php the_category(', '); ?></span>
       	<?php } ?>
				<?php if ( comments_open() ) { ?>
       		<span class="comments"><?php comments_popup_link( __( 'No Comments', 'spacious' ), __( '1 Comment', 'spacious' ), __( '% Comments', 'spacious' ), '', __( 'Comments Off', 'spacious' ) ); ?></span>
       	<?php } ?>
       	<?php edit_post_link( __( 'Edit', 'spacious' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
	</footer>
	<?php
	do_action( 'spacious_after_post_content' );
   ?>
</article>