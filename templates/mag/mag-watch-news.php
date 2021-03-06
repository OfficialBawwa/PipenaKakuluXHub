<?php 
$betubeIconColor = '';
global $redux_demo;
$betubeWatchNewsTitle = $redux_demo['betube_watch_news_title'];
$betubeWatchNewsDesc = $redux_demo['betube_watch_news_description'];
$betubeWatchNewsIcon = $redux_demo['betube_watch_news_icon'];
$betubeWatchNewsIconColor = $redux_demo['betube_watch_news_icon_color'];
$betubeWatchNewsCats = $redux_demo['betube_watch_news_cats'];
$betubeWatchNewsPostCount = $redux_demo['betube_watch_news_post_count'];
?>

<section class="betube_mag borderBottom betube__watchnews">
	<div class="row">
		<div class="columns">
			<!--headings-->
			<div class="Media Media--reverse borderBottom">
				<div class="betube_mag__heading_right Media-figure">
					<!--prev_mag_carousel-->
					<?php if(is_rtl()){?>
					<a href="#" class="next_mag_carousel"><i class="fa fa-chevron-right"></i></a>
					<?php }else{ ?>
					<a href="#" class="prev_mag_carousel"><i class="fa fa-chevron-left"></i></a>
					<?php } ?>
					<!--prev_mag_carousel-->
					
					<!--next_mag_carousel-->
					<?php if(is_rtl()){?>
					<a href="#" class="prev_mag_carousel"><i class="fa fa-chevron-left"></i></a>
					<?php }else{ ?>
					<a href="#" class="next_mag_carousel"><i class="fa fa-chevron-right"></i></a>
					<?php } ?>
					<!--next_mag_carousel-->
				</div><!--betube_mag__heading_right-->
				<div class="Media-body">
					<div class="betube_mag__heading">
						<div class="betube_mag__heading_icon" style="background:<?php echo esc_html($betubeWatchNewsIconColor); ?>;">
							<i class="<?php echo esc_html($betubeWatchNewsIcon); ?>"></i>
						</div><!--betube_mag__heading_icon-->
						<div class="betube_mag__heading_head">
							<h3><?php echo esc_html($betubeWatchNewsTitle); ?></h3>
							<p><?php echo esc_html($betubeWatchNewsDesc); ?></p>
						</div><!--betube_mag__heading_head-->
					</div><!--betube_mag__heading-->
				</div><!--Media-body-->
			</div>
			<!--headings-->
			<!--owl-carousel-->
			<div class="owl-carousel betube_mag__carousel removeBorderBottom" data-car-length="3" data-items="3" data-loop="true" data-nav="false" data-autoplay="true" data-autoplay-timeout="4000" data-dots="false" data-auto-width="false" data-margin="10" data-responsive-small="1" data-responsive-medium="2" data-responsive-xlarge="4" data-right="<?php if(is_rtl()){ echo 'true';}else{echo 'false';}?>">
				<?php 
				global $paged, $wp_query, $wp;
				$temp = $wp_query;
				$wp_query= null;
				$arags = array(					
					'posts_per_page' => $betubeWatchNewsPostCount,
					'category__in' => $betubeWatchNewsCats,
				);
				$wp_query = new WP_Query($arags);
				while ($wp_query->have_posts()) : $wp_query->the_post();
				$betubepostCatgory = get_the_category( $post->ID );
				if ($betubepostCatgory[0]->category_parent == 0){
					$tag = $betubepostCatgory[0]->cat_ID;
					$tag_extra_fields = get_option(BETUBE_CATEGORY_FIELDS);
					if (isset($tag_extra_fields[$tag])) {
						$betubeIconCode = $tag_extra_fields[$tag]['category_icon_code'];
						$betubeIconColor = $tag_extra_fields[$tag]['category_icon_color'];
						$betubeCatIMG = $tag_extra_fields[$tag]['category_image'];
					}
				}elseif($betubepostCatgory[1]->category_parent == 0){
					$tag = $betubepostCatgory[0]->category_parent;
					$tag_extra_fields = get_option(BETUBE_CATEGORY_FIELDS);
					if (isset($tag_extra_fields[$tag])) {
						$betubeIconCode = $tag_extra_fields[$tag]['category_icon_code'];
						$betubeIconColor = $tag_extra_fields[$tag]['category_icon_color'];
						$betubeCatIMG = $tag_extra_fields[$tag]['your_image_url'];
					}
				}else{
					$tag = $betubepostCatgory[0]->category_parent;
					$tag_extra_fields = get_option(BETUBE_CATEGORY_FIELDS);
					if (isset($tag_extra_fields[$tag])) {
						$betubeIconCode = $tag_extra_fields[$tag]['category_icon_code'];
						$betubeIconColor = $tag_extra_fields[$tag]['category_icon_color'];
						$betubeCatIMG = $tag_extra_fields[$tag]['your_image_url'];
					}
				}
				$user_ID = $post->post_author;
				$authorName = get_the_author_meta('display_name', $user_ID );
				$thumbURL = betube_thumb_url($post->ID);
				$altTag = betube_thumb_alt($post->ID);
				$post_ID = $post->ID;
				?>
				<div class="item">
					<figure class="betube_mag__item">
						<div class="betube_mag__item_img height height-220">
							<img src="<?php echo esc_url($thumbURL); ?>" alt="<?php echo esc_attr($altTag); ?>"/>
							<span class="betube_mag__item_cat" style="background:<?php echo esc_html($betubeIconColor); ?>;">
								<?php echo esc_html($betubepostCatgory[0]->name); ?>
							</span>
							<span class="betube_mag__item_icon">
								<i class="<?php echo betube_post_format_display($post_ID); ?>"></i>
							</span>
							<a href="<?php the_permalink(); ?>" class="hover-posts"></a>
						</div>
						<figcaption>
							<h5>
								<a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
							</h5>
							<p>
								<?php esc_html_e( 'BY', 'betube' ); ?> : <?php the_author_posts_link(); ?> 
								<i class="fa fa-clock-o"></i>
								<?php $beTubedateFormat = get_option( 'date_format' );?>
								<?php echo get_the_date($beTubedateFormat, $post_ID); ?>
							</p>
						</figcaption>
					</figure>
				</div><!--item-->
				<?php endwhile; ?>
				<?php wp_reset_query(); ?>
			</div>
			<!--owl-carousel-->
		</div><!--columns-->
	</div><!--row-->
</section><!--betube__watchnews-->