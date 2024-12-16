<?php
// دریافت برچسب‌های مرتبط با پست فعلی
$post_tags = wp_get_post_tags(get_the_ID(), array('fields' => 'ids'));

// دریافت دسته‌بندی‌های مرتبط با پست فعلی
$post_categories = wp_get_post_categories(get_the_ID(), array('fields' => 'ids'));
$num = 6;
// ساخت آرایه از آرگومان‌های برای بازیابی خبرهای مرتبط
$args = array(
    'post__not_in' => array(get_the_ID()), // عدم دریافت خود پست فعلی
    'posts_per_page' => $num,
    'orderby' => 'date',
    'order' => 'DESC',
    'tax_query' => array(
        'relation' => 'OR',
        array(
            'taxonomy' => 'post_tag',
            'field' => 'id',
            'terms' => $post_tags,
        )
    ),
);

// اجرای پرس و جو برای بازیابی خبرهای مرتبط
$related_posts = new WP_Query($args);

// نمایش خبرهای مرتبط
if ($related_posts->have_posts()) {
    ?>
    <div class="related-post  mb-2 ">
        <div class="title-icon d-flex align-items-center mb-1 align-items-center bg-secondary cornner-tr p-2">
            <p class="f17 m-0 me-2 icon-before-qoute">مطالب مرتبط</p>
        </div>
        <?php
        echo '<div class="row d-flex flex-wrap box p-4">';
        while ($related_posts->have_posts()) {
            $related_posts->the_post();
            ?>

            <div class="mini-article d-flex col-md-12 col-sm-24 pb-3 mb-3 px-0 ">
                <div width="<?php echo $thumb_width; ?>" height="<?php echo $thumb_height; ?>">

                    <a href="<?php the_permalink(); ?>" class="image_frame">
                        <?php echo i8_the_thumbnail('i8-sm-100-75', 'hover', $dimenition = array('width' => 100, 'height' => 75), true, '', false, true); ?>
                    </a>

                </div>
                <div class="d-flex flex-column ">
                    <h4 class="me-2 l22-05 post-title ">
                        <a class="i8-blink display-4 fw-4 l1" href="<?php echo get_the_permalink(); ?>">
                            <?php i8_limit_text(get_the_title(), 72, '...'); ?>
                        </a>
                    </h4>
                    <p class="post-publish-date f12 text-end text-subtitle my-0 me-2">
                        <?php the_date() ?>
                    </p>
                </div>

            </div>

            <?php
        }
        echo '</div></div>';
}

// بازنشانی پست فعلی
wp_reset_postdata();
?>



