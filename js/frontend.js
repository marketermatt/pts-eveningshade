/**
 * Created by jacob on 9/23/14.
 */
jQuery(document).ready(function(){
    jQuery('.gallery-item').hover(function () {
        jQuery(this).find('.gallery-caption').css("display","block");
    }, function () {
        jQuery(this).find('.gallery-caption').fadeOut(500).css("display","none");

    })
});