<?php
$bigSliderCat = 9980;


$one_post_query_args = array(
  'posts_per_page' => '1',
  'cat' => $bigSliderCat,
  'order' => 'DESC',
);
// The Query
$one_post_query = new WP_Query($one_post_query_args);

$two_post_query_args = array(
  'posts_per_page' => '2',
  'cat' => $bigSliderCat,
  'offset' => '1',
  'order' => 'DESC',
);
// The Query
$two_post_query = new WP_Query($two_post_query_args);

$multi_post_query_args = array(
  'posts_per_page' => '6',
  'cat' => $bigSliderCat,
  'offset' => '3',
  'order' => 'DESC',
);
// The Query
$multi_post_query = new WP_Query($multi_post_query_args);

?>

<!-- //باکس اول بزرگ -->
<div class="box row main-slider px-0 px-xl-3 px-lg-3 px-md-3 mx-0">
  <div class="col-xl-12 col-lg-16 col-md-16 col-sm-24 card big-post">
    <?php
    // The Loop
    if ($one_post_query->have_posts()) {
      while ($one_post_query->have_posts()) {
        $one_post_query->the_post();
        $primary_cat = get_post_meta(get_the_ID(), 'hasht_primary_category');

        $primary_cat_color = get_term_meta($primary_cat[0], 'i8_CustomTerm_color', true) ? get_term_meta($primary_cat[0], 'i8_CustomTerm_color', true) : '#000000';
        $primary_cat_color_transparent = $primary_cat_color . 'c4';


    ?>
        <a href="<?php the_permalink(); ?>" class="image_frame">
          <?php echo i8_the_thumbnail('i8-xl-632-486', 'object-fit-cover w-100 rounded-15 card-img hover', 486, true, '', false, true); ?>
        </a>
        <div class="card-img-overlay " style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 20.97%, <?php echo $primary_cat_color_transparent; ?> 100%)">
          <?php if (i8_primary_category($post->ID)) : ?>
            <div class="main-img-tag d-flex align-items-center text-white" style="background-color: <?php echo $primary_cat_color; ?>;">
              <span class="mini-circle"></span>
              <p class="f13 mb-0"><?php echo i8_primary_category($post->ID); ?></p>
            </div>
          <?php endif; ?>
          <h5><a class="card-title i8-blink text-center f31 fw-6 text-white l1" href="<?php echo get_the_permalink(); ?>"><?php i8_limit_text(get_the_title(), 72, '...'); ?></a></h5>
        </div>
    <?php
      }
      /* Restore original Post Data */
      wp_reset_postdata();
    } else {
      // no posts found
    }
    ?>

  </div>
  
  <!-- باکس دوتایی وسط  -->
  <div class="col-xl-6 col-lg-8 col-md-8 col-sm-24 mt-4 mt-xl-0  mt-lg-0 mt-md-0 small-post">
    <div class="row ">
      <?php
      // The Loop
      if ($two_post_query->have_posts()) {
        while ($two_post_query->have_posts()) {
          $two_post_query->the_post();
          $primary_cat = get_post_meta(get_the_ID(), 'hasht_primary_category');

          $primary_cat_color = get_term_meta($primary_cat[0], 'i8_CustomTerm_color', true) ? get_term_meta($primary_cat[0], 'i8_CustomTerm_color', true) : '#000000';
          $primary_cat_color_transparent = $primary_cat_color . 'c4';
      ?>
          <div class="col-sm-24 position-relative item ">
            <a href="<?php the_permalink(); ?>" class="image_frame">
              <?php echo i8_the_thumbnail('i8-lg-464-340', 'object-fit-cover w-100 rounded-15 card-img hover', 231, true, '', false, true); ?>
            </a>
            <div class="card-img-overlay " style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 20.97%, <?php echo $primary_cat_color_transparent; ?> 100%)">
              <?php if (i8_primary_category($post->ID)) : ?>
                <div class="main-img-tag  d-flex align-items-center text-white" style="background-color: <?php echo $primary_cat_color; ?>;">
                  <span class="mini-circle"></span>
                  <p class="f12 mb-0"><?php echo i8_primary_category($post->ID); ?></p>
                </div>
              <?php endif; ?>
              <a class="card-title text-center f18 l1 text-white i8-blink" href="<?php echo get_the_permalink(); ?>"><?php i8_limit_text(get_the_title(), 72, '...'); ?></a>
            </div>
          </div>
      <?php
        }
        /* Restore original Post Data */
        wp_reset_postdata();
      } else {
        // no posts found
      }
      ?>

    </div>
  </div>
  <!-- باکس ۶ تایی کوچک -->
  <div class="col-xl-12 col-lg-24 d-flex flex-wrap row-gap-3 column-xl-gap-0 mt-4 mt-xl-0 flex-lg-row flex-md-row flex-sm-row align-content-start">
    <?php
    // The Loop
    if ($multi_post_query->have_posts()) {
      while ($multi_post_query->have_posts()) {
        $multi_post_query->the_post();
        $primary_cat = get_post_meta(get_the_ID(), 'hasht_primary_category');

        $primary_cat_color = get_term_meta($primary_cat[0], 'i8_CustomTerm_color', true) ? get_term_meta($primary_cat[0], 'i8_CustomTerm_color', true) : '#000000';
        $primary_cat_color_transparent = $primary_cat_color . 'c4';
        $style = 'background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 20.97%,' . $primary_cat_color_transparent . ' 100%)';



    ?>
        <div class="mini-article bigger-img d-flex mb-0 align-items-center  col-xl-24 col-lg-8 col-md-12 col-sm-12">
          <div class="position-relative item">
            <a href="<?php the_permalink(); ?>" class="image_frame">
              <?php echo i8_the_thumbnail('i8-sm-130-88', 'object-fit-cover rounded-15 card-img hover', 67, true, '', false, true); ?>
            </a>
            <div class="card-img-overlay w-100 " style="border-radius:10px;background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 20.97%, <?php echo $primary_cat_color_transparent; ?> 100%)">

            </div>
          </div>
          <a class="f15 me-2 l22-05 mb-0 text-grey i8-blink" href="<?php echo get_the_permalink(); ?>"><?php i8_limit_text(get_the_title(), 74, '...'); ?></a>
        </div>
    <?php
      }
      /* Restore original Post Data */
      wp_reset_postdata();
    } else {
      // no posts found
    }
    ?>
  </div>

</div>

<?php
$subSliderCat = 17;

$sub_post_query_args = array(
  'posts_per_page' => '4',
  'cat' => $subSliderCat,
  'order' => 'DESC',
);
// The Query
$sub_post_query = new WP_Query($sub_post_query_args);
?>

<?php
dynamic_sidebar('top_section_left');
?>