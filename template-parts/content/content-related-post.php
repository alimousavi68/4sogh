<div class="related-post border-bottom mb-2">
    <div class="title-icon d-flex align-items-center mb-3 align-items-center">
        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M5.33301 21.3467L5.34634 21.3319" stroke="#FF9900" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M5.33301 26.6801L5.34634 26.6653" stroke="#FF9900" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M5.33301 10.6801L5.34634 10.6653" stroke="#FF9900" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M5.33301 5.34672L5.34634 5.33191" stroke="#FF9900" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M5.33301 16.0133L5.34634 15.9985" stroke="#FF9900" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M10.666 26.6801L10.6793 26.6653" stroke="#FF9900" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M16 26.6801L16.0133 26.6653" stroke="#FF9900" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M21.333 26.6801L21.3463 26.6653" stroke="#FF9900" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M26.666 26.6801L26.6793 26.6653" stroke="#FF9900" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M26.666 21.3467L26.6793 21.3319" stroke="#FF9900" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M26.666 16.0133L26.6793 15.9985" stroke="#FF9900" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M26.666 10.6801L26.6793 10.6653" stroke="#FF9900" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M26.666 5.34672L26.6793 5.33191" stroke="#FF9900" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M21.333 5.34672L21.3463 5.33191" stroke="#FF9900" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M16 5.34672L16.0133 5.33191" stroke="#FF9900" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M10.666 5.34672L10.6793 5.33191" stroke="#FF9900" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
            <path
                d="M23.3751 18.0626C23.3751 16.6536 22.8154 15.3023 21.8191 14.3061C20.8228 13.3098 19.4716 12.7501 18.0626 12.7501H14.8751V9.63481C14.8751 9.53387 14.8463 9.43502 14.7921 9.34985C14.7379 9.26468 14.6606 9.19671 14.5692 9.1539C14.4777 9.11109 14.376 9.09521 14.2759 9.10812C14.1758 9.12104 14.0814 9.16221 14.0039 9.22681L8.98886 13.4046C8.92908 13.4544 8.88098 13.5168 8.84797 13.5873C8.81496 13.6578 8.79785 13.7347 8.79785 13.8126C8.79785 13.8904 8.81496 13.9673 8.84797 14.0378C8.88098 14.1083 8.92908 14.1707 8.98886 14.2206L14.0039 18.3983C14.0814 18.4629 14.1758 18.5041 14.2759 18.517C14.376 18.5299 14.4777 18.514 14.5692 18.4712C14.6606 18.4284 14.7379 18.3604 14.7921 18.2753C14.8463 18.1901 14.8751 18.0913 14.8751 17.9903V14.8751H18.0626C18.908 14.8751 19.7187 15.2109 20.3165 15.8087C20.9143 16.4064 21.2501 17.2172 21.2501 18.0626V23.3751H23.3751V18.0626Z"
                fill="#FF9900" />
        </svg>

        <p class="text-blue box-title f24 fw-7 m-0 me-2">مطالب مرتبط</p>
    </div>
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
        echo '<div class="row d-flex flex-wrap">';
        while ($related_posts->have_posts()) {
            $related_posts->the_post();
            ?>
           
            <div
                class="mini-article d-flex col-md-12 col-sm-24 pb-3 mb-3 px-0 ">
                <div width="<?php echo $thumb_width; ?>" height="<?php echo $thumb_height; ?>">

                    <a href="<?php the_permalink(); ?>" class="image_frame">
                        <?php echo i8_the_thumbnail('i8-sm-100-75', 'hover', $dimenition = array('width' => 100, 'height' => 75), true, '', false, true); ?>
                    </a>

                </div>
                <div class="d-flex flex-column ">
                    <h4 class="me-2 l22-05 post-title">
                        <a class="i8-blink display-4 fw-4 l1"
                            href="<?php echo get_the_permalink(); ?>">
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
        echo '</div>';
    }

    // بازنشانی پست فعلی
    wp_reset_postdata();
    ?>



</div>