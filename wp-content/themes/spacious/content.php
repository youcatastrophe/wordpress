<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'spacious_before_post_content' ); ?>

	<?php
	if( !is_single() ) {
	?>
	<header class="entry-header">
	<h1 class="entry-title">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
	</h1><!-- .entry-title -->
	</header>
	<?php
	}
	?>

	<?php
		if( has_post_thumbnail() ) {
			if( of_get_option( 'spacious_site_layout', 'box_1218px' ) == 'box_1218px' || of_get_option( 'spacious_site_layout', 'box_1218px' ) == 'wide_1218px' ) {
				$featured = 'featured-blog-large';
			}
			elseif( of_get_option( 'spacious_site_layout', 'box_1218px' ) == 'box_978px' || of_get_option( 'spacious_site_layout', 'box_1218px' ) == 'wide_978px' ) {
				$featured = 'featured';
			}
			$image = '';
     		$title_attribute = get_the_title( $post->ID );
     		$image .= '<figure class="post-featured-image">';
  			$image .= '<a href="' . get_permalink() . '" title="'.the_title( '', '', false ).'">';
  			$image .= get_the_post_thumbnail( $post->ID, $featured, array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
  			$image .= '</figure>';

  			echo $image;
  		}
	?>

	<div class="entry-content clearfix">
		<?php
			the_excerpt();
		?>
	</div>

	<?php if ( 'post' == get_post_type() ) : ?>
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
				<span class="read-more-link"><a class="read-more" href="<?php the_permalink(); ?>"><?php _e( 'Read more', 'spacious' ); ?></a></span>
			</div>
		</footer>
	<?php endif; ?>
	<?php
	do_action( 'spacious_after_post_content' );
   ?>
</article>