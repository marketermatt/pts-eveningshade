<?php
/**
 * @package WordPress
 * @copyright Copyright (C) 2014 pixelthemestudio.ca - All Rights Reserved.
 * @license GPL/GNU <http://www.gnu.org/licenses/gpl-3.0.html>
 * @subpackage eveningshade
 */

// Get theme settings
//require (get_template_directory() . "/includes/settings.php"); no need for this again as we now use get_option('option') to get settings

get_header(); ?>

    <div>
        <div id="leftbottom" <?php if (get_option('pts_bloginset')=="Disable"){ ?>style="width: 649px !important;"<?php } ?>>
            <div id="lefttop">
                <?php
                /* Queue the first post, that way we know
                 * what date we're dealing with (if that is the case).
                 *
                 * We reset this later so we can run the loop
                 * properly with a call to rewind_posts().
                 */
                if (have_posts())
                    the_post();
                ?>

                <h1 class="page-title">
                    <?php if (is_day()) : ?>
                        <?php printf(__('Articles from: <span>%s</span>', 'eveningshade'), get_the_date()); ?>
                    <?php elseif (is_month()) : ?>
                        <?php printf(__('Articles from: <span>%s</span>', 'eveningshade'), get_the_date('F Y')); ?>
                    <?php
                    elseif (is_year()) : ?>
                        <?php printf(__('Articles from: <span>%s</span>', 'eveningshade'), get_the_date('Y')); ?>
                    <?php
                    else : ?>
                        <?php _e('Blog Archives', 'eveningshade'); ?>
                    <?php endif; ?>
                </h1>

                <?php
                /* Since we called the_post() above, we need to
                 * rewind the loop back to the beginning that way
                 * we can run the loop properly, in full.
                 */
                rewind_posts();

                /* Run the loop for the archives page to output the posts.
                 * If you want to overload this in a child theme then include a file
                 * called loop-archives.php and that will be used instead.
                 */
                get_template_part('loop', 'archive');
                ?>

                <!-- Post navigation -->
                <?php //if(function_exists('wp_pagenavi')) { wp_pagenavi(); }else{ wp_pagenavi_custom(); } ?>
            </div>
        </div>
        <?php if (get_option('pts_bloginset') <> "Disable") { ?>
            <div id="inset"><?php get_template_part( 'includes/sidebar', 'bloginset' ); ?></div>
        <?php } ?>
        <div id="rightbottom">
            <div id="righttop">
                <?php get_template_part( 'includes/sidebar', 'blogright' ); ?>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

<?php get_footer(); ?>