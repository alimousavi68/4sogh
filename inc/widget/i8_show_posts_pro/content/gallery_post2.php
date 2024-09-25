<?php
echo $args['before_widget'];

echo '<div class="text-title box-title  ' . $head_font_size . ' fw-7 m-0 me-lg-2 me-md-2">';
if ($hide_title != 'on') {
    echo $args['before_title'] . $icon_print . $title  .  $args['after_title'];
}
echo $sub_title_print . '</div>';



// نمایش محتویات ویجت- نمایش پست ها
$category_posts2 = new WP_Query(array(
    'posts_per_page' => $num,
    'cat'            => $cat,
    'order' => 'DESC',
    'orderby' => $orderby
));
echo '<div class="row gallery">';
if ($category_posts2->have_posts()) {
    echo '<div class="col-xl-24 col-md-24 col-sm-24 col-24 row px-0">';
    while ($category_posts2->have_posts()) {
        $category_posts2->the_post();
        $primary_cat = get_post_meta(get_the_ID(), 'hasht_primary_category');
        // $primary_cat_color = get_term_meta($primary_cat[0], 'i8_CustomTerm_color', true) ? get_term_meta($primary_cat[0], 'i8_CustomTerm_color', true) : '#000000';
        // $primary_cat_color_transparent = $primary_cat_color . 'c4';
    ?>
        <div class='<?php echo $col; ?> px-0 px-xl-2 px-lg-2 px-md-2'>
            <div class="post-flip-box-container" class="image_frame">
                <?php echo i8_the_thumbnail('i8-lg-290-163', 'post-flip-box-image object-fit-cover' . $thumb_radius, array("width" => 303, "height" => 190)); ?>

                <div class="post-flip-box-link-wrapper">
                    <a href="<?php echo get_the_permalink(); ?>" class="post-flip-box-link i8-blink" aria-label="<?php echo get_the_title(); ?>"></a>
                </div>
                <div class="post-flip-box-overlay d-flex align-items-end">
                    <h2 class="post-flip-box-title0">
                        <a class="<?php echo $title_font_size; ?> <?php echo $title_font_weight; ?> i8-blink post-flip-box-link l1 fd-7 text-white" href="<?php echo get_the_permalink(); ?>"><?php i8_limit_text(get_the_title(), 72, '...'); ?></a>
                    </h2>
                </div>
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