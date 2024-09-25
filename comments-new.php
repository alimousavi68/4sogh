<?php global $qaleb; ?>
<?php
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))

    die('Please do not load this page directly. Thanks!');
if (post_password_required()) { ?>

    <p class="nocomments">این مطلب خصوصی است.در صورتی که رمز آن را دارید در قسمت زیر وارد کنید.</p>
<?php

    return;
}

?>



<!-- You can start editing here. -->
<?php if (have_comments()) : ?>
    <div class="single_article sended_commnet">
        <ul class="commentlist">
            <?php wp_list_comments(array('callback' => 'mytheme_comment')); ?>
        </ul><!-- commentlist -->


        <div class="navigation">
            <div class="alignleft">
                <?php previous_comments_link() ?>
            </div>
            <div class="alignright">
                <?php next_comments_link() ?>
            </div>
        </div>

    </div><!-- End single_article -->


<?php else : // this is displayed if there are no comments so far 
?>
    <?php if ('open' == $post->comment_status) : ?>
        <!-- If comments are open, but there are no comments. -->
    <?php else : // comments are closed 
    ?>
        <!-- If comments are closed. -->
        <p class="nocomments">دیدگاه بسته شده است.</p>
    <?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>
    <div class="box_wrapper">
        <div class="cm_wrapper">
            <?php if (get_option('comment_registration') && !@$user_ID) : ?>
                <p><i class="fa fa-lock" aria-hidden="true"></i> شما باید <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">وارد سایت شوید</a> تا بتوانید نظر دهید.</p>
            <?php else : ?>
                <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
                    <?php if (@$user_ID) : ?>
                        <p><i class="fa fa-unlock" aria-hidden="true"></i> وارد شده به نام <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">خروج &raquo;</a></p>
                    <?php else : ?>
                        <p>
                            <input type="text" placeholder="نام شما :" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
                            <label for="author"></label>
                        </p>

                        <p>
                            <input type="text" placeholder="پست الکترونیکی :" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
                            <label for="email"></label>
                        </p>
                    <?php endif; ?>
                    <p>
                        <textarea type="text" placeholder="متن پیام شما :" name="comment" id="comment" class="comment_textarea" cols="100%" rows="10" tabindex="4"></textarea>
                    </p>
                    <input name="submit" type="submit" id="submit" tabindex="5" value="ثبت دیدگاه" />

                    <?php comment_id_fields(); ?>
                    <?php do_action('comment_form', $post->ID); ?>
                </form>

            <?php endif; // If registration required and not logged in 
            ?>

        </div><!-- /cm_wrapper -->
    </div><!-- End box_wrapper -->

<?php endif; // if you delete this the sky will fall on your head 
?>