<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color"
        content="<?php echo (get_theme_mod('i8_light_primary_color')) ? get_theme_mod('i8_light_primary_color') : '#383838'; ?>" />

    <!-- SEO Meta Tags -->
    <title><?php wp_title(' | ', true, 'right'); ?> </title>

    <meta name="keywords" content="<?php
    if (is_single()) {
        $tags = get_the_tags();
        $tag_names = array();
        if ($tags) {
            foreach ($tags as $tag) {
                $tag_names[] = $tag->name;
            }
            echo implode(', ', $tag_names);
        }
    } else {
        echo 'اخبار, اخبار روز , خبر';
    }
    ?>">

    <!-- Social Media Meta Tags -->
    <meta property="og:title" content="<?php wp_title(' | ', true, 'right'); ?> <?php bloginfo('name'); ?>">
    <meta property="og:description" content="<?php
    if (is_home() || is_front_page()) {
        bloginfo('description');
    } elseif (is_single()) {
        echo strip_tags(get_the_excerpt());
    }
    ?>">
    <meta property="og:image"
        content="<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/images/global/no-image.png'; ?>">
    <meta property="og:url" content="<?php echo get_permalink(); ?>">
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    <meta property="og:type" content="article">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?>">
    <meta name="twitter:description" content="<?php
    if (is_home() || is_front_page()) {
        bloginfo('description');
    } elseif (is_single()) {
        echo strip_tags(get_the_excerpt());
    }
    ?>">
    <meta name="twitter:image"
        content="<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/images/global/no-image.png'; ?>">

    <?php wp_head(); ?>

    <?php if (is_singular()): ?>
        <style media="print">
            .sl-sidebar,
            .sub-header,
            .bottom-content-bar,
            .related-post,
            #footer,
            .top-menu,
            #comments {
                display: none !important;
            }
        </style>

    <?php endif; ?>
    <style>
        
        .bottom-menu {
            /* background: var(--i8-dark-bg-color); */
            /* color: white; */
        }

        .row {
            margin: 0px !important;
            /* padding: 0px !important; */
        }

        .round-icon {
            background-color: var(--i8-dark-complete-color);
            width: 37px;
            height: 37px;
            color: white;
        }

        .i8-main-menu-frame {
            background: linear-gradient(to bottom, var(--i8-light-primary) 50%, var(--i8-light-bg-color) 50%);
            transition: top 0.6s ease;

        }

        .dark-mode .i8-main-menu-frame {
            background: linear-gradient(to bottom, var(--i8-dark-fg-color) 50%, var(--i8-dark-bg-color) 50%);
            transition: top 0.6s ease;

        }

        .i8-main-menu {
            display: flex;
            max-width: 1300px;
            height: 50px;
            padding: 7px;
            justify-content: space-between;
            flex-shrink: 0;
            position: relative;
            background-color: var(--i8-light-fg-color);
            box-shadow: 0px 5px 15px 0px rgba(0, 0, 0, 0.10);
            align-content: space-between;
            flex-wrap: wrap;
        }

        .sticky {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        #mini-logo {

            width: 0px;
            overflow: hidden;
            transition: width 0.5s ease;
        }

        .i8-show {
            width: 174px !important;
            transition: width 0.5s ease;
        }

    </style>

</head>

<body dir="rtl" class="bg-main">
    <!-- header -->
    <header id="header" class="mb-4 mt-2">
        <div class="container d-flex justify-content-between  bg-secondary cornner-tr p-0 i8-header ">
            <div class="col-18 row h-right">
                <div class="align-items-center col-10 col-lg-5 col-md-6 d-flex h-logo m-0">
                    <!-- Logo -->
                    <a href="<?php echo bloginfo('url') ?>" title="<?php bloginfo('title'); ?> " class="logo">
                        <img width="153" height="73" class="header-logo"
                            src="<?php echo get_stylesheet_directory_uri(); ?>/images/global/logo.png" alt="logo" />
                    </a>
                    <!-- End Logo -->
                </div>
                <div class="d-none i8-line-divider col-auto d-lg-flex">

                </div>

                <div class="col-18 d-flex d-md-flex d-none flex-column h-menu justify-content-center row row-gap-2">
                    <div class="d-flex flex-row gap-2">
                        <?php
                        if (function_exists('parsidate')) {
                            // دریافت تاریخ امروز
                            $today = parsidate('l j F  Y');
                            echo '<span class="i8-bullet-rec d-none d-sm-flex">' . $today . '</span>';
                        }
                        echo '<span class="i8-bullet-rec d-none d-sm-flex">' . date('d YF') . '</span>';
                        ?>
                        <span class="i8-bullet-rec d-none d-sm-flex ">
                            <?php
                            echo display_hijri_date_with_format();
                            ?>
                        </span>
                        <?php
                        $last_newspaper_print_info = get_last_post_year_and_number_meta()
                            ?>
                        <span class="i8-bullet-rec d-none d-sm-flex "><?php echo $last_newspaper_print_info['year']; ?></span>
                        <span class="i8-bullet-rec d-none d-sm-flex">شماره  <?php echo $last_newspaper_print_info['number']; ?></span>
                    </div>
                    <div class="">
                        <?php build_custom_menu_by_location('primary'); ?>
                    </div>
                </div>
            </div>
            <div class="col-6 h-left  d-flex flex-column justify-content-center align-content-center">
                <div class="bg-danger cornner-bs d-flex justify-content-end p-0 p-sm-2">
                    <?php i8_show_social_icons(21, 21); ?>
                    <?php i8_mobile_menu('mobile'); ?>
                </div>
                <div class="text-start fw-3 ps-2 pt-2 d-none d-md-block">
                    CHARSOGH NEWSPAPER
                </div>
            </div>
        </div>

    </header>
    <!-- header  -->