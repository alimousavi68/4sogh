<?php
echo $args['before_widget'];
echo '<div class="row box mx-0 d-flex row-gap-3 ">';
if ($hide_title != 'on') {
    
    echo '<p class="text-title f24 fw-7 m-0 me-2">';
    echo $args['before_title'] . $icon_print . $title  .  $args['after_title'];
    echo $sub_title_print . '</p></div>';
}

// نمایش محتویات ویجت- نمایش پست ها
$category_posts = new WP_Query(array(
    'posts_per_page' => $num,
    'cat'            => $cat,
    'order' => 'DESC',
    'orderby'=> $orderby
));

if ($category_posts->have_posts()) {
    while ($category_posts->have_posts()) {
        $category_posts->the_post();
?>
        <div class="mini-article d-flex <?php echo $col; ?>  px-0 px-xl-2 px-lg-2 px-md-2 align-items-center">
            <a href="<?php the_permalink(); ?>" class="image_frame"><?php echo i8_the_thumbnail('i8-sm-130-88', 'hover', 67); ?></a>
            <a class="f15 me-2 l22-05 text-grey i8-blink" href="<?php echo get_the_permalink(); ?>"><?php i8_limit_text(get_the_title(), 72, '...'); ?></a>
        </div>
<?php
    }
    wp_reset_postdata();
}
echo '</div>';

echo $args['after_widget'];

?>