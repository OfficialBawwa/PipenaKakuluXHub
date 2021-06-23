<?php
function betube_theme_support() {
	/*==========================
	beTube : Adding WP Functions & Theme Support
	===========================*/
	// Add support for Woocommerce
	add_theme_support( 'woocommerce');
	// Add support for Custom Background
	add_theme_support( 'custom-background' );
	// Add support for RSS Feed links
	add_theme_support( 'automatic-feed-links' );
	// Add support for Post Thumbnails	
	add_theme_support( 'post-thumbnails' );
	// Add support for Title tags
	add_theme_support( 'title-tag' );
	// Add support for full and wide align images
	add_theme_support( 'align-wide' );
	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );
	// Add support for HTML5
	add_theme_support( 'html5', 
		array( 
			'comment-list', 
			'comment-form', 
			'search-form', 
			'gallery', 
			'caption', 
		) 
	);	
	// Add support for Post Formats
	add_theme_support( 'post-formats',		
		array(
			'image',             // an image
			'video',             // video
			'audio',             // audio
		)
	);
	/*==========================
	beTube : Default thumbnail size
	===========================*/	
	set_post_thumbnail_size(750, 500, true);
	add_image_size( 'betube-fslider', 400, 300, true );
	add_image_size( 'betube-movies', 185, 274, false );
	add_image_size( 'betube-thumbnail', 400, 250, false );	
	/*==========================
	beTube : Track views
	===========================*/
    add_action( 'wp_head', 'betube_track_post_views');
	/*==========================
	beTube : Theme page titles
	===========================*/	
    add_filter( 'wp_title', 'betube_wp_title', 10, 2 );
	/*==========================
	beTube : Category new fields (the form)
	===========================*/	
	add_filter('add_category_form', 'betube_my_category_fields');
	add_filter('edit_category_form', 'betube_my_category_fields');
	/*==========================
	beTube : Update category fields
	===========================*/	
    add_action( 'edited_category', 'betube_update_my_category_fields', 10, 2 );  
    add_action( 'create_category', 'betube_update_my_category_fields', 10, 2 );
	/*==========================
	beTube : Enque Media
	===========================*/	
	add_action('wp_enqueue_scripts', 'betube_add_media_upload_scripts');
	add_action( 'admin_enqueue_scripts', 'betube_wp_media_files' );
	add_action( 'admin_enqueue_scripts', 'betube_cat_enqueue_script' );
	/*==========================
	beTube : Set the maximum allowed width for any content in the theme, like oEmbeds and images added to posts.
	===========================*/
	$GLOBALS['content_width'] = apply_filters( 'betube_theme_support', 1200 );	
	/*==========================
	beTube : Add Colors
	===========================*/
	require get_template_directory() . '/inc/colors.php';
	/*==========================
	beTube : Add Breadcrumbs
	===========================*/	
	require get_template_directory() . '/inc/breadcrumbs.php';
	/*==========================
	beTube : Add Video Function
	===========================*/	
	require get_template_directory() . '/inc/video-functions.php';
	
	if ( version_compare( $GLOBALS['wp_version'], '4.0-alpha', '<' ) ){
		require get_template_directory() . '/inc/back-compat.php'; 
	}
	/*==========================
	beTube : Include the TGM_Plugin_Activation class. 
	===========================*/	
	require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
    add_action( 'tgmpa_register', 'betube_register_required_plugins' );
	
} /* end theme support */
add_action( 'after_setup_theme', 'betube_theme_support' );