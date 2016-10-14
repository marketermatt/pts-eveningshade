<?php
/**
 * @package WordPress
 * @copyright Copyright (C) 2014 pixelthemestudio.ca - All Rights Reserved.
 * @license GPL/GNU* @subpackage eveningshade
 */

?>
<div id="showcase1" style="background:#<?php echo get_option('pts_scbg'); ?>"><?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Showcase Widget')) : ?><?php endif; ?></div>