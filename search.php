<?php
/**
 * @package WordPress
 * @copyright Copyright (C) 2014 pixelthemestudio.ca - All Rights Reserved.
 * @license GPL/GNU <http://www.gnu.org/licenses/gpl-3.0.html>
* @subpackage eveningshade
 */


get_header(); 

?>

    <div>
        <div id="contentfull-top"></div>
        <div id="contentfull">
            <?php if ( have_posts() ) : ?>
                <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'eveningshade' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                <?php
                /* Run the loop for the search to output the results.
                 * If you want to overload this in a child theme then include a file
                 * called loop-search.php and that will be used instead.
                 */
                get_template_part( 'loop', 'search' );
                ?>
            <?php else : ?>
                <div id="post-0" class="post no-results not-found">
                    <h2 class="entry-title"><?php _e( 'Nothing Found', 'eveningshade' ); ?></h2>
                    <div class="entry-content">
                        <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'eveningshade' ); ?></p>
                        <?php get_search_form(); ?>
                    </div><!-- .entry-content -->
                </div><!-- #post-0 -->
            <?php endif; ?>
        </div>
        <div id="contentfull-bottom"></div>
    </div>

<?php get_footer(); ?>