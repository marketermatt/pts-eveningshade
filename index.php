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
                <?php get_template_part( 'loop', 'index' ); ?>
            </div>
        </div>
        <?php if (get_option('pts_bloginset')<>"Disable") { ?>
            <div id="inset"><?php get_template_part( 'includes/sidebar', 'bloginset' );?></div>
        <?php } ?>
        <div id="rightbottom">
            <div id="righttop">
                <?php get_template_part( 'includes/sidebar', 'blogright' );?>
            </div>
        </div>
    </div>
<div class="clearfix"></div>



<?php get_footer(); ?>