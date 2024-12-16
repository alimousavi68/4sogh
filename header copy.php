<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="<?php echo (get_theme_mod('i8_light_primary_color')) ? get_theme_mod('i8_light_primary_color') : '#383838'; ?>" />

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
    <header id="header" class="mb-4">


        <!-- Main header -->
        <div id="header-container" class="row header-container">
            <div
                class="col-24 d-flex flex-column justify-content-center justify-content-lg-between white-shadow py-2 px-0 d-flex ">
                <div class="container d-flex justify-content-center justify-content-between align-items-center px-lg-0">
                    <div class="col-18 col-md-2 d-flex w-auto gap-4">
                        <!-- Logo -->
                        <a href="<?php echo bloginfo('url') ?>" title="<?php bloginfo('title'); ?> " class="logo">
                            <img width="314" height="75" class="header-logo"
                                src="<?php echo get_stylesheet_directory_uri(); ?>/images/global/logo-bebinobekhon.webp" alt="logo" />
                        </a>
                        <!-- End Logo -->
                    </div>

                    <!-- Social media And mobile Menu -->
                    <div
                        class="col-auto py-2 d-flex flex-column justify-content-between gap-1 gap-lg-2 gap-sm-2 text-white">
                        <div class="d-flex d-lg-none justify-content-end gap-2">

                            <a href="#"
                                class="dark-mode-switch1 dark-btn  px-1 px-lg-0 px-sm-1 d-flex justify-content-center align-items-center"
                                alt="dark mode button" aria-label="dark mode button">
                                <svg class="" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="var(--i8-light-fg-color)" class="bi bi-brightness-high" viewBox="0 0 16 16">
                                    <path
                                        d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
                                </svg>
                            </a>
                            <a href="<?php echo home_url('/?s'); ?>"
                                class="dark-btn px-1 px-lg-0 px-sm-1  d-flex justify-content-center align-items-center"
                                alt="search button" aria-label="search button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23"
                                    fill="var(--i8-light-fg-color)" class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </a>
                            <?php i8_mobile_menu('mobile'); ?>
                        </div>

                        <div class="">
                            <?php i8_show_social_icons(21, 21); ?>
                        </div>
                        <div class="d-flex f14 justify-content-end">
                            <?php
                            // $date = new jDateTime(true, true, 'Asia/Tehran');
                            // echo $date->date("H:i - l j F Y "); ?>
                        </div>



                    </div>
                    <!-- End Social media And mobile Menu -->

                </div>

            </div>



        </div>
        <div id="i8-main-menu-frame" class="row i8-main-menu-frame">
            <div class="container d-flex justify-content-center px-lg-0">

                <!-- Main Menu -->
                <div class="d-none d-lg-flex i8-main-menu col-24 d-flex flex-column justify-content-end ">
                    <div class="d-flex flex-row">
                        <a id="mini-logo" class="sticky-logo ms-2">
                            <img width="174" height="40" src="<?php echo get_stylesheet_directory_uri(); ?>/images/global/logo-mini.webp" alt="logo"  />
                        </a>
                        <?php build_custom_menu_by_location('primary'); ?>
                    </div>
                    

                    <!-- Tools Btn -->
                    <div class="d-flex justify-content-end align-items-center gap-2 gap-lg-2 gap-sm-2">
                        <a href="#"
                            class="dark-mode-switch  px-1 px-lg-0 px-sm-1 round-icon d-flex justify-content-center align-items-center"
                            alt="dark mode button" aria-label="dark mode button">
                            <svg class="" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="var(--i8-light-fg-color)" class="bi bi-brightness-high" viewBox="0 0 16 16">
                                <path
                                    d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
                            </svg>
                        </a>
                        <a href="<?php echo home_url('/?s'); ?>"
                            class=" px-1 px-lg-0 px-sm-1 round-icon d-flex justify-content-center align-items-center"
                            alt="search button" aria-label="search button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23"
                                fill="var(--i8-light-fg-color)" class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </a>
                    </div>
                    <!-- End Tools Btn -->

                </div>
                <!-- End Main Menu -->



            </div>
        </div>

    </header>
    <!-- header  -->