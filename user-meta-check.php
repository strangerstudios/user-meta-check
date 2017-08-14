<?php
/*
Plugin Name: User Meta Check
Plugin URI: https://www.strangerstudios.com/wp/user-meta-check/
Description: Shortcode to hide content based on user meta value.
Version: .1
Author: Stranger Studios
Author URI: https://www.strangerstudios.com
Text Domain: user-meta-check
*/

/**
 * Shortcode to hide/show content based on membership level
 */
function user_meta_check_shortcode($atts, $content=null, $code="")
{
	//grab key and value attributes
	extract(shortcode_atts(array(
		'key' => NULL,
		'value' => NULL,
	), $atts));
	
	//default to hiding
	$show = false;
	
	if(is_user_logged_in()) {
		global $current_user;
		$meta_value = get_user_meta($current_user->ID, $key, true);
		if($meta_value == $value)
			$show = true;
	}

	if($show)
		return do_shortcode($content);	//show content
	else
		return "";	//just hide it
}
add_shortcode("user-meta-check", "user_meta_check_shortcode");