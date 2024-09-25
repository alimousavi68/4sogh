<?php
echo $args['before_widget'];

echo '<div class="text-title box-title  ' . $head_font_size . ' fw-7 m-0 me-lg-2 me-md-2">';
if ($hide_title != 'on') {
  // echo $args['before_title'] . $title . $args['after_title'];
  echo $args['before_title'] . $icon_print . $title . $args['after_title'];
}
echo $sub_title_print . '</div>';


echo '<div class="row row-gap-3">';
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
    if (($category_posts->current_post + 1) === 1):
      ?>
      <div
        class="news-card col-xl-13 col-md-13 col-sm-24 text-xl-end text-lg-end text-md-end text-sm-center d-flex flex-column row-gap-2 image_frame px-1 px-xl-3 px-lg-3 px-md-3 ">
        <a href="<?php the_permalink(); ?>" class="image_frame">
          <?php echo i8_the_thumbnail('i8-xl-430-242', 'single-item-thumb hover w-100 i8-img-fit', $dimenition = array('width' => $thumb_width, 'height' => $thumb_height), true, '', false, true); ?>
        </a>
        <h2 class="post-title display-3 fw-7 l1">
          <a href="<?php echo get_the_permalink(); ?>" class="i8-blink">
            <?php i8_limit_text(get_the_title(), 120, '...'); ?>
          </a>
        </h2>

        <p class="post-publish-date f12 text-end text-subtitle my-0">
          <?php the_date() ?>
        </p>
      </div>
      <div class="col-xl-11 col-md-11 col-sm-24 row px-1 px-xl-2 px-lg-2 px-md-2 ">
      <?php endif;
    if (($category_posts->current_post + 1) > 1):
      ?>
        <div
          class="<?php echo $col; ?>  mini-article d-flex   <?php echo ($category_posts->current_post + 1 == $category_posts->post_count) ? '' : 'border-bottom'; ?> pb-3 mb-3 px-0 ">
          <div>

            <a href="<?php the_permalink(); ?>" class="image_frame">
              <?php echo i8_the_thumbnail('i8-sm-100-75', 'hover', $dimenition = array('width' => 100, 'height' => 70), true, '', false, true); ?>
            </a>

          </div>
          <div class="d-flex flex-column ">
            <h3 class="me-2 l22-05 post-title">
              <a class="i8-blink <?php echo $title_font_size; ?> <?php echo $title_font_weight; ?> l1"
                href="<?php echo get_the_permalink(); ?>">
                <?php i8_limit_text(get_the_title(), 72, '...'); ?>
              </a>
            </h3>
            <p class="post-publish-date f12 text-end text-subtitle my-0 me-2">
              <?php the_date() ?>
            </p>
          </div>

        </div>
        <?php
    endif;
    wp_reset_postdata();
  }
}
echo '</div>';
echo '</div>';

echo $args['after_widget'];

?>