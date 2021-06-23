<?php get_header(); ?>
<section class="category-content index-main">
	<div class="row">
		<?php if ( is_active_sidebar( 'main' ) ) { ?>
		<div class="large-8 columns">
		<?php }else{ ?>
		<div class="large-12 columns">
		<?php } ?>
			<?php if ( have_posts() ){ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'blog-loop' ); ?>
				<?php endwhile; ?>
				<?php get_template_part('pagination');?>
			<?php }else{ ?>			
				<?php get_template_part( 'parts/content', 'missing' ); ?>
			<?php } ?>
		</div><!--row-->
		<?php if ( is_active_sidebar( 'main' ) ) { ?>
		<div class="large-4 columns">
			<aside class="secBg sidebar">
				<div class="row">
					<?php get_sidebar(); ?>
				</div>
			</aside>
		</div>	
		<?php } ?>
	</div><!--row-->
</section><!--category-content-->			
<?php get_footer(); ?>