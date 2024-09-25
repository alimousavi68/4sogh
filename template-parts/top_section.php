<?php
$bigSliderCat = 17;


$one_post_query_args = array(
    'posts_per_page' => '1',
    'cat' => $bigSliderCat,
    'order' => 'DESC',
);
// The Query
$one_post_query = new WP_Query($one_post_query_args);

$two_post_query_args = array(
    'posts_per_page' => '4',
    'cat' => $bigSliderCat,
    'offset' => '1',
    'order' => 'DESC',
);
// The Query
$two_post_query = new WP_Query($two_post_query_args);
?>

<div class="row box p-3 row-gap-4">
    <!--  top-right-sidebar -->
    <div class="col-24 col-xl-18 col-lg-18 col-md-24 main-slider-2 d-flex px-0 gap-0">
        <div class="row">
        <?php
            dynamic_sidebar('top_section_right');
        ?>
        </div>
    </div>

    <!--  top-left-sidebar -->
    <div class="col-24 col-lg-6 col-md-24 px-0 px-lg-3">
        <?php
        dynamic_sidebar('top_section_left');
        ?>
    </div>
</div>