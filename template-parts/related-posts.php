<?php 
// مشخصات پست جاری را بدست می‌آوریم
$current_post_id = get_the_ID();
$current_post_categories = wp_get_post_categories($current_post_id);
$current_post_tags = wp_get_post_tags($current_post_id);

// پیدا کردن مطالب مرتبط با پست جاری
$related_args = array(
    'post_type' => 'post',
    'post__not_in' => array($current_post_id),
    'tax_query' => array(
        'relation' => 'OR',
        array(
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => $current_post_categories,
        ),
        array(
            'taxonomy' => 'post_tag',
            'field' => 'term_id',
            'terms' => wp_list_pluck($current_post_tags, 'term_id'),
        ),
    ),
);

$related_query = new WP_Query($related_args);

// نمایش مطالب مرتبط
if ($related_query->have_posts()) {
    echo '<h2>مطالب مرتبط</h2>';
    echo '<ul>';
    while ($related_query->have_posts()) {
        $related_query->the_post();
        echo '<li><a class="i8-blink" href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
    }
    echo '</ul>';
    wp_reset_postdata();
} else {
    echo 'مطلب مرتبطی یافت نشد.';
}
?>
