<?php
/**
 * Template name: Profile Page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage betube
 * @since betube
 */

if ( !is_user_logged_in() ) {
	$login = betube_get_template_url('template-login.php');
	wp_redirect( $login ); exit;
}
global $redux_demo; 
$pagepermalink = get_permalink($post->ID);
$edit = betube_get_template_url('template-edit-post.php');

if(isset($_GET['delete_id'])){
	$deleteUrl = $_GET['delete_id'];
	wp_delete_post($deleteUrl);
}
global $current_user, $user_id;
wp_get_current_user();
$user_info = get_userdata($user_ID);
$user_id = $current_user->ID; // You can set $user_id to any users, but this gets the current users ID.

get_header();
betube_breadcrumbs();
?>
<?php 
global $redux_demo; 
$profile = betube_get_template_url('template-profile.php');
$allFavourite = betube_get_template_url('template-favorite.php');
$newPostAds = betube_get_template_url('template-submit-video.php');
?>
<?php 
	$page = get_page($post->ID);
	$current_page_id = $page->ID;
	$betubeProfileIMG = get_user_meta($user_ID, "betube_author_profile_bg", true);
	if(!empty($betubeProfileIMG)){
		$betubeProfileIMG = betube_get_image_url($betubeProfileIMG);
	}
	$betube_gdpr = get_the_author_meta('betube_gdpr', $user_ID);
?>
<section class="topProfile" style="background: url('<?php echo esc_url($betubeProfileIMG); ?>') no-repeat;">
	<div class="main-text text-center">
		<div class="row">
			<div class="large-12 columns">
				<?php 
				$betubeFirstTXT = get_the_author_meta('firsttext', $user_id);
				$betubesecondTXT = get_the_author_meta('secondtext', $user_id);
				if(!empty($betubeFirstTXT)){	
				?>
				<h3><?php echo esc_html($betubeFirstTXT); ?></h3>
				<?php } ?>
				<?php if(!empty($betubesecondTXT)){?>
				<h1><?php echo esc_html($betubesecondTXT); ?></h1>
				<?php } ?>
			</div><!--large-12-->
		</div><!--row-->
	</div><!--main-text-->
	<div class="profile-stats">
		<div class="row secBg">
			<div class="large-12 columns">
				<?php
				$authorAvatarURL = get_user_meta($user_ID, "betube_author_avatar_url", true);
				$authorAvatarURL = betube_get_image_url($authorAvatarURL);
				if(!empty($authorAvatarURL)) {					
					?>
					<div class="profile-author-img">
						<img src="<?php echo esc_url($authorAvatarURL); ?>" alt="author">						
					</div>
					<?php
				}else{
					$authorID = get_the_author_meta('user_email', $user_ID);
					$avatar_url = betube_get_avatar_url($authorID, $size = '150' );
					?>
					<div class="profile-author-img">
						<img src="<?php echo esc_url($avatar_url); ?>" alt="profile author img">
					</div><!--profile-author-img-->
					<?php
				}
				?>
				<div class="profile-subscribe">
					<span><i class="fa fa-users"></i><?php echo betubeFollowerCount($user_id);?></span>
					<?php 
					if ( is_user_logged_in() ) { 
						global $current_user;
						wp_get_current_user();
						$user_id = $current_user->ID;
						if(isset($user_id)){
							if($user_ID != $user_id){							
							echo betube_authors_follower_check($user_ID, $user_id);
							}
						}
					}								
					?>
				</div><!--profile-subscribe-->
				<div class="profile-share">
					<div class="easy-share" data-easyshare data-easyshare-http data-easyshare-url="<?php echo esc_url( home_url( '/' ) ); ?>">
						<!-- Facebook -->
						<button data-easyshare-button="facebook">
							<span class="fa fa-facebook"></span>
							<span><?php esc_html_e("Share", 'betube') ?></span>
						</button>
						<span data-easyshare-button-count="facebook">0</span>

						<!-- Twitter -->
						<button data-easyshare-button="twitter" data-easyshare-tweet-text="">
							<span class="fa fa-twitter"></span>
							<span><?php esc_html_e("Tweet", 'betube') ?></span>
						</button>
						<span data-easyshare-button-count="twitter">0</span>

						<!-- Google+ -->
						<button data-easyshare-button="google">
							<span class="fa fa-google-plus"></span>
							<span>+1</span>
						</button>
						<span data-easyshare-button-count="google">0</span>

						<div data-easyshare-loader><?php esc_html_e("Loading", 'betube') ?>...</div>
					</div>
				</div><!--profile-share-->
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
										global $current_user;
										wp_get_current_user();
										$user_id = $current_user->ID;
										echo betubeFavoriteCount($user_id);
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
									<p class="number-text"><?php echo betubeFollowerCount($user_id);?></p>
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
									'user_id' => get_current_user_id(), // use user_id
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
							<h5><?php esc_html_e("Profile OVERVIEW", 'betube') ?></h5>
						</div>
						<div class="widgetContent">
						<?php 
						global $redux_demo;
						$betubeProfile = betube_get_template_url('template-profile.php');						
						$betubeVideoSingleUser = betube_get_template_url('template-user-all-video.php');
						$betubeFavourite = betube_get_template_url('template-favorite.php');
						$beTubeAddPost =  betube_get_template_url('template-submit-video.php');
						$beTubefollowers = betube_get_template_url('template-followers.php');
						$beTubeallFollowers = betube_get_template_url('template-followers.php');
						$beTubeEditProfile = betube_get_template_url('template-edit-profile.php');
						?>
							<ul class="profile-overview">
								<li class="clearfix">
									<a class="active" href="<?php echo esc_url($betubeProfile); ?>">
										<i class="fa fa-user"></i><?php esc_html_e("About Me", 'betube') ?>
									</a>
								</li><!--AboutMe-->
								<li class="clearfix">
									<a href="<?php echo esc_url($betubeVideoSingleUser); ?>">
										<i class="fa fa-video-camera"></i><?php esc_html_e("Videos", 'betube') ?> 
										<span class="float-right"><?php echo count_user_posts($user_ID);?></span>
									</a>
								</li><!--Videos-->
								<li class="clearfix">
									<a href="<?php echo esc_url($betubeFavourite); ?>">
										<i class="fa fa-heart"></i><?php esc_html_e("Favorite Videos", 'betube') ?>
										<span class="float-right">
											<?php 
												global $current_user;
												wp_get_current_user();
												$user_id = $current_user->ID;
												echo betubeFavoriteCount($user_id);
												?>
										</span>
									</a>
								</li><!--Favorite Videos-->
								<li class="clearfix">
									<a href="<?php echo esc_url($beTubeallFollowers); ?>">
										<i class="fa fa-users"></i><?php esc_html_e("Followers", 'betube') ?>
										<span class="float-right">
										<?php echo betubeFollowerCount($user_id);?>
										</span>
									</a>
								</li><!--Followers-->
								<li class="clearfix">
								<?php 									
								$args = array(
									'user_id' => get_current_user_id(), // use user_id
									'count' => true, //return only the count
									'status' => 'approve'
								);
								$betubeUsercomments = get_comments($args);
								?>
									<a href="#">
										<i class="fa fa-comments-o"></i><?php esc_html_e("comments", 'betube') ?>
										<span class="float-right">
											<?php echo esc_attr($betubeUsercomments); ?>
										</span>
									</a>
								</li><!--comments-->
								<li class="clearfix">
									<a href="<?php echo esc_url($beTubeEditProfile); ?>">
										<i class="fa fa-gears"></i><?php esc_html_e("Profile Settings", 'betube') ?>
									</a>
								</li><!--Profile Settings-->
								<li class="clearfix">
									<a href="<?php echo wp_logout_url(get_option('siteurl')); ?>">
										<i class="fa fa-sign-out"></i><?php esc_html_e("Logout", 'betube') ?>
									</a>
								</li><!--Logout-->
								<?php if(!empty($beTubeAddPost)){?>
								<a href="<?php echo esc_url($beTubeAddPost); ?>" class="button">
									<i class="fa fa-plus-circle"></i><?php esc_html_e("Submit Video", 'betube') ?>
								</a><!--Submit Video-->
								<?php } ?>
							</ul><!--UL-->
						</div><!--widgetContent -->
					</div><!--widgetBox -->
				</div><!--Large12 -->
			</div><!--row-->
		</aside><!--aside-->
	</div><!--Large4-->
	<!-- left sidebar -->
	<!-- right side content area -->
	<div class="large-8 columns profile-inner">
		<!-- single post description -->
		<section class="singlePostDescription">
			<div class="row secBg">
				<div class="large-12 columns">
					<div class="heading">
						<i class="fa fa-user"></i>
						<h4><?php esc_html_e("About", 'betube') ?>&nbsp;<?php echo esc_html($user_identity); ?></h4>
					</div>
					<div class="description">
						<p>
							<?php 
							$user_id = $current_user->ID; 
							echo get_the_author_meta('description', $user_id); 
							?>
						</p>
						<?php 
						$authorWeb = get_the_author_meta('user_url', $user_id);
						$authorEmail = get_the_author_meta('user_email', $user_id);
						$authorPhone = get_the_author_meta('phone', $user_id);
						if(!empty($authorWeb)){
						?>	
						<div class="site profile-margin">
							<button><i class="fa fa-globe"></i><?php esc_html_e("Website", 'betube') ?></button>
							<a href="<?php the_author_meta('user_url', $user_id); ?>" class="inner-btn"><?php the_author_meta('user_url', $user_id); ?></a>
						</div><!--website-->
						<?php } ?>
						<?php if(!empty($authorEmail)){?>
						<div class="email profile-margin">
							<button><i class="fa fa-envelope"></i><?php esc_html_e("Email", 'betube') ?></button>
							<span class="inner-btn"><?php the_author_meta('user_email', $user_id); ?></span>
						</div><!--email-->
						<?php } ?>
						<?php if(!empty($authorPhone)){?>
						<div class="phone profile-margin">
							<button><i class="fa fa-phone"></i><?php esc_html_e("Phone", 'betube') ?></button>
							<span class="inner-btn"><?php the_author_meta('phone', $user_id); ?></span>
						</div><!--phone-->
						<?php } ?>
						<div class="socialLinks profile-margin">
							<button>
								<i class="fa fa-share-alt"></i>
								<?php esc_html_e("Social", 'betube') ?>
							</button>
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
					</div><!--Description-->
				</div><!--large12-->
			</div><!--row-->
		</section><!-- End single post description -->
	</div><!-- end left side content area -->
	<!-- right side content area -->
</div><!--End Row-->
<?php get_footer(); ?>