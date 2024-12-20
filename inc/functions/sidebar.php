<?php

/**
 * declaration sidebars for functions.php
 */
add_action('widgets_init', 'i8_add_custom_sidebar');
function i8_add_custom_sidebar()
{
 

    //  home main bar - right - سایدبار اصلی صفحه نخست سمت راست
    register_sidebar(array(
        'name'           => 'ستون اصلی - صفحه نخست سمت راست',
        'id'             => 'hmr-sidebar',
        'class'          => 'hmr-sidebar',
        'description'    => 'این ستون در صفحه اصلی و در سمت راست قرار میگیرد.',
        'before_widget'  => '<div class="widget ">',
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
        'description'    => 'این ستون در صفحه اصلی و در سمت چپ قرار میگیرد.',
        'before_widget'  => '',
        'after_widget'   => '',
        'before_title'   => '',
        'after_title'    => '',
        'before_sidebar' => '<div class="1 widget widget-container d-flex flex-column row-gap-3">',
        'after_sidebar'  => '</div>',
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
        'before_widget'  => '<div class="widget">',
        'after_widget'   => '</div>',
        'before_title'   => '',
        'after_title'    => '',
        'before_sidebar' => '',
        'after_sidebar'  => '',
        'show_in_rest'   => false,
    ));
    register_sidebar(array(
        'name'           => 'سایدبار بالایی - صفحه آرشیو',
        'id'             => 'at-sidebar',
        'class'          => 'at-sidebar',
        'description'    => 'این ساید بار در صفحه آرشیو و در سمت بالا قرار می گیرد.',
        'before_widget'  => '<div class="widget">',
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
        'before_widget'  => '<div class="widget ">',
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
        'before_widget'  => '<div class="widget ">',
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
        'before_widget'  => '<div class="widget ">',
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
