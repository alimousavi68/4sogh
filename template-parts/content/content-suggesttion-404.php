<div >
    <div class="title-icon d-flex align-items-center mb-3 align-items-center justify-content-center mb-5">
    <?php
    $svg= '<?xml version="1.0" encoding="UTF-8"?><svg width="32px" height="32px" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#000000"><circle cx="12" cy="12" r="8" stroke="#000000" stroke-width="1.5"></circle><path d="M19.812 12.99c1.813 1.51 2.755 2.864 2.362 3.651-.731 1.467-5.805.42-11.333-2.336C5.312 11.55 1.423 8.126 2.154 6.66c.392-.786 2.033-.85 4.322-.315" stroke="#000000" stroke-width="1.5"></path></svg>';
    $color='var(--i8-light-primary )';
    echo customizeSVG($svg,$color,$color); ?>
    <p class="text-blue f24 fw-7 m-0 me-2">مطالب  پیشنهادی برای شما</p>
    </div>
    <?php
    $cat = -1;
    $count = 21;
    // ساخت آرایه از آرگومان‌های برای بازیابی خبرهای مرتبط
    $args = array(
        'post__not_in' => array(get_the_ID()), // عدم دریافت خود پست فعلی
        'posts_per_page' => $count,
        'cat' => $cat,
        'orderby' => 'date',
        'order' => 'DESC',
    );

    // اجرای پرس و جو برای بازیابی خبرها
    $sponsored_posts = new WP_Query($args);

    // نمایش خبرها 
    if ($sponsored_posts->have_posts()) {
        echo '<div class="row d-flex flex-wrap">';
        while ($sponsored_posts->have_posts()) {
            $sponsored_posts->the_post();
    ?>
            <div class="mini-article d-flex col-md-8 col-sm-24 mb-3">
                <a href="<?php the_permalink(); ?>" class="image_frame"><?php echo i8_the_thumbnail('i8-sm-130-88', 'ms-2 hover'); ?></a>
                <a class="text-grey i8-blink" href="<?php echo the_permalink(); ?>" class="f15 me-2 l22-05"><?php echo get_the_title(); ?></a>
            </div>
    <?php
        }
        echo '</div>';
    }

    // بازنشانی پست فعلی
    wp_reset_postdata();
    ?>



</div>