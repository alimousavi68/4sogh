<?php
// get and set newspaper number ID
if (isset($_GET['np-number'])) {
    $np_number_post = $_GET['np-number'];
} elseif (is_single()) {
    $np_number_post = $post->ID;
} else {
    $np_number_post = get_last_i8_newspaper_post_id();

}

// get and set specific newspaper page number 
if (isset($_GET['np-page'])) {
    $np_page = $_GET['np-page'];
} else {
    $np_page = 1;
}



?>
<div class="row row-gap-md-2 d-flex">
    <div class="col-md-4 d-lg-flex d-none i8-sticky order-2 order-md-1 row-gap-2 flex-column px-0 ps-md-3 pe-md-0 ">

        <!-- منوی صفحات -->
        <div class="widget-container">

            <div class="widget-header d-flex align-items-center justify-content-between cornner-tr">
                <div class="widget-title d-flex align-items-center gap-2 justify-content-start">
                    <span class="fw-6 fs-5 icon-before-qoute">صفحات</span>
                </div>
            </div>

            <div class="widget-body row">
                <?php
                echo get_pages_by_category($np_number_post);
                ?>
            </div>

        </div>

        <!-- دکمه های دانلود -->
        <?php

        $pdfs = get_i8_pdf_value($np_number_post, $np_page);
        $pdf_full = $pdfs['pdf_full'];
        $pdf_page = $pdfs['pdf_page'];
        ?>

        <!-- download link for mobile  -->
        <div class="widget-container">
            <div class="row py-2 row-gap-2">
                <div class="col-12 col-md-24 p-0">
                    <a class="np-btn cornner-tr p-1 fs-6 fw-2 d-flex gap-1" href="<?php echo $pdf_page; ?>" download>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/global/download.svg" width="18"
                            height="auto" alt="">
                        PDF این صفحه
                    </a>
                </div>
                <div class="col-12 col-md-24 p-0">
                    <a class="np-btn cornner-tr p-1 fs-6 fw-2 d-flex gap-1" href="<?php echo $pdf_full; ?>" download>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/global/download.svg" width="18"
                            height="auto" alt="">
                        PDF تمام صفحات
                    </a>
                </div>
            </div>
        </div>


        <div class="d-none d-md-flex flex-column gap-2 widget-container">
            <?php
            dynamic_sidebar('hmr-sidebar');
            ?>
        </div>



    </div>

    <!-- بخش نمایش تصویر روزنامه -->
    <div class="col-24 col-lg-14 order-1 order-md-2 px-0">
        <div class="widget-container cornner-tr">
            <div class="widget-header d-flex align-items-center justify-content-between">
                <div class="widget-title d-flex align-items-center gap-2 justify-content-start">
                    <img src="<?php echo get_template_directory_uri() ?>/images/global/qoute-bullet.svg" alt="">
                    <span class="fw-6 fs-5"><?php echo get_the_title($np_number_post); ?></span>
                </div>
            </div>
            <div class="widget-body row">


                <div id="drawattention-container">

                    <?php
                    function get_np_image_shortcode($np_number, $np_page)
                    {
                        $np_post = get_post($np_number);
                        if ($np_post) {
                            $pages = get_post_meta($np_post->ID, '_i8_pages', true);
                            if ($pages) {
                                foreach ($pages as $page) {
                                    if ($page['number'] == $np_page) {
                                        return $page['image'];
                                    }
                                }
                            }
                        }
                    }
                    $page_image_id = get_np_image_shortcode($np_number_post, $np_page);

                    if ($page_image_id) {
                        echo do_shortcode('[drawattention ID="' . $page_image_id . '"]');
                    } else {
                        echo 'صفحه ای با این شماره موجود نیست';
                    }
                    ?>
                </div>

                <div class="row py-2 row-gap-2 d-flex d-md-none">
                    <div class="col-12 col-md-24 p-0">
                        <a class="np-btn cornner-tr p-1 fs-6 fw-2 d-flex gap-1" href="<?php echo $pdf_page; ?>"
                            download>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/global/download.svg" width="18"
                                height="auto" alt="">
                            PDF این صفحه
                        </a>
                    </div>
                    <div class="col-12 col-md-24 p-0">
                        <a class="np-btn cornner-tr p-1 fs-6 fw-2 d-flex gap-1" href="<?php echo $pdf_full; ?>"
                            download>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/global/download.svg" width="18"
                                height="auto" alt="">
                            PDF تمام صفحات
                        </a>
                    </div>
                </div>
                <div class="d-flex d-md-none justify-content-center w-100">
                    <?php echo get_pages_by_category($np_number_post); ?>
                </div>

            </div>
        </div>
    </div>

    <!-- لیشت نمایش مطالب این صفحه // سایدبار -- -->
    <div
        class="col-24 col-lg-6 i8-sticky d-flex flex-column gap-3 order-3 order-md-3 px-0 ps-md-0 pe-md-3 mt-3 mt-md-0">

        <!-- مطالبی این صفحه -->
        <div class="widget-container cornner-tr ">
            <div class="widget-header d-flex align-items-center justify-content-between">
                <div class="widget-title d-flex align-items-center gap-2 justify-content-start">
                    <span class="fw-6 fs-5 icon-before-qoute">مطالب این صفحه</span>
                </div>
            </div>
            <div class="widget-body row">
                <?php

                $image_id = $page_image_id;
                $hotspot_links = get_drawattention_hotspots($image_id);

                if (is_array($hotspot_links)) {
                    echo '<ul class="p-0 i8-list-items">';
                    foreach ($hotspot_links as $hotspot) {
                        echo '<li>';
                        echo '<a class="fs14 l2 fw-3 text-end" href="' . esc_url($hotspot['url']) . '" target="_blank">' . esc_html($hotspot['title']) . '</a>';
                        echo '</li>';
                    }
                    echo '</ul>';
                } else {
                    echo $hotspot_links; // نمایش خطا در صورت وجود
                }
                ?>
            </div>
        </div>

        <!-- سایدبار -->
        <?php
        dynamic_sidebar('hml-sidebar');
        ?>

    </div>



</div>