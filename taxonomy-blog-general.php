<?php
/**
 * The template for displaying archives of any blog taxonomy
 *
 * @package WordPress
 * @subpackage classify-child
 * @since classify 1.0
 */

get_header();?>
<?php betube_breadcrumbs(); ?>
<section class="category-content">
	<div class="row">
		<!-- left side content area -->
		<div class="large-8 columns">			
			<?php if ( have_posts() ): ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'blog-loop' ); ?>
				<?php endwhile; ?>
				<div class="row">
					<div class="large-12 columns">
						<?php get_template_part('pagination'); ?>
					</div><!--large-12-->
				</div><!--row-->
				<?php else : ?>
				<?php echo esc_html_e('Sorry, Nothing found', 'betube'); ?>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
		</div>		
		<!-- left side content area -->
		<div class="large-4 columns">
			<aside class="secBg sidebar">
				<div class="row">
					<?php dynamic_sidebar('blog'); ?>
				</div>
			</aside>
		</div>
	</div><!--row-->
</section>
<?php get_footer(); ?>