<?php
/**
 * @package WordPress
 * @copyright Copyright (C) 2014 pixelthemestudio.ca - All Rights Reserved.
 * @license GPL/GNU* @subpackage eveningshade
 */

?>

<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Page Right Column')) : ?>
    <div class="widget"><h3><?php _e('Right Column Widgets', 'eveningshade'); ?></h3>

        <div
            class="textwidget"><?php _e('Welcome to the Right Column for the Evening Shade theme. You can put a variety of widgets in this location and to manage where they are published in your site, you can download the Widget logic plugin.', 'eveningshade'); ?>
        </div>
    </div>
    <div class="widget"><h3><?php _e('Blogroll', 'eveningshade'); ?></h3>
        <ul class="xoxo blogroll">
            <li><a href="<?php echo wp_get_theme()->get('ThemeURI'); ?>"><?php _e('Download this Theme', 'eveningshade'); ?></a></li>
            <li><a href="http://codex.wordpress.org/"><?php _e('Documentation', 'eveningshade'); ?></a></li>
            <li><a href="http://wordpress.org/extend/plugins/"><?php _e('Plugins', 'eveningshade'); ?></a></li>
            <li><a href="http://wordpress.org/extend/ideas/"><?php _e('Suggest Ideas', 'eveningshade'); ?></a></li>
            <li><a href="http://wordpress.org/support/"><?php _e('Support Forum', 'eveningshade'); ?></a></li>
            <li><a href="http://wordpress.org/news/"><?php _e('WordPress Blog', 'eveningshade'); ?></a></li>

        </ul>

    </div>




<?php endif; ?>