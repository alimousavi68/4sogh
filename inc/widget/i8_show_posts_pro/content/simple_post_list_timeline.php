<?php
echo $args['before_widget'];

echo '<div class="text-title box-title fs-5 bg-secondary cornner-tr py-2 px-3 fw-5  ' . $head_font_size . ' fw-7 m-0">';
if ($hide_title != 'on') {
    // echo $args['before_title'] . $title . $args['after_title'];
    echo $args['before_title'] . $icon_print . $title . $args['after_title'];
}
echo $sub_title_print . '</div>';
?>
<style>
    .timeline-item {
        padding: 3em 1.2em 1.1em;
        position: relative;
        color: rgba(0, 0, 0, 0.7);
        border-right: 2px solid #E5E5E5;
    }

    .timeline-item p {
        font-size: 1rem;
    }

    .timeline-item::before {
        content: attr(date-is);
        position: absolute;
        right: 1.2em;
        font-weight: bold;
        top: 1em;
        display: block;
        font-weight: 700;
        font-size: 0.785rem;
    }

    .timeline-item::after {
        width: 10px;
        height: 10px;
        display: block;
        top: 1em;
        position: absolute;
        right: -7px;

        content: "";
        border: 2px solid var(--i8-light-complete-color);
        background: white;
    }

    .timeline-item:last-child {
        -o-border-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.3) 60%, rgba(0, 0, 0, 0)) 1 100%;
        border-image: linear-gradient(to bottom, rgba(229, 229, 229, 1) 60%, rgba(229, 229, 229, 0)) 1 100%;
    }
</style>
<div class="timeline_list pe-3 pe-lg-4 pe-xl-4 pe-md-4 box mt-2 py-4 px-2">
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

    if ($category_posts->have_posts()) {
        while ($category_posts->have_posts()) {
            $category_posts->the_post();
            ?>
            <!-- //echo wordpress post date in this template : 6min ago -->

            <div class="timeline-item"
                date-is='<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' پیش'; ?>'>
                <a class="i8-blink <?php echo $title_font_size; ?>  <?php echo $title_font_weight; ?> l22-05 text-normal cursor-pointer text-grey"
                    href="<?php echo get_the_permalink(); ?>">
                    <?php
                    show_post_structure_related_icon(get_the_ID());
                    i8_limit_text(get_the_title(), 100, '...'); ?>
                    
                </a>
                <?php if ($hide_excerpt != 'on'): ?>
                    <p>
                        <?php i8_limit_text(get_the_excerpt(), 100, '...'); ?>
                    </p>
                <?php endif; ?>
            </div>

            <?php
        }
        wp_reset_postdata();
    }

    echo '</div>';
    echo $args['after_widget'];


    ?>