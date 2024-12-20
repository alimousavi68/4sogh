<?php ?>
<style>
  .bg-main {
    background-color: var(--i8-dark-bg-color) !important;
  }

  .box {
    background-color: var(--i8-dark-fg-color) !important;
  }

  .box {
    background-color: var(--i8-light-fg-color);
    background-color: #4c4c4cd1;
  }

  .cornner-tr::after,.cornner-bottom::after {
    background-color: var(--i8-dark-bg-color) !important;
  }

  .list-title a,
  .post-title a {
    color: #e9e9e9;
  }

  .text-grey {
    color: #e9e9e9;
  }

  .timeline-item {
    color: #e9e9e9;
  }
</style>
<div class="row">
  <div class="col px-0">
    <?php
    dynamic_sidebar('at-sidebar');
    ?>
  </div>
</div>
<div class="row mx-0">
  <div class="col-xl-24 col-md-24 col-sm-24 d-flex flex-column px-0">

    <div class="d-flex align-content-center justify-content-between bg-secondary cornner-tr px-2">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12  box-title text-center text-sm-end">
        <?php
        $cat = get_queried_object();

        echo '<span class="fs-5 ms-2 icon-before-qoute"> ' . $cat->name . '</span>';
        ?>
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


</div>