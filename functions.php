<?php
/**
 * @package WordPress
 * @copyright Theme Design Copyright (C) 2014 pixelthemestudio.ca - All Rights Reserved.
 * @license GPL/GNU <http://www.gnu.org/licenses/gpl-3.0.html>
 * Theme for WordPress: eveningshade* @subpackage eveningshade
 */
$functions_path = get_template_directory() . '/functions/';
$includes_path = get_template_directory() . '/includes/';
require_once($includes_path . 'settings.php');
require_once($functions_path . 'contact.php');
require_once($functions_path . 'shortcodes.php');
require_once($functions_path . 'widgets.php');
require_once($functions_path . 'breadcrumbs.php');
require_once($includes_path . 'wp-pagenavi.php');


// Add a text domain
add_action('init', 'eveningshade_setup');
function eveningshade_setup()
{
    load_theme_textdomain('eveningshade', get_template_directory() . '/languages');
}


// Enable support for post-thumbnails
add_theme_support('post-thumbnails');

// If we want to ensure that we only call this function if
// the user is working with WP 2.9 or higher,
add_theme_support('post-thumbnails');


add_theme_support('post-thumbnails');
set_post_thumbnail_size(150, 100, false); // default thumbnail size
//add_image_size('index-thumbnail', 100, 100); // for front page thumbnails
//add_image_size('single-post-thumbnail', 225, 180); // a different thumbnail size on single post pages

// Add default posts and comments RSS feed links to head
add_theme_support('automatic-feed-links');

// Add menu Support and removing the menu container.
register_nav_menu('Main Menu', 'Your primary site menu');
register_nav_menu('Top Menu', 'Your corner menu');
register_nav_menu('Footer Menu', 'Your footer menu');

function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
} // function

//add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );
/* Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link. */
function eveningshade_page_menu_args($args)
{
    $args['show_home'] = true;
    return $args;
}

add_filter('wp_page_menu_args', 'eveningshade_page_menu_args');

/* Sets the excerpt length */
function eveningshade_excerpt_length($length)
{
    return 70;
}

add_filter('excerpt_length', 'eveningshade_excerpt_length');


// Stops WordPress from going to middle of full post view - very irrating. Thanks to http://digwp.com
function remove_more_jump_link($link)
{
    $offset = strpos($link, '#more-');
    if ($offset) {
        $end = strpos($link, '"', $offset);
    }
    if ($end) {
        $link = substr_replace($link, '', $offset, $end - $offset);
    }
    return $link;
}

add_filter('the_content_more_link', 'remove_more_jump_link');

// Changing excerpt ending to a more-link
function new_excerpt_more($more)
{
    global $post;
    return '<a class="more-link" href="' . get_permalink($post->ID) . '">' . __('Read more', 'eveningshade') . '</a>';
}

add_filter('excerpt_more', 'new_excerpt_more');

/* Remove the irritating comment tags on the comment form */
function mytheme_init()
{
    add_filter('comment_form_defaults', 'mytheme_comments_form_defaults');
}

add_action('after_setup_theme', 'mytheme_init');

function mytheme_comments_form_defaults($default)
{
    unset($default['comment_notes_after']);
    return $default;
}

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since Twenty Ten 1.0
 */
function eveningshade_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}

add_action('widgets_init', 'eveningshade_remove_recent_comments_style');

if (!function_exists('eveningshade_posted_on')) :
    /**
     * Prints HTML with meta information for the current post�date/time and author.
     *
     * @since Twenty Ten 1.0
     */
    function eveningshade_posted_on()
    {
        printf(__('<span class="%1$s">Date: </span> %2$s <span class="meta-sep">&nbsp;Author: </span> %3$s', 'eveningshade'),
            'meta-prep meta-prep-author',
            sprintf('<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
                get_permalink(),
                esc_attr(get_the_time()),
                get_the_date()
            ),
            sprintf('<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
                get_author_posts_url(get_the_author_meta('ID')),
                sprintf(esc_attr__('View all posts by %s', 'eveningshade'), get_the_author()),
                get_the_author()
            )
        );
    }
endif;


if (!function_exists('eveningshade_comment')) :
    /**
     * Template for comments and pingbacks.
     *
     * To override this walker in a child theme without modifying the comments template
     * simply create your own eveningshade_comment(), and that function will be used instead.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     *
     * @since Twenty Ten 1.0
     */
    function eveningshade_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case '' :
                ?>
                <div <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                    <div class="commentgroup">
                        <div id="comment-<?php comment_ID(); ?>">
                            <div class="cmeta">
                                <?php echo get_avatar($comment, 40); ?><?php printf(__('%s', 'eveningshade'), sprintf('<span class="cname">%s</span>', get_comment_author_link())); ?>
                                <br/>
	<span class="cdate">Commented:&nbsp;<a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
            <?php
            /* translators: 1: date, 2: time */
            printf(__('%1$s at %2$s', 'eveningshade'), get_comment_date(), get_comment_time()); ?></a>(<?php edit_comment_link(__('Edit', 'eveningshade'), ' ');
                                ?>)</div>
                            </span>
                            <?php if ($comment->comment_approved == '0') : ?>
                                <div class="cmoderation">
                                    <?php _e('Your comment is awaiting moderation.', 'eveningshade'); ?>
                                </div>
                            <?php endif; ?>
                            <div class="comment-body"><?php comment_text(); ?></div>
                            <div
                                class="reply"><?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?></div>


                        </div>
                    </div>
                    <!-- #comment-##  -->
                </div>
                <?php
                break;
            case 'pingback'  :
            case 'trackback' :
                ?>
                <li class="post pingback">
                <p><?php _e('Pingback:', 'eveningshade'); ?> <?php comment_author_link(); ?>(<?php edit_comment_link(__('Edit', 'eveningshade'), ' '); ?>)</p>
                <?php
                break;
        endswitch;
    }
endif;


if (!function_exists('eveningshade_posted_in')) :
    /**
     * Prints HTML with meta information for the current post (category, tags and permalink).
     *
     * @since Twenty Ten 1.0
     */
    function eveningshade_posted_in()
    {
        // Retrieves tag list of current post, separated by commas.
        $tag_list = get_the_tag_list('', ', ');
        if ($tag_list) {
            $posted_in = __('This entry was posted in: %1$s <br />Tags: %2$s. <br />Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'eveningshade');
        } elseif (is_object_in_taxonomy(get_post_type(), 'category')) {
            $posted_in = __('This entry was posted in %1$s. Bookmark: <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'eveningshade');
        } else {
            $posted_in = __('Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'eveningshade');
        }
        // Prints the string, replacing the placeholders.
        printf(
            $posted_in,
            get_the_category_list(', '),
            $tag_list,
            get_permalink(),
            the_title_attribute('echo=0')
        );
    }
endif;
?>
<?php
// for scripts needed on the front-end

define('pts_js', get_template_directory_uri() . '/js');
function pts_js_scripts()
{
    if (!is_admin()) {
        //wp_deregister_script( 'jquery' );
        //wp_register_script( 'jquery', pts_js . '/jquery-1.3.2.min.js', false, '' );
    }
}

add_action('init', 'pts_js_scripts');
?>
<?php
// begin control panel naming

$themename = "Evening Shade";
$shortname = "pts";

/* control panel settings here */

$options = array(

    array("name" => "Logo and Title Settings",
        "type" => "section"),
    array("type" => "open"),

    array("name" => "Disable/Enable Default logo set",
        "desc" => "Choose to enable or disable the default theme logo and title group for your own logo",
        "id" => $shortname . "_sitetitle",
        "type" => "select",
        "std" => "Enable",
        "options" => array("Enable", "Disable")),

    array(
        "name" => "Logo Image",
        "desc" => "Add the link to your own logo image.",
        "id" => $shortname . "_logo",
        "type" => "text",
        "std" => ""),

    array(
        "name" => "Logo ALT",
        "desc" => "For seo benefits - enter your logo alt keywords like: The best WordPress themes",
        "id" => $shortname . "_alt",
        "type" => "text",
        "std" => "WordPress themes by Pixel Theme Studio"),

    array("type" => "close"),
    array("name" => "Blog Settings",
        "type" => "section"),
    array("type" => "open"),

    array("name" => "Blog Inset Column",
        "desc" => "Choose to enable or disable the inset column for your blog pages. This is just for the blog only.",
        "id" => $shortname . "_bloginset",
        "type" => "select",
        "std" => "Enable",
        "options" => array("Enable", "Disable")),

    array("type" => "close"),
    array("name" => "Showcase and Slideshow Settings",
        "type" => "section"),
    array("type" => "open"),

    array("name" => "Home Page Showcase",
        "desc" => "Choose either the Widget Showcase or your own choice of a slideshow or slider - you will need to download your choice of one and install it.",
        "id" => $shortname . "_sctype",
        "type" => "select",
        "std" => "Widget Showcase",
        "options" => array("Widget Showcase", "Content Slideshow")),

    array("name" => "Showcase Background Colour",
        "desc" => "Choose the background colour for your showcase area. Default colour is 000000",
        "id" => $shortname . "_scbg",
        "type" => "text_colour",
        "std" => "000000"),

    array("type" => "close"),

    array("name" => "Miscellaneous Settings",
        "type" => "section"),
    array("type" => "open"),

    array("name" => "Disable/Enable Top Menu",
        "desc" => "Choose to enable or disable the top corner menu",
        "id" => $shortname . "_topmenu",
        "type" => "select",
        "std" => "Disable",
        "options" => array("Disable", "Enable")),

    array("name" => "Disable/Enable Footer Menu",
        "desc" => "Choose to enable or disable the footer menu",
        "id" => $shortname . "_footermenu",
        "type" => "select",
        "std" => "Disable",
        "options" => array("Disable", "Enable")),

    array("name" => "Copyright Information",
        "desc" => "Enter your own copyright credit line.",
        "id" => $shortname . "_copyright",
        "std" => "Copyright &copy; 2014 All Rights Reserved. Powered by WordPress 4.0",
        "type" => "textarea"),

    array("name" => "Google Analytics Code",
        "desc" => "Enter your own Google Analytics code.",
        "id" => $shortname . "_google",
        "std" => "",
        "type" => "textarea"),


    array("type" => "close")

);


function ptstheme_add_admin()
{

    global $themename, $shortname, $options;

    if ($_GET['page'] == basename(__FILE__)) {

        if ('save' == $_REQUEST['action']) {

            foreach ($options as $value) {
                update_option($value['id'], $_REQUEST[$value['id']]);
            }

            foreach ($options as $value) {
                if (isset($_REQUEST[$value['id']])) {
                    update_option($value['id'], $_REQUEST[$value['id']]);
                } else {
                    delete_option($value['id']);
                }
            }

            header("Location: admin.php?page=functions.php&saved=true");
            die;

        } else if ('reset' == $_REQUEST['action']) {

            foreach ($options as $value) {
                delete_option($value['id']);
            }

            header("Location: admin.php?page=functions.php&reset=true");
            die;

        }
    }

    if (function_exists('add_object_page')) {
        $file_dir = get_template_directory_uri();
        add_object_page($themename, $themename, 'administrator', basename(__FILE__), 'ptstheme_admin', $file_dir . "/functions/images/icon.png");
    } else {
        $file_dir = get_template_directory_uri();
        add_theme_page($themename, $themename, 'administrator', basename(__FILE__), 'ptstheme_admin', $file_dir . "/functions/images/icon.png");
    }
    // add_theme_page(basename(__FILE__), $themename, 'Theme Options', 'administrator', basename(__FILE__), 'ptstheme_admin');

}

function ptstheme_add_init()
{

    $file_dir = get_template_directory_uri();
    wp_enqueue_style("functions", $file_dir . "/functions/css/admin_style.css", false, "1.0", "all");
    wp_enqueue_script("functions", $file_dir . "/functions/js/jscolor/jscolor.js", false, "1.3.1");
    wp_enqueue_script("m_script", $file_dir . "/functions/js/script.js", array('jquery'), "1.0");

}

function ptstheme_admin() {

    global $themename, $shortname, $options;
    $i = 0;

    if ($_REQUEST['saved']) echo '<div id="message" class="updated fade" style="background:#87A85E; border-color:#4C693C; color:#fff; margin-left:5px;"><p><strong>' . $themename . ' settings sucessfully saved.</strong><br><br><img src=""></p></div> ';
    if ($_REQUEST['reset']) echo '<div id="message" class="updated fade" style="background:#5992B5; border-color:#4A6A80; color:#fff; margin-left:5px;"><p><strong>' . $themename . ' settings successfully reset.</strong></p></div>';
    if ($_REQUEST['error']) echo '<div id="message" class="updated fade" style="border-color:#733B2F; background:#B56D6B; color:#fff; margin-left:5px;"><p><strong>An error has occurred in the ' . $themename . ' theme.</strong></p></div>';

    ?>

<?php $file_dir = get_template_directory_uri(); ?>
    <div class="admin-sidebar">
        <?php echo ptstheme_admin_adverts(); ?>
    </div>
    <div class="wrap m_wrap">
        <div id="logo"><img src='<?php echo $file_dir . "/functions/images/logo.png"; ?>' alt="logo"/>

            <h1> <?php echo $themename; ?> Theme Settings </h1></div>

        <div class="m_help">
            <p>
                <strong>Theme Support: </strong>If you are experiencing difficulties with the <?php echo $themename; ?>
                theme, you can setup a membership with www.pixelthemestudio.ca if you do not have one. This gives you
                direct support in addition to the theme setup tutorials located at the site. </p>
        </div>


        <form method="post">
            <div class="m_opts">
                <?php foreach ($options as $value) {
                switch ($value['type']) {

                case "open":
                    ?>

                    <?php break;

                case "close":
                ?>

            </div>
    </div>

<br/>


<?php break;

case "title":
    ?>
    <p>To easily use the <?php echo $themename; ?> theme, you can use the menu below.</p>


    <?php break;

case 'text_colour':
    ?>

    <div class="m_input m_text">
        <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
        <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>"
               value="<?php if (get_option($value['id']) != "") {
                   echo stripslashes(get_option($value['id']));
               } else {
                   echo $value['std'];
               } ?>" class="color"/>
        <small><?php echo $value['desc']; ?></small>
        <div class="clearfix"></div>

    </div>

    <?php break;

case 'text':
    ?>

    <div class="m_input m_text">
        <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
        <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>"
               value="<?php if (get_option($value['id']) != "") {
                   echo stripslashes(get_option($value['id']));
               } else {
                   echo $value['std'];
               } ?>"/>
        <small><?php echo $value['desc']; ?></small>
        <div class="clearfix"></div>

    </div>

    <?php
    break;

case 'textarea':
    ?>

    <div class="m_input m_textarea">
        <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
        <textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols=""
                  rows=""><?php if (get_option($value['id']) != "") {
                echo stripslashes(get_option($value['id']));
            } else {
                echo $value['std'];
            } ?></textarea>
        <small><?php echo $value['desc']; ?></small>
        <div class="clearfix"></div>

    </div>

    <?php
    break;

case 'select':
    ?>

    <div class="m_input m_select">
        <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>

        <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
            <?php foreach ($value['options'] as $option) { ?>
                <option <?php if (get_option($value['id']) == $option) {
                    echo 'selected="selected"';
                } ?>><?php echo $option; ?></option><?php } ?>
        </select>

        <small><?php echo $value['desc']; ?></small>
        <div class="clearfix"></div>
    </div>

    <?php

    break;
case "radio":
    ?>
    <div class="m_input m_select">
        <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
        <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="radio"
               value="<?php echo $value['value']; ?>" <?php echo $selector; ?> <?php if ($get_options[$id] == $value['value'] || $get_options[$id] == "") {
            echo 'checked="checked"';
        } ?> /> <?php echo $value['desc']; ?>&nbsp; &nbsp;
        <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>_2" type="radio"
               value="<?php echo $value['value2']; ?>" <?php echo $selector; ?> <?php if ($get_options[$id] == $value['value2']) {
            echo 'checked="checked"';
        } ?> /> <?php echo $value['desc2']; ?>
        <small><?php echo $value['desc']; ?></small>
        <div class="clearfix"></div>
    </div>

    <?php
    break;

case "checkbox":
    ?>

    <div class="m_input m_checkbox">
        <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>

        <?php if (get_option($value['id'])) {
            $checked = "checked=\"checked\"";
        } else {
            $checked = "";
        } ?>
        <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"
               value="true" <?php echo $checked; ?> />


        <small><?php echo $value['desc']; ?></small>
        <div class="clearfix"></div>
    </div>
    <?php break;
case "section":

$i++;

?>

<div class="m_section">
    <div class="m_title"><h3><img src="<?php echo get_template_directory_uri(); ?>/functions/images/trans.png"
                                  class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input
                name="save<?php echo $i; ?>" type="submit" value="Save changes"/>
</span>

        <div class="clearfix"></div>
    </div>
    <div class="m_options">


        <?php break;

        }
        }
        ?>

        <p class="submit">
            <input name="save" type="submit" value="Save all changes"/>
            <input type="hidden" name="action" value="save"/>
        </p>
        </form>
        <form method="post">
            <p class="submit">
                <input name="reset" type="submit" value="Reset"/>
                <input type="hidden" name="action" value="reset"/>
            </p>
        </form>
    </div>


<?php
}
?>
<?php
add_action('admin_init', 'ptstheme_add_init');
add_action('admin_menu', 'ptstheme_add_admin');

//remove wordpress default gallery styling
add_filter('use_default_gallery_style', '__return_false');
if (!isset($content_width)) $content_width = 430;

$args = array(
    'width' => 940,
    'height' => 300,
    'default-image' => '',
    'uploads' => true,
    'header-text' => false,
);
add_theme_support('custom-header', $args);

$args = array(
    'default-image' => get_stylesheet_directory_uri() . '/images/bg.png',
    'default-repeat' => 'repeat-x',
);
add_theme_support('custom-background', $args);
function my_theme_add_editor_styles()
{
    add_editor_style(get_stylesheet_directory_uri() . '/css/editor.css');
}

add_action('after_setup_theme', 'my_theme_add_editor_styles');

function html_validate($text)
{
    $withthis = 'rel="tag"';
    $replacethis = 'rel="category tag"';
    $text = str_replace($replacethis, $withthis, $text);

    return $text;
}

add_filter('the_category', 'html_validate');

function eveningshade_wp_title( $title, $sep ) {
    global $paged, $page;

    if ( is_feed() )
        return $title;

    // Add the site name.
    $title .= ' '.get_bloginfo( 'name' );

    //if is normal page or post


    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title = "$title $sep $site_description";

    // Add a page number if necessary.
    if ( $paged >= 2 || $page >= 2 )
        $title = "$title $sep " . sprintf( __( 'Page %s', 'ga' ), max( $paged, $page ) );

    return $title;
}
add_filter( 'wp_title', 'eveningshade_wp_title', 10, 2 );