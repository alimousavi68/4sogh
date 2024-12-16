<div class="box archive-card d-flex flex-column flex-xl-row flex-lg-row flex-md-row flex-sm-row row-gap-3 border-bottom py-3">
    <div class="archive-thumb col-lg-6 col-md-6 col-sm-6  px-0 px-xl-2 px-lg-2">
        <a href="<?php the_permalink(); ?>" class="image_frame">
            <?php echo i8_the_thumbnail('i8-290-222', 'hover w-100 object-fit-cover i8-h-md-100', $size = array('width' => '290', 'height' => 163), true, '', false, true) ?>
        </a>
    </div>
    <div class="d-flex flex-column col-lg-18 col-md-18 col-sm-18 px-3">
        <h4
            class="post-title text-center text-xl-end text-lg-end text-md-end text-sm-end  justify-content-between flex-column ">
            <a href="<?php the_permalink(); ?>" class="fs-4 l2 fw-6 i8-blink d-inline">
                <?php i8_limit_text(get_the_title(), 250, '...'); ?>
            </a>
        </h4>
        <p class="text-justify fs-6 fw-2">
            <?php i8_limit_text(get_the_excerpt(), 240, '...'); ?>
        </p>
    </div>

</div>