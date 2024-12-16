<?php
echo $args['before_widget'];

echo '<div class="text-title box-title fs-5 bg-secondary cornner-tr py-2 px-3 ' . $head_font_size . ' m-0">';
if ($hide_title != 'on') {
  echo $args['before_title'] . $icon_print . $title . $args['after_title'];
}
echo $sub_title_print . '</div>';

?>
<style>
  .multi-items {
    border-bottom: 1px solid #ccc;
  }

  .multi-items:last-child {
    border-bottom: 0px;
  }
</style>


<div class="box mt-2 py-4 px-2 col-24 col-xl-24  col-lg-24 col-md-24 col-sm-24 multi-items d-flex gap-2">
  <div class="row row-gap-3">
    <?php

    $category_posts2 = new WP_Query(
      array(
        'posts_per_page' => $num,
        'cat' => $cat,
        'order' => 'DESC',
        'orderby' => $orderby
      )
    );

 
    if ($category_posts2->have_posts()) { ?>
      <?php
      while ($category_posts2->have_posts()) {
        $category_posts2->the_post();
        ?>
        <div class="<?php echo $col; ?> border-bottom-dashed multi-item d-flex flex-column gap-2 <?php echo ( $category_posts2->current_post + 1  == $num ) ? '' : ''; ?>">
          <a href="<?php the_permalink(); ?>" class="image_frame" >
            <?php echo i8_the_thumbnail('i8-md-219-140', 'hover multi-item-thumb w-100 i8-img-fit', $dimenition = array('width' => 231, 'height' => 140), true, '', false, true); ?>
          </a>
          <div class="single-item-data d-flex flex-column gap-1 justify-content-between">
            <div class="title-box">
             

              <h1 class="post-title <?php echo $title_font_size; ?> <?php echo $title_font_weight; ?> l1">
                <a href="<?php echo get_the_permalink(); ?>" class="i8-blink">
                  <?php i8_limit_text(get_the_title(), 200, '...'); ?>
                </a>
              </h1>
            </div>
            <p class="post-publish-date f12 text-end text-subtitle my-2">
              <?php the_date() ?>
            </p>
          </div>
        </div>
        <?php
      }
      wp_reset_postdata();
    }


    ?>


  </div>
</div>

<?php
echo $args['after_widget'];
?>