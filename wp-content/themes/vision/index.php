<?php get_header(); ?>

<?php 

if(is_home() && $paged<2){
	get_template_part('slider');
}

?>

<section class="section-content-area">
		
		<div class="container">
			
			<div class="row">
				
				<div class="col-sm-9">
					
					<div class="posts-area">						
					
						<?php if(have_posts()): ?>

						<?php while(have_posts()):the_post(); ?>

							<?php get_template_part('content',get_post_format() ); ?>

						<?php endwhile; ?>

						<?php vision_pagenavi(); ?>
				
						<?php else: ?>

							<?php get_template_part('content','none'); ?>
						
						<?php endif; ?>			

					</div> <!-- end posts-area -->

				</div> <!-- end col-sm-9 -->
	
				<div class="col-sm-3">
	
					<div class="sidebar">
						
						<?php get_sidebar(); ?>
			
					</div> <!-- end sidebar -->

				</div> <!-- end col-sm-3 -->

			</div> <!-- end row -->

		</div> <!-- end container -->

</section> <!-- end section-content-area -->

<?php get_template_part('footer', 'main'); ?>

<?php get_footer(); ?>