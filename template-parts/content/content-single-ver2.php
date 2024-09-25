<?php
// post tags 
$posttags = get_the_tags();

$tag_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hash" viewBox="0 0 16 16">
<path d="M8.39 12.648a1.32 1.32 0 0 0-.015.18c0 .305.21.508.5.508.266 0 .492-.172.555-.477l.554-2.703h1.204c.421 0 .617-.234.617-.547 0-.312-.188-.53-.617-.53h-.985l.516-2.524h1.265c.43 0 .618-.227.618-.547 0-.313-.188-.524-.618-.524h-1.046l.476-2.304a1.06 1.06 0 0 0 .016-.164.51.51 0 0 0-.516-.516.54.54 0 0 0-.539.43l-.523 2.554H7.617l.477-2.304c.008-.04.015-.118.015-.164a.512.512 0 0 0-.523-.516.539.539 0 0 0-.531.43L6.53 5.484H5.414c-.43 0-.617.22-.617.532 0 .312.187.539.617.539h.906l-.515 2.523H4.609c-.421 0-.609.219-.609.531 0 .313.188.547.61.547h.976l-.516 2.492c-.008.04-.015.125-.015.18 0 .305.21.508.5.508.265 0 .492-.172.554-.477l.555-2.703h2.242l-.515 2.492zm-1-6.109h2.266l-.515 2.563H6.859l.532-2.563z"/>
</svg>';
$reference_icon = '<?xml version="1.0" encoding="UTF-8"?><svg width="32px" height="32px" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#000000"><path d="M10 12H5a1 1 0 01-1-1V7.5a1 1 0 011-1h4a1 1 0 011 1V12zm0 0c0 2.5-1 4-4 5.5M20 12h-5a1 1 0 01-1-1V7.5a1 1 0 011-1h4a1 1 0 011 1V12zm0 0c0 2.5-1 4-4 5.5" stroke="#000000" stroke-width="1.5" stroke-linecap="round"></path></svg>';

$tag_icon = customizeSVG($tag_icon, 'var(--i8-dark-primary)', 'var(--i8-dark-primary)');
$reference_icon = customizeSVG($reference_icon, 'var(--i8-dark-primary)', 'var(--i8-dark-primary)');

$reference_name = (get_post_meta($post->ID, 'hasht-reference-name', true)) ? get_post_meta($post->ID, 'hasht-reference-name', true) : '';
$reference_link = (get_post_meta($post->ID, 'hasht-reference-link', true)) ? get_post_meta($post->ID, 'hasht-reference-link', true) : '#';
?>
<div class="col-xl-17 col-md-24 col-sm-24 pe-0 ps-2 ps-lg-2 ps-sm-0 d-flex flex-column gap-3">
    <?php
    if (is_active_sidebar('st-sidebar')) {
        echo '<div class="box row d-flex py-3 mx-0 align-content-center row-gap-3">';
        dynamic_sidebar('st-sidebar');
        echo '</div>';
    }
    ?>

    <section class="d-flex flex-column row-gap-3">
        <div class="box l2 content-entry text-justify">
            <div class="row d-flex mx-0 align-content-center">
                <div class="row w-100 mx-0 d-flex flex-column-reverse flex-xl-row flex-lg-row flex-md-row">
                    <div class="col-xl-24 col-lg-24 col-md-24 col-sm-24 ps-lg-2  px-0 px-md-2 px-lg-2">
                        <h1 class="single-title h-fs-8 mt-md-3 text-center"><?php the_title(); ?></h1>
                    </div>
                </div>
                <div class="i8-breadcrumb col-md-12 col-sm-24 mb-0 d-flex flex-row  justify-content-center justify-content-md-start text-gray f14 " aria-label="breadcrumb">
                    <?php i8_breadcrumb(); ?>
                </div>
                <div class="col-md-12 col-sm-24 mb-0 d-flex flex-row  justify-content-center align-item-center justify-content-xl-end justify-content-lg-end justify-content-md-end text-gray f14">
                    <?php if ( get_post_meta(get_the_ID(), 'i8_hide_date', true) != 'on') : ?>
                        <div class="d-flex align-items-center">
                            <p class="text-gray f14 m-0" style="line-height: 100%;padding-top: 5px;"><?php the_date('H:i - Y/m/d ') ?></p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="var(--i8-light-primary)" class="bi bi-calendar2 mx-1" viewBox="0 0 16 16">
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z" />
                                <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z" />
                            </svg>
                        </div>
                    <?php endif; ?>
                    <div class="social-share d-none d-xl-flex d-lg-flex d-md-flex justify-content-center gap-0 gap-lg-0 gap-sm-1">
                        <a class="p-0 p-lg-0 p-sm-1" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" alt="twitter share button" aria-label="twitter share button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="var(--i8-light-primary)" class="bi bi-twitter mx-1" viewBox="0 0 16 16">
                                <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                            </svg>
                        </a>
                        <a class="p-0 p-lg-0 p-sm-1" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" alt="facebook share button" aria-label="facebook share button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="var(--i8-light-primary)" class="bi bi-facebook mx-1" viewBox="0 0 16 16">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                            </svg>
                        </a>
                        <a class="p-0 p-lg-0 p-sm-1" href="https://t.me/share/url?url=<?php the_permalink(); ?>" alt="telegram share button" aria-label="telegram share button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="var(--i8-light-primary)" class="bi bi-telegram mx-1" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.577.298-.595.442-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294.26.006.549-.1.868-.32 2.179-1.471 3.304-2.214 3.374-2.23.05-.012.12-.026.166.016.047.041.042.12.037.141-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8.154 8.154 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629.093.06.183.125.27.187.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.426 1.426 0 0 0-.013-.315.337.337 0 0 0-.114-.217.526.526 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09z" />
                            </svg>
                        </a>
                        <a class="p-0 p-lg-0 p-sm-1" href="https://wa.me/?text=<?php the_permalink(); ?>" alt="whatsapp share button" aria-label="whatsapp share button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="var(--i8-light-primary)" class="bi bi-whatsapp mx-1" viewBox="0 0 16 16">
                                <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                            </svg>
                        </a>

                    </div>
                </div>
            </div>

            <?php the_content(); ?>
        </div>
        <div class="box d-flex flex-xxl-row flex-xl-row flex-lg-row justify-content-between flex-column align-items-start gap-2">
            <?php
            if ($reference_name) :

            ?>
                <div class="reference d-flex flex-wrap align-items-center">
                    <span>منبع : <a href="<?php echo $reference_link; ?>" target="_blank" rel="nofollow" class="tag-item mb-0" aria-label="article reference"><?php echo $reference_name; ?></a></span>
                </div>

            <?php
            endif;


            ?>
            <div class="tags d-flex flex-wrap row-gap-1">
                <?php
                if ($posttags) :
                    echo $tag_icon;
                    foreach ($posttags as $tag) :
                        if ($tag) :
                ?>
                            <a href="<?php echo get_tag_link($tag); ?>" class="tag-item mb-0"><?php echo $tag->name ?></a>
                <?php
                        endif;
                    endforeach;
                else :
                    echo $tag_icon;
                    echo '<a href="#" class="tag-item mb-0">بدون برچسب</a>';
                endif;


                ?>
            </div>

            <div class="social-icons d-flex justify-content-center gap-0 gap-lg-0 gap-sm-1">
                <a class="p-0 p-lg-0 p-sm-1" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" alt="twitter share button" aria-label="twitter share button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="var(--i8-light-primary)" class="bi bi-twitter mx-1" viewBox="0 0 16 16">
                        <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                    </svg>
                </a>
                <a class="p-0 p-lg-0 p-sm-1" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" alt="facebook share button" aria-label="facebook share button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="var(--i8-light-primary)" class="bi bi-facebook mx-1" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                    </svg>
                </a>
                <a class="p-0 p-lg-0 p-sm-1" href="https://t.me/share/url?url=<?php the_permalink(); ?>" alt="telegram share button" aria-label="telegram share button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="var(--i8-light-primary)" class="bi bi-telegram mx-1" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.577.298-.595.442-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294.26.006.549-.1.868-.32 2.179-1.471 3.304-2.214 3.374-2.23.05-.012.12-.026.166.016.047.041.042.12.037.141-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8.154 8.154 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629.093.06.183.125.27.187.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.426 1.426 0 0 0-.013-.315.337.337 0 0 0-.114-.217.526.526 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09z" />
                    </svg>
                </a>
                <a class="p-0 p-lg-0 p-sm-1" href="https://wa.me/?text=<?php the_permalink(); ?>" alt="whatsapp share button" aria-label="whatsapp share button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="var(--i8-light-primary)" class="bi bi-whatsapp mx-1" viewBox="0 0 16 16">
                        <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                    </svg>
                </a>

            </div>




        </div>

        <!-- <?php //get_template_part('template-parts/content/content-related-post'); 
                ?> -->


        <?php //get_template_part('template-parts/content/content-sponsored-post'); 
        ?>

        <?php
        if (is_active_sidebar('sf-sidebar')) {
            echo '<div class="box row d-flex py-3 mx-0 align-content-center row-gap-3">';
            dynamic_sidebar('sf-sidebar');
            echo '</div>';
        }
        ?>

        <?php
        if (comments_open() || get_comments_number()) {
            comments_template();
        }
        ?>

    </section>
</div>
<!--section 1-->