<?php
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">


    <div class="box mb-3">  
        <?php
        comment_form(array(
            'comment_notes_before' => '',
            'comment_notes_after' => '',
            'title_reply' => '',
            'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
            'title_reply_after' => '</h3>',
            'cancel_reply_link' => __('انصراف از پاسخ', 'theme-text-domain'),
        ));
        ?>
    </div>


    <?php if (have_comments()) : ?>
        <span class="text-grey f16 me-2 mb-1 comments-title">
            <?php
            $comments_number = get_comments_number();
            printf( '%s نظر برای این مطلب ثبت شده است: ', $comments_number); 
            ?>
        </span  >  

        <div class="row mx-0 d-flex row-gap-3 overflow-hidden">
            <?php
            wp_list_comments(array(
                'style' => 'ol',
                'avatar_size' => 60,
                'short_ping' => true,
                'callback' => 'theme_comment_callback'
            ));
            ?>
        </div>

        <?php
        the_comments_pagination(array(
            'prev_text' => '<span class="screen-reader-text">' . esc_html__('Previous', 'theme-text-domain') . '</span>',
            'next_text' => '<span class="screen-reader-text">' . esc_html__('Next', 'theme-text-domain') . '</span>',
        ));
        ?>

    <?php endif; ?>

    <?php
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
    ?>
        <p class="no-comments"><?php esc_html_e('نظرات بسته شده است', 'theme-text-domain'); ?></p>
    <?php endif; ?>


</div><!-- #comments -->

<?php
function theme_comment_callback($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;

    // نمایش قسمت های مورد نظر از نظر
    printf(
        '<div %s>',
        comment_class(array('comment-item d-flex comment col-24 box comments row-gap-3', 'depth-' . $depth), $comment->comment_ID, '', false)
    );

    if ($args['avatar_size'] != 0) {
        // echo get_avatar($comment, array('class' => ''));
        echo get_avatar(get_the_author_meta('ID'), $size = '60', $default = '', $alt = '', array('class' => 'comment-avatar rounded-circle'), $args['avatar_size']);
    }

    echo '<div class="w-100"><div class="d-flex justify-content-between align-items-center me-2">';
    printf(
        '<p class="text-grey fw-7 mb-0">%s</p>',
        get_comment_author_link()
    );

    echo ('<div class="d-flex">');
    comment_reply_link(
        array_merge(
            $args,
            array(
                'depth'         => $depth,
                'max_depth'     => $args['max_depth'],
                'add_below'     => 'comment',
                'respond_id'    => 'respond',
                'reply_text'    => __('پاسخ دادن'),
                'reply_to_text' => __('پاسخ دادن به %s'),
                'login_text'    => __('ورود برای پاسخ دادن'),
                'before'        => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="var(--i8-light-primary )" class="bi bi-reply-all" viewBox="0 0 16 16"><path d="M8.098 5.013a.144.144 0 0 1 .202.134V6.3a.5.5 0 0 0 .5.5c.667 0 2.013.005 3.3.822.984.624 1.99 1.76 2.595 3.876-1.02-.983-2.185-1.516-3.205-1.799a8.74 8.74 0 0 0-1.921-.306 7.404 7.404 0 0 0-.798.008h-.013l-.005.001h-.001L8.8 9.9l-.05-.498a.5.5 0 0 0-.45.498v1.153c0 .108-.11.176-.202.134L4.114 8.254a.502.502 0 0 0-.042-.028.147.147 0 0 1 0-.252.497.497 0 0 0 .042-.028l3.984-2.933zM9.3 10.386c.068 0 .143.003.223.006.434.02 1.034.086 1.7.271 1.326.368 2.896 1.202 3.94 3.08a.5.5 0 0 0 .933-.305c-.464-3.71-1.886-5.662-3.46-6.66-1.245-.79-2.527-.942-3.336-.971v-.66a1.144 1.144 0 0 0-1.767-.96l-3.994 2.94a1.147 1.147 0 0 0 0 1.946l3.994 2.94a1.144 1.144 0 0 0 1.767-.96v-.667z" /><path d="M5.232 4.293a.5.5 0 0 0-.7-.106L.54 7.127a1.147 1.147 0 0 0 0 1.946l3.994 2.94a.5.5 0 1 0 .593-.805L1.114 8.254a.503.503 0 0 0-.042-.028.147.147 0 0 1 0-.252.5.5 0 0 0 .042-.028l4.012-2.954a.5.5 0 0 0 .106-.699z" /></svg>',
                'after'         => ''
            )
        )
    );

    printf('<p class="f13 text-gray me-2 mb-0">%s</p>', get_comment_date('d F Y'));
    echo '</div></div>';
    echo ' <p class="me-2 f14 mt-1">';
    edit_comment_link(esc_html__('(ویرایش)', 'theme-text-domain'), ' ');
    echo '<br/>';
    echo get_comment_text();

    if ($comment->comment_approved == '0') {
        echo '<br/>';
        echo '<em class="comment-awaiting-moderation">' . esc_html__('نظر شما در انتظار تایید است.', 'theme-text-domain') . '</em><br/>';
    }
    echo '</p>';


    echo '</div></div>';
}
