<?php
/**
 * @copyright Copyright (C) 2014 pixelthemestudio.ca - All Rights Reserved.
 * @license GPL/GNU <http://www.gnu.org/licenses/gpl-3.0.html>
 */
?>
    <!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>"/>
        <title><?php wp_title('|', true, 'right'); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11"/>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
        <?php
        if (is_singular() && get_option('thread_comments'))
            wp_enqueue_script('comment-reply');

        ?>
        <?php /* Always have wp_head() just before the closing </head> tag of your theme */
        wp_head(); ?>
    </head>
<body <?php body_class(); ?>>

<div id="w980">
    <div id="header" class="clearfix">


        <div id="logo">
            <?php if (get_option('pts_sitetitle') <> "Disable") { ?>
                <a href="<?php echo home_url(); ?>" title="<?php echo get_option('pts_alt'); ?>"><img
                        src="<?php echo get_template_directory_uri(); ?>/images/logo-default.png"
                        alt="<?php echo get_option('pts_alt'); ?>"/></a>
                <h1><?php bloginfo('name'); ?></h1>
                <h2><?php bloginfo('description'); ?></h2>
            <?php } else { ?>
                <a href="<?php home_url(); ?>" title="<?php echo get_option('pts_alt'); ?>"><img src="<?php echo get_option('pts_logo'); ?>"
                                                                                    alt="<?php echo get_option('pts_alt'); ?>"/></a>
            <?php } ?>
        </div>

        <?php if (get_option('pts_topmenu') <> "Disable") { ?>
            <div
                id="topmenu"><?php wp_nav_menu(array('theme_location' => 'Top Menu', 'sort_column' => 'menu_order')); ?></div>
        <?php } ?>
        <div id="menuwrapper" class="clearfix">
            <div
                id="menu"><?php wp_nav_menu(array('theme_location' => 'Main Menu', 'sort_column' => 'menu_order')); ?></div>
            <div id="search">
                <form role="search" method="get" id="searchform_header" action="<?php echo home_url(); ?>">
                    <div><label class="screen-reader-text" for="s"><?php _e('Search for:', 'eveningshade'); ?></label>
                        <input value="" name="s" id="s_top" type="text" onFocus="this.value=''">
                        <input id="searchsubmit_top" value="Search" type="submit">
                    </div>
                </form>
            </div>

        </div>
    </div>
    <div id="midwrapper" class="clearfix">
    <div id="contentwrapper">
<?php if (is_front_page()) {
    //print_r(get_custom_header());

    if (get_custom_header()->url == '') {

        ?>
        <?php
        switch (get_option('pts_sctype')) {
            case "Widget Showcase":
                get_template_part( 'includes/showcase1', 'index' );
                break;
            case "Content Slideshow":
                get_template_part( 'includes/showcase2', 'index' );
                break;
        }
    } else {
        ?>
    <div id="showcase1" style="background:#<?php echo get_option('pts_scbg'); ?>"><img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>"
             width="<?php echo get_custom_header()->width; ?>"/></div>
    <?php
    }
    ?>
<?php } else { ?>
    <?php get_template_part( 'includes/showcase1', 'index' ); ?>
<?php
}
?>


<?php if (!is_front_page()) { ?>
    <div id="bcwrapper">
        <div id="breadcrumbs"><?php if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('', '');
            } else {
                pts_breadcrumbs();
            } ?></div>
    </div>
<?php } ?>