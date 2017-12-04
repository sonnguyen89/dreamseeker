<div class="wrap">
    <h2>FB Last Posts Settings</h2>

    <form method="post" action="options.php">
        <?php settings_fields('default'); ?>

        <p>You need to create a blank Facebook application and provide some information here in order to get posts from
            a page or group. You can create one using <a href="https://developers.facebook.com/" target="_blank">Facebook
                Developers</a> area.<br/>
            <strong>Note:</strong> your target page or group should be readable by this application.</p>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="fb_last_posts_app_id">Facebook APP ID</label></th>
                <td>
                    <input type="text" id="fb_last_posts_app_id" name="fb_last_posts_app_id" size="80" placeholder="Facebook APP ID" value="<?php echo get_option('fb_last_posts_app_id'); ?>"/>

                    <p>Copy &amp; paste your Facebook application's APP ID here.
                        <a href="https://www.facebook.com/help/community/question/?id=372967692803654">Where can I find
                            it?</a><br/>
                    </p>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><label for="fb_last_posts_app_secret">Facebook APP Secret</label></th>
                <td>
                    <input type="text" id="fb_last_posts_app_secret" name="fb_last_posts_app_secret" size="80" placeholder="Facebook APP Secret" value="<?php echo get_option('fb_last_posts_app_secret'); ?>"/>
                </td>
            </tr>
        </table>
        <br/>

        <h3>Parsing Settings</h3>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="fb_last_posts_target_id">Facebook Page/Group ID</label></th>
                <td>
                    <input type="text" id="fb_last_posts_target_id" name="fb_last_posts_target_id" size="80" placeholder="Page ID, e.g. 131093616270 or FIBA" value="<?php echo get_option('fb_last_posts_target_id'); ?>"/>
                    <p>Enter Facebook Page ID or slug you want to pull posts from. You can find it by navigating to this page's URL and replacing address from <code>https://<strong>WWW</strong>.facebook.com/xxx</code> to <code>https://<strong>GRAPH</strong>.facebook.com/xxx</code>.<br />
                    Example: <a href="https://graph.facebook.com/FIBA" target="_blank">https://graph.facebook.com/FIBA</a>. From that information we can see, that FIBA page's ID is <code>131093616270</code>. So you can write either this ID or simply <code>FIBA</code> here.</p>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><label for="fb_last_posts_caching_time">Caching Time</label></th>
                <td>
                    <input type="text" id="fb_last_posts_caching_time" name="fb_last_posts_caching_time" size="3" placeholder="Caching time in minutes" value="<?php echo get_option('fb_last_posts_caching_time'); ?>"/> minutes
                    <p>This plugin automatically caches posts to a local file so it doesn't need to make requests to Facebook on every page load. You can specify how many minutes it should take to invalidate this cache.<br />
                    You can completely disable caching for development purposes by <code>define('FB_LAST_POSTS_DISABLE_CACHE', true);</code> in your wp-config.php</p>
                </td>
            </tr>

            <tr valign="top">
                <td scope="row" colspan="2">
                    <label for="fb_last_posts_origin">
                        <input type="checkbox" name="fb_last_posts_origin" id="fb_last_posts_origin" <?php print get_option('fb_last_posts_origin') ? 'checked="checked"' : ''; ?> />
                        Get posts originally posted only by page owner (exclude posts posted by other users)
                    </label>
                </td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>

    <hr />
    <h2>How To Use</h2>
    <p>After you have filled settings above you can show target's (page, group or timeline) Facebook posts on your pages.</p>
    <p>In order to get last Facebook posts you should call <code>fb_get_last_posts()</code> function. Optionally you can specify how many posts plugin should pull: <code>fb_get_last_posts(10)</code> (default is 15 posts).</p>
    <p>You get an array of posts. Every array element has these keys:
    <ul>
        <li><code>id</code> - original post ID</li>
        <li><code>message</code> - post message content</li>
        <li><code>permalink</code> - Facebook post's permalink</li>
        <li><code>author_id</code> - Facebook user ID who created this post</li>
        <li><code>author_name</code> - Facebook user name who created this post</li>
        <li><code>post_type</code> - Facebook post type (can be <code>status</code>, <code>photo</code>, <code>video</code>, etc.)</li>
        <li><code>link</code> - If some media is attached to post, it's page URL will be placed here</li>
        <li><code>picture</code> - If some media is attached to a post, it's thumbnail image URL will be placed here</li>
        <li><code>create_time</code> - Date and time when post was created</li>

    </ul></p>

    <h3>Usage Code Example</h3>
    <p>Use this code in any template you want to show posts on.</p>
    <p>
        <code>&lt;?php<br />
            $fb_posts = fb_get_last_posts(10);<br />
            foreach($fb_posts as $fb_post): ?&gt;<br />
            &nbsp;&nbsp;&nbsp;&nbsp;&lt;div&gt;<br />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;span class="author">&lt;?php print esc_html($fb_post['author_name']);?&gt;&lt;/span&gt;,<br />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;span class="date">&lt;?php print date(get_option('date_format'), strtotime($fb_post['created_time']));?&gt;&lt;/span&gt;<br />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;p&gt;&lt;?php print esc_html($fb_post['message']); ?&gt;&lt;/p&gt;<br />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;a href="&lt;?php print $fb_post['permalink'];?&gt;"&gt;Original post&lt;/a&gt;<br />
            &nbsp;&nbsp;&nbsp;&nbsp;&lt;/div&gt;<br />
            &lt;?php endforeach; ?&gt;
        </code>
    </p>

</div>