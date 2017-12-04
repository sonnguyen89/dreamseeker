<?php
/*
Plugin Name: FB Last Posts
Description: A very tiny plugin that helps you to show last Facebook posts of certain page, group or timeline on your site.
Version: 1.0
Author: vitalikaz
Author URI: http://www.blast.lt/kontaktai
Licence: GPL2
*/

require_once(dirname(__FILE__)."/FBLastPosts.class.php");

// init wp hooks
add_action('admin_init', array('FBLastPosts', 'register_settings'));
add_action('admin_menu', array('FBLastPosts', 'register_options_page'));
add_filter('plugin_action_links_' . plugin_basename(__FILE__), array('FBLastPosts', 'action_links'));

function fb_get_last_posts($postsLimit = 10) {

    // get plugin options
    $appId = get_option('fb_last_posts_app_id');
    $appSecret = get_option('fb_last_posts_app_secret');
    $targetId = get_option('fb_last_posts_target_id');

    // check if all mandatory options are specified
    if (!$appId || !$appSecret || !$targetId)
        return new WP_Error('broke', __('App ID, App Secret and target Page ID should be provided to pull data from that page. Please set them in Admin panel in Settings -> FB Last Posts', FBLastPosts::TEXT_DOMAIN));

    // should we pull only owner's posts?
    $originOnly = get_option('fb_last_posts_origin') ? true : false;

	$fbPosts = new FBLastPosts($appId, $appSecret);
    // check if we need to refresh posts
	if (defined('FB_LAST_POSTS_DISABLE_CACHE') && FB_LAST_POSTS_DISABLE_CACHE || !$fbPosts->isCacheValid()) {

        // ... and try to do it
        $pullResult = $fbPosts->pullPosts($targetId, $originOnly, $postsLimit);

        // return error if we could not query Facebook API
        if (is_wp_error($pullResult))
            return $pullResult;
	}
	
	return $fbPosts->getPosts();
}

?>
