<?php ?>
<div class="row mx-0">
  <div class="col-xl-17 col-md-24 col-sm-24 d-flex flex-column ">

    <div class="d-flex align-content-center justify-content-between bg-secondary cornner-tr px-2">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12  box-title text-center text-sm-end">
        <?php
        $cat = get_queried_object();

        echo '<span class="fs-5 ms-2 icon-before-qoute"> ' . $cat->name . '</span>';
        ?>
      </div>
      <div
        class="i8-breadcrumb col-md-12 col-sm-12 mb-0 d-flex flex-row align-items-center  justify-content-center justify-content-sm-end text-gray f14 "
        aria-label="breadcrumb">
        <?php i8_breadcrumb(); ?>
      </div>
    </div>
    <div class="d-flex flex-column row-gap-2 mt-2">
      <?php
      if (have_posts()):
        while (have_posts()):
          the_post();
          get_template_part('template-parts/content/content-archive');
        endwhile;
        // Pagination
        i8_custom_pagination();
      else:
        //to do 
        echo '<p>پستی وجو ندارد!</p>';
      endif;
      ?>
    </div>
  </div>


  <!-- sidebar  -->
  <div class="col-xl-7 col-md-24 col-sm-24 ps-0 pt-4 pt-xl-0 pt-md-4 pt-sm-4 pe-xl-3 pe-0 pe-sm-0 i8-sticky  ">
    <?php
    dynamic_sidebar('al-sidebar');
    ?>
  </div>


</div>