<?php global $qaleb;?>
<?php
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');
if ( post_password_required() ) { ?>
<p class="nocomments">این مطلب خصوصی است.در صورتی که رمز آن را دارید در قسمت زیر وارد کنید.</p>
<?php
return;
}
?>
<!-- You can start editing here. -->
<?php if ( have_comments() ) : ?>
<div class="single_article sended_commnet">
<ul class="commentlist">
<?php wp_list_comments( array( 'callback' => 'mytheme_comment' ) ); ?>
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
<?php else : // this is displayed if there are no comments so far ?>
<?php if ('open' == $post->comment_status) : ?>
<!-- If comments are open, but there are no comments. -->
<?php else : // comments are closed ?>
<!-- If comments are closed. -->
<p class="nocomments">دیدگاه بسته شده است.</p>
<?php endif; ?>
<?php endif; ?>
<?php if ($comment->comment_approved == '0') : ?><div class="comment_ta"><?php printf('%s عزیز ، ', get_comment_author_link()) ?><?php echo 'دیدگاه شما ارسال شد و بعد از تایید مدیر منتشر می شود.'; ?></div><?php endif; ?>		
<?php if ('open' == $post->comment_status) : ?>
<div class="box_wrapper">
<div class="cm_wrapper">
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><i class="fa fa-lock" aria-hidden="true"></i> شما باید <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">وارد سایت شوید</a> تا بتوانید نظر دهید.</p>
<?php else : ?>	
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="comment-form" novalidate>

<?php if ( $user_ID ) : ?>
<div class="in-login">
<i class="fa fa-unlock" aria-hidden="true"></i> وارد شده به نام <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">خروج &raquo;</a>
</div>
<?php else : ?>

<?php endif; ?>
<div class="input-field clearfix">
<textarea id="comment" class="materialize-textarea" name="comment" data-length="1000" aria-required="true"></textarea>
<label for="comment" >دیدگاه خود را اینجا بنویسید</label>
<input type="hidden" name="action" value="ap_submit_comment_ajax" />
</div>
<div class="comment-field-group clearfix">
<div class="comment-form-author input-field">
<input id="author" name="author" type="text" value="<?php echo $comment_author; ?>" size="30" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="author" class="">نام شما</label>
</div>
<div class="comment-form-email input-field ">
<input id="email" name="email" type="email" value="<?php echo $comment_author_email; ?>" size="30" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="email" class="">پست الکترونیکی</label>
</div>
</div>


<?php if($qaleb['comments-from'] == '1'){?>

<?php if($qaleb['comments-law'] == '1'){?>
<button class="accordion"><?php echo $qaleb['comments-law-title']; ?></button>
<div class="panel">
<?php echo $qaleb['single-comment-text']; ?>
</div>
<script type="text/javascript">
var acc = document.getElementsByClassName("accordion");
var i;
for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
} 
</script> 
<?php } ?>
<?php if( function_exists( 'cptch_display_captcha_custom' ) ) { echo "<input type='hidden' name='cntctfrm_contact_action' value='true' />"; echo cptch_display_captcha_custom(); } ?>
<div class="form-submit">
<input name="submit" type="submit" id="submit" tabindex="5" value="ارسال دیدگاه" />
 <input type='hidden' name='comment_post_ID' value='494' id='comment_post_ID' />
<input type='hidden' name='comment_parent' id='comment_parent' value='0' />
</div>
<?php }else{ ?>

<p><a href="#openModal" class="modalsubmit">ارسال دیدگاه</a></p>
<div id="openModal" class="modalDialog">
<div>
<a href="#closed" title="Closed" class="closed">&times;</a>
<h2>از ارسال دیدگاه مطمئن هستید؟</h2>
<?php if($qaleb['comments-law'] == '1'){?>
<p><?php echo $qaleb['comments-law-title']; ?></p>
<?php echo $qaleb['single-comment-text']; ?>
<?php } ?>
<?php if( function_exists( 'cptch_display_captcha_custom' ) ) { echo "<input type='hidden' name='cntctfrm_contact_action' value='true' />"; echo cptch_display_captcha_custom(); } ?>
<div class="form-submit">
<input name="submit" type="submit" id="submit" tabindex="5" value="دیدگاه من را ارسال کن" />
 <input type='hidden' name='comment_post_ID' value='494' id='comment_post_ID' />
<input type='hidden' name='comment_parent' id='comment_parent' value='0' />
</div>
 </div>
</div>
<?php } ?>

<?php comment_id_fields(); ?>   
<?php do_action('comment_form', $post->ID); ?>
</form>
<?php endif; // If registration required and not logged in ?>
</div><!-- /cm_wrapper -->
</div><!-- End box_wrapper -->
<?php endif; // if you delete this the sky will fall on your head ?>