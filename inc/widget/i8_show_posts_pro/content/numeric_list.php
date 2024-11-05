<?php
echo $args['before_widget'];

echo '<div class="text-title box-title  ' . $head_font_size . ' fw-7  m-0">';
if ($hide_title != 'on') {
    // echo $args['before_title'] . $title . $args['after_title'];
    echo $args['before_title'] . $icon_print . $title . $args['after_title'];
}
echo $sub_title_print . '</div>';

echo '<ul class="numeric-list-content d-flex flex-wrap mb-0">';
// نمایش محتویات ویجت- نمایش پست ها
$category_posts = new WP_Query(array(
    'posts_per_page' => $num,
    'cat' => $cat,
));

if ($category_posts->have_posts()) {
    while ($category_posts->have_posts()) {
        $category_posts->the_post();
        $count = $category_posts->current_post + 1;
        ?>

        <li
            class="col-24 col-lg-24 col-md-12 col-sm-12 py-3 py-lg-2 py-md-2 py-xl-2 <?php echo ($category_posts->current_post + 1 == $category_posts->post_count) ? '' : 'border-bottom'; ?>">
            <article class="numeric-list ">
                <div class="numeric-list-item d-flex justify-content-start align-items-top ">
                    <div class="list-title-none">
                        <span class="f24 fw-7 ps-1" style="color:var(--i8-light-primary);">
                            <?php echo $count; ?>
                        </span>
                        <a href="<?php the_permalink(); ?>"
                            class="<?php echo $title_font_size; ?> <?php echo $title_font_weight; ?> i8-blink">
                            <?php i8_limit_text(get_the_title(), 55, '...'); ?>
                        </a>
                    </div>
                </div>
            </article>
        </li>
        <?php
    }
    wp_reset_postdata();
}
echo '</ul>';
echo $args['after_widget'];