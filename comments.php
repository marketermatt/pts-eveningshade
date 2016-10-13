<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to eveningshade_comment which is
 * located in the functions.php file.
 * Modified by www.pixelthemestudio.ca
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>


<?php
// You can start editing here -- including this comment!
?>

<?php if (have_comments()) : ?>
    <!-- moved this here from above -->
    <h2 id="comments-title"><?php
        printf(_n('One Response to: %2$s', '%1$s Responses to %2$s', get_comments_number(), 'eveningshade'),
            number_format_i18n(get_comments_number()), '<em>' . get_the_title() . '</em>');
        ?></h2></div>
    <div id="comments">
    <?php if (post_password_required()) : ?>
        <p class="nopassword"><?php _e('This post is password protected. Enter the password to view any comments.', 'eveningshade'); ?></p>
        <!--</div> #comments -->

        <?php
        /* Stop the rest of comments.php from being processed,
         * but don't kill the script entirely -- we still have
         * to fully load the template.
         */
        return;
    endif;
    ?>
    <!-- moved this here from above end -->



    <div class="commentlist">
        <?php
        /* Loop through and list the comments. Tell wp_list_comments()
         * to use eveningshade_comment() to format the comments.
         * If you want to overload this in a child theme then you can
         * define eveningshade_comment() and that will be used instead.
         * See eveningshade_comment() in eveningshade/functions.php for more.
         */
        wp_list_comments(array('callback' => 'eveningshade_comment'));
        ?>
    </div>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // Are there comments to navigate through? ?>
        <div class="navigation">
            <div class="nav-previous"><?php previous_comments_link('<span class="meta-nav">&larr;</span> '.__('Older Comments', 'eveningshade')); ?></div>
            <div class="nav-next"><?php next_comments_link(__('Newer Comments', 'eveningshade').' <span class="meta-nav">&rarr;</span>'); ?></div>
        </div><!-- .navigation -->
    <?php endif; // check for comment navigation ?>

<?php
else : // or, if we don't have comments:

    /* If there are no comments and comments are closed,
     * let's leave a little note, shall we?
     */
    if (!comments_open()) :
        ?>
        <!--<p class="nocomments"><?php //_e( 'Comments are closed.', 'eveningshade' ); ?></p>-->
    <?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php comment_form(); ?>

<!-- #comments -->