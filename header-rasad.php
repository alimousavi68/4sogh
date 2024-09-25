<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="<?php echo (get_theme_mod('i8_light_primary_color')) ? get_theme_mod('i8_light_primary_color') : '#0A93CD'; ?>" />
    <title><?php bloginfo('title'); ?></title>
    <?php wp_head(); ?>
    <?php if (is_singular()) : ?>
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
        .top-menu {
            display: flex;
            padding: 1px;
            justify-content: space-between;
            align-items: center;
            align-self: stretch;
            background: #1171B7;
            height: 29px;
            color: white;
        }

        .bottom-menu {
            /* display: flex;
            padding: 1px;
            justify-content: space-between;
            align-items: center;
            align-self: stretch; */
            background: #1171B7;
            color: white;
        }

        .row {
            margin: 0px !important;
            padding: 0px !important;
        }

        .round-icon {
            background-color: #1e6fb7;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            color: white;
        }
    </style>
</head>

<body dir="rtl" class="bg-main">
    <!-- header -->
    <header id="header">
        <!-- top menu -->
        <div class="row">
            <div class="col-24 top-menu ">
                <div class="container d-flex justify-content-center justify-content-between p-1 align-items-center">
                    <span class="d-flex f13"><?php
                                                $date = new jDateTime(true, true, 'Asia/Tehran');
                                                echo $date->date("l j F Y H:i"); ?></span>
                    <?php i8_show_social_icons(16, 18); ?>

                </div>
            </div>
        </div>
        <!-- End - top menu -->
        <!-- Main header -->
        <div class="row ">
            <div class="col-24 d-flex justify-content-center justify-content-lg-between white-shadow py-3 px-0 d-flex align-items-center border-bottom">
                <div class="container d-flex justify-content-center justify-content-between align-items-center px-lg-0">
                    <div class="col-18 col-md-2 d-flex w-auto gap-4">
                        <a href="<?php echo bloginfo('url') ?>" title="<?php bloginfo('title'); ?> " class="logo">
                            <img width="177" height="70" class="header-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/images/global/rasaderooz.ir-logo.webp" alt="logo" />
                        </a>
                        <div class="d-none d-lg-flex align-items-center">
                            <?php build_custom_menu_by_location('primary'); ?>
                        </div>
                    </div>
                    <div class="col-auto py-2 d-flex align-items-center justify-content-between gap-2 gap-lg-2 gap-sm-2">

                        <div class="d-flex d-lg-none">
                            <?php i8_mobile_menu('mobile'); ?>
                        </div>
                        <div class="d-flex justify-content-end align-items-center gap-2 gap-lg-2 gap-sm-2">
                            <a href="#" class="dark-mode-switch  px-1 px-lg-0 px-sm-1 round-icon d-flex justify-content-center align-items-center" alt="dark mode button" aria-label="dark mode button">
                                <svg class="" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="var(--i8-light-fg-color)" class="bi bi-brightness-high" viewBox="0 0 16 16">
                                    <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
                                </svg>
                            </a>
                            <a href="<?php echo home_url('/?s'); ?>" class=" px-1 px-lg-0 px-sm-1 round-icon d-flex justify-content-center align-items-center" alt="search button" aria-label="search button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="var(--i8-light-fg-color)" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <?php
            if (function_exists('show_market_bar')) {
                show_market_bar();
            }
            ?>
        </div>
    </header>
    <!-- header  -->