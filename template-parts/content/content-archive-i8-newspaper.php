<div class="border-bottom box col-12 col-lg-6 d-flex flex-column gap-2 p-3 ">
    <div class="px-0">
        <a href="<?php the_permalink(); ?>" class="image_frame">
            <?php echo i8_the_thumbnail('i8-290-222', 'hover object-fit-cover ', $size = array('width' => '100%', 'height' => 'auto'), true, '', false, true) ?>
        </a>
    </div>
    <div class="d-flex flex-column gap-3 ">
        <h4 class="post-title text-center text-xl-end text-lg-end text-md-end text-sm-end  justify-content-between flex-column ">
            <a href="<?php the_permalink(); ?>" class="fs-5 i8-blink d-inline icon-before-qoute">
                <?php i8_limit_text(get_the_title(), 250, '...'); ?>
            </a>
        </h4>
    </div>

</div>