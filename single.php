<?php
/**
 * @package WordPress
 * @copyright Copyright (C) 2014 pixelthemestudio.ca - All Rights Reserved.
 * @license GPL/GNU <http://www.gnu.org/licenses/gpl-3.0.html>
 * Theme for WordPress: eveningshade* @subpackage eveningshade
 */

get_header();

?>

    <div>
        <div id="leftbottom" <?php if (get_option('pts_bloginset')=="Disable"){ ?>style="width: 649px !important;"<?php } ?>>
            <div id="lefttop">
                <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

                    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <h1 class="entry-title"><?php the_title(); ?></h1>

                        <div class="entry-meta">
                            <?php eveningshade_posted_on(); ?>&nbsp;<span class="cat-links">
						<?php printf( __( '<span class="%1$s">&nbsp;Category: </span> %2$s', 'eveningshade' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
					</span>
                        </div><!-- .entry-meta -->

                        <div class="entry-content">
                            <?php the_post_thumbnail( 'single-post-thumbnail' ); ?>
                            <?php the_content(); ?>
                            <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'eveningshade' ), 'after' => '</div>' ) ); ?>
                        </div><!-- .entry-content -->

                        <div class="entry-utility">
                            <?php eveningshade_posted_in(); ?>
                            <?php edit_post_link( __( 'Edit', 'eveningshade' ), '<span class="edit-link">', '</span>' ); ?>
                        </div><!-- .entry-utility -->
                    </div><!-- #post-## -->

                    <div id="nav-below" class="navigation">
                        <a class="Logo-Text" href="javascript:javascript:history.go(-1)">Return to Previous Page</a>
                    </div><!-- #nav-below -->

                    <?php comments_template( '', true ); ?>

                <?php endwhile; // end of the loop. ?>
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