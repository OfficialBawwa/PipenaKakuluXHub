<?php
/**
 * The template for displaying Author bio
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage betube
 * @since betube
 */

global $user_ID;
global $paged;
$author = get_user_by( 'slug', get_query_var( 'author_name' ) ); 
$user_ID = $author->ID;
$user_info = get_userdata($user_ID);
get_header();
betube_breadcrumbs(); 
global $redux_demo; 
$contact_email = get_the_author_meta( 'user_email', $user_ID );
$betubeProfileIMG = get_user_meta($user_ID, "betube_author_profile_bg", true);
if(!empty($betubeProfileIMG)){
	$betubeProfileIMG = betube_get_image_url($betubeProfileIMG);
}
if(isset($_POST['unfollow'])){
	$author_id = sanitize_text_field($_POST['author_id']);
	$follower_id = sanitize_text_field($_POST['follower_id']);
	echo betube_authors_unfollow($author_id, $follower_id);	
}
if(isset($_POST['follower'])){
	$author_id = sanitize_text_field($_POST['author_id']);
	$follower_id = sanitize_text_field($_POST['follower_id']);
	echo betube_authors_insert($author_id, $follower_id);	
}
?>
<section class="topProfile" style="background: url('<?php echo esc_url($betubeProfileIMG); ?>') no-repeat;">
	<div class="main-text text-center">
		<div class="row">
			<div class="large-12 columns">
				<?php 
					$betubeFirstTXT = get_the_author_meta('firsttext', $user_ID);
					$betubeSecondTXT = get_the_author_meta('secondtext', $user_ID);
				?>
				<?php if($betubeFirstTXT){ ?>
					<h3><?php echo betube_display_html_ad_code($betubeFirstTXT); ?></h3>
				<?php } ?>
				<?php if($betubeSecondTXT){ ?>
					<h1><?php echo betube_display_html_ad_code($betubeSecondTXT); ?></h1>
				<?php } ?>
			</div><!--large-12-->
		</div><!--row-->
	</div><!--main-text-->
	<div class="profile-stats">
		<div class="row secBg">
			<div class="large-12 columns">
				<?php 				
				$authorAvatarURL = get_user_meta($user_ID, "betube_author_avatar_url", true);
				if(!empty($authorAvatarURL)) {
					$authorAvatarURL = betube_get_image_url($authorAvatarURL);
					?>
					<div class="profile-author-img">
						<img src="<?php echo esc_url($authorAvatarURL); ?>" alt="<?php esc_html_e("Author", 'betube') ?>">
					</div>
					<?php
				}else{
					$authorID = get_the_author_meta('user_email', $user_ID);
					$avatar_url = betube_get_avatar_url($authorID, $size = '150' );
					?>
					<div class="profile-author-img">
						<img src="<?php echo esc_url($avatar_url); ?>" alt="<?php esc_html_e("Author", 'betube') ?>">
					</div><!--profile-author-img-->
					<?php
				}
				?>
				<div class="profile-subscribe">
					<span><i class="fa fa-users"></i><?php echo betubeFollowerCount($user_ID);?></span>
					<?php 
						if ( is_user_logged_in() ) {
							$current_user = wp_get_current_user();
							$current_user_id = $current_user->ID;
							if(isset($current_user_id)){
								if($user_ID != $current_user_id){							
									echo betube_authors_follower_check($user_ID, $current_user_id);
								}
							}
						}								
						?>
				</div><!--profile-subscribe-->				
				<div class="clearfix">
					<div class="profile-author-name float-left">
						<h4><?php echo get_the_author_meta('display_name', $user_ID); ?></h4>
						<?php $betubeRegDate = get_the_author_meta('user_registered', $user_ID); ?>
						<?php $dateFormat = get_option( 'date_format' );?>
						<p><?php esc_html_e("Join Date", 'betube') ?> : <span><?php echo date($dateFormat, strtotime($betubeRegDate));?></span></p>
					</div><!--profile-author-name-->
					<div class="profile-author-stats float-right">
						<ul class="menu">
							<li>
								<div class="icon float-left">
									<i class="fa fa-video-camera"></i>
								</div>
								<div class="li-text float-left">
									<p class="number-text"><?php echo count_user_posts($user_ID);?></p>
									<span><?php esc_html_e("Videos", 'betube') ?></span>
								</div>
							</li><!--Total Videos-->
							<li>
								<div class="icon float-left">
									<i class="fa fa-heart"></i>
								</div>
								<div class="li-text float-left">
									<p class="number-text">
									<?php 
										echo betubeFavoriteCount($user_ID);
									?>
									</p>
									<span><?php esc_html_e("Favorites", 'betube') ?></span>
								</div>
							</li><!--Total favorites-->
							<li>
								<div class="icon float-left">
									<i class="fa fa-users"></i>
								</div>
								<div class="li-text float-left">
									<p class="number-text"><?php echo betubeFollowerCount($user_ID);?></p>
									<span><?php esc_html_e("Followers", 'betube') ?></span>
								</div>
							</li><!--Total followers-->
							<li>
								<div class="icon float-left">
									<i class="fa fa-comments-o"></i>
								</div>
								<div class="li-text float-left">
								<?php 									
								$args = array(
									'user_id' => $user_ID, // use user_id
									'count' => true, //return only the count
									'status' => 'approve'
								);
								$betubeUsercomments = get_comments($args);
								?>
									<p class="number-text"><?php echo esc_attr($betubeUsercomments); ?></p>
									<span><?php esc_html_e("Comments", 'betube') ?></span>
								</div>
							</li><!--Total comments-->
						</ul>
					</div><!--profile-author-stats-->
				</div><!--clearfix-->
			</div><!--row secBg-->
		</div><!--row secBg-->
	</div><!--profile-stats-->
</section><!--Section topProfile-->
<div class="row">
	<!-- left sidebar -->
	<div class="large-4 columns">
		<aside class="secBg sidebar">
			<div class="row">
				<!-- profile overview -->
				<div class="large-12 columns">
					<div class="widgetBox">
						<div class="widgetTitle">
							<h5><?php esc_html_e("Profile Overview", 'betube') ?></h5>
						</div>
						<div class="widgetContent">
							<ul class="tabs vertical" id="vert-tabs" data-tabs>
								<li class="tabs-title <?php if(empty($paged)){echo "is-active";}?>">
									<a href="#panel1v" aria-selected="true">
									<i class="fa fa-user"></i><?php esc_html_e("About Me", 'betube') ?></a>
								</li>
								<li class="tabs-title <?php if(isset($paged) && $paged > 0){echo "is-active";}?>">
									<a href="#panel2v"><i class="fa fa-user"></i><?php esc_html_e("Videos", 'betube') ?> 
									<span class="float-right">
										<?php echo count_user_posts($user_ID);?>
									</span>
									</a>
								</li>
								<li class="tabs-title">
									<a href="#panel3v"><i class="fa fa-user"></i>
									<?php esc_html_e("Favorite Videos", 'betube') ?>
										<span class="float-right">
											<?php
											echo betubeFavoriteCount($user_ID);
											?>
										</span>
									</a>
								</li>
								<li class="tabs-title">
									<a href="#panel4v"><i class="fa fa-user"></i>
									<?php esc_html_e("Followers", 'betube') ?>
										<span class="float-right"><?php echo betubeFollowerCount($user_ID);?></span>
									</a>
								</li>								
							</ul>							
						</div><!--widgetContent -->
					</div><!--widgetBox -->
				</div><!--Large12 -->
			</div><!--row-->
		</aside><!--aside-->
	</div><!--Large4-->
	<!-- left sidebar -->
	<!-- right side content area -->
	<div id="foo" class="large-8 columns profile-inner">
		<div class="tabs-content vertical" data-tabs-content="vert-tabs">
			<div class="tabs-panel <?php if(empty($paged)){echo "is-active";}?>" id="panel1v">
				<section class="singlePostDescription">
					<div class="row secBg">
						<div class="large-12 columns">						
							<div class="heading">
								<i class="fa fa-user"></i>
								<h4><?php esc_html_e("About", 'betube') ?>&nbsp;<?php echo get_the_author_meta('display_name', $user_ID ); ?></h4>
							</div><!--Heading-->
							<div class="description">
								<p><?php echo  get_the_author_meta('description', $user_ID); ?></p>
								
								<div class="site profile-margin">
									<button><i class="fa fa-globe"></i><?php esc_html_e("Website", 'betube') ?></button>
									<a href="<?php the_author_meta('user_url', $user_ID); ?>" class="inner-btn"><?php the_author_meta('user_url', $user_ID); ?></a>
								</div><!--website-->
								
								<div class="email profile-margin">
									<button><i class="fa fa-envelope"></i><?php esc_html_e("Email", 'betube') ?></button>
									<span class="inner-btn"><?php the_author_meta('user_email', $user_ID); ?></span>
								</div><!--email-->
								
								<div class="phone profile-margin">
									<button><i class="fa fa-phone"></i><?php esc_html_e("Phone", 'betube') ?></button>
									<span class="inner-btn"><?php the_author_meta('phone', $user_ID); ?></span>
								</div><!--phone-->
								
								<div class="socialLinks profile-margin">
									<button><i class="fa fa-share-alt"></i><?php esc_html_e("Social", 'betube') ?></button>
									
									<?php 
										$userFB = $user_info->facebook;
										$userTW = $user_info->twitter;
										$userGoogle = $user_info->googleplus;
										$userPin = $user_info->pinterest;
										$userLin = $user_info->linkedin;
										$userYoutube = $user_info->youtube;
										$userVimeo = $user_info->vimeo;
										$userInstagram = $user_info->instagram;
									?>
									<?php if($userFB){?>
										<a href="<?php echo esc_url($userFB); ?>" class="inner-btn">
											<i class="fa fa-facebook"></i>
										</a>
									<?php } ?>	
									
									<?php if($userTW){?>
										<a href="<?php echo esc_url($userTW); ?>" class="inner-btn">
											<i class="fa fa-twitter"></i>
										</a>
									<?php } ?>
									
									<?php if($userGoogle){?>
										<a href="<?php echo esc_url($userGoogle); ?>" class="inner-btn">
											<i class="fa fa-google-plus"></i>
										</a>
									<?php } ?>
								
									<?php if($userPin){?>	
										<a href="<?php echo esc_url($user_info->pinterest); ?>" class="inner-btn">
											<i class="fa fa-pinterest-p"></i>
										</a>
									<?php } ?>
									
								
									<?php if($userLin){?>	
										<a href="<?php echo esc_url($user_info->linkedin); ?>" class="inner-btn">
											<i class="fa fa-linkedin"></i>
										</a>
									<?php } ?>
									
									<?php if($userYoutube){?>	
										<a href="<?php echo esc_url($user_info->youtube); ?>" class="inner-btn">
											<i class="fa fa-youtube"></i>
										</a>
									<?php } ?>
									<?php if($userVimeo){?>	
										<a href="<?php echo esc_url($user_info->vimeo); ?>" class="inner-btn">
											<i class="fa fa-vimeo"></i>
										</a>
									<?php } ?>
									<?php if($userInstagram){?>	
										<a href="<?php echo esc_url($user_info->instagram); ?>" class="inner-btn">
											<i class="fa fa-instagram"></i>
										</a>
									<?php } ?>
									
								</div><!--socialLinks-->
						
							</div><!--description-->
						</div><!--large-12 columns-->
					</div><!--row secBg-->
				</section><!--singlePostDescription-->
			</div><!--panel1v-->
			<!--Panel2v-->
			<div class="tabs-panel <?php if(isset($paged) && $paged > 0){echo "is-active";}?>" id="panel2v">
				<section class="profile-videos">
					<div class="row secBg">
						<div class="large-12 columns">
							<div class="heading">
								<i class="fa fa-video-camera"></i>
								<h4><?php echo get_the_author_meta('display_name', $user_ID ); ?>&nbsp; <?php esc_html_e("Videos", 'betube') ?></h4>
							</div><!--Heading-->
							<?php 
							global $paged, $wp_query, $wp;
							$args = wp_parse_args($wp->matched_query);
							if ( !empty ( $args['paged'] ) && 0 == $paged ) {
								$wp_query->set('paged', $args['paged']);
								$paged = $args['paged'];
							}							
							$temp = $wp_query;
							$wp_query= null;							
							$args = array(
								'post_type' => 'post',
								'posts_per_page' => 12,
								'paged' => $paged,								
								'author' => $user_ID,
							);
							$wp_query = new WP_Query($args);							
							$current = 1;
							?>
							<?php while ($wp_query->have_posts()) : $wp_query->the_post(); $current++;?>
							<div class="profile-video">
								<div class="media-object stack-for-small">
									<div class="media-object-section media-img-content">
										<div class="video-img">
											<?php 
											if ( has_post_thumbnail()) {
												global $redux_demo;
												$betube_img_opti = $redux_demo['betube_img_opti'];
												if($betube_img_opti == true){
													echo get_the_post_thumbnail($post->ID, 'betube-thumbnail');
												}else{
													echo get_the_post_thumbnail($post->ID, 'full');
												}
											}else{
											?>
											<img src="<?php echo get_template_directory_uri() . '/assets/images/nothumb.png' ?>" alt="No Thumb"/> 
											<?php } ?>
										</div>
									</div><!--Thumbnail media-object-->
									<div class="media-object-section media-video-content">
										<div class="video-content">
											<h5><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h5>
											<p><?php echo substr(get_the_excerpt(), 0,260); ?></p>
										</div><!--Video Content-->
										<div class="video-detail clearfix">
											<div class="video-stats">
												<span><i class="fa fa-check-square-o"></i><?php echo get_post_status( $post->ID ); ?></span>
												<?php $dateFormat = get_option( 'date_format' );?>
												<?php $post_id = $post->ID ?>
												<span><i class="fa fa-clock-o"></i><?php echo get_the_date($dateFormat, $post_id); ?></span>
												<span><i class="fa fa-eye"></i><?php echo betube_get_post_views($post->ID); ?></span>
											</div><!--Video Stats-->
										</div><!--Video Details-->
									</div><!--Content media-object-->
								</div><!--media-object-->
							</div><!--Profile-Video-->
							<?php endwhile; ?>
							<?php get_template_part('pagination'); ?>
							<?php wp_reset_postdata(); ?>
							<?php wp_reset_query(); ?>							
						</div><!--large12-->
					</div><!--row-->
				</section>
			</div>
			<!--Panel2v End-->
			<!--Panel3v Start-->
			<div class="tabs-panel" id="panel3v">
				<section class="profile-videos">
					<div class="row secBg">
						<div class="large-12 columns">
							<div class="heading">
								<i class="fa fa-video-camera"></i>
								<h4><?php echo get_the_author_meta('display_name', $user_ID ); ?> <?php esc_html_e("Favorite Videos", 'betube') ?></h4>
							</div>
							<?php 
								global $paged, $wp_query, $wp;
								$args = wp_parse_args($wp->matched_query);
								if ( !empty ( $args['paged'] ) && 0 == $paged ) {
									$wp_query->set('paged', $args['paged']);
									$paged = $args['paged'];
								}
								$cat_id = get_cat_ID(single_cat_title('', false));
								$temp = $wp_query;
								$wp_query= null;
								$wp_query = new WP_Query();								
								$myarray = betube_authors_all_favorite($user_ID);
								if(!empty($myarray)){
									$args = array(
										'post_type' => 'post',
										'post__in'      => $myarray
									);
									// The Query
									$wp_query = new WP_Query( $args );
									$current = -1;
									$current2 = 0;							
							?>
							<?php while ($wp_query->have_posts()) : $wp_query->the_post(); $current++; $current2++; ?>
							<!--loopcontent-->
							<div class="profile-video">
								<div class="media-object stack-for-small">
									<div class="media-object-section media-img-content">
										<div class="video-img">
											<?php 
											if ( has_post_thumbnail()) {
												global $redux_demo;
												$betube_img_opti = $redux_demo['betube_img_opti'];
												if($betube_img_opti == true){
													echo get_the_post_thumbnail($post->ID, 'betube-thumbnail');
												}else{
													echo get_the_post_thumbnail($post->ID, 'full');
												}
											}else{
											?>
											<img src="<?php echo get_template_directory_uri() . '/assets/images/nothumb.png' ?>" alt="No Thumb"/> 
											<?php } ?>
										</div>
									</div>
									<div class="media-object-section media-video-content">
										<div class="video-content">
											<h5><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h5>
											<p><?php echo substr(get_the_excerpt(), 0,260); ?></p>
										</div>
										<div class="video-detail clearfix">
											<div class="video-stats">
												<span><i class="fa fa-check-square-o"></i><?php echo get_post_status( $post->ID ); ?></span>
												<?php $dateFormat = get_option( 'date_format' );?>
												<span><i class="fa fa-clock-o"></i><?php echo get_the_date($dateFormat, $post_id); ?></span>
												<span><i class="fa fa-eye"></i><?php echo betube_get_post_views($post->ID); ?></span>
											</div>											
										</div>
									</div>
								</div>
							</div>
							<!--loopcontent-->
							<?php endwhile; ?>
							<?php wp_reset_query(); ?>
								<?php }else{ ?>
								<p><?php echo get_the_author_meta('display_name', $user_ID ); ?> <?php esc_html_e("have not any favourite Video yet!", 'betube') ?></p>
								<?php } ?>								
						</div><!--large-12-->
					</div><!--row-->
				</section>
			</div>
			<!--Panel3v End-->
			<!--Panel4v Start-->
			<div class="tabs-panel" id="panel4v">
				<section class="content content-with-sidebar followers margin-bottom-10">
					<div class="row secBg">
						<div class="large-12 columns">
							<div class="row column head-text clearfix">
								<h4 class="pull-left"><i class="fa fa-users"></i><?php esc_html_e("Followers", 'betube') ?></h4>
							</div>
							<div class="row collapse">
							<?php echo betubeAllFollowers($user_ID);?>
							</div><!--row-->
							<!--Start Following-->
							<div class="row column head-text clearfix">
								<h4 class="pull-left"><i class="fa fa-users"></i><?php esc_html_e("Following", 'betube') ?></h4>
							</div><!--End Row-->
							<div class="row collapse">
								<?php echo betubeAllFollowing($user_ID); ?>
							</div><!--End collapse-->
							<!--End Following-->
						</div><!--large-12-->
					</div><!--row-->
				</section>
			</div><!--Panel4v End-->			
	<!-- right side content area -->
		</div><!--tabs-content-->
	</div><!--IF FOO-->
</div><!--End Row-->
<?php get_footer(); ?>