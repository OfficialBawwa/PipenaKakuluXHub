<?php 
/**
 * Dimox Breadcrumbs
 * http://dimox.net/wordpress-breadcrumbs-without-a-plugin/
 * Since ver 1.0
 * Add this to any template file by calling betube_breadcrumbs()
 * Changes: MC added taxonomy support
 */
function betube_breadcrumbs(){
  /* === OPTIONS === */	
	$text['home']     = esc_html__('Home','betube'); // text for the 'Home' link	
	$text['category'] = '%s'; // text for a category page	
	$text['tax'] 	  = esc_html__('Archive for','betube').' "%s"'; // text for a taxonomy page	
	$text['search']   = esc_html__('Search Results for','betube').' "%s"'; // text for a search results page	
	$text['tag']      = esc_html__('Posts Tagged','betube').' "%s"'; // text for a tag page
	$text['author']   = esc_html__('Posted By','betube').' "%s"'; // text for an author page	
	$text['404']      = esc_html__('Page Not Found','betube');// text for the 404 page

	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$delimiter   = '&nbsp;'; // delimiter between crumbs
	$before      = '<li><span>'; // tag before the current crumb
	$after       = '</span></li>'; // tag after the current crumb
	/* === END OF OPTIONS === */

	global $post;
	$homeLink = home_url() . '/';
	$linkBefore = '<li>';
	$linkAfter = '</li>';
	$linkAttr = ' rel="v:url" property="v:title"';	
	$link = $linkBefore . '<i class="fa fa-home"></i><a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;

	if (is_home() || is_front_page()) {

		if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $text['home'] . '</a></div>';

	} else {

		echo '<section id="breadcrumb" class="breadMargin"><div class="row"><div class="large-12 columns"><nav aria-label="You are here:" role="navigation"><ul class="breadcrumbs">' . sprintf($link, $homeLink, $text['home']) . $delimiter;

		
		if ( is_category() ) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) {
				$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo wp_kses($cats, $allowed_html);
			}
			echo wp_kses_post($before) . sprintf($text['category'], single_cat_title('', false)) . $after;

		} elseif( is_tax('post') ){
			$thisCat = get_category(get_query_var('cat'), false);			
			if($thisCat){
				if ($thisCat->parent != 0) {
					$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
					$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
					$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
					echo wp_kses_post($cats);
				}
			}			
			echo wp_kses_post($before) . sprintf($text['tax'], single_cat_title('', false)) . $after;
		}elseif( is_tax('blog_category') ){			
			$term_object = get_term( get_queried_object() );
			$taxonomy = $term_object->taxonomy;
			$term_id = $term_object->term_id;
			$term_name = $term_object->name;
			$term_parent = $term_object->parent;
			$taxonomy_object = get_taxonomy( $taxonomy );
			$current_term_link  = $before . $term_name . $after;
			$parent_term_string = '';
			$link = '<li><a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
			if ( 0 !== $term_parent ){
				$parent_term_links = [];
				while ( $term_parent ) {
					$term = get_term( $term_parent, $taxonomy );
					$parent_term_links[] = sprintf( $link, esc_url( get_term_link( $term ) ), $term->name );
					$term_parent = $term->parent;
				}
				$parent_term_links  = array_reverse( $parent_term_links );
				$parent_term_string = implode( $delimiter, $parent_term_links );
			}
			if ( $parent_term_string ) {
				$breadcrumb_trail = $parent_term_string . $delimiter . $current_term_link;
			}else{
				$breadcrumb_trail = $current_term_link;
			}
			echo betube_display_html_ad_code($breadcrumb_trail);			
		}elseif ( is_search() ) {
			echo wp_kses_post($before) . sprintf($text['search'], get_search_query()) . $after;

		} elseif ( is_day() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
			echo wp_kses_post($before) . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo wp_kses_post($before) . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			echo wp_kses_post($before) . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
			$catLink = '<li class="cAt">';
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
				if ($showCurrent == 1) echo wp_kses_post($delimiter) . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $catLink . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo wp_kses_post($cats);
				if ($showCurrent == 1) echo wp_kses_post($before) . get_the_title() . $after;
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo wp_kses_post($before) . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, $delimiter);
			$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
			$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
			echo wp_kses_post($cats);
			printf($link, get_permalink($parent), $parent->post_title);
			if ($showCurrent == 1) echo wp_kses_post($delimiter) . $before . get_the_title() . $after;

		} elseif ( is_page() && !$post->post_parent ) {
			if ($showCurrent == 1) echo wp_kses_post($before) . get_the_title() . $after;

		} elseif ( is_page() && $post->post_parent ) {
			$linkPage = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = sprintf($linkPage, get_permalink($page->ID), get_the_title($page->ID));
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo wp_kses_post($breadcrumbs[$i]);
				if ($i != count($breadcrumbs)-1) echo wp_kses_post($delimiter);
			}
			if ($showCurrent == 1) echo wp_kses_post($delimiter) . $before . get_the_title() . $after;

		} elseif ( is_tag() ) {			
			echo the_archive_title();

		} elseif ( is_author() ) {
	 		$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
			$author_ID = $author->ID;			
			$userdata = get_userdata($author_ID);			
			echo wp_kses_post($before) . sprintf($text['author'], $userdata->display_name) . $after;

		} elseif ( is_404() ) {
			echo wp_kses_post($before) . $text['404'] . $after;
		}		

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
				echo the_archive_title();
			echo esc_html__('Page', 'betube') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) 
				echo wp_kses_post($before).the_archive_title().$after;
		}

		echo '</ul></nav></div></div></section>';

	}
}