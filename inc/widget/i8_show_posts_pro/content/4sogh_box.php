<?php

echo $args['before_widget'];
echo '<div class="widget-container">';

if ($hide_title != 'on') {
  echo '<div class="widget-header d-flex align-items-center justify-content-between cornner-tr">';
  echo '<div class="widget-title d-flex align-items-center gap-2 justify-content-start">';
  echo $args['before_title'] . $icon_print . '<span class="fw-6 '. $head_font_size .' icon-before-qoute">' . $title . '</span>' . $args['after_title'];
  echo '</div>';
  echo '<div class="link-to-archive"><a href="'. get_category_link($cat) .'" class="fw-1 fs-6">بیشتر...</a></div></div>';
}
?>

<div class="widget-body row">
  <div class="col-24 col-lg-17 col-sm-15 row px-0">
    <div class="col-24 col-lg-10 d-flex flex-column gap-3 mb-4 mb-lg-0 order-1 order-md-0 px-0 px-lg-2">
      <?php

      $category_posts2 = new WP_Query(
        array(
          'posts_per_page' => 1,
          'cat' => $cat,
          'order' => 'DESC',
          'orderby' => $orderby
        )
      );

      // left
      if ($category_posts2->have_posts()) { ?>
        <?php
        while ($category_posts2->have_posts()) {
          $category_posts2->the_post();
          ?>

          <span class="fw-1 fs-6 text-justify">
            <?php
            echo get_post_meta(get_the_ID(), '_post_subtitle', true);
            ?>
          </span>

          <a href="<?php echo get_the_permalink(); ?>" class="i8-blink fs-2 fw-9 l2 text-">
            <?php i8_limit_text(get_the_title(), 200, '...'); ?>
          </a>

          <?php if ($hide_excerpt != 'on'): ?>
            <p class="l2 fw-3 fs-6 text-justify mb-0">
              <?php i8_limit_text(get_the_excerpt(), 300, '...'); ?>
            </p>
            <a href="<?php echo get_the_permalink(); ?>" class="d-flex justify-content-end">ادامه مطلب..</a>
          <?php endif; ?>

        </div>
        <div class="col-24 col-lg-14 overflow-hidden pe-0 ps-lg-3 px-0">
          <a href="<?php the_permalink(); ?>" class="image_frame">
            <?php echo i8_the_thumbnail('i8-500-280', 'hover multi-item-thumb w-100 i8-img-fit', array("width" => '100%', "height" => 'auto'), true, '', false, true); ?>
          </a>
        </div>
      </div>

      <?php
        }
        wp_reset_postdata();
      }

      // نمایش محتویات ویجت- نمایش پست ها
      $category_posts = new WP_Query(
        array(
          'posts_per_page' => $num - 1,
          'cat' => $cat,
          'order' => 'DESC',
          'offset' => 1,
          'orderby' => $orderby
        )
      );
      ?>


  <div class="col-24 col-lg-7 col-sm-9">
    <ul class="p-0 i8-list-items">
      <?php
      if ($category_posts->have_posts()) { ?>
        <?php
        while ($category_posts->have_posts()) {
          $category_posts->the_post();
          ?>

          <li>
            <a href="<?php echo get_the_permalink(); ?>" class="i8-blink">
              <?php i8_limit_text(get_the_title(), 200, '...'); ?>
            </a>
          </li>


          <?php
        }
        wp_reset_postdata();
      }
      ?>
    </ul>
  </div>

</div>
</div>



<?php
echo $args['after_widget'];
?>