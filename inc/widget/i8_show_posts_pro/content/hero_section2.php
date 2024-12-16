<?php
echo $args['before_widget'];

if ($hide_title != 'on') {
  echo '<div class="text-title box-title fs-5 bg-secondary cornner-tr py-2 px-3 fw-5  ' . $head_font_size . ' fw-7 m-0 me-lg-2 me-md-2">';
  echo $args['before_title'] . $icon_print . $title  .  $args['after_title'];
  echo $sub_title_print . '</div>';
}

?>
<style>
  .multi-item {
    height: 240px;
  }

  .single-item-data {
    height: 100%;
  }

  .hero-small-column>div:first-child {
    border-bottom: 1px solid #ccc;
  }
</style>

<?php
// <!-- mainslider-2 Single-Item -->

// نمایش محتویات ویجت- نمایش پست ها
$category_posts = new WP_Query(array(
  'posts_per_page' => 1,
  'cat'            => $cat,
  'order' => 'DESC',
  'orderby' => $orderby
));
if ($category_posts->have_posts()) : ?>
  <div class="border-start col-24 col-lg-12 col-md-12 col-sm-24 col-xl-12 d-flex flex-column gap-0 i8-border-md-none ps-0 ps-lg-2 ps-md-2 px-0 px-sm-0 single-item">
    <?php
    while ($category_posts->have_posts()) :
      $category_posts->the_post();
    ?>
      <a href="<?php the_permalink(); ?>">
        <?php echo i8_the_thumbnail('i8-500-280', 'single-item-thumb hover w-100 i8-img-fit', $dimenition = array('width' => 430, 'height' => 242), true, '', false, true); ?>
      </a>
      <div class="single-item-data d-flex flex-column gap-0">
        <span class="post-category f16 pt-2"><?php echo i8_primary_category(get_the_ID()) ?></span>
        <!-- <span class="post-subtitle f13 fw-1"><?php $subtitle=get_post_meta(get_the_ID(), '_post_subtitle', true);echo ($subtitle) ? $subtitle :'' ; ?></span> -->
        <h1 class="post-title f26 fw-5 l1"><a href="<?php echo get_the_permalink(); ?>" class="i8-blink"><?php i8_limit_text(get_the_title(), 115, '...'); ?></a></h1>
        <?php if ($hide_excerpt != 'on') : ?>
          <p class="post-excerpt f15"><?php i8_limit_text(get_the_excerpt(), 150, '...'); ?></p>
        <?php endif; ?>
        <p class="post-publish-date f12 text-start text-subtitle"><?php the_date() ?></p>
      </div>
  <?php endwhile;
  endif; ?>
  </div>
  <!-- end single items -->

  <!-- multi items -->
  <div class="col-24 col-xl-12 col-lg-12 col-md-12 col-sm-24 multi-items d-flex px-0 gap-1">
    <div class="row">
      <?php
      $category_posts2 = new WP_Query(array(
        'posts_per_page' => 2,
        'cat'            => $cat,
        'order' => 'DESC',
        'offset' => '1',
        'orderby' => $orderby
      ));
      if ($category_posts2->have_posts()) : ?>
        <div class="col-24 col-lg-12 col-md-12 col-sm-24 d-flex flex-column gap-3 px-2 border-start i8-border-sm-none hero-small-column">

          <?php
          while ($category_posts2->have_posts()) :
            $category_posts2->the_post();
          ?>
            <div class="multi-item d-flex flex-column gap-2">
              <a href="<?php the_permalink(); ?>">
                <?php echo i8_the_thumbnail('i8-290-222', 'multi-item-thumb hover w-100 i8-img-fit', $dimenition = array('width' => 222, 'height' => 130), true, '', false, true); ?>
              </a>
              <div class="single-item-data d-flex flex-column gap-0 justify-content-between">
                <div class="title-box">
                  <span class="post-category f16"><?php echo i8_primary_category(get_the_ID()) ?></span>
                  <h1 class="post-title f16 fw-4 l1"><a href="<?php echo get_the_permalink(); ?>" class="i8-blink"><?php i8_limit_text(get_the_title(), 82, '...'); ?></a></h1>
                </div>
                <p class="post-publish-date f12 text-start text-subtitle my-0"><?php the_date() ?></p>
              </div>
            </div>

        <?php
          endwhile;
        endif;
        ?>
        </div>


        <?php
        $category_posts3 = new WP_Query(array(
          'posts_per_page' => 2,
          'cat'            => $cat,
          'order' => 'DESC',
          'offset' => '3',
          'orderby' => $orderby
        ));
        if ($category_posts3->have_posts()) : ?>
          <div class="col-24 col-lg-12 col-md-12 col-sm-24 d-flex flex-column gap-3 px-2 border-start hero-small-column i8-border-md-none">
            <?php
            while ($category_posts3->have_posts()) :
              $category_posts3->the_post();
            ?>
              <div class="multi-item d-flex flex-column gap-2">
                <a href="<?php the_permalink(); ?>">
                  <?php echo i8_the_thumbnail('i8-290-222', 'multi-item-thumb hover w-100 i8-img-fit', $dimenition = array('width' => 222, 'height' => 130), true, '', false, true); ?>
                </a>
                <div class="single-item-data d-flex flex-column gap-0 justify-content-between">
                  <div class="title-box">
                    <span class="post-category f16"><?php echo i8_primary_category(get_the_ID()) ?></span>
                    <h1 class="post-title f16 fw-4 l1"><a href="<?php echo get_the_permalink(); ?>" class="i8-blink"><?php i8_limit_text(get_the_title(), 82, '...'); ?></a></h1>
                  </div>
                  <p class="post-publish-date f12 text-start text-subtitle my-0"><?php the_date() ?></p>
                </div>
              </div>

          <?php
            endwhile;
          endif;
          ?>
          </div>


    </div>
  </div>

  <?php
  echo $args['after_widget'];
  ?>