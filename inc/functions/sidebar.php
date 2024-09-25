<?php

/**
 * declaration sidebars for functions.php
 */
add_action('widgets_init', 'i8_add_custom_sidebar');
function i8_add_custom_sidebar()
{
    //  hero section -  بخش بالای سایت - راست 
    register_sidebar(array(
        'name'           => ' بخش بالای سایت / راست - صفحه نخست',
        'id'             => 'top_section_right',
        'class'          => 'top_section_right',
        'description'    => 'این ساید بار در بالای سایت و سمت راست صفحه نخست قرار دارد.',
        'before_widget'  => '',
        'after_widget'   => '',
        'before_title'   => '',
        'after_title'    => '',
        'before_sidebar' => '',
        'after_sidebar'  => '',
        'show_in_rest'   => false,
    ));
    //  hero section -  بخش بالای سایت - چپ 
    register_sidebar(array(
        'name'           => ' بخش بالای سایت / چپ - صفحه نخست',
        'id'             => 'top_section_left',
        'class'          => 'top_section_left',
        'description'    => 'این ساید بار در بالای سایت و سمت چپ صفحه نخست قرار دارد.',
        'before_widget'  => '<div class="widget">',
        'after_widget'   => '</div>',
        'before_title'   => '',
        'after_title'    => '',
        'before_sidebar' => '',
        'after_sidebar'  => '',
        'show_in_rest'   => false,
    ));



    //  home left sidebar - ساید بار کناری صفحه نخست
    register_sidebar(array(
        'name'           => 'سایدبار کناری - صفحه نخست',
        'id'             => 'hl-sidebar',
        'class'          => 'hl-sidebar',
        'description'    => 'این ساید بار در صفحه اصلی و در سمت چپ قرار می گیرد.',
        'before_widget'  => '<div class="widget box">',
        'after_widget'   => '</div>',
        'before_title'   => '',
        'after_title'    => '',
        'before_sidebar' => '',
        'after_sidebar'  => '',
        'show_in_rest'   => false,
    ));

    //  home main bar - right - سایدبار اصلی صفحه نخست سمت راست
    register_sidebar(array(
        'name'           => 'ستون اصلی - صفحه نخست سمت راست',
        'id'             => 'hmr-sidebar',
        'class'          => 'hmr-sidebar',
        'description'    => 'این ستون در صفحه اصلی و در سمت راست قرار میگیرد.',
        'before_widget'  => '<div class="widget box">',
        'after_widget'   => '</div>',
        'before_title'   => '',
        'after_title'    => '',
        'before_sidebar' => '',
        'after_sidebar'  => '',
        'show_in_rest'   => false,
    ));
    //  home main bar - left - سایدبار اصلی صفحه نخست
    register_sidebar(array(
        'name'           => 'ستون اصلی - صفحه نخست سمت چپ',
        'id'             => 'hml-sidebar',
        'class'          => 'hml-sidebar',
        'description'    => 'این ستون در صفحه اصلی و در سمت راست قرار میگیرد.',
        'before_widget'  => '<div class="widget box ">',
        'after_widget'   => '</div>',
        'before_title'   => '',
        'after_title'    => '',
        'before_sidebar' => '',
        'after_sidebar'  => '',
        'show_in_rest'   => false,
    ));

    //  home main bar - ویژه - سایدبار اصلی صفحه نخست
    register_sidebar(array(
        'name'           => 'ستون اصلی - صفحه نخست ویژه',
        'id'             => 'hms-sidebar',
        'class'          => 'hms-sidebar',
        'description'    => '۲-این ستون در صفحه اصلی و در سمت راست قرار میگیرد.',
        'before_widget'  => '<div class="widget box">',
        'after_widget'   => '</div>',
        'before_title'   => '',
        'after_title'    => '',
        'before_sidebar' => '',
        'after_sidebar'  => '',
        'show_in_rest'   => false,
    ));

    //  home main bar - right - سایدبار اصلی صفحه نخست زیر ویژه  سمت راست
    register_sidebar(array(
        'name'           => 'ستون اصلی - صفحه نخست زیر ویژه سمت راست',
        'id'             => 'hmer-sidebar',
        'class'          => 'hmer-sidebar',
        'description'    => 'این ستون در صفحه اصلی و در سمت راست زیر ویژه قرار میگیرد.',
        'before_widget'  => '<div class="row widget box p-2">',
        'after_widget'   => '</div>',
        'before_title'   => '',
        'after_title'    => '',
        'before_sidebar' => '',
        'after_sidebar'  => '',
        'show_in_rest'   => false,
    ));
    //  home main bar - left - سایدبار اصلی صفحه نخست
    register_sidebar(array(
        'name'           => 'ستون اصلی - صفحه نخست زیر ویژه سمت چپ',
        'id'             => 'hmel-sidebar',
        'class'          => 'hmel-sidebar',
        'description'    => 'این ستون در صفحه اصلی و در سمت راست زیر ویژه قرار میگیرد.',
        'before_widget'  => '<div class="row widget box p-2">',
        'after_widget'   => '</div>',
        'before_title'   => '',
        'after_title'    => '',
        'before_sidebar' => '',
        'after_sidebar'  => '',
        'show_in_rest'   => false,
    ));
    //  home main bar - bottom - انتهای صفحه اصلی
    register_sidebar(array(
        'name'           => 'انتهای صفحه اصلی - تمام عرض',
        'id'             => 'hf-sidebar',
        'class'          => 'hf-sidebar',
        'description'    => 'این ستون در صفحه اصلی و در زیر همه بخش ها و بالای فوتر قرار میگیرد.',
        'before_widget'  => '<div class="widget multimdeia-dark-bg">',
        'after_widget'   => '</div>',
        'before_title'   => '',
        'after_title'    => '',
        'before_sidebar' => '',
        'after_sidebar'  => '',
        'show_in_rest'   => false,
    ));


    //  archive left sidebar - ساید بار کناری صفحه آرشیو
    register_sidebar(array(
        'name'           => 'سایدبار کناری - صفحه آرشیو',
        'id'             => 'al-sidebar',
        'class'          => 'al-sidebar',
        'description'    => 'این ساید بار در صفحه آرشیو و در سمت چپ قرار می گیرد.',
        'before_widget'  => '<div class="widget p-2 p-sm-2 box">',
        'after_widget'   => '</div>',
        'before_title'   => '',
        'after_title'    => '',
        'before_sidebar' => '',
        'after_sidebar'  => '',
        'show_in_rest'   => false,
    ));

    //  single left sidebar - ساید بار کناری صفحه نوشته
    register_sidebar(array(
        'name'           => 'سایدبار کناری - صفحه نوشته',
        'id'             => 'sl-sidebar',
        'class'          => 'sl-sidebar',
        'description'    => 'این ساید بار در صفحه نوشته و در سمت چپ قرار می گیرد.',
        'before_widget'  => '<div class="widget box p-2 p-sm-2 box">',
        'after_widget'   => '</div>',
        'before_title'   => '',
        'after_title'    => '',
        'before_sidebar' => '',
        'after_sidebar'  => '',
        'show_in_rest'   => false,
    ));

    //  single top article sidebar - ساید بار بالای صفحه نوشته 
    register_sidebar(array(
        'name'           => 'سایدبار بالای - صفحه نوشته',
        'id'             => 'st-sidebar',
        'class'          => 'st-sidebar',
        'description'    => 'این ساید بار در صفحه نوشته و در بالای نوشته قرار می گیرد.',
        'before_widget'  => '<div class="widget box">',
        'after_widget'   => '</div>',
        'before_title'   => '',
        'after_title'    => '',
        'before_sidebar' => '',
        'after_sidebar'  => '',
        'show_in_rest'   => false,
    ));

    //  single footer article sidebar - ساید بار پایین نوشته 
    register_sidebar(array(
        'name'           => 'ساید بار پایین - صفحه نوشته',
        'id'             => 'sf-sidebar',
        'class'          => 'sf-sidebar',
        'description'    => 'این ساید بار در صفحه نوشته و در پایین نوشته قرار می گیرد.',
        'before_widget'  => '<div class="widget box">',
        'after_widget'   => '</div>',
        'before_title'   => '',
        'after_title'    => '',
        'before_sidebar' => '',
        'after_sidebar'  => '',
        'show_in_rest'   => false,
    ));

    //  footer right sidebar - ساید بار فوتر - راست
    register_sidebar(array(
        'name'           => 'ساید بار فوتر - راست',
        'id'             => 'fr-sidebar',
        'class'          => 'fr-sidebar',
        'description'    => 'این سایدبار در فوتر تمامی صفحات و در سمت راست قرار می گیرد.',
        'before_widget'  => '<div class="widget">',
        'after_widget'   => '</div>',
        'before_title'   => '',
        'after_title'    => '',
        'before_sidebar' => '',
        'after_sidebar'  => '',
        'show_in_rest'   => false,
    ));

    //  footer right sidebar - ساید بار فوتر - وسط
    register_sidebar(array(
        'name'           => 'ساید بار فوتر - وسط',
        'id'             => 'fc-sidebar',
        'class'          => 'fc-sidebar',
        'description'    => 'این سایدبار در فوتر تمامی صفحات و در وسط قرار می گیرد.',
        'before_widget'  => '<div class="widget col-12 col-lg-6 col-md-6 col-sm-12 d-flex flex-column align-items-center align-content-center ">',
        'after_widget'   => '</div>',
        'before_title'   => '',
        'after_title'    => '',
        'before_sidebar' => '',
        'after_sidebar'  => '',
        'show_in_rest'   => false,
    ));

    //  footer left sidebar - ساید بار فوتر - چپ
    register_sidebar(array(
        'name'           => 'ساید بار فوتر - چپ',
        'id'             => 'fl-sidebar',
        'class'          => 'fl-sidebar',
        'description'    => 'این سایدبار در فوتر تمامی صفحات و در سمت چپ قرار می گیرد.',
        'before_widget'  => '<div class="widget">',
        'after_widget'   => '</div>',
        'before_title'   => '',
        'after_title'    => '',
        'before_sidebar' => '',
        'after_sidebar'  => '',
        'show_in_rest'   => false,
    ));
}
