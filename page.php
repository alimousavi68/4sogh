<?php
//header
get_header();
?>
<div class="container px-0">
    <div class="row mx-0">
        <?php get_template_part('template-parts/content/content-page'); ?>



        <!-- sidebar  -->
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-24 ps-0 pe-xl-2 pe-0 pe-sm-0 i8-sticky sl-sidebar">
            <?php dynamic_sidebar('al-sidebar'); ?>
        </div>

    </div>
</div>

<?php
//footer
get_footer();
?>