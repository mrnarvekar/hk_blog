<?php
function hk_get_category($post_id){
	if ( class_exists('WPSEO_Primary_Term') ) {
	     // Show the post's 'Primary' category, if this Yoast feature is available, & one is set
		$wpseo_primary_term = new WPSEO_Primary_Term( 'category', $post_id );
		$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
		if(!$wpseo_primary_term){
			$category = wp_get_post_terms( $post_id, 'category' ); 
		}else{
			$term = get_term( $wpseo_primary_term );
		     if ( is_wp_error( $term ) ) {
		          // Default to first category (not Yoast) if an error is returned
		        $category = wp_get_post_terms( $post_id, 'category' ); 
		     } else {
		          // Set variables for category_display & category_slug based on Primary Yoast Term
		          $category_id = $term->term_id;
		          $category[] = get_category($category_id);

		     }
		}
	} else {
	     // Default, display the first category in WP's list of assigned categories
	    $category = wp_get_post_terms( $post_id, 'category' ); 
	}
	return $category;
}

/**
 * Function calculate the estimates reading time of the post content.
 * @param string $content Post content.
 * @return string estimated reading time.
 */
function get_estimated_reading_time( $content = '') {
    $wpm = 265;
    $text_content = strip_shortcodes( $content );   // Remove shortcodes
    $str_content = strip_tags( $text_content );     // remove tags
    $word_count = str_word_count( $str_content );
    $readtime = ceil( $word_count / $wpm );
    return $readtime;
}

function get_mins_read(){
	$mins_read = get_post_meta( get_the_ID(), 'hk_mins_read', true ); 
	if(!$mins_read){
		$mins_read = get_estimated_reading_time(get_the_content());
	}
	return $mins_read;
}

function hk_get_excerpt($limit) {
	$content = get_the_excerpt();
	$limit_pos = strpos($content, " ", $limit);
	return substr($content, 0, $limit_pos);
}