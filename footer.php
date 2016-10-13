<?php
/**
 * @package WordPress
 * @copyright Copyright (C) 2014 pixelthemestudio.ca - All Rights Reserved.
 * @license GPL/GNU <http://www.gnu.org/licenses/gpl-3.0.html>
 * Theme for WordPress: eveningshade* @subpackage eveningshade
 */
?>

		</div><!-- end contentwrapper -->
			<div id="bottom" class="clearfix"><?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Bottom Widgets')) : ?><?php endif; ?></div>
				<div id="footer">
				<?php if (get_option('pts_footermenu')<>"Disable") { ?>
				<div><?php wp_nav_menu( array( 'theme_location' => 'Footer Menu', 'sort_column' => 'menu_order', 'depth' => '1' ) ); ?></div>
				<?php } ?>
                    <?php echo get_option('pts_copyright'); ?>
                    <br />
                    <?php _e('Theme Design by','eveningshade'); ?> <a href="'<?php wp_get_theme()->get('ThemeURI'); ?>'">: Pixel Theme Studio</a>
				
				</div>
		</div><!-- end midwrapper -->
	</div><!-- end w980 -->
<div id="footerwrapper"></div>
<?php echo get_option('pts_google') ?>
<?php /* Always have wp_head() just before the closing </body> tag of your theme */ wp_footer(); ?>
</body>
</html>