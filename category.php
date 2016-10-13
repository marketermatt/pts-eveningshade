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
        <div id="leftbottom" <?php if (get_option('pts_bloginset')=="Disable"){ ?>style="width: 649px !important;"<?php } ?>>
            <div id="lefttop">
                <h1 class="page-title"><?php printf(__('Category: %s', 'eveningshade'), '<span>' . single_cat_title('', false) . '</span>'); ?></h1>
                <?php $category_description = category_description();
                if (!empty($category_description))
                    echo '<div class="archive-meta">' . $category_description . '</div>';
                get_template_part('loop', 'category');
                ?>
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