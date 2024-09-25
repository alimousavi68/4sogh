<?php
//header
get_header();
?>
<div class="container px-0">
    <div class="row mx-0">

        <?php
        $post_structure = get_post_meta(get_the_ID(), 'i8_post_structure', true);

        $video_url = get_post_meta(get_the_ID(), 'hasht-video-link', true);
        $video_emebed = get_post_meta(get_the_ID(), 'hasht-video-embbed', true);

        // تشخیص نوع فایل ویدیو
        $file_extension = pathinfo($video_url, PATHINFO_EXTENSION);
        $is_video = in_array($file_extension, array('mp4', 'webm', 'ogg'));

        // اگر URL یک فایل ویدیویی است
        if ($post_structure == 'image'):
            get_template_part('template-parts/content/content-single-gallery');
        elseif ($post_structure == 'video' && ($is_video || $video_emebed)):
            get_template_part('template-parts/content/content-single-video');
        elseif ($post_structure == 'none-thumbnail'):
            get_template_part('template-parts/content/none-thumbnail');
        else:
            get_template_part('template-parts/content/content-single');
        endif;
        ?>

        <!-- sidebar  -->
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-24 ps-0 pe-xl-2 pe-0 pe-sm-0 i8-sticky sl-sidebar">
            <?php dynamic_sidebar('sl-sidebar'); ?>
        </div>

    </div>
</div>

<?php
//footer
get_footer();
?>