<?php
/**
 * Template Name: Page with Right Column
 * @copyright Copyright (C) 2014 pixelthemestudio.ca - All Rights Reserved.
 * @license GPL/GNU <http://www.gnu.org/licenses/gpl-3.0.html>* @subpackage eveningshade
 */

get_header(); 

?>
    <div>
        <div id="leftbottom" style="width:649px">
            <div id="lefttop">
                <?php get_template_part( 'page-content' ); ?>
            </div>
        </div>
        <div id="rightbottom" style="width: 280px !important;">
            <div id="righttop">
                <?php get_template_part( 'includes/sidebar', 'pageright' );?>

            </div>
        </div>
    </div>
<div class="clearfix"></div>
<?php get_footer(); ?>