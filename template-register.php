<?php
/**
 * Template name: Register Page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage betube
 * @since betube
 */

if ( is_user_logged_in() ) {
	$profile = betube_get_template_url('template-profile.php');
	wp_redirect( $profile ); exit;
}
global $user_ID, $user_identity, $user_level, $registerSuccess, $betube_gdpr;

$registerSuccess = true;


if (!$user_ID) {
	//print_r($_POST); exit();
	if($_POST){
		$registerSuccess = false;
		$remember = esc_sql($_POST['remember']);
		if(!empty($remember)){
			
			$message = esc_html__( 'Registration successful.', 'betube' );
			$username = esc_sql($_POST['username']);
			$email = esc_sql($_POST['email']);
			$password = esc_sql($_POST['pwd']);
			$confirm_password = esc_sql($_POST['confirm']);
			$registerSuccess = true;
			if(isset($_POST['gdpr'])){
				$betube_gdpr = true;
			}else{
				$betube_gdpr = false;
			}
			if(empty($username)) {
				$message = esc_html__( 'User name should not be empty.', 'betube' );
				$registerSuccess = false;
			}
			if(isset($email)) {

				if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email)){ 

					wp_update_user( array ('ID' => $user_ID, 'user_email' => $email) ) ;

				}

				else { $message = esc_html__( 'Please enter a Valid Email', 'betube' ); }

				$registerSuccess = false;

			}
			if($password) {

				if (strlen($password) < 5 || strlen($password) > 15) {

					$message = esc_html__( 'Password must be 5 to 15 characters in length.', 'betube' );

					$registerSuccess = false;

					}

				//elseif( $password == $confirm_password ) {

				elseif(isset($password) && $password != $confirm_password) {

					$message = esc_html__( 'Password Mismatch', 'betube' );

					$registerSuccess = false;

				}elseif ( isset($password) && !empty($password) ) {

					$update = wp_set_password( $password, $user_ID );

					$message = esc_html__( 'Registration successful.', 'betube' );

					$registerSuccess = true;

				}

			}

			$status = wp_create_user( $username, $password, $email );
			if ( is_wp_error($status) ) {
				$registerSuccess = false;
				$message =  esc_html__( 'Username or E-mail already exists. Please try another one.', 'betube' );
			}else{
				if($betube_gdpr == true){
					update_user_meta($status, 'betube_gdpr', 'yes');
				}else{
					update_user_meta($status, 'betube_gdpr', 'no');
				}
				beTubeUserNotification( $email, $password, $username );			
				global $redux_demo; 
				$newUsernotification = $redux_demo['newusernotification'];	
					if($newUsernotification == 1){
					beTubeNewUserNotifiy($email, $username);	
					}

				$registerSuccess = true;
			}


			if($registerSuccess == true) {
				$login_data = array();
				$login_data['user_login'] = $username;
				$login_data['user_password'] = $password;
				$user_verify = wp_signon( $login_data, false ); 

				global $redux_demo; 
				$profile = betube_get_template_url('template-profile.php');
				wp_redirect( $profile ); exit;

			}	
		}else{
			$message = esc_html__( 'You must need to agreed to terms and condition.', 'betube' );
			$registerSuccess = false;
		}
	}
}

get_header(); 
betube_breadcrumbs();
?>
<?php 
	$page = get_page($post->ID);
	$current_page_id = $page->ID;
	global $redux_demo;
	$login = betube_get_template_url('template-login.php');
	$betubeTerms = $redux_demo['termsandcondition'];
	$betubeLawURL = $redux_demo['lawdataurl'];
?>
<section class="registration">
	<div class="row secBg">
		<div class="large-12 columns">
		<?php $betubeCanReg = get_option('users_can_register'); ?>
		<?php if($betubeCanReg == '0'){?>
		<span class='registration-closed'><?php esc_html_e('Registration is currently disabled. Please try again later.', 'betube') ?></span>
		<?php }else{?>			
		
			<div class="login-register-content">
				<div class="row collapse borderBottom">
					<div class="medium-6 large-centered medium-centered">
						<div class="page-heading text-center">
							<h3><?php esc_html_e('User Registration', 'betube') ?></h3>
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<?php the_content(); ?>
							<?php endwhile; endif; ?>
						</div><!--page-heading-->
					</div><!--medium-6-->
				</div><!--row collapse-->
				<div class="row" data-equalizer data-equalize-on="medium" id="test-eq">
					<div class="large-4 large-offset-1 medium-6 columns">
						<div class="social-login" data-equalizer-watch>
							<h5 class="text-center"><?php esc_html_e('Login via Social Profile', 'betube') ?></h5>
							
							<?php
							/* Detect plugin. For use on Front End only.*/
							if( class_exists( 'NextendSocialLogin' ) ) {
							?>
							<div class="social-login-btn facebook">								
								<a class="loginSocialbtn fb" href="<?php echo get_site_url(); ?>/wp-login.php?loginFacebook=1" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginFacebook=1&redirect='+window.location.href; return false;"><i class="fa fa-facebook"></i><?php esc_html_e('Login via Facebook', 'betube') ?></a>
							</div>
							<?php } ?>
							
							<?php
							if( class_exists( 'NextendTwitterSettings' ) ) {
							?>
							<div class="social-login-btn twitter">
								<a class="loginSocialbtn twitter" href="<?php echo get_site_url(); ?>/wp-login.php?loginTwitter=1" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginTwitter=1&redirect='+window.location.href; return false;"><i class="fa fa-twitter"></i><?php esc_html_e('Login via Twitter', 'betube') ?></a>
							</div>
							<?php } ?>
							
							<?php
							if( class_exists( 'NextendGoogleSettings' ) ) {
							?>
							<div class="social-login-btn g-plus">
								<a class="loginSocialbtn google" href="<?php echo get_site_url(); ?>/wp-login.php?loginGoogle=1" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginGoogle=1&redirect='+window.location.href; return false;"><i class="fa fa-google-plus"></i><?php esc_html_e('Login via Google', 'betube') ?></a>
							</div>
							<?php } ?>
							<!--AccessPress Socil Login-->
							<?php
							if( class_exists( 'APSL_Lite_Class' ) ) {
								?>
								<div class="betubeAPSL">
								<?php echo do_shortcode('[apsl-login-lite]'); ?>
								</div>
								<?php
							}	
							if ( class_exists( 'APSP_Class' ) ) {
								?>
								<div class="betubeAPSL">
								<?php echo do_shortcode('[apsl-login]'); ?>
								</div>
								<?php
							}
							?>
							<!--AccessPress Socil Login-->
						</div><!--social-login-->
					</div><!--large-4-->
					<div class="large-2 medium-2 columns show-for-large">
						<div class="middle-text text-center hide-for-small-only" data-equalizer-watch>
							<p>
								<i class="fa fa-arrow-left arrow-left"></i>
								<span><?php esc_html_e('OR', 'betube') ?></span>
								<i class="fa fa-arrow-right arrow-right"></i>
							</p>
						</div><!--middle-text-->
					</div><!--large-2-->
					<div class="large-4 medium-6 columns end">
						<div class="register-form">
							<h5 class="text-center"><?php esc_html_e('Create your Account', 'betube') ?></h5>
							<form id="myform" method="POST" enctype="multipart/form-data" data-abide novalidate>
								<div data-abide-error class="alert callout" style="display: none;">
									<p><i class="fa fa-exclamation-triangle"></i> <?php esc_html_e('There are some errors in your form.', 'betube') ?></p>
								</div>
								<?php if(isset($registerSuccess) && $registerSuccess == false){?>
									
									<div class="alert callout">
										<p> <?php echo esc_html($message); ?></p>
									</div>
									
								<?php }?>
								<div class="input-group">
									<span class="input-group-label"><i class="fa fa-user"></i></span>
									<input class="input-group-field" type="text" id="contactName" name="username" maxlength="30" placeholder="<?php esc_html_e('Enter your username', 'betube') ?>" required>
								</div>

								<div class="input-group">
									<span class="input-group-label"><i class="fa fa-envelope"></i></span>
									<input class="input-group-field" type="email" id="email" name="email" placeholder="<?php esc_html_e('Enter your email', 'betube') ?>" required>
								</div>

								<div class="input-group">
									<span class="input-group-label"><i class="fa fa-lock"></i></span>
									<input type="password" id="password" name="pwd" placeholder="<?php esc_html_e('Enter your password', 'betube') ?>" required>
								</div>
								<div class="input-group">
									<span class="input-group-label"><i class="fa fa-lock"></i></span>
									<input type="password" name="confirm" placeholder="<?php esc_html_e('Re-type your password', 'betube') ?>" required pattern="alpha_numeric">
								</div>
								<div class="input-group">
									<div class="checkbox">
										<input type="checkbox" name="remember" id="remember" value="forever" checked required>
										<label class="customLabel" for="remember">
											<?php esc_html_e("Agreed to", 'betube') ?>
											<a target="_blank" href="<?php echo esc_url($betubeTerms); ?>">
												<?php esc_html_e('terms & Condition', 'betube'); ?>
											</a>.
										</label>
									</div>									
								</div>
								<!--GDPR-->
								<div class="input-group">
									<div class="checkbox">
										<input type="checkbox" name="gdpr" id="gdpr" value="gdpr" checked>
										<label class="customLabel" for="gdpr">
											<?php esc_html_e("Agreed to", 'betube'); ?>
											<a target="_blank" href="<?php echo esc_url($betubeLawURL); ?>">
												<?php esc_html_e('GDPR', 'betube'); ?>
											</a>
											<?php esc_html_e(', keep me informed via email about my account info and posts related emails.', 'betube'); ?>
										</label>
									</div>
								</div>
								<!--GDPR-->
								<span class="form-error"><?php esc_html_e('Your email is invalid', 'betube') ?></span>
								<input type="hidden" name="submit" value="Register" id="submit" />
								<button class="button expanded" type="submit" name="op" value="Publish Ad"><?php esc_html_e('Register Now', 'betube') ?></button>
								<p class="loginclick"> 
									<a href="<?php echo esc_url($login); ?>"><?php esc_html_e('Already have account?', 'betube') ?></a>
									<a href="<?php echo esc_url($login); ?>"><?php esc_html_e('Login here', 'betube') ?></a>
								</p>
							</form>
						</div>
					</div><!--End Large 4 For Form-->
				</div><!--row test-eq-->
			</div><!--login-register-content-->	
		<?php } ?>			
		</div><!--large-12-->
	</div><!--row secBg-->
</section><!--registration-->
<?php get_footer(); ?>