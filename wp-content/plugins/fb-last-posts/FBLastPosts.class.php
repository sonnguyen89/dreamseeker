<?php
/**
 * FB Last Posts
 *
 * Author: vitalikaz
 *
 */
 
require_once(dirname(__FILE__)."/fb/facebook.php");

class FBLastPosts {

    const TEXT_DOMAIN = 'fb-last-posts';
	
	public
        $appId,
        $appSecret;

	private
        $dataFile,
        $cacheLifetime;
	
	public function __construct($appId, $appSecret, $cacheLifetime = 30) {
		$this->appId = $appId;
		$this->appSecret = $appSecret;
		$this->dataFile = dirname(__FILE__).'/data/'.md5($appId.$appSecret).".txt";
        $this->cacheLifetime = $cacheLifetime;
	}
	
	public function isCacheValid() {
		if (!file_exists($this->dataFile)) return false;
		return filemtime($this->dataFile) > strtotime(sprintf('-%d minutes', $this->cacheLifetime));
	}
	
	public function pullPosts($pageId, $originOnly = false, $limit = 15) {
	    
	    // initialize Facebook
        try {
            $facebook = new Facebook(array(
                'appId' => $this->appId,
                'secret' => $this->appSecret,
            ));

            // query for last posts
            $_posts = $facebook->api("/{$pageId}/feed?limit={$limit}");

        } catch(Exception $e) {
            return new WP_Error('broke', __("Could not connect to Facebook API using App ID and App Secret you provided.", self::TEXT_DOMAIN));
        }
		if (!isset($_posts['data'])) return false;
		
		$posts = array();
        
        // collect data from result
		foreach ($_posts['data'] as $post):
		    // check if we need to add this post to result
			if ( //true
                ($originOnly && isset($post['from']) && isset($post['from']['id']) && $post['from']['id'] == $pageId || !$originOnly) &&
                isset($post['id'])
			) {
			    // format post id
				$id = explode('_', $post['id']);
				if (is_array($id) && count($id) == 2) $id = $id[1];
				else $id = $post['id'];
				$posts[] = //$post;
                array(
                    'id' => $id,
					'message' => $post['message'],
                    'permalink' => sprintf('http://www.facebook.com/%s/posts/%s', $post['from']['id'], $id),

                    'author_id' => $post['from']['id'],
                    'author_name' => $post['from']['name'],

                    'post_type' => $post['type'],
                    'link' => $post['link'],
                    'picture' => $post['picture'],

					'created_time' => $post['created_time']
				);
			}
		endforeach;

		file_put_contents($this->dataFile, serialize($posts));

        return true;
	}
	
	public function getPosts() {
		$data = array();
		if (file_exists($this->dataFile)) {
			$data = unserialize(file_get_contents($this->dataFile));
		}
		return $data;
	}

    /* Wordpress hooks */
    static public function register_settings() {

        add_option( 'fb_last_posts_app_id');
        add_option( 'fb_last_posts_app_secret');
        add_option( 'fb_last_posts_target_id');
        add_option( 'fb_last_posts_origin');
        add_option( 'fb_last_posts_caching_time', 30);

        register_setting( 'default', 'fb_last_posts_app_id' );
        register_setting( 'default', 'fb_last_posts_app_secret' );
        register_setting( 'default', 'fb_last_posts_target_id' );
        register_setting( 'default', 'fb_last_posts_origin' );
        register_setting( 'default', 'fb_last_posts_caching_time' );

    }

    static public function register_options_page() {
        if (function_exists('add_options_page')) {
            function include_options_page() {
                include(dirname(__FILE__).'/fb-last-posts-options.php');
            }

            add_options_page(__('FB Last Posts', self::TEXT_DOMAIN), __('FB Last Posts', self::TEXT_DOMAIN), 'manage_options', 'fb-last-posts-settings', 'include_options_page');
        }
    }

    static public function action_links($links) {
        $links[] = '<a href="'. get_admin_url(null, 'options-general.php?page=fb-last-posts-settings') .'">Settings</a>';
        return $links;

    }
}

?>
