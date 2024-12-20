<?php
//header
get_header();

$cat = get_queried_object();
$slug = $cat->slug;
?>
<!-- main section -->
<div class="container px-0 mb-4">
    <?php
    if ($slug == 'multimedia') {
        get_template_part('template-parts/archive-multimedia-main-box');
    } else {
        get_template_part('template-parts/archive-main-box');
    }
    ?>
</div>
<!-- main section -->

<?php
//footer
get_footer();
?>