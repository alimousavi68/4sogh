<?php
// post tags 
$posttags = get_the_tags();
// $tag_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hash" viewBox="0 0 16 16">
// <path d="M8.39 12.648a1.32 1.32 0 0 0-.015.18c0 .305.21.508.5.508.266 0 .492-.172.555-.477l.554-2.703h1.204c.421 0 .617-.234.617-.547 0-.312-.188-.53-.617-.53h-.985l.516-2.524h1.265c.43 0 .618-.227.618-.547 0-.313-.188-.524-.618-.524h-1.046l.476-2.304a1.06 1.06 0 0 0 .016-.164.51.51 0 0 0-.516-.516.54.54 0 0 0-.539.43l-.523 2.554H7.617l.477-2.304c.008-.04.015-.118.015-.164a.512.512 0 0 0-.523-.516.539.539 0 0 0-.531.43L6.53 5.484H5.414c-.43 0-.617.22-.617.532 0 .312.187.539.617.539h.906l-.515 2.523H4.609c-.421 0-.609.219-.609.531 0 .313.188.547.61.547h.976l-.516 2.492c-.008.04-.015.125-.015.18 0 .305.21.508.5.508.265 0 .492-.172.554-.477l.555-2.703h2.242l-.515 2.492zm-1-6.109h2.266l-.515 2.563H6.859l.532-2.563z"/>
// </svg>';
// $tag_icon = customizeSVG($tag_icon, 'var(--i8-dark-primary)', 'var(--i8-dar-primary)');
$tag_icon = '';
$reference_icon = '<?xml version="1.0" encoding="UTF-8"?><svg width="32px" height="32px" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#000000"><path d="M10 12H5a1 1 0 01-1-1V7.5a1 1 0 011-1h4a1 1 0 011 1V12zm0 0c0 2.5-1 4-4 5.5M20 12h-5a1 1 0 01-1-1V7.5a1 1 0 011-1h4a1 1 0 011 1V12zm0 0c0 2.5-1 4-4 5.5" stroke="#000000" stroke-width="1.5" stroke-linecap="round"></path></svg>';

$tag_icon = customizeSVG($tag_icon, 'var(--i8-dark-primary)', 'var(--i8-dark-primary)');
$reference_icon = customizeSVG($reference_icon, 'var(--i8-dark-primary)', 'var(--i8-dark-primary)');

$reference_name = (get_post_meta($post->ID, 'hasht-reference-name', true)) ? get_post_meta($post->ID, 'hasht-reference-name', true) : '';
$reference_link = (get_post_meta($post->ID, 'hasht-reference-link', true)) ? get_post_meta($post->ID, 'hasht-reference-link', true) : '#';
?>
<div class="col-md-17 col-sm-24 col-xl-18 d-flex flex-column gap-2 pe-0 ps-0 ps-xl-3 ps-lg-3 ps-md-2 ps-sm-0">
    <?php
    if (is_active_sidebar('st-sidebar')) {
        echo '<div class=" row d-flex py-3 mx-0 align-content-center row-gap-3">';
        dynamic_sidebar('st-sidebar');
        echo '</div>';
    }
    ?>
    <!-- breadcrumb -->
    <div class=" d-flex align-items-top pb-2 mx-0 align-content-center row-gap-3 i8-breadcrumb box p-2 order-2 order-xl-1 order-lg-1  align-items-center  flex-wrap justify-content-around">
        <div class="col-md-12 col-sm-24 mb-0 d-flex flex-row  justify-content-center justify-content-md-start text-gray f14 "
            aria-label="breadcrumb">
            <?php i8_breadcrumb(); ?>
        </div>
        <div
            class="d-xl-flex d-lg-flex d-md-flex  col-md-12 col-sm-24 mb-0 flex-row  justify-content-center justify-content-md-end text-gray f14">
            <div class="d-flex justify-content-center gap-3 gap-lg-2 gap-sm-1">

                <?php if (get_post_meta(get_the_ID(), 'i8_hide_date', true) != 'on'): ?>
                    <div class="d-flex align-items-center gap-2">
                        <p class="text-gray f14 m-0" style="line-height: 100%;padding-top: 5px;">
                            <?php the_date('H:i - Y/m/d ') ?>
                        </p>

                        <svg xmlns="http://www.w3.org/2000/svg" width="21px" height="21px" fill="none" stroke-width="1.5"
                            viewBox="0 0 24 24" color="var(--i8-light-primary)">
                            <path stroke="var(--i8-light-primary)" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" d="M12 6v6h6"></path>
                            <path stroke="var(--i8-light-primary)" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10Z"></path>
                        </svg>
                    </div>
                <?php endif; ?>

                <a class="p-0 p-lg-0 p-sm-1" href="#share-btn" alt="copy page link button"
                    aria-label="copy page link button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="none" stroke-width="1.5"
                        viewBox="0 0 24 24" color="var(--i8-light-primary)">
                        <path stroke="var(--i8-light-primary)" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M14 11.998C14 9.506 11.683 7 8.857 7H7.143C4.303 7 2 9.238 2 11.998c0 2.378 1.71 4.368 4 4.873a5.3 5.3 0 0 0 1.143.124">
                        </path>
                        <path stroke="var(--i8-light-primary)" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M10 11.998c0 2.491 2.317 4.997 5.143 4.997h1.714c2.84 0 5.143-2.237 5.143-4.997 0-2.379-1.71-4.37-4-4.874A5.304 5.304 0 0 0 16.857 7">
                        </path>
                    </svg>
                </a>
                <a class="p-0 p-lg-0 p-sm-1" id="printButton" href="" alt="print page button"
                    aria-label="print page button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="none" stroke-width="1.5"
                        viewBox="0 0 24 24" color="var(--i8-light-primary)">
                        <path stroke="var(--i8-light-primary)" stroke-width="1.5"
                            d="M17.571 18H20.4a.6.6 0 0 0 .6-.6V11a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v6.4a.6.6 0 0 0 .6.6h2.829M8 7V3.6a.6.6 0 0 1 .6-.6h6.8a.6.6 0 0 1 .6.6V7">
                        </path>
                        <path stroke="var(--i8-light-primary)" stroke-width="1.5"
                            d="M6.098 20.315 6.428 18l.498-3.485A.6.6 0 0 1 7.52 14h8.96a.6.6 0 0 1 .594.515L17.57 18l.331 2.315a.6.6 0 0 1-.594.685H6.692a.6.6 0 0 1-.594-.685Z">
                        </path>
                        <path stroke="var(--i8-light-primary)" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" d="m17 10.01.01-.011"></path>
                    </svg>
                </a>


            </div>
        </div>
    </div>

    <!-- intro -->
    <div class="article d-flex flex-column gap-3 justify-content-between box p-xl-4 p-lg-4 p-md-4 p-0 order-1 order-xl-2 order-lg-2 ">

        <div class="row">
            <?php
            $sub_title = get_post_meta(get_the_ID(), '_post_subtitle', true);
            ?>
            <p class="display-6 fw-1 text-justify text-xl-end text-lg-end text-md-end text-sm-justify mb-0">
                <?php echo $sub_title; ?>
            </p>
            <h1 class="single-title fw-7 h-fs-8 text-justify text-xl-end text-lg-end text-md-end text-sm-justify">
                <?php the_title(); ?>
            </h1>
            <p class="f15 text-gray text-justify">
                <?php i8_limit_text(get_the_excerpt(), 350, '...'); ?>
            </p>
        </div>

    </div>

    <!-- body -->
    <section class="d-flex flex-column row-gap-3 box p-4 mt-2  order-3 order-xl-3 order-lg-3">

        <div class="l2 content-entry text-justify border-bottom ">
            <?php the_content(); ?>

            <?php
            if ($reference_name):
                ?>
                <div class="reference d-flex flex-wrap align-items-center my-4">
                    <span>منبع : <a href="<?php echo $reference_link; ?>" target="_blank" rel="nofollow"
                            class="tag-item mb-0" aria-label="article reference">
                            <?php echo $reference_name; ?>
                        </a></span>
                </div>

                <?php
            endif;
            ?>
            <?php
            if ($author_name):
                ?>
                <div class="reference d-flex flex-wrap align-items-center my-4">
                    <p>نویسنده : <span class="tag-item mb-0" aria-label="article auhtor name">
                            <?php echo $author_name; ?>
                        </span></p>
                </div>
                <?php
            endif;
            ?>


        </div>

        <div
            class="bottom-content-bar d-flex flex-xxl-row flex-xl-row flex-lg-row  border-bottom pb-2 justify-content-between flex-column align-items-start gap-4">
            <div class="tags d-flex flex-wrap row-gap-2">


                <?php
                echo $tag_icon;
                if ($posttags):
                    foreach ($posttags as $tag):
                        if ($tag):
                            ?>
                            <a href="<?php echo get_tag_link($tag); ?>" class="tag-item mb-0 d-flex align-items-center">
                                <?php echo $tag->name ?>
                            </a>
                            <?php
                        else:
                            echo '<a href="#" class="tag-item mb-0">بدون برچسب</a>';
                        endif;
                    endforeach;
                endif;
                ?>

            </div>

            <div class="d-flex flex-wrap gap-2 gap-3 gap-lg-2 gap-sm-1 justify-content-end social-icons">
                <div class="copy-link">
                    <div class="container-share-button">
                        <div class="share-container">
                            <div class="share-btn" id='share-btn'>
                                کپی لینک
                            </div>
                            <div contenteditable="true" class="share-url"></div>

                        </div>
                    </div>
                    <div class="animate slide-in-down notification-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" fill="none"
                            stroke-width="1.5" viewBox="0 0 24 24" color="#383838">
                            <path stroke="#383838" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                d="M19.4 20H9.6a.6.6 0 0 1-.6-.6V9.6a.6.6 0 0 1 .6-.6h9.8a.6.6 0 0 1 .6.6v9.8a.6.6 0 0 1-.6.6Z">
                            </path>
                            <path stroke="#383838" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                d="M15 9V4.6a.6.6 0 0 0-.6-.6H4.6a.6.6 0 0 0-.6.6v9.8a.6.6 0 0 0 .6.6H9"></path>
                        </svg> در داخل کلیپ بورد ذخیره شد!
                    </div>


                </div>
                <a class="p-0 p-lg-0 p-sm-1" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>"
                    alt="twitter share button" aria-label="twitter share button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="var(--i8-light-primary)"
                        class="bi bi-twitter mx-1" viewBox="0 0 16 16">
                        <path
                            d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                    </svg>
                </a>
                <a class="p-0 p-lg-0 p-sm-1"
                    href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"
                    alt="instagram share button" aria-label="instagram share button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="var(--i8-light-primary)"
                        class="bi bi-instagram mx-1" viewBox="0 0 16 16">
                        <path
                            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                    </svg>
                </a>
                <a class="p-0 p-lg-0 p-sm-1" href="https://t.me/share/url?url=<?php the_permalink(); ?>"
                    alt="telegram share button" aria-label="telegram share button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="var(--i8-light-primary)"
                        class="bi bi-telegram mx-1" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.577.298-.595.442-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294.26.006.549-.1.868-.32 2.179-1.471 3.304-2.214 3.374-2.23.05-.012.12-.026.166.016.047.041.042.12.037.141-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8.154 8.154 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629.093.06.183.125.27.187.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.426 1.426 0 0 0-.013-.315.337.337 0 0 0-.114-.217.526.526 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09z" />
                    </svg>
                </a>
                <a class="p-0 p-lg-0 p-sm-1" href="https://wa.me/?text=<?php the_permalink(); ?>"
                    alt="whatsapp share button" aria-label="whatsapp share button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="var(--i8-light-primary)"
                        class="bi bi-whatsapp mx-1" viewBox="0 0 16 16">
                        <path
                            d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                    </svg>
                </a>

            </div>

        </div>

        <?php get_template_part('template-parts/content/content-related-post'); ?>


        <?php
        if (is_active_sidebar('sf-sidebar')) {
            echo '<div class=" row d-flex py-3 mx-0 align-content-center row-gap-3">';
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