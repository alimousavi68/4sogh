<?php
echo $args['before_widget'];

if ($hide_title != 'on') {
  echo '<div class="text-title box-title fs-5 bg-secondary cornner-tr py-2 px-3 fw-5  ' . $head_font_size . ' fw-7 m-0 me-lg-2 me-md-2">';
  echo $args['before_title'] . $icon_print . $title . $args['after_title'];
  echo $sub_title_print . '</div>';
}

?>
<style>
  .single-item-data {
    height: 100%;
  }


</style>

<?php
// <!-- mainslider-2 top-Item -->

// نمایش محتویات ویجت- نمایش پست ها
$category_posts = new WP_Query(
  array(
    'posts_per_page' => 1,
    'cat' => $cat,
    'order' => 'DESC',
    'orderby' => $orderby
  )
);
?>
<div class="d-flex flex-column gap-1 pe-xl-0 pe-lg-0 px-0 box mt-2 py-4 px-2">

  <!-- End post number 1 - big post -->
  <div class="row  pb-3 ">
    <div class="col-24 col-lg-18 col-md-18 col-sm-24 col-xl-18 d-flex flex-column-reverse flex-lg-row flex-md-row flex-sm-row flex-xl-row mx-0 pb-0 pb-md-0 pb-sm-4 px-0 row-gap-0">
      <?php if ($category_posts->have_posts()): ?>
        <?php
        while ($category_posts->have_posts()):
          $category_posts->the_post();
          ?>
          <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-24 ps-lg-2 px-0 px-md-2 px-sm-2 px-lg-2 py-3 py-xl-0 py-lg-0 py-md-0">
            <?php
            $sub_title = get_post_meta(get_the_ID(), '_post_subtitle', true);
            ?>
            <p class="display-6 fw-1 text-xl-end text-lg-end text-md-end text-sm-center mb-0">
              <?php echo $sub_title; ?>
            </p>
            <h1 class="f24 fw-7 text-xl-end text-lg-end text-md-end text-sm-center l1">
              <a href="<?php echo get_the_permalink(); ?>" class="i8-blink">
                <?php i8_limit_text(get_the_title(), 90, '...'); ?>
              </a>
            </h1>

            <!-- <p class="f15 text-gray text-justify">
            <?php //i8_limit_text(get_the_excerpt(), 238, '...'); ?>
          </p> -->
            <p class="post-publish-date f12 text-end text-subtitle mb-0">
              <?php the_date() ?>
            </p>
          </div>
          <div class="col-xl-15 col-lg-15 col-md-15 col-sm-12 col-24 px-0 px-xl-2 px-sm-2 px-lg-2">
            <a href="<?php the_permalink(); ?>" class="image_frame">
              <?php echo i8_the_thumbnail('i8-500-280', 'hover w-100 object-fit-cover i8-h-md-100', $size = array('width' => 430, 'height' => 242), true, 'max-height:255px;', false, true); ?>
            </a>
          </div>
        </div>
      <?php endwhile;
      endif; ?>
    <!-- End post number 1 - big post -->

    <!-- post number 2 -->
    <div class="col-24 col-lg-6 col-md-6 col-sm-24 col-xl-6 gap-1 px-xl-2 px-lg-2 px-md-2 px-0  ">
      <?php
      $category_posts2 = new WP_Query(
        array(
          'posts_per_page' => 1,
          'cat' => $cat,
          'order' => 'DESC',
          'offset' => '1',
          'orderby' => $orderby
        )
      );
      if ($category_posts2->have_posts()): ?>
        <?php
        while ($category_posts2->have_posts()):
          $category_posts2->the_post();
          ?>
          <div class="d-flex flex-column flex-md-column flex-sm-row gap-2 multi-item">
            <a href="<?php the_permalink(); ?>" class="image_frame_2">
              <?php echo i8_the_thumbnail('i8-290-222', 'multi-item-thumb hover w-100 i8-img-fit', $dimenition = array('width' => 222, 'height' => 130), true, '', false, true); ?>
            </a>
            <div class="d-flex flex-column gap-0 justify-content-between">
              <div class="title-box">
                <h1 class="post-title <?php echo $title_font_size; ?>  <?php echo $title_font_weight; ?> l1 ">
                  <a href="<?php echo get_the_permalink(); ?>" class="i8-blink">
                    <?php i8_limit_text(get_the_title(), 82, '...'); ?>
                  </a>
                </h1>
                <p class="post-publish-date f12 text-end text-subtitle my-0">
                  <?php the_date() ?>
                </p>
              </div>

            </div>
          </div>

          <?php
        endwhile;
      endif;
      ?>


    </div>
    <!-- End post number 2 -->
  </div>

  <!-- end top Item -->

  <div class="row w-100 mx-0 d-flex  flex-xl-row flex-lg-row flex-md-row flex-sm-row row-gap-3">
    <?php
    $category_posts3 = new WP_Query(
      array(
        'posts_per_page' => 4,
        'cat' => $cat,
        'order' => 'DESC',
        'offset' => '2',
        'orderby' => $orderby
      )
    );
    if ($category_posts3->have_posts()): ?>

      <?php
      while ($category_posts3->have_posts()):
        $category_posts3->the_post();
        $even_odd_items_padding_in_wraped_mode =  (($category_posts3->current_post + 1) % 2) == 0 ? 'ps-0' : 'pe-0';
        ?>
        <div class="col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 d-flex flex-column gap-2 px-2 px-xl-2 px-lg-2 <?php echo $even_odd_items_padding_in_wraped_mode; ?>">

          <a href="<?php the_permalink(); ?>" class="image_frame_2">
            <?php echo i8_the_thumbnail('i8-290-222', 'multi-item-thumb hover w-100 i8-img-fit', $dimenition = array('width' => 222, 'height' => 130), true, '', false, true); ?>
          </a>

          <div class="d-flex flex-column gap-0 justify-content-between">
            <div class="title-box">
              <h1 class="post-title <?php echo $title_font_size; ?>  <?php echo $title_font_weight; ?> l1 ">
                <a href="<?php echo get_the_permalink(); ?>" class="i8-blink">
                  <?php i8_limit_text(get_the_title(), 82, '...'); ?>
                </a>
              </h1>
              <p class="post-publish-date f12 text-end text-subtitle my-0">
                <?php the_date() ?>
              </p>
            </div>
          </div>

        </div>

        <?php
      endwhile;
    endif;
    ?>


  </div>


</div>

<?php
echo $args['after_widget'];
?>