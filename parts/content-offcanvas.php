<?php 
	global $redux_demo;
	$darkClass = "";
	$myheaderID = "";
	$beTubeHeaderStyle = $redux_demo['betube-header-style'];
	if($beTubeHeaderStyle == "v3" || $beTubeHeaderStyle == "v4" || $beTubeHeaderStyle == "v5" || $beTubeHeaderStyle == "v6" || $beTubeHeaderStyle == "v7" || $beTubeHeaderStyle == "v8"){
		$myheaderID="offCanvas";
	}elseif($beTubeHeaderStyle == "v1" || $beTubeHeaderStyle == "v2"){
		$myheaderID="offCanvas-responsive";
	}
	if($beTubeHeaderStyle == "v4" || $beTubeHeaderStyle == "v5" || $beTubeHeaderStyle == "v6" || $beTubeHeaderStyle == "v7"){
		$darkClass = "dark-off-menu";
	}
	$betubeFBLink = $redux_demo['facebook-link'];
	$betubeTwitterLink = $redux_demo['twitter-link'];
	$betubeDribbbleLink = $redux_demo['dribbble-link'];
	$betubeFlickerLink = $redux_demo['flickr-link'];
	$betubeGithubLink = $redux_demo['github-link'];
	$betubePinLink = $redux_demo['pinterest-link'];
	$betubeYoutubeLink = $redux_demo['youtube-link'];
	$betubeGoogleLink = $redux_demo['google-plus-link'];
	$betubeLinkedinLink = $redux_demo['linkedin-link'];
	$betubeInstaLink = $redux_demo['instagram-link'];
	$betubeVimeoLink = $redux_demo['vimeo-link'];
	
	$betubeTumbleLink = $redux_demo['betube_tumblr'];
	$betubeVKLink = $redux_demo['betube_vk'];
	$betubeSoundCloudLink = $redux_demo['betube_soundcloud'];
	$betubeBehanceLink = $redux_demo['betube_behance'];
	$betubeDiggLink = $redux_demo['betube_digg'];
	$betubeLastfmLink = $redux_demo['betube_lastfm'];
	$betubeOdnoLink = $redux_demo['betube_odnoklassniki'];
	$betubeVineLink = $redux_demo['betube_vine'];
	$betubeYelpLink = $redux_demo['betube_yelp'];
	
	$beTubeUploadVideo = betube_get_template_url('template-submit-video.php');
	$beTubeRegister = betube_get_template_url('template-register.php');
	$beTubeProfile = betube_get_template_url('template-profile.php');
	if(is_rtl()){
		$betubeMenuRTL = "position-right";
	}else{
		$betubeMenuRTL = "position-left";
	}
?>
<div class="off-canvas <?php echo esc_attr($betubeMenuRTL); ?> light-off-menu <?php echo esc_attr($darkClass); ?>" id="<?php echo esc_attr($myheaderID); ?>" data-off-canvas>
	<div class="off-menu-close">
        <h3><?php esc_html_e("Menu", 'betube') ?></h3>
        <span data-toggle="<?php echo esc_attr($myheaderID); ?>"><i class="fa fa-times"></i></span>
    </div><!--off-menu-close-->	
	<?php betube_off_canvas_nav(); ?>
	<div class="responsive-search">
		<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<div class="input-group">
				<input class="input-group-field search-field" type="search" placeholder="<?php echo esc_attr_x( 'Search...', '', 'betube' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', '', 'betube' ) ?>">
				<div class="input-group-button">
					<button type="submit" name="search" value="<?php echo esc_attr_x( 'Search', '', 'betube' ) ?>"><i class="fa fa-search"></i></button>
				</div>
			</div>
		</form>		
	</div><!--responsive-search-->	
	<div class="off-social">
		<h6><?php esc_html_e("Get Socialize", 'betube') ?></h6>
		<?php if(!empty($betubeFBLink)){?>
		<a href="<?php echo esc_url($betubeFBLink); ?>" target="_blank">
			<i class="fa fa-facebook"></i>
		</a>
		<?php }?>
		
		<?php if(!empty($betubeTwitterLink)){?>
		<a href="<?php echo esc_url($betubeTwitterLink); ?>" target="_blank">
			<i class="fa fa-twitter"></i>
		</a>
		<?php }?>
		
		<?php if(!empty($betubeDribbbleLink)){?>
		<a href="<?php echo esc_url($betubeDribbbleLink); ?>" target="_blank">
			<i class="fa fa-dribbble"></i>
		</a>
		<?php }?>
		
		<?php if(!empty($betubeFlickerLink)){?>
		<a href="<?php echo esc_url($betubeFlickerLink); ?>" target="_blank">
			<i class="fa fa-flickr"></i>
		</a>
		<?php }?>
		
		<?php if(!empty($betubeGithubLink)){?>
		<a href="<?php echo esc_url($betubeGithubLink); ?>" target="_blank">
			<i class="fa fa-github"></i>
		</a>
		<?php }?>
		
		<?php if(!empty($betubePinLink)){?>
		<a href="<?php echo esc_url($betubePinLink); ?>" target="_blank">
			<i class="fa fa-pinterest-p"></i>
		</a>
		<?php }?>
		
		<?php if(!empty($betubeYoutubeLink)){?>
		<a href="<?php echo esc_url($betubeYoutubeLink); ?>" target="_blank">
			<i class="fa fa-youtube"></i>
		</a>
		<?php }?>
		
		<?php if(!empty($betubeGoogleLink)){?>
		<a href="<?php echo esc_url($betubeGoogleLink); ?>" target="_blank">
			<i class="fa fa-google-plus"></i>
		</a>
		<?php }?>
		
		<?php if(!empty($betubeLinkedinLink)){?>
		<a href="<?php echo esc_url($betubeLinkedinLink); ?>" target="_blank">
			<i class="fa fa-linkedin"></i>
		</a>
		<?php }?>
		
		<?php if(!empty($betubeInstaLink)){?>
		<a href="<?php echo esc_url($betubeInstaLink); ?>" target="_blank">
			<i class="fa fa-instagram"></i>
		</a>
		<?php }?>
		
		<?php if(!empty($betubeVimeoLink)){?>
		<a href="<?php echo esc_url($betubeVimeoLink); ?>" target="_blank">
			<i class="fa fa-vimeo"></i>
		</a>
		<?php }?>
		
		<?php if(!empty($betubeTumbleLink)){?>
		<a href="<?php echo esc_url($betubeTumbleLink); ?>" target="_blank">
			<i class="fa fa-tumblr"></i>
		</a>
		<?php }?>
		<?php if(!empty($betubeVKLink)){?>
		<a href="<?php echo esc_url($betubeVKLink); ?>" target="_blank">
			<i class="fa fa-vk"></i>
		</a>
		<?php }?>
		<?php if(!empty($betubeSoundCloudLink)){?>
		<a href="<?php echo esc_url($betubeSoundCloudLink); ?>" target="_blank">
			<i class="fa fa-soundcloud"></i>
		</a>
		<?php }?>
		<?php if(!empty($betubeBehanceLink)){?>
		<a href="<?php echo esc_url($betubeBehanceLink); ?>" target="_blank">
			<i class="fa fa-behance"></i>
		</a>
		<?php }?>
		<?php if(!empty($betubeDiggLink)){?>
		<a href="<?php echo esc_url($betubeDiggLink); ?>" target="_blank">
			<i class="fa fa-digg"></i>
		</a>
		<?php }?>
		<?php if(!empty($betubeLastfmLink)){?>
		<a href="<?php echo esc_url($betubeLastfmLink); ?>" target="_blank">
			<i class="fa fa-lastfm"></i>
		</a>
		<?php }?>
		<?php if(!empty($betubeOdnoLink)){?>
		<a href="<?php echo esc_url($betubeOdnoLink); ?>" target="_blank">
			<i class="fa fa-odnoklassniki"></i>
		</a>
		<?php }?>
		<?php if(!empty($betubeVineLink)){?>
		<a href="<?php echo esc_url($betubeVineLink); ?>" target="_blank">
			<i class="fa fa-vine"></i>
		</a>
		<?php }?>
		<?php if(!empty($betubeYelpLink)){?>
		<a href="<?php echo esc_url($betubeYelpLink); ?>" target="_blank">
			<i class="fa fa-yelp"></i>
		</a>
		<?php }?>
		
	</div><!--Get Socialize-->
	<!--Only for Header V3-->
	<?php if($beTubeHeaderStyle == "v3" || $beTubeHeaderStyle == "v4" || $beTubeHeaderStyle == "v6" || $beTubeHeaderStyle == "v7" || $beTubeHeaderStyle == "v8"){?>	
	<div class="top-button">
		<ul class="menu">
			<li>
				<a href="<?php echo esc_url($beTubeUploadVideo); ?>">
					<?php esc_html_e( 'Upload Video', 'betube' ); ?>
				</a>
			</li>
			<li class="dropdown-login">
				<?php if(!is_user_logged_in()){ ?>
				<a href="<?php echo esc_url($beTubeRegister); ?>">
					<?php esc_html_e( 'login/Register', 'betube' ); ?>
				</a>
				<?php }else{ ?>
				<a href="<?php echo esc_url($beTubeProfile); ?>">
					<?php esc_html_e( 'Account', 'betube' ); ?>
				</a>
				<?php }?>
			</li>
		</ul>
	</div>
	<?php }?>
	<!--Only for Header V3-->
</div>
<!--Only for Header V3 and V4-->
<?php if($beTubeHeaderStyle == "v3" || $beTubeHeaderStyle == "v4"){?>
	<div class="light-off-menu my-panel show-for-large <?php echo esc_attr($darkClass); ?>" id="my-panel" data-toggler=".is-active">
		<div class="off-menu-close">
			<h3><?php esc_html_e("Menu", 'betube') ?></h3>
			<span data-toggle="my-panel"><i class="fa fa-times"></i></span>
		</div><!--off-menu-close-->
		<?php betube_off_canvas_nav(); ?>
		<div class="responsive-search">
			<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<div class="input-group">
					<input class="input-group-field search-field" type="search" placeholder="<?php echo esc_attr_x( 'Search...', '', 'betube' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', '', 'betube' ) ?>">
					<div class="input-group-button">
						<button type="submit" name="search" value="<?php echo esc_attr_x( 'Search', '', 'betube' ) ?>"><i class="fa fa-search"></i></button>
					</div>
				</div>
			</form>		
		</div><!--responsive-search-->
		<div class="off-social">
			<h6><?php esc_html_e("Get Socialize", 'betube') ?></h6>
			<?php if(!empty($betubeFBLink)){?>
			<a href="<?php echo esc_url($betubeFBLink); ?>" target="_blank">
				<i class="fa fa-facebook"></i>
			</a>
			<?php }?>
			
			<?php if(!empty($betubeTwitterLink)){?>
			<a href="<?php echo esc_url($betubeTwitterLink); ?>" target="_blank">
				<i class="fa fa-twitter"></i>
			</a>
			<?php }?>
			
			<?php if(!empty($betubeDribbbleLink)){?>
			<a href="<?php echo esc_url($betubeDribbbleLink); ?>" target="_blank">
				<i class="fa fa-dribbble"></i>
			</a>
			<?php }?>
			
			<?php if(!empty($betubeFlickerLink)){?>
			<a href="<?php echo esc_url($betubeFlickerLink); ?>" target="_blank">
				<i class="fa fa-flickr"></i>
			</a>
			<?php }?>
			
			<?php if(!empty($betubeGithubLink)){?>
			<a href="<?php echo esc_url($betubeGithubLink); ?>" target="_blank">
				<i class="fa fa-github"></i>
			</a>
			<?php }?>
			
			<?php if(!empty($betubePinLink)){?>
			<a href="<?php echo esc_url($betubePinLink); ?>" target="_blank">
				<i class="fa fa-pinterest-p"></i>
			</a>
			<?php }?>
			
			<?php if(!empty($betubeYoutubeLink)){?>
			<a href="<?php echo esc_url($betubeYoutubeLink); ?>" target="_blank">
				<i class="fa fa-youtube"></i>
			</a>
			<?php }?>
			
			<?php if(!empty($betubeGoogleLink)){?>
			<a href="<?php echo esc_url($betubeGoogleLink); ?>" target="_blank">
				<i class="fa fa-google-plus"></i>
			</a>
			<?php }?>
			
			<?php if(!empty($betubeLinkedinLink)){?>
			<a href="<?php echo esc_url($betubeLinkedinLink); ?>" target="_blank">
				<i class="fa fa-linkedin"></i>
			</a>
			<?php }?>
			
			<?php if(!empty($betubeInstaLink)){?>
			<a href="<?php echo esc_url($betubeInstaLink); ?>" target="_blank">
				<i class="fa fa-instagram"></i>
			</a>
			<?php }?>
			
			<?php if(!empty($betubeVimeoLink)){?>
			<a href="<?php echo esc_url($betubeVimeoLink); ?>" target="_blank">
				<i class="fa fa-vimeo"></i>
			</a>
			<?php }?>

			<?php if(!empty($betubeTumbleLink)){?>
			<a href="<?php echo esc_url($betubeTumbleLink); ?>" target="_blank">
				<i class="fa fa-tumblr"></i>
			</a>
			<?php }?>
			<?php if(!empty($betubeVKLink)){?>
			<a href="<?php echo esc_url($betubeVKLink); ?>" target="_blank">
				<i class="fa fa-vk"></i>
			</a>
			<?php }?>
			<?php if(!empty($betubeSoundCloudLink)){?>
			<a href="<?php echo esc_url($betubeSoundCloudLink); ?>" target="_blank">
				<i class="fa fa-soundcloud"></i>
			</a>
			<?php }?>
			<?php if(!empty($betubeBehanceLink)){?>
			<a href="<?php echo esc_url($betubeBehanceLink); ?>" target="_blank">
				<i class="fa fa-behance"></i>
			</a>
			<?php }?>
			<?php if(!empty($betubeDiggLink)){?>
			<a href="<?php echo esc_url($betubeDiggLink); ?>" target="_blank">
				<i class="fa fa-digg"></i>
			</a>
			<?php }?>
			<?php if(!empty($betubeLastfmLink)){?>
			<a href="<?php echo esc_url($betubeLastfmLink); ?>" target="_blank">
				<i class="fa fa-lastfm"></i>
			</a>
			<?php }?>
			<?php if(!empty($betubeOdnoLink)){?>
			<a href="<?php echo esc_url($betubeOdnoLink); ?>" target="_blank">
				<i class="fa fa-odnoklassniki"></i>
			</a>
			<?php }?>
			<?php if(!empty($betubeVineLink)){?>
			<a href="<?php echo esc_url($betubeVineLink); ?>" target="_blank">
				<i class="fa fa-vine"></i>
			</a>
			<?php }?>
			<?php if(!empty($betubeYelpLink)){?>
			<a href="<?php echo esc_url($betubeYelpLink); ?>" target="_blank">
				<i class="fa fa-yelp"></i>
			</a>
			<?php }?>
			
		</div><!--Get Socialize-->
		<div class="top-button">
			<ul class="menu">
				<li>
					<a href="<?php echo esc_url($beTubeUploadVideo); ?>">
						<?php esc_html_e( 'Upload Video', 'betube' ); ?>
					</a>
				</li>
				<li class="dropdown-login">
					<?php if(!is_user_logged_in()){ ?>
					<a href="<?php echo esc_url($beTubeRegister); ?>">
						<?php esc_html_e( 'login/Register', 'betube' ); ?>
					</a>
					<?php }else{ ?>
					<a href="<?php echo esc_url($beTubeProfile); ?>">
						<?php esc_html_e( 'Account', 'betube' ); ?>
					</a>
					<?php }?>
				</li>
			</ul>
		</div>
	</div>
	
<?php }?>