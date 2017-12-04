=== FB Last Posts ===
Contributors: vitalikaz
Donate link: http://www.blast.lt/kontaktai/
Tags: facebook, facebook page, facebook posts, fb posts, like button, facebook recent posts, fanpage, fb group, likebox, facebook likebox, last posts, recent posts
Requires at least: 3.0.1
Tested up to: 4.0
Stable tag: 1.0.1
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A very tiny plugin that helps you to show last Facebook posts of certain page, group or timeline on your site.

== Description ==

This plugin allows you to show posts from Facebook pages, groups and timelines directly on your website in a very simple way.
Plugin does not register shortcodes, JS scripts or any extra libraries, so it's extremely clean & tiny and you are free to decide how your recent Facebook posts listing will look like.

If you are a fan of clean code (like me) without tons of extra scripts for plugin to work, you will definitely like this plugin. It's extremely fast as it does not any unnecessary work and cleverly caches results.

= Sample Usage =
`<?php
// try to get posts from Facebook
$fb_posts = fb_get_last_posts(10);

// check if result is not a WP error
if (!is_wp_error($fb_posts)):
    // loop through posts and show them
    foreach($fb_posts as $fb_post): ?>
        <div>
            <span class="author"><?php print esc_html($fb_post['author_name']);?></span>,
            <span class="date"><?php print date(get_option('date_format'), strtotime($fb_post['created_time']));?></span>
            <p><?php print esc_html($fb_post['message']); ?></p>
            <a href="<?php print $fb_post['permalink'];?>">Original post</a>
        </div>
    <?php endforeach;
else: 
    // or display an error ?>
    <div><?php print esc_html($fb_posts->get_error_message());?></div>
<?php endif; ?>`

== Installation ==
1. Upload the `fb-last-posts` folder to the `/wp-content/plugins/` directory.
1. Activate plugin through the 'Plugins' menu in WordPress.
1. Setup plugin through 'Settings -> FB Last Posts' menu. This page will guide you how to do everything you need to use this plugin.
1. You are ready to go! Use `fb_get_last_posts()` function to get posts from Facebook (please check Description tab for an example).

== Screenshots ==
1. Plugin settings page

== Frequently Asked Questions ==
If you have any questions, please contact author on labas [at] blast [dot] lt

== Changelog ==

= 1.0 =
* Initial version

== Upgrade Notice ==

= 1.0 =
Have fun using this extremely tiny plugin! :)
