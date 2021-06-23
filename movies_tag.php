<?php
/**
 * The template for displaying archives of movies archive
 *
 * @package WordPress
 * @subpackage betube
 * @since betube 2.0.4
 */
?>
<?php get_header();?>
<?php 
$tagID = get_queried_object(); 
print_r($tagID);
echo "shabir";
$arags = array(
	'post_type' => 'movies',
	'posts_per_page' => 10,
	'post_status' => 'publish',	
	'tag' => 'DESC',
);
$wp_query= null;
$wp_query = new WP_Query($arags);								
?>
<?php betube_breadcrumbs(); ?>
<div class="row">
	<div class="large-8 columns">
		<section class="content content-with-sidebar">
			<div class="row secBg">
				<div class="large-12 columns">
					<div class="main-heading movie__list_heading clearfix">
						<div class="head-title pull-left">
							<i class="fa fa-film"></i>
							<h4><?php the_archive_title();?></h4>
						</div><!--head-title-->
					</div><!--movie__list_heading-->
					<div class="tabs-content" data-tabs-content="newVideos">
						<div class="tabs-panel is-active" id="new-all">
							<div class="row gutter__12 mr-set">
								<?php if (have_posts() ): ?>
								<?php while (have_posts() ) : the_post(); ?>
								<!--Single Movie-->
								<div class="large-3 medium-4 columns beetube__matchheight end">
									<div class="post thumb-border movie__post">
										<div class="post-thumb">
											<?php 
											if( has_post_thumbnail()){
												$imageurl = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'betube-movies');
												$thumb_id = get_post_thumbnail_id($post->id);
												$alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
											?>
											<img src="<?php echo esc_url($imageurl[0]); ?>" alt="<?php if(empty($alt)){echo "Image";}else{ echo esc_attr($alt); } ; ?>"/>
											<?php }else{ ?>
											<img src="<?php echo get_template_directory_uri() . '/assets/images/watchmovies.png' ?>" alt="No Thumb"/>
											<?php }?>
											<a href="<?php the_permalink(); ?>" class="hover-posts">
												<span><i class="fa fa-play"></i>
												<?php esc_html_e('Watch movie', 'betube') ?>
												</span>
											</a>
										</div>
										<div class="post-des text-center">
											<h6>
												<a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a>
											</h6>
											<span><?php esc_html_e('Views', 'betube') ?> : <?php echo betube_get_post_views(get_the_ID()); ?></span>
										</div>
									</div><!--post-->
								</div><!--large-3-->
								<!--Single Movie-->
								<?php endwhile; ?>
								<!--Paginatation-->
								<div class="row">
									<div class="large-12 columns"><?php get_template_part('pagination'); ?></div>
								</div>
								<!--Paginatation-->
								<?php endif; ?>
							</div><!--row-->
						</div><!--tabs-panel-->
					</div><!--tabs-content-->
				</div><!--large-12-->
			</div><!--row secBg-->
		</section><!--content content-with-sidebar-->
	</div><!--large-8-->
	<div class="large-4 columns">
		<aside class="secBg sidebar">
			<div class="row">
				<?php dynamic_sidebar('main'); ?>
			</div><!--row-->
		</aside><!--secBg-->
	</div><!--large-4 columns-->
</div><!--row-->
<?php get_footer(); ?>