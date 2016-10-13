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
            <?php get_template_part('page-content'); ?>
        </div>
        <div id="contentfull-bottom"></div>
    </div>

<?php get_footer(); ?>