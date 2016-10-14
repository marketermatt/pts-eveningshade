<?php
/**
 * @package WordPress
 * @copyright Copyright (C) 2014 pixelthemestudio.ca - All Rights Reserved.
 * @license GPL/GNU* @subpackage eveningshade
 */
?>

<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Page Inset Column')) : ?>

<div class="widget"><h3><?php _e('Inset Column Widgets','eveningshade'); ?></h3>
<div class="textwidget"><?php _e('Welcome to the Inset Column for the Evening Shade theme. As some people like to have a third column sidebar, the Inset column will provide you with that option which you can also disable anytime you want from the theme settings.','eveningshade'); ?>
</div>
</div>
<div class="widget"><h3><?php _e('Archives','eveningshade'); ?></h3>
<ul>
	<?php wp_get_archives( 'type=monthly' ); ?>
</ul>
</div>




<?php endif; ?>