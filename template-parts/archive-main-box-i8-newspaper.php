<?php ?>
<div class="row mx-0">

    <div class="row d-flex align-content-center justigy-content-around bg-secondary cornner-tr px-2 ">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12  box-title text-center text-sm-end">
        <?php
        $cat = get_queried_object();

        // echo '<span class="fs-5 ms-2 icon-before-qoute"> ' . $cat->name . '</span>';
        echo '<span class="fs-5 ms-2 icon-before-qoute"> ' . 'آرشیو روزنامه' . '</span>';
        ?>
      </div>

      <div
        class="i8-breadcrumb col-md-12 col-sm-12 mb-0 d-flex flex-row align-items-center  justify-content-center justify-content-sm-end text-gray f14 "
        aria-label="breadcrumb">
        <?php i8_breadcrumb(); ?>
      </div>
    </div>

    <div class="row px-0 py-2 d-flex row-gap-3">
      <?php
      if (have_posts()):
        while (have_posts()):
          the_post();
          get_template_part('template-parts/content/content-archive-i8-newspaper');
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