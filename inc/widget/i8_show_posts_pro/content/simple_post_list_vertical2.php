<?php
echo $args['before_widget'];
if ($hide_title != 'on') { ?>
    <div
        class="col-24 col-lg-4 col-md-4 col-xl-4 d-flex flex-row flex-xl-column flex-lg-column flex-md-column gap-0 justify-content-between justify-content-xl-start justify-content-lg-start justify-content-md-start px-0 px-2 px-lg-0 px-md-0 px-xl-0  align-items-start">
        <p class="box-title <?php echo $head_font_size; ?> fw-7 mb-1">
            <?php echo $args['before_title'] . $icon_print . $title . $args['after_title']; ?>
        </p>
        <p class=" f14 fw-4 text-grey mb-3  d-none d-xl-block d-lg-block d-md-block">
            <?php echo $sub_title_print; ?>
        </p>
        <p class="display-5 fw-4 mb-2 ">
            <a class="cat_btn_link i8-blink" href="<?php echo get_category_link($cat); ?>">دیدن همه</a>
        </p>
    </div>




    
<?php } ?>

<?php
// نمایش محتویات ویجت- نمایش پست ها
$category_posts = new WP_Query(
    array(
        'posts_per_page' => $num,
        'cat' => $cat,
        'order' => 'DESC',
        'orderby' => $orderby
    )
);

echo '<div class="col-24 col-xl-20 col-lg-20 col-md-20 d-flex flex-row flex-wrap px-0 py-2">';
echo '<div class="row">';
if ($category_posts->have_posts()) {
    while ($category_posts->have_posts()) {
        $category_posts->the_post();
        ?>
        <div class="<?php echo $col; ?> col-12 d-flex flex-column gap-2 px-2 px-xl-2 px-lg-2">
            <a href="<?php the_permalink(); ?>" class="image_frame_2">
                <?php echo i8_the_thumbnail('i8-lg-290-163', 'multi-item-thumb hover w-100 i8-img-fit', $dimenition = array('width' => $thumb_width , 'height' => $thumb_height), true, '', false, true); ?>
            </a>
            
            <div class="d-flex flex-column gap-1">
                <div class="title-box">
                    <h1 class="post-title <?php echo $title_font_size; ?> <?php echo $title_font_weight; ?>  l1">
                        <a href="<?php echo get_the_permalink(); ?>" class="i8-blink">
                            <?php i8_limit_text(get_the_title(), 75, '...'); ?>
                        </a>
                    </h1>
                </div>
                <p class="post-publish-date f12 text-end text-subtitle my-0">
                    <?php the_date() ?>
                </p>
            </div>

        </div>
        <?php
    }
    wp_reset_postdata();
}
echo '</div>';
echo '</div>';

echo $args['after_widget'];

?>